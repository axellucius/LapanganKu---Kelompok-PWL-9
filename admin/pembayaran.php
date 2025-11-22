<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$query = "SELECT pb.*, pm.olahraga, pm.lapangan, pm.tanggal, pm.jam_mulai, pm.jam_selesai 
          FROM pembayaran pb 
          JOIN pemesanan pm ON pb.id_pemesanan = pm.id_pemesanan 
          ORDER BY pb.tanggal_pembayaran DESC";
$pembayaran = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pembayaran - Admin LapanganKu</title>
    <link rel="stylesheet" href="../style/admin-dashboard.css">
    <link rel="stylesheet" href="../style/admin-crud.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🏀 LapanganKu</h2>
                <p>Admin Panel</p>
            </div>
            
            <nav class="sidebar-menu">
                <a href="dashboard.php" class="menu-item">
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
                <a href="pembayaran.php" class="menu-item active">
                    <span class="icon">💰</span>
                    <span>Pembayaran</span>
                </a>
                <a href="logout.php" class="menu-item logout">
                    <span class="icon">🚪</span>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>
        
        <main class="main-content">
            <header class="top-bar">
                <h1>Manage Pembayaran</h1>
                <div class="admin-info">
                    <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['admin_nama']); ?></strong></span>
                </div>
            </header>
            
            <div class="content">
                <div class="card">
                    <div class="card-header">
                        <h2>Daftar Pembayaran</h2>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email/HP</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal Main</th>
                                    <th>Metode</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tgl Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $pembayaran->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email_hp']); ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($row['olahraga']); ?><br>
                                        <small><?php echo htmlspecialchars($row['lapangan']); ?></small>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($row['tanggal']); ?><br>
                                        <small><?php echo $row['jam_mulai'] . '-' . $row['jam_selesai']; ?></small>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['metode_pembayaran']); ?></td>
                                    <td><strong>Rp <?php echo number_format($row['jumlah'], 0, ',', '.'); ?></strong></td>
                                    <td>
                                        <span class="badge badge-<?php echo $row['status']; ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d M Y H:i', strtotime($row['tanggal_pembayaran'])); ?></td>
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