<?php
session_start();
require '../conn/db.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

$id = (int)($_GET['id'] ?? 0);
$campaign = null;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM campaigns WHERE id = ?");
    $stmt->execute([$id]);
    $campaign = $stmt->fetch();
}

$is_edit = !empty($campaign);
$page_id = 'campaigns';
$page_title = $is_edit ? 'Edit Campaign' : 'Tambah Campaign Baru';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($page_title) ?> — IlmisGarden Admin</title>
  <link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
  <link rel="icon" href="../img/F4F6F4-full.png" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php include 'admin_layout.php'; ?>

<div style="max-width: 700px; margin: 0 auto;">
  <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
    <h2><?= htmlspecialchars($page_title) ?></h2>
    <a href="campaign.php" style="color: var(--muted); text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 4px;">
      <i class='bx bx-arrow-back'></i> Kembali
    </a>
  </div>

  <?php if (isset($_SESSION['flash_msg'])): ?>
    <div style="padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-weight: 500; <?= $_SESSION['flash_type'] === 'danger' ? 'background: #fee2e2; color: #991b1b;' : 'background: #dcfce7; color: #166534;' ?>">
      <?= htmlspecialchars($_SESSION['flash_msg']) ?>
    </div>
    <?php unset($_SESSION['flash_msg'], $_SESSION['flash_type']); ?>
  <?php endif; ?>

  <div class="card" style="padding: 24px;">
    <form action="campaign_action.php" method="post">
      <input type="hidden" name="action" value="<?= $is_edit ? 'update' : 'create' ?>">
      <?php if ($is_edit): ?>
        <input type="hidden" name="id" value="<?= $campaign['id'] ?>">
      <?php endif; ?>

      <div style="margin-bottom: 16px;">
        <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Nama Campaign <span style="color:red;">*</span></label>
        <input type="text" name="campaign_name" value="<?= htmlspecialchars($campaign['campaign_name'] ?? '') ?>" required placeholder="Contoh: Display QR Code Utama / Promo Ramadhan" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem;">
      </div>

      <div style="margin-bottom: 16px;">
        <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Kode Campaign (Unik) <span style="color:red;">*</span></label>
        <input type="text" name="campaign_code" value="<?= htmlspecialchars($campaign['campaign_code'] ?? '') ?>" <?= $is_edit ? 'readonly' : 'required' ?> placeholder="Contoh: DISPLAY2026 / RAMADHAN10" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem; text-transform: uppercase; <?= $is_edit ? 'background: #f3f4f6;' : '' ?>">
        <?php if ($is_edit): ?>
          <small style="color: var(--muted); font-size: 0.8rem;">Kode campaign tidak dapat diubah setelah dibuat.</small>
        <?php endif; ?>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Tipe Diskon</label>
          <select name="discount_type" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem; background: #fff;">
            <option value="percent" <?= ($campaign['discount_type'] ?? 'percent') === 'percent' ? 'selected' : '' ?>>Persentase (%)</option>
            <option value="fixed" <?= ($campaign['discount_type'] ?? '') === 'fixed' ? 'selected' : '' ?>>Nominal Tetap (Rp)</option>
          </select>
        </div>

        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Nilai Diskon <span style="color:red;">*</span></label>
          <input type="number" step="0.01" name="discount_value" value="<?= htmlspecialchars($campaign['discount_value'] ?? '10') ?>" required placeholder="Misal: 10 (untuk 10%) atau 15000" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem;">
        </div>
      </div>

      <div style="margin-bottom: 16px;">
        <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Status Campaign</label>
        <select name="status" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem; background: #fff;">
          <option value="ACTIVE" <?= ($campaign['status'] ?? 'ACTIVE') === 'ACTIVE' ? 'selected' : '' ?>>ACTIVE (Aktif)</option>
          <option value="INACTIVE" <?= ($campaign['status'] ?? '') === 'INACTIVE' ? 'selected' : '' ?>>INACTIVE (Nonaktif)</option>
        </select>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Tanggal Mulai (Opsional)</label>
          <input type="datetime-local" name="start_date" value="<?= !empty($campaign['start_date']) ? date('Y-m-d\TH:i', strtotime($campaign['start_date'])) : '' ?>" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem;">
        </div>

        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem;">Tanggal Berakhir (Opsional)</label>
          <input type="datetime-local" name="end_date" value="<?= !empty($campaign['end_date']) ? date('Y-m-d\TH:i', strtotime($campaign['end_date'])) : '' ?>" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 0.95rem;">
        </div>
      </div>

      <?php if ($is_edit): ?>
        <div style="margin-bottom: 20px; padding: 12px; background: #f9fafb; border-radius: 6px; border: 1px solid var(--border);">
          <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.9rem; font-weight: 500;">
            <input type="checkbox" name="regen_token" value="1">
            Regenerasi Token Keamanan (Token lama tidak akan berlaku lagi)
          </label>
        </div>
      <?php endif; ?>

      <div style="display: flex; justify-content: flex-end; gap: 10px;">
        <a href="campaign.php" style="padding: 10px 18px; border-radius: 6px; border: 1px solid var(--border); background: #fff; text-decoration: none; color: var(--charcoal); font-weight: 500;">Batal</a>
        <button type="submit" style="padding: 10px 20px; border-radius: 6px; border: none; background: var(--sage-dark); color: #fff; font-weight: 600; cursor: pointer; font-size: 0.95rem;">
          <i class='bx bx-save'></i> Simpan Campaign
        </button>
      </div>
    </form>
  </div>
</div>

<?php include 'admin_layout_end.php'; ?>
