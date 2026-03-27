<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Artisan Product — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/artisan.css" />
</head>
<body>

  <!-- ─── MOBILE MENU ──────────────────────────────────── -->
  <nav class="mobile-menu" id="mobileMenu">
    <button class="mobile-menu__close" id="mobileClose">✕</button>
    <a href="product.php">Product</a>
    <a href="shop.php">Catalog</a>
    <a href="about.php">About Us</a>
  </nav>

  <!-- ─── NAVBAR ───────────────────────────────────────── -->
  <header class="nav" id="navbar">
    <a href="index.php" class="nav__logo">
      <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
    </a>
    <ul class="nav__links">
      <li><a href="product.php">Product</a></li>
      <li><a href="shop.php">Catalog</a></li>
      <li><a href="about.php">About Us</a></li>
    </ul>
    <div class="nav__actions">
      <a href="cart.php" class="nav__icon" aria-label="Cart">
        <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
      </a>
      <a href="profile.php" class="nav__icon" aria-label="Profile">
        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      </a>
      <button class="nav__hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </header>

  <!-- ─── HERO ─────────────────────────────────────────── -->
  <section class="artisan-hero">
    <div class="artisan-container">
      <h1>Artisan Collection</h1>
      <p>
        Di balik setiap produk kami, ada sebuah cerita tentang keindahan, craftsmanship, dan sentuhan bunga yang membawa ketenangan. Melalui Artisan Collection, 
        kami menghadirkan rangkaian produk fungsional berbahan dasar bunga yang dibuat secara khusus bersama pengrajin lokal Bandung. Kami percaya bahwa kualitas 
        terbaik lahir dari tangan-tangan ahli. Karena itu, kami berkolaborasi dengan para pengrajin lokal Bandung. Kolaborasi ini juga merupakan bentuk dukungan kami 
        terhadap komunitas kreatif lokal, sehingga setiap pembelian produk untuk mempercantik ruangan, juga membantu menghidupkan industri kerajinan dalam negeri.
      </p>
      <p>
        Setiap produk dalam koleksi ini terdapat bunga-bunga yang indah untuk dilihat, dan mampu membuat perasaan 
        orang yang menggunakannya jauh lebih baik. Kehadiran penambahan bunga di setiap produk yang biasa kita pakai dapat 
        membuat rasa lebih tenang dan rileks saat menggunakannya, juga mood yang lebih positif.
      </p>
    </div>
  </section>

  <!-- ─── PRODUCT SECTIONS ──────────────────────────────── -->
  <section class="artisan-section">

    <!-- ── 1. FLORAL TEA ── -->
    <div class="artisan-card reveal">
      <div class="artisan-img">
        <img src="img/artisan1.jpg" alt="Floral Tea">
      </div>
      <div class="artisan-content">
        <h2>1. Floral Tea</h2>
        <p>
          Floral Tea adalah salah satu koleksi paling spesial dari artisan series kami. Diracik melalui kolaborasi bersama Hage Natural, 
          teh ini menggabungkan keindahan bunga dengan cita rasa yang lembut dan manfaat yang menenangkan. Setiap elemennya dirancang secara 
          detail mulai dari pemilihan bunga, gagang teh berbentuk bunga, hingga kemasan yang artistik sehingga menghadirkan pengalaman minum teh yang berbeda 
          dari biasanya, lebih intim, lebih estetik, dan lebih mindful.
        </p>
        <p>
          Floral Tea menggunakan dua bunga utama yang terkenal dengan efek relaksasinya, yaitu bunga camomile dan bunga lavender. 
          Kombinasi keduanya menghasilkan teh dengan aroma yang mewah, rasa yang halus, serta manfaat relaksasi yang kuat, cocok dinikmati saat malam hari, 
          setelah bekerja, atau saat ingin me time.
        </p>
      </div>
    </div>

    <!-- Floral Tea Catalog -->
    <div class="catalog-block reveal">
      <div class="catalog-header">
        <h3>Floral Tea Camovender</h3>
      </div>
      <div class="orchid-section">
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/floral1.jpg" alt="Floral Tea 1 Sachet">
          </div>
          <div class="orchid-text">
            <h3>Camovender</h3>
            <div class="price-block">
              <h4>12 K</h4>
              <p>1 Sachet Floral Tea Camovender</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/floral2.jpg" alt="Floral Tea 5 Sachet">
          </div>
          <div class="orchid-text">
            <h3>Camovender</h3>
            <div class="price-block">
              <h4>57 K</h4>
              <p>5 Sachet Floral Tea Camovender</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/floral3.jpg" alt="Floral Tea 10 Sachet">
          </div>
          <div class="orchid-text">
            <h3>Camovender</h3>
            <div class="price-block">
              <h4>75 K</h4>
              <p>10 Sachet Floral Tea Camovender</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── 2. FLORAL SCENT ── -->
    <div class="artisan-card reverse reveal">
      <div class="artisan-img">
        <img src="img/artisan2.jpg" alt="Floral Scent Diffuser">
      </div>
      <div class="artisan-content">
        <h2>2. Floral Scent</h2>
        <p>
          Diffuser Floral kami adalah perpaduan antara aroma yang menenangkan dan keindahan visual yang estetik. 
          Dirancang sebagai dekor fungsional, diffuser ini tidak hanya menyebarkan wangi floral yang lembut, 
          tetapi juga mempercantik ruangan melalui potongan bunga asli yang kami masukkan ke dalam botolnya.
          Komposisi utama diffuser adalah alkohol dan essential oil premium.
        </p>
        <p>
          <em>Ambience de Fleur –</em> Desain diffuser dibuat dengan konsep minimalis natural sehingga mudah menyatu dengan berbagai gaya interior, 
          mulai dari modern, minimalis, rustic, hingga classic. Dilengkapi dengan reed stick yang membantu aroma menyebar secara perlahan 
          dan konsisten. Diffuser kami cocok untuk kamar tidur, ruang tamu, ruang kerja, hingga area self-care.
        </p>
      </div>
    </div>

    <!-- Floral Scent Catalog -->
    <div class="catalog-block reveal">
      <div class="catalog-header">
        <h3>Floral Scent</h3>
      </div>
      <div class="orchid-section">
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/Fleur2.png" alt="Ambience de Fleur 100ml">
          </div>
          <div class="orchid-text">
            <h3>Ambience de Fleur</h3>
            <div class="price-block">
              <h4>115 K</h4>
              <p>100 ml Floral Scent + Stick Reed<br>Dengan dekorasi bunga<br>Lembut, Elegan, Menenangkan</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/Fleur1.png" alt="Ambience de Fleur 200ml">
          </div>
          <div class="orchid-text">
            <h3>Ambience de Fleur</h3>
            <div class="price-block">
              <h4>178 K</h4>
              <p>200 ml Floral Scent + Stick Reed<br>Dengan dekorasi bunga<br>Lembut, Elegan, Menenangkan</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── 3. BLOOMING BAR & LUSH PETALS ── -->
    <div class="artisan-card reveal">
      <div class="artisan-img">
        <img src="img/artisan3.jpg" alt="Blooming Bar">
      </div>
      <div class="artisan-content">
        <h2>3. Blooming Bar &amp; Lush Petals</h2>
        <p>
          Dalam kolaborasi spesial bersama RawGlow Rituals, Ilmisgarden menghadirkan rangkaian perawatan tubuh natural yang memadukan 
          keindahan bunga dengan kehangatan ritual selfcare. Blooming Bar dan Lush Petals tercipta untuk memanjakan kulit sekaligus memberikan 
          pengalaman mandi yang aromatik, lembut, dan menenangkan.
        </p>
        <p>
          Terinspirasi dari pesona bunga dan ketenangan mandi ritual, kedua produk ini menggunakan organic botanical oil serta petal bunga pilihan, 
          menciptakan sensasi perawatan tubuh yang lembut, mewah, dan penuh makna.
        </p>
        <p>
          <strong>Blooming Bar — Handmade Soap Natural</strong><br>
          Blooming Bar adalah sabun mandi yang dirancang untuk memberi kelembaban tahan lama tanpa membuat kulit terasa licin ataupun kering. 
          Teksturnya yang lembut dan busa creamy membersihkan kulit secara menyeluruh sambil mempertahankan hidrasi alami.
        </p>
        <p>
          Diformulasikan dari <strong>Virgin Coconut Oil (VCO), Sunflower Oil, Palm Oil, Olive Oil, Castor Oil, dan Canola Oil</strong> 
          yang bekerja bersama untuk membersihkan sekaligus menutrisi kulit. Dipadukan dengan <strong>Fragrance Oil premium</strong> dan <strong>Petal bunga pilihan</strong>, 
          sabun ini memberikan pengalaman mandi yang lebih menyegarkan dan mewah setiap hari.
        </p>
      </div>
    </div>

    <!-- Blooming Bar Catalog -->
    <div class="catalog-block reveal">
      <div class="catalog-header">
        <h3>Blooming Bar</h3>
      </div>
      <div class="orchid-section">
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/blooming1.png" alt="Blooming Bar Lavender">
          </div>
          <div class="orchid-text">
            <h3>Lavender</h3>
            <div class="price-block">
              <h4>58 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Relaks dan menenangkan</p>
            </div>
            <div class="price-block">
              <h4>135 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Tatakan Kayu + Pouch Scrub</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/blooming2.png" alt="Blooming Bar Floral">
          </div>
          <div class="orchid-text">
            <h3>Floral</h3>
            <div class="price-block">
              <h4>58 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Relaks dan menenangkan</p>
            </div>
            <div class="price-block">
              <h4>135 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Tatakan Kayu + Pouch Scrub</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/blooming3.png" alt="Blooming Bar Fresh">
          </div>
          <div class="orchid-text">
            <h3>Fresh</h3>
            <div class="price-block">
              <h4>58 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Relaks dan menenangkan</p>
            </div>
            <div class="price-block">
              <h4>135 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Tatakan Kayu + Pouch Scrub</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/blooming4.png" alt="Blooming Bar Coconut">
          </div>
          <div class="orchid-text">
            <h3>Coconut</h3>
            <div class="price-block">
              <h4>58 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Relaks dan menenangkan</p>
            </div>
            <div class="price-block">
              <h4>135 K</h4>
              <p>10gr Blooming Bar<br>Dengan dekorasi bunga<br>Tatakan Kayu + Pouch Scrub</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ── LUSH PETALS ── -->
    <div class="artisan-card reverse reveal">
      <div class="artisan-img">
        <img src="img/artisan4.jpg" alt="Lush Petals">
      </div>
      <div class="artisan-content">
        <h2>Lush Petals — Body Scrub Moisturizing &amp; Exfoliating</h2>
        <p>
          Untuk perawatan kulit yang lebih menyeluruh, Ilmisgarden menghadirkan Lush Petals, body scrub lembut dengan exfoliant alami yang aman digunakan setiap hari.
          Kandungan botanical oils dan petal bunga membantu mengangkat sel kulit mati secara gentle tanpa iritasi, sekaligus menjaga hidrasi kulit.
        </p>
        <p>
          Lush Petals memberikan manfaat seperti membantu menghaluskan dan mencerahkan kulit, mengangkat sel kulit mati tanpa membuat kulit terasa kering. 
          Kandungannya juga bekerja untuk mengunci kelembapan setelah mandi, sehingga kulit tetap lembut dan segar sepanjang hari.
        </p>
        <p>
          Kolaborasi Ilmisgarden x RawGlow Rituals bertujuan untuk mengubah rutinitas mandi menjadi momen self-love yang memanjakan tubuh, pikiran, dan indera.
          Setiap detail mulai dari aroma, komposisi bahan, tekstur, hingga tampilan kelopak bunga dirancang dengan cinta dan dedikasi.
        </p>
        <ul class="feature-list">
          <li>✓ Cocok untuk semua jenis kulit</li>
          <li>✓ Aman untuk pemakaian harian</li>
          <li>✓ Ideal untuk kulit lembab, glowing, dan harum sepanjang hari</li>
        </ul>
      </div>
    </div>

    <!-- Lush Petals Catalog -->
    <div class="catalog-block reveal">
      <div class="catalog-header">
        <h3>Lush Petals</h3>
      </div>
      <div class="orchid-section">
        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/lav1.png" alt="Lush Petals Floral">
          </div>
          <div class="orchid-text">
            <h3>Floral</h3>
            <div class="price-block">
              <h4>135 K</h4>
              <p>Lembut, manis, dan romantis</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/lav2.png" alt="Lush Petals Mint">
          </div>
          <div class="orchid-text">
            <h3>Mint</h3>
            <div class="price-block">
              <h4>135 K</h4>
              <p>Segar, dingin, dan menyegarkan pikiran</p>
            </div>
          </div>
        </div>

        <div class="orchid-row">
          <div class="orchid-image">
            <img src="img/lav3.png" alt="Lush Petals Lavender">
          </div>
          <div class="orchid-text">
            <h3>Lavender</h3>
            <div class="price-block">
              <h4>135 K</h4>
              <p>Menenangkan dan memberi efek relaks</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Closing tagline -->
    <div class="artisan-tagline reveal">
      <p><em>Blooming Bar &amp; Lush Petals — Let Your Bathing Time Blossom Beautifully</em></p>
      <p>Rasakan keharuman bunga, kelembutan kulit, dan ketenangan batin dalam setiap ritual mandi Anda.</p>
    </div>

  </section>

  <!-- ─── FOOTER ────────────────────────────────────────── -->
  <footer class="footer">
    <div class="footer__top">
      <div class="footer__logo"><img src="img/F4F6F4-full.png" alt="Ilmisgarden" /></div>
      <div class="footer__socials">
        <a href="https://wa.me/6285795077194" target="_blank" class="footer__social" aria-label="WhatsApp">
          <svg viewBox="0 0 24 24"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        </a>
        <a href="https://www.instagram.com/ilmisgarden/" target="_blank" class="footer__social" aria-label="Instagram">
          <svg viewBox="0 0 24 24"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/></svg>
        </a>
        <a href="https://www.tiktok.com/@ilmisgarden" target="_blank" class="footer__social" aria-label="TikTok">
          <svg viewBox="0 0 24 24"><path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/></svg>
        </a>
      </div>
    </div>
    <p class="footer__addr">
      <a href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7" target="_blank">
        Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135
      </a>
    </p>
    <p class="footer__copy">© 2025 Ilmisgarden. All rights reserved.</p>
  </footer>

  <a href="about.php#contact" class="floating-about">Hubungi Kami</a>

  <script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => navbar.classList.toggle('scrolled', window.scrollY > 60));

    const hamburger   = document.getElementById('hamburger');
    const mobileMenu  = document.getElementById('mobileMenu');
    const mobileClose = document.getElementById('mobileClose');
    hamburger.addEventListener('click', () => mobileMenu.classList.add('open'));
    mobileClose.addEventListener('click', () => mobileMenu.classList.remove('open'));
    mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileMenu.classList.remove('open')));

    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
      });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
  <script src="js/script.js"></script>
</body>
</html>