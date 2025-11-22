<?php
require_once '../config/db-connection.php';

echo "<h2>Testing Database Connection</h2>";

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "<p style='color: green;'>✓ Koneksi database berhasil!</p>";

echo "<h3>Tabel Pemesanan:</h3>";
$result = $conn->query("SELECT * FROM pemesanan ORDER BY created_at DESC LIMIT 5");
if ($result) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>User ID</th><th>Olahraga</th><th>Lapangan</th><th>Tanggal</th><th>Jam</th><th>Status</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_pemesanan'] . "</td>";
        echo "<td>" . ($row['user_id'] ?? 'Guest') . "</td>";
        echo "<td>" . $row['olahraga'] . "</td>";
        echo "<td>" . $row['lapangan'] . "</td>";
        echo "<td>" . $row['tanggal'] . "</td>";
        echo "<td>" . $row['jam_mulai'] . " - " . $row['jam_selesai'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
}

echo "<h3>Tabel Pembayaran:</h3>";
$result2 = $conn->query("SELECT * FROM pembayaran ORDER BY tanggal_pembayaran DESC LIMIT 5");
if ($result2) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>ID Pemesanan</th><th>Nama</th><th>Email/HP</th><th>Metode</th><th>Jumlah</th><th>Status</th></tr>";
    while ($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['id_pemesanan'] . "</td>";
        echo "<td>" . $row['nama_lengkap'] . "</td>";
        echo "<td>" . $row['email_hp'] . "</td>";
        echo "<td>" . $row['metode_pembayaran'] . "</td>";
        echo "<td>Rp " . number_format($row['jumlah'], 0, ',', '.') . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
}

$conn->close();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background: #f5f5f5;
    }
    table {
        background: white;
        margin: 20px 0;
        width: 100%;
    }
    th {
        background: #2A8A56;
        color: white;
    }
</style>