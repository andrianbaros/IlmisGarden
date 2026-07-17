<?php
session_start();

// Unset admin-specific session variables
unset($_SESSION['admin_id']);
unset($_SESSION['admin_username']);
unset($_SESSION['admin_email']);
unset($_SESSION['is_admin']);

header("Location: login_admin.php");
exit;
