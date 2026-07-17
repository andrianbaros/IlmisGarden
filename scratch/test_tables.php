<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=ilmisgarden;charset=utf8mb4", "root", "");
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    print_r($tables);
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
