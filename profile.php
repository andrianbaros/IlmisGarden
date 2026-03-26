<?php
session_start();
require 'conn/db.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id_user=?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$msg     = '';
$msgType = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['username']);
    $email   = trim($_POST['email']);
    $address = trim($_POST['address']);

    if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
        if (password_verify($_POST['current_password'], $user['password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $newPass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET username=?, email=?, address=?, password=? WHERE id_user=?");
                $stmt->execute([$name, $email, $address, $newPass, $user_id]);
                $msg = "Profil dan password berhasil diperbarui.";
            } else {
                $msg = "Konfirmasi password tidak cocok.";
                $msgType = 'error';
            }
        } else {
            $msg = "Password lama salah.";
            $msgType = 'error';
        }
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username=?, email=?, address=? WHERE id_user=?");
        $stmt->execute([$name, $email, $address, $user_id]);
        $msg = "Profil berhasil diperbarui.";
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user=?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    $_SESSION['username'] = $user['username'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profil — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/profile.css" />
</head>
<body>

  <!-- ─── MOBILE MENU ──────────────────────────────────── -->
  <nav class="mobile-menu" id="mobileMenu">
    <button class="mobile-menu__close" id="mobileClose">✕</button>
    <a href="product.php">Product</a>
    <a href="shop.php">Catalog</a>
    <a href="about.php">About Us</a>
  </nav>

  <!-- ─── NAVBAR ───────────────────────────────────────── -->
  <header class="nav" id="navbar">
    <a href="index.php" class="nav__logo">
      <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
    </a>
    <ul class="nav__links">
      <li><a href="product.php">Product</a></li>
      <li><a href="shop.php">Catalog</a></li>
      <li><a href="about.php">About Us</a></li>
    </ul>
    <div class="nav__actions">
      <?php if (isset($_SESSION['id_user'])): ?>
        <span class="nav__username">
          <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
        </span>
        <a href="logout.php" class="nav__icon" aria-label="Logout">
          <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        </a>
      <?php else: ?>
        <a href="signin.php" class="nav__icon" aria-label="Sign In">
          <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
        </a>
      <?php endif; ?>
      <a href="cart.php" class="nav__icon" aria-label="Cart">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      </a>
      <button class="nav__hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <!-- ─── PROFILE LAYOUT ────────────────────────────────── -->
  <div class="profile-layout">

    <!-- Sidebar -->
    <aside class="profile-sidebar">
      <div class="profile-sidebar__avatar">
        <div class="profile-avatar">
          <?= strtoupper(substr($user['username'], 0, 1)) ?>
        </div>
        <div class="profile-sidebar__info">
          <p class="profile-sidebar__name"><?= htmlspecialchars($user['username']) ?></p>
          <p class="profile-sidebar__email"><?= htmlspecialchars($user['email']) ?></p>
        </div>
      </div>

      <nav class="profile-nav">
        <a href="profile.php" class="profile-nav__link active">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Profil Saya
        </a>
        <a href="transaction.php" class="profile-nav__link">
          <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          Transaksi
        </a>
        <a href="#" class="profile-nav__link profile-nav__link--disabled">
          <svg viewBox="0 0 24 24"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
          Kupon
          <span class="profile-nav__badge">Soon</span>
        </a>
        <a href="#" class="profile-nav__link profile-nav__link--disabled">
          <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          Membership
          <span class="profile-nav__badge">Soon</span>
        </a>
        <a href="logout.php" class="profile-nav__link profile-nav__link--logout">
          <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          Keluar
        </a>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="profile-main">

      <div class="profile-main__header">
        <h1 class="profile-main__title">Profil <em>Saya</em></h1>
        <p class="profile-main__sub">Kelola informasi akun dan keamananmu.</p>
      </div>

      <?php if (!empty($msg)): ?>
      <div class="profile-alert profile-alert--<?= $msgType ?>">
        <svg viewBox="0 0 24 24">
          <?php if ($msgType === 'success'): ?>
            <polyline points="20 6 9 17 4 12"/>
          <?php else: ?>
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          <?php endif; ?>
        </svg>
        <?= htmlspecialchars($msg) ?>
      </div>
      <?php endif; ?>

      <form method="POST" class="profile-form" novalidate>

        <!-- Info Section -->
        <div class="profile-form__section">
          <h2 class="profile-form__section-title">Informasi Dasar</h2>

          <div class="profile-field">
            <label for="username">Nama</label>
            <div class="profile-field__wrap">
              <svg class="profile-field__icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <input type="text" id="username" name="username"
                value="<?= htmlspecialchars($user['username']) ?>"
                required autocomplete="username" />
            </div>
          </div>

          <div class="profile-field">
            <label for="email">Email</label>
            <div class="profile-field__wrap">
              <svg class="profile-field__icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <input type="email" id="email" name="email"
                value="<?= htmlspecialchars($user['email']) ?>"
                required autocomplete="email" />
            </div>
          </div>

          <div class="profile-field">
            <label for="address">Alamat</label>
            <div class="profile-field__textarea-wrap">
              <svg class="profile-field__icon profile-field__icon--top" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <textarea id="address" name="address" rows="3"
                placeholder="Jl. Contoh No.1, Kota..."><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
            </div>
          </div>
        </div>

        <!-- Password Section -->
        <div class="profile-form__section">
          <h2 class="profile-form__section-title">Ganti Password</h2>
          <p class="profile-form__section-note">Kosongkan jika tidak ingin mengganti password.</p>

          <div class="profile-field">
            <label for="current_password">Password Saat Ini</label>
            <div class="profile-field__wrap">
              <svg class="profile-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              <input type="password" id="current_password" name="current_password"
                placeholder="Masukkan password saat ini"
                autocomplete="current-password" />
              <button type="button" class="profile-field__eye" onclick="togglePw('current_password')" aria-label="Tampilkan">
                <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
              </button>
            </div>
          </div>

          <div class="profile-fields-row">
            <div class="profile-field">
              <label for="new_password">Password Baru</label>
              <div class="profile-field__wrap">
                <svg class="profile-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input type="password" id="new_password" name="new_password"
                  placeholder="Password baru"
                  autocomplete="new-password" />
                <button type="button" class="profile-field__eye" onclick="togglePw('new_password')" aria-label="Tampilkan">
                  <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
              </div>
            </div>

            <div class="profile-field">
              <label for="confirm_password">Konfirmasi Password</label>
              <div class="profile-field__wrap">
                <svg class="profile-field__icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input type="password" id="confirm_password" name="confirm_password"
                  placeholder="Ulangi password baru"
                  autocomplete="new-password" />
                <button type="button" class="profile-field__eye" onclick="togglePw('confirm_password')" aria-label="Tampilkan">
                  <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Actions -->
        <div class="profile-form__actions">
          <button type="reset" class="profile-btn profile-btn--cancel">Batalkan</button>
          <button type="submit" class="profile-btn profile-btn--save">
            Simpan Perubahan
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          </button>
        </div>

      </form>
    </main>
  </div>

  <!-- ─── FOOTER ───────────────────────────────────────── -->
  <footer class="footer">
    <div class="footer__top">
      <div class="footer__logo"><img src="img/F4F6F4-full.png" alt="Ilmisgarden" /></div>
      <div class="footer__socials">
        <a href="https://wa.me/6285795077194" target="_blank" class="footer__social" aria-label="WhatsApp">
          <svg viewBox="0 0 24 24"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        </a>
        <a href="https://www.instagram.com/ilmisgarden/" target="_blank" class="footer__social" aria-label="Instagram">
          <svg viewBox="0 0 24 24"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/></svg>
        </a>
        <a href="https://www.tiktok.com/@ilmisgarden" target="_blank" class="footer__social" aria-label="TikTok">
          <svg viewBox="0 0 24 24"><path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/></svg>
        </a>
      </div>
    </div>
    <p class="footer__addr"><a href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7" target="_blank">Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135</a></p>
    <p class="footer__copy">© 2025 Ilmisgarden. All rights reserved.</p>
  </footer>

  <script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 60));

    const hamburger   = document.getElementById('hamburger');
    const mobileMenu  = document.getElementById('mobileMenu');
    const mobileClose = document.getElementById('mobileClose');
    hamburger.addEventListener('click', () => mobileMenu.classList.add('open'));
    mobileClose.addEventListener('click', () => mobileMenu.classList.remove('open'));
    mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileMenu.classList.remove('open')));

    function togglePw(id) {
      const input = document.getElementById(id);
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
    }

    /* Live confirm password match */
    const newPw = document.getElementById('new_password');
    const cfPw  = document.getElementById('confirm_password');
    function checkMatch() {
      if (!cfPw.value) { cfPw.style.borderColor = ''; return; }
      cfPw.style.borderColor = (newPw.value === cfPw.value) ? 'var(--sage)' : '#ef4444';
    }
    newPw.addEventListener('input', checkMatch);
    cfPw.addEventListener('input', checkMatch);
  </script>
  <script src="js/script.js"></script>
</body>
</html>