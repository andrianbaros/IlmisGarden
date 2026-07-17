<?php
require 'conn/db.php';
$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "ALL USERS:\n";
print_r($users);
