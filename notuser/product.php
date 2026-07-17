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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products — IlmisGarden Admin</title>
  <link rel="icon" href="../img/F4F6F4-full.png" />
  <link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
  <style>
    .btn-edit, .btn-del {
      padding: 7px 12px;
      border-radius: 6px;
      font-size: 0.78rem;
      font-weight: 550;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      cursor: pointer;
      transition: all 0.2s;
    }
    .btn-edit {
      background: var(--info-bg);
      color: var(--info);
      border: 1px solid rgba(59,130,246,0.12);
    }
    .btn-edit:hover { background: #dbeafe; }
    .btn-del {
      background: var(--danger-bg);
      color: var(--danger);
      border: 1px solid rgba(239,68,68,0.12);
    }
    .btn-del:hover { background: #fee2e2; }
    .btn-add-product {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 9px 20px;
      background: var(--forest);
      color: #fff;
      border-radius: 8px;
      font-size: 0.82rem;
      font-weight: 550;
      transition: background 0.2s;
    }
    .btn-add-product:hover {
      background: var(--sage-dark);
    }
  </style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
$page_id = 'products';
$page_title = 'Products';
include 'admin_layout.php';
?>

<div class="top-bar">
  <h2 style="margin:0;">Products</h2>
  <a href="product_add.php" class="btn-add-product">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    Add Product
  </a>
</div>

<div class="products">
  <?php foreach ($products as $p): ?>
    <div class="product-card">
      <?php
        $img = $p['main_image']
               ? "../".$p['main_image']
               : "../img/no-image.png";
      ?>

      <img src="<?= htmlspecialchars($img) ?>"
           alt="<?= htmlspecialchars($p['name']) ?>" class="product-image"
           loading="lazy">

      <h3 class="product-name"><?= htmlspecialchars($p['name']) ?></h3>
      <p class="product-price">Rp <?= number_format($p['price'],0,',','.') ?></p>

      <div class="actions">
        <a href="product_edit.php?id=<?= $p['id'] ?>" class="btn-edit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="13" height="13"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          Edit
        </a>
        <a href="product_delete.php?id=<?= $p['id'] ?>"
           class="btn-del"
           onclick="return confirm('Yakin hapus produk ini?')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="13" height="13"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
          Delete
        </a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php include 'admin_layout_end.php'; ?>
