<?php
require_once '../config/db-connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_SESSION['id_user'] ?? 1;
    $sport = $_POST['sport'] ?? '';
    $lapangan = $_POST['lapangan'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $jam_mulai = str_replace(".", ":", $_POST['jam_mulai']);
    $jam_selesai = str_replace(".", ":", $_POST['jam_selesai']);
    if (strlen($jam_mulai) === 5) $jam_mulai .= ":00";
    if (strlen($jam_selesai) === 5) $jam_selesai .= ":00";
    $status = "Menunggu Pembayaran";
    $created_at = date("Y-m-d H:i:s");

    if ($sport == "Basket") $id_lapangan = 1;
    elseif ($sport == "Futsal") $id_lapangan = 2;
    else $id_lapangan = 3;

    $stmt = $conn->prepare("INSERT INTO pemesanan (id_user, id_lapangan, tanggal, jam_mulai, jam_selesai, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssss", $id_user, $id_lapangan, $tanggal, $jam_mulai, $jam_selesai, $status, $created_at);

    if ($stmt->execute()) {
        echo "<script>alert('Pemesanan berhasil!'); window.location.href='pembayaran.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Lapangan - LapanganKu</title>
    <link rel="stylesheet" href="../style/pemesanan.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="container header-inner">
        <div class="logo">LapanganKu</div>
        <nav>
            <ul>
                <li><a href="../pages/homepage.php">Home</a></li>
                <li><a href="../pages/pemesanan.php">Lapangan</a></li>
                <li><a href="../pages/about-us.php">About us</a></li>
                <li><a href="../pages/profil-page.php" class="btn-profile">Profile</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="main">
    <div class="top-section">
        <h2 class="title">Pemesanan Lapangan</h2>
        <p class="subtitle">Pilih olahraga favoritmu dan pesan lapangan dengan mudah!</p>
        <div class="promo">Promo Hari ini : Diskon 10%</div>

        <div class="sports">
            <button type="button" class="sport active" data-sport="Basket">🏀 Basket</button>
            <button type="button" class="sport" data-sport="Futsal">⚽ Futsal</button>
            <button type="button" class="sport" data-sport="Badminton">🏸 Badminton</button>
        </div>
    </div>

    <div class="bottom-section">
        <form class="form-section" method="POST" action="">
            <h2 class="title">Pemesanan Lapangan</h2>
            <p class="info">Pilih tanggal, lapangan, dan jam bermain (09.00 - 23.00)</p>

            <div class="field">
                <label class="label">Tanggal Bermain</label>
                <input type="date" name="tanggal" id="tanggal" class="select" required>
            </div>

            <div class="field">
                <label class="label">Pilih Lapangan</label>
                <div class="radios">
                    <label class="radio">
                        <input type="radio" name="lapangan" value="Lapangan 1" checked>
                        <span>Lapangan 1</span>
                    </label>
                    <label class="radio">
                        <input type="radio" name="lapangan" value="Lapangan 2">
                        <span>Lapangan 2</span>
                    </label>
                </div>
            </div>

            <div class="field">
                <label class="label">Jam Mulai</label>
                <select name="jam_mulai" id="jam_mulai" class="select" required></select>
            </div>

            <div class="field">
                <label class="label">Jam Selesai</label>
                <select name="jam_selesai" id="jam_selesai" class="select" required></select>
            </div>

            <input type="hidden" name="sport" id="inputSport" value="Basket">

            <div class="summary-section">
                <div class="summary">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>
                    <div class="summary-row">
                        <div class="summary-label">Lapangan:</div>
                        <div class="summary-value" id="s-sport">Basket</div> -
                        <div class="summary-value" id="s-lapangan">Lapangan 1</div>
                    </div>
                    <div class="summary-row">
                        <div class="summary-label">Tanggal:</div>
                        <div class="summary-value" id="s-tanggal">-</div>
                    </div>
                    <div class="summary-row">
                        <div class="summary-label">Jam:</div>
                        <div class="summary-value" id="s-jam">-</div>
                    </div>
                    <button type="submit" class="btn" name="lanjut_pembayaran">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="../script/pemesanan.js?v=3"></script>
</body>
</html>
