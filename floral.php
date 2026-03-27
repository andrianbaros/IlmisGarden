<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flower Arrangement — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/floral.css" />
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


  <!-- HERO -->
  <section class="floral-hero">
    <div class="floral-hero__overlay"></div>
    <div class="floral-hero__content reveal">
      <p class="section__label">Flower Arrangement</p>
      <h1 class="floral-hero__title">Merangkai Cerita<br>dalam Setiap <em>Bunga</em></h1>
      <p class="floral-hero__sub">Setiap rangkaian menyampaikan perasaan, menciptakan suasana, dan meninggalkan kesan yang tak terlupakan.</p>
      <a href="#catalog" class="btn-primary">Lihat Katalog Bunga</a>
    </div>
  </section>

  <!-- STORY -->
  <section class="section floral-story">
    <div class="floral-story__inner">
      <div class="floral-story__text reveal">
        <p class="section__label">Layanan Kami</p>
        <h2 class="floral-story__heading">Berbagai Jenis <em>Arrangement</em></h2>
        <p>Kami menyediakan berbagai jenis flower arrangement yang dapat disesuaikan untuk berbagai momen:</p>
        <ul class="floral-list">
          <li>Bouquet Flower</li>
          <li>Basket Flower</li>
          <li>Bloombox Flower</li>
          <li>Vase Arrangement</li>
          <li>Standing Flower &amp; Blooming Canvas</li>
          <li>Dan rangkaian lain sesuai permintaan</li>
        </ul>
        <p>Setiap produk dibuat menggunakan bunga pilihan terbaik untuk memastikan tampilan yang cantik, harmonis, dan tahan lama.</p>
      </div>
      <div class="floral-story__imgs reveal">
        <div class="floral-story__img-main">
          <img src="img/floral (5).jpg" alt="Trend Arrangement" loading="lazy" />
        </div>
        <div class="floral-story__img-sm">
          <img src="img/floral (4).jpg" alt="Asymmetric Design" loading="lazy" />
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="section section--warm floral-features">
    <div class="section__header reveal" style="justify-content:center;text-align:center;margin-bottom:3rem;">
      <div>
        <p class="section__label">Keunggulan</p>
        <h2 class="section__title">Ciri Khas <em>Ilmisgarden</em></h2>
      </div>
    </div>
    <div class="features-trio">
      <div class="feature-card reveal">
        <div class="feature-card__icon">
          <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        </div>
        <h3>Selalu Mengikuti Tren</h3>
        <p>Modern minimalis, rustic, korean style, pastel aesthetic, hingga desain elegan klasik.</p>
      </div>
      <div class="feature-card reveal">
        <div class="feature-card__icon">
          <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <h3>Desain Asimetris Seimbang</h3>
        <p>Komposisi asimetris memberikan flow yang halus sehingga bunga tidak terlihat berat atau monoton.</p>
      </div>
      <div class="feature-card reveal">
        <div class="feature-card__icon">
          <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3>Omakase — Percayakan pada Kami</h3>
        <p>Sampaikan tema warna dan nuansa — sisanya kami olah dengan kreativitas penuh menggunakan bunga terbaik hari ini.</p>
      </div>
    </div>
  </section>

  <!-- STANDING FLOWER -->
  <section class="section floral-standing">
    <div class="floral-standing__inner">
      <div class="floral-standing__text reveal">
        <p class="section__label">Produk Spesial</p>
        <h2 class="floral-standing__heading">Standing <em>Flower</em></h2>
        <p>Standing Flower premium yang dirancang khusus untuk menyampaikan pesan positif, doa baik, dan apresiasi yang tulus.</p>
        <p><strong>Cocok untuk:</strong></p>
        <ul class="floral-list">
          <li>Ucapan Selamat Ulang Tahun</li>
          <li>Graduation / Wisuda</li>
          <li>Grand Opening Toko, Kantor, atau Usaha Baru</li>
          <li>Ucapan Selamat &amp; Sukses</li>
          <li>Event Korporat &amp; Acara Spesial Lainnya</li>
        </ul>
        <p>Tersedia pilihan bunga segar ataupun artifisial, modern dan elegan, dapat disesuaikan dengan tema acara.</p>
      </div>
      <div class="floral-standing__gallery reveal">
        <div class="standing-gallery-grid">
          <div class="standing-gallery-grid__item standing-gallery-grid__item--tall">
            <img src="img/floral3.jpeg" alt="Standing Flower" loading="lazy" />
          </div>
          <div class="standing-gallery-grid__item">
            <img src="img/floral2.jpeg" alt="Standing Flower" loading="lazy" />
          </div>
          <div class="standing-gallery-grid__item">
            <img src="img/floral1.jpeg" alt="Standing Flower" loading="lazy" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- BLOOMING CANVAS -->
  <section class="section section--dark floral-canvas">
    <div class="floral-canvas__inner">
      <div class="floral-canvas__text reveal">
        <p class="section__label">Koleksi Eksklusif</p>
        <h2 class="floral-canvas__heading">Blooming <em>Canvas</em></h2>
        <p>Papan ucapan dengan rangkaian bunga artificial bernuansa elegan, cocok untuk momen pernikahan dan acara spesial lainnya.</p>
        <p>Menggunakan kombinasi bunga premium dengan warna lembut serta latar artistik yang modern.</p>
        <p class="floral-canvas__note"><em>Tulisan dan warna dapat disesuaikan sesuai tema. Tersedia berbagai ukuran dan desain.</em></p>
      </div>
      <div class="floral-canvas__gallery reveal">
        <div class="canvas-gallery-grid">
          <div class="canvas-gallery-grid__item canvas-gallery-grid__item--wide">
            <img src="img/BloomingCanvas1.png" alt="Blooming Canvas" loading="lazy" />
          </div>
          <div class="canvas-gallery-grid__item">
            <img src="img/BloomingCanvas2.png" alt="Blooming Canvas" loading="lazy" />
          </div>
          <div class="canvas-gallery-grid__item">
            <img src="img/BloomingCanvas3.png" alt="Blooming Canvas" loading="lazy" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="section section--warm floral-cta reveal" style="text-align:center;">
    <p class="section__label">Diskusi Bebas</p>
    <h2 class="section__title" style="margin-bottom:1rem;">Siap Memesan? <em>Hubungi Kami</em></h2>
    <p style="color:var(--muted);font-size:0.9rem;margin-bottom:2rem;">Konsultasikan kebutuhan rangkaian bungamu — kami siap membantu.</p>
    <a href="https://wa.me/6285795077194?text=Halo, saya ingin konsultasi flower arrangement" target="_blank" class="btn-primary">Chat via WhatsApp</a>
  </section>

  <!-- CATALOG -->
  <section class="section floral-catalog" id="catalog">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Price Guide</p>
        <h2 class="section__title">Flower Bouquet <em>Catalog</em></h2>
      </div>
    </div>

    <div class="catalog-sections">

      <?php
      $catalogItems = [
        ['name'=>'Omakase','desc'=>'Percayakan pilihan bunga sepenuhnya pada kreativitas kami.','items'=>[
          ['img'=>'Frame 157.png','name'=>''],
          ['img'=>'Frame 158.png','name'=>''],
          ['img'=>'Frame 1581.png','name'=>''],
        ],'swatches'=>['#e8d4c8','#d5b4a0','#8a6d5a','#c3d2b2']],

        ['name'=>'Rose','items'=>[
          ['img'=>'rose1.png','name'=>'Single Rose','price'=>'Mulai 50k','info'=>'1 Stem'],
          ['img'=>'rose2.png','name'=>'Petite Rose','price'=>'Mulai 85k','info'=>'3 Stem'],
          ['img'=>'rose3.png','name'=>'Small Rose','price'=>'Mulai 155k','info'=>'>5 Stem'],
        ],'swatches'=>['#c43b3b','#ffcece','#ffc7e1','#ffe6d9','#ffffff']],

        ['name'=>'Hydrangea','items'=>[
          ['img'=>'Hydrangea1.png','name'=>'Single Blue','price'=>'Mulai 77k'],
          ['img'=>'Hydrangea2.png','name'=>'Purple','price'=>'Mulai 126k'],
          ['img'=>'Hydrangea3.png','name'=>'Small','price'=>'Mulai 160k'],
        ],'swatches'=>['#7eb6ff','#d4a4ff','#ffb3d9']],

        ['name'=>'Pom Pom','items'=>[
          ['img'=>'PomPom1.png','name'=>'Single','price'=>'Mulai 80k'],
          ['img'=>'PomPom2.png','name'=>'Medium','price'=>'Mulai 350k'],
          ['img'=>'PomPom3.png','name'=>'Large','price'=>'Mulai 450k'],
        ],'swatches'=>['#ffdfef','#d9f5ff','#fff7ad']],

        ['name'=>'Small Gompie','items'=>[
          ['img'=>'Gompie1.png','name'=>'Single','price'=>'Mulai 170k'],
          ['img'=>'Gompie2.png','name'=>'Medium','price'=>'Mulai 280k'],
          ['img'=>'Gompie3.png','name'=>'Large','price'=>'Mulai 520k'],
        ],'swatches'=>['#ffb3b3','#ffcce0','#ffe6f7']],

        ['name'=>'Sunflower','items'=>[
          ['img'=>'Sunflower1.png','name'=>'Single','price'=>'Mulai 100k','info'=>'1 Stem'],
          ['img'=>'Sunflower2.png','name'=>'Small','price'=>'Mulai 170k','info'=>'1 Stem + Foliage'],
          ['img'=>'Sunflower3.png','name'=>'Medium','price'=>'Mulai 430k','info'=>'>3 Stem'],
          ['img'=>'Sunflower4.png','name'=>'Large','price'=>'Mulai 550k','info'=>'>5 Stem'],
        ],'swatches'=>['#ffde3b','#fce893','#7a5c2e']],

        ['name'=>'Gerbera','items'=>[
          ['img'=>'Gerbera1.png','name'=>'Gerbera Only','price'=>'5 Stem: 150k · 10: 200k · 20: 350k'],
          ['img'=>'Gerbera3.png','name'=>'Mix Gerbera','price'=>'Mulai 300k · 5 Stem + Foliage'],
        ],'swatches'=>['#ff7a7a','#ffb6d9','#fff1a8','#ff8f47']],

        ['name'=>'Lily','items'=>[
          ['img'=>'Lily1.png','name'=>'Single','price'=>'Mulai 250k','info'=>'1 Stem + Foliage'],
          ['img'=>'Lily2.png','name'=>'Medium','price'=>'Mulai 500k','info'=>'>2 Stem'],
          ['img'=>'Lily3.png','name'=>'Large','price'=>'Mulai 1.350k','info'=>'>3 Stem'],
        ],'swatches'=>['#fff4f4','#ffd1d6','#f7e9ff']],

        ['name'=>'Dianthus','items'=>[
          ['img'=>'Dianthus1.png','name'=>'Single','price'=>'Mulai 300k','info'=>'>5 Stem'],
          ['img'=>'Dianthus2.png','name'=>'Medium','price'=>'Mulai 555k','info'=>'>10 Stem'],
          ['img'=>'Dianthus3.png','name'=>'Large','price'=>'Mulai 1.150k','info'=>'>20 Stem'],
        ],'swatches'=>['#ffb3c6','#ff7aa2','#ffa8a8']],

        ['name'=>'Lisianthus','items'=>[
          ['img'=>'Lisianthus1.png','name'=>'Single','price'=>'Mulai 150k','info'=>'1 Stem'],
          ['img'=>'Lisianthus2.png','name'=>'Medium','price'=>'Mulai 250k','info'=>'+ Foliage'],
          ['img'=>'Lisianthus3.png','name'=>'Large','price'=>'Mulai 500k','info'=>'>5 Stem'],
        ],'swatches'=>['#ffffff','#e3d7ff','#ffe2ff']],

        ['name'=>'Money Bouquet','items'=>[
          ['img'=>'MoneyBouquet1.png','name'=>'Small','price'=>'Mulai 80k'],
          ['img'=>'MoneyBouquet2.png','name'=>'Medium','price'=>'Mulai 400k'],
          ['img'=>'MoneyBouquet3.png','name'=>'Large','price'=>'Mulai 850k'],
        ],'swatches'=>['#d1ffd8','#fff4b8']],

        ['name'=>'Artificial Flowers','items'=>[
          ['img'=>'ArtificialFlowers1.png','name'=>'Small','price'=>'Mulai 250k'],
          ['img'=>'ArtificialFlowers2.png','name'=>'Medium','price'=>'Mulai 500k'],
          ['img'=>'ArtificialFlowers3.png','name'=>'Large','price'=>'Mulai 700k'],
        ],'swatches'=>['#ffdee2','#e7eaff','#eaffea']],

        ['name'=>'Dried Flowers','items'=>[
          ['img'=>'DriedFlowers1.png','name'=>'Small','price'=>'Mulai 250k'],
          ['img'=>'DriedFlowers2.png','name'=>'Medium','price'=>'Mulai 300k'],
          ['img'=>'DriedFlowers3.png','name'=>'Large','price'=>'Mulai 500k'],
        ],'swatches'=>['#f7e7ce','#e6d8bf','#dfc49a']],
      ];

      foreach ($catalogItems as $cat):
      ?>
      <div class="catalog-block reveal">
        <div class="catalog-block__header">
          <h3><?= $cat['name'] ?></h3>
          <?php if (!empty($cat['desc'])): ?>
          <p><?= $cat['desc'] ?></p>
          <?php endif; ?>
        </div>
        <div class="catalog-block__items">
          <?php foreach ($cat['items'] as $item): ?>
          <div class="catalog-item-card">
            <div class="catalog-item-card__img">
              <img src="img/<?= $item['img'] ?>" alt="<?= $item['name'] ?>" loading="lazy" />
            </div>
            <?php if (!empty($item['name'])): ?>
            <p class="catalog-item-card__name"><?= $item['name'] ?></p>
            <?php endif; ?>
            <?php if (!empty($item['price'])): ?>
            <p class="catalog-item-card__price"><?= $item['price'] ?></p>
            <?php endif; ?>
            <?php if (!empty($item['info'])): ?>
            <p class="catalog-item-card__info"><?= $item['info'] ?></p>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="catalog-block__swatches">
          <?php foreach ($cat['swatches'] as $sw): ?>
          <span class="swatch" style="background:<?= $sw ?>;<?= $sw==='#ffffff'?'border:1px solid #ddd':'' ?>"></span>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
  </section>

  <!-- FOOTER -->
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
    const hamburger  = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileClose= document.getElementById('mobileClose');
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