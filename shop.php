<?php
session_start();
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;


// Ambil semua kategori unik dari DB (kolom type)
$stmt = $pdo->query("SELECT DISTINCT type FROM products");
$keywords = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Ambil filter dari GET
$selectedKeywords = isset($_GET['keywords']) ? $_GET['keywords'] : [];
$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = ($priceFilterActive && isset($_GET['max_price'])) ? (int)$_GET['max_price'] : null;

// Query produk
$query = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($selectedKeywords)) {
    $placeholders = implode(',', array_fill(0, count($selectedKeywords), '?'));
    $query .= " AND type IN ($placeholders)";
    $params = array_merge($params, $selectedKeywords);
}

if ($priceFilterActive && $maxPrice !== null) {
    $query .= " AND price <= ?";
    $params[] = $maxPrice;
}

$query .= " ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet"
  />

  <noscript>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
  </noscript>

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://unpkg.com/feather-icons"></script>

  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="style.css" />

</head>
<body>

<!-- Navbar Start -->
<nav class="navbar">
  <a href="index.php" class="navbar-logo">
    <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
  </a>

  <div class="navbar-nav">
    <a href="product.php">Product</a>
    <a href="index.php#workshop">Workshop</a>
    <a href="index.php#catalog">Catalog</a>
    <a href="index.php#about">About Us</a>
  </div>

  <div class="navbar-extra">
    <?php if (isset($_SESSION['id_user'])): ?>
      <span style="margin-right:20px;">
        Hello, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
      </span>
      <a href="logout.php"><i data-feather="log-out"></i></a>
    <?php else: ?>
      <a href="signin.php"><i data-feather="log-in"></i></a>
    <?php endif; ?>

    <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
    <a href="profile.php" id="user"><i data-feather="user"></i></a>
    <i id="menu" data-feather="menu"></i>
  </div>
</nav>
<!-- Navbar End -->

<!-- MAIN -->
<div class="container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <form method="GET" id="filter-form">
      <div class="filter-section">
        <h5>Keywords</h5><br>
        <?php foreach ($keywords as $k): ?>
          <label>
            <input type="checkbox" name="keywords[]" value="<?= htmlspecialchars($k) ?>"
              <?= in_array($k, $selectedKeywords) ? 'checked' : '' ?>>
            <?= ucfirst($k) ?>
          </label><br>
        <?php endforeach; ?>
      </div>

      <div class="filter-section">
        <h3>
          <label>
            <input type="checkbox" id="price-filter-toggle" name="price_filter"
              value="1" <?= $priceFilterActive ? 'checked' : '' ?> />
            Price
          </label>
        </h3>

        <div id="price-filter-content" style="display: <?= $priceFilterActive ? 'block' : 'none' ?>;">
          <input type="range" min="0" max="3000000"
                 value="<?= $maxPrice ?? 50000 ?>"
                 id="price-range" name="max_price" />
          <div class="price-range">
            <span>Rp.0</span>
            <span>Rp.3.000.000</span>
          </div>
        </div>
      </div>

      <button type="submit">Filter</button>
    </form>
  </aside>

  <!-- PRODUCTS -->
  <section class="products">
    <?php if (count($products) === 0): ?>
      <p>Tidak ada produk tersedia.</p>
    <?php else: ?>
      <?php foreach ($products as $p): ?>
        <div class="product-card">
          <div class="product-image"
            style="background:url('<?= htmlspecialchars($p['image']) ?>') center/cover no-repeat;">
          </div>
          <h4><?= htmlspecialchars($p['name']) ?></h4>
          <p><?= nl2br(htmlspecialchars($p['description'])) ?></p>
          <p>Rp. <?= number_format($p['price'], 0, ',', '.') ?></p>
          <a href="product_details.php?id=<?= $p['id'] ?>" class="buy-button">BUY</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>

</div>

<!-- SCRIPTS -->
<script>
  const priceToggle = document.getElementById('price-filter-toggle');
  const priceContent = document.getElementById('price-filter-content');

  priceToggle.addEventListener('change', function() {
    priceContent.style.display = this.checked ? 'block' : 'none';
  });

  feather.replace();
</script>

<script src="js/script.js"></script>

</body>
</html>
