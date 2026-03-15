let count = 0;
const hearts = document.querySelectorAll(".heart");
const progress = document.getElementById("progress");

hearts.forEach(heart => {
  heart.addEventListener("click", () => {
    if (heart.classList.contains("pop")) return;

    heart.classList.add("pop");
    count++;
    progress.innerText = `💞 ${count} / 3`;

    if (count === 3) {
      setTimeout(() => {
        document.getElementById("game-screen").classList.add("hidden");
        document.getElementById("letter-screen").classList.remove("hidden");
        startTyping();
      }, 600);
    }
  });
});

/* typing effect */
function startTyping() {
  const el = document.getElementById("typing");
  const text = el.dataset.text;
  let index = 0;
  el.textContent = "";

  function typeEffect() {
    if (index < text.length) {
      el.textContent += text.charAt(index);
      index++;
      setTimeout(typeEffect, 80);
    }
  }
  typeEffect();
}
