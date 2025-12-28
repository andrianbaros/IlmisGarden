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

/* ===============================
   DELETE IMAGE
================================ */
if (isset($_GET['delete_image'])) {
    $imgId = (int)$_GET['delete_image'];

    $stmt = $pdo->prepare("SELECT image FROM product_images WHERE id=?");
    $stmt->execute([$imgId]);
    $img = $stmt->fetch();

    if ($img) {
        $file = "../".$img['image'];
        if (file_exists($file)) unlink($file);
        $pdo->prepare("DELETE FROM product_images WHERE id=?")->execute([$imgId]);
    }

    header("Location: product_edit.php?id=".$id);
    exit;
}

/* ===============================
   GET PRODUCT
================================ */
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) die("Product not found");

/* ===============================
   GET IMAGES
================================ */
$stmt = $pdo->prepare(
    "SELECT * FROM product_images
     WHERE product_id=?
     ORDER BY is_primary DESC, id ASC"
);
$stmt->execute([$id]);
$images = $stmt->fetchAll();

/* ===============================
   UPDATE PRODUCT
================================ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pdo->prepare(
        "UPDATE products SET
         name=?, description=?, price=?,
         catalog=?, flower=?, occasion=?
         WHERE id=?"
    )->execute([
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['catalog'] ?: null,
        $_POST['flower'] ?: null,
        $_POST['occasion'] ?: null,
        $id
    ]);

    /* IMAGE UPLOAD */
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
<style>
  /* ===============================
   RESET
=============================== */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

/* ===============================
   BODY
=============================== */
body {
  font-family: "Inter", sans-serif;
  background: #f4f6f4;
  padding: 32px;
  color: #111;
}

/* ===============================
   TITLE
=============================== */
h2 {
  font-size: 22px;
  margin-bottom: 24px;
}

h3 {
  font-size: 15px;
  margin-bottom: 12px;
}

/* ===============================
   LAYOUT
=============================== */
.form-container {
  max-width: 1100px;
  margin: auto;
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 24px;
  align-items: start;
}

/* ===============================
   CARD
=============================== */
.card {
  background: #fff;
  padding: 20px;
  border-radius: 14px;
  box-shadow: 0 6px 20px rgba(0,0,0,.06);
}

/* ===============================
   FORM
=============================== */
label {
  display: block;
  margin-top: 14px;
  font-weight: 600;
  font-size: 13px;
}

input,
textarea,
select {
  width: 100%;
  margin-top: 6px;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #c5cec7;
  font-size: 13px;
}

textarea {
  min-height: 100px;
  resize: vertical;
}

input:focus,
textarea:focus,
select:focus {
  outline: none;
  border-color: #4a6652;
}

/* ===============================
   GRID (PRICE + CATEGORY)
=============================== */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-top: 10px;
}

/* ===============================
   ACTIONS
=============================== */
.form-actions {
  margin-top: 22px;
  display: flex;
  gap: 12px;
}

button {
  background: #708871;
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 8px;
  font-size: 13px;
  cursor: pointer;
}

button:hover {
  background: #4a6652;
}

.form-actions a {
  background: #ddd;
  padding: 10px 18px;
  border-radius: 8px;
  text-decoration: none;
  color: #333;
  font-size: 13px;
}

/* ===============================
   IMAGE PANEL
=============================== */
.image-card {
  align-self: start;
}

/* ===============================
   IMAGE GRID
=============================== */
.image-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, 56px);
  gap: 8px;
  max-height: 180px;
  overflow-y: auto;
  margin-bottom: 12px;
}

/* IMAGE BOX */
.image-box {
  width: 56px;
  height: 56px;
  border-radius: 8px;
  overflow: hidden;
  border: 1px solid #ddd;
  background: #fafafa;
  position: relative;
}

/* IMAGE */
.image-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* DELETE BUTTON */
.delete-img {
  position: absolute;
  top: -8px;
  right: -8px;
  width: 26px;
  height: 26px;
  background: #dc3545;
  color: #fff;
  border-radius: 50%;
  font-size: 16px;
  font-weight: bold;
  line-height: 26px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.25);
  transition: all 0.2s ease;
}

.delete-img:hover {
  background: #b02a37;
}

/* ===============================
   RESPONSIVE
=============================== */
@media (max-width: 900px) {
  .form-container {
    grid-template-columns: 1fr;
  }
}

</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Product</title>

<style>
/* === STYLE TETAP (TIDAK DIUBAH) === */
<?php /* (style kamu tetap sama persis, aman) */ ?>
</style>
</head>
<body>

<h2>Edit Product</h2>

<form method="post" enctype="multipart/form-data">
<div class="form-container">

<!-- LEFT -->
<div class="card">
  <h3>Basic Information</h3>

  <label>Product Name</label>
  <input type="text" name="name"
         value="<?= htmlspecialchars($product['name']) ?>" required>

  <label>Description</label>
  <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

  <div class="form-grid">
    <div>
      <label>Price</label>
      <input type="number" name="price"
             value="<?= $product['price'] ?>" required>
    </div>

    <div>
      <label>By Catalog</label>
      <select name="catalog">
        <option value="">— Optional —</option>
        <?php foreach ($catalogs as $c): ?>
          <option value="<?= $c ?>" <?= $product['catalog']===$c?'selected':'' ?>>
            <?= $c ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label>By Flowers</label>
      <select name="flower">
        <option value="">— Optional —</option>
        <?php foreach ($flowers as $f): ?>
          <option value="<?= $f ?>" <?= $product['flower']===$f?'selected':'' ?>>
            <?= $f ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label>By Occasion</label>
      <select name="occasion">
        <option value="">— Optional —</option>
        <?php foreach ($occasions as $o): ?>
          <option value="<?= $o ?>" <?= $product['occasion']===$o?'selected':'' ?>>
            <?= $o ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="form-actions">
    <button type="submit">Update Product</button>
    <a href="product.php">Cancel</a>
  </div>
</div>

<!-- RIGHT -->
<div class="card image-card">
  <h3>Images</h3>

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

  <input type="file" name="images[]" multiple accept="image/*">
  <small>Upload untuk menambah gambar</small>
</div>

</div>
</form>

</body>
</html>
