<?php
require '../conn/db.php';

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
  'Lisianthus','Pom-pom','Rose','Sunflower'
];

$occasions = [
  'Anniversary','Birthday','Christmas','Graduation','Grand Opening',
  'Gift','Raya','Valentine','Wedding'
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
$stmt = $pdo->prepare(
  "SELECT * FROM product_images
   WHERE product_id=?
   ORDER BY is_primary DESC, id ASC"
);
$stmt->execute([$id]);
$images = $stmt->fetchAll();

/* =============================
   DELETE IMAGE
============================= */
if (isset($_GET['delete_image'])) {
  $imgId = (int)$_GET['delete_image'];
  $img = $pdo->prepare("SELECT image FROM product_images WHERE id=?");
  $img->execute([$imgId]);
  $row = $img->fetch();
  if ($row) {
    @unlink("../".$row['image']);
    $pdo->prepare("DELETE FROM product_images WHERE id=?")->execute([$imgId]);
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

  if (!empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['name'] as $i => $name) {
      if ($_FILES['images']['error'][$i] === 0) {
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $file = uniqid().'.'.$ext;
        move_uploaded_file($_FILES['images']['tmp_name'][$i], "../img/pr/".$file);
        $pdo->prepare(
          "INSERT INTO product_images (product_id, image)
           VALUES (?, ?)"
        )->execute([$id, "img/pr/".$file]);
      }
    }
  }

  header("Location: product.php?msg=updated");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Inter,sans-serif;background:#f4f6f4;padding:32px}
h2{margin-bottom:24px}

.form-container{
  max-width:1100px;
  margin:auto;
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:24px;
}

.card{
  background:#fff;
  padding:24px;
  border-radius:14px;
  box-shadow:0 6px 20px rgba(0,0,0,.06);
}

label{
  font-weight:600;
  font-size:13px;
  display:block;
  margin-bottom:6px;
}

input,textarea{
  width:100%;
  padding:10px;
  border-radius:8px;
  border:1px solid #c5cec7;
  margin-bottom:14px;
}

textarea{min-height:100px}

/* ===== TABLE CHECKBOX ===== */
.filter-table{
  width:100%;
  border-collapse:collapse;
  margin-bottom:20px;
}

.filter-table th{
  text-align:left;
  font-size:14px;
  padding-bottom:8px;
}

.filter-table td{
  padding:4px 0;
  vertical-align:middle;
}

.filter-table input{
  margin-right:8px;
}

/* ===== ACTION BUTTON ===== */
.form-actions{
  margin-top:20px;
  display:flex;
  gap:12px;
}

button{
  background:#708871;
  color:#fff;
  border:none;
  padding:10px 18px;
  border-radius:8px;
  cursor:pointer;
}

.btn-cancel{
  background:#ddd;
  color:#333;
  padding:10px 18px;
  border-radius:8px;
  text-decoration:none;
  font-size:13px;
}

.btn-cancel:hover{background:#cfcfcf}

/* ===== IMAGE ===== */
.image-grid{
  display:grid;
  grid-template-columns:repeat(auto-fill,64px);
  gap:10px;
  margin-bottom:12px;
}

.image-box{
  width:64px;
  height:64px;
  border-radius:10px;
  overflow:hidden;
  position:relative;
  border:1px solid #ddd;
}

.image-box img{
  width:100%;
  height:100%;
  object-fit:cover;
}

.delete-img{
  position:absolute;
  top:-6px;
  right:-6px;
  width:22px;
  height:22px;
  background:#dc3545;
  color:#fff;
  border-radius:50%;
  text-align:center;
  line-height:22px;
  text-decoration:none;
  font-weight:bold;
}

@media(max-width:900px){
  .form-container{grid-template-columns:1fr}
}
</style>
</head>

<body>

<h2>Edit Product</h2>

<form method="post" enctype="multipart/form-data">
<div class="form-container">

<!-- LEFT -->
<div class="card">

<label>Product Name</label>
<input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

<label>Description</label>
<textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

<label>Price</label>
<input type="number" name="price" value="<?= $product['price'] ?>" required>

<table class="filter-table">
<tr><th colspan="2">By Catalog</th></tr>
<?php foreach ($catalogs as $c): ?>
<tr>
<td width="24"><input type="checkbox" name="catalog[]" value="<?= $c ?>" <?= in_array($c,$selectedCatalogs)?'checked':'' ?>></td>
<td><?= $c ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">By Flowers</th></tr>
<?php foreach ($flowers as $f): ?>
<tr>
<td width="24"><input type="checkbox" name="flower[]" value="<?= $f ?>" <?= in_array($f,$selectedFlowers)?'checked':'' ?>></td>
<td><?= $f ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">By Occasion</th></tr>
<?php foreach ($occasions as $o): ?>
<tr>
<td width="24"><input type="checkbox" name="occasion[]" value="<?= $o ?>" <?= in_array($o,$selectedOccasions)?'checked':'' ?>></td>
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
<label>Images</label>
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
<input type="file" name="images[]" multiple>
</div>

</div>
</form>

</body>
</html>
