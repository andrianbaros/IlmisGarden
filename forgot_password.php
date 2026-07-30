<?php
require 'conn/db.php';
require 'includes/mailer.php';

// Auto-migrate forgot password & SMTP tables if missing
ensure_forgot_password_tables_exist($pdo);

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Silakan masukkan alamat email yang valid.";
    } else {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        
        // Rate limiting check (max 5 requests per 15 mins)
        $stmtRate = $pdo->prepare("
            SELECT COUNT(*) FROM password_reset_logs 
            WHERE (email = ? OR ip_address = ?) 
              AND action = 'request_otp' 
              AND created_at >= DATE_SUB(NOW(), INTERVAL 15 MINUTE)
        ");
        $stmtRate->execute([$email, $ip]);
        $requestCount = (int)$stmtRate->fetchColumn();

        if ($requestCount >= 5) {
            $error = "Terlalu banyak permintaan reset password. Silakan coba kembali 15 menit lagi.";
        } else {
            // Check if user exists
            $stmtUser = $pdo->prepare("SELECT id_user, email FROM users WHERE email = ? LIMIT 1");
            $stmtUser->execute([$email]);
            $user = $stmtUser->fetch();

            if (!$user) {
                $error = "Email tidak ditemukan.";
            } else {
                $userId = $user['id_user'];

                // Invalidate old OTPs for this email
                $pdo->prepare("UPDATE password_reset_tokens SET used_at = NOW() WHERE email = ? AND used_at IS NULL")->execute([$email]);

                // Generate 6-digit OTP
                $otp = str_pad(mt_rand(100000, 999999), 6, '0', STR_PAD_LEFT);
                $otp_hash = password_hash($otp, PASSWORD_DEFAULT);
                $expires_at = date('Y-m-d H:i:s', time() + 600); // 10 minutes

                // Store in database
                $stmtIns = $pdo->prepare("INSERT INTO password_reset_tokens (user_id, email, otp_hash, expires_at) VALUES (?, ?, ?, ?)");
                $stmtIns->execute([$userId, $email, $otp_hash, $expires_at]);

                // Log audit action
                log_audit_action($pdo, $userId, $email, 'request_otp');

                // Send Email via PHPMailer
                $emailBody = build_otp_email_html($otp, $email);
                $sendResult = send_smtp_email($pdo, $email, "Kode Verifikasi Reset Password — Ilmis Garden", $emailBody);

                if ($sendResult['success']) {
                    $_SESSION['reset_email'] = $email;
                    $_SESSION['last_otp_request_time'] = time();
                    $_SESSION['flash_msg'] = "Kode OTP telah dikirimkan ke email " . htmlspecialchars($email) . ". Silakan periksa inbox / spam Anda.";
                    header("Location: " . BASE_URL . "/verify_otp");
                    exit;
                } else {
                    $error = "Gagal mengirim email verifikasi: " . htmlspecialchars($sendResult['error']);
                }
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
  <title>Lupa Password | Ilmis Garden</title>
  <meta name="description" content="Reset password akun Ilmis Garden Anda.">
  <link rel="icon" href="img/F4F6F4-full.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/auth.css" />
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
        <h2 class="auth-panel__title">Pulihkan<br>akses akun<br><em>Ilmisgarden</em></h2>
        <p class="auth-panel__sub">Kami akan mengirimkan kode verifikasi 6-digit ke alamat email terdaftar Anda untuk mengatur ulang password.</p>
      </div>
      <div class="auth-panel__deco"></div>
    </div>

    <!-- Right panel — form -->
    <div class="auth-form-panel">
      <div class="auth-form-wrap">

        <div class="auth-form-header">
          <h1 class="auth-form-title">Lupa Password</h1>
          <p class="auth-form-sub">Masukkan email terdaftar Anda di bawah ini.</p>
        </div>

        <?php if (!empty($error)): ?>
        <div class="auth-alert auth-alert--error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form" novalidate>

          <div class="form-field">
            <label for="email">Alamat Email Terdaftar</label>
            <div class="form-field__input-wrap">
              <svg class="form-field__icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="contoh: baros@email.com"
                value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                required
                autocomplete="email"
                autofocus
              />
            </div>
          </div>

          <button type="submit" class="auth-submit">
            Kirim Kode Verifikasi
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </button>

        </form>

        <p class="auth-switch">
          Sudah ingat password? <a href="<?= BASE_URL ?>/signin">Masuk di sini</a>
        </p>

        <a href="<?= BASE_URL ?>/signin" class="auth-back">
          <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali ke Sign In
        </a>

      </div>
    </div>

  </div>

</body>
</html>
