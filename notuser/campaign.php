<?php
session_start();
require '../conn/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

$page_id = 'campaigns';
$page_title = 'Campaign Management';

// Fetch overall campaign stats
$total_scans = (int)$pdo->query("SELECT COUNT(*) FROM campaign_visits")->fetchColumn();
$total_trx = (int)$pdo->query("SELECT COUNT(*) FROM transactions WHERE campaign_id IS NOT NULL OR (campaign IS NOT NULL AND campaign != '')")->fetchColumn();
$total_discount = (int)$pdo->query("SELECT COALESCE(SUM(CASE WHEN discount_amount > 0 THEN discount_amount ELSE discount END), 0) FROM transactions WHERE campaign_id IS NOT NULL OR (campaign IS NOT NULL AND campaign != '')")->fetchColumn();
$total_sales = (int)$pdo->query("SELECT COALESCE(SUM(subtotal), 0) FROM transactions WHERE campaign_id IS NOT NULL OR (campaign IS NOT NULL AND campaign != '')")->fetchColumn();
$conversion_rate = $total_scans > 0 ? round(($total_trx / $total_scans) * 100, 1) : 0;

// Fetch all campaigns with per-campaign metrics
$sql = "
    SELECT c.*,
           (SELECT COUNT(*) FROM campaign_visits cv WHERE cv.campaign_id = c.id OR cv.campaign_code = c.campaign_code) AS scans,
           (SELECT COUNT(*) FROM transactions t WHERE t.campaign_id = c.id OR t.campaign_code = c.campaign_code OR t.campaign = c.campaign_code) AS trx_count,
           (SELECT COALESCE(SUM(CASE WHEN t.discount_amount > 0 THEN t.discount_amount ELSE t.discount END), 0) FROM transactions t WHERE t.campaign_id = c.id OR t.campaign_code = c.campaign_code OR t.campaign = c.campaign_code) AS discount_sum,
           (SELECT COALESCE(SUM(t.subtotal), 0) FROM transactions t WHERE t.campaign_id = c.id OR t.campaign_code = c.campaign_code OR t.campaign = c.campaign_code) AS sales_sum
    FROM campaigns c
    ORDER BY c.created_at DESC
";
$campaigns = $pdo->query($sql)->fetchAll();

// Protocol & host determination for link generation
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$base_domain = $protocol . $host . rtrim(BASE_URL, '/');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Campaign Management — IlmisGarden Admin</title>
  <link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
  <link rel="icon" href="../img/F4F6F4-full.png" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    .metric-card {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 16px;
    }
    .metric-icon {
      width: 44px;
      height: 44px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.4rem;
    }
    .badge-active { background: #dcfce7; color: #166534; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
    .badge-inactive { background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
    
    /* Modal QR */
    .modal-overlay {
      position: fixed; top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.5);
      display: none; align-items: center; justify-content: center;
      z-index: 9999;
    }
    .modal-card {
      background: #fff; border-radius: 12px; padding: 24px; max-width: 400px; width: 90%; text-align: center;
      box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<?php include 'admin_layout.php'; ?>

<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
  <div>
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--charcoal);">Campaign Management</h1>
    <p style="color: var(--muted); font-size: 0.88rem; margin-top: 4px;">Kelola QR Code Marketing & Program Diskon Pelanggan</p>
  </div>
  <a href="campaign_form.php" style="background: var(--sage-dark); color: #fff; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 6px;">
    <i class='bx bx-plus-circle' style="font-size: 1.1rem;"></i> Buat Campaign Baru
  </a>
</div>

<?php if (isset($_SESSION['flash_msg'])): ?>
  <div style="padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; <?= $_SESSION['flash_type'] === 'danger' ? 'background: #fee2e2; color: #991b1b;' : 'background: #dcfce7; color: #166534;' ?>">
    <?= htmlspecialchars($_SESSION['flash_msg']) ?>
  </div>
  <?php unset($_SESSION['flash_msg'], $_SESSION['flash_type']); ?>
<?php endif; ?>

<!-- Summary Analytics Cards -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
  <div class="metric-card">
    <div class="metric-icon" style="background: #e0f2fe; color: #0284c7;"><i class='bx bx-qr-scan'></i></div>
    <div>
      <span style="display: block; font-size: 0.78rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Total Scans</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);"><?= number_format($total_scans) ?></span>
    </div>
  </div>

  <div class="metric-card">
    <div class="metric-icon" style="background: #fef3c7; color: #d97706;"><i class='bx bx-shopping-bag'></i></div>
    <div>
      <span style="display: block; font-size: 0.78rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Total Transaksi</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);"><?= number_format($total_trx) ?></span>
    </div>
  </div>

  <div class="metric-card">
    <div class="metric-icon" style="background: #dcfce7; color: #16a34a;"><i class='bx bx-money'></i></div>
    <div>
      <span style="display: block; font-size: 0.78rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Total Omset</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);">Rp <?= number_format($total_sales, 0, ',', '.') ?></span>
    </div>
  </div>

  <div class="metric-card">
    <div class="metric-icon" style="background: #fae8ff; color: #c026d3;"><i class='bx bx-purchase-tag-alt'></i></div>
    <div>
      <span style="display: block; font-size: 0.78rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Total Diskon</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);">Rp <?= number_format($total_discount, 0, ',', '.') ?></span>
    </div>
  </div>

  <div class="metric-card">
    <div class="metric-icon" style="background: #f1f5f9; color: #475569;"><i class='bx bx-line-chart'></i></div>
    <div>
      <span style="display: block; font-size: 0.78rem; text-transform: uppercase; color: var(--muted); font-weight: 600;">Conversion Rate</span>
      <span style="font-size: 1.3rem; font-weight: 700; color: var(--charcoal);"><?= $conversion_rate ?>%</span>
    </div>
  </div>
</div>

<!-- Campaigns Table -->
<div class="card" style="overflow-x: auto; padding: 20px;">
  <h3 class="card__title" style="margin-bottom: 16px;">Daftar Campaign Aktif & Nonaktif</h3>
  
  <table class="transaction-table" style="box-shadow: none; border: none; font-size: 0.88rem;">
    <thead>
      <tr>
        <th>Campaign</th>
        <th>Diskon</th>
        <th>Status</th>
        <th>Analitik (Scan / Trx / Conv)</th>
        <th>Omset & Diskon Given</th>
        <th>Masa Berlaku</th>
        <th style="text-align: center;">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($campaigns)): ?>
        <tr>
          <td colspan="7" class="empty">Belum ada campaign. Klik "Buat Campaign Baru" untuk memulai.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($campaigns as $c): ?>
          <?php
            $c_url = $base_domain . '/?campaign=' . urlencode($c['campaign_code']) . '&token=' . urlencode($c['campaign_token']);
            $c_conv = $c['scans'] > 0 ? round(($c['trx_count'] / $c['scans']) * 100, 1) : 0;
            $disc_str = $c['discount_type'] === 'percent' ? (float)$c['discount_value'] . '%' : 'Rp ' . number_format($c['discount_value'], 0, ',', '.');
          ?>
          <tr>
            <td>
              <strong style="color: var(--charcoal); font-size: 0.92rem;"><?= htmlspecialchars($c['campaign_name']) ?></strong>
              <div style="font-size: 0.78rem; color: var(--muted); font-family: monospace; margin-top: 2px;">
                Kode: <span style="background: #f3f4f6; padding: 2px 6px; border-radius: 4px; color: #374151; font-weight: 600;"><?= htmlspecialchars($c['campaign_code']) ?></span>
              </div>
            </td>

            <td>
              <span style="font-weight: 600; color: #0284c7; background: #e0f2fe; padding: 4px 8px; border-radius: 6px; font-size: 0.82rem; display: inline-block;">
                <?= $disc_str ?>
              </span>
            </td>

            <td>
              <a href="campaign_action.php?action=toggle&id=<?= $c['id'] ?>&status=<?= $c['status'] === 'ACTIVE' ? 'INACTIVE' : 'ACTIVE' ?>" 
                 title="Klik untuk mengubah status"
                 style="text-decoration: none;">
                <?php if ($c['status'] === 'ACTIVE'): ?>
                  <span class="badge-active"><i class='bx bx-check-circle'></i> ACTIVE</span>
                <?php else: ?>
                  <span class="badge-inactive"><i class='bx bx-x-circle'></i> INACTIVE</span>
                <?php endif; ?>
              </a>
            </td>

            <td>
              <div><strong><?= number_format($c['scans']) ?></strong> Scans / <strong><?= number_format($c['trx_count']) ?></strong> Trx</div>
              <div style="font-size: 0.78rem; color: var(--muted);">Conv. Rate: <strong style="color: var(--charcoal);"><?= $c_conv ?>%</strong></div>
            </td>

            <td>
              <div>Omset: <strong style="color: #166534;">Rp <?= number_format($c['sales_sum'], 0, ',', '.') ?></strong></div>
              <div style="font-size: 0.78rem; color: var(--muted);">Diskon: -Rp <?= number_format($c['discount_sum'], 0, ',', '.') ?></div>
            </td>

            <td>
              <div style="font-size: 0.8rem; color: var(--muted);">
                <?php if ($c['start_date'] || $c['end_date']): ?>
                  <?= $c['start_date'] ? date('d M Y', strtotime($c['start_date'])) : 'Awal' ?> — 
                  <?= $c['end_date'] ? date('d M Y', strtotime($c['end_date'])) : 'Selamanya' ?>
                <?php else: ?>
                  <span style="color: #059669;">Tanpa batas waktu</span>
                <?php endif; ?>
              </div>
            </td>

            <td style="text-align: center;">
              <div style="display: flex; gap: 6px; justify-content: center; align-items: center;">
                <button type="button" onclick="copyLink('<?= htmlspecialchars($c_url, ENT_QUOTES) ?>')" class="btn-sm" style="background: #e2e8f0; color: #1e293b; border: 1px solid #cbd5e1; font-weight: 600; padding: 6px 10px; border-radius: 6px; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;" title="Copy Link Campaign">
                  <i class='bx bx-copy'></i> Link
                </button>

                <button type="button" onclick="showQrModal('<?= htmlspecialchars($c['campaign_name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($c_url, ENT_QUOTES) ?>')" class="btn-sm" style="background: #e0e7ff; color: #4338ca; border: 1px solid #c7d2fe; padding: 6px 10px; border-radius: 6px; cursor: pointer;" title="Lihat QR Code">
                  <i class='bx bx-qr'></i> QR
                </button>

                <a href="campaign_form.php?id=<?= $c['id'] ?>" style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 6px 10px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center;" title="Edit Campaign">
                  <i class='bx bx-edit'></i>
                </a>

                <a href="campaign_action.php?action=delete&id=<?= $c['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus campaign ini?');" style="background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; padding: 6px 10px; border-radius: 6px; text-decoration: none; display: inline-flex; align-items: center;" title="Hapus Campaign">
                  <i class='bx bx-trash'></i>
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Modal QR Code Generator -->
<div class="modal-overlay" id="qrModal">
  <div class="modal-card">
    <h3 id="modalCampName" style="font-size: 1.1rem; color: var(--charcoal); margin-bottom: 12px;">QR Code Campaign</h3>
    
    <div style="background: #fff; padding: 12px; border: 1px solid var(--border); border-radius: 8px; display: inline-block; margin-bottom: 16px;">
      <img id="qrImage" src="" alt="QR Code" style="width: 200px; height: 200px; display: block;" />
    </div>

    <div style="margin-bottom: 16px; text-align: left;">
      <label style="font-size: 0.78rem; font-weight: 600; color: var(--muted); display: block; margin-bottom: 4px;">URL Link Campaign:</label>
      <input type="text" id="modalCampUrl" readonly style="width: 100%; padding: 8px; font-size: 0.8rem; border: 1px solid var(--border); border-radius: 6px; background: #f9fafb; font-family: monospace; color: #1e293b;" />
    </div>

    <div style="display: flex; gap: 8px; justify-content: center; flex-wrap: wrap;">
      <button type="button" onclick="copyLink(document.getElementById('modalCampUrl').value)" style="padding: 8px 16px; background: #e2e8f0; color: #1e293b; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
        <i class='bx bx-copy'></i> Copy Link
      </button>
      <a id="downloadQrBtn" href="" download="campaign-qr.png" target="_blank" style="padding: 8px 16px; background: var(--sage-dark); color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
        <i class='bx bx-download'></i> Download QR
      </a>
      <button type="button" onclick="closeQrModal()" style="padding: 8px 16px; background: #f3f4f6; color: #374151; border: 1px solid var(--border); border-radius: 6px; font-size: 0.85rem; cursor: pointer; font-weight: 600;">
        Tutup
      </button>
    </div>
  </div>
</div>

<script>
function copyLink(url) {
  navigator.clipboard.writeText(url).then(() => {
    alert('Link Campaign berhasil disalin to Clipboard!\n\n' + url);
  }).catch(err => {
    prompt('Salin link berikut secara manual:', url);
  });
}

function showQrModal(name, url) {
  document.getElementById('modalCampName').innerText = name;
  document.getElementById('modalCampUrl').value = url;
  
  const qrApi = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent(url);
  document.getElementById('qrImage').src = qrApi;
  document.getElementById('downloadQrBtn').href = qrApi;
  
  document.getElementById('qrModal').style.display = 'flex';
}

function closeQrModal() {
  document.getElementById('qrModal').style.display = 'none';
}
</script>

<?php include 'admin_layout_end.php'; ?>
