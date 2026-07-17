<?php
require 'conn/db.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: " . BASE_URL . "/signin");
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

        $discount = 0;
        $campaign = null;
        if (isset($_SESSION['campaign_discount']) && $_SESSION['campaign_discount'] > 0) {
            $discount = (int)round($subtotal * $_SESSION['campaign_discount']);
            $campaign = $_SESSION['campaign_source'] ?? null;
        }
        $final_subtotal = $subtotal - $discount;

        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, total_items, subtotal, discount, campaign, status) VALUES (?, ?, ?, ?, ?, 'belum diproses')");
            $stmt->execute([$user_id, $totalItem, $final_subtotal, $discount, $campaign]);
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

$discount = 0;
if (isset($_SESSION['campaign_discount']) && $_SESSION['campaign_discount'] > 0) {
    $discount = (int)round($subtotal * $_SESSION['campaign_discount']);
}
$final_subtotal = $subtotal - $discount;

/* ── WA message ── */
$message  = "Halo, saya ingin membeli produk berikut:\n";
foreach ($cart as $c) {
    $message .= "- {$c['name']} (x{$c['qty']}) : Rp. " . number_format($c['price'] * $c['qty'], 0, ',', '.') . "\n";
}
if ($discount > 0) {
    $message .= "\nSubtotal: Rp. " . number_format($subtotal, 0, ',', '.');
    $message .= "\nDiskon Campaign (" . htmlspecialchars($_SESSION['campaign_source'] ?? '') . "): -Rp. " . number_format($discount, 0, ',', '.');
    $message .= "\nTotal Pembayaran: Rp. " . number_format($final_subtotal, 0, ',', '.');
} else {
    $message .= "\nTotal Item: $totalItem\nSubtotal: Rp. " . number_format($subtotal, 0, ',', '.');
}
$waText   = urlencode($message);
$buyLink  = "cart?buy=1&msg=" . $waText;
?>
<!DOCTYPE html>
<html lang="id">
<head>

  <title>Shopping Cart | Ilmis Garden</title>
  <meta name="description" content="Keranjang belanja Anda di Ilmis Garden.">
  <link rel="canonical" href="https://ilmisgarden.com/cart">
  
  <meta property="og:title" content="Shopping Cart | Ilmis Garden">
  <meta property="og:description" content="Keranjang belanja Anda di Ilmis Garden.">
  <meta property="og:url" content="https://ilmisgarden.com/cart">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">
  
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Shopping Cart | Ilmis Garden">
  <meta name="twitter:description" content="Keranjang belanja Anda di Ilmis Garden.">
  <meta name="twitter:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">

  
  
  
  
  <!-- Open Graph / Facebook -->
  
  
  
  
  

  <!-- Twitter -->
  
  
  
  
  
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/cart.css" />
</head>
<body>



<?php include 'includes/navbar.php'; ?>


  <!-- ─── BREADCRUMB ────────────────────────────────────── -->
  <div class="breadcrumb">
    <a href="<?= BASE_URL ?>/">Home</a>
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
          <a href="<?= BASE_URL ?>/shop" class="btn-primary">Mulai Belanja →</a>
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
              <form method="post" action="<?= BASE_URL ?>/update_cart" class="qty-form">
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
            <form method="post" action="<?= BASE_URL ?>/remove_cart" class="cart-item__remove">
              <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
              <button type="submit" class="cart-remove-btn" aria-label="Hapus">
                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
              </button>
            </form>

          </div>
          <?php endforeach; ?>
        </div>

        <div class="cart-list__footer">
          <a href="<?= BASE_URL ?>/shop" class="cart-continue">← Lanjut Belanja</a>
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
        <?php if ($discount > 0): ?>
          <div class="cart-summary__total-row">
            <span>Subtotal</span>
            <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
          </div>
          <div class="cart-summary__total-row" style="color: #c99a5c; font-weight: 500;">
            <span>Diskon Campaign (10%)</span>
            <span>-Rp <?= number_format($discount, 0, ',', '.') ?></span>
          </div>
          <div class="cart-summary__total-row cart-summary__total-row--grand">
            <span>Total Bayar</span>
            <span>Rp <?= number_format($final_subtotal, 0, ',', '.') ?></span>
          </div>
        <?php else: ?>
          <div class="cart-summary__total-row cart-summary__total-row--grand">
            <span>Subtotal</span>
            <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
          </div>
        <?php endif; ?>
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
      <div class="footer__logo"><img src="img/F4F6F4-full.png" alt="Ilmis Garden Logo" loading="lazy" decoding="async" /></div>
            <div class="footer__socials">
        <a href="https://wa.me/6285795077194" target="_blank" class="footer__social" aria-label="WhatsApp">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.012 0C5.398 0 .019 5.396.019 12.01c0 2.111.549 4.185 1.597 6.009L0 24l6.135-1.61c1.764.96 3.754 1.47 5.867 1.47 6.614 0 11.993-5.387 11.993-12.01C24.005 5.396 18.626 0 12.012 0zm6.735 16.947c-.276.779-1.396 1.439-2.256 1.548-.756.096-1.74.156-2.82-.192-4.632-1.488-7.596-6.192-7.824-6.492-.228-.3-1.896-2.52-1.896-4.812 0-2.292 1.188-3.42 1.62-3.876.372-.396.984-.576 1.572-.576.192 0 .36.012.516.024.456.024.684.06.984.78.372.9 1.272 3.108 1.38 3.324.108.216.18.468.036.756-.144.288-.3.468-.588.804-.288.336-.612.756-.876 1.02-.276.288-.564.6-.24 1.152.324.552 1.44 2.376 3.096 3.852 2.124 1.896 3.912 2.484 4.464 2.712.552.228.876.18 1.2-.192.42-.48 1.8-2.1 2.28-2.82.18-.276.36-.228.612-.132.252.096 1.608.756 2.952 1.428.468.228.78.336.888.528.12.192.12 1.104-.156 1.884z"/></svg>
        </a>
        <a href="https://www.instagram.com/ilmisgarden/" target="_blank" class="footer__social" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
        </a>
        <a href="https://www.tiktok.com/@ilmisgarden" target="_blank" class="footer__social" aria-label="TikTok">
          <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.05 1.62 4.2 1.12 1.27 2.7 2.06 4.38 2.27v4.11a8.88 8.88 0 0 1-5-1.73v7.35a7.58 7.58 0 0 1-7.58 7.58 7.59 7.59 0 0 1-7.58-7.59 7.57 7.57 0 0 1 7.58-7.58c.29 0 .59.02.88.07V13a3.61 3.61 0 0 0-.88-.11 3.69 3.69 0 0 0-3.69 3.69 3.69 3.69 0 0 0 3.69 3.69 3.69 3.69 0 0 0 3.69-3.69V0z"/></svg>
        </a>
      </div>
    </div>
    <p class="footer__addr"><a href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7" target="_blank">Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135</a></p>
    <p class="footer__copy">© 2025 Ilmisgarden. All rights reserved.</p>
  </footer>

  <script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 60));

    
  </script>
  <script src="js/script.js"></script>
</body>
</html>