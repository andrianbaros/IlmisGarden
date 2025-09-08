<?php
session_start();
require 'conn/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Simpan data ke session
        $_SESSION['id_user']   = $user['id_user'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['email']     = $user['email'];

        // Simpan pesan welcome di session (opsional)
        $_SESSION['flash_msg'] = "Login berhasil, Selamat datang {$user['username']}!";

        // Redirect
        header("Location: shop.php");
        exit;
    } else {
        $error = "Email atau Password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="css/user.css">
</head>
<body>
  <div class="container">
    <form action="" method="POST">
      <h2>Sign In</h2>
      <?php if (!empty($error)): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="example@gmail.com" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="enter your password" required>
      </div>

      <button type="submit">Sign In</button>
      <div class="switch">
        Don’t have an account? <a href="signup.php">Sign Up</a>
      </div>
    </form>
  </div>
</body>
</html>
