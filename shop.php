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
      <link rel="icon" href="img/F4F6F4-full.png" />

    <!-- Fonts -->
    <!-- 1. Preconnect ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- 2. Preload stylesheet Google Fonts -->
    <link
      rel="preload"
      as="style"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />

    <!-- 3. Load stylesheet font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />

    <!-- 4. Fallback untuk browser lama / tanpa JavaScript -->
    <noscript>
      <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet"
      />
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
      />
    </noscript>

    <!-- Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="style.css" />

</head>
<body >
<!-- Navbar Start -->
    <nav class="navbar">
      <a href="index.php" class="navbar-logo"><img src="img/F4F6F4-full.png" alt="Logo" /></a>

      <div class="navbar-nav">
        <a href="product.php">Product</a>
        <a href="#workshop">Workshop</a>
        <a href="#catalog">Catalog</a>
        <a href="#about">About Us</a>
      </div>
      <div class="navbar-extra">
        
      <?php if (isset($_SESSION['id_user'])): ?>
        <span style="margin-right:20px;">
          Hello, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
        </span>
        <a href="logout.php"><i data-feather="log-out"></i></a>
      <?php else: ?>
        <a href="signin.php"><i data-feather="log-in"></i></a>
      <?php endif; ?>

        <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <i id="menu" data-feather="menu"></i>

      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Navbar End -->

  <!-- MAIN -->
  <div class="container" style="padding-top: 100px;">
    <!-- SIDEBAR -->
    <aside class="sidebar">


      <div class="filter-section">
        <h5>Keywords</h5><br>
        <label><input type="checkbox" checked> Flower Bouquet </label>
        <small>Description</small>
        <label><input type="checkbox" checked> Wedding Bouquet </label>
        <small>Description</small>
        <label><input type="checkbox" checked> Workshop</label>
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
            <input type="range" min="0" max="3000000" value="<?= isset($_GET['max_price']) ? (int)$_GET['max_price'] : 50000 ?>" id="price-range" name="max_price" />
            <div class="price-range">
              <span>Rp.0</span>

              <span>Rp.3.000.000</span>
            </div>
          </div>
        </div>
        <button type="submit" style="  width: 100%;
        margin-top:2rem;
  padding: 0.6rem;
  background: #708871;
  border: #292b28;
  border-radius: 6px;
  color: #fff;
  cursor: pointer;
  font-weight: 500;">Filter</button>
      </form>

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
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>