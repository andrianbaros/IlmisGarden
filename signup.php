<?php
include 'conn/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob        = $_POST['dob'];

    // Cek apakah email sudah terdaftar
    $check = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "<script>alert('Email sudah digunakan, silakan pakai email lain.'); window.location='signup.php';</script>";
        exit;
    }

    // Ambil id terakhir
    $stmt = $pdo->query("SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1");
    $last = $stmt->fetch();

    if ($last) {
        $num = intval(substr($last['id_user'], 2)) + 1;
        $new_id = "IL" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $new_id = "IL001";
    }

    // Insert data (pakai address kosong biar nggak error)
    $address = '';

    $stmt = $pdo->prepare("INSERT INTO users (id_user, username, email, password, date_of_birth, address) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$new_id, $username, $email, $password, $dob, $address])) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='signin.php';</script>";
    } else {
        echo "<script>alert('Gagal daftar, coba lagi.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="css/user.css">
</head>
<body>
  <div class="container">
    <form method="POST">
      <h2>Sign Up</h2>
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" placeholder="username" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="example@gmail.com" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="enter your password" required>
      </div>
      <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm" placeholder="confirm your password" required>
      </div>
      <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="dob" required>
      </div>
      <button type="submit">Sign Up</button>
      <div class="switch">
        Already have an account? <a href="signin.php">Sign In</a>
      </div>
    </form>
  </div>
</body>
</html>
