<?php
session_start();
require_once '../config/db-connection.php';

// Query yang benar sesuai nama kolom di database
$query = "SELECT 
    p.id as pembayaran_id,
    p.id_pemesanan,
    pm.olahraga,
    pm.lapangan,
    pm.tanggal,
    pm.jam_mulai,
    pm.jam_selesai,
    CONCAT(pm.jam_mulai, ' - ', pm.jam_selesai) as jam,
    p.metode_pembayaran,
    p.jumlah,
    p.status,
    p.tanggal_pembayaran
FROM pembayaran p
INNER JOIN pemesanan pm ON p.id_pemesanan = pm.id_pemesanan
ORDER BY p.tanggal_pembayaran DESC";

$result = $conn->query($query);
?>  

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LapanganKu - History Pembayaran</title>
  <link rel="stylesheet" href="../style/history-pembayaran.css">
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

  <main>
    <h2 class="judul">History Pembayaran</h2>
    <div class="keterangan">
      <div class="keterangan-header">
        <span>Lapangan Olahraga</span>
        <span>Metode Pembayaran</span>
        <p>Harga</p>
        <span>Status</span>
      </div>

      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <div class="card-item">
            <div class="lapangan">
              <?php 
              // Mapping gambar berdasarkan olahraga
              $img_map = [
                'Badminton' => '../photos/dpnkwabotttfihp7gf3r.jpg',
                'Basket' => '../photos/pngtree-playground-basketball-hoop-afternoon-basketball-hoop-school-no-photography-picture-with-image_824923.jpg',
                'Futsal' => '../photos/Lap Futsal.png'
              ];
              $img_src = $img_map[$row['olahraga']] ?? '../photos/dpnkwabotttfihp7gf3r.jpg';
              ?>
              <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($row['olahraga']); ?>">
              <div class="lapangan-info">
                <h3>Lapangan <?php echo htmlspecialchars($row['olahraga']); ?></h3>
                <p><strong><?php echo htmlspecialchars($row['lapangan']); ?></strong></p>
                <p>📅 <?php echo htmlspecialchars($row['tanggal']); ?></p>
                <p>🕒 <?php echo htmlspecialchars($row['jam']); ?></p>
              </div>
            </div>
            <div class="metode"><?php echo htmlspecialchars($row['metode_pembayaran']); ?></div>
            <div class="harga">Rp <?php echo number_format($row['jumlah'], 0, ',', '.'); ?></div>
            <div class="status <?php echo $row['status'] === 'success' ? 'success' : ($row['status'] === 'pending' ? 'waiting' : 'failed'); ?>">
              <?php 
              echo $row['status'] === 'success' ? '✅ Success' : ($row['status'] === 'pending' ? '⏳ Waiting' : '❌ Failed'); 
              ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="empty-state">
          <div style="font-size: 80px; margin-bottom: 20px;">📋</div>
          <h3>Belum Ada Riwayat Pembayaran</h3>
          <p>Anda belum melakukan pemesanan. Yuk pesan lapangan sekarang!</p>
          <a href="pemesanan.php" class="btn-pesan">🏀 Pesan Lapangan</a>
        </div>
      <?php endif; ?>

      <?php $conn->close(); ?>
    </div>
  </main>

  <footer>
    <div class="footer-container">
      <div class="footer-box">
        <h3>LapanganKu</h3>
        <p>Sistem pemesanan lapangan olahraga terbaik di Indonesia</p>
        <p><b>Layanan Konsumen</b><br>
         <div class="Email">📧 E-mail: LapanganKu@gmail.com</div>
         <br>
         <div class="Telpon">📞 Telepon : 098-2098731</div>
      </div>

      <div class="footer-box">
        <h4>LAYANAN</h4>
        <ul>
          <li><a href="#">Bantuan</a></li>
          <li><a href="#">Cara Pemesanan</a></li>
          <li><a href="#">Ketersediaan Lapangan</a></li>
          <li><a href="#">Promo Lapangan</a></li>
          <li><a href="#">Konfirmasi Pesanan</a></li>
        </ul>
      </div>

      <div class="footer-box">
        <h4>INFORMASI</h4>
        <ul>
          <li><a href="#">Lokasi</a></li>
          <li><a href="#">Lapangan</a></li>
          <li><a href="#">Harga Sewa</a></li>
          <li><a href="history-pembayaran.php">Histori Pemesanan</a></li>
          <li><a href="#">Konfirmasi Pesanan</a></li>
        </ul>
      </div>

      <div class="footer-box lokasi"></div>
    </div>
  </footer>
</body>
</html>