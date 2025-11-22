<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM users WHERE id = $id");
    header('Location: users.php?msg=deleted');
    exit;
}

$users = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin LapanganKu</title>
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
                <a href="users.php" class="menu-item active">
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
        
        <main class="main-content">
            <header class="top-bar">
                <h1>Manage Users</h1>
                <div class="admin-info">
                    <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['admin_nama']); ?></strong></span>
                </div>
            </header>
            
            <div class="content">
                <?php if (isset($_GET['msg'])): ?>
                    <div class="alert alert-success">
                        <?php 
                        if ($_GET['msg'] == 'deleted') echo 'User berhasil dihapus!';
                        if ($_GET['msg'] == 'added') echo 'User berhasil ditambahkan!';
                        if ($_GET['msg'] == 'updated') echo 'User berhasil diupdate!';
                        ?>
                    </div>
                <?php endif; ?>
                
                <div class="card">
                    <div class="card-header">
                        <h2>Daftar Users</h2>
                        <a href="user-add.php" class="btn btn-primary">+ Tambah User</a>
                    </div>
                    
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($user = $users->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td><?php echo date('d M Y', strtotime($user['created_at'])); ?></td>
                                    <td>
                                        <a href="user-edit.php?id=<?php echo $user['id']; ?>" class="btn-action btn-edit">Edit</a>
                                        <a href="?delete=<?php echo $user['id']; ?>" 
                                           class="btn-action btn-delete" 
                                           onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</a>
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