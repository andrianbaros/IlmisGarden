<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ilmisgarden - Floral Arrangement</title>

  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/floral.css" />
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <a href="index.php" class="navbar-logo">
      <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
    </a>

    <div class="navbar-nav">
      <a href="product.php">Product</a>
      <a href="index.php#catalog">Catalog</a>
      <a href="index.php#about">About Us</a>
    </div>

    <div class="navbar-extra">
      <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
      <a href="profile.php" id="user"><i data-feather="user"></i></a>
      <i id="menu" data-feather="menu"></i>
    </div>
  </nav>

  <section class="floral-hero">
    <h1>Ilmisgarden – Merangkai Cerita dalam Setiap Bunga</h1>
    <p>
      Ilmisgarden hadir sebagai rumah bagi pecinta bunga yang menginginkan rangkaian yang
      indah juga memiliki karakter dan makna. Setiap rangkaian bunga menyampaikan perasaan,
      menciptakan suasana, dan meninggalkan kesan yang tak terlupakan.
    </p>
  </section>

  <section class="floral-content">

    <div class="floral-text">
      <h2>Jenis Flower Arrangement</h2>
      <ul>
        <li>Bouquet Flower</li>
        <li>Basket Flower</li>
        <li>Bloombox Flower</li>
        <li>Vase Arrangement</li>
        <li>Custom arrangement sesuai permintaan</li>
      </ul>
      <p>
        Semua rangkaian dibuat menggunakan bunga pilihan terbaik untuk memastikan tampilan
        yang cantik, harmonis, dan tahan lama.
      </p>
    </div>

  </section>

  <section class="floral-trend">
    <h2>Selalu Mengikuti Tren</h2>
    <p>
      Ilmisgarden terus menyesuaikan desain berdasarkan tren terbaru—modern minimalis,
      rustic, Korean style, pastel aesthetic, hingga desain klasik elegan.
    </p>
    <img src="img/floral (5).jpg" alt="Trend Image" />
  </section>

  <section class="floral-asym">
    <div class="asym-text">
      <h2>Desain Asimetris Seimbang</h2>
      <p>
        Struktur asimetris seimbang memberikan harmoni visual dan flow yang halus sehingga
        rangkaian terlihat tidak monoton dan nyaman untuk dinikmati dari berbagai sudut.
      </p>
    </div>
    <img src="img/floral (4).jpg" class="asym-img" alt="Asymmetric Design" />
  </section>

  <section class="floral-omakase">
    <h2>Omakase</h2>
    <p>
      Percayakan kreativitas penuh kepada kami! Anda cukup memberikan tema warna atau nuansa
      yang diinginkan—sisanya kami yang merangkai.
    </p>
    <img src="img/floral (3).jpg" alt="Omakase Image" />
  </section>

  <section class="floral-pricelist">
    <h2>Pricelist Catalog</h2>
    <table>
      <thead>
        <tr>
          <th>Jenis Produk</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Bouquet Flower</td>
          <td>Rp 250.000</td>
        </tr>
        <tr>
          <td>Basket Flower</td>
          <td>Rp 450.000</td>
        </tr>
        <tr>
          <td>Bloombox Premium</td>
          <td>Rp 380.000</td>
        </tr>
        <tr>
          <td>Vase Arrangement</td>
          <td>Rp 200.000</td>
        </tr>
      </tbody>
    </table>

    <div class="floral-gallery">
      <img src="img/floral.jpg" />
      <img src="img/floral (2).jpg" />
      <img src="img/floral (1).jpg" />
    </div>
  </section>

  <script>
    feather.replace();
  </script>

</body>

</html>
