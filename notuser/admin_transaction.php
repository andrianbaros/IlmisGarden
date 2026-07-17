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
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_transaction'])) {
    $id_transaction = (int)$_POST['id_transaction'];

    $pdo->prepare("DELETE FROM transaction_items WHERE transaction_id = ?")
        ->execute([$id_transaction]);

    $pdo->prepare("DELETE FROM transactions WHERE id_transaction = ?")
        ->execute([$id_transaction]);

    header("Location: admin_transaction.php?msg=deleted");
    exit;
}

// Update status
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $id_transaction = (int)$_POST['id_transaction'];
    $new_status     = $_POST['status'];

    $pdo->prepare(
        "UPDATE transactions SET status = ? WHERE id_transaction = ?"
    )->execute([$new_status, $id_transaction]);

    header("Location: admin_transaction.php?msg=updated");
    exit;
}

// Query transaksi + data user + timestamp
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
        GROUP_CONCAT(p.name, ' (x', ti.qty, ')' SEPARATOR ', ') AS items
    FROM transactions t
    LEFT JOIN users u ON t.user_id = u.id_user
    LEFT JOIN transaction_items ti ON t.id_transaction = ti.transaction_id
    LEFT JOIN products p ON ti.product_id = p.id
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
<title>Orders — IlmisGarden Admin</title>
<link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
<link rel="icon" href="../img/F4F6F4-full.png" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
$page_id = 'orders';
$page_title = 'Orders';
include 'admin_layout.php';
?>

<div class="tabs">
  <a href="?status=all" class="<?= $status_filter=='all'?'active':'' ?>">All</a>
  <a href="?status=belum diproses" class="<?= $status_filter=='belum diproses'?'active':'' ?>">Waiting</a>
  <a href="?status=diproses" class="<?= $status_filter=='diproses'?'active':'' ?>">Processing</a>
  <a href="?status=selesai" class="<?= $status_filter=='selesai'?'active':'' ?>">Completed</a>
</div>

<table class="transaction-table">
<thead>
<tr>
  <th>Customer</th>
  <th>Items</th>
  <th>Qty</th>
  <th>Date</th>
  <th>Status</th>
  <th>Actions</th>
</tr>
</thead>

<tbody>
<?php
$filtered = array_filter($transactions, function ($t) use ($status_filter) {
    return $status_filter === 'all' || $t['status'] === $status_filter;
});

if (empty($filtered)): ?>
<tr>
  <td colspan="6" class="empty">No orders found</td>
</tr>
<?php else:
foreach ($filtered as $t):

$wa = formatWA($t['whatsapp']);

if ($t['status'] === 'belum diproses') {
    $msg = 'Halo '.$t['username'].', pesanan Anda sudah kami terima.';
} elseif ($t['status'] === 'diproses') {
    $msg = 'Halo '.$t['username'].', pesanan Anda sedang diproses.';
} elseif ($t['status'] === 'selesai') {
    $msg = 'Halo '.$t['username'].', pesanan Anda sudah dikirim.';
} else {
    $msg = 'Halo '.$t['username'];
}
?>

<tr>
<td data-label="Customer">
  <div style="font-weight:600;margin-bottom:2px;"><?= htmlspecialchars($t['username'] ?? 'Guest / Deleted User') ?></div>
  <div style="font-size:0.78rem;color:var(--muted);"><?= htmlspecialchars($t['email'] ?? '-') ?></div>
  <?php if (!empty($wa)): ?>
  <a href="https://wa.me/<?= $wa ?>?text=<?= urlencode($msg) ?>"
     target="_blank"
     style="display:inline-flex;align-items:center;gap:4px;font-size:0.78rem;color:#16a34a;font-weight:500;margin-top:4px;">
     <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="12" height="12" style="vertical-align: middle; margin-right: 2px;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
     <?= htmlspecialchars($wa) ?>
  </a>
  <?php else: ?>
  <span style="font-size:0.78rem;color:var(--muted);">No Phone</span>
  <?php endif; ?>
  <div style="font-size:0.75rem;color:var(--muted);margin-top:2px;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="11" height="11" style="vertical-align: middle; margin-right: 2px; color: var(--muted);"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
    <?= htmlspecialchars($t['address'] ?? '-') ?>
  </div>
</td>

<td data-label="Items" style="max-width:220px;"><?= htmlspecialchars($t['items'] ?? 'No Items') ?></td>

<td data-label="Qty"><?= (int)$t['total_items'] ?></td>

<td data-label="Date">
  <span style="font-size:0.82rem;color:var(--muted);">
    <?= date('d M Y', strtotime($t['created_at'])) ?>
    <br><span style="font-size:0.75rem;"><?= date('H:i', strtotime($t['created_at'])) ?></span>
  </span>
</td>

<td data-label="Status">
  <span class="status <?= $t['status'] ?>">
    <?= ucfirst($t['status']) ?>
  </span>
</td>

<td data-label="Actions">
  <form method="POST" class="status-form" style="display:inline-flex;">
    <input type="hidden" name="id_transaction" value="<?= $t['id_transaction'] ?>">
    <select name="status">
      <option value="belum diproses" <?= $t['status']=='belum diproses'?'selected':'' ?>>Belum Diproses</option>
      <option value="diproses" <?= $t['status']=='diproses'?'selected':'' ?>>Diproses</option>
      <option value="selesai" <?= $t['status']=='selesai'?'selected':'' ?>>Selesai</option>
    </select>
    <button type="submit" name="update_status">Update</button>
  </form>

  <form method="POST" style="display:inline-flex;margin-left:4px;"
        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
    <input type="hidden" name="id_transaction" value="<?= $t['id_transaction'] ?>">
    <button type="submit" name="delete_transaction" class="delete-btn">Delete</button>
  </form>
</td>
</tr>

<?php endforeach; endif; ?>
</tbody>
</table>

<?php include 'admin_layout_end.php'; ?>
