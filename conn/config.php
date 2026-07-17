<?php
// Feature flag for special seasonal/marketing campaigns
define('SHOW_EID_COLLECTION', false);

// Secret key for securing campaign URLs via SHA256 HMAC signature
define('CAMPAIGN_SECRET', 'ilmisgarden_secret_key_2026_rfv');

// Whitelisted campaigns that are authorized to receive discounts
$whitelisted_campaigns = [
    'qr_display' => 'Display QR Code Utama',
    'display_qr' => 'Display QR Code Physical'
];

/**
 * Validate signature of a campaign source.
 * 
 * @param string $campaign
 * @param string $signature
 * @return bool
 */
function validate_campaign_signature($campaign, $signature) {
    global $whitelisted_campaigns;
    if (!isset($whitelisted_campaigns[$campaign])) {
        return false;
    }
    $expected = hash_hmac('sha256', $campaign, CAMPAIGN_SECRET);
    return hash_equals($expected, $signature);
}

/**
 * Generate a signed campaign URL.
 * 
 * @param string $campaign
 * @param string $baseUrl
 * @return string
 */
function generate_signed_campaign_url($campaign, $baseUrl = 'index.php') {
    $signature = hash_hmac('sha256', $campaign, CAMPAIGN_SECRET);
    return $baseUrl . '?campaign=' . urlencode($campaign) . '&signature=' . urlencode($signature);
}

/**
 * Record a visit to the campaign
 * 
 * @param PDO $pdo
 * @param string $campaign
 * @param string $source
 * @return void
 */
function record_campaign_visit($pdo, $campaign, $source) {
    try {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $stmt = $pdo->prepare("INSERT INTO campaign_visits (campaign_name, source, ip_address) VALUES (?, ?, ?)");
        $stmt->execute([$campaign, $source, $ip]);
    } catch (Exception $e) {
        // Log error silently, do not interrupt customer experience
        error_log("Campaign track failed: " . $e->getMessage());
    }
}
