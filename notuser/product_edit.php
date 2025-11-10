<?php
require '../conn/db.php'; // koneksi PDO

// daftar kategori/type (bisa diubah sesuai kebutuhan)
$types = ['flower', 'wedding', 'workshop'];

$id = $_GET['id'] ?? null;
if (!$id) die("Product ID required");

// ambil data
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) die("Product not found");

// update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $_POST['name'];
    $desc  = $_POST['description'];
    $price = $_POST['price'];
    $type  = $_POST['type'];

    // cek apakah ada gambar baru
    $imagePath = $product['image']; // default gambar lama
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../img/pr/";
        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = "img/pr/" . $fileName;
        }
    }

    $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, type=?, image=? WHERE id=?");
    $stmt->execute([$name, $desc, $price, $type, $imagePath, $id]);

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
  <link rel="icon" href="img/F4F6F4-full.png" />
</head>
<body>
  <h2>Edit Product</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="form-container">
      <div class="card">
        <h3>Basic Information</h3>
        <div class="form-group">
          <label>Product Name</label>
          <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="form-group">
          <label>Description</label>
          <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" value="<?= $product['price'] ?>" required>
          </div>
          <div class="form-group">
            <label>Category (type)</label>
            <select name="type" required>
              <option value="">-- Select Category --</option>
              <?php foreach ($types as $t): ?>
                <option value="<?= $t ?>" <?= $product['type'] == $t ? 'selected' : '' ?>>
                  <?= ucfirst($t) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <button type="submit" class="btn">Update Product</button>
        <a href="product.php" ><button class="btn cancel">Cancel</button></a>
      </div>

      <div class="card image-upload">
        <h3>Image</h3>
        <?php if ($product['image']): ?>
          <img src="../<?= htmlspecialchars($product['image']) ?>" width="120" style="margin-bottom:10px;border-radius:6px;">
        <?php endif; ?>
        <input type="file" name="image" accept="image/*">
      </div>
    </div>
  </form>
</body>
</html>
