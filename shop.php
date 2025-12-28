<?php
session_start();
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;

/* =============================
   Ambil kategori/type
============================= */
$stmt = $pdo->query("SELECT DISTINCT type FROM products");
$keywords = $stmt->fetchAll(PDO::FETCH_COLUMN);

/* =============================
   Ambil filter
============================= */
$selectedKeywords   = $_GET['keywords'] ?? [];
$priceFilterActive  = isset($_GET['price_filter']);
$maxPrice           = ($priceFilterActive && isset($_GET['max_price']))
                        ? (int)$_GET['max_price']
                        : null;

/* =============================
   Query produk + gambar utama
============================= */
$sql = "
    SELECT 
        p.*,
        pi.image AS main_image
    FROM products p
    LEFT JOIN product_images pi
      ON p.id = pi.product_id AND pi.is_primary = 1
    WHERE 1=1
";

$params = [];

// filter type
if (!empty($selectedKeywords)) {
    $placeholders = implode(',', array_fill(0, count($selectedKeywords), '?'));
    $sql .= " AND p.type IN ($placeholders)";
    $params = array_merge($params, $selectedKeywords);
}

// filter harga
if ($priceFilterActive && $maxPrice !== null) {
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://unpkg.com/feather-icons"></script>

  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
  <a href="index.php" class="navbar-logo">
    <img src="img/F4F6F4-full.png" alt="Logo" style="width:200px;">
  </a>

  <div class="navbar-nav">
    <a href="shop.php" class="active">Product</a>
    <a href="index.php#catalog">Catalog</a>
    <a href="index.php#about">About Us</a>
  </div>

  <div class="navbar-extra">
    <?php if ($user_id): ?>
      <span style="margin-right:20px;">
        Hello, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
      </span>
      <a href="logout.php"><i data-feather="log-out"></i></a>
    <?php else: ?>
      <a href="signin.php"><i data-feather="log-in"></i></a>
    <?php endif; ?>

    <a href="cart.php"><i data-feather="shopping-cart"></i></a>
    <a href="profile.php"><i data-feather="user"></i></a>
    <i id="menu" data-feather="menu"></i>
  </div>
</nav>

<!-- MAIN -->
<div class="container">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <form method="GET">
      <div class="filter-section">
        <h5>Category</h5><br>
        <?php foreach ($keywords as $k): ?>
          <label>
            <input type="checkbox" name="keywords[]" value="<?= htmlspecialchars($k) ?>"
              <?= in_array($k, $selectedKeywords) ? 'checked' : '' ?>>
            <?= ucfirst($k) ?>
          </label><br>
        <?php endforeach; ?>
      </div>

      <div class="filter-section">
        <label>
          <input type="checkbox" name="price_filter" <?= $priceFilterActive ? 'checked' : '' ?>>
          Max Price
        </label>

        <?php if ($priceFilterActive): ?>
          <input type="range" min="0" max="3000000"
                 name="max_price"
                 value="<?= $maxPrice ?? 0 ?>">
          <p>≤ Rp. <?= number_format($maxPrice ?? 0,0,',','.') ?></p>
        <?php endif; ?>
      </div>

      <button type="submit">Filter</button>
    </form>
  </aside>

  <!-- PRODUCTS -->
  <section class="products">
    <?php if (empty($products)): ?>
      <p>Tidak ada produk tersedia.</p>
    <?php else: ?>
      <?php foreach ($products as $p): ?>

        <?php
          $img = $p['main_image']
                 ? $p['main_image']
                 : 'img/no-image.png';
        ?>

        <div class="product-card">
          <div class="product-image"
               style="background:url('<?= htmlspecialchars($img) ?>') center/cover no-repeat;">
          </div>

          <h4><?= htmlspecialchars($p['name']) ?></h4>
          <p class="price">
            Rp. <?= number_format($p['price'],0,',','.') ?>
          </p>

          <a href="product_details.php?id=<?= $p['id'] ?>" class="buy-button">
            BUY
          </a>
        </div>

      <?php endforeach; ?>
    <?php endif; ?>
  </section>

</div>

<script>
  feather.replace();
</script>
<script src="js/script.js"></script>

</body>
</html>
