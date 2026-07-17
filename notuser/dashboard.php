<?php
session_start();
require '../conn/db.php';

// pastikan admin login
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

// inisialisasi variabel
$total_sales = 0;
$total_orders = 0;
$new_orders = 0;
$to_process = 0;
$processed  = 0;
$completed  = 0;

// === Hitung ringkasan data ===
$stmt = $pdo->query("SELECT COALESCE(SUM(subtotal),0) AS sales, COUNT(*) AS orders FROM transactions");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_sales  = $row['sales'] ?? 0;
$total_orders = $row['orders'] ?? 0;

$stmt = $pdo->prepare("SELECT COUNT(*) FROM transactions WHERE status = 'belum diproses'");
$stmt->execute();
$new_orders = (int) $stmt->fetchColumn();

$stmt = $pdo->query("SELECT status, COUNT(*) as cnt FROM transactions GROUP BY status");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($r['status'] === 'belum diproses') $to_process = $r['cnt'];
    if ($r['status'] === 'diproses') $processed = $r['cnt'];
    if ($r['status'] === 'selesai') $completed = $r['cnt'];
}

// === Data grafik per bulan ===
$chart_labels = [];
$chart_orders = [];
$chart_sales  = [];

$sql = "SELECT DATE_FORMAT(created_at, '%Y-%m') as ym, 
               COUNT(*) as orders, 
               SUM(subtotal) as sales
        FROM transactions
        GROUP BY ym
        ORDER BY ym ASC";
$stmt = $pdo->query($sql);
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $chart_labels[] = $r['ym'];
    $chart_orders[] = (int)$r['orders'];
    $chart_sales[]  = (int)$r['sales'];
}

// === Catalog & Campaign stats ===
$total_products = (int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_campaign_visits = (int)$pdo->query("SELECT COUNT(*) FROM campaign_visits")->fetchColumn();
$total_discounts_given = (int)$pdo->query("SELECT COALESCE(SUM(discount), 0) FROM transactions")->fetchColumn();

// === Recent Transactions (Last 5) ===
$recent_orders = $pdo->query("
    SELECT t.id_transaction, t.subtotal, t.status, t.created_at, u.username
    FROM transactions t
    LEFT JOIN users u ON t.user_id = u.id_user
    ORDER BY t.created_at DESC
    LIMIT 5
")->fetchAll();

// === Top Selling Products (Last 4) ===
$top_products = $pdo->query("
    SELECT p.name, SUM(ti.qty) as total_qty, p.price,
           (
             SELECT pi.image
             FROM product_images pi
             WHERE pi.product_id = p.id
             ORDER BY pi.is_primary DESC, pi.id ASC
             LIMIT 1
           ) AS main_image
    FROM transaction_items ti
    JOIN products p ON ti.product_id = p.id
    GROUP BY ti.product_id
    ORDER BY total_qty DESC
    LIMIT 4
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard — IlmisGarden Admin</title>
  <link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
  <link rel="icon" href="../img/F4F6F4-full.png" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
$page_id = 'dashboard';
$page_title = 'Dashboard';
include 'admin_layout.php';
?>

<!-- KPI Stats -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-card__icon green">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
    </div>
    <span class="stat-card__label">Total Sales</span>
    <span class="stat-card__value">Rp <?= number_format((int)$total_sales,0,',','.') ?></span>
  </div>
  <div class="stat-card">
    <div class="stat-card__icon blue">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
    </div>
    <span class="stat-card__label">Total Orders</span>
    <span class="stat-card__value"><?= (int)$total_orders ?></span>
  </div>
  <div class="stat-card">
    <div class="stat-card__icon amber">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    </div>
    <span class="stat-card__label">New Orders</span>
    <span class="stat-card__value"><?= (int)$new_orders ?></span>
  </div>
  <div class="stat-card">
    <div class="stat-card__icon green">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <span class="stat-card__label">Completed</span>
    <span class="stat-card__value"><?= (int)$completed ?></span>
  </div>
</div>

<!-- Chart + Orders Breakdown -->
<div class="grid grid-2-1" style="margin-bottom: 20px;">
  <div class="card">
    <h3 class="card__title">Sales & Orders Trend</h3>
    <canvas id="orderChart" height="140"></canvas>
  </div>

  <div class="card">
    <h3 class="card__title">Order Status</h3>
    <div style="display:flex;flex-direction:column;gap:14px;margin-top:8px;">
      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px;background:var(--warning-bg);border-radius:10px;">
        <span style="font-size:0.82rem;font-weight:500;color:#92400e;">Waiting</span>
        <span style="font-size:1.3rem;font-weight:700;color:#92400e;"><?= (int)$to_process ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px;background:var(--info-bg);border-radius:10px;">
        <span style="font-size:0.82rem;font-weight:500;color:#1e40af;">Processing</span>
        <span style="font-size:1.3rem;font-weight:700;color:#1e40af;"><?= (int)$processed ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;align-items:center;padding:14px;background:var(--success-bg);border-radius:10px;">
        <span style="font-size:0.82rem;font-weight:500;color:#166534;">Completed</span>
        <span style="font-size:1.3rem;font-weight:700;color:#166534;"><?= (int)$completed ?></span>
      </div>
    </div>
  </div>
</div>

<!-- Campaign & Catalog Metrics -->
<div class="grid grid-3" style="margin-bottom: 20px;">
  <div class="card" style="display: flex; align-items: center; gap: 16px; padding: 18px;">
    <div style="background: var(--info-bg); color: var(--info); width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
    </div>
    <div>
      <span class="small" style="display: block; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; color: var(--muted);">Catalog Products</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);"><?= $total_products ?> items</span>
    </div>
  </div>
  
  <div class="card" style="display: flex; align-items: center; gap: 16px; padding: 18px;">
    <div style="background: var(--warning-bg); color: var(--warning); width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="3" y="10" width="18" height="12" rx="2" ry="2"></rect><path d="M7 10V7a5 5 0 0 1 10 0v3"></path></svg>
    </div>
    <div>
      <span class="small" style="display: block; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; color: var(--muted);">Campaign QR Scans</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);"><?= $total_campaign_visits ?> scans</span>
    </div>
  </div>

  <div class="card" style="display: flex; align-items: center; gap: 16px; padding: 18px;">
    <div style="background: var(--success-bg); color: var(--success); width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
    </div>
    <div>
      <span class="small" style="display: block; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; color: var(--muted);">Campaign Discounts</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);">Rp <?= number_format($total_discounts_given, 0, ',', '.') ?></span>
    </div>
  </div>
</div>

<!-- Recent Orders & Top Selling Products -->
<div class="grid grid-2-1" style="margin-bottom: 20px;">
  <!-- Recent Orders Table -->
  <div class="card" style="overflow-x: auto; padding-bottom: 12px;">
    <h3 class="card__title" style="margin-bottom: 12px;">Recent Orders</h3>
    <table class="transaction-table" style="margin-top: 0; box-shadow: none; border: none;">
      <thead>
        <tr>
          <th>Customer</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recent_orders)): ?>
          <tr>
            <td colspan="4" class="empty">No recent orders yet</td>
          </tr>
        <?php else: ?>
          <?php foreach ($recent_orders as $ro): ?>
            <tr>
              <td><strong style="color: var(--charcoal);"><?= htmlspecialchars($ro['username'] ?? 'Guest / Deleted User') ?></strong></td>
              <td>Rp <?= number_format($ro['subtotal'], 0, ',', '.') ?></td>
              <td><span class="status <?= $ro['status'] ?>"><?= ucfirst($ro['status']) ?></span></td>
              <td><span style="font-size: 0.8rem; color: var(--muted);"><?= date('d M Y', strtotime($ro['created_at'])) ?></span></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
    <div style="margin-top: 14px; text-align: left;">
      <a href="admin_transaction.php" style="font-size: 0.82rem; color: var(--sage-dark); font-weight: 600; display: inline-flex; align-items: center; gap: 4px; text-decoration: none;">
        View all orders
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
      </a>
    </div>
  </div>

  <!-- Top Selling Products -->
  <div class="card">
    <h3 class="card__title" style="margin-bottom: 16px;">Top Selling Products</h3>
    <div style="display: flex; flex-direction: column; gap: 14px;">
      <?php if (empty($top_products)): ?>
        <p style="font-size: 0.85rem; color: var(--muted); text-align: center; padding: 20px 0;">No sales recorded yet</p>
      <?php else: ?>
        <?php foreach ($top_products as $tp): ?>
          <div style="display: flex; align-items: center; gap: 12px;">
            <?php
              $tp_img = $tp['main_image'] ? "../".$tp['main_image'] : "../img/no-image.png";
            ?>
            <img src="<?= htmlspecialchars($tp_img) ?>" alt="<?= htmlspecialchars($tp['name']) ?>" style="width: 44px; height: 44px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
            <div style="flex-grow: 1; min-width: 0;">
              <span style="display: block; font-size: 0.85rem; font-weight: 600; color: var(--charcoal); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= htmlspecialchars($tp['name']) ?></span>
              <span style="font-size: 0.78rem; color: var(--muted);"><?= $tp['total_qty'] ?> sold</span>
            </div>
            <div style="font-weight: 600; font-size: 0.85rem; color: var(--charcoal);">
              Rp <?= number_format($tp['price'], 0, ',', '.') ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="footer">Last update: <?= date('d M Y, H:i') ?></div>

<?php include 'admin_layout_end.php'; ?>

<script>
const ctx = document.getElementById('orderChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_labels) ?>,
        datasets: [
            {
                label: 'Orders',
                data: <?= json_encode($chart_orders) ?>,
                borderColor: '#283128',
                backgroundColor: 'rgba(40,49,40,0.06)',
                yAxisID: 'y',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#283128'
            },
            {
                label: 'Sales (Rp)',
                data: <?= json_encode($chart_sales) ?>,
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.06)',
                yAxisID: 'y1',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#22c55e'
            }
        ]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        plugins: {
          legend: {
            position: 'top',
            labels: { 
              usePointStyle: true, 
              pointStyle: 'circle',
              padding: 20,
              font: { family: 'Inter', size: 12 }
            }
          }
        },
        scales: {
            y:  { type: 'linear', position: 'left',  beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 11 } } },
            y1: { type: 'linear', position: 'right', beginAtZero: true, grid: { drawOnChartArea: false },    ticks: { font: { size: 11 } } },
            x:  { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>
