<?php
session_start();
require 'conn/db.php';

// Pastikan user login
if (!isset($_SESSION['id_user'])) {
    header("Location: signin.php");
    exit;
}

$user_id = $_SESSION['id_user'];

// Ambil data user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id_user=?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Update data user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['username'];
    $email   = $_POST['email'];
    $address = $_POST['address'];

    // Password update opsional
    if (!empty($_POST['current_password']) && !empty($_POST['new_password'])) {
        if (password_verify($_POST['current_password'], $user['password'])) {
            if ($_POST['new_password'] === $_POST['confirm_password']) {
                $newPass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET name=?, email=?, address=?, password=? WHERE id_user=?");
                $stmt->execute([$name, $email, $address, $newPass, $user_id]);
                $msg = "Profil berhasil diperbarui.";
            } else {
                $msg = "Konfirmasi password tidak cocok.";
            }
        } else {
            $msg = "Password lama salah.";
        }
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username=?, email=?, address=? WHERE id_user=?");
        $stmt->execute([$name, $email, $address, $user_id]);
        $msg = "Profil berhasil diperbarui (tanpa ganti password).";
    }

    // Refresh data user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user=?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile - Ilmisgarden</title>
  <link rel="stylesheet" href="css/profile.css">
</head>
<body>
  <!-- HEADER -->
  <header class="header">
    <div class="logo">🌿 <span>ILMISGARDEN</span></div>
    <nav class="nav-links">
      <a href="shop.php">Product</a>
      <a href="#">Catalog</a>
      <a href="#">Workshop</a>
      <a href="#">About Us</a>
    </nav>
    <div class="nav-icons">
      <a href="#">🔍</a>
      <a href="cart.php">🛒</a>
      <a href="profile.php">👤</a>
    </div>
  </header>

  <!-- MAIN -->
  <main class="profile-container">
    <div class="tabs">
      <a href="profile.php" class="active">Profile</a>
      <a href="#">Transaction</a>
      <a href="#">Coupon</a>
      <a href="#">Membership</a>
    </div>

    <?php if (!empty($msg)): ?>
      <p class="alert"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <form method="POST" class="profile-form">

      <label>Name</label>
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

      <label>Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label>Address</label>
      <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">

      <label>Current Password</label>
      <input type="password" name="current_password" placeholder="enter your current password">

      <label>New Password</label>
      <input type="password" name="new_password" placeholder="enter your new password">

      <label>Confirm Password</label>
      <input type="password" name="confirm_password" placeholder="confirm your new password">

      <div class="form-actions">
        <button type="reset" class="cancel">Cancel</button>
        <button type="submit" class="save">Save</button>
      </div>
    </form>
  </main>
</body>
</html>
