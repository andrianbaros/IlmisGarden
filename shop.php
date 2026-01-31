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
  'Gift','Raya','Valentine','Wedding',
  'Sebulan Penuh Cinta','Imlek'
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

.filter-actions {
  margin-top:20px;
  display:flex;
  flex-direction:column;   /* ini bikin turun ke bawah */
  align-items:flex-start;
  gap:10px;
}
.price-row{
  display:flex;
  align-items:center;
  gap:10px;
}
  /* Default: desktop → menu disembunyikan */
#menu-btn {
  display: none;
}

/* Muncul hanya di layar kecil */
@media (max-width: 1366px) {
  #menu-btn {
    display: inline-block;
  }
}



</style>
</head>
<body>
<!-- Navbar Start -->
    <nav class="navbar">
<a href="index.php" class="navbar-logo">
  <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
</a>


      
<div class="navbar-nav">
  <a href="product.php">Product</a>
  <a href="shop.php" data-section="catalog" class="active">Catalog</a>
  <a href="about.php" data-section="about">About Us</a>
</div>

      <div class="navbar-extra">
        


        <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <a href="#" id="menu-btn">
  <i data-feather="menu"></i>
</a>


      </div>
    </nav>
    <!-- Navbar End -->


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

  <div class="price-row">
    <label>
      <input type="checkbox" name="price_filter"
        <?= $priceFilterActive ? 'checked' : '' ?>>
      Max Price
    </label>

    <?php if ($priceFilterActive): ?>
      <input type="number"
        name="max_price"
        min="0"
        step="1000"
        placeholder="Contoh: 500000"
        value="<?= htmlspecialchars($maxPrice ?? '') ?>">
    <?php endif; ?>
  </div>

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

  <a href="product_details.php?id=<?= $p['id'] ?>">
    <div class="product-image"
         style="background:url('<?= htmlspecialchars($img) ?>') center/cover no-repeat;"></div>
  </a>

  <h4><?= htmlspecialchars($p['name']) ?></h4>
  <p class="price">Rp <?= number_format($p['price'],0,',','.') ?></p>

  <a href="product_details.php?id=<?= $p['id'] ?>" class="buy-button">BUY</a>

</div>

  <?php endforeach; ?>
<?php endif; ?>
</section>

</div>
<section class="container" style="padding-bottom:110px;"></section>

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

feather.replace();

const navbarNav = document.querySelector(".navbar-nav");
const menuBtn = document.querySelector("#menu-btn");

menuBtn.addEventListener("click", function(e){
  e.preventDefault();
  e.stopPropagation();
  navbarNav.classList.toggle("active");
});

document.addEventListener("click", function (e) {
  if (!menuBtn.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

    </script>
    <!-- js -->
    <script src="js/script.js"></script>

</body>
</html>
