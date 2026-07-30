<?php
require 'conn/db.php';

try {
    $stmt = $pdo->query("DESCRIBE users");
    echo "Users Table:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
