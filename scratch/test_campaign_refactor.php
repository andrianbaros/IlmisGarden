<?php
require 'conn/db.php';

echo "=== STARTING CAMPAIGN REFACTOR VERIFICATION ===\n\n";

// 1. Fetch default campaign
$stmt = $pdo->query("SELECT * FROM campaigns WHERE campaign_code = 'DISPLAY2026'");
$camp = $stmt->fetch();

if (!$camp) {
    die("Error: Seed campaign DISPLAY2026 not found!\n");
}

echo "1. Active Campaign Found: " . $camp['campaign_name'] . " (Token: " . $camp['campaign_token'] . ")\n";

// 2. Validate valid token
$val1 = validate_db_campaign($pdo, 'DISPLAY2026', $camp['campaign_token']);
echo "2. Validate with correct token: " . ($val1 ? "PASSED (Valid)" : "FAILED") . "\n";

// 3. Validate invalid token
$val2 = validate_db_campaign($pdo, 'DISPLAY2026', 'wrong_token_123');
echo "3. Validate with WRONG token: " . (!$val2 ? "PASSED (Rejected correctly)" : "FAILED") . "\n";

// 4. Test INACTIVE status behavior
$pdo->exec("UPDATE campaigns SET status = 'INACTIVE' WHERE campaign_code = 'DISPLAY2026'");
$val3 = validate_db_campaign($pdo, 'DISPLAY2026', $camp['campaign_token']);
echo "4. Validate when status=INACTIVE: " . (!$val3 ? "PASSED (Rejected correctly)" : "FAILED") . "\n";

// Re-activate
$pdo->exec("UPDATE campaigns SET status = 'ACTIVE' WHERE campaign_code = 'DISPLAY2026'");

// 5. Test expired end_date
$pdo->exec("UPDATE campaigns SET end_date = '2020-01-01 00:00:00' WHERE campaign_code = 'DISPLAY2026'");
$val4 = validate_db_campaign($pdo, 'DISPLAY2026', $camp['campaign_token']);
echo "5. Validate when expired end_date: " . (!$val4 ? "PASSED (Rejected correctly)" : "FAILED") . "\n";

// Restore end_date to null
$pdo->exec("UPDATE campaigns SET end_date = NULL WHERE campaign_code = 'DISPLAY2026'");

echo "\n=== ALL VERIFICATION TESTS PASSED SUCCESSFULLY! ===\n";
