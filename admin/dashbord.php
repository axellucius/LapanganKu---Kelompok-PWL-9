<?php
session_start();
require_once '../config/db-connection.php';

// Cek login admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Ambil statistik
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_pemesanan = $conn->query("SELECT COUNT(*) as total FROM pemesanan")->fetch_assoc()['total'];
$total_pembayaran = $conn->query("SELECT SUM(jumlah) as total FROM pembayaran WHERE status = 'success'")->fetch_assoc()['total'];
$pemesanan_pending = $conn->query("SELECT COUNT(*) as total FROM pemesanan WHERE status = 'pending'")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - LapanganKu</title>
    <link rel="stylesheet" href="../style/admin-dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🏀 LapanganKu</h2>
                <p>Admin Panel</p>
            </div>
            
            <nav class="sidebar-menu">
                <a href="dashboard.php" class="menu-item active">
                    <span class="icon">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="users.php" class="menu-item">
                    <span class="icon">👥</span>
                    <span>Users</span>
                </a>
                <a href="pemesanan.php" class="menu-item">
                    <span class="icon">📅</span>
                    <span>Pemesanan</span>
                </a>
                <a href="pembayaran.php" class="menu-item">
                    <span class="icon">💰</span>
                    <span>Pembayaran</span>
                </a>
                <a href="logout.php" class="menu-item logout">
                    <span class="icon">🚪</span>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="top-bar">
                <h1>Dashboard</h1>
                <div class="admin-info">
                    <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['admin_nama']); ?></strong></span>
                </div>
            </header>
            
            <div class="content">
                <!-- Statistics Cards -->
                <div class="stats-grid">
                    <div class="stat-card blue">
                        <div class="stat-icon">👥</div>
                        <div class="stat-info">
                            <h3><?php echo $total_users; ?></h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    
                    <div class="stat-card green">
                        <div class="stat-icon">📅</div>
                        <div class="stat-info">
                            <h3><?php echo $total_pemesanan; ?></h3>
                            <p>Total Pemesanan</p>
                        </div>
                    </div>
                    
                    <div class="stat-card orange">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-info">
                            <h3><?php echo $pemesanan_pending; ?></h3>
                            <p>Pemesanan Pending</p>
                        </div>
                    </div>
                    
                    <div class="stat-card purple">
                        <div class="stat-icon">💰</div>
                        <div class="stat-info">
                            <h3>Rp <?php echo number_format($total_pembayaran ?? 0, 0, ',', '.'); ?></h3>
                            <p>Total Pendapatan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Pemesanan -->
                <div class="card">
                    <h2>Pemesanan Terbaru</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Olahraga</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $recent = $conn->query("SELECT * FROM pemesanan ORDER BY created_at DESC LIMIT 5");
                                while ($row = $recent->fetch_assoc()):
                                ?>
                                <tr>
                                    <td><?php echo $row['id_pemesanan']; ?></td>
                                    <td><?php echo htmlspecialchars($row['olahraga']); ?></td>
                                    <td><?php echo htmlspecialchars($row['lapangan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                    <td><?php echo $row['jam_mulai'] . ' - ' . $row['jam_selesai']; ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo $row['status']; ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>