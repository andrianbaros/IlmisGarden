<?php
session_start();
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;

/* =============================
   FILTER OPTIONS
============================= */
$catalogs = [
  'Add-on','Artificial Flowers','Basket','Best Seller','Blooming Canvas',
  'Bouquet','Box','Centerpiece','Dried Flowers','Money Bouquet',
  'Standing Flowers','Vase','Wedding Bouquet'
];

$flowers = [
  'Dianthus','Gerbera','Gompie','Hydrangea','Lilly',
  'Lisianthus','Pom-pom','Rose','Sunflower'
];

$occasions = [
  'Anniversary','Birthday','Christmas','Graduation','Grand Opening',
  'Gift','Raya','Valentine','Wedding'
];

/* =============================
   GET FILTER
============================= */
$catalogFilter  = $_GET['catalog'] ?? [];
$flowerFilter   = $_GET['flower'] ?? [];
$occasionFilter = $_GET['occasion'] ?? [];

$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = ($priceFilterActive && isset($_GET['max_price']))
              ? (int)$_GET['max_price']
              : null;

/* =============================
   QUERY
============================= */
$sql = "
  SELECT p.*, pi.image AS main_image
  FROM products p
  LEFT JOIN product_images pi
    ON p.id = pi.product_id AND pi.is_primary = 1
  WHERE 1=1
";
$params = [];

if ($catalogFilter) {
  $sql .= " AND p.catalog IN (" . str_repeat('?,', count($catalogFilter)-1) . "?)";
  $params = array_merge($params, $catalogFilter);
}
if ($flowerFilter) {
  $sql .= " AND p.flower IN (" . str_repeat('?,', count($flowerFilter)-1) . "?)";
  $params = array_merge($params, $flowerFilter);
}
if ($occasionFilter) {
  $sql .= " AND p.occasion IN (" . str_repeat('?,', count($occasionFilter)-1) . "?)";
  $params = array_merge($params, $occasionFilter);
}
if ($priceFilterActive && $maxPrice) {
  $sql .= " AND p.price <= ?";
  $params[] = $maxPrice;
}

$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ilmisgarden</title>

<link rel="icon" href="img/F4F6F4-full.png">
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="style.css">

<script src="https://unpkg.com/feather-icons"></script>

<style>
/* ===== FILTER BAR ===== */
.filter-bar {
  background:#fff;
  padding:20px;
  border-radius:14px;
  box-shadow:0 6px 20px rgba(0,0,0,.06);
  margin-bottom:30px;
}

.filter-grid {
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:20px;
}

.filter-group h5 {
  margin-bottom:10px;
  font-size:14px;
}

.filter-group label {
  display:block;
  font-size:13px;
  margin-bottom:6px;
}

.filter-actions {
  margin-top:16px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

@media(max-width:900px){
  .filter-grid{
    grid-template-columns:1fr;
  }
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="index.php" class="navbar-logo">
    <img src="img/F4F6F4-full.png" style="width:200px;">
  </a>

  <div class="navbar-nav">
    <a href="shop.php" class="active">Product</a>
    <a href="index.php#catalog">Catalog</a>
    <a href="index.php#about">About Us</a>
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

<div class="container">

<!-- FILTER BAR -->
<form method="GET" class="filter-bar">

  <div class="filter-grid">

    <div class="filter-group">
      <h5>By Catalog</h5>
      <?php foreach ($catalogs as $c): ?>
        <label>
          <input type="checkbox" name="catalog[]" value="<?= $c ?>"
            <?= in_array($c,$catalogFilter)?'checked':'' ?>>
          <?= $c ?>
        </label>
      <?php endforeach; ?>
    </div>

    <div class="filter-group">
      <h5>By Flowers</h5>
      <?php foreach ($flowers as $f): ?>
        <label>
          <input type="checkbox" name="flower[]" value="<?= $f ?>"
            <?= in_array($f,$flowerFilter)?'checked':'' ?>>
          <?= $f ?>
        </label>
      <?php endforeach; ?>
    </div>

    <div class="filter-group">
      <h5>By Occasion</h5>
      <?php foreach ($occasions as $o): ?>
        <label>
          <input type="checkbox" name="occasion[]" value="<?= $o ?>"
            <?= in_array($o,$occasionFilter)?'checked':'' ?>>
          <?= $o ?>
        </label>
      <?php endforeach; ?>
    </div>

  </div>

  <div class="filter-actions">
    <label>
      <input type="checkbox" name="price_filter" <?= $priceFilterActive?'checked':'' ?>>
      Max Price
    </label>

    <?php if ($priceFilterActive): ?>
      <input type="range" name="max_price" min="0" max="3000000"
             value="<?= $maxPrice ?>">
    <?php endif; ?>

    <button type="submit">Apply Filter</button>
  </div>

</form>

<!-- PRODUCTS -->
<section class="products">
<?php if (!$products): ?>
  <p>Tidak ada produk.</p>
<?php else: ?>
  <?php foreach ($products as $p): ?>
    <?php $img = $p['main_image'] ?: 'img/no-image.png'; ?>
    <div class="product-card">
      <div class="product-image"
           style="background:url('<?= htmlspecialchars($img) ?>') center/cover no-repeat;"></div>
      <h4><?= htmlspecialchars($p['name']) ?></h4>
      <p class="price">Rp <?= number_format($p['price'],0,',','.') ?></p>
      <a href="product_details.php?id=<?= $p['id'] ?>" class="buy-button">BUY</a>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
</section>

</div>

<script>feather.replace();</script>
</body>
</html>
