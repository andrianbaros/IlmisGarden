<?php
session_start();
require '../conn/db.php';

if (!isset($_SESSION['is_admin'])) {
    header("Location: login_admin.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) die("ID required");

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
  'Lisianthus','Pom-pom','Rose','Sunflower', 'Orchid'
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
   GET PRODUCT
============================= */
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) die("Product not found");

$selectedCatalogs  = $product['catalog']  ? explode(',', $product['catalog'])  : [];
$selectedFlowers   = $product['flower']   ? explode(',', $product['flower'])   : [];
$selectedOccasions = $product['occasion'] ? explode(',', $product['occasion']) : [];

/* =============================
   GET IMAGES
============================= */
$stmt = $pdo->prepare("
  SELECT * FROM product_images
  WHERE product_id=?
  ORDER BY is_primary DESC, id ASC
");
$stmt->execute([$id]);
$images = $stmt->fetchAll();

/* =============================
   DELETE IMAGE (SAFE)
============================= */
if (isset($_GET['delete_image'])) {
  $imgId = (int)$_GET['delete_image'];

  $img = $pdo->prepare(
    "SELECT image, is_primary FROM product_images WHERE id=?"
  );
  $img->execute([$imgId]);
  $row = $img->fetch();

  if ($row) {
    @unlink("../".$row['image']);
    $pdo->prepare("DELETE FROM product_images WHERE id=?")
        ->execute([$imgId]);

    // jika primary dihapus → set pengganti
    if ($row['is_primary'] == 1) {
      $pdo->prepare("
        UPDATE product_images
        SET is_primary = 1
        WHERE product_id=?
        ORDER BY id ASC
        LIMIT 1
      ")->execute([$id]);
    }
  }

  header("Location: product_edit.php?id=".$id);
  exit;
}

/* =============================
   UPDATE PRODUCT
============================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $catalog  = !empty($_POST['catalog'])  ? implode(',', $_POST['catalog'])  : null;
  $flower   = !empty($_POST['flower'])   ? implode(',', $_POST['flower'])   : null;
  $occasion = !empty($_POST['occasion']) ? implode(',', $_POST['occasion']) : null;

  $pdo->prepare(
    "UPDATE products SET
     name=?, description=?, price=?,
     catalog=?, flower=?, occasion=?
     WHERE id=?"
  )->execute([
    $_POST['name'],
    $_POST['description'],
    $_POST['price'],
    $catalog,
    $flower,
    $occasion,
    $id
  ]);

  /* =============================
     UPLOAD IMAGE (SAFE)
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

        $insert->execute([$id, "img/pr/".$file]);
      }
    }
  }

  // ===== PASTIKAN ADA PRIMARY IMAGE =====
  $check = $pdo->prepare("
    SELECT COUNT(*) FROM product_images
    WHERE product_id=? AND is_primary=1
  ");
  $check->execute([$id]);

  if ($check->fetchColumn() == 0) {
    $pdo->prepare("
      UPDATE product_images
      SET is_primary = 1
      WHERE product_id=?
      ORDER BY id ASC
      LIMIT 1
    ")->execute([$id]);
  }

  header("Location: product.php?msg=updated");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Product — IlmisGarden Admin</title>
<link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
<link rel="icon" href="../img/F4F6F4-full.png" />
<style>
  .filter-table { width:100%; border-collapse:collapse; margin-bottom:16px; }
  .filter-table th { text-align:left; font-size:0.82rem; padding:6px 0; color:var(--charcoal); font-weight:600; }
  .filter-table td { padding:3px 0; vertical-align:middle; font-size:0.85rem; }
  .filter-table input[type="checkbox"] { width:auto; margin-right:8px; accent-color:var(--sage); }
  .image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, 72px);
    gap: 10px;
    margin: 12px 0 16px;
  }
  .image-box {
    position: relative;
    width: 72px;
    height: 72px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid var(--border);
  }
  .image-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .delete-img {
    position: absolute;
    top: 3px;
    right: 3px;
    width: 18px;
    height: 18px;
    background: var(--danger);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    line-height: 1;
    text-decoration: none;
    font-weight: bold;
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    transition: transform 0.15s;
  }
  .delete-img:hover {
    transform: scale(1.15);
  }
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
$page_id = 'products';
$page_title = 'Edit Product';
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
<input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

<label style="margin-top:16px;">Description</label>
<textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

<label style="margin-top:16px;">Price (Rp)</label>
<input type="number" name="price" value="<?= $product['price'] ?>" required>

<table class="filter-table" style="margin-top:20px;">
<tr><th colspan="2">Catalog</th></tr>
<?php foreach ($catalogs as $c): ?>
<tr>
<td width="24">
<input type="checkbox" name="catalog[]" value="<?= $c ?>"
<?= in_array($c,$selectedCatalogs)?'checked':'' ?>>
</td>
<td><?= $c ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">Flowers</th></tr>
<?php foreach ($flowers as $f): ?>
<tr>
<td width="24">
<input type="checkbox" name="flower[]" value="<?= $f ?>"
<?= in_array($f,$selectedFlowers)?'checked':'' ?>>
</td>
<td><?= $f ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">Occasion</th></tr>
<?php foreach ($occasions as $o): ?>
<tr>
<td width="24">
<input type="checkbox" name="occasion[]" value="<?= $o ?>"
<?= in_array($o,$selectedOccasions)?'checked':'' ?>>
</td>
<td><?= $o ?></td>
</tr>
<?php endforeach; ?>
</table>

<div class="form-actions">
  <button type="submit">Update Product</button>
  <a href="product.php" class="btn-cancel">Cancel</a>
</div>

</div>

<!-- RIGHT -->
<div class="card">
<label>Product Images</label>
<div class="image-grid">
<?php foreach ($images as $img): ?>
<div class="image-box">
<img src="../<?= htmlspecialchars($img['image']) ?>">
<a class="delete-img"
   href="?id=<?= $id ?>&delete_image=<?= $img['id'] ?>"
   onclick="return confirm('Hapus gambar ini?')">×</a>
</div>
<?php endforeach; ?>
</div>
<label style="margin-top:12px;">Add More Images</label>
<input type="file" name="images[]" multiple accept="image/*" style="margin-top:8px;">
</div>

</div>
</form>

<?php include 'admin_layout_end.php'; ?>
