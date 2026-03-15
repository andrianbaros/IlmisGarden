<?php
$host = "103.247.9.152";
$user = "ilmi8192_valentine";
$pass = "%5Pk*i&Z+OOg(kZb";
$db   = "ilmi8192_valentine";
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("DB Connection Failed: " . $conn->connect_error);
}
?>
