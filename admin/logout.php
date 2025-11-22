<?php
session_start();

// Hapus semua session admin
unset($_SESSION['admin_id']);
unset($_SESSION['admin_nama']);
unset($_SESSION['admin_username']);

// Destroy session
session_destroy();

// Redirect ke login
header('Location: login.php');
exit;
?>