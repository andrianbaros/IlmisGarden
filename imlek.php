<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Merayakan Imlek — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/imlek.css" />
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
  <section class="imlek-hero">
    <div class="imlek-hero__bg">
      <img src="img/DGR01932.jpg" alt="Imlek Arrangement Ilmisgarden" />
    </div>
    <div class="imlek-hero__overlay"></div>
    <div class="imlek-hero__content reveal">
      <p class="section__label">Koleksi Imlek</p>
      <h1 class="imlek-hero__title">Merayakan Imlek dengan<br><em>Keindahan dan Makna</em></h1>
      <p class="imlek-hero__sub">Bersama Ilmisgarden — rangkaian bunga yang membawa doa, harapan, dan keberuntungan di tahun baru.</p>
      <a href="shop.php?occasion%5B%5D=Imlek" class="btn-primary imlek-btn">Lihat Koleksi Imlek →</a>
    </div>
  </section>

  <!-- ─── ARTICLE BODY ──────────────────────────────────── -->
  <section class="section imlek-article">
    <div class="imlek-article__inner">
      <div class="imlek-article__lead reveal">
        <p>Imlek merupakan momen pergantian tahun yang sarat akan harapan baru, keberuntungan, dan kebersamaan yang hangat.</p>
      </div>
      <div class="imlek-article__prose reveal">
        <p>Di momen istimewa ini, Ilmisgarden menghadirkan keindahan rangkaian bunga yang dirancang dengan penuh perhatian dan sentuhan estetika — cocok sebagai dekorasi rumah, hadiah untuk keluarga dan relasi, hingga simbol doa dan harapan baik bagi perjalanan di tahun yang baru.</p>
        <p>Lebih dari sekadar hiasan, setiap rangkaian membawa pesan keberuntungan dan ketulusan. Melalui momen Imlek ini, Ilmisgarden mengajak Anda untuk menyambut tahun baru dengan keindahan yang bermakna.</p>
      </div>
    </div>
  </section>

  <!-- ─── PRODUCTS ──────────────────────────────────────── -->
  <section class="section section--warm imlek-products">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:4rem;">
      <div>
        <p class="section__label">Koleksi Eksklusif</p>
        <h2 class="section__title">Produk <em>Imlek</em> Kami</h2>
      </div>
    </div>

    <!-- Fortune Basket -->
    <div class="imlek-product-block reveal">
      <div class="imlek-product-block__header">
        <h3 class="imlek-product-block__name">Fortune <em>Basket</em></h3>
      </div>
      <div class="imlek-product-block__grid imlek-product-block__grid--2">
        <div class="imlek-product-item">
          <img src="img/DGR01890.jpg" alt="Fortune Basket" loading="lazy" />
        </div>
        <div class="imlek-product-item">
          <img src="img/DGR01967.jpg" alt="Fortune Basket" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Golden Harmony Bloombox -->
    <div class="imlek-product-block reveal">
      <div class="imlek-product-block__header">
        <h3 class="imlek-product-block__name">Golden Harmony <em>Bloombox</em></h3>
      </div>
      <div class="imlek-product-block__grid">
        <div class="imlek-product-item">
          <img src="img/bloombox(1).jpg" alt="Golden Harmony Bloombox" loading="lazy" />
        </div>
        <div class="imlek-product-item">
          <img src="img/bloombox.jpg" alt="Golden Harmony Bloombox" loading="lazy" />
        </div>
        <div class="imlek-product-item">
          <img src="img/bloombox(2).jpg" alt="Golden Harmony Bloombox" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Imperial Luck Arrangement -->
    <div class="imlek-product-block reveal">
      <div class="imlek-product-block__header">
        <h3 class="imlek-product-block__name">Imperial Luck <em>Arrangement</em></h3>
      </div>
      <div class="imlek-product-block__grid imlek-product-block__grid--2">
        <div class="imlek-product-item">
          <img src="img/imperal.jpg" alt="Imperial Luck Arrangement" loading="lazy" />
        </div>
        <div class="imlek-product-item">
          <img src="img/imperal(2).jpg" alt="Imperial Luck Arrangement" loading="lazy" />
        </div>
      </div>
    </div>

  </section>

  <!-- ─── FINAL CTA ─────────────────────────────────────── -->
  <section class="section section--dark imlek-cta reveal">
    <div class="imlek-cta__inner">
      <p class="section__label">Sambut Tahun Baru</p>
      <h2 class="imlek-cta__title">Rayakan Imlek dengan<br><em>Rangkaian Penuh Makna</em></h2>
      <p class="imlek-cta__sub">Hadirkan keberuntungan dan keindahan untuk keluarga dan orang terkasihmu.</p>
      <div class="imlek-cta__actions">
        <a href="shop.php?occasion%5B%5D=Imlek" class="btn-primary imlek-btn">Lihat Semua Koleksi →</a>
        <a href="https://wa.me/6285795077194?text=Halo, saya ingin memesan untuk Imlek" target="_blank" class="btn-outline">Chat via WhatsApp</a>
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