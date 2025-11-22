<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "<script>
        alert('⚠️ Silakan login terlebih dahulu!');
        window.location.href = 'sign-in.php';
    </script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$total_pemesanan = $conn->query("SELECT COUNT(*) as total FROM pemesanan WHERE user_id = $user_id")->fetch_assoc()['total'];
$total_pembayaran = $conn->query("SELECT COUNT(*) as total FROM pembayaran pb JOIN pemesanan pm ON pb.id_pemesanan = pm.id_pemesanan WHERE pm.user_id = $user_id AND pb.status = 'success'")->fetch_assoc()['total'];
$total_spending = $conn->query("SELECT SUM(pb.jumlah) as total FROM pembayaran pb JOIN pemesanan pm ON pb.id_pemesanan = pm.id_pemesanan WHERE pm.user_id = $user_id AND pb.status = 'success'")->fetch_assoc()['total'] ?? 0;

$rating = $total_pembayaran > 0 ? min(5.0, 4.0 + ($total_pembayaran * 0.1)) : 0;
$rating = number_format($rating, 1);

$joined_date = new DateTime($user['created_at']);
$now = new DateTime();
$diff = $now->diff($joined_date);
$months_joined = ($diff->y * 12) + $diff->m;

$stmt->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - <?php echo htmlspecialchars($user['name']); ?></title>
  <link rel="stylesheet" href="../style/profile-page.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-content">
      <div class="logo">🏀 LapanganKu</div>
      <div class="nav-links">
        <a href="homepage.php">Home</a>
        <a href="pemesanan.php">Lapangan</a>
        <a href="about-us.php">About</a>
        <a href="history-pembayaran.php">History</a>
        <div class="user-dropdown">
          <div class="user-info">
            <img src="../photos/Bryan.png" alt="User" class="user-avatar" id="navAvatar">
            <span><?php echo htmlspecialchars($user['name']); ?></span>
            <span>▼</span>
          </div>
          <div class="dropdown-menu">
            <a href="profil-page.php">👤 My Profile</a>
            <a href="history-pembayaran.php">📜 History</a>
            <a href="logout.php">🚪 Logout</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="profile-header">
      <div class="profile-header-content">
        <div class="profile-photo-wrapper">
          <img src="../photos/Bryan.png" alt="Profile" class="profile-photo" id="profilePhoto">
          <div class="upload-overlay" id="uploadBtn">
            <span>📷</span>
          </div>
          <input type="file" id="photoInput" accept="image/*" hidden>
        </div>
        <div class="profile-info-header">
          <h1 class="profile-name"><?php echo htmlspecialchars($user['name']); ?></h1>
          <p class="profile-email">
            📧 <?php echo htmlspecialchars($user['email']); ?>
          </p>
          <div class="profile-stats">
            <div class="stat-item">
              <div class="stat-value"><?php echo $total_pemesanan; ?></div>
              <div class="stat-label">Bookings</div>
            </div>
            <div class="stat-item">
              <div class="stat-value"><?php echo $rating; ?>⭐</div>
              <div class="stat-label">Rating</div>
            </div>
            <div class="stat-item">
              <div class="stat-value"><?php echo $months_joined; ?></div>
              <div class="stat-label">Bulan</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="profile-content">
      <div class="card">
        <h2 class="card-title">
          <span>👤</span>
          Informasi Personal
        </h2>
        
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <div class="input-wrapper">
            <input type="text" class="form-input" id="inputName" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
            <button class="edit-btn" data-field="name">Edit</button>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Email Address</label>
          <div class="input-wrapper">
            <input type="email" class="form-input" id="inputEmail" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
            <button class="edit-btn" data-field="email">Edit</button>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Nomor Telepon</label>
          <div class="input-wrapper">
            <input type="text" class="form-input" id="inputPhone" value="+62 123 456 789" readonly>
            <button class="edit-btn" data-field="phone">Edit</button>
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Bio</label>
          <div class="input-wrapper">
            <textarea class="form-input" id="inputBio" rows="4" readonly>Member aktif LapanganKu sejak <?php echo $months_joined; ?> bulan yang lalu. Sudah melakukan <?php echo $total_pemesanan; ?> kali pemesanan lapangan olahraga.</textarea>
            <button class="edit-btn" data-field="bio" style="top: 1rem;">Edit</button>
          </div>
        </div>

        <h3 class="card-title" style="margin-top: 2rem;">
          <span>✓</span>
          Status Akun
        </h3>
        <div class="form-group">
          <label class="form-label">Verifikasi Email</label>
          <span class="badge verified">✓ Terverifikasi</span>
        </div>
        <div class="form-group">
          <label class="form-label">Verifikasi Nomor Telepon</label>
          <span class="badge pending">⏳ Belum Diverifikasi</span>
        </div>

        <h3 class="card-title" style="margin-top: 2rem;">
          <span>⚽</span>
          Olahraga Favorit
        </h3>
        <div class="tags-container">
          <span class="tag">🏀 Basketball</span>
          <span class="tag">⚽ Futsal</span>
          <span class="tag">🏸 Badminton</span>
          <span class="tag">🏐 Volleyball</span>
        </div>
      </div>

      <!-- Right Column: Statistics -->
      <div>
        <div class="card" style="margin-bottom: 1.5rem;">
          <h2 class="card-title">
            <span>📊</span>
            Statistik Cepat
          </h2>
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-card-info">
                <h3><?php echo $total_pemesanan; ?></h3>
                <p>Total Pemesanan</p>
              </div>
              <div class="stat-card-icon">📅</div>
            </div>
            
            <div class="stat-card orange">
              <div class="stat-card-info">
                <h3><?php echo $total_pembayaran; ?></h3>
                <p>Pemesanan Selesai</p>
              </div>
              <div class="stat-card-icon">✅</div>
            </div>
            
            <div class="stat-card blue">
              <div class="stat-card-info">
                <h3>Rp <?php echo number_format($total_spending, 0, ',', '.'); ?></h3>
                <p>Total Pengeluaran</p>
              </div>
              <div class="stat-card-icon">💰</div>
            </div>
            
            <div class="stat-card yellow">
              <div class="stat-card-info">
                <h3><?php echo $rating; ?> ⭐</h3>
                <p>Rating Anda</p>
              </div>
              <div class="stat-card-icon">🏆</div>
            </div>
          </div>
        </div>

        <div class="card">
          <h2 class="card-title">
            <span>🏆</span>
            Pencapaian
          </h2>
          <div class="achievement-badge">
            <div class="achievement-icon">🏆</div>
            <h3 class="achievement-title">Member Aktif</h3>
            <p class="achievement-desc">
              Sudah <?php echo $months_joined; ?> bulan menjadi member setia LapanganKu!
            </p>
          </div>
          
          <?php if ($total_pemesanan >= 5): ?>
          <div class="achievement-badge">
            <div class="achievement-icon">⭐</div>
            <h3 class="achievement-title">Frequent Booker</h3>
            <p class="achievement-desc">
              Sudah melakukan <?php echo $total_pemesanan; ?> kali pemesanan lapangan
            </p>
          </div>
          <?php endif; ?>

          <?php if ($total_spending >= 500000): ?>
          <div class="achievement-badge">
            <div class="achievement-icon">💎</div>
            <h3 class="achievement-title">VIP Member</h3>
            <p class="achievement-desc">
              Total transaksi mencapai Rp <?php echo number_format($total_spending, 0, ',', '.'); ?>
            </p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Notification -->
  <div class="toast" id="toast">
    <span class="toast-icon" id="toastIcon">✓</span>
    <span class="toast-message" id="toastMessage">Perubahan berhasil disimpan!</span>
  </div>

  <script>
    const userId = <?php echo $user_id; ?>;
  </script>
  <script src="../script/profile-page.js"></script>
</body>
</html>
<?php $conn->close(); ?>