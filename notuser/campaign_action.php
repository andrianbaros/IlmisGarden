<?php
session_start();
require '../conn/db.php';

// Pastikan admin login
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Ensure database table exists before action
ensure_campaign_tables_exist($pdo);

if ($action === 'create') {
    $name  = trim($_POST['campaign_name'] ?? '');
    $code  = strtoupper(trim($_POST['campaign_code'] ?? ''));
    $type  = $_POST['discount_type'] ?? 'percent';
    $val   = (float)($_POST['discount_value'] ?? 10);
    $status= $_POST['status'] ?? 'ACTIVE';
    $start = !empty($_POST['start_date']) ? date('Y-m-d H:i:s', strtotime($_POST['start_date'])) : null;
    $end   = !empty($_POST['end_date'])   ? date('Y-m-d H:i:s', strtotime($_POST['end_date']))   : null;
    try {
        $token = bin2hex(random_bytes(16));
    } catch (Exception $ex) {
        $token = md5(uniqid(mt_rand(), true));
    }

    if (empty($name) || empty($code)) {
        $_SESSION['flash_msg'] = "Nama dan Kode Campaign wajib diisi!";
        $_SESSION['flash_type'] = "danger";
        header("Location: campaign_form.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO campaigns (campaign_name, campaign_code, campaign_token, discount_type, discount_value, status, start_date, end_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $code, $token, $type, $val, $status, $start, $end]);
        $_SESSION['flash_msg'] = "Campaign '$name' ($code) berhasil dibuat!";
        $_SESSION['flash_type'] = "success";
    } catch (Exception $e) {
        if (strpos($e->getMessage(), '1062') !== false || strpos($e->getMessage(), '23000') !== false) {
            $_SESSION['flash_msg'] = "Gagal membuat campaign: Kode Campaign '$code' sudah digunakan pada campaign lain. Silakan gunakan Kode Campaign yang unik (contoh: RAMADHAN2026, PROMO10).";
        } else {
            $_SESSION['flash_msg'] = "Gagal membuat campaign: " . $e->getMessage();
        }
        $_SESSION['flash_type'] = "danger";
    }

    header("Location: campaign.php");
    exit;
}

if ($action === 'update') {
    $id    = (int)($_POST['id'] ?? 0);
    $name  = trim($_POST['campaign_name'] ?? '');
    $type  = $_POST['discount_type'] ?? 'percent';
    $val   = (float)($_POST['discount_value'] ?? 10);
    $status= $_POST['status'] ?? 'ACTIVE';
    $start = !empty($_POST['start_date']) ? date('Y-m-d H:i:s', strtotime($_POST['start_date'])) : null;
    $end   = !empty($_POST['end_date'])   ? date('Y-m-d H:i:s', strtotime($_POST['end_date']))   : null;

    if ($id <= 0 || empty($name)) {
        $_SESSION['flash_msg'] = "Data campaign tidak valid!";
        $_SESSION['flash_type'] = "danger";
        header("Location: campaign.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE campaigns SET campaign_name = ?, discount_type = ?, discount_value = ?, status = ?, start_date = ?, end_date = ? WHERE id = ?");
        $stmt->execute([$name, $type, $val, $status, $start, $end, $id]);

        if (isset($_POST['regen_token']) && $_POST['regen_token'] == 1) {
            try {
                $newToken = bin2hex(random_bytes(16));
            } catch (Exception $ex) {
                $newToken = md5(uniqid(mt_rand(), true));
            }
            $pdo->prepare("UPDATE campaigns SET campaign_token = ? WHERE id = ?")->execute([$newToken, $id]);
        }

        $_SESSION['flash_msg'] = "Campaign berhasil diperbarui!";
        $_SESSION['flash_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['flash_msg'] = "Gagal memperbarui campaign: " . $e->getMessage();
        $_SESSION['flash_type'] = "danger";
    }

    header("Location: campaign.php");
    exit;
}

if ($action === 'toggle') {
    $id = (int)($_GET['id'] ?? 0);
    $status = $_GET['status'] ?? 'INACTIVE';

    if ($id > 0) {
        $newStatus = ($status === 'ACTIVE') ? 'ACTIVE' : 'INACTIVE';
        $pdo->prepare("UPDATE campaigns SET status = ? WHERE id = ?")->execute([$newStatus, $id]);
        $_SESSION['flash_msg'] = "Status campaign berhasil diubah menjadi $newStatus.";
        $_SESSION['flash_type'] = "success";
    }

    header("Location: campaign.php");
    exit;
}

if ($action === 'delete') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $pdo->prepare("DELETE FROM campaigns WHERE id = ?")->execute([$id]);
        $_SESSION['flash_msg'] = "Campaign berhasil dihapus.";
        $_SESSION['flash_type'] = "success";
    }
    header("Location: campaign.php");
    exit;
}

header("Location: campaign.php");
exit;
