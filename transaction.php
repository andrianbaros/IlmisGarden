<?php
session_start();
require 'conn/db.php';

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// Ambil data transaksi user
$stmt = $pdo->prepare("
    SELECT t.*, GROUP_CONCAT(p.name, ' (x', ti.qty, ')') AS items
    FROM transactions t
    JOIN transaction_items ti ON t.id_transaction = ti.transaction_id
    JOIN products p ON ti.product_id = p.id
    WHERE t.user_id = ?
    GROUP BY t.id_transaction
    ORDER BY t.created_at DESC
");
$stmt->execute([$user_id]);
$transactions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ilmisgarden - Transactions</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <script src="https://unpkg.com/feather-icons"></script>

  <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/profile.css" />
  <link rel="stylesheet" href="css/transaction.css" />
</head>
<body>
<!-- Navbar Start -->
<nav class="navbar">
  <a href="index.php" class="navbar-logo"><img src="img/F4F6F4-full.png" alt="Logo" /></a>
  <div class="navbar-nav">
    <a href="product.php">Product</a>
    <a href="index.php#workshop">Workshop</a>
    <a href="index.php#catalog">Catalog</a>
    <a href="index.php#about">About Us</a>
  </div>
  <div class="navbar-extra">
    <?php if (isset($_SESSION['id_user'])): ?>
      <span style="margin-right:20px;">
        Hello, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
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

<!-- MAIN -->
<main class="profile-container">
  <div class="tabs">
    <a href="profile.php">Profile</a>
    <a href="transaction.php" class="active">Transaction</a>
    <a href="#">Coupon</a>
    <a href="#">Membership</a>
  </div>

  <h3>Transaction History</h3>
  <?php if (empty($transactions)): ?>
    <p class="alert">Belum ada transaksi.</p>
  <?php else: ?>
    <div class="transaction-list">
      <?php foreach ($transactions as $t): ?>
        <div class="transaction-card">
          <div class="transaction-header">
            <span><b>ID:</b> <?= $t['id_transaction'] ?></span>
            <span class="status <?= $t['status'] ?>"><?= ucfirst($t['status']) ?></span>
          </div>
          <p><b>Items:</b> <?= htmlspecialchars($t['items']) ?></p>
          <p><b>Total Items:</b> <?= $t['total_items'] ?> | <b>Subtotal:</b> Rp <?= number_format($t['subtotal'],0,',','.') ?></p>
          <small><i class="fa fa-clock"></i> <?= $t['created_at'] ?></small>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<script> feather.replace(); </script>
<script src="js/script.js"></script>
</body>
</html>
