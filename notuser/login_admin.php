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
        $_SESSION['admin_id']       = $admin['id_admin'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_email']    = $admin['email'];
        $_SESSION['is_admin']       = true;
        
        $_SESSION['flash_msg'] = "Login berhasil, Selamat datang Admin {$admin['username']}!";
        
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — IlmisGarden</title>
  <link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
  <link rel="icon" href="../img/F4F6F4-full.png" />
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="login-page">
  <div class="login-card">
    <div class="login-card__logo">
      <img src="../img/F4F6F4-full.png" alt="IlmisGarden">
    </div>
    <h2>Admin Panel</h2>
    <p class="login-card__subtitle">Sign in to manage your store</p>

    <form action="" method="POST">
      <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label>Username or Email</label>
        <input type="text" name="login" placeholder="admin@ilmisgarden.com" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
      </div>

      <button type="submit">Sign In</button>
      <div class="switch">
        <a href="../">← Back to Store</a>
      </div>
    </form>
  </div>
</body>
</html>
