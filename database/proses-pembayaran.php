<?php
session_start();
require_once '../config/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: pemesanan.php');
    exit;
}

$id_pemesanan = $_POST['id_pemesanan'] ?? 0;
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$metode = $_POST['metode'] ?? '';
$jumlah = floatval($_POST['jumlah'] ?? 0);

if (empty($nama) || empty($email) || empty($metode) || $id_pemesanan == 0 || $jumlah == 0) {
    echo "<script>
        alert('Data tidak lengkap! Silakan isi semua field.');
        window.history.back();
    </script>";
    exit;
}

$conn->begin_transaction();

try {
    $stmt = $conn->prepare("INSERT INTO pembayaran (id_pemesanan, nama_lengkap, email_hp, metode_pembayaran, jumlah, status, tanggal_pembayaran) VALUES (?, ?, ?, ?, ?, 'success', NOW())");
    
    if (!$stmt) {
        throw new Exception("Prepare statement gagal: " . $conn->error);
    }
    
    $stmt->bind_param("isssd", $id_pemesanan, $nama, $email, $metode, $jumlah);
    
    if (!$stmt->execute()) {
        throw new Exception("Insert pembayaran gagal: " . $stmt->error);
    }
    
    $id_pembayaran = $conn->insert_id;
    
    $stmt2 = $conn->prepare("UPDATE pemesanan SET status = 'confirmed' WHERE id_pemesanan = ?");
    
    if (!$stmt2) {
        throw new Exception("Prepare statement update gagal: " . $conn->error);
    }
    
    $stmt2->bind_param("i", $id_pemesanan);
    
    if (!$stmt2->execute()) {
        throw new Exception("Update pemesanan gagal: " . $stmt2->error);
    }
    
    $conn->commit();
    
    $_SESSION['pembayaran_sukses'] = true;
    $_SESSION['detail_pembayaran'] = [
        'id_pembayaran' => $id_pembayaran,
        'id_pemesanan' => $id_pemesanan,
        'nama' => $nama,
        'email' => $email,
        'metode' => $metode,
        'jumlah' => $jumlah
    ];
    
    unset($_SESSION['id_pemesanan']);
    unset($_SESSION['detail_pemesanan']);
    
    $stmt->close();
    $stmt2->close();
    
    header('Location: ../pages/transaksi-berhasil.php');
    exit;
    
} catch (Exception $e) {
    $conn->rollback();
    
    echo "<script>
        alert('Pembayaran gagal! Error: " . addslashes($e->getMessage()) . "');
        window.history.back();
    </script>";
    exit;
}

$conn->close();
?>