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
  $likes = [];
  foreach ($catalogFilter as $c) {
    $likes[] = "FIND_IN_SET(LOWER(REPLACE(?,' ','')), LOWER(REPLACE(p.catalog,' ','')))";
    $params[] = strtolower($c);
  }
  $sql .= " AND p.catalog IS NOT NULL AND (" . implode(" OR ", $likes) . ")";
}


if ($flowerFilter) {
  $likes = [];
  foreach ($flowerFilter as $f) {
    $likes[] = "FIND_IN_SET(LOWER(REPLACE(?,' ','')), LOWER(REPLACE(p.flower,' ','')))";
    $params[] = strtolower($f);
  }
  $sql .= " AND p.flower IS NOT NULL AND (" . implode(" OR ", $likes) . ")";
}

if ($occasionFilter) {
  $likes = [];
  foreach ($occasionFilter as $o) {
    $likes[] = "FIND_IN_SET(LOWER(REPLACE(?,' ','')), LOWER(REPLACE(p.occasion,' ','')))";
    $params[] = strtolower($o);
  }
  $sql .= " AND p.occasion IS NOT NULL AND (" . implode(" OR ", $likes) . ")";
}



/* =============================
   PRICE
============================= */
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

/* ===== ACTIVE NAVBAR FIX (GLOBAL) ===== */
.navbar .navbar-nav a.active {
  color: #1c221c !important;
  font-weight: 700;
}

.navbar .navbar-nav a.active::after {
  content: "";
  display: block;
  padding-bottom: 0.5rem;
  border-bottom: 0.1rem solid #1c221c;
  transform: scaleX(0.6) !important;
}

.navbar .navbar-nav a.active:hover {
  color: #1c221c;
}

/* ===== ACTIVE MOBILE OVERRIDE ===== */
@media (max-width: 1366px) {
  .navbar .navbar-nav a.active {
    color: #1c221c !important;
  }

  .navbar .navbar-nav a.active::after {
    transform: scaleX(0.6) !important;
  }
}



</style>
</head>
<body>

    <nav class="navbar">

      <a href="index.php" class="navbar-logo">
  <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
</a>
      <div class="navbar-nav">
        <a href="product.php" >Product</a>
        <a href="shop.php"  class="active">Catalog</a>
        <a href="index.php#about">About Us</a>
      </div>
      <div class="navbar-extra">
      <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>
      </div>
    </nav>


<div class="container">

<!-- FILTER BAR -->
<form method="GET" class="filter-bar">

<div class="filter-accordion-wrapper">

  <!-- BY CATALOG -->
  <div class="accordion-item">
    <button type="button" class="accordion-header">
      By Catalog
      <span class="icon">▸</span>
    </button>
    <div class="accordion-body">
      <?php foreach ($catalogs as $c): ?>
        <label>
          <input type="checkbox" name="catalog[]" value="<?= $c ?>"
            <?= in_array($c,$catalogFilter)?'checked':'' ?>>
          <?= $c ?>
        </label>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- BY FLOWERS -->
  <div class="accordion-item">
    <button type="button" class="accordion-header">
      By Flowers
      <span class="icon">▸</span>
    </button>
    <div class="accordion-body">
      <?php foreach ($flowers as $f): ?>
        <label>
          <input type="checkbox" name="flower[]" value="<?= $f ?>"
            <?= in_array($f,$flowerFilter)?'checked':'' ?>>
          <?= $f ?>
        </label>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- BY OCCASION -->
  <div class="accordion-item">
    <button type="button" class="accordion-header">
      By Occasion
      <span class="icon">▸</span>
    </button>
    <div class="accordion-body">
      <?php foreach ($occasions as $o): ?>
        <label>
          <input type="checkbox" name="occasion[]" value="<?= $o ?>"
            <?= in_array($o,$occasionFilter)?'checked':'' ?>>
          <?= $o ?>
        </label>
      <?php endforeach; ?>
    </div>
  </div>

</div>


<div class="filter-actions">
  <label>
    <input type="checkbox" name="price_filter" <?= $priceFilterActive ? 'checked' : '' ?>>
    Max Price
  </label>

  <?php if ($priceFilterActive): ?>
    <input
      type="number"
      name="max_price"
      min="0"
      step="1000"
      placeholder="Contoh: 500000"
      value="<?= htmlspecialchars($maxPrice ?? '') ?>"
    >
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

<script>
  document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', () => {
      const item = header.parentElement;
      const body = item.querySelector('.accordion-body');

      document.querySelectorAll('.accordion-item').forEach(i => {
        if (i !== item) {
          i.classList.remove('active');
          i.querySelector('.accordion-body').style.maxHeight = null;
        }
      });

      if (item.classList.contains('active')) {
        item.classList.remove('active');
        body.style.maxHeight = null;
      } else {
        item.classList.add('active');
        body.style.maxHeight = body.scrollHeight + "px";
      }
    });
  });
</script>

<script>
  feather.replace();
</script>

</body>
</html>
