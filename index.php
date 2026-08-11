<?php
require 'conn/db.php';

/* =============================
   BESTSELLERS
============================= */
$stmt = $pdo->prepare("
  SELECT p.id, p.name, p.price, pi.image
  FROM products p
  LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
  WHERE p.id IN (17,20,19,6)
");
$stmt->execute();
$bestsellers = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* =============================
   ALL PRODUCTS + PRICE FILTER
============================= */
$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = $priceFilterActive && isset($_GET['max_price']) ? (int)$_GET['max_price'] : null;

if ($priceFilterActive && $maxPrice !== null) {
    $stmt = $pdo->prepare("
      SELECT p.id, p.name, p.price, pi.image
      FROM products p
      LEFT JOIN product_images pi 
        ON pi.product_id = p.id AND pi.is_primary = 1
      WHERE p.price <= ?
      ORDER BY p.id DESC
    ");
    $stmt->execute([$maxPrice]);
} else {
    $stmt = $pdo->query("
      SELECT p.id, p.name, p.price, pi.image
      FROM products p
      LEFT JOIN product_images pi 
        ON pi.product_id = p.id AND pi.is_primary = 1
      ORDER BY p.id DESC
    ");
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* =============================
   WEDDING PRODUCTS
============================= */
$stmt = $pdo->prepare("
  SELECT p.id, p.name, p.price, pi.image
  FROM products p
  LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
  WHERE FIND_IN_SET('Wedding', p.occasion)
  ORDER BY p.id DESC
  LIMIT 4
");
$stmt->execute();
$weddingProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* =============================
   WORKSHOP PRODUCTS
============================= */
$stmt2 = $pdo->prepare("
  SELECT p.id, p.name, p.price, pi.image
  FROM products p
  LEFT JOIN product_images pi 
    ON pi.product_id = p.id AND pi.is_primary = 1
  WHERE FIND_IN_SET('Workshop', p.occasion)
  ORDER BY p.id DESC
  LIMIT 4
");
$stmt2->execute();
$workshopProducts = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>

  <title>Ilmis Garden | Florist, Bouquet & Decoration Services</title>
  <meta name="description" content="Selamat datang di Ilmis Garden, penyedia layanan karangan bunga, buket, dan dekorasi terbaik.">
  <link rel="canonical" href="https://ilmisgarden.com/">
  
  <meta property="og:title" content="Ilmis Garden | Florist, Bouquet & Decoration Services">
  <meta property="og:description" content="Selamat datang di Ilmis Garden, penyedia layanan karangan bunga, buket, dan dekorasi terbaik.">
  <meta property="og:url" content="https://ilmisgarden.com/">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">
  
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Ilmis Garden | Florist, Bouquet & Decoration Services">
  <meta name="twitter:description" content="Selamat datang di Ilmis Garden, penyedia layanan karangan bunga, buket, dan dekorasi terbaik.">
  <meta name="twitter:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link rel="icon" href="favicon.ico" sizes="any">
  <link rel="icon" href="favicon-32x32.png" type="image/png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Preload Critical Images for Performance -->
  <link rel="preload" as="image" href="img/F4F6F4-full.png" fetchpriority="high">
  <link rel="preload" as="image" href="img/heroimg1-nogb.png" fetchpriority="high">
  <link rel="preload" as="image" href="img/heroimg2-nogb.png" fetchpriority="high">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="css/index.css?v=<?= time() ?>" />

</head>
<body>



<?php include 'includes/navbar.php'; ?>

<!-- HERO -->
<section class="hero" id="home">
  <div class="hero__slides">
    <div class="hero__slide hero__slide--nogb active" style="background-image:url('img/heroimg1-nogb.png')"
         data-title="Selamat datang di<br><em>Ilmisgarden</em>"
         data-text="Tempat di mana setiap bunga punya cerita.<br>Kami merangkai setiap tangkai dengan cinta untuk setiap momen spesialmu."
         data-link="product"
         data-btn="Lihat Produk →"></div>
    <div class="hero__slide hero__slide--artisan" style="background-image:url('img/heroimg2-nogb.png')"
         data-title="Produk Artisan<br><em>Eksklusif</em>"
         data-text="Artisan produk berbahan dasar bunga<br>berkolaborasi dengan pengrajin lokal dan desain berkarakter."
         data-link="artisan"
         data-btn="Lihat Artisan →"></div>
    <?php if (defined('SHOW_EID_COLLECTION') && SHOW_EID_COLLECTION): ?>
    <div class="hero__slide" style="background-image:url('img/lebaran_banner.png')"
         data-title="Eid Collection<br><em>Special</em>"
         data-text="Sempurnakan perayaan Idul Fitri dengan hampers elegan<br>yang membawa kehangatan dan kebersamaan."
         data-link="lebaran"
         data-btn="Lihat Koleksi Lebaran →"></div>
    <?php endif; ?>
  </div>

  <div class="hero__content">
    <p class="hero__eyebrow">Flower Atelier · Bandung</p>

    <h1 class="hero__title" id="hero-title"></h1>
    <p class="hero__sub" id="hero-text"></p>

    <div class="hero__actions">
      <a href="#" id="hero-btn" class="btn-primary">Lihat Produk →</a>
      <a href="<?= BASE_URL ?>/about" class="btn-outline">Tentang Kami</a>
    </div>
  </div>

  <div class="hero__dots">
    <button class="hero__dot active" data-slide="0"></button>
    <button class="hero__dot" data-slide="1"></button>
    <?php if (defined('SHOW_EID_COLLECTION') && SHOW_EID_COLLECTION): ?>
    <button class="hero__dot" data-slide="2"></button>
    <?php endif; ?>
  </div>
</section>

    <!-- ─── ABOUT STRIP ──────────────────────────────────── -->
<section class="about-strip reveal">
  <div class="about-strip__inner">
    <div class="about-strip__text">
      <p class="about-strip__desc">
        Ilmisgarden adalah toko bunga di Bandung yang menyediakan bouquet fresh flowers untuk berbagai momen spesial. Kami melayani <strong>custom rangkaian bunga</strong>, hampers &amp; gift decoration, serta <strong>same day delivery</strong> area Bandung — dengan desain yang soft, feminine, dan berkesan.
      </p>
    </div>
    <a href="<?= BASE_URL ?>/about" class="about-strip__cta">Kenali Kami →</a>
  </div>
</section>
  <!-- ─── BESTSELLERS ──────────────────────────────────── -->
  <section class="section">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Terlaris</p>
        <h2 class="section__title">Our <em>Bestsellers</em></h2>
      </div>
      <a href="<?= BASE_URL ?>/product" class="link-arrow">Lihat Semua →</a>
    </div>

    <div class="products-grid stagger">
      <?php if (!empty($bestsellers)): ?>
        <?php foreach ($bestsellers as $p): ?>
        <article class="product-card reveal">
          <div class="product-card__img">
            <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy" decoding="async" width="500" height="500" />
            <span class="product-card__tag">Terlaris</span>
          </div>
          <div class="product-card__body">
            <h3 class="product-card__name"><?= htmlspecialchars($p['name']) ?></h3>
            <p class="product-card__price">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
            <a href="product_details?id=<?= $p['id'] ?>">
              <button class="product-card__btn">Beli Sekarang</button>
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No products available.</p>
      <?php endif; ?>
    </div>
  </section>

  <!-- ─── CATALOG ──────────────────────────────────────── -->
  <section class="section section--warm">
    <div class="section__header reveal">
      <div>
        <p class="section__label">Koleksi</p>
        <h2 class="section__title">Explore Our <em>Catalog</em></h2>
      </div>
      <a href="<?= BASE_URL ?>/shop" class="link-arrow">Semua Catalog →</a>
    </div>

    <div class="catalog-masonry stagger">
      <a href="shop?catalog[]=Bouquet" class="catalog-pill reveal">
        <img src="img/bouquet.png" alt="Bouquet" loading="lazy" decoding="async" width="1200" height="1600" />
        <div class="catalog-pill__label"><span>Bouquet</span></div>
      </a>
      <a href="shop?catalog[]=Box" class="catalog-pill reveal">
        <img src="img/box.png" alt="Box" loading="lazy" decoding="async" width="1200" height="1600" />
        <div class="catalog-pill__label"><span>Box</span></div>
      </a>
      <a href="shop?catalog[]=Basket" class="catalog-pill reveal">
        <img src="img/basket.png" alt="Basket" loading="lazy" decoding="async" width="1200" height="1600" />
        <div class="catalog-pill__label"><span>Basket</span></div>
      </a>
      <a href="shop?catalog[]=Standing+Flowers" class="catalog-pill reveal">
        <img src="img/standing.png" alt="Standing Flower" loading="lazy" decoding="async" width="1200" height="1600" />
        <div class="catalog-pill__label"><span>Standing Flower</span></div>
      </a>
      <a href="shop?catalog[]=Vase" class="catalog-pill reveal">
        <img src="img/vase.png" alt="Vase" loading="lazy" decoding="async" width="1200" height="1600" />
        <div class="catalog-pill__label"><span>Vase</span></div>
      </a>
      <a href="<?= BASE_URL ?>/artisan" class="catalog-pill reveal">
        <img src="img/ArtisanProductmenu.png" alt="Artisan Product" loading="lazy" decoding="async" width="3024" height="4032" />
        <div class="catalog-pill__label"><span>Artisan Product</span></div>
      </a>
    </div>
  </section>

  <!-- ─── WEDDING PACKAGE ──────────────────────────────── -->
  <section class="section">
    <div class="split">
      <div class="split__img reveal">
        <img src="img/weddingpkg.jpg" alt="Wedding Package" loading="lazy" decoding="async" width="1200" height="1401" />
      </div>
      <div class="split__text reveal">
        <p class="section__label">Special Package</p>
        <h2>Wedding <em>Package</em></h2>
        <p>Setiap kisah cinta layak dirayakan dengan keindahan yang tulus. <strong>Wedding Bouquet by Ilmisgarden</strong> dirangkai dengan sentuhan lembut dan warna-warna yang menggambarkan harapan, cinta, dan kebahagiaan.</p>
        <p>Dibuat dengan bunga segar pilihan dan desain yang menyesuaikan tema pernikahanmu — sederhana, elegan, dan penuh makna.</p>
        <a href="<?= BASE_URL ?>/wedding" class="btn-primary">Lihat Paket →</a>
      </div>
    </div>

    <?php if (!empty($weddingProducts)): ?>
    <div class="products-grid stagger" style="margin-top:3rem">
      <?php foreach ($weddingProducts as $p): ?>
      <article class="product-card reveal">
        <div class="product-card__img">
          <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy" decoding="async" width="500" height="500" />
          <span class="product-card__tag">Wedding</span>
        </div>
        <div class="product-card__body">
          <h3 class="product-card__name"><?= htmlspecialchars($p['name']) ?></h3>
          <p class="product-card__price">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
          <a href="product_details?id=<?= $p['id'] ?>">
            <button class="product-card__btn">Beli Sekarang</button>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </section>

  <!-- ─── WORKSHOP ──────────────────────────────────────── -->
  <section class="section">
    <div class="workshop-strip reveal">
      <div class="workshop-strip__img">
        <img src="img/image (2).png" alt="Workshop" loading="lazy" decoding="async" width="864" height="1184" />
      </div>
      <div class="workshop-strip__body">
        <p class="section__label">Pengalaman Unik</p>
        <h2>Flower <em>Workshop</em></h2>
        <p>Merangkai bunga adalah cara untuk menyentuh jiwa, memberi ketenangan di tengah kesibukan, dan menumbuhkan rasa percaya diri.</p>
        <p>Dengan setiap kelopak yang kamu susun, kamu bukan hanya menciptakan karya seni, tapi juga menciptakan momen kebahagiaan dan kedamaian dalam dirimu.</p>
        <a href="<?= BASE_URL ?>/workshop" class="btn-primary">Show More →</a>
      </div>
    </div>

    <?php if (!empty($workshopProducts)): ?>
    <div class="products-grid stagger" style="margin-top:3rem">
      <?php foreach ($workshopProducts as $p): ?>
      <article class="product-card reveal">
        <div class="product-card__img">
          <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy" decoding="async" width="500" height="500" />
          <span class="product-card__tag">Workshop</span>
        </div>
        <div class="product-card__body">
          <h3 class="product-card__name"><?= htmlspecialchars($p['name']) ?></h3>
          <p class="product-card__price">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
          <a href="product_details?id=<?= $p['id'] ?>">
            <button class="product-card__btn">Beli Sekarang</button>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </section>

  <!-- ─── VISIT US ─────────────────────────────────────── -->
  <section class="section section--dark">
    <div class="reveal" style="text-align:center; max-width:600px; margin:0 auto;">
      <p class="section__label">Kunjungi Kami</p>
      <h2 class="section__title" style="color:#fff; margin-bottom:1.5rem;">Find Us in <em>Bandung</em></h2>
    </div>
    <div class="location-bar" style="background:transparent; padding:2rem 0 0;">
      <div class="location-inner reveal" style="justify-content:center; max-width:700px; margin:0 auto;">
        <div class="location-icon">
          <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <div class="location-text">
          <h3 style="color:#fff; font-family:var(--serif); font-weight:300;">Jl. Raya Golf Dago No.4, Cigadung</h3>
          <a href="https://maps.app.goo.gl/UiEmKAw1AQ4xS1mEA" target="_blank" style="color:rgba(255,255,255,0.5); border-color:rgba(255,255,255,0.3);">
            Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135 — Buka di Maps →
          </a>
        </div>
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
    <a href="about#contact" class="floating-about">
  Hubungi Kami
</a>
<script src="js/script.js"></script> 
</body>
</html>
