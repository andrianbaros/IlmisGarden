<?php
session_start();
$_GET['campaign'] = 'qr_display';
$_GET['signature'] = hash_hmac('sha256', 'qr_display', 'ilmisgarden_secret_key_2026_rfv');

require_once 'conn/db.php';

echo "Session campaign_source: " . ($_SESSION['campaign_source'] ?? 'NONE') . "\n";
echo "Session campaign_discount: " . ($_SESSION['campaign_discount'] ?? 'NONE') . "\n";
echo "Cookie campaign_source: " . ($_COOKIE['campaign_source'] ?? 'NONE') . "\n";

// Check campaign_visits
$visit = $pdo->query("SELECT * FROM campaign_visits ORDER BY id DESC LIMIT 1")->fetch();
if ($visit) {
    echo "Last campaign visit logged: ID {$visit['id']} - Name: {$visit['campaign_name']} - Source: {$visit['source']} - IP: {$visit['ip_address']}\n";
} else {
    echo "No campaign visit found in DB!\n";
}
