<?php
session_start();
require '../conn/db.php';

// Pastikan admin login
if (!isset($_SESSION['is_admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Filter status
$status_filter = $_GET['status'] ?? 'all';

// Query transaksi (join ke users)
$sql = "
    SELECT t.id_transaction, t.total_items, t.subtotal, t.status, t.created_at,
           u.username, u.email,
           GROUP_CONCAT(p.name, ' (x', ti.qty, ')') AS items
    FROM transactions t
    JOIN users u ON t.user_id = u.id_user
    JOIN transaction_items ti ON t.id_transaction = ti.transaction_id
    JOIN products p ON ti.product_id = p.id
    GROUP BY t.id_transaction
    ORDER BY t.created_at DESC
";

$stmt = $pdo->query($sql);
$transactions = $stmt->fetchAll();

// Update status jika ada request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id_transaction = $_POST['id_transaction'];
    $new_status     = $_POST['status'];

    $update = $pdo->prepare("UPDATE transactions SET status = ? WHERE id_transaction = ?");
    $update->execute([$new_status, $id_transaction]);

    header("Location: admin_transaction.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Transactions</title>
  <link rel="stylesheet" href="admin_transaction.css">
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
      <!-- Navbar -->
  <nav class="navbar">
    <!-- Logo -->
    <a href="dashboard.php">
      <img src="../img/F4F6F4-full.png" alt="IlmisGarden">
    </a>

    <!-- Menu -->
    <div class="navbar-nav">
      <a href="dashboard.php" class="active">Dashboard</a>
      <a href="admin_transaction.php">Order</a>
      <a href="product.php">Product</a>
      <!-- <a href="coupon.php"><i data-feather="tag"></i> Coupon</a> -->
      <!-- <a href="membership.php"><i data-feather="users"></i> Membership</a> -->
    </div>

    <!-- Extra (Profile, dll) -->
    <div class="navbar-extra">

      <a href="#" id="menu"><i data-feather="menu"></i></a>
    </div>
  </nav>

  <script>
    feather.replace();

    // Toggle menu untuk responsive
    const navbarNav = document.querySelector('.navbar .navbar-nav');
    document.querySelector('#menu').onclick = () => {
      navbarNav.classList.toggle('active');
    };
  </script>
  <div class="container" style="margin: 100px auto;">
    <h2>My Order</h2>
    <div class="tabs">
      <a href="?status=all" class="<?= $status_filter=='all'?'active':'' ?>">All</a>
      <a href="?status=belum diproses" class="<?= $status_filter=='belum diproses'?'active':'' ?>">Need to Ship</a>
      <a href="?status=diproses" class="<?= $status_filter=='diproses'?'active':'' ?>">Shipment</a>
      <a href="?status=selesai" class="<?= $status_filter=='selesai'?'active':'' ?>">Order Completed</a>
    </div>

    <table class="transaction-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $filtered = array_filter($transactions, function($t) use($status_filter){
          return $status_filter == 'all' || $t['status'] == $status_filter;
      });

      if (empty($filtered)): ?>
        <tr>
          <td colspan="5" class="empty">There's No Order Anymore</td>
        </tr>
      <?php else: 
        foreach ($filtered as $t): ?>
          <tr>
            <td>
              <?= htmlspecialchars($t['username']) ?><br>
              <small><?= htmlspecialchars($t['email']) ?></small>
            </td>
            <td><?= htmlspecialchars($t['items']) ?></td>
            <td><?= $t['total_items'] ?></td>
            <td><span class="status <?= $t['status'] ?>"><?= ucfirst($t['status']) ?></span></td>
            <td>
              <form method="POST" class="status-form">
                <input type="hidden" name="id_transaction" value="<?= $t['id_transaction'] ?>">
                <select name="status">
                  <option value="belum diproses" <?= $t['status']=='belum diproses'?'selected':'' ?>>Belum Diproses</option>
                  <option value="diproses" <?= $t['status']=='diproses'?'selected':'' ?>>Diproses</option>
                  <option value="selesai" <?= $t['status']=='selesai'?'selected':'' ?>>Selesai</option>
                </select>
                <button type="submit" name="update_status">Update</button>
              </form>
            </td>
          </tr>
        <?php endforeach; 
      endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
