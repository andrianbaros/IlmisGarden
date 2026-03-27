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


  <!-- ─── PAGE HERO ─────────────────────────────────────── -->
  <div class="page-hero">
    <div class="page-hero__content reveal">
      <p class="section__label">Kerajinan Tangan</p>
      <h1 class="page-hero__title">Artisan <em>Product</em></h1>
    </div>
  </div>

  <!-- ─── INTRO ─────────────────────────────────────────── -->
  <section class="section artisan-intro">
    <div class="artisan-intro__inner reveal">
      <p class="artisan-intro__lead">Produk artisan kami dibuat dengan tangan, penuh perhatian, dan dibuat khusus untuk setiap momen.</p>
      <p class="artisan-intro__body">Setiap produk artisan yang kami hadirkan merupakan hasil dari kecintaan terhadap keindahan dan ketelitian dalam setiap proses. Dari pemilihan bahan hingga detail akhir, semua dikerjakan dengan penuh dedikasi untuk menghasilkan karya yang tak hanya indah, tetapi juga bermakna.</p>
    </div>
  </section>

  <!-- ─── PRODUCT SECTIONS ──────────────────────────────── -->
  <section class="section artisan-section">

    <!-- Product 1 -->
    <div class="artisan-card reveal">
      <div class="artisan-img">
        <img src="img/ArtisanProduct.png" alt="Artisan Product" loading="lazy" />
      </div>
      <div class="artisan-content">
        <p class="section__label">Unggulan</p>
        <h2>Produk <em>Artisan</em> Kami</h2>
        <p>Rangkaian produk handcrafted yang dibuat dengan bahan pilihan dan teknik yang telah diasah selama bertahun-tahun. Setiap detail mencerminkan perhatian dan kecintaan kami terhadap seni merangkai.</p>
        <ul>
          <li>Dibuat dengan tangan, satu per satu</li>
          <li>Bahan berkualitas premium</li>
          <li>Dapat dikustomisasi sesuai kebutuhan</li>
          <li>Dikemas dengan elegan</li>
        </ul>
        <a href="shop.php?catalog%5B%5D=Artisan" class="btn-primary">Lihat di Catalog →</a>
      </div>
    </div>

    <!-- Product 2 (reverse) -->
    <div class="artisan-card artisan-card--reverse reveal">
      <div class="artisan-img">
        <img src="img/ArtisanProductmenu.png" alt="Artisan Product" loading="lazy" />
      </div>
      <div class="artisan-content">
        <p class="section__label">Custom Order</p>
        <h2>Pesan <em>Sesuai Keinginanmu</em></h2>
        <p>Kami menerima pesanan custom untuk berbagai kebutuhan — hadiah ulang tahun, souvenir pernikahan, kenangan wisuda, hingga dekorasi ruangan pribadi. Ceritakan konsepmu dan kami akan wujudkan.</p>
        <ul>
          <li>Konsultasi desain gratis</li>
          <li>Tersedia untuk berbagai budget</li>
          <li>Siap kirim ke seluruh Indonesia</li>
        </ul>
        <a href="https://wa.me/6285795077194?text=Halo, saya ingin custom order artisan product" target="_blank" class="btn-primary">Konsultasi via WhatsApp →</a>
      </div>
    </div>

  </section>

  <!-- ─── CTA STRIP ─────────────────────────────────────── -->
  <div class="artisan-cta-strip reveal">
    <div class="artisan-cta-strip__inner">
      <p>Tertarik dengan produk artisan kami?</p>
      <a href="https://wa.me/6285795077194?text=Halo, saya ingin info artisan product" target="_blank" class="btn-primary">
        <svg viewBox="0 0 24 24" style="width:15px;height:15px;fill:currentColor;"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        WhatsApp Kami
      </a>
    </div>
  </div>

  <!-- ─── ORCHID ON VASE ────────────────────────────────── -->
  <section class="section artisan-orchid">
    <div class="artisan-orchid__header reveal">
      <p class="section__label">Tanaman Premium</p>
      <h2>Orchid <em>on Vase</em></h2>
    </div>

    <div class="orchid-section">

      <!-- Orchid 1 / 2 -->
      <div class="orchid-row reveal">
        <div class="orchid-image">
          <img src="img/orchid21.png" alt="Orchid 1 or 2" loading="lazy" />
        </div>
        <div class="orchid-text">
          <h3>Orchid 1 or 2</h3>
          <div class="price-blocks">
            <div class="price-block">
              <h4>365K</h4>
              <p>1 orchid plant<br>Small ceramic vase<br>Ornaments</p>
            </div>
            <div class="price-block">
              <h4>665K</h4>
              <p>2 orchid plants<br>Small ceramic vase<br>Ornaments</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Orchid 3 -->
      <div class="orchid-row reveal">
        <div class="orchid-image">
          <img src="img/orchid22.png" alt="Orchid 3" loading="lazy" />
        </div>
        <div class="orchid-text">
          <h3>Orchid 3</h3>
          <div class="price-blocks">
            <div class="price-block">
              <h4>1.000K</h4>
              <p>3 orchid plants<br>Medium ceramic vase<br>Ornaments</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Orchid 5 / 6 -->
      <div class="orchid-row reveal">
        <div class="orchid-image">
          <img src="img/orchid23.png" alt="Orchid 5 or 6" loading="lazy" />
        </div>
        <div class="orchid-text">
          <h3>Orchid 5 or 6</h3>
          <div class="price-blocks">
            <div class="price-block">
              <h4>1.600K</h4>
              <p>5 orchid plants<br>Large ceramic vase<br>Ornaments</p>
            </div>
            <div class="price-block">
              <h4>1.900K</h4>
              <p>6 orchid plants<br>Large ceramic vase<br>Ornaments</p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Variety -->
    <p class="orchid-var-title reveal">Pilihan Varietas</p>
    <div class="orchid-variety reveal">
      <img src="img/orchid-var1.png" alt="Variety 1" loading="lazy" />
      <img src="img/orchid-var2.png" alt="Variety 2" loading="lazy" />
      <img src="img/orchid-var3.png" alt="Variety 3" loading="lazy" />
      <img src="img/orchid-var4.png" alt="Variety 4" loading="lazy" />
      <img src="img/orchid-var5.png" alt="Variety 5" loading="lazy" />
    </div>
  </section>

  <!-- ─── FINAL CTA ─────────────────────────────────────── -->
  <section class="section section--dark artisan-cta reveal">
    <div class="artisan-cta__inner">
      <p class="section__label">Pesan Sekarang</p>
      <h2 class="artisan-cta__title">Hadirkan Karya <em>Istimewa</em><br>untuk Momenmu</h2>
      <p class="artisan-cta__sub">Setiap produk dibuat dengan penuh perhatian — khusus untukmu.</p>
      <a href="https://wa.me/6285795077194?text=Halo, saya tertarik dengan artisan product Ilmisgarden" target="_blank" class="btn-primary">
        <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:currentColor;"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        Chat via WhatsApp
      </a>
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