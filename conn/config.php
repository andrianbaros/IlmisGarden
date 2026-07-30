<?php
// Feature flag for special seasonal/marketing campaigns
define('SHOW_EID_COLLECTION', false);

// Secret key for securing campaign URLs
define('CAMPAIGN_SECRET', 'ilmisgarden_secret_key_2026_rfv');

// Secret key for encrypting SMTP password in database
define('SMTP_SECRET_KEY', 'ilmisgarden_smtp_enc_key_2026_secure');

/**
 * Encrypt SMTP Password
 */
function encrypt_smtp_pass($plain_text) {
    if (empty($plain_text)) return '';
    $key = hash('sha256', SMTP_SECRET_KEY, true);
    $iv = openssl_random_pseudo_bytes(16);
    $cipher = openssl_encrypt($plain_text, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $cipher);
}

/**
 * Decrypt SMTP Password
 */
function decrypt_smtp_pass($encrypted_text) {
    if (empty($encrypted_text)) return '';
    $raw = base64_decode($encrypted_text);
    if (strlen($raw) < 17) return $encrypted_text;
    $key = hash('sha256', SMTP_SECRET_KEY, true);
    $iv = substr($raw, 0, 16);
    $cipher = substr($raw, 16);
    $decrypted = openssl_decrypt($cipher, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted !== false ? $decrypted : $encrypted_text;
}

/**
 * Generate a campaign URL with code and token
 * 
 * @param string $campaignCode
 * @param string $token
 * @param string $baseUrl
 * @return string
 */
function generate_campaign_url($campaignCode, $token, $baseUrl = null) {
    if (!$baseUrl) {
        $baseUrl = defined('BASE_URL') ? BASE_URL . '/' : '/';
    }
    return rtrim($baseUrl, '/') . '/?campaign=' . urlencode($campaignCode) . '&token=' . urlencode($token);
}

/**
 * Backward compatibility signature generator
 */
function generate_signed_campaign_url($campaign, $baseUrl = 'index.php') {
    $signature = hash_hmac('sha256', $campaign, CAMPAIGN_SECRET);
    return $baseUrl . '?campaign=' . urlencode($campaign) . '&signature=' . urlencode($signature);
}

/**
 * Ensure campaigns table exists automatically
 * 
 * @param PDO $pdo
 * @return void
 */
function ensure_campaign_tables_exist($pdo) {
    if (!$pdo) return;
    static $checked = false;
    if ($checked) return;
    $checked = true;

    try {
        $sql = "CREATE TABLE IF NOT EXISTS campaigns (
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
        $pdo->exec($sql);

        $chk = $pdo->query("SELECT COUNT(*) FROM campaigns")->fetchColumn();
        if ($chk == 0) {
            $token = bin2hex(random_bytes(16));
            $stmt = $pdo->prepare("INSERT INTO campaigns (campaign_name, campaign_code, campaign_token, discount_type, discount_value, status) VALUES (?, ?, ?, 'percent', 10.00, 'ACTIVE')");
            $stmt->execute(['Display QR Code Utama', 'DISPLAY2026', $token]);
        }
    } catch (Exception $e) {
        error_log("Auto-migrate campaigns table error: " . $e->getMessage());
    }
}

/**
 * Validate campaign against database
 * 
 * @param PDO $pdo
 * @param string $campaignCode
 * @param string|null $token
 * @param string|null $signature
 * @return array|false
 */
function validate_db_campaign($pdo, $campaignCode, $token = null, $signature = null) {
    if (!$pdo || empty($campaignCode)) return false;

    ensure_campaign_tables_exist($pdo);

    try {
        $stmt = $pdo->prepare("
            SELECT * FROM campaigns 
            WHERE campaign_code = ? 
              AND status = 'ACTIVE'
              AND (start_date IS NULL OR start_date <= NOW())
              AND (end_date IS NULL OR end_date >= NOW())
            LIMIT 1
        ");
        $stmt->execute([$campaignCode]);
        $camp = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$camp) return false;

        // Token / Signature validation
        if ($token !== null && $token !== '') {
            if (!hash_equals($camp['campaign_token'], $token)) {
                return false;
            }
        } elseif ($signature !== null && $signature !== '') {
            $expected = hash_hmac('sha256', $campaignCode, CAMPAIGN_SECRET);
            if (!hash_equals($expected, $signature) && !hash_equals($camp['campaign_token'], $signature)) {
                return false;
            }
        }

        return $camp;
    } catch (Exception $e) {
        error_log("Campaign DB validation error: " . $e->getMessage());
        return false;
    }
}

/**
 * Retrieve and re-validate current user's active campaign from session/cookie
 * 
 * @param PDO $pdo
 * @return array|false
 */
function get_active_user_campaign($pdo) {
    if (!$pdo) return false;

    $campaignCode = $_SESSION['campaign_code'] ?? ($_COOKIE['campaign_code'] ?? ($_SESSION['campaign_source'] ?? ($_COOKIE['campaign_source'] ?? null)));
    $token = $_SESSION['campaign_token'] ?? ($_COOKIE['campaign_token'] ?? null);

    if (!$campaignCode) {
        return false;
    }

    $camp = validate_db_campaign($pdo, $campaignCode, $token);

    if ($camp) {
        // Refresh session
        $_SESSION['campaign_id']             = $camp['id'];
        $_SESSION['campaign_code']           = $camp['campaign_code'];
        $_SESSION['campaign_name']           = $camp['campaign_name'];
        $_SESSION['campaign_discount_type']  = $camp['discount_type'];
        $_SESSION['campaign_discount_value'] = $camp['discount_value'];
        $_SESSION['campaign_token']          = $camp['campaign_token'];
        $_SESSION['campaign_source']         = $camp['campaign_code'];
        $_SESSION['campaign_discount']       = ($camp['discount_type'] === 'percent') ? ($camp['discount_value'] / 100.0) : 0;
        return $camp;
    } else {
        // Clear invalid/expired campaign from session & cookie
        unset($_SESSION['campaign_id'], $_SESSION['campaign_code'], $_SESSION['campaign_name'], $_SESSION['campaign_discount_type'], $_SESSION['campaign_discount_value'], $_SESSION['campaign_token'], $_SESSION['campaign_source'], $_SESSION['campaign_discount']);
        setcookie('campaign_code', '', time() - 3600, '/');
        setcookie('campaign_token', '', time() - 3600, '/');
        setcookie('campaign_source', '', time() - 3600, '/');
        return false;
    }
}

/**
 * Record a visit to the campaign
 * 
 * @param PDO $pdo
 * @param array|int $campaignData
 * @param string $source
 * @return void
 */
function record_campaign_visit($pdo, $campaignData, $source = 'QR') {
    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $cId = is_array($campaignData) ? ($campaignData['id'] ?? null) : $campaignData;
        $cCode = is_array($campaignData) ? ($campaignData['campaign_code'] ?? null) : null;
        $cName = is_array($campaignData) ? ($campaignData['campaign_name'] ?? null) : (is_string($campaignData) ? $campaignData : 'Unknown');

        $stmt = $pdo->prepare("INSERT INTO campaign_visits (campaign_id, campaign_code, campaign_name, source, ip_address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$cId, $cCode, $cName, $source, $ip]);
    } catch (Exception $e) {
        error_log("Campaign track failed: " . $e->getMessage());
    }
}

