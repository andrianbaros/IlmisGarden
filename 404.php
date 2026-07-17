<?php
http_response_code(404);
require 'conn/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Tidak Ditemukan (404) | Ilmis Garden</title>
  <link rel="icon" href="<?= BASE_URL ?>/img/F4F6F4-full.png" />
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  
  <style>
    :root {
      --forest: #283128;
      --sage: #708871;
      --cream: #f8faf8;
      --charcoal: #2d2d2d;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      font-family: 'DM Sans', sans-serif;
      background-color: var(--cream);
      color: var(--charcoal);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      text-align: center;
      padding: 20px;
    }
    .error-container {
      max-width: 500px;
      background: #ffffff;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(40,49,40,0.05);
      border: 1px solid rgba(112,136,113,0.15);
    }
    .error-code {
      font-family: 'Cormorant Garamond', serif;
      font-size: 6rem;
      font-weight: 300;
      color: var(--sage);
      line-height: 1;
      margin-bottom: 10px;
    }
    h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2rem;
      font-weight: 400;
      color: var(--forest);
      margin-bottom: 16px;
    }
    p {
      font-size: 0.95rem;
      color: #666;
      line-height: 1.6;
      margin-bottom: 28px;
    }
    .btn-home {
      display: inline-block;
      background-color: var(--sage);
      color: #ffffff;
      padding: 12px 28px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.9rem;
      transition: background-color 0.2s ease;
    }
    .btn-home:hover {
      background-color: var(--forest);
    }
  </style>
</head>
<body>
  <div class="error-container">
    <div class="error-code">404</div>
    <h1>Halaman Tidak Ditemukan</h1>
    <p>Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan. Silakan kembali ke beranda kami untuk menjelajahi koleksi bunga premium lainnya.</p>
    <a href="<?= BASE_URL ?>/" class="btn-home">Kembali ke Beranda</a>
  </div>
</body>
</html>
