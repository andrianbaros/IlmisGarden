<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>IlmisGarden — About Us</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/about.css" />
</head>
<body>


<!-- MOBILE MENU -->
<nav class="mobile-menu" id="mobileMenu">
  <button class="mobile-menu__close" id="mobileClose">✕</button>
  <a href="product.php">Product</a>
  <a href="shop.php">Catalog</a>
  <a href="about.php" class="active">About Us</a>
</nav>

<!-- NAVBAR -->
<header class="nav" id="navbar">
  <a href="index.php" class="nav__logo">
    <img src="img/F4F6F4-full.png" alt="Ilmisgarden" />
  </a>

  <ul class="nav__links">
    <li><a href="product.php" >Product</a></li>
    <li><a href="shop.php">Catalog</a></li>
    <li><a href="about.php" class="active">About Us</a></li>
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


  <!-- ─── PAGE HERO ─────────────────────────────────────── -->
  <div class="page-hero">
    <div class="page-hero__content reveal">
      <p class="section__label">Mengenal Kami</p>
      <h1 class="page-hero__title">About <em>Ilmisgarden</em></h1>
    </div>
  </div>

  <!-- ─── ABOUT SPLIT ───────────────────────────────────── -->
  <section class="section about-section">
    <div class="about-split">

      <!-- Text side -->
      <div class="about-split__text reveal">
        <p class="section__label">Cerita Kami</p>
        <h2 class="about-split__heading">Berawal dari <em>Kecintaan</em><br>terhadap Bunga</h2>

        <p>Ilmisgarden berawal dari kecintaan terhadap bunga sejak usia muda dan tumbuh di lingkungan perkebunan. Kami percaya bahwa bunga adalah simbol keindahan, kesuburan, dan kebahagiaan.</p>
        <p>Melalui rangkaian dan produk berbahan dasar bunga, Ilmisgarden hadir untuk menghadirkan pengalaman yang bermakna dan menyentuh emosi di setiap momen penting.</p>

        <div class="about-visi-misi">
          <div class="visi-misi-card reveal">
            <div class="visi-misi-card__icon">
              <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <div>
              <h3>Visi</h3>
              <p>Menjadi toko bunga ikonik dengan produk berbahan dasar bunga yang berkualitas dan berkarakter.</p>
            </div>
          </div>

          <div class="visi-misi-card reveal">
            <div class="visi-misi-card__icon">
              <svg viewBox="0 0 24 24"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            </div>
            <div>
              <h3>Misi</h3>
              <ul>
                <li>Menghadirkan produk bunga berkualitas dan inovatif</li>
                <li>Menciptakan pengalaman berbelanja yang berkesan</li>
                <li>Menerapkan prinsip keberlanjutan</li>
                <li>Membangun komunitas pencinta keindahan bunga</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Slider side -->
      <div class="about-split__slider reveal">
        <div class="about-slider-main">
          <button class="about-prev" onclick="prevAboutImage()">‹</button>
          <img id="aboutMainImage" src="img/aboutus1.jpeg" alt="Ilmisgarden Gallery" />
          <button class="about-next" onclick="nextAboutImage()">›</button>
        </div>
        <div class="about-thumbnails">
          <img src="img/aboutus1.jpeg" onclick="setAboutImage(0)" class="active" alt="" />
          <img src="img/aboutus2.jpeg" onclick="setAboutImage(1)" alt="" />
          <img src="img/aboutus3.jpeg" onclick="setAboutImage(2)" alt="" />
          <img src="img/aboutus4.jpeg" onclick="setAboutImage(3)" alt="" />
          <img src="img/fototeam.jpeg" onclick="setAboutImage(4)" alt="" />
        </div>
      </div>

    </div>
  </section>

  <!-- ─── CONTACT SECTION ───────────────────────────────── -->
  <section id="contact" class="section section--warm contact-section">
    <div class="section__header reveal" style="justify-content:center; text-align:center;">
      <div>
        <p class="section__label">Hubungi Kami</p>
        <h2 class="section__title">Lokasi &amp; <em>Kontak</em></h2>
      </div>
    </div>

    <div class="contact-grid reveal">

      <!-- Address -->
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        </div>
        <div class="contact-card__body">
          <h3>Alamat Studio</h3>
          <p>Jl. Raya Golf Dago No.4, Cigadung,<br>Kec. Cibeunying Kaler,<br>Kota Bandung, Jawa Barat 40135</p>
          <a href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7" target="_blank" class="contact-link">Lihat di Google Maps →</a>
        </div>
      </div>

      <!-- WhatsApp -->
      <div class="contact-card">
        <div class="contact-card__icon contact-card__icon--wa">
          <svg viewBox="0 0 24 24"><path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/></svg>
        </div>
        <div class="contact-card__body">
          <h3>WhatsApp</h3>
          <p>+62 857-9507-7194</p>
          <a href="https://api.whatsapp.com/send?phone=6285795077194" target="_blank" class="contact-link">Chat via WhatsApp →</a>
        </div>
      </div>

      <!-- Instagram -->
      <div class="contact-card">
        <div class="contact-card__icon contact-card__icon--ig">
          <svg viewBox="0 0 24 24"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/></svg>
        </div>
        <div class="contact-card__body">
          <h3>Instagram</h3>
          <p>@ilmisgarden</p>
          <a href="https://www.instagram.com/ilmisgarden" target="_blank" class="contact-link">Kunjungi Instagram →</a>
        </div>
      </div>

      <!-- TikTok -->
      <div class="contact-card">
        <div class="contact-card__icon">
          <svg viewBox="0 0 24 24"><path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/></svg>
        </div>
        <div class="contact-card__body">
          <h3>TikTok</h3>
          <p>@ilmisgarden</p>
          <a href="https://www.tiktok.com/@ilmisgarden" target="_blank" class="contact-link">Lihat di TikTok →</a>
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
    /* Navbar scroll */
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 60);
    });

 // ELEMENT
const hamburger = document.getElementById("hamburger");
const mobileMenu = document.getElementById("mobileMenu");
const mobileClose = document.getElementById("mobileClose");

// TOGGLE MENU
hamburger.addEventListener("click", () => {
  mobileMenu.classList.toggle("open");
});

// CLOSE VIA X
mobileClose.addEventListener("click", () => {
  mobileMenu.classList.remove("open");
});

// CLOSE SAAT KLIK LINK
document.querySelectorAll("#mobileMenu a").forEach(link => {
  link.addEventListener("click", () => {
    mobileMenu.classList.remove("open");
  });
});

// CLOSE SAAT KLIK LUAR (SMART)
document.addEventListener("click", (e) => {
  if (
    !mobileMenu.contains(e.target) &&
    !hamburger.contains(e.target)
  ) {
    mobileMenu.classList.remove("open");
  }
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
    /* About slider */
    const aboutImages = [
      "img/aboutus1.jpeg",
      "img/aboutus2.jpeg",
      "img/aboutus3.jpeg",
      "img/aboutus4.jpeg",
      "img/fototeam.jpeg"
    ];
    let aboutIndex = 0;
    const aboutImg = document.getElementById("aboutMainImage");
    const thumbs   = document.querySelectorAll(".about-thumbnails img");

    function updateAboutSlider() {
      aboutImg.style.opacity = 0;
      setTimeout(() => {
        aboutImg.src = aboutImages[aboutIndex];
        aboutImg.style.opacity = 1;
        thumbs.forEach(t => t.classList.remove("active"));
        thumbs[aboutIndex].classList.add("active");
      }, 200);
    }

    function nextAboutImage() {
      aboutIndex = (aboutIndex + 1) % aboutImages.length;
      updateAboutSlider();
    }

    function prevAboutImage() {
      aboutIndex = (aboutIndex - 1 + aboutImages.length) % aboutImages.length;
      updateAboutSlider();
    }

    function setAboutImage(index) {
      aboutIndex = index;
      updateAboutSlider();
      resetAutoSlide();
    }

    let aboutInterval = setInterval(nextAboutImage, 4000);
    function resetAutoSlide() {
      clearInterval(aboutInterval);
      aboutInterval = setInterval(nextAboutImage, 4000);
    }
  </script>
  <script src="js/script.js"></script>
   <a href="#contact" class="floating-about">
  Hubungi Kami
</a>
</body>
</html>