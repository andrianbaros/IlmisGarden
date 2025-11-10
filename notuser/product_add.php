<?php
require '../conn/db.php'; // koneksi PDO

// daftar kategori/type (bisa diubah sesuai kebutuhan)
$types = ['flower', 'wedding', 'workshop'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $desc  = $_POST['description'];
    $price = $_POST['price'];
    $type  = $_POST['type'];

    // upload gambar
    $imagePath = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../img/pr/";
        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = "img/pr/" . $fileName; // path disimpan di DB
        }
    }

    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, type, image) 
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $desc, $price, $type, $imagePath]);

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
  <link rel="icon" href="../img/F4F6F4-full.png" />
</head>
<body>
  <h2>Add Product</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="form-container">
      <div class="card">
        <h3>Basic Information</h3>
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" name="name" required>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description"></textarea>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" required>
          </div>
          <div class="form-group">
            <label>Category (type)</label>
            <select name="type" required>
              <option value="">-- Select Category --</option>
              <?php foreach ($types as $t): ?>
                <option value="<?= $t ?>"><?= ucfirst($t) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <button type="submit" class="btn">Add Product</button>
        <a href="product.php" ><button class="btn cancel">Cancel</button></a>
      </div>

      <div class="card image-upload">
        <h3>Image</h3>
        <input type="file" name="image" accept="image/*" required>
      </div>
    </div>
  </form>
</body>
</html>
