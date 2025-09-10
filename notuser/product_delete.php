<?php
require '../conn/db.php'; // koneksi PDO

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Product ID required");
}

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: product.php?msg=deleted");
exit;
