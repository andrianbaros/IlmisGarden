<?php
session_start();
include '../db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admins WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $admin = $result->fetch_assoc();

  if (password_verify($password, $admin['password'])) {
    $_SESSION['admin_login'] = true;
    $_SESSION['admin_username'] = $admin['username'];
    header("Location: dashboard.php");
    exit;
  }
}

header("Location: login.php?error=1");
exit;
