<?php
/**
 * Single Source of Truth for Ilmis Garden Navbar
 * Included by all storefront PHP pages.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!-- MOBILE MENU -->
<nav class="mobile-menu" id="mobileMenu">
  <button class="mobile-menu__close" id="mobileClose">✕</button>
  <a href="<?= BASE_URL ?>/product" class="<?= $current_page === 'product' ? 'active' : '' ?>">Product</a>
  <a href="<?= BASE_URL ?>/shop" class="<?= $current_page === 'shop' ? 'active' : '' ?>">Catalog</a>
  <a href="<?= BASE_URL ?>/about" class="<?= $current_page === 'about' ? 'active' : '' ?>">About Us</a>
</nav>

<!-- NAVBAR -->
<header class="nav" id="navbar">
  <a href="<?= BASE_URL ?>/" class="nav__logo">
    <img src="<?= BASE_URL ?>/img/F4F6F4-full.png" alt="Ilmis Garden Logo" loading="lazy" decoding="async" />
  </a>

  <ul class="nav__links">
    <li><a href="<?= BASE_URL ?>/product" class="<?= $current_page === 'product' ? 'active' : '' ?>">Product</a></li>
    <li><a href="<?= BASE_URL ?>/shop" class="<?= $current_page === 'shop' ? 'active' : '' ?>">Catalog</a></li>
    <li><a href="<?= BASE_URL ?>/about" class="<?= $current_page === 'about' ? 'active' : '' ?>">About Us</a></li>
  </ul>

  <div class="nav__actions">
    <?php if (isset($_SESSION['id_user']) && isset($_SESSION['username'])): ?>
      <span class="nav__user-greeting">Halo, <?= htmlspecialchars($_SESSION['username']) ?></span>
    <?php endif; ?>
    <a href="<?= BASE_URL ?>/cart" class="nav__icon <?= $current_page === 'cart' ? 'active' : '' ?>" aria-label="Cart">
      <svg viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
    </a>
    <a href="<?= BASE_URL ?>/profile" class="nav__icon <?= in_array($current_page, ['profile', 'transaction']) ? 'active' : '' ?>" aria-label="Profile">
      <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </a>
    <button class="nav__hamburger" id="hamburger" aria-label="Menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
