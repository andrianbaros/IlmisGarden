<?php
session_start();
require 'conn/db.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// Ambil data user untuk sidebar
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE id_user=?");
$stmtUser->execute([$user_id]);
$user = $stmtUser->fetch();

// Ambil transaksi beserta item detail
$stmt = $pdo->prepare("
    SELECT t.*, GROUP_CONCAT(p.name, ' (x', ti.qty, ')' SEPARATOR ', ') AS items
    FROM transactions t
    JOIN transaction_items ti ON t.id_transaction = ti.transaction_id
    JOIN products p ON ti.product_id = p.id
    WHERE t.user_id = ?
    GROUP BY t.id_transaction
    ORDER BY t.created_at DESC
");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Transaksi — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/profile.css" />
  <link rel="stylesheet" href="css/transaction.css" />
</head>
<body>

<!-- MOBILE MENU -->
<nav class="mobile-menu" id="mobileMenu">
  <button class="mobile-menu__close" id="mobileClose">✕</button>
  <a href="product.php">Product</a>
  <a href="shop.php">Catalog</a>
  <a href="about.php">About Us</a>
</nav>

<!-- NAVBAR -->
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
    <a href="cart.php" class="nav__icon" aria-label="Cart">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
    </a>

    <a href="profile.php" class="nav__icon" aria-label="Profile">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </a>

    <!-- WRAPPER PENTING -->
    <div class="nav__menu-wrapper">
      <button class="nav__hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>

      <!-- PINDAH MOBILE MENU KE SINI -->
      <nav class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu__close" id="mobileClose">✕</button>
        <a href="product.php">Product</a>
        <a href="shop.php">Catalog</a>
        <a href="about.php">About Us</a>
      </nav>
    </div>

  </div>
</header>

  <!-- ─── LAYOUT ────────────────────────────────────────── -->
  <div class="profile-layout">

    <!-- ─── SIDEBAR (shared with profile.php) ────────────── -->
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
        <a href="profile.php" class="profile-nav__link">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Profil Saya
        </a>
        <a href="transaction.php" class="profile-nav__link active">
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

    <!-- ─── MAIN CONTENT ──────────────────────────────────── -->
    <main class="profile-main">

      <div class="profile-main__header">
        <h1 class="profile-main__title">Riwayat <em>Transaksi</em></h1>
        <p class="profile-main__sub"><?= count($transactions) ?> transaksi ditemukan.</p>
      </div>

      <?php if (empty($transactions)): ?>

        <!-- Empty state -->
        <div class="txn-empty">
          <div class="txn-empty__icon">
            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          </div>
          <h3>Belum ada transaksi</h3>
          <p>Mulai belanja dan riwayat transaksimu akan muncul di sini.</p>
          <a href="shop.php" class="btn-primary">Mulai Belanja →</a>
        </div>

      <?php else: ?>

        <div class="txn-list">
          <?php foreach ($transactions as $t):
           $status = strtolower($t['status']);

// Status Class
if (in_array($status, ['paid', 'success', 'selesai'])) {
  $statusClass = 'txn-status--success';
} elseif (in_array($status, ['pending', 'menunggu'])) {
  $statusClass = 'txn-status--pending';
} elseif (in_array($status, ['cancelled', 'dibatalkan'])) {
  $statusClass = 'txn-status--cancelled';
} else {
  $statusClass = 'txn-status--default';
}

// Status Label
if ($status === 'paid') {
  $statusLabel = 'Dibayar';
} elseif ($status === 'success' || $status === 'selesai') {
  $statusLabel = 'Selesai';
} elseif ($status === 'pending' || $status === 'menunggu') {
  $statusLabel = 'Menunggu';
} elseif ($status === 'cancelled' || $status === 'dibatalkan') {
  $statusLabel = 'Dibatalkan';
} else {
  $statusLabel = ucfirst($t['status']);
}
          ?>
          <div class="txn-card">
            <div class="txn-card__head">
              <div class="txn-card__id">
                <span class="txn-card__id-label">Order</span>
                <span class="txn-card__id-value">#<?= htmlspecialchars($t['id_transaction']) ?></span>
              </div>
              <span class="txn-status <?= $statusClass ?>"><?= $statusLabel ?></span>
            </div>

            <div class="txn-card__body">
              <div class="txn-card__items">
                <p class="txn-card__items-label">Produk</p>
                <p class="txn-card__items-value"><?= htmlspecialchars($t['items']) ?></p>
              </div>

              <div class="txn-card__meta">
                <div class="txn-meta-row">
                  <span>Total Item</span>
                  <span><?= $t['total_items'] ?> item</span>
                </div>
                <div class="txn-meta-row txn-meta-row--total">
                  <span>Subtotal</span>
                  <span>Rp <?= number_format($t['subtotal'], 0, ',', '.') ?></span>
                </div>
              </div>
            </div>

            <div class="txn-card__foot">
              <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <?= date('d M Y, H:i', strtotime($t['created_at'])) ?> WIB
            </div>
          </div>
          <?php endforeach; ?>
        </div>

      <?php endif; ?>
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
  </script>
  <script src="js/script.js"></script>
</body>
</html>