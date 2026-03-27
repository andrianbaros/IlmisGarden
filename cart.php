<?php
session_start();
require 'conn/db.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

/* ── Buy: create transaction & redirect to WA ── */
if (isset($_GET['buy']) && $_GET['buy'] == 1) {
    $stmt = $pdo->prepare("SELECT c.qty, p.id AS product_id, p.price 
                           FROM cart c JOIN products p ON c.product_id = p.id 
                           WHERE c.user_id=?");
    $stmt->execute([$user_id]);
    $items = $stmt->fetchAll();

    if (!empty($items)) {
        $totalItem = 0; $subtotal = 0;
        foreach ($items as $i) { $totalItem += $i['qty']; $subtotal += $i['price'] * $i['qty']; }

        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, total_items, subtotal, status) VALUES (?, ?, ?, 'belum diproses')");
            $stmt->execute([$user_id, $totalItem, $subtotal]);
            $transactionId = $pdo->lastInsertId();

            $stmtItem = $pdo->prepare("INSERT INTO transaction_items (transaction_id, product_id, qty, price) VALUES (?, ?, ?, ?)");
            foreach ($items as $i) { $stmtItem->execute([$transactionId, $i['product_id'], $i['qty'], $i['price']]); }

            $pdo->prepare("DELETE FROM cart WHERE user_id=?")->execute([$user_id]);
            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            die("Error: " . $e->getMessage());
        }
    }

    $msg = urlencode($_GET['msg'] ?? "");
    header("Location: https://wa.me/6285795077194?text=$msg");
    exit;
}

/* ── Fetch cart ── */
$stmt = $pdo->prepare("
    SELECT c.id_cart AS cart_id, c.qty, p.id AS product_id, p.name, p.price, pi.image
    FROM cart c
    JOIN products p ON c.product_id = p.id
    LEFT JOIN product_images pi ON pi.product_id = p.id AND pi.is_primary = 1
    WHERE c.user_id = ?
");
$stmt->execute([$user_id]);
$cart = $stmt->fetchAll();

$totalItem = 0; $subtotal = 0;
foreach ($cart as $c) { $totalItem += $c['qty']; $subtotal += $c['price'] * $c['qty']; }

/* ── WA message ── */
$message  = "Halo, saya ingin membeli produk berikut:\n";
foreach ($cart as $c) {
    $message .= "- {$c['name']} (x{$c['qty']}) : Rp. " . number_format($c['price'] * $c['qty'], 0, ',', '.') . "\n";
}
$message .= "\nTotal Item: $totalItem\nSubtotal: Rp. " . number_format($subtotal, 0, ',', '.');
$waText   = urlencode($message);
$buyLink  = "cart.php?buy=1&msg=" . $waText;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keranjang — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/cart.css" />
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
    <li><a href="product.php" >Product</a></li>
    <li><a href="shop.php">Catalog</a></li>
    <li><a href="about.php">About Us</a></li>
  </ul>

  <div class="nav__actions">
    <a href="cart.php" class="nav__icon" aria-label="Cart" class="active">
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


  <!-- ─── BREADCRUMB ────────────────────────────────────── -->
  <div class="breadcrumb">
    <a href="index.php">Home</a>
    <span>›</span>
    <span>Keranjang</span>
  </div>

  <!-- ─── CART LAYOUT ───────────────────────────────────── -->
  <div class="cart-layout">

    <!-- ─── ITEM LIST ──────────────────────────────────── -->
    <section class="cart-list">
      <h1 class="cart-title">Keranjang <em>Belanja</em></h1>

      <?php if (empty($cart)): ?>

        <div class="cart-empty">
          <div class="cart-empty__icon">
            <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          </div>
          <h3>Keranjangmu masih kosong</h3>
          <p>Temukan rangkaian bunga untukmu dan tambahkan ke keranjang.</p>
          <a href="shop.php" class="btn-primary">Mulai Belanja →</a>
        </div>

      <?php else: ?>

        <div class="cart-items">
          <?php foreach ($cart as $c): ?>
          <div class="cart-item" id="cart-item-<?= $c['cart_id'] ?>">

            <!-- Image -->
            <div class="cart-item__img">
              <img src="<?= htmlspecialchars($c['image'] ?? 'img/no-image.png') ?>"
                   alt="<?= htmlspecialchars($c['name']) ?>" loading="lazy" />
            </div>

            <!-- Info -->
            <div class="cart-item__info">
              <h3 class="cart-item__name"><?= htmlspecialchars($c['name']) ?></h3>
              <p class="cart-item__unit-price">Rp <?= number_format($c['price'], 0, ',', '.') ?> / item</p>
            </div>

            <!-- Qty stepper -->
            <div class="cart-item__qty">
              <form method="post" action="update_cart.php" class="qty-form">
                <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
                <button type="submit" name="action" value="minus" class="qty-btn">−</button>
                <span class="qty-value"><?= $c['qty'] ?></span>
                <button type="submit" name="action" value="plus" class="qty-btn">+</button>
              </form>
            </div>

            <!-- Subtotal per item -->
            <div class="cart-item__subtotal">
              Rp <?= number_format($c['price'] * $c['qty'], 0, ',', '.') ?>
            </div>

            <!-- Remove -->
            <form method="post" action="remove_cart.php" class="cart-item__remove">
              <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
              <button type="submit" class="cart-remove-btn" aria-label="Hapus">
                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
              </button>
            </form>

          </div>
          <?php endforeach; ?>
        </div>

        <div class="cart-list__footer">
          <a href="shop.php" class="cart-continue">← Lanjut Belanja</a>
        </div>

      <?php endif; ?>
    </section>

    <!-- ─── ORDER SUMMARY ─────────────────────────────── -->
    <?php if (!empty($cart)): ?>
    <aside class="cart-summary">
      <h2 class="cart-summary__title">Ringkasan <em>Pesanan</em></h2>

      <div class="cart-summary__items">
        <?php foreach ($cart as $c): ?>
        <div class="cart-summary__row">
          <div class="cart-summary__row-img">
            <img src="<?= htmlspecialchars($c['image'] ?? 'img/no-image.png') ?>"
                 alt="<?= htmlspecialchars($c['name']) ?>" />
          </div>
          <div class="cart-summary__row-info">
            <p class="cart-summary__row-name"><?= htmlspecialchars($c['name']) ?></p>
            <p class="cart-summary__row-qty">x<?= $c['qty'] ?></p>
          </div>
          <p class="cart-summary__row-price">Rp <?= number_format($c['price'] * $c['qty'], 0, ',', '.') ?></p>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="cart-summary__totals">
        <div class="cart-summary__total-row">
          <span>Total Item</span>
          <span><?= $totalItem ?> item</span>
        </div>
        <div class="cart-summary__total-row cart-summary__total-row--grand">
          <span>Subtotal</span>
          <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
        </div>
      </div>

      <a href="<?= $buyLink ?>" class="cart-checkout-btn">
        <svg viewBox="0 0 24 24"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        Pesan via WhatsApp
      </a>

      <p class="cart-summary__note">
        Pesananmu akan dikonfirmasi melalui WhatsApp oleh tim kami.
      </p>
    </aside>
    <?php endif; ?>

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