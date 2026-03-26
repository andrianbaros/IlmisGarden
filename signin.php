<?php
session_start();
require 'conn/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = trim($_POST['identifier']);
    $password   = trim($_POST['password']);

    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    }

    $stmt->execute([$identifier]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id_user']   = $user['id_user'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['email']     = $user['email'];
        $_SESSION['flash_msg'] = "Login berhasil, Selamat datang {$user['username']}!";
        header("Location: shop.php");
        exit;
    } else {
        $error = "Username/Email atau Password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/auth.css" />
</head>
<body>

  <div class="auth-layout">

    <!-- Left panel — decorative -->
    <div class="auth-panel">
      <a href="index.php" class="auth-panel__logo">
        <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
      </a>
      <div class="auth-panel__content">
        <p class="auth-panel__eyebrow">Flower Atelier · Bandung</p>
        <h2 class="auth-panel__title">Selamat datang<br>kembali di<br><em>Ilmisgarden</em></h2>
        <p class="auth-panel__sub">Masuk untuk melanjutkan perjalanan merangkai keindahan bersamamu.</p>
      </div>
      <div class="auth-panel__deco"></div>
    </div>

    <!-- Right panel — form -->
    <div class="auth-form-panel">
      <div class="auth-form-wrap">

        <div class="auth-form-header">
          <h1 class="auth-form-title">Sign In</h1>
          <p class="auth-form-sub">Masuk ke akunmu untuk mulai berbelanja.</p>
        </div>

        <?php if (!empty($error)): ?>
        <div class="auth-alert auth-alert--error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form" novalidate>

          <div class="form-field">
            <label for="identifier">Email atau Username</label>
            <div class="form-field__input-wrap">
              <svg class="form-field__icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <input
                type="text"
                id="identifier"
                name="identifier"
                placeholder="email@contoh.com atau username"
                value="<?= htmlspecialchars($_POST['identifier'] ?? '') ?>"
                required
                autocomplete="username"
              />
            </div>
          </div>

          <div class="form-field">
            <label for="password">Password</label>
            <div class="form-field__input-wrap">
              <svg class="form-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
              />
              <button type="button" class="form-field__eye" id="togglePassword" aria-label="Tampilkan password">
                <svg id="eyeIcon" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
          </div>

          <button type="submit" class="auth-submit">
            Masuk
            <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </button>

        </form>

        <p class="auth-switch">
          Belum punya akun? <a href="signup.php">Daftar sekarang</a>
        </p>

        <a href="index.php" class="auth-back">
          <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
          Kembali ke Beranda
        </a>

      </div>
    </div>

  </div>

  <script>
    const toggle = document.getElementById('togglePassword');
    const pwInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    toggle.addEventListener('click', () => {
      const isHidden = pwInput.type === 'password';
      pwInput.type = isHidden ? 'text' : 'password';
      eyeIcon.innerHTML = isHidden
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    });
  </script>

</body>
</html>