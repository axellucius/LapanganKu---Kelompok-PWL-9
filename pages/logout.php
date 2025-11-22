
<?php
session_start();

$user_name = $_SESSION['user_name'] ?? 'User';

session_unset();
session_destroy();

echo "<script>
    alert('👋 Goodbye, " . htmlspecialchars($user_name) . "! Anda telah berhasil logout.');
    window.location.href = 'homepage.php';
</script>";
exit;
?>