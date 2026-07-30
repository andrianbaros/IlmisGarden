<?php
require 'conn/db.php';
require 'includes/mailer.php';

// Auto-migrate forgot password & SMTP tables if missing
ensure_forgot_password_tables_exist($pdo);

if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true || !isset($_SESSION['reset_email'])) {
    header("Location: " . BASE_URL . "/forgot_password");
    exit;
}

$email = $_SESSION['reset_email'];
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password     = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (strlen($new_password) < 8) {
        $error = "Password minimal terdiri dari 8 karakter.";
    } elseif (!preg_match('/[A-Z]/', $new_password)) {
        $error = "Password wajib mengandung setidaknya 1 huruf besar (kapital).";
    } elseif (!preg_match('/[a-z]/', $new_password)) {
        $error = "Password wajib mengandung setidaknya 1 huruf kecil.";
    } elseif (!preg_match('/[0-9]/', $new_password)) {
        $error = "Password wajib mengandung setidaknya 1 angka.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Konfirmasi password baru tidak cocok.";
    } else {
        // Fetch User ID
        $stmtUser = $pdo->prepare("SELECT id_user FROM users WHERE email = ? LIMIT 1");
        $stmtUser->execute([$email]);
        $user = $stmtUser->fetch();
        $userId = $user['id_user'] ?? 0;

        // Hash new password
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password in users table
        $stmtUp = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmtUp->execute([$hashed, $email]);

        // Mark OTP token as used
        if (isset($_SESSION['reset_token_id'])) {
            $pdo->prepare("UPDATE password_reset_tokens SET used_at = NOW() WHERE id = ?")->execute([$_SESSION['reset_token_id']]);
        }
        $pdo->prepare("UPDATE password_reset_tokens SET used_at = NOW() WHERE email = ? AND used_at IS NULL")->execute([$email]);

        // Log audit action
        log_audit_action($pdo, $userId, $email, 'reset_password_success');

        // Session Cleanup
        unset(
            $_SESSION['reset_email'],
            $_SESSION['otp_verified'],
            $_SESSION['reset_token_id'],
            $_SESSION['last_otp_request_time']
        );

        $_SESSION['flash_msg'] = "Password Anda berhasil diubah! Silakan masuk menggunakan password baru Anda.";
        header("Location: " . BASE_URL . "/signin");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reset Password | Ilmis Garden</title>
  <meta name="description" content="Buat password baru untuk akun Ilmis Garden Anda.">
  <link rel="icon" href="img/F4F6F4-full.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/auth.css" />
  <style>
    .strength-meter {
      height: 4px;
      background: #e4e0d8;
      border-radius: 4px;
      margin-top: 6px;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    .strength-bar {
      height: 100%;
      width: 0%;
      transition: width 0.3s ease, background-color 0.3s ease;
    }
    .strength-text {
      font-size: 0.76rem;
      margin-top: 4px;
      font-weight: 500;
      color: var(--muted);
    }
    .rule-box {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 6px;
      margin-top: 8px;
      padding: 8px 10px;
      background: rgba(112, 136, 113, 0.06);
      border-radius: var(--r-sm);
    }
    .rule-item {
      font-size: 0.74rem;
      color: var(--muted);
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .rule-item svg {
      width: 12px;
      height: 12px;
      stroke: currentColor;
      fill: none;
      stroke-width: 2;
    }
    .rule-item.valid {
      color: var(--sage-dark);
      font-weight: 500;
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
        <h2 class="auth-panel__title">Buat<br>Password<br><em>Baru Anda</em></h2>
        <p class="auth-panel__sub">Pastikan password baru Anda kuat dan mudah diingat agar keamanan akun Anda selalu terjaga.</p>
      </div>
      <div class="auth-panel__deco"></div>
    </div>

    <!-- Right panel — form -->
    <div class="auth-form-panel">
      <div class="auth-form-wrap">

        <div class="auth-form-header">
          <h1 class="auth-form-title">Reset Password</h1>
          <p class="auth-form-sub">Untuk akun <strong><?= htmlspecialchars($email) ?></strong></p>
        </div>

        <?php if (!empty($error)): ?>
        <div class="auth-alert auth-alert--error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form" novalidate>

          <div class="form-field">
            <label for="new_password">Password Baru</label>
            <div class="form-field__input-wrap">
              <svg class="form-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input
                type="password"
                id="new_password"
                name="new_password"
                placeholder="Masukkan password baru"
                required
                autocomplete="new-password"
                autofocus
              />
              <button type="button" class="form-field__eye" onclick="togglePass('new_password', this)" aria-label="Lihat Password">
                <svg class="eyeIcon" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>

            <div class="strength-meter">
              <div id="strengthBar" class="strength-bar"></div>
            </div>
            <div id="strengthText" class="strength-text">Kekuatan Password: -</div>

            <div class="rule-box">
              <div class="rule-item" id="ruleLen"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg> Min. 8 Karakter</div>
              <div class="rule-item" id="ruleUpper"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg> Min. 1 Huruf Besar</div>
              <div class="rule-item" id="ruleLower"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg> Min. 1 Huruf Kecil</div>
              <div class="rule-item" id="ruleNum"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/></svg> Min. 1 Angka</div>
            </div>
          </div>

          <div class="form-field">
            <label for="confirm_password">Konfirmasi Password Baru</label>
            <div class="form-field__input-wrap">
              <svg class="form-field__icon" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              <input
                type="password"
                id="confirm_password"
                name="confirm_password"
                placeholder="Ulangi password baru"
                required
                autocomplete="new-password"
              />
              <button type="button" class="form-field__eye" onclick="togglePass('confirm_password', this)" aria-label="Lihat Password">
                <svg class="eyeIcon" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
          </div>

          <button type="submit" class="auth-submit">
            Simpan Password Baru
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </button>

        </form>

        <a href="<?= BASE_URL ?>/signin" class="auth-back">
          <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali ke Sign In
        </a>

      </div>
    </div>

  </div>

<script>
function togglePass(inputId, btn) {
  const input = document.getElementById(inputId);
  const svg = btn.querySelector('svg');
  const isHidden = input.type === 'password';
  input.type = isHidden ? 'text' : 'password';
  svg.innerHTML = isHidden
    ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
    : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
}

// Realtime Password Strength & Rule Validator
const passInput = document.getElementById('new_password');
const strengthBar = document.getElementById('strengthBar');
const strengthText = document.getElementById('strengthText');

const ruleLen = document.getElementById('ruleLen');
const ruleUpper = document.getElementById('ruleUpper');
const ruleLower = document.getElementById('ruleLower');
const ruleNum = document.getElementById('ruleNum');

passInput.addEventListener('input', function() {
  const val = passInput.value;
  let score = 0;

  const hasLen = val.length >= 8;
  const hasUpper = /[A-Z]/.test(val);
  const hasLower = /[a-z]/.test(val);
  const hasNum = /[0-9]/.test(val);

  updateRule(ruleLen, hasLen);
  updateRule(ruleUpper, hasUpper);
  updateRule(ruleLower, hasLower);
  updateRule(ruleNum, hasNum);

  if (hasLen) score++;
  if (hasUpper) score++;
  if (hasLower) score++;
  if (hasNum) score++;

  if (val.length === 0) {
    strengthBar.style.width = '0%';
    strengthText.innerText = 'Kekuatan Password: -';
    strengthText.style.color = 'var(--muted)';
  } else if (score <= 2) {
    strengthBar.style.width = '33%';
    strengthBar.style.backgroundColor = '#ef4444';
    strengthText.innerText = 'Kekuatan Password: Lemah';
    strengthText.style.color = '#ef4444';
  } else if (score === 3) {
    strengthBar.style.width = '66%';
    strengthBar.style.backgroundColor = '#f59e0b';
    strengthText.innerText = 'Kekuatan Password: Sedang';
    strengthText.style.color = '#f59e0b';
  } else {
    strengthBar.style.width = '100%';
    strengthBar.style.backgroundColor = '#16a34a';
    strengthText.innerText = 'Kekuatan Password: Sangat Kuat';
    strengthText.style.color = '#16a34a';
  }
});

function updateRule(el, isValid) {
  const svg = el.querySelector('svg');
  if (isValid) {
    el.classList.add('valid');
    svg.innerHTML = '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>';
  } else {
    el.classList.remove('valid');
    svg.innerHTML = '<circle cx="12" cy="12" r="10"/>';
  }
}
</script>
</body>
</html>
