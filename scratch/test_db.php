<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;charset=utf8mb4", "root", "");
    echo "Connected successfully to localhost with root/empty password\n";
    $databases = $pdo->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
    print_r($databases);
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
