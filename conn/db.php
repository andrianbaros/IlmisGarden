<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = '103.247.9.152';
$db   = 'ilmi8192_garden';
$user = 'ilmi8192_admin'; // sesuaikan username db Anda
$pass = ';mr52=Zw$O%-H3Ud';      // sesuaikan password db Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$host_header = $_SERVER['HTTP_HOST'] ?? '';
$isLocal = (stripos($host_header, 'localhost') !== false || stripos($host_header, '127.0.0.1') !== false || php_sapi_name() === 'cli');

if (!defined('BASE_URL')) {
    if ($isLocal) {
        define('BASE_URL', '/a');
    } else {
        define('BASE_URL', '');
    }
}

if ($isLocal) {
    try {
        $localDsn = "mysql:host=127.0.0.1;dbname=ilmisgarden;charset=utf8mb4";
        $pdo = new PDO($localDsn, "root", "", $options);
    } catch (\PDOException $localEx) {
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $remoteEx) {
            throw new \PDOException($localEx->getMessage(), (int)$localEx->getCode());
        }
    }
} else {
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        try {
            $localDsn = "mysql:host=127.0.0.1;dbname=ilmisgarden;charset=utf8mb4";
            $pdo = new PDO($localDsn, "root", "", $options);
        } catch (\PDOException $localEx) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}

try {
    require_once __DIR__ . '/config.php';

    // Campaign Detection & Tracking
    if (isset($_GET['campaign'])) {
        $campaignCode = trim($_GET['campaign']);
        $token = $_GET['token'] ?? null;
        $signature = $_GET['signature'] ?? null;

        $camp = validate_db_campaign($pdo, $campaignCode, $token, $signature);
        if ($camp) {
            $_SESSION['campaign_id']             = $camp['id'];
            $_SESSION['campaign_code']           = $camp['campaign_code'];
            $_SESSION['campaign_name']           = $camp['campaign_name'];
            $_SESSION['campaign_discount_type']  = $camp['discount_type'];
            $_SESSION['campaign_discount_value'] = $camp['discount_value'];
            $_SESSION['campaign_token']          = $camp['campaign_token'];
            $_SESSION['campaign_source']         = $camp['campaign_code'];
            $_SESSION['campaign_discount']       = ($camp['discount_type'] === 'percent') ? ($camp['discount_value'] / 100.0) : 0;

            setcookie('campaign_code', $camp['campaign_code'], time() + (86400 * 30), '/');
            setcookie('campaign_token', $camp['campaign_token'], time() + (86400 * 30), '/');
            setcookie('campaign_source', $camp['campaign_code'], time() + (86400 * 30), '/');

            record_campaign_visit($pdo, $camp, 'QR');
        } else {
            // Invalid campaign parameter passed, clear active campaign
            unset($_SESSION['campaign_id'], $_SESSION['campaign_code'], $_SESSION['campaign_name'], $_SESSION['campaign_discount_type'], $_SESSION['campaign_discount_value'], $_SESSION['campaign_token'], $_SESSION['campaign_source'], $_SESSION['campaign_discount']);
            setcookie('campaign_code', '', time() - 3600, '/');
            setcookie('campaign_token', '', time() - 3600, '/');
            setcookie('campaign_source', '', time() - 3600, '/');
        }
    } else {
        // Re-validate existing campaign in session/cookie against DB
        get_active_user_campaign($pdo);
    }
} catch (Exception $e) {
    // Prevent failure from config setup blocking db initialization
}