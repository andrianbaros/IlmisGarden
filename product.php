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
        <a href="shop.php">Catalog</a>
        <a href="about.php">About Us</a>
      </div>
      <div class="navbar-extra">
      <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>
      </div>
    </nav>

    <!-- Navbar End -->
<!-- Bouquet Section -->


<section class="bouquet-section" style="margin-top:100px"> 
  <div class="bouquet-card"><a href="imlek.php">
    <img src="img/imlek.png" alt="Imlek" >
    <div class="overlay">
    </div></a>      
  </div>
  <div class="bouquet-card"><a href="bulan-penuh-cinta.php">
    <img src="img/Bulanpenuhcinta.png" alt="Imlek" >
    <div class="overlay">
    </div></a>      
  </div>


  <div class="bouquet-card"><a href="wedding.php">
    <img src="img/Product (2).png" alt="Wedding Bouquet">
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

  <div class="bouquet-card"><a href="decoration.php">
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
<section style="margin-bottom: 100px";>
.
</section>

<footer
  style="
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#283128;
    color:#d9d9d9;
    text-align:center;
    padding:8px 10px;
    z-index:9999;
    font-size:13px;
  ">

  <!-- Address -->
  <div style="margin-bottom:10px;">
  <a
          href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7"
          target="_blank"
          style="color:#d9d9d9;"
        >
    Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135
  </a>  <br>
</div>

  <!-- Social Icons -->
  <div style="display:flex; justify-content:center; gap:28px; align-items:center;">

    <!-- WhatsApp -->
    <a href="https://wa.me/6285795077194"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/>
      </svg>
      <span>WA</span>
    </a>

    <!-- Instagram -->
    <a href="https://www.instagram.com/ilmisgarden/"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/>
      </svg>
      <span>IG</span>
    </a>

    <!-- TikTok -->
    <a href="https://www.tiktok.com/@ilmisgarden"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/>
      </svg>
      <span>TikTok</span>
    </a>

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
