<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ilmis Garden | Artisan Product</title>
  <link rel="icon" href="img/F4F6F4-full.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/about.css" />
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar">
    <a href="index.php" class="navbar-logo">
      <img src="img/F4F6F4-full.png" alt="Logo" style="width: 200px; height: auto;" />
    </a>

    <div class="navbar-nav">
      <a href="product.php">Product</a>
      <a href="shop.php">Catalog</a>
      <a href="about.php" class="active">About Us</a>
    </div>

    <div class="navbar-extra">
      <a href="cart.php" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
      <a href="profile.php" id="user"><i data-feather="user"></i></a>
       <a href="#" id="menu-btn">
  <i data-feather="menu"></i>
</a>
    </div>
  </nav>

<section class="about" id="about" style="margin-top:100px;">
  <div class="aboutus-wrapper">

    <!-- TEXT -->
    <div class="aboutus-text">
      <h2>About Ilmisgarden</h2>

      <p>
        Ilmisgarden berawal dari kecintaan terhadap bunga sejak usia muda dan
        tumbuh di lingkungan perkebunan. Kami percaya bahwa bunga adalah simbol
        keindahan, kesuburan, dan kebahagiaan.
      </p>

      <p>
        Melalui rangkaian dan produk berbahan dasar bunga, Ilmisgarden hadir
        untuk menghadirkan pengalaman yang bermakna dan menyentuh emosi di setiap
        momen penting.
      </p>

      <h3>Visi</h3>
      <p>
        Menjadi toko bunga ikonik dengan produk berbahan dasar bunga yang
        berkualitas dan berkarakter.
      </p>

      <h3>Misi</h3>
      <ul>
        <li>Menghadirkan produk bunga berkualitas dan inovatif</li>
        <li>Menciptakan pengalaman berbelanja yang berkesan</li>
        <li>Menerapkan prinsip keberlanjutan</li>
        <li>Membangun komunitas pencinta keindahan bunga</li>
      </ul>
    </div>

    <!-- SLIDER (DI BAWAH TEKS) -->
    <div class="about-slider">

      <div class="about-slider-main">
        <button class="about-prev" onclick="prevAboutImage()">‹</button>

        <img
          id="aboutMainImage"
          src="img/about.png"
          alt="Ilmisgarden Gallery">

        <button class="about-next" onclick="nextAboutImage()">›</button>
      </div>

      <div class="about-thumbnails">
        <img src="img/aboutus1.jpeg" onclick="setAboutImage(0)" class="active">
        <img src="img/aboutus2.jpeg" onclick="setAboutImage(1)">
        <img src="img/aboutus3.jpeg" onclick="setAboutImage(2)">
        <img src="img/aboutus4.jpeg" onclick="setAboutImage(3)">
        <img src="img/fototeam.jpeg" onclick="setAboutImage(4)">
      </div>

    </div>

  </div>
</section>




<section
  style="
    background:#f4f6f4;
    padding:60px 20px;
    color:#283128;
  "
>
  <div
    style="
      max-width:900px;
      margin:0 auto;
      background:#ffffff;
      border-radius:14px;
      box-shadow:0 6px 20px rgba(0,0,0,.08);
      padding:30px 25px;
    "
  >
    <h2 style="text-align:center; margin-bottom:25px;">
      Lokasi & Kontak Ilmisgarden
    </h2>

    <!-- LOKASI -->
    <div style="display:flex; gap:14px; margin-bottom:18px; align-items:flex-start;">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="#708871">
        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5z"/>
      </svg>
      <div>
        <strong>Alamat Studio</strong>
        <p style="margin:4px 0;">
          Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler,<br>
          Kota Bandung, Jawa Barat 40135
        </p>
        <a
          href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7"
          target="_blank"
          style="color:#708871; text-decoration:underline;"
        >
          Lihat di Google Maps
        </a>
      </div>
    </div>

    <hr style="border:none; border-top:1px solid #ddd; margin:20px 0;">

    <!-- KONTAK -->
    <div style="display:grid; grid-template-columns:1fr; gap:16px;">

      <!-- WhatsApp -->
      <div style="display:flex; gap:14px; align-items:center;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#25D366">
          <path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/>
        </svg>
        <div>
          <strong>WhatsApp</strong>
          <p style="margin:4px 0;">+62 857-9507-7194</p>
          <a
            href="https://api.whatsapp.com/send?phone=6285795077194"
            target="_blank"
            style="color:#708871; text-decoration:underline;"
          >
            Chat via WhatsApp
          </a>
        </div>
      </div>

      <!-- Instagram -->
      <div style="display:flex; gap:14px; align-items:center;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#E1306C">
          <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/>
        </svg>
        <div>
          <strong>Instagram</strong>
          <p style="margin:4px 0;">@ilmisgarden</p>
          <a
            href="https://www.instagram.com/ilmisgarden"
            target="_blank"
            style="color:#708871; text-decoration:underline;"
          >
            Kunjungi Instagram
          </a>
        </div>
      </div>

      <!-- TikTok -->
      <div style="display:flex; gap:14px; align-items:center;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#000">
          <path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/>
        </svg>
        <div>
          <strong>TikTok</strong>
          <p style="margin:4px 0;">@ilmisgarden</p>
          <a
            href="https://www.tiktok.com/@ilmisgarden"
            target="_blank"
            style="color:#708871; text-decoration:underline;"
          >
            Lihat di TikTok
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

<footer
  style="
    position:fixed;
    bottom:0;
    left:0;
    width:100%;
    background:#283128;
    color:#d9d9d9;
    text-align:center;
    padding:8px 10px;
    z-index:9999;
    font-size:13px;
  ">

  <!-- Address -->
  <div style="margin-bottom:10px;">
  <a
          href="https://maps.app.goo.gl/rsnJ95JT2Sy38p1W7"
          target="_blank"
          style="color:#d9d9d9;"
        >
    Jl. Raya Golf Dago No.4, Cigadung, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40135
  </a>  <br>
</div>

  <!-- Social Icons -->
  <div style="display:flex; justify-content:center; gap:28px; align-items:center;">

    <!-- WhatsApp -->
    <a href="https://wa.me/6285795077194"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M20.52 3.48A11.78 11.78 0 0 0 12 0C5.38 0 .01 5.38.01 12c0 2.11.55 4.18 1.6 6.01L0 24l6.16-1.61A11.93 11.93 0 0 0 12 24c6.62 0 12-5.38 12-12a11.78 11.78 0 0 0-3.48-8.52z"/>
      </svg>
      <span>WA</span>
    </a>

    <!-- Instagram -->
    <a href="https://www.instagram.com/ilmisgarden/"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7zm5 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm6.5-.9a1.1 1.1 0 1 1-2.2 0 1.1 1.1 0 0 1 2.2 0z"/>
      </svg>
      <span>IG</span>
    </a>

    <!-- TikTok -->
    <a href="https://www.tiktok.com/@ilmisgarden"
       target="_blank"
       style="color:#d9d9d9; text-decoration:none; display:flex; align-items:center; gap:6px;">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="#d9d9d9">
        <path d="M16 0h4a6.5 6.5 0 0 1-4-2v14a5 5 0 1 1-5-5h1v3a2 2 0 1 0 2 2V0z"/>
      </svg>
      <span>TikTok</span>
    </a>

  </div>
</footer>



 <script>feather.replace();

const navbarNav = document.querySelector(".navbar-nav");
const menuBtn = document.querySelector("#menu-btn");

menuBtn.addEventListener("click", function(e){
  e.preventDefault();
  e.stopPropagation();
  navbarNav.classList.toggle("active");
});

document.addEventListener("click", function (e) {
  if (!menuBtn.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

    </script>
<script>
  const aboutImages = [
    "img/aboutus1.jpeg",
    "img/aboutus2.jpeg",
    "img/aboutus3.jpeg",
    "img/aboutus4.jpeg",
    "img/fototeam.jpeg"
  ];

  let aboutIndex = 0;
  const aboutImg = document.getElementById("aboutMainImage");
  const thumbs = document.querySelectorAll(".about-thumbnails img");

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



    <!-- js -->
    <script src="js/script.js"></script>
</body>
</html>
