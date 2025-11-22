<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['id_pemesanan']) || !isset($_SESSION['detail_pemesanan'])) {
    echo "<script>
        alert('⚠️ Silakan lakukan pemesanan terlebih dahulu!');
        window.location.href='pemesanan.php';
    </script>";
    exit;
}

$detail = $_SESSION['detail_pemesanan'];
$id_pemesanan = $_SESSION['id_pemesanan'];

$jam_mulai_int = (int)str_replace('.00', '', $detail['jam_mulai']);
$jam_selesai_int = (int)str_replace('.00', '', $detail['jam_selesai']);
$durasi = $jam_selesai_int - $jam_mulai_int;

$harga_per_jam = 0;
switch($detail['olahraga']) {
    case 'Basket':
        $harga_per_jam = 50000;
        break;
    case 'Futsal':
        $harga_per_jam = 80000;
        break;
    case 'Badminton':
        $harga_per_jam = 40000;
        break;
    default:
        $harga_per_jam = 50000;
}

$harga_total = $harga_per_jam * $durasi;

// Gambar lapangan
$gambar = '';
switch($detail['olahraga']) {
    case 'Badminton':
        $gambar = '../photos/dpnkwabotttfihp7gf3r.jpg';
        break;
    case 'Basket':
        $gambar = '../photos/Lap Basket.png';
        break;
    case 'Futsal':
        $gambar = '../photos/Lap Futsal.png';
        break;
    default:
        $gambar = '../photos/Lap Basket.png';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pembayaran - LapanganKu</title>
    <link rel="stylesheet" href="../style/pembayaran.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="pesanan">
            <h2>Pesanan Anda</h2>
            <div class="detail-pesanan">
                <img src="<?php echo $gambar; ?>" alt="<?php echo htmlspecialchars($detail['olahraga']); ?>" width="150px" height="120px">
                <div class="info-pesanan">
                    <strong>Lapangan <?php echo htmlspecialchars($detail['olahraga']); ?></strong>
                    <div class="info-detail">
                        <p>Lapangan: <?php echo htmlspecialchars($detail['lapangan']); ?></p>
                        <p>Tanggal: <?php echo htmlspecialchars($detail['tanggal']); ?></p>
                        <p>Jam: <?php echo htmlspecialchars($detail['jam_mulai']); ?> - <?php echo htmlspecialchars($detail['jam_selesai']); ?></p>
                        <p>Durasi: <?php echo $durasi; ?> jam</p>
                    </div>
                </div>
                <div class="harga">
                    <div>Rp <?php echo number_format($harga_per_jam, 0, ',', '.'); ?>/jam</div>
                    <div style="font-size: 0.85rem; color: #666;">x <?php echo $durasi; ?> jam</div>
                </div>
            </div>
            <div class="garis-putus"></div>
            <div class="total">
                <strong>Total: Rp <?php echo number_format($harga_total, 0, ',', '.'); ?></strong>
            </div>
        </div>

        <div class="pembayaran">
            <h2>Pembayaran</h2>
            <form id="formPembayaran" method="POST" action="../database/proses-pembayaran.php">
                <input type="hidden" name="id_pemesanan" value="<?php echo $id_pemesanan; ?>">
                <input type="hidden" name="jumlah" value="<?php echo $harga_total; ?>">
                
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required />
                
                <label for="email">Email/No-Hp</label>
                <input type="text" id="email" name="email" placeholder="Masukkan email atau nomor HP" required />
                
                <div class="metode-pembayaran">Metode Pembayaran</div>
                
                <label class="opsi-pembayaran">
                    <input type="radio" name="metode" value="Transfer Bank" required /> Transfer Bank
                </label>
                <label class="opsi-pembayaran">
                    <input type="radio" name="metode" value="E-Wallet" /> E-Wallet
                </label>
                <label class="opsi-pembayaran">
                    <input type="radio" name="metode" value="Virtual Account" /> Virtual Account
                </label>
                <label class="opsi-pembayaran">
                    <input type="radio" name="metode" value="Kartu Debit/Kredit" /> Kartu Debit/Kredit
                </label>
                <label class="opsi-pembayaran">
                    <input type="radio" name="metode" value="Bayar di Tempat" /> Bayar di Tempat
                </label>

                <button type="submit" id="btnBayar">💳 Pay Now</button>
            </form>
        </div>
    </div>
    
    <script src="../script/pembayaran.js"></script>
</body>
</html>