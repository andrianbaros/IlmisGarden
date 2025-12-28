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
  'Gift','Raya','Valentine','Wedding'
];

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
     IMAGE UPLOAD
  ============================= */
  if (!empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['name'] as $i => $name) {
      if ($_FILES['images']['error'][$i] === 0) {

        $ext  = pathinfo($name, PATHINFO_EXTENSION);
        $file = uniqid().'.'.$ext;

        move_uploaded_file(
          $_FILES['images']['tmp_name'][$i],
          "../img/pr/".$file
        );

        $pdo->prepare(
          "INSERT INTO product_images (product_id, image, is_primary)
           VALUES (?, ?, ?)"
        )->execute([
          $product_id,
          "img/pr/".$file,
          $i === 0 ? 1 : 0
        ]);
      }
    }
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
* { box-sizing:border-box;margin:0;padding:0 }
body {
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
  padding:20px;
  border-radius:14px;
  box-shadow:0 6px 20px rgba(0,0,0,.06);
}
label{
  display:block;
  margin-top:14px;
  font-weight:600;
  font-size:13px;
}
input,textarea{
  width:100%;
  margin-top:6px;
  padding:10px;
  border-radius:8px;
  border:1px solid #c5cec7;
}
.checkbox-group{
  margin-top:10px;
  display:grid;
  grid-template-columns:repeat(auto-fill,minmax(150px,1fr));
  gap:6px;
}
.checkbox-group label{
  font-weight:400;
  font-size:13px;
}
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:14px;
}
button{
  margin-top:20px;
  background:#708871;
  color:#fff;
  border:none;
  padding:10px 18px;
  border-radius:8px;
  cursor:pointer;
}
button:hover{background:#4a6652}
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

  <div class="form-grid">
    <div>
      <label>Price</label>
      <input type="number" name="price" required>
    </div>
  </div>

  <label>By Catalog</label>
  <div class="checkbox-group">
    <?php foreach ($catalogs as $c): ?>
      <label>
        <input type="checkbox" name="catalog[]" value="<?= $c ?>"> <?= $c ?>
      </label>
    <?php endforeach; ?>
  </div>

  <label>By Flowers</label>
  <div class="checkbox-group">
    <?php foreach ($flowers as $f): ?>
      <label>
        <input type="checkbox" name="flower[]" value="<?= $f ?>"> <?= $f ?>
      </label>
    <?php endforeach; ?>
  </div>

  <label>By Occasion</label>
  <div class="checkbox-group">
    <?php foreach ($occasions as $o): ?>
      <label>
        <input type="checkbox" name="occasion[]" value="<?= $o ?>"> <?= $o ?>
      </label>
    <?php endforeach; ?>
  </div>

  <button type="submit">Add Product</button>
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
