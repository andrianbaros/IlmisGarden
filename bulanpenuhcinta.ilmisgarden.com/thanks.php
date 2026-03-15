<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Confession Terkirim 💖</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page">

<!-- OVERLAY -->
<div class="popup-overlay">
  <div class="popup-card">
    <div class="popup-emoji">💖</div>
    <h1>Confession Terkirim</h1>
    <p>Terima kasih, pesanmu sudah masuk 💌</p>
    <p class="small">Admin akan memilih confess paling berkesan ✨</p>

    <button onclick="closePopup()">OK 💕</button>
  </div>
</div>

<script>
function closePopup() {
  const popup = document.querySelector(".popup-overlay");
  popup.classList.add("hide");

  // redirect setelah animasi selesai
  setTimeout(() => {
    window.location.href = "index.php";
  }, 500);
}
</script>


</body>
</html>
