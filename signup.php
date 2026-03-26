<?php
include 'conn/db.php';

$errors  = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email']    ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm']  ?? '';
    $dob      = $_POST['dob']      ?? '';
    $address  = trim($_POST['address'] ?? '');

    // Validasi
    if ($password !== $confirm) {
        $errors[] = "Password dan konfirmasi password tidak sama.";
    }
    if (!preg_match('/^[0-9]{10,15}$/', $whatsapp)) {
        $errors[] = "Nomor WhatsApp tidak valid (10–15 digit angka).";
    }

    if (empty($errors)) {
        // Cek duplikat
        $check = $pdo->prepare("SELECT id_user FROM users WHERE email = ? OR whatsapp = ?");
        $check->execute([$email, $whatsapp]);
        if ($check->rowCount() > 0) {
            $errors[] = "Email atau No. WhatsApp sudah terdaftar.";
        }
    }

    if (empty($errors)) {
        // Generate ID
        $stmt = $pdo->query("SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1");
        $last = $stmt->fetch();
        $new_id = $last
            ? "IL" . str_pad(intval(substr($last['id_user'], 2)) + 1, 3, "0", STR_PAD_LEFT)
            : "IL001";

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("
            INSERT INTO users (id_user, username, email, whatsapp, password, date_of_birth, address)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");

        if ($stmt->execute([$new_id, $username, $email, $whatsapp, $hashed, $dob, $address])) {
            $success = true;
        } else {
            $errors[] = "Registrasi gagal. Silakan coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/auth.css" />
</head>
<body>

  <div class="auth-layout">

    <!-- ─── LEFT PANEL ─────────────────────────────────── -->
    <div class="auth-panel">
      <a href="index.php" class="auth-panel__logo">
        <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
      </a>
      <div class="auth-panel__content">
        <p class="auth-panel__eyebrow">Flower Atelier · Bandung</p>
        <h2 class="auth-panel__title">Bergabung<br>bersama<br><em>Ilmisgarden</em></h2>
        <p class="auth-panel__sub">Daftarkan dirimu dan mulai temukan rangkaian bunga yang sempurna untuk setiap momenmu.</p>
      </div>
      <div class="auth-panel__deco"></div>
    </div>

    <!-- ─── RIGHT PANEL ─────────────────────────────────── -->
    <div class="auth-form-panel">
      <div class="auth-form-wrap">

        <?php if ($success): ?>

          <!-- Success state -->
          <div class="auth-success-state">
            <div class="auth-success-icon">
              <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <h1 class="auth-form-title">Registrasi Berhasil!</h1>
            <p class="auth-form-sub" style="margin-bottom:2rem;">Akunmu sudah siap. Silakan masuk untuk mulai berbelanja.</p>
            <a href="signin.php" class="auth-submit" style="text-decoration:none; display:flex;">
              Masuk Sekarang
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
          </div>

        <?php else: ?>

          <div class="auth-form-header">
            <h1 class="auth-form-title">Buat Akun</h1>
            <p class="auth-form-sub">Isi data di bawah untuk mendaftar.</p>
          </div>

          <!-- Error alerts -->
          <?php if (!empty($errors)): ?>
          <div class="auth-alert auth-alert--error" style="flex-direction:column; align-items:flex-start; gap:0.3rem;">
            <div style="display:flex; align-items:center; gap:0.5rem; font-weight:500;">
              <svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              Perbaiki kesalahan berikut:
            </div>
            <?php foreach ($errors as $e): ?>
              <p style="margin-left:1.4rem; font-size:0.8rem;">• <?= htmlspecialchars($e) ?></p>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <form method="POST" class="auth-form" novalidate>

            <!-- Row 1: Username -->
            <div class="form-field">
              <label for="username">Username</label>
              <div class="form-field__input-wrap">
                <svg class="form-field__icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <input type="text" id="username" name="username"
                  placeholder="username kamu"
                  value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                  required autocomplete="username" />
              </div>
            </div>

            <!-- Row 2: Email -->
            <div class="form-field">
              <label for="email">Email</label>
              <div class="form-field__input-wrap">
                <svg class="form-field__icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <input type="email" id="email" name="email"
                  placeholder="email@contoh.com"
                  value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                  required autocomplete="email" />
              </div>
            </div>

            <!-- Row 3: WhatsApp -->
            <div class="form-field">
              <label for="whatsapp">No. WhatsApp</label>
              <div class="form-field__input-wrap">
                <svg class="form-field__icon" viewBox="0 0 24 24"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
                <input type="text" id="whatsapp" name="whatsapp"
                  placeholder="08xxxxxxxxxx"
                  pattern="^[0-9]{10,15}$"
                  value="<?= htmlspecialchars($_POST['whatsapp'] ?? '') ?>"
                  required />
              </div>
            </div>

            <!-- Row 4: Password + Confirm (side by side) -->
            <div class="form-row">
              <div class="form-field">
                <label for="password">Password</label>
                <div class="form-field__input-wrap">
                  <svg class="form-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                  <input type="password" id="password" name="password"
                    placeholder="Password"
                    required autocomplete="new-password" />
                  <button type="button" class="form-field__eye" onclick="togglePw('password', this)" aria-label="Tampilkan">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  </button>
                </div>
              </div>

              <div class="form-field">
                <label for="confirm">Konfirmasi</label>
                <div class="form-field__input-wrap">
                  <svg class="form-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                  <input type="password" id="confirm" name="confirm"
                    placeholder="Ulangi password"
                    required autocomplete="new-password" />
                  <button type="button" class="form-field__eye" onclick="togglePw('confirm', this)" aria-label="Tampilkan">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Row 5: Date of Birth -->
            <div class="form-field">
              <label for="dob">Tanggal Lahir</label>
              <div class="form-field__input-wrap">
                <svg class="form-field__icon" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <input type="date" id="dob" name="dob"
                  value="<?= htmlspecialchars($_POST['dob'] ?? '') ?>"
                  required />
              </div>
            </div>

            <!-- Row 6: Address (full width) -->
            <div class="form-field form-field--full">
              <label for="address">Alamat Lengkap</label>
              <div class="form-field__textarea-wrap">
                <svg class="form-field__icon form-field__icon--top" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                <textarea id="address" name="address"
                  placeholder="Jl. Contoh No.1, Kota, Provinsi..."
                  rows="3"
                  required><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
              </div>
            </div>

            <button type="submit" class="auth-submit">
              Daftar Sekarang
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>

          </form>

          <p class="auth-switch">
            Sudah punya akun? <a href="signin.php">Masuk di sini</a>
          </p>

          <a href="index.php" class="auth-back">
            <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Kembali ke Beranda
          </a>

        <?php endif; ?>

      </div>
    </div>

  </div>

  <script>
    function togglePw(fieldId, btn) {
      const input = document.getElementById(fieldId);
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      btn.querySelector('svg').innerHTML = isHidden
        ? '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>'
        : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }

    /* Live password match indicator */
    const pwField  = document.getElementById('password');
    const cfField  = document.getElementById('confirm');
    if (pwField && cfField) {
      function checkMatch() {
        const match = pwField.value === cfField.value && cfField.value !== '';
        cfField.style.borderColor = cfField.value === ''
          ? '' : (match ? 'var(--sage)' : '#ef4444');
      }
      pwField.addEventListener('input', checkMatch);
      cfField.addEventListener('input', checkMatch);
    }
  </script>

</body>
</html>