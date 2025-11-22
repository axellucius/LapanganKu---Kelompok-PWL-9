<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM pemesanan WHERE id_pemesanan = $id");
    header('Location: pemesanan.php?msg=deleted');
    exit;
}

// Handle Status Update
if (isset($_GET['update_status'])) {
    $id = intval($_GET['update_status']);
    $status = $_GET['status'];
    $conn->query("UPDATE pemesanan SET status = '$status' WHERE id_pemesanan = $id");
    header('Location: pemesanan.php?msg=updated');
    exit;
}

// Get all pemesanan with user info
$query = "SELECT p.*, u.name as user_name, u.email as user_email 
          FROM pemesanan p 
          LEFT JOIN users u ON p.user_id = u.id 
          ORDER BY p.created_at DESC";
$pemesanan = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pemesanan - Admin LapanganKu</title>
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
                <a href="pemesanan.php" class="menu-item active">
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
        
        <main class="main-content">
            <header class="top-bar">
                <h1>Manage Pemesanan</h1>
                <div class="admin-info">
                    <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['admin_nama']); ?></strong></span>
                </div>
            </header>
            
            <div class="content">
                <?php if (isset($_GET['msg'])): ?>
                    <div class="alert alert-success">
                        <?php 
                        if ($_GET['msg'] == 'deleted') echo 'Pemesanan berhasil dihapus!';
                        if ($_GET['msg'] == 'updated') echo 'Status pemesanan berhasil diupdate!';
                        ?>
                    </div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-header">
                        <h2>Daftar Pemesanan</h2>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Olahraga</th>
                                    <th>Lapangan</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $pemesanan->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_pemesanan']; ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($row['user_name'] ?? 'Guest'); ?><br>
                                        <small><?php echo htmlspecialchars($row['user_email'] ?? '-'); ?></small>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['olahraga']); ?></td>
                                    <td><?php echo htmlspecialchars($row['lapangan']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                    <td><?php echo $row['jam_mulai'] . ' - ' . $row['jam_selesai']; ?></td>
                                    <td>
                                        <span class="badge badge-<?php echo $row['status']; ?>">
                                            <?php echo ucfirst($row['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 'pending'): ?>
                                            <a href="?update_status=<?php echo $row['id_pemesanan']; ?>&status=confirmed" 
                                               class="btn-action btn-edit">Confirm</a>
                                            <a href="?update_status=<?php echo $row['id_pemesanan']; ?>&status=cancelled" 
                                               class="btn-action btn-delete">Cancel</a>
                                        <?php endif; ?>
                                        <a href="?delete=<?php echo $row['id_pemesanan']; ?>" 
                                           class="btn-action btn-delete" 
                                           onclick="return confirm('Yakin ingin menghapus pemesanan ini?')">Delete</a>
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