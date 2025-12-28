<?php
require '../conn/db.php';

$types = ['flower', 'wedding', 'workshop'];

$id = $_GET['id'] ?? null;
if (!$id) die("ID required");

/* ===============================
   HAPUS 1 GAMBAR
================================ */
if (isset($_GET['delete_image'])) {
    $imgId = (int)$_GET['delete_image'];

    // ambil data gambar
    $stmt = $pdo->prepare("SELECT image FROM product_images WHERE id=?");
    $stmt->execute([$imgId]);
    $img = $stmt->fetch();

    if ($img) {
        $filePath = "../".$img['image'];
        if (file_exists($filePath)) {
            unlink($filePath); // hapus file fisik
        }

        $pdo->prepare("DELETE FROM product_images WHERE id=?")
            ->execute([$imgId]);
    }

    header("Location: product_edit.php?id=".$id);
    exit;
}

/* ===============================
   AMBIL PRODUK
================================ */
$stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) die("Product not found");

/* ===============================
   AMBIL GAMBAR
================================ */
$imgStmt = $pdo->prepare(
    "SELECT * FROM product_images
     WHERE product_id=?
     ORDER BY is_primary DESC, id ASC"
);
$imgStmt->execute([$id]);
$images = $imgStmt->fetchAll();

/* ===============================
   UPDATE PRODUK
================================ */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pdo->prepare(
        "UPDATE products SET name=?, description=?, price=?, type=? WHERE id=?"
    )->execute([
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['type'],
        $id
    ]);

    // upload gambar baru
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $i => $imgName) {
            if ($_FILES['images']['error'][$i] === 0) {
                $tmp  = $_FILES['images']['tmp_name'][$i];
                $file = time().'_'.$imgName;
                $path = "../img/pr/".$file;

                move_uploaded_file($tmp, $path);

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
<link rel="stylesheet" href="admin.css">
<style>
.image-grid {
  display:flex;
  flex-wrap:wrap;
  gap:10px;
}
.image-box {
  position:relative;
}
.image-box img {
  width:90px;
  height:90px;
  object-fit:cover;
  border-radius:6px;
}
.delete-img {
  position:absolute;
  top:-6px;
  right:-6px;
  background:#dc3545;
  color:#fff;
  border:none;
  border-radius:50%;
  width:22px;
  height:22px;
  font-size:14px;
  cursor:pointer;
}
</style>
</head>
<body>

<h2>Edit Product</h2>

<form method="post" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name"
       value="<?= htmlspecialchars($product['name']) ?>" required>

<label>Description</label>
<textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>

<label>Price</label>
<input type="number" name="price"
       value="<?= $product['price'] ?>" required>

<label>Category</label>
<select name="type">
<?php foreach ($types as $t): ?>
<option value="<?= $t ?>" <?= $product['type']==$t?'selected':'' ?>>
<?= ucfirst($t) ?>
</option>
<?php endforeach; ?>
</select>

<h3>Current Images</h3>
<div class="image-grid">
<?php foreach ($images as $img): ?>
  <div class="image-box">
    <img src="../<?= htmlspecialchars($img['image']) ?>">
    <a href="?id=<?= $id ?>&delete_image=<?= $img['id'] ?>"
       onclick="return confirm('Hapus gambar ini?')"
       class="delete-img">×</a>
  </div>
<?php endforeach; ?>
</div>

<h3>Add Images</h3>
<input type="file" name="images[]" multiple accept="image/*">

<br><br>
<button type="submit">Update</button>
<a href="product.php">Cancel</a>

</form>

</body>
</html>
