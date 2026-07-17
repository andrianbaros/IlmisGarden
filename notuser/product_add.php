<?php
session_start();
require '../conn/db.php';

if (!isset($_SESSION['is_admin'])) {
    header("Location: login_admin.php");
    exit;
}

/* =============================
   FILTER CATEGORY OPTIONS
============================= */
$catalogs = [
  'Add-on','Artificial Flowers','Basket','Best Seller','Blooming Canvas',
  'Bouquet','Box','Centerpiece','Dried Flowers','Money Bouquet',
  'Standing Flowers','Vase','Wedding Bouquet'
];

$flowers = [
  'Dianthus','Gerbera','Gompie','Hydrangea','Lilly',
  'Lisianthus','Pom-pom','Rose','Sunflower', 'Orchid', 'Tuberose / Sedap Malam'
];

$occasions = [
  'Anniversary',
  'Birthday',
  'Christmas',
  'Graduation',
  'Grand Opening',
  'Gift',
  'Raya',
  'Valentine',
  'Wedding',
  'Workshop',
  'Imlek',
  'Sebulan Penuh Cinta',
  'Eid Al Fitr'
];


/* =============================
   INSERT PRODUCT
============================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $catalog  = !empty($_POST['catalog'])  ? implode(',', $_POST['catalog'])  : null;
  $flower   = !empty($_POST['flower'])   ? implode(',', $_POST['flower'])   : null;
  $occasion = !empty($_POST['occasion']) ? implode(',', $_POST['occasion']) : null;

  $stmt = $pdo->prepare(
    "INSERT INTO products
     (name, description, price, catalog, flower, occasion)
     VALUES (?, ?, ?, ?, ?, ?)"
  );

  $stmt->execute([
    $_POST['name'],
    $_POST['description'],
    $_POST['price'],
    $catalog,
    $flower,
    $occasion
  ]);

  $product_id = $pdo->lastInsertId();

  /* =============================
     IMAGE UPLOAD (FIXED)
  ============================= */
  if (!empty($_FILES['images']['name'][0])) {

    $insert = $pdo->prepare(
      "INSERT INTO product_images (product_id, image, is_primary)
       VALUES (?, ?, 0)"
    );

    foreach ($_FILES['images']['name'] as $i => $name) {
      if ($_FILES['images']['error'][$i] === 0) {

        $ext  = pathinfo($name, PATHINFO_EXTENSION);
        $file = uniqid().'.'.$ext;

        move_uploaded_file(
          $_FILES['images']['tmp_name'][$i],
          "../img/pr/".$file
        );

        $insert->execute([
          $product_id,
          "img/pr/".$file
        ]);
      }
    }

    // ===== PASTIKAN ADA PRIMARY IMAGE =====
    $pdo->prepare("
      UPDATE product_images
      SET is_primary = 1
      WHERE product_id = ?
      ORDER BY id ASC
      LIMIT 1
    ")->execute([$product_id]);
  }

  header("Location: product.php?msg=added");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product — IlmisGarden Admin</title>
<link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
<link rel="icon" href="../img/F4F6F4-full.png" />
<style>
  .filter-table { width:100%; border-collapse:collapse; margin-bottom:16px; }
  .filter-table th { text-align:left; font-size:0.82rem; padding:6px 0; color:var(--charcoal); font-weight:600; }
  .filter-table td { padding:3px 0; vertical-align:middle; font-size:0.85rem; }
  .filter-table input[type="checkbox"] { width:auto; margin-right:8px; accent-color:var(--sage); }
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
$page_id = 'products';
$page_title = 'Add Product';
include 'admin_layout.php';
?>

<div style="margin-bottom:24px;">
  <a href="product.php" style="display:inline-flex;align-items:center;gap:6px;font-size:0.82rem;color:var(--muted);font-weight:500;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
    Back to Products
  </a>
</div>

<form method="post" enctype="multipart/form-data">
<div class="form-container">

<!-- LEFT -->
<div class="card">

<label>Product Name</label>
<input type="text" name="name" required>

<label style="margin-top:16px;">Description</label>
<textarea name="description"></textarea>

<label style="margin-top:16px;">Price (Rp)</label>
<input type="number" name="price" required>

<table class="filter-table" style="margin-top:20px;">
<tr><th colspan="2">Catalog</th></tr>
<?php foreach ($catalogs as $c): ?>
<tr>
  <td width="24"><input type="checkbox" name="catalog[]" value="<?= $c ?>"></td>
  <td><?= $c ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">Flowers</th></tr>
<?php foreach ($flowers as $f): ?>
<tr>
  <td width="24"><input type="checkbox" name="flower[]" value="<?= $f ?>"></td>
  <td><?= $f ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">Occasion</th></tr>
<?php foreach ($occasions as $o): ?>
<tr>
  <td width="24"><input type="checkbox" name="occasion[]" value="<?= $o ?>"></td>
  <td><?= $o ?></td>
</tr>
<?php endforeach; ?>
</table>

<div class="form-actions">
  <button type="submit">Add Product</button>
  <a href="product.php" class="btn-cancel">Cancel</a>
</div>

</div>

<!-- RIGHT -->
<div class="card">
  <label>Product Images</label>
  <input type="file" name="images[]" multiple accept="image/*" required style="margin-top:8px;">
  <p style="font-size:0.78rem;color:var(--muted);margin-top:8px;">First image will be used as the primary image.</p>
</div>

</div>
</form>

<?php include 'admin_layout_end.php'; ?>
