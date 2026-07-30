<?php
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../conn/config.php';

use PHPMailer\PHPMailer\PHPMailer;

/**
 * Ensure tables exist for Forgot Password & SMTP
 */
function ensure_forgot_password_tables_exist($pdo) {
    if (!$pdo) return;
    static $checked = false;
    if ($checked) return;
    $checked = true;

    try {
        $pdo->exec("CREATE TABLE IF NOT EXISTS password_reset_tokens (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            email VARCHAR(255) NOT NULL,
            otp_hash VARCHAR(255) NOT NULL,
            failed_attempts INT NOT NULL DEFAULT 0,
            expires_at DATETIME NOT NULL,
            used_at DATETIME NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        $pdo->exec("CREATE TABLE IF NOT EXISTS smtp_settings (
            id INT PRIMARY KEY DEFAULT 1,
            smtp_host VARCHAR(255) NOT NULL DEFAULT 'smtp.gmail.com',
            smtp_port INT NOT NULL DEFAULT 587,
            smtp_user VARCHAR(255) NOT NULL DEFAULT '',
            smtp_pass TEXT NOT NULL,
            smtp_crypto VARCHAR(10) NOT NULL DEFAULT 'tls',
            from_email VARCHAR(255) NOT NULL DEFAULT '',
            from_name VARCHAR(255) NOT NULL DEFAULT 'Ilmis Garden',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

        $chkSmtp = $pdo->query("SELECT COUNT(*) FROM smtp_settings")->fetchColumn();
        if ($chkSmtp == 0) {
            $stmt = $pdo->prepare("INSERT INTO smtp_settings (id, smtp_host, smtp_port, smtp_user, smtp_pass, smtp_crypto, from_email, from_name) VALUES (1, 'smtp.gmail.com', 587, '', '', 'tls', 'no-reply@ilmisgarden.com', 'Ilmis Garden')");
            $stmt->execute();
        }

        $pdo->exec("CREATE TABLE IF NOT EXISTS password_reset_logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NULL,
            email VARCHAR(255) NOT NULL,
            action VARCHAR(100) NOT NULL,
            ip_address VARCHAR(45) NOT NULL,
            user_agent VARCHAR(255) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");
    } catch (Exception $e) {
        error_log("Auto-migrate forgot password tables failed: " . $e->getMessage());
    }
}

/**
 * Get active SMTP Configuration
 */
function get_smtp_config($pdo) {
    ensure_forgot_password_tables_exist($pdo);
    try {
        $stmt = $pdo->query("SELECT * FROM smtp_settings WHERE id = 1 LIMIT 1");
        $cfg = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($cfg) {
            $cfg['smtp_pass_plain'] = decrypt_smtp_pass($cfg['smtp_pass']);
            return $cfg;
        }
    } catch (Exception $e) {
        error_log("Failed to fetch SMTP config: " . $e->getMessage());
    }

    return [
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => 587,
        'smtp_user' => '',
        'smtp_pass' => '',
        'smtp_pass_plain' => '',
        'smtp_crypto' => 'tls',
        'from_email' => 'no-reply@ilmisgarden.com',
        'from_name' => 'Ilmis Garden'
    ];
}

/**
 * Record Audit Log Action
 */
function log_audit_action($pdo, $user_id, $email, $action) {
    ensure_forgot_password_tables_exist($pdo);
    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 250);
        $stmt = $pdo->prepare("INSERT INTO password_reset_logs (user_id, email, action, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $email, $action, $ip, $ua]);
    } catch (Exception $e) {
        error_log("Audit log failed: " . $e->getMessage());
    }
}

/**
 * Build HTML Template for Verification Email
 */
function build_otp_email_html($otp_code, $recipient_email) {
    $logo_url = 'https://ilmisgarden.com/img/F4F6F4-full.png';
    return "
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset='utf-8'>
      <style>
        body { font-family: 'DM Sans', Arial, sans-serif; background-color: #f4f6f4; margin: 0; padding: 20px; color: #283128; }
        .container { max-width: 520px; background: #ffffff; margin: 0 auto; padding: 32px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .header { text-align: center; margin-bottom: 24px; }
        .logo { max-height: 50px; width: auto; margin-bottom: 12px; }
        .title { font-size: 20px; font-weight: 700; color: #283128; margin-bottom: 8px; }
        .subtitle { font-size: 14px; color: #64748b; margin-bottom: 24px; }
        .otp-box { background: #f1f5f9; border: 2px dashed #94a3b8; border-radius: 10px; padding: 20px; text-align: center; margin: 24px 0; }
        .otp-code { font-size: 34px; font-weight: 800; letter-spacing: 8px; color: #283128; font-family: monospace; }
        .notice { font-size: 13px; color: #64748b; line-height: 1.6; text-align: center; }
        .footer { font-size: 12px; color: #94a3b8; text-align: center; margin-top: 32px; border-top: 1px solid #f1f5f9; padding-top: 16px; }
      </style>
    </head>
    <body>
      <div class='container'>
        <div class='header'>
          <img src='{$logo_url}' alt='Ilmis Garden' class='logo'>
          <div class='title'>Kode Verifikasi Reset Password</div>
          <div class='subtitle'>Halo, kami menerima permintaan reset password untuk akun <strong>{$recipient_email}</strong>.</div>
        </div>
        
        <div class='otp-box'>
          <div style='font-size: 12px; text-transform: uppercase; color: #64748b; font-weight: 600; margin-bottom: 8px;'>Kode OTP Verifikasi Anda</div>
          <div class='otp-code'>{$otp_code}</div>
        </div>

        <div class='notice'>
          <strong>Perhatian:</strong> Kode ini hanya berlaku selama <strong>10 menit</strong>.<br>
          Jangan berikan kode ini kepada siapapun. Jika Anda tidak pernah meminta reset password, abaikan email ini.
        </div>

        <div class='footer'>
          &copy; " . date('Y') . " Ilmis Garden. All rights reserved.<br>
          Jl. Raya Golf Dago No.4, Cigadung, Bandung, Jawa Barat
        </div>
      </div>
    </body>
    </html>
    ";
}

/**
 * Send Email via SMTP
 */
function send_smtp_email($pdo, $to_email, $subject, $body_html) {
    $cfg = get_smtp_config($pdo);

    if (empty($cfg['smtp_host']) || empty($cfg['smtp_user'])) {
        return ['success' => false, 'error' => 'Server belum dikonfigurasi untuk pengiriman email. Silakan atur Username & Password SMTP pengirim terlebih dahulu di Dashboard Admin > SMTP Settings.'];
    }

    $mail = new PHPMailer();
    $mail->Host       = $cfg['smtp_host'];
    $mail->Port       = (int)$cfg['smtp_port'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $cfg['smtp_user'];
    $mail->Password   = $cfg['smtp_pass_plain'];
    $mail->SMTPSecure = strtolower($cfg['smtp_crypto']);
    $mail->setFrom(!empty($cfg['from_email']) ? $cfg['from_email'] : $cfg['smtp_user'], $cfg['from_name']);
    $mail->addAddress($to_email);
    $mail->setSubject($subject);
    $mail->setBody($body_html);
    $mail->isHTML(true);

    if ($mail->send()) {
        return ['success' => true];
    } else {
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }
}

/**
 * Test SMTP Connection only
 */
function test_smtp_connection_only($pdo) {
    $cfg = get_smtp_config($pdo);

    if (empty($cfg['smtp_host']) || empty($cfg['smtp_user'])) {
        return ['success' => false, 'error' => 'Konfigurasi Host dan Username SMTP belum diisi.'];
    }

    $mail = new PHPMailer();
    $mail->Host       = $cfg['smtp_host'];
    $mail->Port       = (int)$cfg['smtp_port'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $cfg['smtp_user'];
    $mail->Password   = $cfg['smtp_pass_plain'];
    $mail->SMTPSecure = strtolower($cfg['smtp_crypto']);

    if ($mail->testConnection()) {
        return ['success' => true];
    } else {
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }
}
