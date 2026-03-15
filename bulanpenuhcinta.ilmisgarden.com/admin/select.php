<?php
include '../db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  die("ID tidak valid");
}

// set terpilih
$stmt = $conn->prepare(
  "UPDATE confess SET is_selected = 1 WHERE id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();

// balik ke dashboard biasa
header("Location: dashboard.php");
exit;
