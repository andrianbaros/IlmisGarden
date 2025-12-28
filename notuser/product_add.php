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

  $stmt = $pdo->prepare(
    "INSERT INTO products
     (name, description, price, catalog, flower, occasion)
     VALUES (?, ?, ?, ?, ?, ?)"
  );

  $stmt->execute([
    $_POST['name'],
    $_POST['description'],
    $_POST['price'],
    $_POST['catalog'] ?: null,
    $_POST['flower'] ?: null,
    $_POST['occasion'] ?: null
  ]);

  $product_id = $pdo->lastInsertId();

  /* =============================
     IMAGE UPLOAD
  ============================= */
  if (!empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['name'] as $i => $name) {
      if ($_FILES['images']['error'][$i] === 0) {
        $file = time().'_'.$name;
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
input,textarea,select{
  width:100%;
  margin-top:6px;
  padding:10px;
  border-radius:8px;
  border:1px solid #c5cec7;
}
.form-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:14px;
}
button{
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

    <div>
      <label>By Catalog</label>
      <select name="catalog">
        <option value="">— Optional —</option>
        <?php foreach ($catalogs as $c): ?>
          <option value="<?= $c ?>"><?= $c ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label>By Flowers</label>
      <select name="flower">
        <option value="">— Optional —</option>
        <?php foreach ($flowers as $f): ?>
          <option value="<?= $f ?>"><?= $f ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label>By Occasion</label>
      <select name="occasion">
        <option value="">— Optional —</option>
        <?php foreach ($occasions as $o): ?>
          <option value="<?= $o ?>"><?= $o ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <br>
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
