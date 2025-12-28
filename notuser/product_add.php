<?php
require '../conn/db.php';

$types = ['flower', 'wedding', 'workshop'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $desc  = $_POST['description'];
    $price = $_POST['price'];
    $type  = $_POST['type'];

    // insert product TANPA image
    $stmt = $pdo->prepare(
        "INSERT INTO products (name, description, price, type)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$name, $desc, $price, $type]);

    $product_id = $pdo->lastInsertId();

    // upload multiple images
    foreach ($_FILES['images']['name'] as $i => $imgName) {
        if ($_FILES['images']['error'][$i] === 0) {
            $tmp  = $_FILES['images']['tmp_name'][$i];
            $file = time().'_'.$imgName;
            $path = "../img/pr/".$file;

            move_uploaded_file($tmp, $path);

            $stmt = $pdo->prepare(
                "INSERT INTO product_images (product_id, image, is_primary)
                 VALUES (?, ?, ?)"
            );
            $stmt->execute([
                $product_id,
                "img/pr/".$file,
                $i === 0 ? 1 : 0 // gambar pertama = utama
            ]);
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
  <link rel="stylesheet" href="admin.css">
</head>
<body>
<h2>Add Product</h2>

<form method="post" enctype="multipart/form-data">
<div class="form-container">
<div class="card">
  <label>Name</label>
  <input type="text" name="name" required>

  <label>Description</label>
  <textarea name="description"></textarea>

  <label>Price</label>
  <input type="number" name="price" required>

  <label>Category</label>
  <select name="type" required>
    <?php foreach ($types as $t): ?>
      <option value="<?= $t ?>"><?= ucfirst($t) ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Add Product</button>
</div>

<div class="card">
  <h3>Images</h3>
  <input type="file" name="images[]" multiple accept="image/*" required>
</div>
</div>
</form>
</body>
</html>
