<?php
/**
 * admin_layout.php — Reusable admin shell (sidebar + topbar)
 *
 * Usage: 
 *   $page_id = 'dashboard'; // 'dashboard' | 'orders' | 'products'
 *   $page_title = 'Dashboard';
 *   include 'admin_layout.php';
 *   // ... page content ...
 *   include 'admin_layout_end.php';
 */

// Determine active page
$page_id    = $page_id    ?? 'dashboard';
$page_title = $page_title ?? 'Dashboard';
$admin_name = $_SESSION['admin_username'] ?? 'Admin';
?>
<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
  <div class="admin-sidebar__logo">
    <img src="../img/F4F6F4-full.png" alt="IlmisGarden" style="max-height: 40px; width: auto; display: block; margin: 0 auto;">
  </div>

  <nav class="admin-sidebar__nav">
    <div class="admin-sidebar__section">Menu</div>

    <a href="dashboard.php" class="admin-sidebar__link <?= $page_id === 'dashboard' ? 'active' : '' ?>">
      <i class='bx bx-grid-alt'></i>
      Dashboard
    </a>

    <a href="admin_transaction.php" class="admin-sidebar__link <?= $page_id === 'orders' ? 'active' : '' ?>">
      <i class='bx bx-receipt'></i>
      Orders
    </a>

    <a href="product.php" class="admin-sidebar__link <?= $page_id === 'products' ? 'active' : '' ?>">
      <i class='bx bx-package'></i>
      Products
    </a>

    <a href="bestseller.php" class="admin-sidebar__link <?= $page_id === 'bestseller' ? 'active' : '' ?>">
      <i class='bx bx-trophy'></i>
      Best Seller
    </a>
  </nav>

  <div class="admin-sidebar__footer">
    <a href="logout_admin.php">
      <i class='bx bx-log-out' style="font-size: 1.2rem;"></i>
      Logout
    </a>
  </div>
</aside>

<!-- Mobile overlay -->
<div class="admin-sidebar-overlay" id="sidebarOverlay"></div>

<!-- Top bar -->
<header class="admin-topbar">
  <div class="admin-topbar__left">
    <button class="admin-topbar__toggle" id="sidebarToggle" type="button" aria-label="Toggle sidebar">
      <i class='bx bx-menu' style="font-size: 1.5rem;"></i>
    </button>
    <span class="admin-topbar__title"><?= htmlspecialchars($page_title) ?></span>
  </div>
  <div class="admin-topbar__right">
    <span class="admin-topbar__badge">
      <i class='bx bx-time-five' style="font-size: 1.1rem;"></i>
      <?= date('d M Y') ?>
    </span>
  </div>
</header>

<!-- Main content -->
<main class="admin-main">
  <div class="admin-content">
