<?php
session_start();
require '../conn/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login    = trim($_POST['login']);   // bisa username atau email
    $password = trim($_POST['password']);

    // cek login dengan username atau email
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ? OR username = ?");
    $stmt->execute([$login, $login]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['id_admin']   = $admin['id_admin'];
        $_SESSION['username']   = $admin['username'];
        $_SESSION['email']      = $admin['email'];
        $_SESSION['is_admin']   = true;

        $_SESSION['flash_msg'] = "Login berhasil, Selamat datang Admin {$admin['username']}!";

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username/Email atau Password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="user.css">
</head>
<body>
  <div class="container">
    <form action="" method="POST">
      <h2>Admin Sign In</h2>
      <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label>Username / Email</label>
        <input type="text" name="login" placeholder="username atau admin@gmail.com" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="enter admin password" required>
      </div>

      <button type="submit">Login Admin</button>
      <div class="switch">
        <a href="../signin.php">Login sebagai User</a>
      </div>
    </form>
  </div>
</body>
</html>
