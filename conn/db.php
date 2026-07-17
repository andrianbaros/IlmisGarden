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
    if (isset($_GET['campaign']) && isset($_GET['signature'])) {
        $campaign = $_GET['campaign'];
        $sig = $_GET['signature'];
        if (validate_campaign_signature($campaign, $sig)) {
            $_SESSION['campaign_source'] = $campaign;
            $_SESSION['campaign_discount'] = 0.10; // 10%
            setcookie('campaign_source', $campaign, time() + (86400 * 30), '/'); // 30 days
            record_campaign_visit($pdo, $campaign, 'QR');
        }
    } elseif (!isset($_SESSION['campaign_source']) && isset($_COOKIE['campaign_source'])) {
        $_SESSION['campaign_source'] = $_COOKIE['campaign_source'];
        $_SESSION['campaign_discount'] = 0.10;
    }
} catch (Exception $e) {
    // Prevent failure from config setup blocking db initialization
}