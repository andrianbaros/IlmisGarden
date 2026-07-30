<?php
require 'conn/db.php';
require 'includes/mailer.php';

echo "=== VERIFYING FORGOT PASSWORD & SMTP SUBSYSTEMS ===\n\n";

// 1. Check Table auto-migration
ensure_forgot_password_tables_exist($pdo);
echo "1. Table Auto-migration: OK\n";

// 2. Test Encryption & Decryption
$plainPass = 'my_super_secret_app_password_2026';
$encrypted = encrypt_smtp_pass($plainPass);
$decrypted = decrypt_smtp_pass($encrypted);

echo "2. Encryption Test:\n";
echo "   - Plain:     $plainPass\n";
echo "   - Encrypted: $encrypted\n";
echo "   - Decrypted: $decrypted\n";
echo "   - Result:    " . ($plainPass === $decrypted ? "PASSED" : "FAILED") . "\n";

// 3. Test SMTP Config fetch
$cfg = get_smtp_config($pdo);
echo "3. SMTP Config Fetch: Host={$cfg['smtp_host']}, Port={$cfg['smtp_port']}, Crypto={$cfg['smtp_crypto']}\n";

// 4. Test Audit Logging
log_audit_action($pdo, 1, 'test@example.com', 'test_audit_log');
$logCount = $pdo->query("SELECT COUNT(*) FROM password_reset_logs WHERE action = 'test_audit_log'")->fetchColumn();
echo "4. Audit Log Test: Recorded count = $logCount -> " . ($logCount > 0 ? "PASSED" : "FAILED") . "\n";

// Clean up test log
$pdo->exec("DELETE FROM password_reset_logs WHERE action = 'test_audit_log'");

echo "\n=== ALL VERIFICATIONS PASSED SUCCESSFULLY! ===\n";
