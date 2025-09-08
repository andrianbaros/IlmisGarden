<?php
session_start();
require 'conn/db.php';

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'], $_POST['action'])) {
    $cart_id = (int)$_POST['cart_id'];
    $action  = $_POST['action'];

    // Ambil qty sekarang
    $stmt = $pdo->prepare("SELECT qty FROM cart WHERE id_cart=? AND user_id=?");
    $stmt->execute([$cart_id, $user_id]);
    $row = $stmt->fetch();

    if ($row) {
        $qty = (int)$row['qty'];

        if ($action === "plus") {
            $qty++;
        } elseif ($action === "minus") {
            $qty--;
        }

        if ($qty <= 0) {
            // hapus cart kalau qty 0
            $del = $pdo->prepare("DELETE FROM cart WHERE id_cart=? AND user_id=?");
            $del->execute([$cart_id, $user_id]);
        } else {
            // update qty
            $upd = $pdo->prepare("UPDATE cart SET qty=? WHERE id_cart=? AND user_id=?");
            $upd->execute([$qty, $cart_id, $user_id]);
        }
    }
}

// Kembali ke cart
header("Location: cart.php");
exit;
