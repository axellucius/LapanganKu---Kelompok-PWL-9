<?php
session_start();
require_once '../config/db-connection.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "<script>
        alert('⚠️ Silakan login terlebih dahulu!');
        window.location.href = 'sign-in.php';
    </script>";
    exit;
}

// Ambil data user dari database
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Hitung statistik user
$total_pemesanan = $conn->query("SELECT COUNT(*) as total FROM pemesanan WHERE user_id = $user_id")->fetch_assoc()['total'];
$total_pembayaran = $conn->query("SELECT COUNT(*) as total FROM pembayaran pb JOIN pemesanan pm ON pb.id_pemesanan = pm.id_pemesanan WHERE pm.user_id = $user_id AND pb.status = 'success'")->fetch_assoc()['total'];
$total_spending = $conn->query("SELECT SUM(pb.jumlah) as total FROM pembayaran pb JOIN pemesanan pm ON pb.id_pemesanan = pm.id_pemesanan WHERE pm.user_id = $user_id AND pb.status = 'success'")->fetch_assoc()['total'] ?? 0;

// Hitung rating (rata-rata dari total booking yang success)
$rating = $total_pembayaran > 0 ? min(5.0, 4.0 + ($total_pembayaran * 0.1)) : 0;
$rating = number_format($rating, 1);

// Format tanggal bergabung
$joined_date = new DateTime($user['created_at']);
$now = new DateTime();
$diff = $now->diff($joined_date);
$months_joined = ($diff->y * 12) + $diff->m;

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile - <?php echo htmlspecialchars($user['name']); ?></title>
  <link rel="stylesheet" href="../style/Styleprofilpage.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="sidebar">
    <h1>LapanganKu</h1>

    <div class="menu">
      <a href="#" class="item active">
        <span class="icon">🛡️</span>
        <span>Profile</span>
        <span class="arrow">›</span>
      </a>

      <a href="history-pembayaran.php" class="item">
        <span class="icon">📅</span>
        <span>History Pemesanan</span>
        <span class="arrow">›</span>
      </a>

      <a href="homepage.php" class="item">
        <span class="icon">🏠</span>
        <span>Homepage</span>
        <span class="arrow">›</span>
      </a>
      
      <a href="logout.php" class="item logout">
        <span class="icon">🚪</span>
        <span>Logout</span>
        <span class="arrow">›</span>
      </a>
    </div>
  </div>

  <div class="main">
    <div class="header">
      <div class="header-left">
        <h2>MY PROFILE</h2>
      </div>
      <div class="header-right">
        <span class="bell">🔔</span>
        <div class="user">
          <img src="../photos/Bryan.png" class="avatar-mini" id="navAvatar" />
          <div>
            <p class="welcome">Welcome back,</p>
            <p class="name" id="displayName"><?php echo htmlspecialchars($user['name']); ?></p>
          </div>
          <span class="arrow-down">▼</span>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="card-left">
        <div class="photo-section">
          <img src="../photos/Bryan.png" class="avatar" id="profilePhoto" />
          <input type="file" id="photoInput" accept="image/*" hidden />
          <button class="btn-upload" id="uploadBtn">Upload Photo</button>
        </div>

        <div class="form">
          <div class="field">
            <label>Your Name</label>
            <div class="input-wrapper">
              <input type="text" id="inputName" value="<?php echo htmlspecialchars($user['name']); ?>" readonly />
              <span class="edit" data-field="name">Edit</span>
            </div>
          </div>

          <div class="field">
            <label>Email</label>
            <div class="input-wrapper">
              <input type="email" id="inputEmail" value="<?php echo htmlspecialchars($user['email']); ?>" readonly />
              <span class="edit" data-field="email">Edit</span>
            </div>
          </div>

          <div class="field">
            <label>Phone Number</label>
            <div class="input-wrapper">
              <input type="text" id="inputPhone" value="+62 123456789" readonly />
              <span class="edit" data-field="phone">Edit</span>
            </div>
          </div>

          <div class="field">
            <label>Tentang <?php echo htmlspecialchars($user['name']); ?></label>
            <div class="input-wrapper">
              <textarea id="inputAbout" readonly><?php echo htmlspecialchars($user['name']); ?> adalah member LapanganKu yang telah melakukan <?php echo $total_pemesanan; ?> kali pemesanan lapangan.</textarea>
              <span class="edit" data-field="about">Edit</span>
            </div>
          </div>
        </div>

        <div class="status">
          <h3>Status Akun</h3>
          <div class="row">
            <span>Email</span>
            <span class="badge green">Verified</span>
          </div>
          <div class="row">
            <span>Nomor Telepon</span>
            <span class="badge grey">Verify</span>
          </div>
        </div>
      </div>

      <div class="card-right">
        <button class="btn-mydata">My Data</button>

        <div class="section">
          <h3>Kualifikasi</h3>
          <div class="box-kualifikasi">
            <span>Sudah <?php echo $months_joined; ?> bulan aktif member</span>
            <div class="trophy">🏆</div>
          </div>
        </div>

        <div class="section">
          <h3>Olahraga Favorit</h3>
          <div class="tags">
            <span class="tag">Basket</span>
            <span class="tag">Futsal</span>
          </div>
          <div class="tags">
            <span class="tag">Badminton</span>
            <span class="tag">Volleyball</span>
          </div>
        </div>

        <div class="section">
          <h3>Total Pemesanan</h3>
          <div class="box-stat orange">
            <div>
              <div class="number"><?php echo $total_pemesanan; ?></div>
              <div class="text">Booking Lapangan</div>
            </div>
            <div class="icon">⚡</div>
          </div>
        </div>

        <div class="section">
          <h3>Penilaian</h3>
          <div class="box-stat yellow">
            <div>
              <div class="number"><?php echo $rating; ?></div>
              <div class="text">dari <?php echo $total_pembayaran; ?>x booking lapangan</div>
            </div>
            <div class="icon">⭐</div>
          </div>
        </div>
        
        <div class="section">
          <h3>Total Pengeluaran</h3>
          <div class="box-stat green">
            <div>
              <div class="number">Rp <?php echo number_format($total_spending, 0, ',', '.'); ?></div>
              <div class="text">Total transaksi</div>
            </div>
            <div class="icon">💰</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="toast"></div>
  <script>
    // Pass user_id ke JavaScript untuk AJAX update
    const userId = <?php echo $user_id; ?>;
  </script>
  <script src="../script/profile.js"></script>
</body>
</html>
<?php $conn->close(); ?>