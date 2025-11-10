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
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Inter, sans-serif; background:#f4f6f4; margin:0; padding:24px; color:#222; }
    .wrap{ max-width:1100px; margin:100px auto }
    .panel{ background:#fff; padding:18px; border-radius:10px; box-shadow:0 6px 18px rgba(0,0,0,0.06) }
    h1{ margin:0 0 18px; font-size:20px }
    .grid{ display:grid; grid-template-columns:2fr 1fr; gap:18px; margin-bottom:18px }
    .card{ padding:18px; border-radius:8px; border:1px solid rgba(0,0,0,0.06); background:#fff }
    .card h3{ margin:0 0 8px; font-size:14px; color:#333 }
    .stat-row{ display:flex; gap:12px; align-items:stretch }
    .stat{ flex:1; background:#fafbf9; padding:12px; border-radius:8px; border:1px solid rgba(0,0,0,0.04); text-align:center }
    .stat .num{ display:block; font-size:20px; font-weight:700; color:#283128 }
    .small{ font-size:13px; color:#777 }
    .need-list{ display:flex; gap:12px; flex-wrap:wrap }
    .need-item{ flex:1; padding:12px; border-radius:8px; border:1px solid rgba(0,0,0,0.04); background:#fff }
    .footer {margin-top:12px;text-align:right;font-size:13px;color:#777}
    @media(max-width:900px){.grid{grid-template-columns:1fr}}
  </style>
  <link rel="stylesheet" href="../css/navbar.css">
  <link rel="icon" href="../img/F4F6F4-full.png" />
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
  <div class="wrap">
    <div class="panel">
      <h1>Dashboard</h1>

      <div class="grid">
        <!-- Grafik -->
        <div class="card">
          <h3>Statistic Graphic</h3>
          <canvas id="orderChart" height="120"></canvas>
        </div>

        <!-- Performance -->
        <div class="card">
          <h3>Performance</h3>
          <div class="stat-row" style="margin-top:12px">
            <div class="stat">
              <span class="num">Rp <?= number_format((int)$total_sales,0,',','.') ?></span>
              <span class="small">Sale</span>
            </div>
            <div class="stat">
              <span class="num"><?= (int)$total_orders ?></span>
              <span class="small">Order</span>
            </div>
          </div>
        </div>
      </div>

      <div class="grid" style="grid-template-columns:1fr 1fr">
        <!-- System Notification -->
        <div class="card">
          <h3>System Notification</h3>
          <div class="stat-row" style="margin-top:12px">
            <div class="stat">
              <span class="num"><?= (int)$new_orders ?></span>
              <span class="small">New Order</span>
            </div>
          </div>
        </div>

        <!-- Need To Be Done -->
        <div class="card">
          <h3>Need To Be Done</h3>
          <div class="need-list" style="margin-top:12px">
            <div class="need-item">
              <div class="small">Order Need To Be Process</div>
              <div style="font-size:18px;font-weight:700;color:#283128"><?= (int)$to_process ?></div>
            </div>
            <div class="need-item">
              <div class="small">Order Has Been Processed</div>
              <div style="font-size:18px;font-weight:700;color:#283128"><?= (int)$processed ?></div>
            </div>
            <div class="need-item">
              <div class="small">Order Completed</div>
              <div style="font-size:18px;font-weight:700;color:#283128"><?= (int)$completed ?></div>
            </div>
          </div>
        </div>
      </div>

      <div class="footer">Last update: <?= date('Y-m-d H:i:s') ?></div>
    </div>
  </div>

<script>
const ctx = document.getElementById('orderChart').getContext('2d');
const orderChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_labels) ?>,
        datasets: [
            {
                label: 'Orders',
                data: <?= json_encode($chart_orders) ?>,
                borderColor: '#283128',
                backgroundColor: 'rgba(40,49,40,0.1)',
                yAxisID: 'y',
                tension: 0.3,
                fill: true
            },
            {
                label: 'Sales (Rp)',
                data: <?= json_encode($chart_sales) ?>,
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76,175,80,0.1)',
                yAxisID: 'y1',
                tension: 0.3,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        stacked: false,
        plugins: { legend: { position: 'top' } },
        scales: {
            y: { type: 'linear', position: 'left', beginAtZero:true, title:{display:true,text:'Orders'} },
            y1:{ type:'linear', position:'right', beginAtZero:true, grid:{drawOnChartArea:false}, title:{display:true,text:'Sales (Rp)'} }
        }
    }
});
</script>

</body>
</html>
