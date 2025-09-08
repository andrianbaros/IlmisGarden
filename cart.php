<?php
session_start();
require 'conn/db.php';

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// ==================== Jika user baru klik BUY ====================
if (isset($_GET['buy']) && $_GET['buy'] == 1) {
    // Hapus semua cart user ini
    $del = $pdo->prepare("DELETE FROM cart WHERE user_id=?");
    $del->execute([$user_id]);

    // Redirect kembali biar cart kosong + langsung ke WA
    $msg = urlencode($_GET['msg'] ?? "");
    header("Location: https://wa.me/6285795077194?text=$msg");
    exit;
}

// ==================== Ambil cart dari DB ====================
$stmt = $pdo->prepare("SELECT c.id_cart AS cart_id, c.qty, p.id AS product_id, p.name, p.price, p.image 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.id 
                       WHERE c.user_id=?");
$stmt->execute([$user_id]);
$cart = $stmt->fetchAll();

// Hitung total
$totalItem = 0;
$subtotal  = 0;
foreach ($cart as $c) {
    $totalItem += $c['qty'];
    $subtotal  += $c['price'] * $c['qty'];
}

// ==================== Generate Pesan WhatsApp ====================
$message = "Halo, saya ingin membeli produk berikut:\n";
foreach ($cart as $c) {
    $message .= "- " . $c['name'] . " (x" . $c['qty'] . ") : Rp. " . number_format($c['price'] * $c['qty'], 0, ',', '.') . "\n";
}
$message .= "\nTotal Item: $totalItem\n";
$message .= "Subtotal: Rp. " . number_format($subtotal, 0, ',', '.');

$waText = urlencode($message);

// Link untuk BUY (trigger hapus cart + redirect WA)
$buyLink = "cart.php?buy=1&msg=" . $waText;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart - Ilmisgarden</title>
  <link rel="stylesheet" href="css/cart.css">
</head>
<body>

<div class="cart-container">
  <!-- Kiri: daftar produk -->
  <div class="cart-list">
    <?php if (empty($cart)): ?>
      <p>Keranjang kosong. <a href="shop.php">Belanja sekarang</a></p>
    <?php else: ?>
      <?php foreach ($cart as $c): ?>
        <div class="cart-item">
          <div class="cart-left">
            <input type="checkbox" checked>
            <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
            <span class="cart-name"><?= htmlspecialchars($c['name']) ?></span>
          </div>
          <div class="cart-right">
            <span class="cart-price">Rp. <?= number_format($c['price'], 0, ',', '.') ?></span>
            <form method="post" action="remove_cart.php" style="display:inline;">
              <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
              <button class="delete-btn">🗑</button>
            </form>
            <div class="qty-control">
              <form method="post" action="update_cart.php">
                <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
                <button name="action" value="minus">-</button>
                <input type="text" value="<?= $c['qty'] ?>" readonly>
                <button name="action" value="plus">+</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Kanan: ringkasan pesanan -->
  <div class="order-summary">
    <h3>Order</h3>
    <?php foreach ($cart as $c): ?>
      <div class="summary-item">
        <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
        <span><?= htmlspecialchars($c['name']) ?></span>
        <span>Rp. <?= number_format($c['price'], 0, ',', '.') ?></span>
      </div>
    <?php endforeach; ?>
    <div class="summary-footer">
      <div class="row">
        <span>Total Item</span><span><?= $totalItem ?></span>
      </div>
      <div class="row">
        <span>Subtotal</span><span>Rp. <?= number_format($subtotal, 0, ',', '.') ?></span>
      </div>
      <?php if (!empty($cart)): ?>
        <a href="<?= $buyLink ?>" X"><button class="checkout-btn">BUY</button></a>
      <?php endif; ?>
    </div>
  </div>
</div>

</body>
</html>
