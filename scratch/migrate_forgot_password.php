<?php
require 'conn/db.php';

try {
    // 1. Table password_reset_tokens
    $sql1 = "CREATE TABLE IF NOT EXISTS password_reset_tokens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        email VARCHAR(255) NOT NULL,
        otp_hash VARCHAR(255) NOT NULL,
        failed_attempts INT NOT NULL DEFAULT 0,
        expires_at DATETIME NOT NULL,
        used_at DATETIME NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql1);
    echo "Table 'password_reset_tokens' created/verified.\n";

    // 2. Table smtp_settings
    $sql2 = "CREATE TABLE IF NOT EXISTS smtp_settings (
        id INT PRIMARY KEY DEFAULT 1,
        smtp_host VARCHAR(255) NOT NULL DEFAULT 'smtp.gmail.com',
        smtp_port INT NOT NULL DEFAULT 587,
        smtp_user VARCHAR(255) NOT NULL DEFAULT '',
        smtp_pass TEXT NOT NULL,
        smtp_crypto VARCHAR(10) NOT NULL DEFAULT 'tls',
        from_email VARCHAR(255) NOT NULL DEFAULT '',
        from_name VARCHAR(255) NOT NULL DEFAULT 'Ilmis Garden',
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql2);
    echo "Table 'smtp_settings' created/verified.\n";

    // Seed default SMTP record if empty
    $chkSmtp = $pdo->query("SELECT COUNT(*) FROM smtp_settings")->fetchColumn();
    if ($chkSmtp == 0) {
        $stmt = $pdo->prepare("INSERT INTO smtp_settings (id, smtp_host, smtp_port, smtp_user, smtp_pass, smtp_crypto, from_email, from_name) VALUES (1, 'smtp.gmail.com', 587, '', '', 'tls', 'no-reply@ilmisgarden.com', 'Ilmis Garden')");
        $stmt->execute();
        echo "Default SMTP record inserted.\n";
    }

    // 3. Table password_reset_logs (Audit Log)
    $sql3 = "CREATE TABLE IF NOT EXISTS password_reset_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        email VARCHAR(255) NOT NULL,
        action VARCHAR(100) NOT NULL,
        ip_address VARCHAR(45) NOT NULL,
        user_agent VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $pdo->exec($sql3);
    echo "Table 'password_reset_logs' created/verified.\n";

    echo "Migration completed successfully!\n";

} catch (Exception $e) {
    echo "Migration error: " . $e->getMessage() . "\n";
}
