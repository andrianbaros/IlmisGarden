<?php
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location: login_admin.php");
    exit;
}

require '../conn/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Product ID required");
}

/* ============================
   Ambil semua gambar produk
============================ */
$stmt = $pdo->prepare(
    "SELECT image FROM product_images WHERE product_id = ?"
);
$stmt->execute([$id]);
$images = $stmt->fetchAll();

/* ============================
   Hapus file gambar fisik
============================ */
foreach ($images as $img) {
    $filePath = "../" . $img['image'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

/* ============================
   Hapus data produk
   (product_images ikut terhapus
    karena ON DELETE CASCADE)
============================ */
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: product.php?msg=deleted");
exit;
