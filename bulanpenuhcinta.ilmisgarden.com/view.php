<?php
include 'db.php';

$token = $_GET['c'];

$sql = "SELECT * FROM confess WHERE token=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  die("Confession tidak ditemukan 💔");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Someone Confessed 💖</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page">

<!-- FLOATING HEART -->
<div class="heart-float" style="left:10%">💖</div>
<div class="heart-float" style="left:30%; animation-delay:1s;">💘</div>
<div class="heart-float" style="left:50%; animation-delay:2s;">💕</div>
<div class="heart-float" style="left:70%; animation-delay:3s;">❤️</div>
<div class="heart-float" style="left:90%; animation-delay:4s;">💗</div>

<!-- ================= MINI GAME ================= -->
<div id="game-screen" class="container card">
  <h1>💘 Match the Love</h1>
  <p style="text-align:center;">
    Samakan semua emoji untuk membuka surat 💌
  </p>

  <!-- INI YANG KURANG -->
  <div id="memory-grid"></div>

  <p id="progress" style="text-align:center;margin-top:20px;">
    💖 0 / 8 pasangan
  </p>
</div>


<!-- ================= LETTER ================= -->
<div id="letter-screen" class="container card hidden">

  <h1 id="typing" data-text="💘 Someone Has a Crush on You!"></h1>

  <p>
    <strong>Dari:</strong>
    <?= $data['is_anonymous'] 
        ? '💌 Seseorang yang mengagumimu' 
        : htmlspecialchars($data['sender_name']) 
    ?>
  </p>


  <?php if ($data['reason']) { ?>
    <p><strong>Alasan:</strong><br>
      <?= nl2br(htmlspecialchars($data['reason'])) ?>
    </p>
  <?php } ?>

  <p><strong>Pesan 💌</strong><br>
    <?= nl2br(htmlspecialchars($data['message'])) ?>
  </p>

  <p style="text-align:center; margin-top:30px;">
    💖 Selamat bulan penuh cinta 💖
  </p>
</div>

<!-- ================= SCRIPT ================= -->
<script>
/* ===== MEMORY GAME CONFIG ===== */
const emojis = ["💖","💖","💘","💘","💕","💕","❤️","❤️","💗","💗","💞","💞","💝","💝","💓","💓"];
let firstCard = null;
let secondCard = null;
let lockBoard = false;
let matchedPairs = 0;

/* shuffle */
emojis.sort(() => 0.5 - Math.random());

const grid = document.getElementById("memory-grid");
const progress = document.getElementById("progress");

/* create cards */
emojis.forEach(emoji => {
  const card = document.createElement("div");
  card.classList.add("card-memory");
  card.dataset.emoji = emoji;
  card.innerText = emoji;

  card.addEventListener("click", () => flipCard(card));
  grid.appendChild(card);
});

function flipCard(card) {
  if (lockBoard || card.classList.contains("open") || card.classList.contains("matched")) return;

  card.classList.add("open");

  if (!firstCard) {
    firstCard = card;
    return;
  }

  secondCard = card;
  checkMatch();
}

function checkMatch() {
  if (firstCard.dataset.emoji === secondCard.dataset.emoji) {
    firstCard.classList.add("matched");
    secondCard.classList.add("matched");
    matchedPairs++;
    progress.innerText = `💖 ${matchedPairs} / 8 pasangan`;
    resetTurn();

    if (matchedPairs === 8) {
      setTimeout(openLetter, 800);
    }
  } else {
    lockBoard = true;
    setTimeout(() => {
      firstCard.classList.remove("open");
      secondCard.classList.remove("open");
      resetTurn();
    }, 700);
  }
}

function resetTurn() {
  [firstCard, secondCard] = [null, null];
  lockBoard = false;
}

/* ===== OPEN LETTER ===== */
function openLetter() {
  document.getElementById("game-screen").classList.add("hidden");
  document.getElementById("letter-screen").classList.remove("hidden");
  startTyping();
}

/* ===== TYPING EFFECT ===== */
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
</script>


</body>


</html>
