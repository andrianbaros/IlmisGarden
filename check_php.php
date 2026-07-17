<?php
$dirs = ['.', 'notuser', 'includes', 'js', 'css', 'conn'];
$results = [];

function scanDirRecursive($dir, &$results) {
    $items = glob($dir . '/*');
    foreach ($items as $item) {
        if (is_dir($item)) {
            // scanDirRecursive($item, $results); // we only have specific dirs to scan or we can do full recursion
        } elseif (is_file($item)) {
            $ext = pathinfo($item, PATHINFO_EXTENSION);
            if (in_array($ext, ['php', 'js', 'html', 'css', 'json'])) {
                // skip this script itself and other temporary scratch scripts
                if (in_array(basename($item), ['check_php.php', 'apply_seo_and_links.php', 'patch_database_queries.php', 'update_storefront.php', 'check_user.php', 'check_nav.php', 'migrate_bestseller.php'])) continue;

                $lines = file($item);
                foreach ($lines as $lineNum => $line) {
                    // search for .php
                    if (preg_match('/\.php([?"\'#&\s]|$)/i', $line)) {
                        // ignore server side includes/requires unless user wants them? User asked to check them, but let's categorize them.
                        $type = 'unknown';
                        $lineTrim = trim($line);
                        
                        if (preg_match('/(include|require)(_once)?\s*[\(\'"]+.*\.php/i', $lineTrim)) {
                            $type = 'server_include';
                        } elseif (preg_match('/href\s*=\s*[\'"][^\'"]*\.php/i', $lineTrim)) {
                            $type = 'anchor_href';
                        } elseif (preg_match('/action\s*=\s*[\'"][^\'"]*\.php/i', $lineTrim)) {
                            $type = 'form_action';
                        } elseif (preg_match('/header\s*\(\s*[\'"]Location:.*\.php/i', $lineTrim)) {
                            $type = 'redirect';
                        } elseif (preg_match('/(window\.location|location\.href|location\.replace)\s*=?\s*[\'"][^\'"]*\.php/i', $lineTrim)) {
                            $type = 'js_redirect';
                        } elseif (preg_match('/(fetch|axios|ajax)\s*\(\s*[\'"][^\'"]*\.php/i', $lineTrim)) {
                            $type = 'ajax_call';
                        } elseif (preg_match('/<form.*action=.*\.php/i', $lineTrim)) {
                            $type = 'form_action';
                        } elseif (preg_match('/BASE_URL\s*\.\s*[\'"]\/.*\.php/i', $lineTrim)) {
                            $type = 'php_url_concat';
                        } else {
                            $type = 'other';
                        }

                        $results[] = [
                            'file' => $item,
                            'line' => $lineNum + 1,
                            'code' => $lineTrim,
                            'type' => $type
                        ];
                    }
                }
            }
        }
    }
}

foreach ($dirs as $d) {
    scanDirRecursive($d, $results);
}

// Grouping
$grouped = ['HIGH' => [], 'MEDIUM' => [], 'LOW' => [], 'SERVER_ONLY' => []];

foreach ($results as $res) {
    if ($res['type'] === 'server_include') {
        $grouped['SERVER_ONLY'][] = $res;
    } elseif (in_array($res['type'], ['anchor_href', 'form_action'])) {
        $grouped['HIGH'][] = $res;
    } elseif (in_array($res['type'], ['redirect', 'js_redirect'])) {
        $grouped['HIGH'][] = $res;
    } elseif (in_array($res['type'], ['ajax_call'])) {
        $grouped['MEDIUM'][] = $res;
    } else {
        $grouped['LOW'][] = $res;
    }
}

echo "TOTAL FOUND: " . count($results) . "\n";
echo "HIGH PRIORITY: " . count($grouped['HIGH']) . "\n";
echo "MEDIUM PRIORITY: " . count($grouped['MEDIUM']) . "\n";
echo "LOW PRIORITY: " . count($grouped['LOW']) . "\n";
echo "SERVER ONLY (Include/Require): " . count($grouped['SERVER_ONLY']) . "\n\n";

echo str_pad("FILE", 30) . " | " . str_pad("LINE", 5) . " | " . str_pad("TYPE", 15) . " | OLD URL\n";
echo str_repeat("-", 100) . "\n";

foreach (['HIGH', 'MEDIUM', 'LOW'] as $priority) {
    echo "\n=== $priority PRIORITY ===\n";
    foreach ($grouped[$priority] as $res) {
        $shortFile = str_replace('.\\', '', $res['file']);
        $code = substr($res['code'], 0, 80) . (strlen($res['code']) > 80 ? '...' : '');
        echo str_pad($shortFile, 30) . " | " . str_pad($res['line'], 5) . " | " . str_pad($res['type'], 15) . " | " . $code . "\n";
    }
}
