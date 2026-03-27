<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Workshop — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/workshop.css" />
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
  <section class="ws-hero">
    <div class="ws-hero__img">
      <img src="img/workshop.png" alt="Workshop Bunga Ilmisgarden" />
    </div>
    <div class="ws-hero__content reveal">
      <p class="section__label">Flower Workshop</p>
      <h1 class="ws-hero__title">Bangun Rasa Percaya Diri<br>Melalui Setiap Karya yang<br><em>Kamu Buat dengan Cinta</em></h1>
      <p class="ws-hero__sub">Belajar merangkai bunga dari dasar hingga rangkaian selesai — secara private, group, atau kegiatan corporate.</p>
      <a href="#pricelist" class="btn-primary">Lihat Pricelist →</a>
    </div>
  </section>

  <!-- ─── INTRO ─────────────────────────────────────────── -->
  <section class="section ws-intro">
    <div class="ws-intro__inner">
      <div class="ws-intro__text reveal">
        <p class="section__label">Tentang Workshop</p>
        <h2 class="ws-intro__heading">Ruang Belajar Kreatif<br><em>untuk Semua Kalangan</em></h2>
        <p>Merangkai bunga adalah cara untuk menyentuh jiwa, memberi ketenangan di tengah kesibukan — bentuk ekspresi diri yang membawa banyak manfaat seperti menumbuhkan rasa percaya diri.</p>
        <p>Kebebasan untuk memilih jenis bunga dan rangkaian yang kamu ingin rasakan pengalamannya. Kami akan membantu membuatkan program dan modul yang sesuai untuk kamu.</p>
      </div>
      <div class="ws-intro__img reveal">
        <img src="img/Frame 222.png" alt="Workshop Bunga" loading="lazy" />
      </div>
    </div>
  </section>

  <!-- ─── BENEFITS ──────────────────────────────────────── -->
  <section class="section section--warm ws-benefits">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:3rem;">
      <div>
        <p class="section__label">Mengapa Workshop</p>
        <h2 class="section__title">Manfaat Merangkai <em>Bunga</em></h2>
      </div>
    </div>

    <div class="benefits-grid">
      <div class="benefit-card reveal">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
        </div>
        <h3>Kreativitas</h3>
        <p>Meningkatkan kreativitas melalui perpaduan warna, bentuk, dan tekstur yang harmonis.</p>
      </div>
      <div class="benefit-card reveal">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
        </div>
        <h3>Mengurangi Stres</h3>
        <p>Proses merangkai bunga dikenal menenangkan dan membantu mengurangi kecemasan.</p>
      </div>
      <div class="benefit-card reveal">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        </div>
        <h3>Fokus &amp; Ketelitian</h3>
        <p>Melatih fokus serta ketelitian yang membantu meningkatkan keterampilan motorik halus.</p>
      </div>
      <div class="benefit-card reveal">
        <div class="benefit-card__icon">
          <svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        </div>
        <h3>Percaya Diri</h3>
        <p>Membangun rasa percaya diri saat melihat hasil rangkaian yang berhasil dan indah.</p>
      </div>
    </div>
  </section>

  <!-- ─── FOR WHOM ──────────────────────────────────────── -->
  <section class="section ws-segments">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Untuk Siapa</p>
        <h2 class="section__title">Workshop yang <em>Fleksibel</em></h2>
      </div>
    </div>

    <div class="segments-grid">

      <div class="segment-card reveal">
        <div class="segment-card__badge">Hobi</div>
        <h3 class="segment-card__title">Untuk Hobi</h3>
        <p>Bagi individu yang ingin menikmati aktivitas kreatif — workshop ini menjadi pilihan ideal untuk me time, aktivitas akhir pekan, atau sekadar mencari kegiatan yang menenangkan dan inspiratif.</p>
      </div>

      <div class="segment-card reveal">
        <div class="segment-card__badge">Bisnis</div>
        <h3 class="segment-card__title">Untuk Bisnis</h3>
        <p>Bagi yang tertarik memasuki dunia florist, workshop ini memberikan fondasi penting mulai dari pemilihan bunga, teknik rangkai yang tepat, hingga gaya desain kekinian yang relevan dengan pasar.</p>
      </div>

      <div class="segment-card reveal">
        <div class="segment-card__badge">Korporat</div>
        <h3 class="segment-card__title">Untuk Korporat</h3>
        <p>Diadaptasi menjadi aktivitas team building, employee engagement, atau sesi kreatif untuk meningkatkan kolaborasi. Membangun koneksi, komunikasi, dan suasana kerja yang lebih positif.</p>
      </div>

    </div>
  </section>

  <!-- ─── FACILITIES ────────────────────────────────────── -->
  <section class="section section--dark ws-facilities">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Yang Kami Sediakan</p>
        <h2 class="section__title" style="color:#fff;">Fasilitas <em>Lengkap</em></h2>
      </div>
    </div>
    <div class="facilities-list reveal">
      <div class="facility-item">
        <div class="facility-item__icon">
          <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div>
          <h4>Tempat Belajar Fleksibel</h4>
          <p>Workshop bisa diadakan di studio kami atau sesuai kebutuhan klien.</p>
        </div>
      </div>
      <div class="facility-item">
        <div class="facility-item__icon">
          <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"/><path d="M8 12h8M12 8v8"/></svg>
        </div>
        <div>
          <h4>Peralatan Lengkap</h4>
          <p>Bunga segar, alat rangkai, dan semua perlengkapan disediakan oleh kami.</p>
        </div>
      </div>
      <div class="facility-item">
        <div class="facility-item__icon">
          <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div>
          <h4>Instruktur Berpengalaman</h4>
          <p>Dibimbing oleh florist profesional yang siap mengajarkan teknik merangkai dari dasar.</p>
        </div>
      </div>
      <div class="facility-item">
        <div class="facility-item__icon">
          <svg viewBox="0 0 24 24"><path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
        </div>
        <div>
          <h4>Snack &amp; Minuman</h4>
          <p>Termasuk snack dan minuman selama sesi workshop berlangsung.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ─── PRICELIST ─────────────────────────────────────── -->
  <section class="section ws-pricelist" id="pricelist">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Investasi</p>
        <h2 class="section__title">Pricelist <em>Workshop</em></h2>
      </div>
    </div>

    <div class="price-table-wrap reveal">
      <table class="price-table">
        <thead>
          <tr>
            <th>Jenis Rangkaian</th>
            <th>
              <span class="price-tier">Private</span>
              <small>1 pax</small>
            </th>
            <th>
              <span class="price-tier">Group</span>
              <small>min 5 pax</small>
            </th>
            <th>
              <span class="price-tier price-tier--featured">Corporate</span>
              <small>min 10 pax</small>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Bouquet</strong></td>
            <td>Start from 1.600k</td>
            <td>Start from 900k</td>
            <td>Start from 300k<small>/pax</small></td>
          </tr>
          <tr>
            <td><strong>Vase</strong></td>
            <td>Start from 1.840k</td>
            <td>Start from 1.020k</td>
            <td>Start from 380k<small>/pax</small></td>
          </tr>
          <tr>
            <td><strong>Box</strong></td>
            <td>Start from 2.020k</td>
            <td>Start from 1.110k</td>
            <td>Start from 470k<small>/pax</small></td>
          </tr>
          <tr>
            <td><strong>Basket</strong></td>
            <td>Start from 1.900k</td>
            <td>Start from 1.550k</td>
            <td>Start from 410k<small>/pax</small></td>
          </tr>
          <tr>
            <td><strong>Wedding Bouquet</strong></td>
            <td>Start from 1.800k</td>
            <td>Start from 1.000k</td>
            <td><span class="na">—</span></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="price-includes reveal">
      <p class="price-includes__title">Yang termasuk dalam paket:</p>
      <div class="price-includes__grid">
        <span>✓ Waktu by appointment</span>
        <span>✓ Snack dan minuman</span>
        <span>✓ Modul materi</span>
        <span>✓ Lokasi di studio Ilmisgarden</span>
        <span>✓ Jl. Raya Golf Dago No.4</span>
        <span>✓ Free membership 1 tahun</span>
        <span>✓ Hasil rangkaian milik peserta</span>
      </div>
      <p class="price-includes__note">Kami sangat terbuka untuk berdiskusi mengenai program dan budget yang sesuai dengan kebutuhanmu.</p>
    </div>
  </section>

  <!-- ─── GALLERY ───────────────────────────────────────── -->
  <section class="section section--warm ws-gallery">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:2.5rem;">
      <div>
        <p class="section__label">Dokumentasi</p>
        <h2 class="section__title">Workshop <em>Gallery</em></h2>
      </div>
    </div>
    <div class="gallery-grid stagger">
      <div class="gallery-item reveal"><img src="img/Frame 223.png" alt="Workshop Gallery" loading="lazy" /></div>
      <div class="gallery-item reveal"><img src="img/Frame 224.png" alt="Workshop Gallery" loading="lazy" /></div>
      <div class="gallery-item reveal"><img src="img/Frame 225.png" alt="Workshop Gallery" loading="lazy" /></div>
      <div class="gallery-item reveal"><img src="img/Frame 226.png" alt="Workshop Gallery" loading="lazy" /></div>
      <div class="gallery-item reveal"><img src="img/Frame 227.png" alt="Workshop Gallery" loading="lazy" /></div>
      <div class="gallery-item reveal"><img src="img/Frame 228.png" alt="Workshop Gallery" loading="lazy" /></div>
    </div>
  </section>

  <!-- ─── CTA ──────────────────────────────────────────── -->
  <section class="section section--dark ws-cta reveal">
    <div class="ws-cta__inner">
      <p class="section__label">Daftar Sekarang</p>
      <h2 class="ws-cta__title">Siap Mulai <em>Perjalanan</em><br>Kreatifmu?</h2>
      <p class="ws-cta__sub">Hubungi kami untuk informasi lebih lanjut dan reservasi workshop.</p>
      <div class="ws-cta__actions">
        <a href="https://wa.me/6285795077194?text=Halo, saya ingin info workshop merangkai bunga" target="_blank" class="btn-primary">Chat via WhatsApp →</a>
        <a href="shop.php?occasion%5B%5D=Workshop" class="btn-outline">Lihat Produk Workshop</a>
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