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
// SLIDESHOW + CHANGE TEXT (fade + slide)
// =====================
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const totalSlides = slides.length;

const heroText = document.getElementById("hero-text");

// Teks untuk setiap slide
const texts = [
  "tempat di mana setiap bunga punya cerita. Kami merangkai setiap tangkai dengan cinta, menghadirkan keindahan alami untuk setiap momen spesialmu. Dari buket penuh makna, hampers bunga elegan, hingga dekorasi ruangan yang menenangkan — semua kami buat dengan sentuhan hati.🌷",

  "Artisan produk-produk fungsional berbahan dasar bunga berkolaborasi dengan pengrajin lokal."
];

function changeSlide() {
  // Ganti slide
  slides[currentSlide].classList.remove("active");
  currentSlide = (currentSlide + 1) % totalSlides;
  slides[currentSlide].classList.add("active");

  // Fade + slide-out
  heroText.classList.remove("show");

  setTimeout(() => {
    heroText.textContent = texts[currentSlide];

    // Fade + slide-in
    heroText.classList.add("show");
  }, 200);
}

setInterval(changeSlide, 4000);

// Tampilkan teks awal
heroText.classList.add("show");
