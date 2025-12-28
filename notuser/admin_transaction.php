<?php
session_start();
require '../conn/db.php';

// Pastikan admin login
if (!isset($_SESSION['is_admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Helper format WhatsApp
function formatWA($number) {
    $number = preg_replace('/[^0-9]/', '', $number);
    if (substr($number, 0, 1) === '0') {
        $number = '62' . substr($number, 1);
    }
    return $number;
}

// Filter status
$status_filter = $_GET['status'] ?? 'all';

// Hapus transaksi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_transaction'])) {
    $id_transaction = (int)$_POST['id_transaction'];

    $pdo->prepare("DELETE FROM transaction_items WHERE transaction_id=?")->execute([$id_transaction]);
    $pdo->prepare("DELETE FROM transactions WHERE id_transaction=?")->execute([$id_transaction]);

    header("Location: admin_transaction.php?msg=deleted");
    exit;
}

// Update status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id_transaction = $_POST['id_transaction'];
    $new_status     = $_POST['status'];

    $pdo->prepare("UPDATE transactions SET status = ? WHERE id_transaction = ?")
        ->execute([$new_status, $id_transaction]);

    header("Location: admin_transaction.php?msg=updated");
    exit;
}

// Query transaksi + WA user
$sql = "
    SELECT 
        t.id_transaction, 
        t.total_items, 
        t.subtotal, 
        t.status, 
        t.created_at,
        u.username, 
        u.email, 
        u.whatsapp,
        u.address,
        GROUP_CONCAT(p.name, ' (x', ti.qty, ')') AS items
    FROM transactions t
    JOIN users u ON t.user_id = u.id_user
    JOIN transaction_items ti ON t.id_transaction = ti.transaction_id
    JOIN products p ON ti.product_id = p.id
    GROUP BY t.id_transaction
    ORDER BY t.created_at DESC
";

$transactions = $pdo->query($sql)->fetchAll();
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

<nav class="navbar">
  <a href="dashboard.php">
    <img src="../img/F4F6F4-full.png" alt="IlmisGarden">
  </a>
  <div class="navbar-nav">
    <a href="dashboard.php">Dashboard</a>
    <a href="admin_transaction.php" class="active">Order</a>
    <a href="product.php">Product</a>
  </div>
</nav>

<div class="container" style="margin:100px auto;">
<h2>Order List</h2>

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
$filtered = array_filter($transactions, function($t) use ($status_filter) {
    return $status_filter == 'all' || $t['status'] == $status_filter;
});


if (empty($filtered)): ?>
<tr>
  <td colspan="5" class="empty">There's No Order Yet</td>
</tr>
<?php else:
foreach ($filtered as $t):

$wa = formatWA($t['whatsapp']);

if ($t['status'] == 'belum diproses') {
    $msg = 'Halo '.$t['username'].', pesanan Anda sudah kami terima 😊';
} elseif ($t['status'] == 'diproses') {
    $msg = 'Halo '.$t['username'].', pesanan Anda sedang diproses 🌸';
} elseif ($t['status'] == 'selesai') {
    $msg = 'Halo '.$t['username'].', pesanan Anda sudah dikirim 🚚';
} else {
    $msg = 'Halo '.$t['username'];
}

?>

<tr>
<td>
  <strong><?= htmlspecialchars($t['username']) ?></strong><br>
  <small><?= htmlspecialchars($t['email']) ?></small><br>

<a href="https://wa.me/<?= $wa ?>?text=<?= urlencode($msg) ?>"
   target="_blank"
   style="color:#25D366;font-weight:600;text-decoration:none;">
   📞 <?= htmlspecialchars($wa) ?>
</a>
<br>

  <em style="color:#555;font-size:13px;">
    📍 <?= htmlspecialchars($t['address']) ?>
  </em>
</td>

<td><?= htmlspecialchars($t['items']) ?></td>
<td><?= $t['total_items'] ?></td>
<td><span class="status <?= $t['status'] ?>"><?= ucfirst($t['status']) ?></span></td>

<td>
<form method="POST" style="display:inline-block;">
  <input type="hidden" name="id_transaction" value="<?= $t['id_transaction'] ?>">
  <select name="status">
    <option value="belum diproses" <?= $t['status']=='belum diproses'?'selected':'' ?>>Belum Diproses</option>
    <option value="diproses" <?= $t['status']=='diproses'?'selected':'' ?>>Diproses</option>
    <option value="selesai" <?= $t['status']=='selesai'?'selected':'' ?>>Selesai</option>
  </select>
  <button type="submit" name="update_status">Update</button>
</form>

<form method="POST" style="display:inline-block;"
      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
  <input type="hidden" name="id_transaction" value="<?= $t['id_transaction'] ?>">
  <button type="submit" name="delete_transaction" class="delete-btn">Delete</button>
</form>
</td>
</tr>

<?php endforeach; endif; ?>
</tbody>
</table>
</div>
</body>
</html>
