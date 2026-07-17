<?php
require 'conn/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ilmisgarden — Product</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/product.css" />
</head>
<body>



<?php include 'includes/navbar.php'; ?>


  <!-- ─── PAGE HERO ─────────────────────────────────────── -->
  <div class="page-hero">
    <div class="page-hero__content">
      <p class="section__label">Semua Koleksi</p>
      <h1 class="page-hero__title">Our <em>Products</em></h1>
    </div>
  </div>

  <?php if (defined('SHOW_EID_COLLECTION') && SHOW_EID_COLLECTION): ?>
  <!-- ─── EID BANNER ────────────────────────────────────── -->
  <section class="product-banner reveal">
    <a href="<?= BASE_URL ?>/lebaran" class="product-banner__link">
      <img src="img/EID PETALS COLLECTION.png" alt="Eid Petals Collection" />
      <div class="product-banner__overlay">
        <span>Eid Petals Collection →</span>
      </div>
    </a>
  </section>
  <?php endif; ?>

  <!-- ─── MAIN CATEGORIES ───────────────────────────────── -->
  <section class="section product-section">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Kategori Utama</p>
        <h2 class="section__title">Explore by <em>Category</em></h2>
      </div>
    </div>

    <div class="category-grid stagger">

      <a href="<?= BASE_URL ?>/wedding" class="category-card reveal">
        <div class="category-card__img">
          <img src="img/Product (2).png" alt="Wedding Bouquet" loading="lazy" />
        </div>
        <div class="category-card__label">
          <h3>Wedding Bouquet</h3>
          <span class="category-card__arrow">→</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/workshop" class="category-card reveal">
        <div class="category-card__img">
          <img src="img/Product (1).png" alt="Workshop Class" loading="lazy" />
        </div>
        <div class="category-card__label">
          <h3>Workshop Class</h3>
          <span class="category-card__arrow">→</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/floral" class="category-card reveal">
        <div class="category-card__img">
          <img src="img/FlowerArrangement.png" alt="Flower Arrangement" loading="lazy" />
        </div>
        <div class="category-card__label">
          <h3>Flower Arrangement</h3>
          <span class="category-card__arrow">→</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/plants" class="category-card reveal">
        <div class="category-card__img">
          <img src="img/Plants.png" alt="Plants" loading="lazy" />
        </div>
        <div class="category-card__label">
          <h3>Real Plants</h3>
          <span class="category-card__arrow">→</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/decoration" class="category-card reveal">
        <div class="category-card__img">
          <img src="img/Decorations.png" alt="Decorations" loading="lazy" />
        </div>
        <div class="category-card__label">
          <h3>Decorations</h3>
          <span class="category-card__arrow">→</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/artisan" class="category-card reveal">
        <div class="category-card__img">
          <img src="img/ArtisanProduct.png" alt="Artisan Product" loading="lazy" />
        </div>
        <div class="category-card__label">
          <h3>Artisan Product</h3>
          <span class="category-card__arrow">→</span>
        </div>
      </a>

    </div>
  </section>

  <!-- ─── SPOTLIGHT ─────────────────────────────────────── -->
  <section class="section section--warm spotlight-section">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Koleksi Spesial</p>
        <h2 class="section__title">Special <em>Collections</em></h2>
      </div>
    </div>

    <div class="spotlight-grid stagger">

      <a href="<?= BASE_URL ?>/bulan-penuh-cinta" class="spotlight-card reveal">
        <div class="spotlight-card__img">
          <img src="img/Bulanpenuhcinta.png" alt="Bulan Penuh Cinta" loading="lazy" />
        </div>
        <div class="spotlight-card__label">
          <h3>Sebulan Penuh Cinta</h3>
          <p>Hadirkan cinta setiap hari</p>
          <span class="link-arrow" style="color:var(--sage-light); border-color:var(--sage-light)">Lihat Koleksi →</span>
        </div>
      </a>

      <a href="<?= BASE_URL ?>/imlek" class="spotlight-card reveal">
        <div class="spotlight-card__img">
          <img src="img/Imlek.png" alt="Imlek" loading="lazy" />
        </div>
        <div class="spotlight-card__label">
          <h3>Imlek Collection</h3>
          <p>Rayakan keberuntungan dengan bunga</p>
          <span class="link-arrow" style="color:var(--sage-light); border-color:var(--sage-light)">Lihat Koleksi →</span>
        </div>
      </a>

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
   /* Navbar scroll */
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 60);
    });

 
document.addEventListener("DOMContentLoaded", () => {
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
});
  </script>
  <script src="js/script.js"></script>
  <a href="about#contact" class="floating-about">
  Hubungi Kami
</a>
</body>
</html>