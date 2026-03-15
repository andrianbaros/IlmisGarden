<?php
session_start();
if (isset($_SESSION['admin_login'])) {
  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body class="page">

<div class="container card" style="max-width:400px;">
  <h2>🔐 Login Admin</h2>

  <?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Login gagal</p>
  <?php endif; ?>

  <form action="login_process.php" method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Masuk</button>
  </form>
</div>

</body>
</html>
