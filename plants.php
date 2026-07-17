<?php require 'conn/db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>

  <title>Live Plants | Ilmis Garden</title>
  <meta name="description" content="Koleksi tanaman hias segar untuk mempercantik ruangan Anda.">
  <link rel="canonical" href="https://ilmisgarden.com/plants">
  
  <meta property="og:title" content="Live Plants | Ilmis Garden">
  <meta property="og:description" content="Koleksi tanaman hias segar untuk mempercantik ruangan Anda.">
  <meta property="og:url" content="https://ilmisgarden.com/plants">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">
  
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Live Plants | Ilmis Garden">
  <meta name="twitter:description" content="Koleksi tanaman hias segar untuk mempercantik ruangan Anda.">
  <meta name="twitter:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/plants.css" />
</head>
<body>



<?php include 'includes/navbar.php'; ?>

  <!-- ─── HERO ─────────────────────────────────────────── -->
  <section class="plants-hero">
    <div class="plants-hero__img">
      <img src="img/Gambar WhatsApp 2025-11-11 pukul 20.31.38_891aa6ac.jpg" alt="Tanaman Hidup" loading="eager" />
    </div>
    <div class="plants-hero__content reveal">
      <p class="section__label">Real Plants</p>
      <h1 class="plants-hero__title">Hadirkan Energi Positif<br>dari <em>Tanaman Hidup</em></h1>
      <p class="plants-hero__sub">Di tengah aktivitas sehari-hari yang padat, tanaman hidup menciptakan suasana yang lebih segar, tenang, dan penuh energi positif di rumah maupun ruang kerjamu.</p>
      <p class="plants-hero__sub">Ilmisgarden adalah toko bunga di Bandung yang menyediakan bouquet fresh flowers untuk berbagai momen spesial seperti wisuda, ulang tahun, anniversary, lamaran, Mother’s Day, hampers floral, dan gift produk fungsional berbahan dasar bunga yang identik dengan Kota Bandung.
Kami melayani custom rangkaian bunga, hampers dan gift decoration, serta same day flower delivery area Bandung. 
Dengan desain yang soft, feminine, dan berkesan, ilmisgarden ingin menjadi bagian dari kebahagiaan setiap momen melalui rangkaian bunga yang indah dan thoughtful.</p>
      <a href="#pricelist" class="btn-primary">Lihat Pricelist →</a>
    </div>
  </section>

  <!-- ─── INTRO BENEFITS ───────────────────────────────── -->
  <section class="section plants-intro">
    <div class="plants-intro__grid">

      <div class="plants-benefit-card reveal">
        <div class="plants-benefit-card__icon">
          <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <h3>Tahan Lama &amp; Mudah Dirawat</h3>
        <p>Setiap tanaman berasal dari kualitas terbaik dengan kondisi akar sehat dan media tanam yang sesuai.</p>
      </div>

      <div class="plants-benefit-card reveal">
        <div class="plants-benefit-card__icon">
          <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16z"/><path d="M8 12h8M12 8v8"/></svg>
        </div>
        <h3>Energi Positif</h3>
        <p>Tanaman hidup dipercaya meningkatkan mood, memberi ketenangan, dan membuat ruang terasa lebih hidup.</p>
      </div>

      <div class="plants-benefit-card reveal">
        <div class="plants-benefit-card__icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
        </div>
        <h3>Dekorasi Estetis</h3>
        <p>Warna hijau alami merilekskan mata dan menghadirkan sentuhan segar yang memperindah setiap sudut ruangan.</p>
      </div>

    </div>
  </section>

  <!-- ─── GALLERY ───────────────────────────────────────── -->
  <section class="plants-gallery section section--warm">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:2.5rem;">
      <div>
        <p class="section__label">Koleksi</p>
        <h2 class="section__title">Real Plant <em>Gallery</em></h2>
      </div>
    </div>
    <div class="plants-gallery__grid stagger">
      <div class="plants-gallery__item reveal"><img src="img/plants 2.jpg" alt="Real Plant" loading="lazy" /></div>
      <div class="plants-gallery__item reveal"><img src="img/plants 3.jpg" alt="Real Plant" loading="lazy" /></div>
      <div class="plants-gallery__item reveal"><img src="img/plants 4.jpg" alt="Real Plant" loading="lazy" /></div>
    </div>
  </section>

  <!-- ─── ORCHID PRICELIST ─────────────────────────────── -->
  <section class="section plants-pricelist" id="pricelist">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Pricelist Tanaman Hidup</p>
        <h2 class="section__title">Orchid <em>on Vase</em></h2>
      </div>
    </div>

    <div class="orchid-grid">

      <!-- Orchid 1 / 2 -->
      <div class="orchid-card reveal">
        <div class="orchid-card__img">
          <img src="img/orchid21.png" alt="Orchid 1 or 2" loading="lazy" />
        </div>
        <div class="orchid-card__body">
          <h3>Orchid 1 or 2</h3>
          <div class="orchid-card__prices">
            <div class="orchid-price-block">
              <span class="orchid-price-block__amount">365K</span>
              <ul>
                <li>1 orchid plant</li>
                <li>Small ceramic vase</li>
                <li>Ornaments</li>
              </ul>
            </div>
            <div class="orchid-price-block">
              <span class="orchid-price-block__amount">665K</span>
              <ul>
                <li>2 orchid plants</li>
                <li>Small ceramic vase</li>
                <li>Ornaments</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Orchid 3 -->
      <div class="orchid-card reveal">
        <div class="orchid-card__img">
          <img src="img/orchid22.png" alt="Orchid 3" loading="lazy" />
        </div>
        <div class="orchid-card__body">
          <h3>Orchid 3</h3>
          <div class="orchid-card__prices">
            <div class="orchid-price-block">
              <span class="orchid-price-block__amount">1.000K</span>
              <ul>
                <li>3 orchid plants</li>
                <li>Medium ceramic vase</li>
                <li>Ornaments</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Orchid 5 / 6 -->
      <div class="orchid-card reveal">
        <div class="orchid-card__img">
          <img src="img/orchid23.png" alt="Orchid 5 or 6" loading="lazy" />
        </div>
        <div class="orchid-card__body">
          <h3>Orchid 5 or 6</h3>
          <div class="orchid-card__prices">
            <div class="orchid-price-block">
              <span class="orchid-price-block__amount">1.600K</span>
              <ul>
                <li>5 orchid plants</li>
                <li>Large ceramic vase</li>
                <li>Ornaments</li>
              </ul>
            </div>
            <div class="orchid-price-block">
              <span class="orchid-price-block__amount">1.900K</span>
              <ul>
                <li>6 orchid plants</li>
                <li>Large ceramic vase</li>
                <li>Ornaments</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Variety -->
    <div class="orchid-variety reveal">
      <p class="orchid-variety__label">Pilihan Varietas</p>
      <div class="orchid-variety__imgs">
        <img src="img/orchid-var1.png" alt="Orchid Variety 1" loading="lazy" />
        <img src="img/orchid-var2.png" alt="Orchid Variety 2" loading="lazy" />
        <img src="img/orchid-var3.png" alt="Orchid Variety 3" loading="lazy" />
        <img src="img/orchid-var4.png" alt="Orchid Variety 4" loading="lazy" />
        <img src="img/orchid-var5.png" alt="Orchid Variety 5" loading="lazy" />
      </div>
    </div>
  </section>

  <!-- ─── CTA ──────────────────────────────────────────── -->
  <section class="section section--dark plants-cta reveal">
    <div class="plants-cta__inner">
      <p class="section__label">Pesan Sekarang</p>
      <h2 class="plants-cta__title">Percantik Ruanganmu<br>dengan <em>Tanaman Hidup</em></h2>
      <p class="plants-cta__sub">Hubungi kami untuk informasi ketersediaan dan pemesanan.</p>
      <a href="https://wa.me/6285795077194?text=Halo, saya tertarik dengan tanaman hidup Ilmisgarden" target="_blank" class="btn-primary">
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

    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
  <script src="js/script.js"></script>
   <a href="about#contact" class="floating-about">
  Hubungi Kami
</a>
</body>
</html>