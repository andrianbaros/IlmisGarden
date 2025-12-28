<?php
session_start();
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;

// cek id produk
if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit;
}

$id = (int)$_GET['id'];

// ambil produk
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}

// ambil semua gambar produk
$imgStmt = $pdo->prepare(
    "SELECT image FROM product_images
     WHERE product_id = ?
     ORDER BY is_primary DESC"
);
$imgStmt->execute([$id]);
$images = $imgStmt->fetchAll();

if (!$images) {
    // fallback kalau belum ada image
    $images = [['image' => 'img/no-image.png']];
}

// tambah ke cart
if (isset($_POST['add_to_cart'])) {
    if (!$user_id) {
        header("Location: signin.php");
        exit;
    }

    $qty = max(1, (int)$_POST['qty']);

    $stmt = $pdo->prepare(
        "SELECT * FROM cart WHERE user_id=? AND product_id=?"
    );
    $stmt->execute([$user_id, $id]);
    $cartItem = $stmt->fetch();

    if ($cartItem) {
        $stmt = $pdo->prepare(
            "UPDATE cart SET qty = qty + ? WHERE id_cart=?"
        );
        $stmt->execute([$qty, $cartItem['id_cart']]);
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO cart (user_id, product_id, qty)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$user_id, $id, $qty]);
    }

    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($product['name']) ?> | Ilmisgarden</title>

<link rel="icon" href="img/F4F6F4-full.png" />
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/detail.css">
<script src="https://unpkg.com/feather-icons"></script>

<style>
.product-gallery img {
  border-radius: 10px;
}
.thumbs {
  display: flex;
  gap: 10px;
  margin-top: 12px;
}
.thumbs img {
  width: 80px;
  cursor: pointer;
  opacity: .7;
}
.thumbs img:hover {
  opacity: 1;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="index.php" class="navbar-logo">
    <img src="img/F4F6F4-full.png" style="width:200px">
  </a>
  <div class="navbar-nav">
    <a href="product.php">Product</a>
    <a href="index.php#catalog">Catalog</a>
    <a href="index.php#about">About</a>
  </div>
  <div class="navbar-extra">
    <?php if ($user_id): ?>
      <span>Hello, <?= htmlspecialchars($_SESSION['username']) ?></span>
      <a href="logout.php"><i data-feather="log-out"></i></a>
    <?php else: ?>
      <a href="signin.php"><i data-feather="log-in"></i></a>
    <?php endif; ?>
    <a href="cart.php"><i data-feather="shopping-cart"></i></a>
  </div>
</nav>

<!-- CONTENT -->
<main>
<div class="product-detail">

  <!-- GALLERY -->
  <div class="product-gallery">
    <img id="mainImage"
         src="<?= htmlspecialchars($images[0]['image']) ?>"
         style="width:100%;max-width:420px">

    <div class="thumbs">
      <?php foreach ($images as $img): ?>
        <img src="<?= htmlspecialchars($img['image']) ?>"
             onclick="document.getElementById('mainImage').src=this.src">
      <?php endforeach; ?>
    </div>
  </div>

  <!-- INFO -->
  <div class="product-info">
    <h1><?= htmlspecialchars($product['name']) ?></h1>
    <span class="product-price">
      Rp <?= number_format($product['price'],0,',','.') ?>
    </span>

    <form method="POST">
      <div class="qty-box">
        <label>Qty</label>
        <input type="number" name="qty" value="1" min="1" style="width:70px">
      </div>
      <button type="submit" name="add_to_cart" class="buy-button">
        Buy
      </button>
    </form>

    <div class="desc-box">
      <h3>Description</h3>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
    </div>
  </div>

</div>
</main>

<script>
feather.replace();
</script>

</body>
</html>
