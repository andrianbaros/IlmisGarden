<?php
require 'conn/db.php';

$user_id = $_SESSION['id_user'] ?? null;

/* ===============================
   VALIDASI ID PRODUK
================================ */
if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "/shop");
    exit;
}

$id = (int)$_GET['id'];

/* ===============================
   GET PRODUCT
================================ */
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan.";
    exit;
}

/* ===============================
   GET PRODUCT IMAGES
================================ */
$stmt = $pdo->prepare(
    "SELECT image FROM product_images
     WHERE product_id = ?
     ORDER BY is_primary DESC, id ASC"
);
$stmt->execute([$id]);
$images = $stmt->fetchAll();

if (!$images) {
    $images = [['image' => 'img/no-image.png']];
}

/* ===============================
   ADD TO CART
================================ */
if (isset($_POST['add_to_cart'])) {
    if (!$user_id) {
        header("Location: " . BASE_URL . "/signin");
        exit;
    }

    $qty = max(1, (int)$_POST['qty']);

    $stmt = $pdo->prepare(
        "SELECT id_cart, qty FROM cart WHERE user_id = ? AND product_id = ?"
    );
    $stmt->execute([$user_id, $id]);
    $cart = $stmt->fetch();

    if ($cart) {
        $pdo->prepare(
            "UPDATE cart SET qty = qty + ? WHERE id_cart = ?"
        )->execute([$qty, $cart['id_cart']]);
    } else {
        $pdo->prepare(
            "INSERT INTO cart (user_id, product_id, qty) VALUES (?, ?, ?)"
        )->execute([$user_id, $id, $qty]);
    }

    header("Location: " . BASE_URL . "/cart");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>

  <title>Product Details | Ilmis Garden</title>
  <meta name="description" content="Detail produk bunga dari Ilmis Garden.">
  <link rel="canonical" href="https://ilmisgarden.com/product_details">
  
  <meta property="og:title" content="Product Details | Ilmis Garden">
  <meta property="og:description" content="Detail produk bunga dari Ilmis Garden.">
  <meta property="og:url" content="https://ilmisgarden.com/product_details">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">
  
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Product Details | Ilmis Garden">
  <meta name="twitter:description" content="Detail produk bunga dari Ilmis Garden.">
  <meta name="twitter:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/detail.css?v=<?= time() ?>" />
</head>
<body>

 

<?php include 'includes/navbar.php'; ?>
  <!-- ─── BREADCRUMB ────────────────────────────────────── -->
  <div class="breadcrumb">
    <a href="<?= BASE_URL ?>">Home</a>
    <span>›</span>
    <a href="<?= BASE_URL ?>/shop">Catalog</a>
    <span>›</span>
    <span><?= htmlspecialchars($product['name']) ?></span>
  </div>

  <!-- ─── PRODUCT DETAIL ────────────────────────────────── -->
  <main class="detail-layout">

    <!-- Gallery -->
    <div class="detail-gallery reveal">
      <div class="gallery-main">
        <img id="mainImage"
             src="<?= htmlspecialchars($images[0]['image']) ?>"
             alt="<?= htmlspecialchars($product['name']) ?>" />
      </div>

      <?php if (count($images) > 1): ?>
      <div class="gallery-thumbs">
        <?php foreach ($images as $i => $img): ?>
        <button class="thumb-btn <?= $i === 0 ? 'active' : '' ?>"
                onclick="setMainImage(this, '<?= htmlspecialchars($img['image']) ?>')">
          <img src="<?= htmlspecialchars($img['image']) ?>"
               alt="Thumbnail <?= $i + 1 ?>" />
        </button>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="detail-info reveal">

      <!-- Tags -->
      <div class="detail-tags">
        <?php if (!empty($product['catalog'])): ?>
          <span class="detail-tag"><?= htmlspecialchars($product['catalog']) ?></span>
        <?php endif; ?>
        <?php if (!empty($product['occasion'])): ?>
          <span class="detail-tag detail-tag--muted"><?= htmlspecialchars($product['occasion']) ?></span>
        <?php endif; ?>
      </div>

      <h1 class="detail-name"><?= htmlspecialchars($product['name']) ?></h1>

      <p class="detail-price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>

      <!-- Add to cart -->
      <form method="POST" class="detail-form">
        <div class="qty-control">
          <button type="button" class="qty-btn" id="qtyMinus" onclick="changeQty(-1)">−</button>
          <input type="number" name="qty" id="qtyInput" value="1" min="1" readonly />
          <button type="button" class="qty-btn" id="qtyPlus" onclick="changeQty(1)">+</button>
        </div>

        <button type="submit" name="add_to_cart" class="btn-cart">
          <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          Tambah ke Keranjang
        </button>

        <a href="https://wa.me/6285795077194?text=Halo, saya tertarik dengan <?= urlencode($product['name']) ?>"
           target="_blank" class="btn-wa">
          <svg viewBox="0 0 24 24"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
          Tanya via WhatsApp
        </a>
      </form>

      <!-- Meta info -->
      <div class="detail-meta">
        <?php if (!empty($product['flower'])): ?>
        <div class="detail-meta__row">
          <span class="detail-meta__label">Bunga</span>
          <span class="detail-meta__value"><?= htmlspecialchars($product['flower']) ?></span>
        </div>
        <?php endif; ?>
        <?php if (!empty($product['occasion'])): ?>
        <div class="detail-meta__row">
          <span class="detail-meta__label">Occasion</span>
          <span class="detail-meta__value"><?= htmlspecialchars($product['occasion']) ?></span>
        </div>
        <?php endif; ?>
      </div>

      <!-- Description -->
      <?php if (!empty($product['description'])): ?>
      <div class="detail-desc">
        <button class="detail-desc__toggle" id="descToggle">
          Deskripsi Produk
          <svg class="toggle-chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <div class="detail-desc__body" id="descBody">
          <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
        </div>
      </div>
      <?php endif; ?>

    </div>
  </main>

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

  <!-- ─── LIGHTBOX MODAL ────────────────────────────────── -->
  <div class="image-lightbox" id="imageLightbox" aria-hidden="true">
    <div class="image-lightbox__content">
      <button class="image-lightbox__close" id="lightboxClose" aria-label="Tutup">&times;</button>
      <img id="lightboxImg" src="" alt="Full View" />
    </div>
  </div>

  <!-- ─── SCRIPTS ───────────────────────────────────────── -->
  <script src="js/script.js?v=<?= time() ?>"></script>
  <script>
    /* Quantity Control Fallback */
    function changeQty(delta) {
      const qtyInput = document.getElementById("qtyInput");
      if (!qtyInput) return;
      let currentVal = parseInt(qtyInput.value, 10) || 1;
      let newVal = currentVal + delta;
      if (newVal < 1) newVal = 1;
      qtyInput.value = newVal;
    }
    window.changeQty = changeQty;

    /* Navbar scroll */
    const navbar = document.getElementById('navbar');
    if (navbar) {
      window.addEventListener('scroll', () => {
        navbar.classList.toggle('scrolled', window.scrollY > 60);
      });
    }

    const observer = new IntersectionObserver(entries => {
      entries.forEach(e => {
        if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
      });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
  </script>
</body>
</html>