<?php
session_start();
include 'conn/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Simpan data ke session
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        // Redirect ke halaman utama / dashboard
        echo "<script>alert('Login berhasil, Selamat datang {$user['username']}!'); 
              window.location='index.php';</script>";
        exit;
    } else {
        echo "<script>alert('Email atau Password salah');</script>";
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
