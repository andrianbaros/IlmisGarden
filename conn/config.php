<?php
// Feature flag for special seasonal/marketing campaigns
define('SHOW_EID_COLLECTION', false);

// Secret key for securing campaign URLs
define('CAMPAIGN_SECRET', 'ilmisgarden_secret_key_2026_rfv');

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

