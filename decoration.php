<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Decoration — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/decoration.css" />
</head>
<body>

  <!-- ─── MOBILE MENU ──────────────────────────────────── -->
  <nav class="mobile-menu" id="mobileMenu">
    <button class="mobile-menu__close" id="mobileClose">✕</button>
    <a href="product.php">Product</a>
    <a href="shop.php">Catalog</a>
    <a href="about.php">About Us</a>
  </nav>

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
  <section class="deco-hero">
    <div class="deco-hero__img-collage">
      <div class="deco-hero__img deco-hero__img--tall">
        <img src="img/deco1.jpg" alt="Decoration" loading="eager" />
      </div>
      <div class="deco-hero__img-stack">
        <div class="deco-hero__img">
          <img src="img/deco2.jpg" alt="Decoration" loading="eager" />
        </div>
        <div class="deco-hero__img">
          <img src="img/deco3.jpg" alt="Decoration" loading="eager" />
        </div>
      </div>
    </div>

    <div class="deco-hero__content reveal">
      <p class="section__label">Room Decoration</p>
      <h1 class="deco-hero__title">Dekorasi Ruangan yang<br><em>Hidup</em> dengan Sentuhan<br>Rangkaian Kami</h1>
      <p class="deco-hero__sub">Setiap ruangan memiliki cerita yang bisa dihidupkan melalui rangkaian bunga yang tepat — hangat, berenergi, dan memorable.</p>
      <a href="#gallery" class="btn-primary">Lihat Galeri →</a>
    </div>
  </section>

  <!-- ─── ABOUT ─────────────────────────────────────────── -->
  <section class="section deco-about">
    <div class="deco-about__inner">
      <div class="deco-about__text reveal">
        <p class="section__label">Filosofi Kami</p>
        <h2 class="deco-about__heading">Setiap Ruang<br>Layak Terasa <em>Hidup</em></h2>
        <p>Banyak ruang terasa kosong, flat, atau kurang berenergi hanya karena belum memiliki sentuhan visual yang tepat. Kami memprovide berbagai konsep dekorasi untuk mengisi spot-spot kosong di ruangan — mulai dari sudut kecil hingga area besar yang memerlukan focal point yang kuat.</p>
        <p>Dengan pemilihan elemen yang tepat, kami menjadikan setiap ruang lebih hidup, lebih hangat, dan lebih memorable.</p>
      </div>

      <div class="deco-about__cards">
        <div class="deco-feature-card reveal">
          <div class="deco-feature-card__icon">
            <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/></svg>
          </div>
          <h3>Artificial Premium</h3>
          <p>Bunga artificial premium untuk dekorasi tahan lama dan low maintenance tanpa perlu perawatan rutin.</p>
        </div>
        <div class="deco-feature-card reveal">
          <div class="deco-feature-card__icon">
            <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
          </div>
          <h3>Kombinasi Fresh &amp; Artificial</h3>
          <p>Kami rekomendasikan kombinasi keduanya untuk menghadirkan vibrasi positif yang membuat ruangan terasa lebih welcoming.</p>
        </div>
        <div class="deco-feature-card reveal">
          <div class="deco-feature-card__icon">
            <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
          <h3>Custom Konsultasi</h3>
          <p>Diskusikan kebutuhan ruanganmu bersama kami. Kami akan bantu menemukan konsep yang paling sesuai.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── GALLERY ───────────────────────────────────────── -->
  <section class="section section--warm deco-gallery" id="gallery">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:2.5rem;">
      <div>
        <p class="section__label">Portfolio</p>
        <h2 class="section__title">Decoration <em>Gallery</em></h2>
      </div>
    </div>

    <div class="deco-gallery__masonry stagger">
      <div class="deco-gallery__item deco-gallery__item--tall reveal">
        <img src="img/deco1.jpg" alt="Decoration" loading="lazy" />
      </div>
      <div class="deco-gallery__item reveal">
        <img src="img/deco2.jpg" alt="Decoration" loading="lazy" />
      </div>
      <div class="deco-gallery__item reveal">
        <img src="img/deco3.jpg" alt="Decoration" loading="lazy" />
      </div>
      <div class="deco-gallery__item reveal">
        <img src="img/deco7.jpg" alt="Decoration" loading="lazy" />
      </div>
      <div class="deco-gallery__item reveal">
        <img src="img/deco5.jpg" alt="Decoration" loading="lazy" />
      </div>
      <div class="deco-gallery__item reveal">
        <img src="img/deco6.jpg" alt="Decoration" loading="lazy" />
      </div>
    </div>
  </section>

  <!-- ─── DECORATION TYPES ──────────────────────────────── -->
  <section class="section deco-types">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Layanan</p>
        <h2 class="section__title">Jenis <em>Dekorasi</em></h2>
      </div>
    </div>

    <div class="deco-types__grid">

      <div class="deco-type-card reveal">
        <div class="deco-type-card__num">01</div>
        <h3>Centerpiece</h3>
        <p>Mempercantik meja makan, coffee table, atau meja tamu. Memberikan suasana hangat dan berkarakter pada ruang yang sering digunakan.</p>
      </div>

      <div class="deco-type-card reveal">
        <div class="deco-type-card__num">02</div>
        <h3>Corner Arrangement</h3>
        <p>Mengisi sudut-sudut ruangan yang kosong dengan rangkaian bunga vertikal atau dalam vase tinggi yang elegan.</p>
      </div>

      <div class="deco-type-card reveal">
        <div class="deco-type-card__num">03</div>
        <h3>Focal Point Besar</h3>
        <p>Instalasi bunga skala besar sebagai focal point utama ruangan — untuk lobi, resepsi, atau area event.</p>
      </div>

      <div class="deco-type-card reveal">
        <div class="deco-type-card__num">04</div>
        <h3>Custom Request</h3>
        <p>Punya konsep sendiri? Kami terbuka untuk didiskusikan. Setiap ruang memiliki keunikannya masing-masing.</p>
      </div>

    </div>
  </section>

  <!-- ─── CTA ──────────────────────────────────────────── -->
  <section class="section section--dark deco-cta reveal">
    <div class="deco-cta__inner">
      <p class="section__label">Konsultasi Gratis</p>
      <h2 class="deco-cta__title">Ingin Konsultasi<br><em>Dekorasi Ruanganmu?</em></h2>
      <p class="deco-cta__sub">Ceritakan konsep dan ruanganmu kepada kami. Kami siap membantu menciptakan suasana yang tepat.</p>
      <a href="https://wa.me/6285795077194?text=Halo, saya ingin konsultasi dekorasi ruangan" target="_blank" class="btn-primary">
        <svg viewBox="0 0 24 24" style="width:16px;height:16px;fill:currentColor;"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        WhatsApp Kami
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