<?php
include 'conn/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username   = $_POST['username'];
    $email      = $_POST['email'];
    $whatsapp   = $_POST['whatsapp'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob        = $_POST['dob'];
    $address    = $_POST['address'];

    // Cek email atau WA sudah terdaftar
    $check = $pdo->prepare("SELECT email FROM users WHERE email = ? OR whatsapp = ?");
    $check->execute([$email, $whatsapp]);

    if ($check->rowCount() > 0) {
        echo "<script>alert('Email atau No WhatsApp sudah digunakan'); window.location='signup.php';</script>";
        exit;
    }

    // Generate ID user
    $stmt = $pdo->query("SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1");
    $last = $stmt->fetch();

    if ($last) {
        $num = intval(substr($last['id_user'], 2)) + 1;
        $new_id = "IL" . str_pad($num, 3, "0", STR_PAD_LEFT);
    } else {
        $new_id = "IL001";
    }
if ($_POST['password'] !== $_POST['confirm']) {
    echo "<script>alert('Password tidak sama'); window.location='signup.php';</script>";
    exit;
}

    // Insert user
    $stmt = $pdo->prepare("
        INSERT INTO users 
        (id_user, username, email, whatsapp, password, date_of_birth, address) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt->execute([$new_id, $username, $email, $whatsapp, $password, $dob, $address])) {
        echo "<script>alert('Registrasi berhasil!'); window.location='signin.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal');</script>";
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
  <label>No WhatsApp</label>
  <input 
    type="text" 
    name="whatsapp" 
    placeholder="08xxxxxxxxxx" 
    pattern="^[0-9]{10,15}$"
    required
  >
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
      <div class="form-group">
        <label>Address</label> <!-- ✅ Tambahkan field alamat -->
        <textarea name="address" placeholder="masukkan alamat lengkap..." required></textarea>
      </div>
      <button type="submit">Sign Up</button>
      <div class="switch">
        Already have an account? <a href="signin.php">Sign In</a>
      </div>
    </form>
  </div>
</body>
</html>
