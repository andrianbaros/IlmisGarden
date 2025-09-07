<?php
session_start(); // Tambahkan ini
require 'conn/db.php';

// Ambil 4 produk terbaru untuk Best Sellers
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
$bestsellers = $stmt->fetchAll();

// Ambil semua produk (dengan filter harga jika ada) untuk bagian Catalog
$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = $priceFilterActive && isset($_GET['max_price']) ? (int)$_GET['max_price'] : null;

if ($priceFilterActive && $maxPrice !== null) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE price <= ? ORDER BY id DESC");
    $stmt->execute([$maxPrice]);
    $products = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll();
}
?>

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
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
<!-- Navbar Start -->
    <nav class="navbar">
      <a href="index.php" class="navbar-logo"><img src="img/F4F6F4-full.png" alt="Logo" /></a>

      <div class="navbar-nav">
        <a href="product.php">Product</a>
        <a href="#workshop">Workshop</a>
        <a href="#catalog">Catalog</a>
        <a href="#about">About Us</a>
      </div>
      <div class="navbar-extra">
        
        <?php if (isset($_SESSION['id_user'])): ?>
          <span style="margin-right:70px; margin-bottom: 10px;">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
          <a href="logout.php" style="margin-left:10px;"><i data-feather="log-out"></i></a>
        <?php else: ?>
          <a href="signin.php" style="margin-left:10px;"><i data-feather="log-in"></i></a>
        <?php endif; ?>
        <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <i id="menu" data-feather="menu"></i>

      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Navbar End -->
    <!-- Hero Sections-->
    <!-- hero section start-->
    <section class="hero" id="home">
      <div class="slideshow">
        <div
          class="slide active"
          style="background-image: url('img/Picture1.png')"
        ></div>
        <div
          class="slide"
          style="background-image: url('img/fl\ \(2\).jpeg')"
        ></div>
      </div>

      <main class="content">
        <h1>Where Every Flower</h1>
<h1>Tells Your Story</h1>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas
          tenetur eius quisquam velit eligendi amet autem suscipit non optio
          tempore quam numquam molestias deserunt quas deleniti ratione,
          laudantium quos modi.
        </p>
        <a href="#wedding" style="color: black;"><button>Read More</button></a>
      </main>
    </section>
    <!-- hero section end-->
    
<!-- Best Sellers -->
<section class="wedding" id="wedding">
  <h2 class="section-title">Discover Our Bestsellers</h2>
  <p class="section-desc">
  </p>
<div class="product-grid">
  <?php if (!empty($bestsellers)): ?>
    <?php foreach ($bestsellers as $product): ?>
      <div class="product-card">
        <div class="img-wrapper">
          <img src="<?php echo htmlspecialchars($product['image']); ?>" 
               alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p>
          Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?>
        </p>
        <button>Buy</button>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No products available.</p>
  <?php endif; ?>
</div>

<a href="product.php" class="view-all">view all product</a>


</section>

    <!-- Catalog Section -->
<!-- Catalog Section -->
<section class="catalog" id="catalog">
  <h2 class="section-title">Explore Our Catalog</h2>
  <div class="catalog-grid">
    <!-- Kolom Kiri -->
    <div class="catalog-column">
      <div class="catalog-item">
        <div class="catalog-text">Bouquet</div>
        <div class="catalog-img"><img src="img/bouquet.jpg" alt="Bouquet"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Basket</div>
        <div class="catalog-img"><img src="img/basket.jpg" alt="Basket"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Orchid</div>
        <div class="catalog-img"><img src="img/orchid.jpg" alt="Orchid"></div>
      </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="catalog-column">
      <div class="catalog-item">
        <div class="catalog-text">Box</div>
        <div class="catalog-img"><img src="img/box.jpg" alt="Box"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Standing Flower</div>
        <div class="catalog-img"><img src="img/standing.jpg" alt="Standing Flower"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Vase</div>
        <div class="catalog-img"><img src="img/vase.jpg" alt="Vase"></div>
      </div>
    </div>
  </div>
  <a href="" class="view-all">view all product</a>
</section>

<section class="weddingpkg" id="weddingpkg">
  <div class="weddingpkg-container">
    <!-- Kiri: teks -->
    <div class="weddingpkg-text">
      <h2>Wedding Package</h2>
      <p>
        Some feelings are too deep for words. They are spoken in the language of flowers.

Allow us to be the interpreters of your heart. We will weave every hope, every laugh, and every happy tear into the bouquet you hold close, and upon the altar that embraces your sacred vows.

This is not merely about flowers. It is about your love, made tangible.
      </p>
      <a href="wedding.php" style="color: black;"><button class="btn-weddingpkg">Show More</button></a>
    </div>

    <!-- Kanan: gambar -->
    <div class="weddingpkg-img">
      <img src="img/weddingpkg.png" alt="Wedding Package">
    </div>
  </div>
  
</section>
<section class="weddingpkg" id="wedding">
  <p class="section-desc">
  </p>
<div class="product-grid">
  <?php if (!empty($bestsellers)): ?>
    <?php foreach ($bestsellers as $product): ?>
      <div class="product-card">
        <div class="img-wrapper">
          <img src="<?php echo htmlspecialchars($product['image']); ?>" 
               alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p>
          Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?>
        </p>
        <button>Buy</button>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No products available.</p>
  <?php endif; ?>
</div>

<a href="" class="view-all">view all product</a>


</section>

<!-- Workshop Section -->
<section class="workshop" id="workshop">
  <div class="workshop-container">
    <!-- Kiri: gambar -->
    <div class="workshop-img">
      <img src="img/image (2).png" alt="Workshop">
    </div>

    <!-- Kanan: teks -->
    <div class="workshop-text">
      <h2>Workshop</h2>
      <p>
There is a certain magic when fingertips meet the delicacy of a petal, when fragrance becomes a breath of calm. This is not merely a class; it is an invitation to pause, to reconnect with your intuition and with nature.

In our workshop, you will learn the silent language of flowers, understand how each stem wishes to dance, and weave them into a story born from your heart. Forget the world outside for a moment, and discover a therapy for the soul in every leaf and color you choose.

Leave with a masterpiece in your hands and peace within your soul.
      </p>
      <a href="workshop.php" style="color: black;"><button class="btn-workshop">Show More</button></a>
    </div>
  </div>
</section>

<section class="workshop" id="workshop">
  <p class="section-desc">
  </p>
<div class="product-grid">
  <?php if (!empty($bestsellers)): ?>
    <?php foreach ($bestsellers as $product): ?>
      <div class="product-card">
        <div class="img-wrapper">
          <img src="<?php echo htmlspecialchars($product['image']); ?>" 
               alt="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p>
          Rp. <?php echo number_format($product['price'], 0, ',', '.'); ?>
        </p>
        <button>Buy</button>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No products available.</p>
  <?php endif; ?>
</div>
</section>


<!-- About Section -->
<section class="about" id="about">
  <div class="aboutus-container">

    <!-- Kiri: gambar -->
    <div class="about-img">
      <img src="img/about.png" alt="Store Image">
    </div>

    <!-- Kanan: teks -->
    <div class="aboutus-text">
      <h2>Visit Us</h2>
      <p class="section-desc">Jl. Raya Golf Dago No.4, Bandung</p>
    </div>

  </div>
</section>


    <!-- Footer -->
    <footer class="footer">
      <div style="margin-bottom: 3rem;">
      <a href="" style="padding: 3rem; color:#d9d9d9;">Home</a><a href="" style="padding: 3rem; color:#d9d9d9">About Us</a>
      <a href="" style="padding: 3rem; color:#d9d9d9">Product</a><a href="" style="padding: 3rem; color:#d9d9d9">Contact</a>
      </div>
      <div style="margin-bottom: 3rem;">
      <p>Jalan Raya Golf Dago No. 4, Bandung, Jawa Barat, Indonesia</p>
      <p>(+62 812-3456-7890)</p>
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
    <script>
      let currentSlide = 0;
      const slides = document.querySelectorAll(".slide");
      const totalSlides = slides.length;

      setInterval(() => {
        slides[currentSlide].classList.remove("active");
        currentSlide = (currentSlide + 1) % totalSlides;
        slides[currentSlide].classList.add("active");
      }, 4000); // ganti setiap 4 detik
    </script>
  </body>
</html>
