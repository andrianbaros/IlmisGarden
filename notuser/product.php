<?php
session_start();
require '../conn/db.php';

// pastikan admin login
if (!isset($_SESSION['is_admin'])) {
    header("Location: login_admin.php");
    exit;
}

/*
 Ambil produk + 1 gambar (prioritas primary, fallback ke image lain)
*/
$sql = "
    SELECT 
        p.*,
        (
          SELECT pi.image
          FROM product_images pi
          WHERE pi.product_id = p.id
          ORDER BY pi.is_primary DESC, pi.id ASC
          LIMIT 1
        ) AS main_image
    FROM products p
    ORDER BY p.id DESC
";

$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Product</title>
  <link rel="icon" href="../img/F4F6F4-full.png" />
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="../css/navbar.css">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background:#f4f6f4;
      margin:0;
      padding:20px;
    }
    .container {
      max-width:1100px;
      margin:auto;
      background:#fff;
      padding:20px;
      border-radius:8px;
      box-shadow:0 4px 10px rgba(0,0,0,0.08);
    }
    .top-bar {
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:20px;
    }
    .btn {
      padding:8px 12px;
      border-radius:6px;
      text-decoration:none;
      font-size:0.9rem;
      cursor:pointer;
    }
    .btn-add { background:#708871; color:#fff; }
    .btn-edit { background:#cce5ff; color:#004085; }
    .btn-del { background:#f8d7da; color:#721c24; }

    .grid {
      display:grid;
      grid-template-columns:repeat(auto-fill, minmax(200px,1fr));
      gap:20px;
    }
    .card {
      background:#fafafa;
      border:1px solid #ddd;
      border-radius:8px;
      padding:10px;
      text-align:center;
      box-shadow:0 2px 6px rgba(0,0,0,0.05);
    }
    .card img {
      width:100%;
      height:150px;
      object-fit:cover;
      border-radius:6px;
    }
    .price {
      color:#283128;
      font-weight:600;
      margin:5px 0;
    }
    .actions {
      margin-top:10px;
      display:flex;
      justify-content:center;
      gap:6px;
    }
  </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar">
  <a href="dashboard.php">
    <img src="../img/F4F6F4-full.png" alt="IlmisGarden">
  </a>

  <div class="navbar-nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="admin_transaction.php">Order</a>
    <a href="product.php" class="active">Product</a>
  </div>

  <div class="navbar-extra">
    <a href="#" id="menu"><i data-feather="menu"></i></a>
  </div>
</nav>

<div class="container" style="margin:100px auto;">
  <div class="top-bar">
    <h2>My Product (Admin)</h2>
    <a href="product_add.php" class="btn btn-add">
      <i data-feather="plus"></i>
    </a>
  </div>

  <div class="grid">
    <?php foreach ($products as $p): ?>
      <div class="card">

        <?php
          $img = $p['main_image']
                 ? "../".$p['main_image']
                 : "../img/no-image.png";
        ?>

        <img src="<?= htmlspecialchars($img) ?>"
             alt="<?= htmlspecialchars($p['name']) ?>">

        <h4><?= htmlspecialchars($p['name']) ?></h4>
        <p class="price">
          Rp. <?= number_format($p['price'],0,',','.') ?>
        </p>

        <div class="actions">
          <a href="product_edit.php?id=<?= $p['id'] ?>"
             class="btn btn-edit">
             <i data-feather="edit-2"></i>
          </a>

          <a href="product_delete.php?id=<?= $p['id'] ?>"
             class="btn btn-del"
             onclick="return confirm('Yakin hapus produk ini?')">
             <i data-feather="trash-2"></i>
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script>
  feather.replace();
</script>

</body>
</html>
