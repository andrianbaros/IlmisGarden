<?php
session_start();
require 'conn/db.php';

// Data dummy keywords (nanti bisa ambil dari DB kalau perlu)
$keywords = [
    ['name' => 'Indoor Plant'],
    ['name' => 'Outdoor Plant'],
    ['name' => 'Cactus'],
];

$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = $priceFilterActive && isset($_GET['max_price']) ? (int)$_GET['max_price'] : null;

if ($priceFilterActive && $maxPrice !== null) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE price <= ? ORDER BY id DESC");
    $stmt->execute([$maxPrice]);
    $products = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ilmisgarden</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo">
      🌿 <span>ILMISGARDEN</span>
    </div>
    <nav class="nav-links">
      <a href="#">Product</a>
      <a href="#">Catalog</a>
      <a href="#">Workshop</a>
      <a href="#">About Us</a>
    </nav>
    <div class="nav-icons">
      <a href="#">🔍</a>
      <a href="#">🛒</a>
      <a href="#">👤</a>
    </div>
  </header>

  <!-- MAIN -->
  <main class="container">
    <!-- SIDEBAR -->
    <aside class="sidebar">
      <div class="filter-box">
        <h2>Keywords</h2>
        <?php foreach ($keywords as $kw): ?>
          <div class="chip"><?= htmlspecialchars($kw['name']) ?></div>
        <?php endforeach; ?>
      </div>

      <div class="filter-section">
        <label><input type="checkbox" checked> Label</label>
        <small>Description</small>
        <label><input type="checkbox" checked> Label</label>
        <small>Description</small>
        <label><input type="checkbox" checked> Label</label>
        <small>Description</small>
      </div>

      <form method="GET" id="filter-form">
        <div class="filter-section">
          <h3>
            <label>
              <input type="checkbox" id="price-filter-toggle" name="price_filter" value="1" <?= isset($_GET['price_filter']) ? 'checked' : '' ?> />
              Price
            </label>
          </h3>
          <div id="price-filter-content" style="display: <?= isset($_GET['price_filter']) ? 'block' : 'none' ?>;">
            <input type="range" min="0" max="100000" value="<?= isset($_GET['max_price']) ? (int)$_GET['max_price'] : 50000 ?>" id="price-range" name="max_price" />
            <div class="price-range">
              <span>Rp.0</span>
              <span>Rp.0-100K</span>
            </div>
          </div>
        </div>
        <button type="submit" style="margin-top: 12px;">Filter</button>
      </form>

      <div class="filter-section">
        <h3>Color</h3>
        <label><input type="checkbox" checked> Green</label>
        <label><input type="checkbox" checked> Yellow</label>
        <label><input type="checkbox" checked> Red</label>
      </div>

      <div class="filter-section">
        <h3>Size</h3>
        <label><input type="checkbox" checked> Small</label>
        <label><input type="checkbox" checked> Medium</label>
        <label><input type="checkbox" checked> Large</label>
      </div>
    </aside>

    <!-- PRODUCTS -->
    <section class="products">
      <?php if (count($products) === 0): ?>
        <p>Tidak ada produk tersedia.</p>
      <?php else: ?>
        <?php foreach ($products as $p): ?>
          <div class="product-card">
            <div class="product-image" style="background:url('<?= htmlspecialchars($p['image']) ?>') center/cover no-repeat;"></div>
            <h4 class="product-name"><?= htmlspecialchars($p['name']) ?></h4>
            <p class="product-desc"><?= nl2br(htmlspecialchars($p['description'])) ?></p>
            <p class="product-price">Rp. <?= number_format($p['price'], 0, ',', '.') ?></p>
            <button class="buy-button"><a href="product_details.php?id=<?= $p['id'] ?>" class="buy-button">BUY</a>
</button>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>
  </div>
  <script>
  const priceToggle = document.getElementById('price-filter-toggle');
  const priceContent = document.getElementById('price-filter-content');
  const priceRange = document.getElementById('price-range');

  priceToggle.addEventListener('change', function() {
    if (this.checked) {
      priceContent.style.display = 'block';
    } else {
      priceContent.style.display = 'none';
      // Optional: reset slider value or clear input
      // priceRange.value = 50000;
    }
  });
</script>
</body>
</html>