<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ilmis Garden</title>
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

    <link rel="stylesheet" href="css/bouquet.css" />
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">
      <a href="#home" class="navbar-logo"
        ><img src="img/F4F6F4-full.png" alt=""
      /></a>

      <div class="navbar-nav">
        <a href="#wedding">Wedding</a>
        <a href="#workshop">Workshop</a>
        <a href="#catalog">Catalog</a>
        <a href="#about">About Us</a>
      </div>
      <div class="navbar-extra">
        <a href="" id="search"><i data-feather="search"></i></a>
        <a href="" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <i id="menu" data-feather="menu"></i>
      </div>
    </nav>

    <!-- Navbar End -->

  <!-- Hero Section -->
  <section class="hero">
    <h1>Bouquet</h1>
    <p>Crafted with Love, Created to Bloom</p>
    <img src="img/rose.png" alt="Rose" class="hero-img">
  </section>

  <!-- Blooming Collection -->
  <section class="collection">
    <h2>Explore Our Blooming Collection</h2>
    <p>Discover the beauty of our bouquets designed for every occasion.</p>
    <div class="collection-grid">
      <img src="img/coll1.png" alt="Collection 1">
      <img src="img/coll2.png" alt="Collection 2">
      <img src="img/coll3.png" alt="Collection 3">
      <img src="img/coll4.png" alt="Collection 4">
    </div>
  </section>

  <!-- Flower Bouquet Section -->
  <section class="flower-bouquet">
    <h2>Flower Bouquet</h2>
    <p>Beautifully arranged to brighten your day.</p>
    <div class="circle-images">
      <img src="img/bouquet1.png" alt="Bouquet 1">
      <img src="img/bouquet2.png" alt="Bouquet 2">
      <img src="img/bouquet3.png" alt="Bouquet 3">
    </div>
  </section>

  <!-- Static Catalog (per jenis bunga) -->
  <section class="catalog">

    <!-- Rose -->
    <div class="catalog-item">
      <h3>Rose</h3>
      <div class="catalog-content">
        <img src="img/rose1.png" alt="Rose 1">
        <img src="img/rose2.png" alt="Rose 2">
      </div>
      <p>The classic flower of love and elegance, perfect for any occasion.</p>
      <div class="colors">
        <span style="background:red"></span>
        <span style="background:pink"></span>
        <span style="background:orange"></span>
        <span style="background:yellow"></span>
        <span style="background:purple"></span>
      </div>
    </div>

    <!-- Hydrangea -->
    <div class="catalog-item gray">
      <h3>Hydrangea</h3>
      <div class="catalog-content">
        <img src="img/hyd1.png" alt="Hydrangea 1">
        <img src="img/hyd2.png" alt="Hydrangea 2">
      </div>
      <p>Soft, voluminous petals that symbolize gratitude and grace.</p>
      <div class="colors">
        <span style="background:blue"></span>
        <span style="background:violet"></span>
        <span style="background:purple"></span>
      </div>
    </div>

    <!-- Tambah section lain: Peony, Gypsophila, Sunflower, dll sesuai desain -->
    
  </section>

  <!-- Footer -->
  <footer class="footer">
    <p>&copy; 2025 Your Flower Shop | Jl. Raya Golf Dago No.4, Bandung</p>
  </footer>
    <!-- feather icons -->
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>
