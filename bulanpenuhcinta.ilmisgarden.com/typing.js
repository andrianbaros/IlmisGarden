const el = document.querySelector(".typing");
const text = el.getAttribute("data-text");

let index = 0;
el.innerHTML = "";

function typeEffect() {
  if (index < text.length) {
    el.innerHTML += text.charAt(index);
    index++;
    setTimeout(typeEffect, 70);
  }
}

typeEffect();
