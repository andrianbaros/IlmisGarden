// =====================
// NAVBAR TOGGLE
// =====================
const navbarNav = document.querySelector(".navbar-nav");

document.querySelector("#menu").onclick = () => {
  navbarNav.classList.toggle("active");
};

const menu = document.querySelector("#menu");

document.addEventListener("click", function (e) {
  if (!menu.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});

// =====================
// =====================
// SLIDESHOW HERO
// =====================
document.addEventListener("DOMContentLoaded", () => {
  let currentSlide = 0;

  const slides = document.querySelectorAll(".slide");
  const heroText = document.getElementById("hero-text");
  const heroBtn = document.getElementById("hero-btn");

  const texts = [
    `Tempat di mana setiap bunga punya cerita.<br>
     Kami merangkai setiap tangkai dengan cinta
     untuk setiap momen spesialmu. 🌷`,

    `Artisan produk berbahan dasar bunga<br>
     berkolaborasi dengan pengrajin lokal
     dan desain berkarakter.`,

     `Sempurnakan perayaan Idul Fitri dengan hampers elegan yang membawa kehangatan dan<br>
      kebersamaan. 🌙✨`,
  ];

  const links = ["about.php", "artisan.php","lebaran.php"];

  // ===== INIT PERTAMA =====
  heroText.innerHTML = texts[0];
  heroBtn.dataset.link = links[0];
  heroText.classList.add("show");

  heroBtn.addEventListener("click", () => {
    window.location.href = heroBtn.dataset.link;
  });

  function changeSlide() {
    // slide visual
    slides[currentSlide].classList.remove("active");
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add("active");

    // text anim
    heroText.classList.remove("show");

    setTimeout(() => {
      heroText.innerHTML = texts[currentSlide];
      heroBtn.dataset.link = links[currentSlide];

      // 🔥 PENTING: PAKSA repaint
      void heroText.offsetWidth;

      heroText.classList.add("show");
    }, 300);
  }

  setInterval(changeSlide, 4000);
});
