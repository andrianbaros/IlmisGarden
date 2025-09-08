<?php
session_start();
require 'conn/db.php';

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = (int)$_POST['cart_id'];

    // Hapus produk dari cart milik user
    $stmt = $pdo->prepare("DELETE FROM cart WHERE id_cart=? AND user_id=?");
    $stmt->execute([$cart_id, $user_id]);
}

// Balik ke cart
header("Location: cart.php");
exit;
