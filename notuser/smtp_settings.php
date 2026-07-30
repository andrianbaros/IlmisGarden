<?php
session_start();
require '../conn/db.php';
require '../includes/mailer.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

$page_id = 'smtp';
$page_title = 'Pengaturan SMTP Email';

// Load current SMTP config
$cfg = get_smtp_config($pdo);

$flash_msg = $_SESSION['flash_msg'] ?? '';
$flash_type = $_SESSION['flash_type'] ?? '';
unset($_SESSION['flash_msg'], $_SESSION['flash_type']);

// Handle Save Configuration
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'save_smtp') {
    $host   = trim($_POST['smtp_host'] ?? '');
    $port   = (int)($_POST['smtp_port'] ?? 587);
    $user   = trim($_POST['smtp_user'] ?? '');
    $pass   = trim($_POST['smtp_pass'] ?? '');
    $crypto = $_POST['smtp_crypto'] ?? 'tls';
    $femail = trim($_POST['from_email'] ?? '');
    $fname  = trim($_POST['from_name'] ?? 'Ilmis Garden');

    // Encrypt password if new password provided, or keep existing encrypted pass if empty input
    $encrypted_pass = !empty($pass) ? encrypt_smtp_pass($pass) : ($cfg['smtp_pass'] ?? '');

    try {
        $stmt = $pdo->prepare("
            INSERT INTO smtp_settings (id, smtp_host, smtp_port, smtp_user, smtp_pass, smtp_crypto, from_email, from_name) 
            VALUES (1, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
                smtp_host = VALUES(smtp_host),
                smtp_port = VALUES(smtp_port),
                smtp_user = VALUES(smtp_user),
                smtp_pass = VALUES(smtp_pass),
                smtp_crypto = VALUES(smtp_crypto),
                from_email = VALUES(from_email),
                from_name = VALUES(from_name)
        ");
        $stmt->execute([$host, $port, $user, $encrypted_pass, $crypto, $femail, $fname]);

        $_SESSION['flash_msg'] = "Konfigurasi SMTP berhasil disimpan!";
        $_SESSION['flash_type'] = "success";
        header("Location: smtp_settings.php");
        exit;
    } catch (Exception $e) {
        $flash_msg = "Gagal menyimpan konfigurasi: " . $e->getMessage();
        $flash_type = "danger";
    }
}

// Handle Test Connection Only
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'test_connection') {
    $res = test_smtp_connection_only($pdo);
    if ($res['success']) {
        $flash_msg = "KONEKSI BERHASIL! Server SMTP (" . htmlspecialchars($cfg['smtp_host']) . ":" . $cfg['smtp_port'] . ") terhubung dan berhasil melewati autentikasi.";
        $flash_type = "success";
    } else {
        $flash_msg = "KONEKSI GAGAL: " . htmlspecialchars($res['error']);
        $flash_type = "danger";
    }
}

// Handle Test Email Dispatch
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'send_test_email') {
    $target_email = trim($_POST['test_recipient'] ?? '');
    if (empty($target_email) || !filter_var($target_email, FILTER_VALIDATE_EMAIL)) {
        $flash_msg = "Silakan masukkan alamat email penerima uji coba yang valid.";
        $flash_type = "danger";
    } else {
        $test_body = "
        <div style='font-family: Arial, sans-serif; padding: 20px; color: #333;'>
          <h2 style='color: #166534;'>Tes Pengiriman Email SMTP — Ilmis Garden</h2>
          <p>Selamat! Jika Anda membaca email ini, konfigurasi server SMTP di Dashboard Admin Ilmis Garden telah <strong>berfungsi dengan sempurna</strong>.</p>
          <hr style='border: none; border-top: 1px solid #ddd; margin: 20px 0;'>
          <p style='font-size: 0.85rem; color: #666;'>Dikirim pada: " . date('d M Y H:i:s') . "</p>
        </div>";

        $res = send_smtp_email($pdo, $target_email, "Tes Pengiriman Email SMTP — Ilmis Garden", $test_body);
        if ($res['success']) {
            $flash_msg = "EMAIL UJI COBA BERHASIL DIKIRIM ke " . htmlspecialchars($target_email) . "! Silakan periksa inbox / spam.";
            $flash_type = "success";
        } else {
            $flash_msg = "PENGIRIMAN EMAIL GAGAL: " . htmlspecialchars($res['error']);
            $flash_type = "danger";
        }
    }
}

// Re-fetch config
$cfg = get_smtp_config($pdo);
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
  <style>
    .pass-toggle-wrap { position: relative; }
    .pass-toggle-btn { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--muted); font-size: 1.1rem; }
    .alert-box { padding: 14px 18px; border-radius: var(--radius); margin-bottom: 24px; font-weight: 500; font-size: 0.92rem; line-height: 1.5; }
    .alert-box.success { background: var(--success-bg); color: #166534; border: 1px solid #bbf7d0; }
    .alert-box.danger { background: var(--danger-bg); color: #991b1b; border: 1px solid #fecaca; }
  </style>
</head>
<body>

<?php include 'admin_layout.php'; ?>

<div style="max-width: 860px; margin: 0 auto;">
  <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
    <div>
      <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--charcoal);">Pengaturan SMTP Email</h1>
      <p style="color: var(--muted); font-size: 0.88rem; margin-top: 4px;">Konfigurasi server pengiriman email OTP reset password & notifikasi toko</p>
    </div>
  </div>

  <?php if (!empty($flash_msg)): ?>
    <div class="alert-box <?= $flash_type === 'danger' ? 'danger' : 'success' ?>">
      <i class='bx <?= $flash_type === 'danger' ? 'bx-error-circle' : 'bx-check-circle' ?>' style="font-size: 1.2rem; vertical-align: middle; margin-right: 6px;"></i>
      <?= $flash_msg ?>
    </div>
  <?php endif; ?>

  <!-- Main Settings Form -->
  <div class="card" style="padding: 24px; margin-bottom: 24px; background: #fff; border: 1px solid var(--border); border-radius: var(--radius);">
    <h3 style="font-size: 1.1rem; font-weight: 600; color: var(--charcoal); margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
      <i class='bx bx-cog' style="color: var(--sage-dark);"></i> Konfigurasi Server SMTP
    </h3>

    <form action="" method="post">
      <input type="hidden" name="action" value="save_smtp">

      <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">SMTP Host <span style="color:red;">*</span></label>
          <input type="text" name="smtp_host" value="<?= htmlspecialchars($cfg['smtp_host']) ?>" required placeholder="Misal: smtp.gmail.com atau mail.domain.com" style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font);">
        </div>
        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">SMTP Port <span style="color:red;">*</span></label>
          <input type="number" name="smtp_port" value="<?= htmlspecialchars($cfg['smtp_port']) ?>" required placeholder="587 / 465" style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font);">
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">SMTP Username / Email <span style="color:red;">*</span></label>
          <input type="text" name="smtp_user" value="<?= htmlspecialchars($cfg['smtp_user']) ?>" required placeholder="email@gmail.com" style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font);">
        </div>

        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">
            SMTP Password / App Password 
            <small style="color: var(--muted); font-weight: normal;">(Terenkripsi)</small>
          </label>
          <div class="pass-toggle-wrap">
            <input type="password" id="smtpPassInput" name="smtp_pass" placeholder="<?= !empty($cfg['smtp_pass_plain']) ? '•••••••• (Tersimpan terenkripsi)' : 'Masukkan password SMTP' ?>" style="width: 100%; padding: 10px 14px; padding-right: 40px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font);">
            <button type="button" class="pass-toggle-btn" onclick="toggleSmtpPass()" aria-label="Lihat Password">
              <i class='bx bx-show' id="smtpPassIcon"></i>
            </button>
          </div>
          <small style="color: var(--muted); font-size: 0.78rem; display: block; margin-top: 4px;">
            Kosongkan jika tidak ingin mengubah password tersimpan. Untuk Gmail, gunakan <strong>App Password (16 digit)</strong>.
          </small>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">Enkripsi SSL/TLS</label>
          <select name="smtp_crypto" style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font); background: #fff;">
            <option value="tls" <?= ($cfg['smtp_crypto'] ?? 'tls') === 'tls' ? 'selected' : '' ?>>TLS (Port 587 - Direkomendasikan)</option>
            <option value="ssl" <?= ($cfg['smtp_crypto'] ?? '') === 'ssl' ? 'selected' : '' ?>>SSL (Port 465)</option>
          </select>
        </div>

        <div>
          <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">Nama Pengirim (From Name)</label>
          <input type="text" name="from_name" value="<?= htmlspecialchars($cfg['from_name']) ?>" required placeholder="Ilmis Garden" style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font);">
        </div>
      </div>

      <div style="margin-bottom: 24px;">
        <label style="display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.88rem; color: var(--charcoal);">Email Pengirim (From Email)</label>
        <input type="email" name="from_email" value="<?= htmlspecialchars($cfg['from_email']) ?>" placeholder="no-reply@ilmisgarden.com" style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.9rem; font-family: var(--font);">
        <small style="color: var(--muted); font-size: 0.78rem;">Kosongkan jika ingin disamakan dengan SMTP Username.</small>
      </div>

      <div style="display: flex; justify-content: flex-end;">
        <button type="submit" style="padding: 11px 24px; border-radius: 8px; border: none; background: var(--forest); color: #fff; font-weight: 600; cursor: pointer; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s;">
          <i class='bx bx-save' style="font-size: 1.1rem;"></i> Simpan Konfigurasi SMTP
        </button>
      </div>
    </form>
  </div>

  <!-- Testing Tools Card -->
  <div class="card" style="padding: 24px; background: #fff; border: 1px solid var(--border); border-radius: var(--radius);">
    <h3 style="font-size: 1.1rem; font-weight: 600; color: var(--charcoal); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
      <i class='bx bx-wrench' style="color: var(--sage-dark);"></i> Pengujian Server SMTP
    </h3>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <!-- Test Connection Button -->
      <div style="background: var(--cream); padding: 18px; border-radius: 10px; border: 1px solid var(--border);">
        <h4 style="font-size: 0.92rem; font-weight: 600; margin-bottom: 6px; color: var(--charcoal);">1. Cek Koneksi (Test Connection)</h4>
        <p style="font-size: 0.82rem; color: var(--muted); margin-bottom: 14px; line-height: 1.5;">Memeriksa handshake socket & autentikasi login SMTP tanpa mengirimkan email.</p>
        <form action="" method="post">
          <input type="hidden" name="action" value="test_connection">
          <button type="submit" style="width: 100%; padding: 10px; background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.88rem; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
            <i class='bx bx-pulse'></i> Test Connection
          </button>
        </form>
      </div>

      <!-- Test Email Dispatch -->
      <div style="background: var(--cream); padding: 18px; border-radius: 10px; border: 1px solid var(--border);">
        <h4 style="font-size: 0.92rem; font-weight: 600; margin-bottom: 6px; color: var(--charcoal);">2. Kirim Email Uji Coba</h4>
        <p style="font-size: 0.82rem; color: var(--muted); margin-bottom: 10px; line-height: 1.5;">Mengirim pesan tes HTML langsung ke email tujuan Anda.</p>
        <form action="" method="post">
          <input type="hidden" name="action" value="send_test_email">
          <input type="email" name="test_recipient" required placeholder="Masukkan email penerima..." style="width: 100%; padding: 9px 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 0.85rem; font-family: var(--font); margin-bottom: 10px;">
          <button type="submit" style="width: 100%; padding: 10px; background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.88rem; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
            <i class='bx bx-send'></i> Kirim Email Uji Coba
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function toggleSmtpPass() {
  const input = document.getElementById('smtpPassInput');
  const icon = document.getElementById('smtpPassIcon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.className = 'bx bx-hide';
  } else {
    input.type = 'password';
    icon.className = 'bx bx-show';
  }
}
</script>

<?php include 'admin_layout_end.php'; ?>
