<?php
require 'conn/db.php';

// BESTSELLERS → Ambil 4 produk fix dari database
$stmt = $pdo->prepare("SELECT * FROM products WHERE id IN (17,20,19,6)");
$stmt->execute();
$bestsellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

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


// Wedding products
$stmt = $pdo->prepare("SELECT * FROM products WHERE type = 'wedding' ORDER BY id DESC LIMIT 4");
$stmt->execute();
$weddingProducts = $stmt->fetchAll();

// Workshop products
$stmt2 = $pdo->prepare("SELECT * FROM products WHERE type = 'workshop' ORDER BY id DESC LIMIT 4");
$stmt2->execute();
$workshopProducts = $stmt2->fetchAll();
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
  <a href="product.php">Product</a>
  <a href="shop.php" data-section="catalog">Catalog</a>
  <a href="index.php#about" data-section="about">About Us</a>
</div>

      <div class="navbar-extra">
        


        <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
        <a href="profile.php" id="user"><i data-feather="user"></i></a>
        <i id="menu" data-feather="menu"></i>

      </div>
    </nav>
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
        <h1>Selamat datang di <b>Ilmisgarden</b></h1>
        <p id="hero-text" class="fade-slide">
        Tempat di mana setiap bunga punya cerita. Kami merangkai setiap tangkai dengan cinta, menghadirkan keindahan alami untuk setiap momen spesialmu. 
        Dari buket penuh makna, hampers bunga elegan, hingga dekorasi ruangan yang menenangkan — semua kami buat dengan sentuhan hati.🌷
        </p>
        <a href="#about" style="color: black;"><button>Read More</button></a>
      </main>
    </section>
    <!-- hero section end-->
    
<!-- Best Sellers -->
<section class="wedding" id="wedding">
  <h2 class="section-title">Discover Our Bestsellers</h2>
  <p class="section-desc"></p>
  <div class="product-grid">
    <?php if (!empty($bestsellers)): ?>
      <?php foreach ($bestsellers as $product): ?>
        <div class="product-card">
          <div class="img-wrapper">
            <img src="<?= htmlspecialchars($product['image']); ?>" 
                 alt="<?= htmlspecialchars($product['name']); ?>">
          </div>
          <h3><?= htmlspecialchars($product['name']); ?></h3>
          <p>
            Rp. <?= number_format($product['price'], 0, ',', '.'); ?>
          </p>
          <a href="product_details.php?id=<?= $product['id'] ?>" class="buy-btn">
            <button type="button">Buy</button>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No products available.</p>
    <?php endif; ?>
  </div>

  <a href="product.php" class="view-all">View all products</a>
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
        <div class="catalog-img"><img src="img/bouquet.png" alt="Bouquet"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Basket</div>
        <div class="catalog-img"><img src="img/basket.png" alt="Basket"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Orchid</div>
        <div class="catalog-img"><img src="img/orchid.png" alt="Orchid"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Blooming Canvas</div>
        <div class="catalog-img"><img src="img/BloomingCanvas.jpg" alt="BloomingCanvas"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Money Bouquet</div>
        <div class="catalog-img"><img src="img/MoneyBouquet.jpg" alt="MoneyBouquet"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Dried Flower Bouquet</div>
        <div class="catalog-img"><img src="img/DriedFlowerBouquet.jpg" alt="DriedFlowerBouquet"></div>
      </div>
    </div>

    <!-- Kolom Kanan -->
    <div class="catalog-column">
      <div class="catalog-item">
        <div class="catalog-text">Box</div>
        <div class="catalog-img"><img src="img/box.png" alt="Box"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Standing Flower</div>
        <div class="catalog-img"><img src="img/standing.png" alt="Standing Flower"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Vase</div>
        <div class="catalog-img"><img src="img/vase.png" alt="Vase"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Artisan Product</div>
        <div class="catalog-img"><img src="img/ArtisanProduct.jpg" alt="ArtisanProduct"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Artificial Flower Bouquet</div>
        <div class="catalog-img"><img src="img/ArtificialFlowerBouquet.jpg" alt="ArtificialFlowerBouquet"></div>
      </div>
      <div class="catalog-item">
        <div class="catalog-text">Real Plant</div>
        <div class="catalog-img"><img src="img/realplants.png" alt="RealPlant"></div>
      </div>
    </div>
  </div>
  <a href="shop.php" class="view-all">view all catalog</a>
</section>

<section class="weddingpkg" id="weddingpkg">
  <div class="weddingpkg-container">
    <!-- Kiri: teks -->
    <div class="weddingpkg-text">
      <h2>Wedding Package</h2>
      <p>
      Setiap kisah cinta layak dirayakan dengan keindahan yang tulus. 
      <b>Wedding Bouquet by Ilmisgarden</b> dirangkai dengan sentuhan lembut dan warna-warna yang menggambarkan harapan, cinta, dan kebahagiaan. 
      Dibuat dengan bunga segar pilihan dan desain yang menyesuaikan tema pernikahanmu — sederhana, elegan, dan penuh makna. 
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
  <div class="product-grid">
    <?php if (!empty($weddingProducts)): ?>
      <?php foreach ($weddingProducts as $product): ?>
        <div class="product-card">
          <div class="img-wrapper">
            <img src="<?= htmlspecialchars($product['image']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>">
          </div>
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p>Rp. <?= number_format($product['price'], 0, ',', '.') ?></p>
          <a href="product_details.php?id=<?= $product['id'] ?>"><button>Buy</button></a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No wedding products available.</p>
    <?php endif; ?>
  </div>
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
        Merangkai bunga adalah cara untuk menyentuh jiwa, memberi ketenangan di tengah kesibukan, dan menumbuhkan rasa percaya diri. Dengan setiap kelopak yang kamu susun, kamu bukan hanya menciptakan karya seni, tapi juga menciptakan momen kebahagiaan dan kedamaian dalam dirimu. </p>
        <p>
        Kebebasan untuk memilih jenis bunga dan rangkaian yang kamu ingin rasakan pengalamannya. Kami akan membantu membuatkan program dan modul yang sesuai untuk kamu. 
      </p>
      <a href="workshop.php" style="color: black;"><button class="btn-workshop">Show More</button></a>
    </div>
  </div>
</section>
<section class="workshop" id="workshop">
  <div class="product-grid">
    <?php if (!empty($workshopProducts)): ?>
      <?php foreach ($workshopProducts as $product): ?>
        <div class="product-card">
          <div class="img-wrapper">
            <img src="<?= htmlspecialchars($product['image']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>">
          </div>
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p>Rp. <?= number_format($product['price'], 0, ',', '.') ?></p>
          <a href="product_details.php?id=<?= $product['id'] ?>"><button>Buy</button></a>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No workshop products available.</p>
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
      <a href="https://maps.app.goo.gl/UiEmKAw1AQ4xS1mEA">https://maps.app.goo.gl/UiEmKAw1AQ4xS1mEA</a>
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
    <script>
  function setActiveMenu() {
    const hash = window.location.hash.replace('#', '');
    const links = document.querySelectorAll('.navbar-nav a');

    links.forEach(link => link.classList.remove('active'));

    if (hash) {
      const target = document.querySelector(`.navbar-nav a[data-section="${hash}"]`);
      if (target) target.classList.add('active');
    }
  }

  window.addEventListener('load', setActiveMenu);
  window.addEventListener('hashchange', setActiveMenu);
</script>

  </body>
</html>
