<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ilmis Garden | Artisan Product</title>
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
  <link rel="stylesheet" href="css/artisan.css" />
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

  <!-- Hero Intro -->
  <section class="artisan-hero">
    <div class="artisan-container">
      <h1>Artisan Collection</h1>
      <p>
        Di balik setiap produk kami, ada sebuah cerita tentang keindahan, craftsmanship, dan sentuhan bunga yang membawa ketenangan.
        Melalui Artisan Collection, kami menghadirkan rangkaian produk fungsional berbahan dasar bunga yang dibuat secara khusus
        bersama pengrajin lokal Bandung.
      </p>

      <p>
        Setiap produk dalam koleksi ini tidak hanya indah untuk dilihat, tetapi juga mampu meningkatkan mood dan membuat perasaan
        jauh lebih baik. Kami percaya bahwa bunga bukan hanya dekorasi — tetapi sebuah pengalaman emosi.
      </p>
    </div>
  </section>

  <!-- Product Section -->
  <section class="artisan-section">
    <div class="artisan-card">
      <div class="artisan-img">
        <img src="img/artisan1.jpg" alt="Floral Tea">
      </div>
      <div class="artisan-content">
        <h2>1. Floral Tea</h2>
        <p>
          Floral Tea adalah koleksi paling spesial dari Artisan Series. Diracik bersama Hage Natural, teh ini memadukan keindahan
          bunga dengan cita rasa lembut dan manfaat relaksasi. Menggunakan camomile dan lavender premium yang memberi efek menenangkan.
        </p>
      </div>
    </div>

    <div class="artisan-card reverse">
      <div class="artisan-img">
        <img src="img/artisan2.jpg" alt="Diffuser">
      </div>
      <div class="artisan-content">
        <h2>2. Diffuser</h2>
        <p>
          Diffuser Floral kami adalah perpaduan aroma menenangkan dan visual dekoratif yang estetik. Menggunakan essential oil
          premium dan potongan bunga asli di dalam botolnya, menciptakan dekor minimalis natural untuk berbagai gaya interior.
        </p>
      </div>
    </div>

    <div class="artisan-card">
      <div class="artisan-img">
        <img src="img/artisan3.jpg" alt="Blooming Bar">
      </div>
      <div class="artisan-content">
        <h2>3. Blooming Bar & Lush Petals</h2>
        <p>
          Kolaborasi bersama RawGlow Rituals menghadirkan Blooming Bar dan Lush Petals — perawatan tubuh botanical premium.
          Blooming Bar diformulasikan dari VCO, Sunflower Oil, Olive Oil, dan petal bunga pilihan.
        </p>
        <ul>
          <li>Lavender — relaks dan menenangkan</li>
          <li>Floral — lembut dan elegan</li>
          <li>Fresh — segar dan membangkitkan energi</li>
          <li>Coconut — creamy dan tropis</li>
        </ul>
      </div>
    </div>

    <div class="artisan-card reverse">
      <div class="artisan-img">
        <img src="img/artisan4.jpg" alt="Lush Petals">
      </div>
      <div class="artisan-content">
        <h2>Lush Petals — Body Scrub</h2>
        <p>
          Body scrub yang mengangkat sel kulit mati secara gentle dengan botanical oils & petal bunga. Menjaga hidrasi dan
          membuat kulit halus seperti sutra.
        </p>
        <ul>
          <li>Floral — lembut & romantis</li>
          <li>Mint — segar & dingin</li>
          <li>Lavender — menenangkan</li>
        </ul>
      </div>
    </div>
  </section>

  <script>
    feather.replace();
  </script>
</body>
</html>
