<?php
require 'conn/db.php';

/* =============================
   BESTSELLERS
============================= */
$stmt = $pdo->prepare("
  SELECT p.*, pi.image
  FROM products p
  LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
  WHERE p.id IN (17,20,19,6)
");
$stmt->execute();
$bestsellers = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* =============================
   ALL PRODUCTS + PRICE FILTER
============================= */
$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = $priceFilterActive && isset($_GET['max_price']) ? (int)$_GET['max_price'] : null;

if ($priceFilterActive && $maxPrice !== null) {
    $stmt = $pdo->prepare("
      SELECT p.*, pi.image
      FROM products p
      LEFT JOIN product_images pi 
        ON pi.product_id = p.id AND pi.is_primary = 1
      WHERE p.price <= ?
      ORDER BY p.id DESC
    ");
    $stmt->execute([$maxPrice]);
} else {
    $stmt = $pdo->query("
      SELECT p.*, pi.image
      FROM products p
      LEFT JOIN product_images pi 
        ON pi.product_id = p.id AND pi.is_primary = 1
      ORDER BY p.id DESC
    ");
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* =============================
   WEDDING PRODUCTS
============================= */
$stmt = $pdo->prepare("
  SELECT p.*, pi.image
  FROM products p
  LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
  WHERE FIND_IN_SET('Wedding', p.occasion)
  ORDER BY p.id DESC
  LIMIT 4
");
$stmt->execute();
$weddingProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* =============================
   WORKSHOP PRODUCTS
============================= */
$stmt2 = $pdo->prepare("
  SELECT p.*, pi.image
  FROM products p
  LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
  WHERE FIND_IN_SET('Workshop', p.occasion)
  ORDER BY p.id DESC
  LIMIT 4
");
$stmt2->execute();
$workshopProducts = $stmt2->fetchAll(PDO::FETCH_ASSOC);

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
        <h1>Selamat datang di</h1>
        <h1><b>Ilmisgarden</b></h1>
        <p id="hero-text" class="fade-slide">
        Tempat di mana setiap bunga punya cerita.<br> 
        Kami merangkai setiap tangkai dengan cinta, menghadirkan keindahan alami untuk setiap<br> 
        momen spesialmu.<br> 
        Dari buket penuh makna, hampers bunga elegan, hingga dekorasi ruangan yang menenangkan<br> 
        semua kami buat dengan sentuhan hati.🌷<br>
        </p>
        <a href="product.php" style="color: black;"><button>Read More</button></a>
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
      <a href="shop.php?catalog%5B%5D=Bouquet">
      <div class="catalog-item" >
        <div class="catalog-text">Bouquet</div>
        <div class="catalog-img"><img src="img/bouquet.png" alt="Bouquet"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Basket">
      <div class="catalog-item">
        <div class="catalog-text">Basket</div>
        <div class="catalog-img"><img src="img/basket.png" alt="Basket"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Add-on">
      <div class="catalog-item">
        <div class="catalog-text">Add-on</div>
        <div class="catalog-img"><img src="img/addon.jpg" alt="Orchid"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Blooming Canvas">
      <div class="catalog-item">
        <div class="catalog-text">Blooming Canvas</div>
        <div class="catalog-img"><img src="img/BloomingCanvas.jpg" alt="BloomingCanvas"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Money Bouquet">
      <div class="catalog-item">
        <div class="catalog-text">Money Bouquet</div>
        <div class="catalog-img"><img src="img/MoneyBouquet.jpg" alt="MoneyBouquet"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Dried Flowers">
      <div class="catalog-item">
        <div class="catalog-text">Dried Flower Bouquet</div>
        <div class="catalog-img"><img src="img/DriedFlowerBouquet.jpg" alt="DriedFlowerBouquet"></div>
      </div>
    </a>
    </div>

    <!-- Kolom Kanan -->
    <div class="catalog-column">
      <a href="shop.php?catalog%5B%5D=Box">
      <div class="catalog-item">
        <div class="catalog-text">Box</div>
        <div class="catalog-img"><img src="img/box.png" alt="Box"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Standing Flowers">
      <div class="catalog-item">
        <div class="catalog-text">Standing Flower</div>
        <div class="catalog-img"><img src="img/standing.png" alt="Standing Flower"></div>
      </div>
      </a>
      <a href="shop.php?catalog%5B%5D=Vase">
      <div class="catalog-item">
        <div class="catalog-text">Vase</div>
        <div class="catalog-img"><img src="img/vase.png" alt="Vase"></div>
      </div>
    </a>
    <a href="artisan.php">
      <div class="catalog-item">
        <div class="catalog-text">Artisan Product</div>
        <div class="catalog-img"><img src="img/ArtisanProductmenu.png" alt="ArtisanProduct"></div>
      </div>
    </a>
      <a href="shop.php?catalog%5B%5D=Artificial Flowers">
      <div class="catalog-item">
        <div class="catalog-text">Artificial Flower Bouquet</div>
        <div class="catalog-img"><img src="img/ArtificialFlowerBouquet.jpg" alt="ArtificialFlowerBouquet"></div>
      </div>
      </a>
      <a href="plants.php">
      <div class="catalog-item">
        <div class="catalog-text">Real Plant</div>
        <div class="catalog-img"><img src="img/realplants.png" alt="RealPlant"></div>
      </div>
      </a>
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
