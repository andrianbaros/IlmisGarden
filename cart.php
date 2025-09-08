<?php
session_start();
require 'conn/db.php';

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// ==================== Tambah produk ke cart ====================
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $qty        = $_POST['qty'] ?? 1;

    // Cek apakah produk sudah ada di cart
    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
    $stmt->execute([$user_id, $product_id]);
    $cartItem = $stmt->fetch();

    if ($cartItem) {
        // Update qty
        $stmt = $pdo->prepare("UPDATE cart SET qty = qty + ? WHERE id=?");
        $stmt->execute([$qty, $cartItem['id']]);
    } else {
        // Insert baru
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, qty) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $qty]);
    }
}

// ==================== Ambil cart dari DB ====================
$stmt = $pdo->prepare("SELECT c.*, p.name, p.price, p.image 
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
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart - Ilmisgarden</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .cart-container { display: flex; gap: 2rem; margin: 2rem; }
    .cart-list { flex: 2; }
    .cart-item {
      display: flex; align-items: center; justify-content: space-between;
      border: 1px solid #ccc; padding: 10px; border-radius: 8px; margin-bottom: 10px;
    }
    .cart-item img { width: 80px; height: 80px; object-fit: cover; border-radius: 6px; margin-right: 10px; }
    .cart-info { flex: 1; display: flex; align-items: center; gap: 10px; }
    .order-summary {
      flex: 1; border: 2px solid #5b7553; border-radius: 8px; padding: 20px; height: fit-content;
    }
    .order-summary h3 { margin-top: 0; }
    .buy-button {
      background: #5b7553; color: #fff; border: none;
      padding: 12px; width: 100%; cursor: pointer; border-radius: 6px; margin-top: 10px;
    }
    .qty-input {
      width: 50px; text-align: center; padding: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Keranjang Belanja</h2>

    <?php if (empty($cart)): ?>
      <p>Keranjang masih kosong.</p>
      <a href="shop.php">Belanja Sekarang</a>
    <?php else: ?>
      <div class="cart-items">
        <?php foreach ($cart as $c): ?>
          <div class="cart-item">
            <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>" width="80">
            <div class="cart-info">
              <h4><?= htmlspecialchars($c['name']) ?></h4>
              <p>Rp. <?= number_format($c['price'], 0, ',', '.') ?> x <?= $c['qty'] ?></p>
            </div>
            <div class="cart-total">
              Rp. <?= number_format($c['price'] * $c['qty'], 0, ',', '.') ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="order-summary">
        <h3>Ringkasan Pesanan</h3>
        <?php foreach ($cart as $c): ?>
          <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
            <span><?= htmlspecialchars($c['name']) ?> (x<?= $c['qty'] ?>)</span>
            <span>Rp. <?= number_format($c['price'] * $c['qty'], 0, ',', '.') ?></span>
          </div>
        <?php endforeach; ?>
        <hr>
        <p><strong>Total Item:</strong> <?= $totalItem ?></p>
        <p><strong>Subtotal:</strong> Rp. <?= number_format($subtotal, 0, ',', '.') ?></p>
        <button onclick="alert('Fitur checkout belum dibuat')">Checkout</button>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>