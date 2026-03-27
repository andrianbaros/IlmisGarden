<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Bulan Penuh Cinta — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bulan-penuh-cinta.css" />
</head>
<body>

<!-- MOBILE MENU -->
<nav class="mobile-menu" id="mobileMenu">
  <button class="mobile-menu__close" id="mobileClose">✕</button>
  <a href="product.php">Product</a>
  <a href="shop.php">Catalog</a>
  <a href="about.php">About Us</a>
</nav>

<!-- NAVBAR -->
<header class="nav" id="navbar">
  <a href="index.php" class="nav__logo">
    <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
  </a>

  <ul class="nav__links">
    <li><a href="product.php" class="active">Product</a></li>
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

    <!-- WRAPPER PENTING -->
    <div class="nav__menu-wrapper">
      <button class="nav__hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>

      <!-- PINDAH MOBILE MENU KE SINI -->
      <nav class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu__close" id="mobileClose">✕</button>
        <a href="product.php">Product</a>
        <a href="shop.php">Catalog</a>
        <a href="about.php">About Us</a>
      </nav>
    </div>

  </div>
</header>


  <!-- ─── HERO ─────────────────────────────────────────── -->
  <section class="bpc-hero">
    <div class="bpc-hero__bg">
      <img src="img/VALENTINE 2026.png" alt="Bulan Penuh Cinta Ilmisgarden" />
    </div>
    <div class="bpc-hero__overlay"></div>
    <div class="bpc-hero__content reveal">
      <p class="section__label">Februari · Koleksi Spesial</p>
      <h1 class="bpc-hero__title">Bulan Penuh <em>Cinta</em><br>bersama Ilmisgarden</h1>
      <p class="bpc-hero__sub">Perayaan rasa, perhatian, dan keindahan dalam setiap rangkaian bunga.</p>
      <a href="shop.php?occasion%5B%5D=Sebulan+Penuh+Cinta" class="btn-primary">Lihat Koleksi →</a>
    </div>
  </section>

  <!-- ─── ARTICLE BODY ──────────────────────────────────── -->
  <section class="section bpc-article">
    <div class="bpc-article__inner">
      <div class="bpc-article__lead reveal">
        <p>Di bulan Februari, Ilmisgarden memaknainya sebagai <strong>Bulan Penuh Cinta</strong> — sebuah perayaan atas rasa, perhatian, dan keindahan yang hadir dalam berbagai bentuk.</p>
      </div>
      <div class="bpc-article__prose reveal">
        <p>Kami percaya bahwa bunga adalah bahasa paling anggun untuk menyampaikan emosi. Setiap rangkaian dirancang dengan sentuhan estetika, permainan warna yang lembut, serta pemilihan bunga berkualitas tinggi yang mencerminkan karakter Ilmisgarden: <em>elegan, hangat, dan penuh makna</em>.</p>
        <p>Melalui Bulan Penuh Cinta, Ilmisgarden menghadirkan koleksi rangkaian eksklusif untuk berbagai momen istimewa — mulai dari ungkapan cinta romantis, kejutan manis untuk orang terkasih, hingga simbol apresiasi dan self-love yang tak kalah penting.</p>
        <p>Di bulan ini, biarkan bunga berbicara lebih lembut, lebih dalam, dan lebih personal.</p>
      </div>
    </div>
  </section>

  <!-- ─── PRODUCTS ──────────────────────────────────────── -->
  <section class="section section--warm bpc-products">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:4rem;">
      <div>
        <p class="section__label">Koleksi Eksklusif</p>
        <h2 class="section__title">Produk Spesial <em>Bulan Penuh Cinta</em></h2>
      </div>
    </div>

    <!-- Bouquet Edition -->
    <div class="bpc-product-block reveal">
      <div class="bpc-product-block__header">
        <h3 class="bpc-product-block__name">Bouquet Edition</h3>
        <p class="bpc-product-block__desc">Koleksi bouquet dengan nuansa lembut dan romantis untuk momen penuh cinta.</p>
      </div>
      <div class="bpc-product-block__grid bpc-product-block__grid--5">
        <div class="bpc-product-item">
          <img src="img/DGR02124.jpg" alt="Sweet Bouquet" loading="lazy" />
          <span>Sweet Bouquet</span>
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02142.jpg" alt="Baby Breath Bloom" loading="lazy" />
          <span>Baby Breath Bloom</span>
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02120.jpg" alt="Blushing Heart Bouquet" loading="lazy" />
          <span>Blushing Heart Bouquet</span>
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02106.jpg" alt="Soft Crush Bouquet" loading="lazy" />
          <span>Soft Crush Bouquet</span>
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02116.jpg" alt="Sunny Love" loading="lazy" />
          <span>Sunny Love</span>
        </div>
      </div>
    </div>

    <!-- Choco Single Flower -->
    <div class="bpc-product-block reveal">
      <div class="bpc-product-block__header">
        <h3 class="bpc-product-block__name">Choco Single Flower</h3>
      </div>
      <div class="bpc-product-block__grid">
        <div class="bpc-product-item">
          <img src="img/DGR02062.jpg" alt="Choco Single Flower" loading="lazy" />
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02159.jpg" alt="Choco Single Flower" loading="lazy" />
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02162.jpg" alt="Choco Single Flower" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Sweet Classic Bloombox -->
    <div class="bpc-product-block reveal">
      <div class="bpc-product-block__header">
        <h3 class="bpc-product-block__name">Sweet Classic Bloombox</h3>
      </div>
      <div class="bpc-product-block__grid bpc-product-block__grid--2">
        <div class="bpc-product-item">
          <img src="img/DGR02083.jpg" alt="Sweet Classic Bloombox" loading="lazy" />
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02130.jpg" alt="Sweet Classic Bloombox" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Sweet Pebby Bloom -->
    <div class="bpc-product-block reveal">
      <div class="bpc-product-block__header">
        <h3 class="bpc-product-block__name">Sweet Pebby Bloom</h3>
      </div>
      <div class="bpc-product-block__grid bpc-product-block__grid--2">
        <div class="bpc-product-item">
          <img src="img/DGR02078.jpg" alt="Sweet Pebby Bloom" loading="lazy" />
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02137.jpg" alt="Sweet Pebby Bloom" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Brownies and Bloom -->
    <div class="bpc-product-block reveal">
      <div class="bpc-product-block__header">
        <h3 class="bpc-product-block__name">Brownies and Bloom</h3>
      </div>
      <div class="bpc-product-block__grid">
        <div class="bpc-product-item">
          <img src="img/DGR02069.jpg" alt="Brownies and Bloom" loading="lazy" />
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR02151.jpg" alt="Brownies and Bloom" loading="lazy" />
        </div>
        <div class="bpc-product-item">
          <img src="img/DGR01992.jpg" alt="Brownies and Bloom" loading="lazy" />
        </div>
      </div>
    </div>

  </section>

  <!-- ─── BEHIND THE SCENE ──────────────────────────────── -->
  <section class="bpc-behind reveal">
    <div class="bpc-behind__img">
      <img src="img/behind.png" alt="Behind the Scene Bulan Penuh Cinta" loading="lazy" />
    </div>
  </section>

  <!-- ─── LOVE CONFESSION ───────────────────────────────── -->
  <section class="section bpc-confession">
    <div class="bpc-confession__inner reveal">
      <div class="bpc-confession__icon">
        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
      </div>
      <p class="section__label">Program Spesial</p>
      <h2 class="bpc-confession__title">Love <em>Confession</em></h2>
      <p class="bpc-confession__desc">Selama Bulan Penuh Cinta, kami akan memilih <strong>10 alasan paling bermakna</strong> dan mengirimkannya secara bertahap selama bulan Februari. Pengirim terpilih akan dikonfirmasi ulang melalui WhatsApp.</p>
      <a href="https://bulanpenuhcinta.ilmisgarden.com" target="_blank" rel="noopener noreferrer" class="btn-confession">
        Kirim Love Confession
        <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
    </div>
  </section>

  <!-- ─── FINAL CTA ─────────────────────────────────────── -->
  <section class="section section--dark bpc-cta reveal">
    <div class="bpc-cta__inner">
      <p class="section__label">Pesan Sekarang</p>
      <h2 class="bpc-cta__title">Ungkapkan Cintamu<br>dengan <em>Rangkaian Bunga</em></h2>
      <p class="bpc-cta__sub">Tersedia berbagai pilihan untuk setiap momen dan budget.</p>
      <div class="bpc-cta__actions">
        <a href="shop.php?occasion%5B%5D=Sebulan+Penuh+Cinta" class="btn-primary">Lihat Semua Koleksi →</a>
        <a href="https://wa.me/6285795077194?text=Halo, saya ingin memesan untuk Bulan Penuh Cinta" target="_blank" class="btn-outline">Chat via WhatsApp</a>
      </div>
    </div>
  </section>

  <!-- ─── FOOTER ───────────────────────────────────────── -->
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
    <p class="footer__addr"><a href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7" target="_blank">Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135</a></p>
    <p class="footer__copy">© 2025 Ilmisgarden. All rights reserved.</p>
  </footer>

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
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
    }, { threshold: 0.07 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
  <script src="js/script.js"></script>
   <a href="about.php#contact" class="floating-about">
  Hubungi Kami
</a>
</body>
</html>