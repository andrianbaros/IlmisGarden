<?php
session_start();
require 'conn/db.php';

// User ID opsional, hanya dipakai jika add_to_cart
$user_id = $_SESSION['id_user'] ?? null;

// Pastikan ada ID produk
if (!isset($_GET['id'])) {
    header("Location: shop.php");
    exit;
}

$id = (int)$_GET['id'];

// Ambil data produk
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}

// Tambah ke keranjang (HARUS LOGIN)
if (isset($_POST['add_to_cart'])) {
    if (!$user_id) {
        header("Location: signin.php");
        exit;
    }

    $qty = (int)$_POST['qty'];
    if ($qty < 1) $qty = 1;

    $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id=? AND product_id=?");
    $stmt->execute([$user_id, $id]);
    $cartItem = $stmt->fetch();

    if ($cartItem) {
        $stmt = $pdo->prepare("UPDATE cart SET qty = qty + ? WHERE id_cart = ?");
        $stmt->execute([$qty, $cartItem['id_cart']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, qty) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $id, $qty]);
    }

    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ilmisgarden</title>
      <link rel="icon" href="img/F4F6F4-full.png" />

    <!-- Fonts -->
    <!-- 1. Preconnect ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- 2. Preload stylesheet Google Fonts -->
    <link
      rel="preload"
      as="style"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />

    <!-- 3. Load stylesheet font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />

    <!-- 4. Fallback untuk browser lama / tanpa JavaScript -->
    <noscript>
      <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet"
      />
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
      />
    </noscript>

    <!-- Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/detail.css" />

</head>
<body >
<!-- Navbar Start -->
    <nav class="navbar">

      <a href="index.php" class="navbar-logo">
  <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
</a>

      
      <div class="navbar-nav">
        <a href="product.php">Product</a>
        <a href="index.php#catalog">Catalog</a>
        <a href="index.php#about">About Us</a>
      </div>
      <div class="navbar-extra">
        
      <?php if (isset($_SESSION['id_user'])): ?>
        <span style="margin-right:20px;">
          Hello, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
        </span>
        <a href="logout.php"><i data-feather="log-out"></i></a>
      <?php else: ?>
        <a href="signin.php"><i data-feather="log-in"></i></a>
      <?php endif; ?>

        <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>

      </div>
    </nav>
    <!-- Navbar End -->


<main>
  <div class="product-detail">
    <div>
      <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
    </div>
    <div class="product-info">
      <h1><?= htmlspecialchars($product['name']) ?></h1>
      <span class="product-price">Rp. <?= number_format($product['price'], 0, ',', '.') ?></span>
      
      <!-- Form tambah ke keranjang -->
      <form method="POST">
        <div class="qty-box">
          <label for="qty">Qty</label>
          <input type="number" id="qty" name="qty" value="1" min="1" style="width:70px;">
        </div>
        <button type="submit" name="add_to_cart" class="buy-button">Buy</button>
      </form>

      <div class="desc-box">
        <h3>Description</h3>
        <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
      </div>
    </div>
  </div>
</main>
</script>
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>
