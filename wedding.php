<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wedding Arrangement — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/wedding.css" />
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
  <section class="wedding-hero">
    <div class="wedding-hero__overlay"></div>
    <div class="wedding-hero__content reveal">
      <p class="section__label">Wedding Arrangement</p>
      <h1 class="wedding-hero__title">Make Your Special Day<br><em>Bloom with Beauty</em></h1>
      <a href="shop.php?occasion%5B%5D=Wedding" class="btn-primary">Lihat Koleksi Wedding →</a>
    </div>
    <div class="wedding-hero__scroll">
      <span>Scroll</span>
      <div class="wedding-hero__scroll-line"></div>
    </div>
  </section>

  <!-- ─── INTRO STORY ───────────────────────────────────── -->
  <section class="section wedding-intro">
    <div class="wedding-intro__inner">

      <div class="wedding-intro__text reveal">
        <p class="section__label">Makna &amp; Tradisi</p>
        <h2 class="wedding-intro__heading">Makna di Balik<br><em>Wedding Bouquet</em></h2>
        <p>Tradisi pengantin wanita membawa wedding bouquet bukan sekadar hiasan yang mempercantik penampilan. Di balik rangkaian bunga itu, tersimpan simbol yang melambangkan harapan, doa, dan keindahan perjalanan baru yang akan dimulai bersama pasangan.</p>
        <p>Setiap tangkai bunga menggambarkan makna: kesetiaan, kebahagiaan, ketulusan, dan cinta yang tumbuh dari hati. Kini, wedding bouquet adalah simbol bahwa cinta adalah sesuatu yang hidup, indah, tumbuh, dan layak dirayakan.</p>
      </div>

      <div class="wedding-intro__img reveal">
        <img src="img/wedding1.png" alt="Wedding Bouquet" loading="lazy" />
      </div>

    </div>
  </section>

  <!-- ─── PROCESS CARDS ─────────────────────────────────── -->
  <section class="section section--warm wedding-process">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:3rem;">
      <div>
        <p class="section__label">Keunggulan Kami</p>
        <h2 class="section__title">Proses &amp; <em>Perhatian</em></h2>
      </div>
    </div>

    <div class="process-grid">

      <div class="process-card reveal">
        <div class="process-card__num">01</div>
        <div class="process-card__img">
          <img src="img/wedding2.png" alt="Desain Bouquet" loading="lazy" />
        </div>
        <h3 class="process-card__title">Desain Stabil &amp; Ergonomis</h3>
        <p class="process-card__desc">Wedding bouquet kami dirancang agar dapat berdiri stabil dengan sendirinya ketika diletakkan — tetap rapi dan tidak mudah rusak saat pengantin tidak sedang memegangnya.</p>
      </div>

      <div class="process-card reveal">
        <div class="process-card__num">02</div>
        <div class="process-card__img">
          <img src="img/wedding3.png" alt="Pengemasan" loading="lazy" />
        </div>
        <h3 class="process-card__title">Pengemasan &amp; Pengiriman</h3>
        <p class="process-card__desc">Bouquet dikemas dengan dus khusus, dilengkapi ember plastik kecil berisi air dan kapas agar batang bunga tetap lembab sepanjang perjalanan — tiba dalam kondisi terbaik.</p>
      </div>

      <div class="process-card reveal">
        <div class="process-card__num">03</div>
        <div class="process-card__img process-card__img--icon">
          <svg viewBox="0 0 64 64" fill="none">
            <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="1.5"/>
            <path d="M20 32c3-6 8-10 12-10s9 4 12 10c-3 6-8 10-12 10s-9-4-12-10z" stroke="currentColor" stroke-width="1.5"/>
            <circle cx="32" cy="32" r="5" stroke="currentColor" stroke-width="1.5"/>
          </svg>
        </div>
        <h3 class="process-card__title">Pemilihan Bunga Premium</h3>
        <p class="process-card__desc">Bunga dipilih dari jenis khusus terbaik agar tampil lebih cantik, segar, dan harmonis — memaksimalkan hasil foto dan menambah kesan elegan pada penampilan pengantin.</p>
      </div>

    </div>
  </section>

  <!-- ─── BOUQUET STYLES ────────────────────────────────── -->
  <section class="section wedding-styles">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Pilihan Gaya</p>
        <h2 class="section__title">Wedding Bouquet <em>Styles</em></h2>
      </div>
      <a href="shop.php?occasion%5B%5D=Wedding" class="link-arrow">Lihat Semua →</a>
    </div>

    <div class="bouquet-styles-grid stagger">

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/Frame 209 (1).png" alt="Cascade Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Cascade</h3>
          <p>Menyerupai bentuk air terjun, dengan konsentrasi bunga di atas yang meruncing ke bawah — dramatis dan mewah.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 900.000</span>
        </div>
      </article>

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/Frame 209 (2).png" alt="Pomander Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Pomander</h3>
          <p>Berbentuk bola bunga yang digantung di pergelangan tangan dengan pita — unik dan penuh karakter.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 600.000</span>
        </div>
      </article>

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/IMG_1716.jpg" alt="Pageant Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Pageant</h3>
          <p>Digenggam di lekukan lengan, menghasilkan tampilan panjang dan elegan — cocok untuk gaun formal.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 650.000</span>
        </div>
      </article>

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/Frame 209 (4).png" alt="Hand Tied Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Hand Tied</h3>
          <p>Dirangkai secara kasual dan diikat dengan pita — memberikan kesan alami dan effortless.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 445.000</span>
        </div>
      </article>

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/Frame 209 (5).png" alt="Round Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Round</h3>
          <p>Kompak dan simetris dalam bentuk kubah — klasik, rapi, dan cocok untuk berbagai tema.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 400.000</span>
        </div>
      </article>

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/Frame 209 (6).png" alt="Posy Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Posy</h3>
          <p>Kecil, ringan, dan mudah dibawa — rangkaian sederhana namun tetap penuh pesona.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 250.000</span>
        </div>
      </article>

      <article class="bouquet-style-card reveal">
        <div class="bouquet-style-card__img">
          <img src="img/Frame 209 (7).png" alt="Contemporary Bouquet" loading="lazy" />
        </div>
        <div class="bouquet-style-card__body">
          <h3>Contemporary</h3>
          <p>Gaya modern yang menyesuaikan potongan gaun dan tema pernikahan — sleek dan sangat elegan.</p>
          <span class="bouquet-style-card__price">Mulai dari Rp 1.350.000</span>
        </div>
      </article>

    </div>
  </section>

  <!-- ─── CTA ──────────────────────────────────────────── -->
  <section class="section section--dark wedding-cta reveal">
    <div class="wedding-cta__inner">
      <p class="section__label">Konsultasi Gratis</p>
      <h2 class="wedding-cta__title">Wujudkan <em>Impian</em><br>Hari Pernikahanmu</h2>
      <p class="wedding-cta__sub">Hubungi kami untuk konsultasi desain bouquet yang sesuai dengan tema dan gaya pernikahanmu.</p>
      <div class="wedding-cta__actions">
        <a href="https://wa.me/6285795077194?text=Halo, saya ingin konsultasi wedding bouquet" target="_blank" class="btn-primary">Chat via WhatsApp →</a>
        <a href="shop.php?occasion%5B%5D=Wedding" class="btn-outline">Lihat Koleksi</a>
      </div>
    </div>
  </section>

  <!-- ─── FOOTER ───────────────────────────────────────── -->
  <footer class="footer">
    <div class="footer__top">
      <div class="footer__logo">
        <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
      </div>
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

  <!-- ─── SCRIPTS ───────────────────────────────────────── -->
  <script>
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 60);
    });

    const hamburger   = document.getElementById('hamburger');
    const mobileMenu  = document.getElementById('mobileMenu');
    const mobileClose = document.getElementById('mobileClose');
    hamburger.addEventListener('click', () => mobileMenu.classList.add('open'));
    mobileClose.addEventListener('click', () => mobileMenu.classList.remove('open'));
    mobileMenu.querySelectorAll('a').forEach(a =>
      a.addEventListener('click', () => mobileMenu.classList.remove('open'))
    );

    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
      });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
  <script src="js/script.js"></script>
   <a href="about.php#contact" class="floating-about">
  Hubungi Kami
</a>
</body>
</html>