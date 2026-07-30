<?php
require 'conn/db.php';
require 'includes/mailer.php';

// Auto-migrate forgot password & SMTP tables if missing
ensure_forgot_password_tables_exist($pdo);

if (!isset($_SESSION['reset_email'])) {
    header("Location: " . BASE_URL . "/forgot_password");
    exit;
}

$email = $_SESSION['reset_email'];
$error = '';
$success = $_SESSION['flash_msg'] ?? '';
unset($_SESSION['flash_msg']);

// Retrieve current active token record
$stmtToken = $pdo->prepare("
    SELECT * FROM password_reset_tokens 
    WHERE email = ? AND used_at IS NULL 
    ORDER BY id DESC LIMIT 1
");
$stmtToken->execute([$email]);
$tokenRecord = $stmtToken->fetch();

$isExpired = false;
$remainingSeconds = 0;

if (!$tokenRecord) {
    $isExpired = true;
} else {
    $expiresTime = strtotime($tokenRecord['expires_at']);
    $remainingSeconds = $expiresTime - time();
    if ($remainingSeconds <= 0) {
        $isExpired = true;
        $remainingSeconds = 0;
    }
}

// Resend Cooldown calculation (60 seconds)
$lastRequestTime = $_SESSION['last_otp_request_time'] ?? 0;
$resendCooldown = max(0, 60 - (time() - $lastRequestTime));

// Handle Resend Request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'resend') {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';

    if ($resendCooldown > 0) {
        $error = "Silakan tunggu $resendCooldown detik lagi sebelum meminta kode baru.";
    } else {
        // Rate limiting check
        $stmtRate = $pdo->prepare("
            SELECT COUNT(*) FROM password_reset_logs 
            WHERE (email = ? OR ip_address = ?) 
              AND action IN ('request_otp', 'resend_otp') 
              AND created_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)
        ");
        $stmtRate->execute([$email, $ip]);
        if ((int)$stmtRate->fetchColumn() >= 5) {
            $error = "Terlalu banyak permintaan OTP. Silakan tunggu 15 menit lagi.";
        } else {
            // Get user_id
            $stmtUser = $pdo->prepare("SELECT id_user FROM users WHERE email = ? LIMIT 1");
            $stmtUser->execute([$email]);
            $user = $stmtUser->fetch();
            $userId = $user['id_user'] ?? 0;

            // Invalidate old OTPs
            $pdo->prepare("UPDATE password_reset_tokens SET used_at = NOW() WHERE email = ? AND used_at IS NULL")->execute([$email]);

            // Generate new OTP
            $otp = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
            $otp_hash = password_hash($otp, PASSWORD_DEFAULT);
            $expires_at = date('Y-m-d H:i:s', time() + 600);

            $stmtIns = $pdo->prepare("INSERT INTO password_reset_tokens (user_id, email, otp_hash, expires_at) VALUES (?, ?, ?, ?)");
            $stmtIns->execute([$userId, $email, $otp_hash, $expires_at]);

            log_audit_action($pdo, $userId, $email, 'resend_otp');

            $emailBody = build_otp_email_html($otp, $email);
            $sendResult = send_smtp_email($pdo, $email, "Kode Verifikasi Reset Password Baru — Ilmis Garden", $emailBody);

            if ($sendResult['success']) {
                $_SESSION['last_otp_request_time'] = time();
                $_SESSION['flash_msg'] = "Kode OTP baru telah berhasil dikirimkan ke email Anda!";
                header("Location: " . BASE_URL . "/verify_otp");
                exit;
            } else {
                $error = "Gagal mengirim email: " . htmlspecialchars($sendResult['error']);
            }
        }
    }
}

// Handle OTP Verification Submit
if ($_SERVER["REQUEST_METHOD"] === "POST" && (!isset($_POST['action']) || $_POST['action'] !== 'resend')) {
    $inputOtp = trim($_POST['otp'] ?? '');

    if (empty($inputOtp) || strlen($inputOtp) !== 6) {
        $error = "Silakan masukkan 6 digit kode verifikasi yang benar.";
    } elseif ($isExpired || !$tokenRecord) {
        $error = "Kode verifikasi telah kedaluwarsa. Silakan klik 'Kirim Ulang Kode'.";
    } elseif ($tokenRecord['failed_attempts'] >= 5) {
        // Invalidate Token
        $pdo->prepare("UPDATE password_reset_tokens SET used_at = NOW() WHERE id = ?")->execute([$tokenRecord['id']]);
        log_audit_action($pdo, $tokenRecord['user_id'], $email, 'otp_invalidated_max_attempts');
        $error = "Kode verifikasi ini telah dibatalkan karena salah dimasukkan 5 kali berturut-turut. Silakan minta kode baru.";
    } else {
        // Verify OTP hash
        if (password_verify($inputOtp, $tokenRecord['otp_hash'])) {
            // Success
            $_SESSION['otp_verified'] = true;
            $_SESSION['reset_token_id'] = $tokenRecord['id'];
            log_audit_action($pdo, $tokenRecord['user_id'], $email, 'verify_otp_success');

            header("Location: " . BASE_URL . "/reset_password");
            exit;
        } else {
            // Failed attempt
            $newAttempts = $tokenRecord['failed_attempts'] + 1;
            $pdo->prepare("UPDATE password_reset_tokens SET failed_attempts = ? WHERE id = ?")->execute([$newAttempts, $tokenRecord['id']]);
            log_audit_action($pdo, $tokenRecord['user_id'], $email, 'verify_otp_failed');

            if ($newAttempts >= 5) {
                $pdo->prepare("UPDATE password_reset_tokens SET used_at = NOW() WHERE id = ?")->execute([$tokenRecord['id']]);
                $error = "Kode verifikasi salah 5 kali berturut-turut. Kode ini telah dibatalkan demi keamanan. Silakan minta kode baru.";
            } else {
                $remainingAttempts = 5 - $newAttempts;
                $error = "Kode verifikasi tidak valid. Sisa percobaan: $remainingAttempts kali lagi.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verifikasi OTP | Ilmis Garden</title>
  <meta name="description" content="Verifikasi kode OTP reset password akun Anda.">
  <link rel="icon" href="img/F4F6F4-full.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/auth.css" />
  <style>
    .timer-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.4rem;
      padding: 0.4rem 0.9rem;
      background: rgba(112, 136, 113, 0.1);
      border-radius: 20px;
      font-size: 0.82rem;
      font-weight: 500;
      color: var(--sage-dark);
      margin-bottom: 1.2rem;
    }
    .timer-badge svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }
    .otp-input-field {
      width: 100%;
      padding: 0.85rem 1rem;
      font-size: 1.6rem;
      font-weight: 700;
      text-align: center;
      letter-spacing: 0.35em;
      font-family: monospace;
      border: 1.5px solid #cdd4cd;
      border-radius: var(--r-md);
      color: var(--charcoal);
      background: var(--white);
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .otp-input-field:focus {
      border-color: var(--sage);
      box-shadow: 0 0 0 3px rgba(112,136,113,0.12);
    }
    .resend-btn {
      background: none;
      border: none;
      color: var(--sage-dark);
      font-size: 0.83rem;
      font-weight: 500;
      cursor: pointer;
      border-bottom: 1px dashed var(--sage-dark);
      padding: 0;
      transition: color 0.2s;
    }
    .resend-btn:disabled {
      color: var(--muted);
      border-color: transparent;
      cursor: not-allowed;
    }
  </style>
</head>
<body>

  <div class="auth-layout">

    <!-- Left panel — decorative -->
    <div class="auth-panel">
      <a href="<?= BASE_URL ?>/" class="auth-panel__logo">
        <img src="img/F4F6F4-full.png" alt="Ilmisgarden" loading="lazy" decoding="async">
      </a>
      <div class="auth-panel__content">
        <p class="auth-panel__eyebrow">Flower Atelier · Bandung</p>
        <h2 class="auth-panel__title">Verifikasi<br>Keamanan<br><em>Ilmisgarden</em></h2>
        <p class="auth-panel__sub">Masukkan 6-digit kode OTP yang telah dikirimkan ke email Anda untuk melanjutkan proses pemulihan password.</p>
      </div>
      <div class="auth-panel__deco"></div>
    </div>

    <!-- Right panel — form -->
    <div class="auth-form-panel">
      <div class="auth-form-wrap">

        <div class="auth-form-header">
          <h1 class="auth-form-title">Kode Verifikasi</h1>
          <p class="auth-form-sub">Dikirim ke <strong><?= htmlspecialchars($email) ?></strong></p>
        </div>

        <?php if (!empty($success)): ?>
        <div class="auth-alert auth-alert--success">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          <?= htmlspecialchars($success) ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
        <div class="auth-alert auth-alert--error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <div style="text-align: center;">
          <div class="timer-badge">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            Kode berlaku selama: <span id="countdownDisplay" style="font-weight: 700;">--:--</span>
          </div>
        </div>

        <form action="" method="POST" class="auth-form" novalidate>

          <div class="form-field">
            <label for="otp" style="text-align: center; display: block;">Masukkan 6 Digit OTP</label>
            <div class="form-field__input-wrap">
              <input
                type="text"
                id="otp"
                name="otp"
                class="otp-input-field"
                maxlength="6"
                pattern="\d{6}"
                placeholder="000000"
                autocomplete="off"
                required
                autofocus
              />
            </div>
          </div>

          <button type="submit" class="auth-submit" <?= $isExpired ? 'disabled style="opacity:0.6; cursor:not-allowed;"' : '' ?>>
            Verifikasi Kode
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </button>

        </form>

        <div style="text-align: center; margin-bottom: 1.2rem;">
          <form method="post" action="" style="display: inline;">
            <input type="hidden" name="action" value="resend">
            <button type="submit" id="resendBtn" class="resend-btn" <?= ($resendCooldown > 0) ? 'disabled' : '' ?>>
              <span id="resendText">Kirim Ulang Kode <?= $resendCooldown > 0 ? "($resendCooldown s)" : '' ?></span>
            </button>
          </form>
        </div>

        <p class="auth-switch">
          Salah alamat email? <a href="<?= BASE_URL ?>/forgot_password">Ganti Email</a>
        </p>

        <a href="<?= BASE_URL ?>/signin" class="auth-back">
          <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali ke Sign In
        </a>

      </div>
    </div>

  </div>

<script>
// Live 10-Minute Expiration Countdown
(function() {
  let remaining = <?= (int)$remainingSeconds ?>;
  const display = document.getElementById('countdownDisplay');

  function updateTimer() {
    if (remaining <= 0) {
      display.innerText = 'Kedaluwarsa';
      display.style.color = '#dc2626';
      return;
    }
    const mins = Math.floor(remaining / 60);
    const secs = remaining % 60;
    display.innerText = String(mins).padStart(2, '0') + ':' + String(secs).padStart(2, '0');
    remaining--;
  }

  updateTimer();
  if (remaining > 0) {
    const timerInterval = setInterval(() => {
      updateTimer();
      if (remaining < 0) clearInterval(timerInterval);
    }, 1000);
  }
})();

// Live 60-Second Resend Cooldown
(function() {
  let cooldown = <?= (int)$resendCooldown ?>;
  const resendBtn = document.getElementById('resendBtn');
  const resendText = document.getElementById('resendText');

  if (cooldown > 0 && resendBtn && resendText) {
    resendBtn.disabled = true;

    const cooldownInterval = setInterval(() => {
      cooldown--;
      if (cooldown <= 0) {
        clearInterval(cooldownInterval);
        resendBtn.disabled = false;
        resendText.innerText = 'Kirim Ulang Kode';
      } else {
        resendText.innerText = `Kirim Ulang Kode (${cooldown} s)`;
      }
    }, 1000);
  }
})();
</script>
</body>
</html>
