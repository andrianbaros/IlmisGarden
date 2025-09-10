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
                $stmt = $pdo->prepare("UPDATE users SET username=?, email=?, address=?, password=? WHERE id_user=?");
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ilmisgarden</title>
      <link rel="icon" href="img/F4F6F4-full.png" />

    <!-- Fonts -->
    <!-- 1. Preconnect ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <!-- 2. Preload stylesheet Google Fonts -->
    <link
      rel="preload"
      as="style"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />

    <!-- 3. Load stylesheet font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet"
    />

    <!-- 4. Fallback untuk browser lama / tanpa JavaScript -->
    <noscript>
      <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
        rel="stylesheet"
      />
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet"
      />
    </noscript>

    <!-- Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />

    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="css/navbar.css" />
  <link rel="stylesheet" href="css/profile.css" />

</head>
<body >
<!-- Navbar Start -->
    <nav class="navbar">
      <a href="index.php" class="navbar-logo"><img src="img/F4F6F4-full.png" alt="Logo" /></a>

      
      <div class="navbar-nav">
        <a href="product.php">Product</a>
        <a href="index.php#workshop">Workshop</a>
        <a href="index.php#catalog">Catalog</a>
        <a href="index.php#about">About Us</a>
      </div>
      <div class="navbar-extra">
        
      <?php if (isset($_SESSION['id_user'])): ?>
        <span style="margin-right:20px;">
          Hello, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
        </span>
        <a href="logout.php"><i data-feather="log-out"></i></a>
      <?php else: ?>
        <a href="signin.php"><i data-feather="log-in"></i></a>
      <?php endif; ?>

        <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>

      </div>
    </nav>
    <!-- Navbar End -->

  <!-- MAIN -->
  <main class="profile-container">
    <div class="tabs">
      <a href="profile.php" class="active">Profile</a>
      <a href="transaction.php">Transaction</a>
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
      <!-- feather icons -->
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>
