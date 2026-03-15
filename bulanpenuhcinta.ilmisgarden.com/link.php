<?php
$token = $_GET['token'];
$link = "https://bulanpenuhcinta.ilmisgarden.com/view.php?c=$token";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Confession Link 💖</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <h1>💌 Confession Siap Dikirim!</h1>

  <p style="text-align:center;">
    Kirim link ini ke penerima kamu 💕
  </p>

  <input type="text" value="<?= $link ?>" readonly
    style="text-align:center; font-weight:bold;">

  <button onclick="navigator.clipboard.writeText('<?= $link ?>')">
    📋 Copy Link
  </button>

  <p style="text-align:center; margin-top:15px;">
    Semoga dia tersenyum pas baca 💖
  </p>
</div>

</body>
</html>
