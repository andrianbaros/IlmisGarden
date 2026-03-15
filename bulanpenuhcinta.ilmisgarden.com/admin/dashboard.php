<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
  header("Location: login.php");
  exit;
}

include '../db.php';
$sql = "SELECT * FROM confess ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<style>
body {
  margin: 0;
  font-family: Poppins, sans-serif;
  background: linear-gradient(180deg,#4f6f5a,#ee9ca7);
}

.container {
  max-width: 1200px;
  margin: 40px auto;
  background: #fff;
  padding: 25px;
  border-radius: 18px;
  box-shadow: 0 15px 40px rgba(0,0,0,.15);
}

h1 {
  text-align: center;
  margin-bottom: 25px;
}

table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
}

th {
  background: #f3f6f4;
  padding: 10px;
  text-align: left;
}

td {
  padding: 10px;
  vertical-align: top;
}

tr:nth-child(even) {
  background: #fafafa;
}

.small {
  font-size: 12px;
  opacity: .8;
}

.message,
.reason {
  max-width: 240px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  cursor: pointer;
  color: #2f6f4e;
}

.message:hover,
.reason:hover {
  text-decoration: underline;
}

.time {
  font-size: 12px;
  color: #555;
}

.center {
  text-align: center;
}

.btn {
  display: inline-block;
  padding: 6px 12px;
  font-size: 12px;
  border-radius: 20px;
  text-decoration: none;
  background: #6b8f71;
  color: #fff;
}

.btn:hover {
  opacity: .85;
}

input[type="checkbox"] {
  transform: scale(1.2);
}

@media (max-width: 768px) {
  table {
    font-size: 12px;
  }
  .message,
  .reason {
    max-width: 160px;
  }
}

/* MODAL */
.modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.6);
  z-index: 999;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.modal-box {
  background: #fff;
  max-width: 500px;
  width: 100%;
  padding: 20px;
  border-radius: 16px;
  animation: fadeUp .25s ease;
}

.modal-box h3 {
  margin-top: 0;
}

.modal-box p {
  white-space: pre-wrap;
  line-height: 1.6;
}

.close {
  text-align: right;
  margin-top: 15px;
}

.close button {
  padding: 6px 14px;
  border: none;
  border-radius: 20px;
  background: #6b8f71;
  color: #fff;
  cursor: pointer;
}

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
</head>

<body>

<div class="container">
<h1>📊 Dashboard Admin</h1>

<table>
<tr>
  <th>Pengirim</th>
  <th>Kontak Pengirim</th>
  <th>Penerima</th>
  <th>Kontak Penerima</th>
  <th class="center">Anonim</th>
  <th>Alasan</th>
  <th>Pesan</th>
  <th>Waktu</th>
  <th class="center">Aksi</th>
</tr>

<?php while ($row = $result->fetch_assoc()) { ?>
<tr>
  <td><?= htmlspecialchars($row['sender_name']) ?></td>

  <td class="small"><?= htmlspecialchars($row['sender_contact']) ?></td>

  <td><?= htmlspecialchars($row['receiver_name']) ?></td>

  <td class="small"><?= htmlspecialchars($row['receiver_contact']) ?></td>

  <td class="center">
    <input type="checkbox" disabled <?= $row['is_anonymous'] ? 'checked' : '' ?>>
  </td>

  <td class="reason"
    data-title="Alasan"
    data-content="<?= htmlspecialchars($row['reason'] ?: '-', ENT_QUOTES) ?>"
    onclick="openModal(this)">
  <?= htmlspecialchars($row['reason'] ?: '-') ?>
</td>


<td class="message"
    data-title="Pesan"
    data-content="<?= htmlspecialchars($row['message'], ENT_QUOTES) ?>"
    onclick="openModal(this)">
  <?= htmlspecialchars($row['message']) ?>
</td>


  <td class="time">
    <?= date('d M Y H:i', strtotime($row['created_at'])) ?>
  </td>

  <td class="center">
    <?php if (!$row['is_selected']) { ?>
      <a class="btn" href="select.php?id=<?= $row['id'] ?>">⭐ Pilih</a>
    <?php } else { ?>
      <a class="btn" href="../view.php?c=<?= $row['token'] ?>" target="_blank">
        🔗 Lihat
      </a>
    <?php } ?>
  </td>
</tr>
<?php } ?>

</table>
</div>

<!-- MODAL -->
<div class="modal" id="modal">
  <div class="modal-box">
    <h3 id="modalTitle"></h3>
    <p id="modalContent"></p>
    <div class="close">
      <button onclick="closeModal()">Tutup</button>
    </div>
  </div>
</div>

<script>
function openModal(el) {
  document.getElementById('modalTitle').innerText = el.dataset.title;
  document.getElementById('modalContent').innerText = el.dataset.content;
  document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('modal').style.display = 'none';
}

document.getElementById('modal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
</script>


</body>
</html>
