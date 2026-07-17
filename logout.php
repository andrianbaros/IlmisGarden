<?php
require 'conn/db.php';
unset($_SESSION['id_user']);
unset($_SESSION['username']);
header("Location: " . BASE_URL . "/");
exit;
