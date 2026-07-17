// =====================
// HERO SLIDESHOW FINAL (DYNAMIC)
// =====================
document.addEventListener("DOMContentLoaded", () => {
  let currentSlide = 0;

  const slides = document.querySelectorAll(".hero__slide");
  const heroText = document.getElementById("hero-text");
  const heroBtn = document.getElementById("hero-btn");
  const heroTitle = document.getElementById("hero-title");
  const dots = document.querySelectorAll(".hero__dot");

  if (!heroText || !heroBtn || !heroTitle || slides.length === 0) {
    return;
  }

  function updateContent(index) {
    const slide = slides[index];
    if (slide) {
      heroText.innerHTML = slide.getAttribute("data-text") || "";
      heroTitle.innerHTML = slide.getAttribute("data-title") || "";
      heroBtn.innerText = slide.getAttribute("data-btn") || "";
      heroBtn.href = slide.getAttribute("data-link") || "#";
    }
  }

  // INIT
  updateContent(0);
  heroText.classList.add("show");

  function changeSlide(index = null) {
    if (slides.length <= 1) return;
    
    slides[currentSlide].classList.remove("active");
    if (dots[currentSlide]) {
      dots[currentSlide].classList.remove("active");
    }

    currentSlide = index !== null ? index : (currentSlide + 1) % slides.length;

    slides[currentSlide].classList.add("active");
    if (dots[currentSlide]) {
      dots[currentSlide].classList.add("active");
    }

    heroText.classList.remove("show");

    setTimeout(() => {
      updateContent(currentSlide);
      heroText.classList.add("show");
    }, 300);
  }

  if (slides.length > 1) {
    let interval = setInterval(changeSlide, 4000);

    dots.forEach((dot) => {
      dot.addEventListener("click", () => {
        clearInterval(interval);
        changeSlide(parseInt(dot.dataset.slide));
        interval = setInterval(changeSlide, 4000);
      });
    });
  }
});

// =====================
// MOBILE MENU TOGGLE
// =====================
document.addEventListener("DOMContentLoaded", () => {
  const hamburger = document.getElementById("hamburger");
  const mobileMenu = document.getElementById("mobileMenu");
  const mobileClose = document.getElementById("mobileClose");

  if (hamburger && mobileMenu) {
    hamburger.addEventListener("click", () => {
      mobileMenu.classList.toggle("open");
    });
  }

  if (mobileClose && mobileMenu) {
    mobileClose.addEventListener("click", () => {
      mobileMenu.classList.remove("open");
    });
  }

  // Close when clicking any link inside mobile menu
  document.querySelectorAll("#mobileMenu a").forEach(link => {
    link.addEventListener("click", () => {
      if (mobileMenu) {
        mobileMenu.classList.remove("open");
      }
    });
  });

  // Close when clicking outside mobile menu and hamburger
  document.addEventListener("click", (e) => {
    if (mobileMenu && hamburger) {
      if (
        !mobileMenu.contains(e.target) &&
        !hamburger.contains(e.target)
      ) {
        mobileMenu.classList.remove("open");
      }
    }
  });
});

