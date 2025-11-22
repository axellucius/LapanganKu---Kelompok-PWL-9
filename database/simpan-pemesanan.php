<?php
session_start();

// Include koneksi database
require_once '../config/db-connection.php';

// Set header JSON
header('Content-Type: application/json');

// Cek method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
    exit;
}

// Ambil data dari POST
$olahraga = trim($_POST['olahraga'] ?? '');
$lapangan = trim($_POST['lapangan'] ?? '');
$tanggal = trim($_POST['tanggal'] ?? '');
$jam_mulai = trim($_POST['jam_mulai'] ?? '');
$jam_selesai = trim($_POST['jam_selesai'] ?? '');

// Validasi input
if (empty($olahraga) || empty($lapangan) || empty($tanggal) || empty($jam_mulai) || empty($jam_selesai)) {
    echo json_encode([
        'success' => false,
        'message' => 'Semua field harus diisi!',
        'data_received' => [
            'olahraga' => $olahraga,
            'lapangan' => $lapangan,
            'tanggal' => $tanggal,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jam_selesai
        ]
    ]);
    exit;
}

// Validasi jam selesai harus lebih besar dari jam mulai
$jam_mulai_int = (int)str_replace('.00', '', $jam_mulai);
$jam_selesai_int = (int)str_replace('.00', '', $jam_selesai);

if ($jam_selesai_int <= $jam_mulai_int) {
    echo json_encode([
        'success' => false,
        'message' => 'Jam selesai harus lebih besar dari jam mulai!'
    ]);
    exit;
}

// Ambil user_id dari session jika login
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null;

try {
    // Prepare statement sesuai ada user_id atau tidak
    if ($user_id !== null) {
        $sql = "INSERT INTO pemesanan (user_id, olahraga, lapangan, tanggal, jam_mulai, jam_selesai, status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, 'pending', NOW())";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("isssss", $user_id, $olahraga, $lapangan, $tanggal, $jam_mulai, $jam_selesai);
    } else {
        $sql = "INSERT INTO pemesanan (olahraga, lapangan, tanggal, jam_mulai, jam_selesai, status, created_at) 
                VALUES (?, ?, ?, ?, ?, 'pending', NOW())";
        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("sssss", $olahraga, $lapangan, $tanggal, $jam_mulai, $jam_selesai);
    }
    
    // Execute query
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    // Ambil ID yang baru di-insert
    $id_pemesanan = $conn->insert_id;
    
    // Hitung durasi (dalam jam)
    $durasi = $jam_selesai_int - $jam_mulai_int;
    
    // Simpan data ke session untuk halaman pembayaran
    $_SESSION['id_pemesanan'] = $id_pemesanan;
    $_SESSION['detail_pemesanan'] = [
        'olahraga' => $olahraga,
        'lapangan' => $lapangan,
        'tanggal' => $tanggal,
        'jam_mulai' => $jam_mulai,
        'jam_selesai' => $jam_selesai,
        'durasi' => $durasi
    ];
    
    // Close statement
    $stmt->close();
    
    // Response sukses
    echo json_encode([
        'success' => true,
        'message' => 'Pemesanan berhasil disimpan ke database!',
        'id_pemesanan' => $id_pemesanan,
        'data' => [
            'id' => $id_pemesanan,
            'olahraga' => $olahraga,
            'lapangan' => $lapangan,
            'tanggal' => $tanggal,
            'jam' => $jam_mulai . ' - ' . $jam_selesai,
            'durasi' => $durasi . ' jam',
            'status' => 'pending'
        ]
    ]);
    
} catch (Exception $e) {
    // Response error
    echo json_encode([
        'success' => false,
        'message' => 'Error database: ' . $e->getMessage()
    ]);
}

// Close connection
$conn->close();
?>