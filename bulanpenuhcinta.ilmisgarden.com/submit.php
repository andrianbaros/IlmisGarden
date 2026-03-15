<?php
include 'db.php';

$sender_name      = trim($_POST['sender_name']);
$sender_contact   = trim($_POST['sender_contact']);
$receiver_name    = trim($_POST['receiver_name']);
$receiver_contact = trim($_POST['receiver_contact']);
$reason           = trim($_POST['reason']);
$message          = trim($_POST['message']);
$is_anonymous     = isset($_POST['is_anonymous']) ? 1 : 0;

// VALIDASI
if (
  empty($sender_name) ||
  empty($sender_contact) ||
  empty($receiver_name) ||
  empty($receiver_contact) ||
  empty($message)
) {
  die("Semua data wajib diisi kecuali alasan ❤️");
}

// TOKEN
$token = bin2hex(random_bytes(16));

// INSERT
$sql = "INSERT INTO confess
(sender_name, sender_contact, receiver_name, receiver_contact, reason, message, is_anonymous, token)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
  "ssssssis",
  $sender_name,
  $sender_contact,
  $receiver_name,
  $receiver_contact,
  $reason,
  $message,
  $is_anonymous,
  $token
);

$stmt->execute();

header("Location: thanks.php");
exit;
