<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eid Petals Collection — Ilmisgarden</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/lebaran.css" />
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
  <section class="article-hero">
    <div class="article-hero__bg">
      <img src="img/lebaran_banner.jpg" alt="Eid Petals Collection" />
    </div>
    <div class="article-hero__overlay"></div>
    <div class="article-hero__content reveal">
      <p class="section__label">Koleksi Spesial</p>
      <h1 class="article-hero__title">Merayakan Hari yang Fitri<br>bersama <em>Ilmisgarden</em></h1>
      <p class="article-hero__sub">Rayakan kehangatan Hari Raya dengan rangkaian hampers elegan dari Eid Petals Collection yang menghadirkan keharuman bunga, ketenangan, dan kehangatan dalam satu bingkisan istimewa.</p>
      <a href="shop.php?occasion%5B%5D=Eid+Al+Fitr" class="btn-primary">Lihat Koleksi Eid Petals →</a>
    </div>
  </section>

  <!-- ─── ARTICLE BODY ──────────────────────────────────── -->
  <section class="article-body section">
    <div class="article-body__inner">

      <div class="article-lead reveal">
        <p>Rayakan kehangatan Hari Raya dengan <strong>Eid Petals Collection</strong>, rangkaian hampers Lebaran yang identik dengan keharuman bunga <strong>sedap malam</strong> dalam satu koleksi premium yang elegan.</p>
      </div>

      <div class="article-prose reveal">
        <p>Dirancang dengan komposisi bunga bernuansa <strong>putih, hijau, dan biru muda</strong> yang lembut, koleksi ini menghadirkan suasana tenang, hangat, dan penuh rasa syukur yang identik dengan momen Idul Fitri.</p>

        <p>Di dalam setiap hampers, tersusun pilihan produk yang dipadukan secara harmonis. Mulai dari <strong>reed diffuser</strong> dengan aroma lembut yang menghadirkan suasana tenang di rumah, <strong>floral tea</strong> dengan sentuhan bunga yang memberikan momen minum teh lebih menenangkan, hingga <strong>kue Lebaran</strong> yang manis dan klasik untuk menemani kebersamaan bersama keluarga.</p>

        <p>Seluruhnya dilengkapi dengan rangkaian bunga <strong>sedap malam</strong> yang wangi, dirangkai secara elegan sehingga menciptakan bingkisan yang tidak hanya indah dipandang tetapi juga menghadirkan kehangatan dan makna dalam setiap detailnya.</p>

        <p>Lebih dari sekadar hadiah, <strong>Eid Petals Collection</strong> adalah cara yang indah untuk menyampaikan ucapan, doa, dan rasa terima kasih kepada keluarga, sahabat, maupun kolega — sebuah bingkisan yang membawa kehangatan, kebahagiaan, dan makna silaturahmi di hari yang fitri.</p>
      </div>

    </div>
  </section>

  <!-- ─── PRODUCTS ──────────────────────────────────────── -->
  <section class="section section--warm article-products">
    <div class="section__header reveal" style="justify-content:center; text-align:center; margin-bottom:4rem;">
      <div>
        <p class="section__label">Eid Petals Collection</p>
        <h2 class="section__title">Pilihan <em>Hampers</em> Kami</h2>
      </div>
    </div>

    <!-- Mubarak Lux Box -->
    <div class="product-feature reveal">
      <div class="product-feature__header">
        <h3 class="product-feature__name">Mubarak Lux Box</h3>
        <p class="product-feature__desc">Hampers elegan dengan rangkaian bunga sedap malam dan pilihan produk premium.</p>
      </div>
      <div class="product-feature__images">
        <div class="product-feature__img product-feature__img--large">
          <img src="img/Mubarak_1.jpg" alt="Mubarak Lux Box" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/Mubarak_2.jpg" alt="Mubarak Lux Box" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/Mubarak_3.jpg" alt="Mubarak Lux Box" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Silaturahmi in Bloom -->
    <div class="product-feature product-feature--reverse reveal">
      <div class="product-feature__header">
        <h3 class="product-feature__name">Silaturahmi in Bloom</h3>
        <p class="product-feature__desc">Hampers yang menggambarkan kehangatan silaturahmi di Hari Raya.</p>
      </div>
      <div class="product-feature__images">
        <div class="product-feature__img product-feature__img--large">
          <img src="img/silaturahmi_1.jpg" alt="Silaturahmi in Bloom" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/silaturahmi_2.jpg" alt="Silaturahmi in Bloom" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/silaturahmi_3.jpg" alt="Silaturahmi in Bloom" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Cookies and Bloom -->
    <div class="product-feature reveal">
      <div class="product-feature__header">
        <h3 class="product-feature__name">Cookies and Bloom</h3>
        <p class="product-feature__desc">Kombinasi kue Lebaran klasik dengan rangkaian bunga yang elegan.</p>
      </div>
      <div class="product-feature__images">
        <div class="product-feature__img product-feature__img--large">
          <img src="img/cookiesnbloom_1.jpg" alt="Cookies and Bloom" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/cookiesnbloom_2.jpg" alt="Cookies and Bloom" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/cookiesnbloom_3.jpg" alt="Cookies and Bloom" loading="lazy" />
        </div>
      </div>
    </div>

    <!-- Tuberose Vase -->
    <div class="product-feature product-feature--reverse reveal">
      <div class="product-feature__header">
        <h3 class="product-feature__name">Tuberose Vase &amp; Flower Market</h3>
        <p class="product-feature__desc">Keindahan bunga sedap malam dalam rangkaian vase yang elegan dan harum.</p>
      </div>
      <div class="product-feature__images product-feature__images--two">
        <div class="product-feature__img">
          <img src="img/eidvase_1.jpg" alt="Tuberose Vase" loading="lazy" />
        </div>
        <div class="product-feature__img">
          <img src="img/eidvase_2.jpg" alt="Tuberose Vase" loading="lazy" />
        </div>
      </div>
    </div>

  </section>

  <!-- ─── CTA ──────────────────────────────────────────── -->
  <section class="article-cta section section--dark reveal">
    <div class="article-cta__inner">
      <p class="section__label">Pesan Sekarang</p>
      <h2 class="article-cta__title">Hadirkan <em>Kehangatan</em><br>di Hari yang Fitri</h2>
      <p class="article-cta__sub">Tersedia dalam berbagai pilihan paket untuk keluarga, sahabat, dan kolega.</p>
      <a href="shop.php?occasion%5B%5D=Eid+Al+Fitr" class="btn-primary">Lihat Semua Koleksi Eid →</a>
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

    /* Mobile menu */
    const hamburger   = document.getElementById('hamburger');
    const mobileMenu  = document.getElementById('mobileMenu');
    const mobileClose = document.getElementById('mobileClose');
    hamburger.addEventListener('click', () => mobileMenu.classList.add('open'));
    mobileClose.addEventListener('click', () => mobileMenu.classList.remove('open'));
    mobileMenu.querySelectorAll('a').forEach(a =>
      a.addEventListener('click', () => mobileMenu.classList.remove('open'))
    );

    /* Scroll reveal */
    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
      });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
  <script src="js/script.js"></script>
</body>
</html>