<?php
require 'conn/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Page Not Found | Ilmis Garden</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>/css/navbar.css">
  <link rel="icon" href="<?= BASE_URL ?>/img/F4F6F4-full.png" />
  <style>
    .not-found {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 70vh;
      text-align: center;
      padding: 2rem;
    }
    .not-found h1 {
      font-size: 5rem;
      font-family: 'Cormorant Garamond', serif;
      color: var(--sage);
      margin-bottom: 1rem;
    }
    .not-found p {
      font-size: 1.1rem;
      color: var(--charcoal);
      margin-bottom: 2rem;
    }
    .not-found .btn-primary {
      padding: 0.8rem 1.5rem;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <?php include 'includes/navbar.php'; ?>

  <main class="not-found">
    <h1>404</h1>
    <p>Maaf, halaman yang Anda cari tidak ditemukan.</p>
    <a href="<?= BASE_URL ?>/" class="btn-primary">Kembali ke Beranda</a>
  </main>

</body>
</html>
