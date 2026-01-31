<?php
session_start();
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;

/* ===============================
   VALIDASI ID PRODUK
================================ */
if (!isset($_GET['id'])) {
    header("Location: shop.php");
    exit;
}

$id = (int)$_GET['id'];

/* ===============================
   GET PRODUCT
================================ */
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}

/* ===============================
   GET PRODUCT IMAGES
================================ */
$stmt = $pdo->prepare(
    "SELECT image FROM product_images
     WHERE product_id = ?
     ORDER BY is_primary DESC, id ASC"
);
$stmt->execute([$id]);
$images = $stmt->fetchAll();

if (!$images) {
    $images = [['image' => 'img/no-image.png']];
}

/* ===============================
   ADD TO CART
================================ */
if (isset($_POST['add_to_cart'])) {

    if (!$user_id) {
        header("Location: signin.php");
        exit;
    }

    $qty = max(1, (int)$_POST['qty']);

    $stmt = $pdo->prepare(
        "SELECT id_cart, qty FROM cart
         WHERE user_id = ? AND product_id = ?"
    );
    $stmt->execute([$user_id, $id]);
    $cart = $stmt->fetch();

    if ($cart) {
        $pdo->prepare(
            "UPDATE cart SET qty = qty + ?
             WHERE id_cart = ?"
        )->execute([$qty, $cart['id_cart']]);
    } else {
        $pdo->prepare(
            "INSERT INTO cart (user_id, product_id, qty)
             VALUES (?, ?, ?)"
        )->execute([$user_id, $id, $qty]);
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

<link rel="icon" href="img/F4F6F4-full.png">
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/detail.css">

<script src="https://unpkg.com/feather-icons"></script>

<style>
/* ===== GALLERY ===== */
.product-gallery img {
  border-radius: 12px;
}
.thumbs {
  display: flex;
  gap: 10px;
  margin-top: 12px;
  flex-wrap: wrap;
}
.thumbs img {
  width: 70px;
  height: 70px;
  object-fit: cover;
  cursor: pointer;
  opacity: .7;
  border-radius: 8px;
  border: 1px solid #ddd;
}
.thumbs img:hover {
  opacity: 1;
}

/* ===== PRODUCT DETAIL ===== */
.product-detail {
  max-width: 1100px;
  margin: 40px auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
}

.product-info h1 {
  font-size: 28px;
  margin-bottom: 10px;
}

.product-price {
  font-size: 22px;
  font-weight: bold;
  color: #4a6652;
  display: block;
  margin-bottom: 20px;
}

.qty-box {
  margin-bottom: 14px;
}

.qty-box input {
  padding: 6px;
}

.buy-button {
  background: #708871;
  color: #fff;
  border: none;
  padding: 12px 24px;
  border-radius: 8px;
  cursor: pointer;
}

.buy-button:hover {
  background: #4a6652;
}

.desc-box {
  margin-top: 28px;
}

.desc-box h3 {
  margin-bottom: 8px;
}

@media (max-width: 900px) {
  .product-detail {
    grid-template-columns: 1fr;
  }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="index.php" class="navbar-logo">
    <img src="img/F4F6F4-full.png" alt="Ilmisgarden" style="width:200px">
  </a>

  <div class="navbar-nav">
    <a href="shop.php">Product</a>
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
      Rp <?= number_format($product['price'], 0, ',', '.') ?>
    </span>

    <form method="POST">
      <div class="qty-box">
        <label>Qty</label><br>
        <input type="number" name="qty" value="1" min="1" style="width:70px">
      </div>

      <button type="submit" name="add_to_cart" class="buy-button">
        Add to Cart
      </button>
    </form>

    <div class="desc-box">
      <h3>Description</h3>
      <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
    </div>
  </div>

</div>

</main>
<footer
  style="
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#283128;
    color:#d9d9d9;
    text-align:center;
    padding:8px 10px;
    z-index:9999;
    font-size:13px;
  ">

  <!-- Address -->
  <div style="margin-bottom:10px;">
  <a
          href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7"
          target="_blank"
          style="color:#d9d9d9;"
        >
    Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135
  </a>  <br>
</div>

  <!-- Social Icons -->
  <div style="display:flex; justify-content:center; gap:28px; align-items:center;">

    <!-- WhatsApp -->
    <a href="https://wa.me/6285795077194"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/>
      </svg>
      <span>WA</span>
    </a>

    <!-- Instagram -->
    <a href="https://www.instagram.com/ilmisgarden/"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/>
      </svg>
      <span>IG</span>
    </a>

    <!-- TikTok -->
    <a href="https://www.tiktok.com/@ilmisgarden"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/>
      </svg>
      <span>TikTok</span>
    </a>

  </div>
</footer>


<script>
feather.replace();
</script>

</body>
</html>
