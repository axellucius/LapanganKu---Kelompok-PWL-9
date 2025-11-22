<?php
session_start();

if (!isset($_SESSION['pembayaran_sukses']) || $_SESSION['pembayaran_sukses'] !== true) {
    header('Location: homepage.php');
    exit;
}

$detail = $_SESSION['detail_pembayaran'] ?? null;

unset($_SESSION['pembayaran_sukses']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil - LapanganKu</title>
    <link rel="stylesheet" href="../style/transaksi-berhasil.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container header-inner">
            <div class="logo">LapanganKu</div>
            <nav>
                <ul>
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="pemesanan.php">Lapangan</a></li>
                    <li><a href="about-us.php">About us</a></li>
                    <li><a href="profil-page.php" class="btn-profile">Profile</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container1">
        <div class="success-animation">
            <div class="checkmark">✔</div>
        </div>
        
        <h1>Pembayaran Berhasil!</h1>
        <p class="subtitle">Terima kasih atas pembayaran Anda</p>
        
        <?php if ($detail): ?>
        <div class="detail-transaksi">
            <div class="detail-row">
                <span class="label">ID Pembayaran:</span>
                <span class="value">#<?php echo str_pad($detail['id_pembayaran'], 6, '0', STR_PAD_LEFT); ?></span>
            </div>
            <div class="detail-row">
                <span class="label">ID Pemesanan:</span>
                <span class="value">#<?php echo str_pad($detail['id_pemesanan'], 6, '0', STR_PAD_LEFT); ?></span>
            </div>
            <div class="detail-row">
                <span class="label">Nama:</span>
                <span class="value"><?php echo htmlspecialchars($detail['nama']); ?></span>
            </div>
            <div class="detail-row">
                <span class="label">Metode Pembayaran:</span>
                <span class="value"><?php echo htmlspecialchars($detail['metode']); ?></span>
            </div>
            <div class="detail-row total">
                <span class="label">Total Pembayaran:</span>
                <span class="value">Rp <?php echo number_format($detail['jumlah'], 0, ',', '.'); ?></span>
            </div>
        </div>
        <?php endif; ?>
        
        <p class="info-text">
            Email konfirmasi telah dikirim ke <?php echo htmlspecialchars($detail['email'] ?? 'email Anda'); ?>
        </p>
        
        <div class="button-group">
            <a class="button-homepage" href="homepage.php">Kembali ke Homepage</a>
            <a class="button-history" href="history-pembayaran.php">Lihat History</a>
        </div>
    </div>
    
    <script>
        setTimeout(function() {
            if (confirm('Halaman akan kembali ke homepage. Klik OK untuk melanjutkan atau Cancel untuk tetap di halaman ini.')) {
                window.location.href = 'homepage.php';
            }
        }, 30000);
    </script>
</body>
</html>