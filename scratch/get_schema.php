<?php
require 'conn/db.php';

try {
    $stmt = $pdo->query("SHOW TABLES");
    echo "Tables:\n";
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "- " . $row[0] . "\n";
    }

    $stmt = $pdo->query("DESCRIBE transactions");
    echo "\nTransactions Table:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }

    $stmt = $pdo->query("DESCRIBE campaign_visits");
    echo "\nCampaign Visits Table:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
