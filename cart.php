<?php
session_start();
require 'conn/db.php';
// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// ==================== Jika user baru klik BUY ====================
if (isset($_GET['buy']) && $_GET['buy'] == 1) {
    // Ambil cart user
    $stmt = $pdo->prepare("SELECT c.qty, p.id AS product_id, p.price 
                           FROM cart c 
                           JOIN products p ON c.product_id = p.id 
                           WHERE c.user_id=?");
    $stmt->execute([$user_id]);
    $items = $stmt->fetchAll();

    if (!empty($items)) {
        // Hitung total
        $totalItem = 0;
        $subtotal  = 0;
        foreach ($items as $i) {
            $totalItem += $i['qty'];
            $subtotal  += $i['price'] * $i['qty'];
        }

        // Simpan transaksi ke tabel transactions
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO transactions (user_id, total_items, subtotal, status) VALUES (?, ?, ?, 'belum diproses')");
            $stmt->execute([$user_id, $totalItem, $subtotal]);
            $transactionId = $pdo->lastInsertId();

            // Simpan detail item
            $stmtItem = $pdo->prepare("INSERT INTO transaction_items (transaction_id, product_id, qty, price) VALUES (?, ?, ?, ?)");
            foreach ($items as $i) {
                $stmtItem->execute([$transactionId, $i['product_id'], $i['qty'], $i['price']]);
            }

            // Hapus cart
            $del = $pdo->prepare("DELETE FROM cart WHERE user_id=?");
            $del->execute([$user_id]);

            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            die("Error transaksi: " . $e->getMessage());
        }
    }

    // Redirect WA
    $msg = urlencode($_GET['msg'] ?? "");
    header("Location: https://wa.me/6285795077194?text=$msg");
    exit;
}


// ==================== Ambil cart dari DB ====================
$stmt = $pdo->prepare("SELECT c.id_cart AS cart_id, c.qty, p.id AS product_id, p.name, p.price, p.image 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.id 
                       WHERE c.user_id=?");
$stmt->execute([$user_id]);
$cart = $stmt->fetchAll();

// Hitung total
$totalItem = 0;
$subtotal  = 0;
foreach ($cart as $c) {
    $totalItem += $c['qty'];
    $subtotal  += $c['price'] * $c['qty'];
}

// ==================== Generate Pesan WhatsApp ====================
$message = "Halo, saya ingin membeli produk berikut:\n";
foreach ($cart as $c) {
    $message .= "- " . $c['name'] . " (x" . $c['qty'] . ") : Rp. " . number_format($c['price'] * $c['qty'], 0, ',', '.') . "\n";
}
$message .= "\nTotal Item: $totalItem\n";
$message .= "Subtotal: Rp. " . number_format($subtotal, 0, ',', '.');

$waText = urlencode($message);

// Link untuk BUY (trigger hapus cart + redirect WA)
$buyLink = "cart.php?buy=1&msg=" . $waText;
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
  <link rel="stylesheet" href="css/cart.css" />

</head>
<body >
<!-- Navbar Start -->
    <nav class="navbar">
  
      <a href="index.php" class="navbar-logo">
  <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
</a>

      
      <div class="navbar-nav">
        <a href="product.php">Product</a>
        <a href="index.php#workshop">Workshop</a>
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

<div class="cart-container">
  <!-- Kiri: daftar produk -->
  <div class="cart-list">
    <?php if (empty($cart)): ?>
      <p>Your Shoppiing Car is Empty<br>
 <a href="shop.php">Find Your Bloom!</a></p>
    <?php else: ?>
      <?php foreach ($cart as $c): ?>
        <div class="cart-item">
          <div class="cart-left">
            <input type="checkbox" checked>
            <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
            <span class="cart-name"><?= htmlspecialchars($c['name']) ?></span>
          </div>
          <div class="cart-right">
            <span class="cart-price">Rp. <?= number_format($c['price'], 0, ',', '.') ?></span>
            <form method="post" action="remove_cart.php" style="display:inline;">
              <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
              <button class="delete-btn">🗑</button>
            </form>
            <div class="qty-control">
              <form method="post" action="update_cart.php">
                <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
                <button name="action" value="minus">-</button>
                <input type="text" value="<?= $c['qty'] ?>" readonly>
                <button name="action" value="plus">+</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Kanan: ringkasan pesanan -->
  <div class="order-summary">
    <h3>Order</h3>
    <?php foreach ($cart as $c): ?>
      <div class="summary-item">
        <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>">
        <span><?= htmlspecialchars($c['name']) ?></span>
        <span>Rp. <?= number_format($c['price'], 0, ',', '.') ?></span>
      </div>
    <?php endforeach; ?>
    <div class="summary-footer">
      <div class="row">
        <span>Total Item</span><span><?= $totalItem ?></span>
      </div>
      <div class="row">
        <span>Subtotal</span><span>Rp. <?= number_format($subtotal, 0, ',', '.') ?></span>
      </div>
      <?php if (!empty($cart)): ?>
        <a href="<?= $buyLink ?>" X"><button class="checkout-btn">BUY</button></a>
      <?php endif; ?>
    </div>
  </div>
</div>
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>
