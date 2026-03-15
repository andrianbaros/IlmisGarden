<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Love Confession 💖</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="page">

<div class="container card">
  <h1>💘 Send your love confession</h1>
  <p class="heart">❤️ 💌 💕</p>

  <form action="submit.php" method="POST" autocomplete="off">

    <!-- NAMA PENGIRIM (WAJIB) -->
    <label>Nama Pengirim <span style="color:red">*</span></label>
    <input 
      type="text" 
      name="sender_name"
      required
      placeholder="Masukkan nama kamu"
    >

    <!-- KONTAK PENGIRIM -->
    <label>Kontak Pengirim <span style="color:red">*</span></label>
    <input 
      type="text" 
      name="sender_contact" 
      required 
      placeholder="WhatsApp / Instagram / Email"
    >

    <!-- NAMA PENERIMA -->
    <label>Nama Penerima <span style="color:red">*</span></label>
    <input 
      type="text" 
      name="receiver_name" 
      required 
      placeholder="Nama orang yang kamu suka..."
    >

    <!-- KONTAK PENERIMA -->
    <label>Kontak Penerima <span style="color:red">*</span></label>
    <input 
      type="text" 
      name="receiver_contact" 
      required 
      placeholder="WhatsApp / Instagram / Email"
    >

    <!-- ALASAN -->
    <label>Alasan Mengirim Confess</label>
    <textarea 
      name="reason" 
      placeholder="Kenapa kamu mau confess? (opsional)"
    ></textarea>

    <!-- PESAN -->
    <label>Ucapan Confess 💌 <span style="color:red">*</span></label>
    <textarea 
      name="message" 
      required 
      placeholder="Tulis pesan cintamu di sini..."
    ></textarea>

    <div class="anonim">
      <input type="checkbox" name="is_anonymous" value="1" id="anonim">
      <label for="anonim">Kirim sebagai anonim</label>
    </div>


    <button type="submit">💝 Kirim Confession</button>
  </form>
</div>

</body>
</html>
