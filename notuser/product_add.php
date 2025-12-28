<?php
require '../conn/db.php';

$types = ['flower', 'wedding', 'workshop'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmt = $pdo->prepare(
        "INSERT INTO products (name, description, price, type)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['type']
    ]);

    $product_id = $pdo->lastInsertId();

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
/* RESET */
* { box-sizing: border-box; margin:0; padding:0; }

/* BODY */
body {
  font-family: "Inter", sans-serif;
  background:#f4f6f4;
  padding:32px;
  color:#111;
}

/* TITLE */
h2 { font-size:22px; margin-bottom:24px; }
h3 { font-size:15px; margin-bottom:12px; }

/* LAYOUT */
.form-container {
  max-width:1100px;
  margin:auto;
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:24px;
  align-items:start;
}

/* CARD */
.card {
  background:#fff;
  padding:20px;
  border-radius:14px;
  box-shadow:0 6px 20px rgba(0,0,0,.06);
}

/* FORM */
label {
  display:block;
  margin-top:14px;
  font-weight:600;
  font-size:13px;
}

input, textarea, select {
  width:100%;
  margin-top:6px;
  padding:10px;
  border-radius:8px;
  border:1px solid #c5cec7;
  font-size:13px;
}

textarea { min-height:100px; resize:vertical; }

input:focus, textarea:focus, select:focus {
  outline:none;
  border-color:#4a6652;
}

/* GRID */
.form-grid {
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:14px;
  margin-top:10px;
}

/* ACTIONS */
.form-actions {
  margin-top:22px;
  display:flex;
  gap:12px;
}

button {
  background:#708871;
  color:#fff;
  border:none;
  padding:10px 18px;
  border-radius:8px;
  font-size:13px;
  cursor:pointer;
}

button:hover { background:#4a6652; }

.form-actions a {
  background:#ddd;
  padding:10px 18px;
  border-radius:8px;
  text-decoration:none;
  color:#333;
  font-size:13px;
}

/* IMAGE CARD */
.image-card {
  align-self:start;
}

.image-card input[type=file] {
  margin-top:6px;
  font-size:13px;
}

.image-note {
  font-size:12px;
  color:#666;
  margin-top:6px;
}

/* RESPONSIVE */
@media (max-width:900px) {
  .form-container { grid-template-columns:1fr; }
}
</style>

</head>
<body>

<h2>Add Product</h2>

<form method="post" enctype="multipart/form-data">
  <div class="form-container">

    <!-- LEFT -->
    <div class="card">
      <h3>Basic Information</h3>

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
          <label>Category</label>
          <select name="type" required>
            <?php foreach ($types as $t): ?>
              <option value="<?= $t ?>"><?= ucfirst($t) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit">Add Product</button>
        <a href="product.php">Cancel</a>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="card image-card">
      <h3>Images</h3>
      <input type="file" name="images[]" multiple accept="image/*" required>
      <div class="image-note">• Gambar pertama otomatis jadi utama</div>
    </div>

  </div>
</form>

</body>
</html>
