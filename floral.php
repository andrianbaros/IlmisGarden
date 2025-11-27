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

  <!-- Bouquet Layout Base -->
  <link rel="stylesheet" href="css/bouquet.css" />
  <!-- Floral Page Extra Styles -->
  <link rel="stylesheet" href="css/floral.css" />
</head>

<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <a href="index.php" class="navbar-logo">
      <img src="img/F4F6F4-full.png" alt="Logo" style="width:200px; height:auto;" />
    </a>

    <div class="navbar-nav">
      <a href="product.php">Product</a>
      <a href="index.php#catalog">Catalog</a>
      <a href="index.php#about">About Us</a>
    </div>

    <div class="navbar-extra">
      <a href="cart.php"><i data-feather="shopping-cart"></i></a>
      <a href="profile.php"><i data-feather="user"></i></a>
      <i id="menu" data-feather="menu"></i>
    </div>
  </nav>

  <!-- HERO (MATCHED WITH BOUQUET STYLE) -->
  <section class="hero floral-hero-fixed">
    <h1 class="left">Ilmisgarden</h1>
    <img src="img/floral.jpg" class="hero-img" />
    <h1 class="right">Merangkai Cerita dalam Bunga</h1>
  </section>

  <!-- INTRO CONTENT -->
  <section class="collection">
    <table class="collection-table">
      <tr>
        <td class="left">Flower</td>
        <td class="right">Arrangement</td>
      </tr>
      <tr>
        <td colspan="2" class="center">By Ilmisgarden</td>
      </tr>
    </table>

    <div class="collection-wrapper">
      <div class="collection-text">
        <p>
          Kami menyediakan berbagai jenis arrangement untuk setiap momen:<br>
          Bouquet, Basket, Bloombox, Vase Arrangement, Standing Flower, Blooming Canvas,
          dan custom sesuai keinginan Anda.
        </p>
      </div>

      <div class="collection-grid">
        <img src="img/floral (5).jpg" alt="">
        <img src="img/floral (4).jpg" alt="">
        <img src="img/floral (3).jpg" alt="">
      </div>
    </div>
  </section>

  <!-- TREND -->
  <section class="flower-bouquet">
    <h2>Selalu Mengikuti Tren</h2>
    <p>Dari Korean Style, rustic, modern minimalis, hingga pastel aesthetic.</p>

    <div class="circle-images">
      <img src="img/floral (5).jpg" />
      <img src="img/floral1.jpeg" />
      <img src="img/floral2.jpeg" />
    </div>
  </section>

  <!-- ASYMMETRIC SECTION -->
  <section class="floral-asym">
    <div class="asym-text">
      <h2>Asimetris Seimbang</h2>
      <p>
        Komposisi khas kami dengan visual flow yang lembut, dinamis,
        dan enak dilihat dari berbagai sudut.
      </p>
    </div>

    <img src="img/floral (4).jpg" class="asym-img" />
  </section>

  <!-- OMAKASE -->
  <section class="flower-bouquet">
    <h2>Omakase</h2>
    <p>Percayakan kreativitas penuh pada florist kami.</p>

    <div class="circle-images">
      <img src="img/floral (3).jpg" />
      <img src="img/floral3.jpeg" />
      <img src="img/floral2.jpeg" />
    </div>
  </section>

  <!-- STANDING FLOWER -->
  <section class="catalog">
    <div class="catalog-item gray">
      <h3>Standing Flower</h3>
      <div class="catalog-content">
        <img src="img/floral3.jpeg">
        <img src="img/floral2.jpeg">
        <img src="img/floral1.jpeg">
      </div>
      <p>Ucapan elegan untuk grand opening, wedding, dan acara penting lainnya.</p>
    </div>

    <!-- Blooming Canvas -->
    <div class="catalog-item gray">
      <h3>Blooming Canvas</h3>
      <div class="catalog-content">
        <img src="img/BloomingCanvas1.png">
        <img src="img/BloomingCanvas2.png">
        <img src="img/BloomingCanvas3.png">
      </div>
      <p>Papan ucapan berbunga berdesain modern, elegan, dan customizable.</p>
    </div>
  </section>

  <!-- BOUQUET SECTION -->
  <section class="flower-bouquet">
    <h2>Flower Bouquet</h2>
    <p>Beautifully arranged to brighten your day.</p>

    <div class="circle-images">
      <img src="img/Ellipse 5.png" />
      <img src="img/Ellipse 6.png" />
      <img src="img/Ellipse 7.png" />
    </div>
  </section>

  <!-- THE CATALOG (CONNECTED TO BOUQUET.CSS) -->
  <section class="catalog">

    <!-- OMAKASE -->
    <div class="catalog-item gray">
      <h3>Omakase</h3>
      <div class="catalog-content">
        <img src="img/Frame 157.png">
        <img src="img/Frame 158.png">
        <img src="img/Frame 1581.png">
      </div>
    </div>

    <!-- ROSE -->
    <div class="catalog-item gray">
      <h3>Rose</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Rose</b> start 50k</div>
          <img src="img/rose1.png" />
          <div class="caption-bottom">1 Stem</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Petite Rose</b> start 85k</div>
          <img src="img/rose2.png" />
          <div class="caption-bottom">3 Stem</div>
        </div>

        <div class="image-wrapper">
          <div class="caption-top"><b>Small Rose</b> start 155k</div>
          <img src="img/rose3.png" />
          <div class="caption-bottom">>5 Stem</div>
        </div>
      </div>
    </div>

    <!-- HYDRANGEA -->
    <div class="catalog-item gray">
      <h3>Hydrangea</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top"><b>Single Blue</b> 77k</div>
          <img src="img/Hydrangea1.png" />
        </div>
        <div class="image-wrapper">
          <div class="caption-top"><b>Purple</b> 126k</div>
          <img src="img/Hydrangea2.png" />
        </div>
        <div class="image-wrapper">
          <div class="caption-top"><b>Small</b> 160k</div>
          <img src="img/Hydrangea3.png" />
        </div>
      </div>
    </div>

    <!-- POM POM -->
    <div class="catalog-item gray">
      <h3>Pom Pom</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top">Single 80k</div>
          <img src="img/PomPom1.png" />
        </div>
        <div class="image-wrapper">
          <div class="caption-top">Medium 350k</div>
          <img src="img/PomPom2.png" />
        </div>
        <div class="image-wrapper">
          <div class="caption-top">Large 450k</div>
          <img src="img/PomPom3.png" />
        </div>
      </div>
    </div>

    <!-- GOMPIE -->
    <div class="catalog-item gray">
      <h3>Small Gompie</h3>
      <div class="catalog-content">
        <div class="image-wrapper">
          <div class="caption-top">Single 170k</div>
          <img src="img/Gompie1.png" />
        </div>
        <div class="image-wrapper">
          <div class="caption-top">Medium 280k</div>
          <img src="img/Gompie2.png" />
        </div>
        <div class="image-wrapper">
          <div class="caption-top">Large 520k</div>
          <img src="img/Gompie3.png" />
        </div>
      </div>
    </div>

  </section>

  <!-- CONTACT -->
  <section class="deco-contact">
    <h2>Diskusikan Rangkaianmu</h2>
    <a href="https://wa.me/6285795077194" target="_blank" class="btn-wa">💬 WhatsApp Kami</a>
  </section>

  <script>
    feather.replace();
  </script>

</body>
</html>
