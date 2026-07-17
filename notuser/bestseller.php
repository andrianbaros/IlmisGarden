<?php
session_start();
require '../conn/db.php';

// Pastikan admin login
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: login_admin.php");
    exit;
}

// Handle update bestseller status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_bestsellers'])) {
    $selected_ids = isset($_POST['bestseller_ids']) ? array_map('intval', $_POST['bestseller_ids']) : [];
    
    // Begin transaction
    $pdo->beginTransaction();
    try {
        // Reset all bestsellers
        $pdo->exec("UPDATE products SET is_bestseller = 0");
        
        // Set new bestsellers if any are selected
        if (!empty($selected_ids)) {
            $in_clause = implode(',', $selected_ids);
            $pdo->exec("UPDATE products SET is_bestseller = 1 WHERE id IN ($in_clause)");
        }
        $pdo->commit();
        $msg = "Bestsellers updated successfully!";
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Error updating bestsellers: " . $e->getMessage();
    }
}

// Get search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Retrieve all products with their main image and bestseller status
$sql = "
    SELECT 
        p.id, p.name, p.price, p.is_bestseller,
        (
          SELECT pi.image
          FROM product_images pi
          WHERE pi.product_id = p.id
          ORDER BY pi.is_primary DESC, pi.id ASC
          LIMIT 1
        ) AS main_image
    FROM products p
";

if ($search !== '') {
    $sql .= " WHERE p.name LIKE ? ";
}
$sql .= " ORDER BY p.is_bestseller DESC, p.id DESC";

$stmt = $pdo->prepare($sql);
if ($search !== '') {
    $stmt->execute(["%$search%"]);
} else {
    $stmt->execute();
}
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Best Sellers — IlmisGarden Admin</title>
  <link rel="icon" href="../img/F4F6F4-full.png" />
  <link rel="stylesheet" href="admin_theme.css?v=<?= time() ?>">
  <style>
    .bestseller-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .bestseller-card {
      position: relative;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius-lg);
      overflow: hidden;
      transition: all 0.2s var(--ease);
      padding: 12px;
      cursor: pointer;
      display: flex;
      flex-direction: column;
    }
    .bestseller-card:hover {
      box-shadow: var(--shadow-md);
      border-color: var(--sage);
    }
    .bestseller-card.selected {
      border-color: var(--sage-dark);
      background: rgba(112, 136, 113, 0.05);
      box-shadow: 0 0 0 1px var(--sage-dark);
    }
    .bestseller-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .bestseller-card__title {
      font-size: 0.88rem;
      font-weight: 600;
      color: var(--charcoal);
      margin-bottom: 4px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .bestseller-card__price {
      font-size: 0.82rem;
      font-weight: 700;
      color: var(--sage-dark);
    }
    .bestseller-checkbox {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 20px;
      height: 20px;
      accent-color: var(--sage-dark);
      cursor: pointer;
      z-index: 2;
    }
    .badge-bestseller {
      position: absolute;
      top: 20px;
      right: 20px;
      background: var(--forest);
      color: #white;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.65rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      z-index: 2;
      color: #fff;
    }
    .search-bar {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      max-width: 500px;
    }
    .search-bar input {
      flex-grow: 1;
    }
  </style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php
$page_id = 'bestseller';
$page_title = 'Manage Best Sellers';
include 'admin_layout.php';
?>

<div class="top-bar">
  <h2 style="margin:0;">Manage Best Sellers</h2>
  <p class="small" style="margin-top: 4px; color: var(--muted);">Select the products that you want to display on the storefront homepage under the "Bestsellers" section.</p>
</div>

<?php if (isset($msg)): ?>
  <div style="background: var(--success-bg); color: #15803d; padding: 12px 16px; border-radius: 8px; border: 1px solid rgba(34,197,94,0.15); margin-bottom: 20px; font-size: 0.88rem; font-weight: 500;">
    <?= htmlspecialchars($msg) ?>
  </div>
<?php endif; ?>

<?php if (isset($error)): ?>
  <div style="background: var(--danger-bg); color: var(--danger); padding: 12px 16px; border-radius: 8px; border: 1px solid rgba(239,68,68,0.15); margin-bottom: 20px; font-size: 0.88rem; font-weight: 500;">
    <?= htmlspecialchars($error) ?>
  </div>
<?php endif; ?>

<form method="GET" class="search-bar">
  <input type="text" name="search" placeholder="Search products by name..." value="<?= htmlspecialchars($search) ?>">
  <button type="submit">Search</button>
  <?php if ($search !== ''): ?>
    <a href="bestseller.php" class="btn-cancel" style="display: flex; align-items: center; justify-content: center; height: 100%;">Clear</a>
  <?php endif; ?>
</form>

<form method="POST">
  <div style="display: flex; justify-content: space-between; align-items: center; background: var(--surface-dim); padding: 14px 20px; border-radius: var(--radius-lg); border: 1px solid var(--border);">
    <span style="font-size: 0.88rem; color: var(--muted); font-weight: 550;" id="selectedCount">0 products selected</span>
    <button type="submit" name="update_bestsellers">Save Changes</button>
  </div>

  <div class="bestseller-grid">
    <?php foreach ($products as $p): ?>
      <?php
        $img = $p['main_image'] ? "../".$p['main_image'] : "../img/no-image.png";
      ?>
      <div class="bestseller-card <?= $p['is_bestseller'] ? 'selected' : '' ?>" onclick="toggleCard(this)">
        <input type="checkbox" name="bestseller_ids[]" value="<?= $p['id'] ?>" class="bestseller-checkbox" <?= $p['is_bestseller'] ? 'checked' : '' ?> onclick="event.stopPropagation(); updateCount();">
        
        <?php if ($p['is_bestseller']): ?>
          <span class="badge-bestseller">Best Seller</span>
        <?php endif; ?>
        
        <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
        <div class="bestseller-card__title"><?= htmlspecialchars($p['name']) ?></div>
        <div class="bestseller-card__price">Rp <?= number_format($p['price'], 0, ',', '.') ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</form>

<?php include 'admin_layout_end.php'; ?>

<script>
function toggleCard(card) {
  const checkbox = card.querySelector('.bestseller-checkbox');
  checkbox.checked = !checkbox.checked;
  card.classList.toggle('selected', checkbox.checked);
  updateCount();
}

function updateCount() {
  const checkboxes = document.querySelectorAll('.bestseller-checkbox');
  let count = 0;
  checkboxes.forEach(cb => {
    if (cb.checked) {
      count++;
      cb.closest('.bestseller-card').classList.add('selected');
    } else {
      cb.closest('.bestseller-card').classList.remove('selected');
    }
  });
  document.getElementById('selectedCount').textContent = count + " products selected";
}

// Initial count call
updateCount();
</script>
</body>
</html>
