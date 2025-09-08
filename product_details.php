<?php
session_start();
require 'conn/db.php';

// Pastikan ada ID produk di URL
if (!isset($_GET['id'])) {
    header("Location: signin.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($product['name']) ?> - Ilmisgarden</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .product-detail {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      margin: 2rem;
    }
    .product-detail img {
      width: 100%;
      border-radius: 10px;
      object-fit: cover;
    }
    .product-info h1 { margin: 0; }
    .product-price { font-size: 1.5rem; font-weight: bold; margin: 10px 0; }
    .buy-button {
      background: #5b7553;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 6px;
      margin-top: 10px;
    }
    .desc-box {
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 15px;
      border-radius: 8px;
      background: #f9f9f9;
    }
    .qty-box {
      margin-top: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
  </style>
</head>
<body>

<header class="header">
  <div class="logo">🌿 <span>ILMISGARDEN</span></div>
  <nav class="nav-links">
    <a href="index.php">Product</a>
    <a href="#">Catalog</a>
    <a href="#">Workshop</a>
    <a href="#">About Us</a>
  </nav>
  <div class="nav-icons">
    <a href="#">🔍</a>
    <a href="cart.php">🛒</a>
    <a href="#">👤</a>
  </div>
</header>

<main>
  <div class="product-detail">
    <div>
      <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="product-info">
      <h1><?= htmlspecialchars($product['name']) ?></h1>
      <span class="product-price">Rp. <?= number_format($product['price'], 0, ',', '.') ?></span>
      
<form method="POST" action="cart.php">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? 'guest1' ?>"> <!-- contoh user -->
    
    <label for="option">Size</label>
    <select id="option" name="option">
      <option value="small">Small</option>
      <option value="medium">Medium</option>
      <option value="large">Large</option>
    </select>

    <div class="qty-box">
      <label for="qty">Qty</label>
      <input type="number" id="qty" name="qty" value="1" min="1" style="width:70px;">
    </div>

    <button type="submit" name="add_to_cart" class="buy-button">Buy</button>
</form>


      <div class="desc-box">
        <h3>Description</h3>
        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      </div>
    </div>
  </div>
</main>

</body>
</html>
