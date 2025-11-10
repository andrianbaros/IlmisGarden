    <?php
    require '../conn/db.php';

    $message = '';
    $messageClass = 'admin-message';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? 0;
        $description = $_POST['description'] ?? '';
        $image = $_FILES['image'] ?? null;
        if ($name && $price && $description && $image && $image['error'] === 0) {
            $targetDir = 'uploads/';
            $imageName = basename($image['name']);
            $targetFile = $targetDir . $imageName;
            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                $stmt = $pdo->prepare("INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)");
                if ($stmt->execute([$name, $price, $imageName, $description])) {
                    $message = "Produk berhasil ditambahkan!";
                } else {
                    $errorInfo = $stmt->errorInfo();
                    $message = "Gagal menyimpan produk: " . $errorInfo[2];
                }
            } else {
                $message = "Gagal mengupload gambar.";
            }
        } else {
            $message = "Mohon isi semua data dengan benar.";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
    <meta charset="UTF-8" />
    <title>Admin - Tambah Produk</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="../img/F4F6F4-full.png" />
    </head>
    <body>
    <div class="admin-container">
        <h1>Tambah Produk Baru</h1>
        <?php if ($message): ?>
        <div class="<?= $messageClass ?>">
            <?= htmlspecialchars($message) ?>
        </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
        <label for="name">Nama Produk:
            <input type="text" id="name" name="name" required />
        </label>
        <label for="price">Harga Produk:
            <input type="number" id="price" name="price" required min="0" />
        </label>
        <label for="description">Deskripsi Produk:
            <textarea id="description" name="description" rows="4" style="width:100%; padding:8px; border-radius:6px; border:1px solid #ccc; font-size:14px;"></textarea>
        </label>
        <label for="image">Gambar Produk:
            <input type="file" id="image" name="image" accept="image/*" required />
        </label>
        <button type="submit">Tambah Produk</button>
        </form>
    </div>
    </body>
    </html>