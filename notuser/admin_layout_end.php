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

  // Live Clock
  const clockEl = document.getElementById('liveClock');
  if (clockEl) {
    const updateClock = () => {
      const now = new Date();
      const day = String(now.getDate()).padStart(2, '0');
      const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      const month = monthNames[now.getMonth()];
      const year = now.getFullYear();
      const hrs = String(now.getHours()).padStart(2, '0');
      const mins = String(now.getMinutes()).padStart(2, '0');
      const secs = String(now.getSeconds()).padStart(2, '0');
      
      clockEl.innerHTML = `<i class='bx bx-time-five' style="font-size: 1.1rem;"></i> ${day} ${month} ${year}, ${hrs}:${mins}:${secs}`;
    };
    
    updateClock(); // Jalankan langsung agar tidak ada jeda 1 detik menggunakan waktu server
    setInterval(updateClock, 1000);
  }
})();
</script>
</body>
</html>
