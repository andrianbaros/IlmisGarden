<?php
require 'conn/db.php';

try {
    // 1. Create campaigns table
    $sql1 = "CREATE TABLE IF NOT EXISTS campaigns (
        id INT AUTO_INCREMENT PRIMARY KEY,
        campaign_name VARCHAR(255) NOT NULL,
        campaign_code VARCHAR(100) NOT NULL UNIQUE,
        campaign_token VARCHAR(255) NOT NULL,
        discount_type ENUM('percent', 'fixed') DEFAULT 'percent',
        discount_value DECIMAL(10,2) NOT NULL DEFAULT 10.00,
        status ENUM('ACTIVE', 'INACTIVE') DEFAULT 'ACTIVE',
        start_date DATETIME NULL,
        end_date DATETIME NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql1);
    echo "Table 'campaigns' created/verified successfully.\n";

    // Insert default campaign if empty
    $chk = $pdo->query("SELECT COUNT(*) FROM campaigns")->fetchColumn();
    if ($chk == 0) {
        $token = bin2hex(random_bytes(16));
        $stmt = $pdo->prepare("INSERT INTO campaigns (campaign_name, campaign_code, campaign_token, discount_type, discount_value, status) VALUES (?, ?, ?, 'percent', 10.00, 'ACTIVE')");
        $stmt->execute(['Display QR Code Utama', 'DISPLAY2026', $token]);
        echo "Default campaign 'DISPLAY2026' seeded with token: $token\n";
    }

    // 2. Add columns to transactions table if not existing
    $cols = $pdo->query("DESCRIBE transactions")->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('campaign_id', $cols)) {
        $pdo->exec("ALTER TABLE transactions ADD COLUMN campaign_id INT NULL AFTER campaign");
        echo "Added 'campaign_id' to transactions.\n";
    }
    if (!in_array('campaign_name', $cols)) {
        $pdo->exec("ALTER TABLE transactions ADD COLUMN campaign_name VARCHAR(255) NULL AFTER campaign_id");
        echo "Added 'campaign_name' to transactions.\n";
    }
    if (!in_array('campaign_code', $cols)) {
        $pdo->exec("ALTER TABLE transactions ADD COLUMN campaign_code VARCHAR(100) NULL AFTER campaign_name");
        echo "Added 'campaign_code' to transactions.\n";
    }
    if (!in_array('discount_percent', $cols)) {
        $pdo->exec("ALTER TABLE transactions ADD COLUMN discount_percent DECIMAL(5,2) DEFAULT 0.00 AFTER campaign_code");
        echo "Added 'discount_percent' to transactions.\n";
    }
    if (!in_array('discount_amount', $cols)) {
        $pdo->exec("ALTER TABLE transactions ADD COLUMN discount_amount BIGINT DEFAULT 0 AFTER discount_percent");
        echo "Added 'discount_amount' to transactions.\n";
    }

    // 3. Add campaign_id to campaign_visits if not existing
    $vcols = $pdo->query("DESCRIBE campaign_visits")->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array('campaign_id', $vcols)) {
        $pdo->exec("ALTER TABLE campaign_visits ADD COLUMN campaign_id INT NULL AFTER id");
        echo "Added 'campaign_id' to campaign_visits.\n";
    }
    if (!in_array('campaign_code', $vcols)) {
        $pdo->exec("ALTER TABLE campaign_visits ADD COLUMN campaign_code VARCHAR(100) NULL AFTER campaign_id");
        echo "Added 'campaign_code' to campaign_visits.\n";
    }

    echo "Database migration completed successfully.\n";
} catch (Exception $e) {
    echo "Migration error: " . $e->getMessage() . "\n";
}
