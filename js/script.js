// =====================
// HERO SLIDESHOW FINAL
// =====================
document.addEventListener("DOMContentLoaded", () => {
  let currentSlide = 0;

  const slides = document.querySelectorAll(".hero__slide");
  const heroText = document.getElementById("hero-text");
  const heroBtn = document.getElementById("hero-btn");
  const heroTitle = document.getElementById("hero-title");
  const dots = document.querySelectorAll(".hero__dot");

  if (!heroText || !heroBtn || !heroTitle) {
    console.error("Hero element tidak ditemukan!");
    return;
  }

  const texts = [
    `Tempat di mana setiap bunga punya cerita.<br>
     Kami merangkai setiap tangkai dengan cinta
     untuk setiap momen spesialmu. 🌷`,

    `Artisan produk berbahan dasar bunga<br>
     berkolaborasi dengan pengrajin lokal
     dan desain berkarakter.`,

    `Sempurnakan perayaan Idul Fitri dengan hampers elegan<br>
     yang membawa kehangatan dan kebersamaan. 🌙✨`,
  ];

  const titles = [
    "Selamat datang di<br><em>Ilmisgarden</em>",
    "Produk Artisan<br><em>Eksklusif</em>",
    "Eid Collection<br><em>Special</em>",
  ];

  const links = ["product.php", "artisan.php", "lebaran.php"];

  const btnTexts = [
    "Lihat Produk →",
    "Lihat Artisan →",
    "Lihat Koleksi Lebaran →",
  ];

  function updateContent(index) {
    heroText.innerHTML = texts[index];
    heroTitle.innerHTML = titles[index];
    heroBtn.innerText = btnTexts[index];
    heroBtn.href = links[index];
  }

  // INIT
  updateContent(0);
  heroText.classList.add("show");

  function changeSlide(index = null) {
    slides[currentSlide].classList.remove("active");
    dots[currentSlide].classList.remove("active");

    currentSlide = index !== null ? index : (currentSlide + 1) % slides.length;

    slides[currentSlide].classList.add("active");
    dots[currentSlide].classList.add("active");

    heroText.classList.remove("show");

    setTimeout(() => {
      updateContent(currentSlide);
      heroText.classList.add("show");
    }, 300);
  }

  let interval = setInterval(changeSlide, 4000);

  dots.forEach((dot) => {
    dot.addEventListener("click", () => {
      clearInterval(interval);
      changeSlide(parseInt(dot.dataset.slide));
      interval = setInterval(changeSlide, 4000);
    });
  });
});
