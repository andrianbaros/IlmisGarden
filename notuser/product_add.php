<?php
require '../conn/db.php';

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
  'Lisianthus','Pom-pom','Rose','Sunflower'
];

$occasions = [
  'Anniversary','Birthday','Christmas','Graduation','Grand Opening',
  'Gift','Raya','Valentine','Wedding','Workshop'
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
<title>Add Product</title>

<style>
*{box-sizing:border-box;margin:0;padding:0}
body{
  font-family:Inter,sans-serif;
  background:#f4f6f4;
  padding:32px;
}
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

@media(max-width:900px){
  .form-container{grid-template-columns:1fr}
}
</style>
</head>

<body>

<h2>Add Product</h2>

<form method="post" enctype="multipart/form-data">
<div class="form-container">

<!-- LEFT -->
<div class="card">

<label>Product Name</label>
<input type="text" name="name" required>

<label>Description</label>
<textarea name="description"></textarea>

<label>Price</label>
<input type="number" name="price" required>

<table class="filter-table">
<tr><th colspan="2">By Catalog</th></tr>
<?php foreach ($catalogs as $c): ?>
<tr>
  <td width="24"><input type="checkbox" name="catalog[]" value="<?= $c ?>"></td>
  <td><?= $c ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">By Flowers</th></tr>
<?php foreach ($flowers as $f): ?>
<tr>
  <td width="24"><input type="checkbox" name="flower[]" value="<?= $f ?>"></td>
  <td><?= $f ?></td>
</tr>
<?php endforeach; ?>
</table>

<table class="filter-table">
<tr><th colspan="2">By Occasion</th></tr>
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
<label>Images</label>
<input type="file" name="images[]" multiple accept="image/*" required>
<small style="color:#666">• Gambar pertama otomatis jadi utama</small>
</div>

</div>
</form>

</body>
</html>
