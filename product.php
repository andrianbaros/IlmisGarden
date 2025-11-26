<?php
require 'conn/db.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IlmisGarden</title>
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
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">

      <a href="index.php" class="navbar-logo">
  <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
</a>
      <div class="navbar-nav">
        <a href="product.php"  class="active">Product</a>
        <a href="index.php#catalog">Catalog</a>
        <a href="index.php#about">About Us</a>
      </div>
      <div class="navbar-extra">
      <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>
      </div>
    </nav>

    <!-- Navbar End -->
<!-- Bouquet Section -->


<section class="bouquet-section">
  <div class="bouquet-card"><a href="wedding.php">
    <img src="img/Product (2).png" alt="Wedding Bouquet">
    <div class="overlay">
    </div></a>
  </div>

  <div class="bouquet-card"><a href="bouquet.php">
    <img src="img/Product (3).png" alt="Flower Bouquet" >
    <div class="overlay">
    </div></a>      
  </div>

  <div class="bouquet-card"><a href="workshop.php">
    <img src="img/Product (1).png" alt="Workshop Class">
    <div class="overlay"></a>
    </div>
  </div>

  <div class="bouquet-card"><a href="floral.php">
    <img src="img/FlowerArrangement.png" alt="Flower Arrangement">
    <div class="overlay"></a>
    </div>
  </div>

  <div class="bouquet-card"><a href="plants.php">
    <img src="img/Plants.png" alt="Plants">
    <div class="overlay"></a>
    </div>
  </div>

  <div class="bouquet-card"><a href="decations.php">
    <img src="img/Decorations.png" alt="Decorations">
    <div class="overlay"></a>
    </div>
  </div>

  <div class="bouquet-card"><a href="artisan.php">
    <img src="img/ArtisanProduct.png" alt="Artisan Product">
    <div class="overlay"></a>
    </div>
  </div>
</section>


<!-- Footer -->
<footer class="footer">
  <div style="margin-bottom: 3rem;">
    <a href="" style="padding: 3rem; color:#d9d9d9;">Home</a>
    <a href="" style="padding: 3rem; color:#d9d9d9">About Us</a>
    <a href="" style="padding: 3rem; color:#d9d9d9">Product</a>
    <a href="" style="padding: 3rem; color:#d9d9d9">Contact</a>
  </div>

  <div style="margin-bottom: 3rem;">
    <p>Jalan Raya Golf Dago No. 4, Bandung, Jawa Barat, Indonesia</p>
    <p>(WhatsApp : +62 857-9507-7194 )</p>
  </div>

  <div>
    <p>Follow Us</p>
    <a href=""></a><a href=""></a>
  </div>
</footer>


    <!-- feather icons -->
    <script>
      feather.replace();
    </script>
    <!-- js -->
    <script src="js/script.js"></script>

  </body>
</html>
