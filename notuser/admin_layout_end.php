  </div><!-- /.admin-content -->
</main>

<script>
// Sidebar toggle for mobile
(function() {
  const sidebar = document.getElementById('adminSidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const toggle  = document.getElementById('sidebarToggle');

  if (toggle) {
    toggle.addEventListener('click', function() {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('active');
    });
  }

  if (overlay) {
    overlay.addEventListener('click', function() {
      sidebar.classList.remove('open');
      overlay.classList.remove('active');
    });
  }
})();
</script>
</body>
</html>
