<?php
session_start();
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;

/* =============================
   FILTER OPTIONS
============================= */
$catalogs = [
  'Add-on','Artificial Flowers','Basket','Best Seller','Blooming Canvas',
  'Bouquet','Box','Centerpiece','Dried Flowers','Money Bouquet',
  'Standing Flowers','Vase','Wedding Bouquet'
];

$flowers = [
  'Dianthus','Gerbera','Gompie','Hydrangea','Lilly',
  'Lisianthus','Pom-pom','Rose','Sunflower'
];

$occasions = [
  'Anniversary','Birthday','Christmas','Graduation','Grand Opening',
  'Gift','Raya','Valentine','Wedding',
  'Sebulan Penuh Cinta','Imlek','Eid Al Fitr'
];

/* =============================
   GET FILTER
============================= */
$catalogFilter  = $_GET['catalog'] ?? [];
$flowerFilter   = $_GET['flower'] ?? [];
$occasionFilter = $_GET['occasion'] ?? [];

$priceFilterActive = isset($_GET['price_filter']);
$maxPrice = ($priceFilterActive && isset($_GET['max_price']))
              ? (int)$_GET['max_price']
              : null;

/* =============================
   QUERY
============================= */
$sql = "
  SELECT p.*, pi.image AS main_image
  FROM products p
  LEFT JOIN product_images pi
    ON p.id = pi.product_id AND pi.is_primary = 1
  WHERE 1=1
";
$params = [];

if ($catalogFilter) {
  $likes = [];
  foreach ($catalogFilter as $c) {
    $likes[] = "FIND_IN_SET(LOWER(REPLACE(?,' ','')), LOWER(REPLACE(p.catalog,' ','')))";
    $params[] = strtolower($c);
  }
  $sql .= " AND p.catalog IS NOT NULL AND (" . implode(" OR ", $likes) . ")";
}

if ($flowerFilter) {
  $likes = [];
  foreach ($flowerFilter as $f) {
    $likes[] = "FIND_IN_SET(LOWER(REPLACE(?,' ','')), LOWER(REPLACE(p.flower,' ','')))";
    $params[] = strtolower($f);
  }
  $sql .= " AND p.flower IS NOT NULL AND (" . implode(" OR ", $likes) . ")";
}

if ($occasionFilter) {
  $likes = [];
  foreach ($occasionFilter as $o) {
    $likes[] = "FIND_IN_SET(LOWER(REPLACE(?,' ','')), LOWER(REPLACE(p.occasion,' ','')))";
    $params[] = strtolower($o);
  }
  $sql .= " AND p.occasion IS NOT NULL AND (" . implode(" OR ", $likes) . ")";
}

if ($priceFilterActive && $maxPrice) {
  $sql .= " AND p.price <= ?";
  $params[] = $maxPrice;
}

$sql .= " ORDER BY p.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

$activeFilterCount = count($catalogFilter) + count($flowerFilter) + count($occasionFilter)
                   + ($priceFilterActive && $maxPrice ? 1 : 0);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IlmisGarden — Catalog</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/shop.css" />
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
      <li><a href="shop.php" class="active">Catalog</a></li>
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

  <!-- ─── PAGE HERO ─────────────────────────────────────── -->
  <div class="page-hero">
    <div class="page-hero__content">
      <p class="section__label">Koleksi Lengkap</p>
      <h1 class="page-hero__title">Explore Our <em>Catalog</em></h1>
    </div>
  </div>

  <!-- ─── MAIN LAYOUT ───────────────────────────────────── -->
  <div class="shop-layout">

    <!-- ── SIDEBAR FILTER ────────────────────────────────── -->
    <aside class="shop-sidebar" id="sidebar">
      <div class="sidebar-header">
        <h2 class="sidebar-title">Filter</h2>
        <?php if ($activeFilterCount > 0): ?>
          <a href="shop.php" class="sidebar-clear">Reset (<?= $activeFilterCount ?>)</a>
        <?php endif; ?>
      </div>

      <form method="GET" id="filterForm">

        <!-- By Catalog -->
        <div class="filter-group">
          <button type="button" class="filter-group__toggle">
            By Catalog
            <svg class="toggle-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="filter-group__body">
            <?php foreach ($catalogs as $c): ?>
            <label class="filter-check">
              <input type="checkbox" name="catalog[]" value="<?= $c ?>"
                <?= in_array($c, $catalogFilter) ? 'checked' : '' ?>>
              <span class="filter-check__box"></span>
              <?= $c ?>
            </label>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- By Flowers -->
        <div class="filter-group">
          <button type="button" class="filter-group__toggle">
            By Flowers
            <svg class="toggle-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="filter-group__body">
            <?php foreach ($flowers as $f): ?>
            <label class="filter-check">
              <input type="checkbox" name="flower[]" value="<?= $f ?>"
                <?= in_array($f, $flowerFilter) ? 'checked' : '' ?>>
              <span class="filter-check__box"></span>
              <?= $f ?>
            </label>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- By Occasion -->
        <div class="filter-group">
          <button type="button" class="filter-group__toggle">
            By Occasion
            <svg class="toggle-icon" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
          </button>
          <div class="filter-group__body">
            <?php foreach ($occasions as $o): ?>
            <label class="filter-check">
              <input type="checkbox" name="occasion[]" value="<?= $o ?>"
                <?= in_array($o, $occasionFilter) ? 'checked' : '' ?>>
              <span class="filter-check__box"></span>
              <?= $o ?>
            </label>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Price -->
        <div class="filter-group filter-group--price">
          <label class="filter-check filter-check--price">
            <input type="checkbox" name="price_filter" id="priceToggle"
              <?= $priceFilterActive ? 'checked' : '' ?>>
            <span class="filter-check__box"></span>
            Max Price
          </label>
          <div class="price-input-wrap" id="priceInputWrap"
               style="<?= $priceFilterActive ? '' : 'display:none' ?>">
            <span class="price-prefix">Rp</span>
            <input type="number" name="max_price" min="0" step="1000"
                   placeholder="500.000"
                   value="<?= htmlspecialchars($maxPrice ?? '') ?>" />
          </div>
        </div>

        <button type="submit" class="btn-apply">Terapkan Filter</button>

      </form>
    </aside>

    <!-- ── PRODUCT AREA ───────────────────────────────────── -->
    <main class="shop-main">

      <!-- Topbar -->
      <div class="shop-topbar">
        <p class="shop-count">
          <?php if ($activeFilterCount > 0): ?>
            Menampilkan <strong><?= count($products) ?></strong> produk
          <?php else: ?>
            <strong><?= count($products) ?></strong> produk tersedia
          <?php endif; ?>
        </p>

        <!-- Mobile filter toggle -->
        <button class="btn-filter-toggle" id="filterToggle">
          <svg viewBox="0 0 24 24"><line x1="4" y1="6" x2="20" y2="6"/><line x1="8" y1="12" x2="16" y2="12"/><line x1="11" y1="18" x2="13" y2="18"/></svg>
          Filter<?= $activeFilterCount > 0 ? " ({$activeFilterCount})" : '' ?>
        </button>
      </div>

      <!-- Active filter pills -->
      <?php if ($activeFilterCount > 0): ?>
      <div class="filter-pills">
        <?php foreach ($catalogFilter as $c): ?>
          <span class="filter-pill"><?= $c ?></span>
        <?php endforeach; ?>
        <?php foreach ($flowerFilter as $f): ?>
          <span class="filter-pill"><?= $f ?></span>
        <?php endforeach; ?>
        <?php foreach ($occasionFilter as $o): ?>
          <span class="filter-pill"><?= $o ?></span>
        <?php endforeach; ?>
        <?php if ($priceFilterActive && $maxPrice): ?>
          <span class="filter-pill">≤ Rp <?= number_format($maxPrice, 0, ',', '.') ?></span>
        <?php endif; ?>
        <a href="shop.php" class="filter-pill filter-pill--clear">✕ Reset</a>
      </div>
      <?php endif; ?>

      <!-- Product grid -->
      <?php if (!$products): ?>
        <div class="empty-state">
          <div class="empty-state__icon">🌿</div>
          <h3>Tidak ada produk ditemukan</h3>
          <p>Coba ubah atau reset filter yang digunakan.</p>
          <a href="shop.php" class="btn-primary">Reset Filter</a>
        </div>
      <?php else: ?>
      <div class="products-grid stagger">
        <?php foreach ($products as $p):
          $img = $p['main_image'] ?: 'img/no-image.png';
        ?>
        <article class="product-card reveal">
          <a href="product_details.php?id=<?= $p['id'] ?>">
            <div class="product-card__img">
              <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy" />
              <?php if (!empty($p['catalog'])): ?>
              <span class="product-card__tag"><?= htmlspecialchars($p['catalog']) ?></span>
              <?php endif; ?>
            </div>
          </a>
          <div class="product-card__body">
            <h3 class="product-card__name"><?= htmlspecialchars($p['name']) ?></h3>
            <p class="product-card__price">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
            <a href="product_details.php?id=<?= $p['id'] ?>">
              <button class="product-card__btn">Beli Sekarang</button>
            </a>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

    </main>
  </div>

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

    /* Sidebar filter toggle (mobile) */
    const filterToggle = document.getElementById('filterToggle');
    const sidebar      = document.getElementById('sidebar');
    filterToggle.addEventListener('click', () => {
      sidebar.classList.toggle('open');
    });

    /* Accordion filter groups */
    document.querySelectorAll('.filter-group__toggle').forEach(btn => {
      btn.addEventListener('click', () => {
        const group = btn.closest('.filter-group');
        const body  = group.querySelector('.filter-group__body');
        const isOpen = group.classList.contains('open');

        // Close all
        document.querySelectorAll('.filter-group').forEach(g => {
          g.classList.remove('open');
          const b = g.querySelector('.filter-group__body');
          if (b) b.style.maxHeight = null;
        });

        // Open clicked if it was closed
        if (!isOpen) {
          group.classList.add('open');
          body.style.maxHeight = body.scrollHeight + 'px';
        }
      });
    });

    /* Price toggle */
    const priceToggle    = document.getElementById('priceToggle');
    const priceInputWrap = document.getElementById('priceInputWrap');
    priceToggle.addEventListener('change', () => {
      priceInputWrap.style.display = priceToggle.checked ? 'flex' : 'none';
    });

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