<?php
require 'conn/db.php';

try {
    $stmt = $pdo->query("DESCRIBE admin");
    echo "Admin table schema:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }

    $stmt = $pdo->query("SELECT * FROM admin");
    $admins = $stmt->fetchAll();
    echo "\nCurrent Admin records:\n";
    foreach ($admins as $a) {
        echo "- ID: {$a['id_admin']}, Username: {$a['username']}, Email: {$a['email']}\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
