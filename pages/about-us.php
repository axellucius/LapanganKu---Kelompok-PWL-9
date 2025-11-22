<?php
session_start();
$is_logged_in = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$user_name = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LapanganKu</title>
    <link rel="stylesheet" href="../style/about-us.css">
</head>
<body>
    
  <header>
    <div class="container header-inner">
      <div class="logo">LapanganKu</div>
      <nav>
        <ul>
          <li><a href="homepage.php">Home</a></li>
          <li><a href="pemesanan.php">Lapangan</a></li>
          <li><a href="about-us.php">About us</a></li>
          
          <?php if ($is_logged_in): ?>
            <li><a href="history-pembayaran.php">History</a></li>
            <li><a href="profil-page.php" class="btn-profile">👤 <?php echo htmlspecialchars($user_name); ?></a></li>
            <li><a href="logout.php" class="btn-logout">Logout</a></li>
          <?php else: ?>
            <li><a href="sign-in.php" class="btn-login">Login</a></li>
            <li><a href="sign-up.php" class="btn-signup">Daftar</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>

   
    <section class="about-section" id="about">
        <div class="container">
            <h2 class="section-title">About us</h2>
            <p class="section-subtitle">LapanganKu Website</p>
            
            <div class="sports-grid">
                <div class="sport-card">
                    <div class="sport-icon badminton-icon">
                        <img src="../photos/badmin.png" alt="Badminton">
                    </div>
                    <h3 class="sport-title">Badminton</h3>
                    <p class="sport-description">Menyediakan 4 Lapangan</p>
                </div>
                
                <div class="sport-card">
                    <div class="sport-icon futsal-icon">
                        <img src="../photos/futsal.png" alt="Futsal">
                    </div>
                    <h3 class="sport-title">Futsal</h3>
                    <p class="sport-description">Menyediakan 2 Lapangan Outdoor serta Indoor</p>
                </div>
                
                <div class="sport-card">
                    <div class="sport-icon basket-icon">
                        <img src="../photos/basket.png" alt="Basket">
                    </div>
                    <h3 class="sport-title">Basket</h3>
                    <p class="sport-description">Menyediakan 2 Lapangan Outdoor serta Indoor</p>
                </div>
            </div>
        </div>
    </section>

    
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">OUR TEAM</h2>
            <p class="section-subtitle">LapanganKU Developer Team</p>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo-axel">
                        <img src="../photos/Axel.png" alt="Axel Lucius Efendi">
                    </div>
                    <h3 class="member-name-axel">Axel Lucius Efendi</h3>
                    <p class="member-role-axel">Sebagai UI / UX Designer</p>
                </div>
                
                <div class="team-member">
                    <div class="member-photo-bryan">
                        <img src="../photos/Bryan.png" alt="Bryan Stevent">
                    </div>
                    <h3 class="member-name-bryan">Bryan Stevent</h3>
                    <p class="member-role-bryan">Front-End Developer</p>
                </div>
                
                <div class="team-member">
                    <div class="member-photo-justin">
                        <img src="../photos/Justin.png" alt="Justin Sebastian">
                    </div>
                    <h3 class="member-name-justin">Justin Sebastian</h3>
                    <p class="member-role-justin">Back-End Developer</p>
                </div>
            </div>
        </div>
    </section>

   
    <section class="testimonial-section">
        <div class="container">
            <h2 class="section-title-dark">Apa yang customer katakan mengenai LapanganKu</h2>
            
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="customer-photo">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Justin">
                    </div>
                    <div class="testimonial-content">
                        <h4 class="customer-name">Justin</h4>
                        <p class="customer-title">Atlet Badminton</p>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">Lapangan bersih, fasilitas lengkap, harga terjangkau. Sangat puas dengan layanan LapanganKu!</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="customer-photo">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Jessica">
                    </div>
                    <div class="testimonial-content">
                        <h4 class="customer-name">Jessica</h4>
                        <p class="customer-title">Mahasiswa</p>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">Booking online sangat mudah! Tidak perlu antri lagi. Recommended banget untuk mahasiswa.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="customer-photo">
                        <img src="https://randomuser.me/api/portraits/men/46.jpg" alt="Bryan">
                    </div>
                    <div class="testimonial-content">
                        <h4 class="customer-name">Bryan</h4>
                        <p class="customer-title">Pemain Basket</p>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">Lapangan basket terbaik di kota! Kondisi selalu prima dan pelayanan ramah.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="customer-photo">
                        <img src="https://randomuser.me/api/portraits/men/52.jpg" alt="Andi">
                    </div>
                    <div class="testimonial-content">
                        <h4 class="customer-name">Andi</h4>
                        <p class="customer-title">Pengusaha</p>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">Tempat favorit tim kantor untuk olahraga bersama. Sistemnya praktis dan profesional.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="customer-photo">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Sarah">
                    </div>
                    <div class="testimonial-content">
                        <h4 class="customer-name">Sarah</h4>
                        <p class="customer-title">Ibu Rumah Tangga</p>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">Anak-anak suka main badminton disini. Tempatnya aman dan nyaman untuk keluarga.</p>
                    </div>
                </div>
                
                <div class="testimonial-card">
                    <div class="customer-photo">
                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Doni">
                    </div>
                    <div class="testimonial-content">
                        <h4 class="customer-name">Doni</h4>
                        <p class="customer-title">Coach Futsal</p>
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p class="testimonial-text">Lapangan futsal dengan standar profesional. Cocok untuk latihan tim maupun turnamen.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <footer>
    <div class="container footer-inner">
      <div class="footer-col">
        <h4>LapanganKu</h4>
        <p>Online booking lapangan olahraga favoritmu dengan mudah dan cepat.</p>
        <address>
          Jl. Merdeka No. 123<br />
          Telp: (021) 123456<br />
          Email: info@lapanganku.com
        </address>
      </div>
      <div class="footer-col">
        <h4>Lapangan</h4>
        <ul>
          <li><a href="pemesanan.php">Basket</a></li>
          <li><a href="pemesanan.php">Futsal</a></li>
          <li><a href="pemesanan.php">Badminton</a></li>
          <li><a href="pemesanan.php">Booking</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Informasi</h4>
        <ul>
          <li><a href="about-us.php">Tentang Kami</a></li>
          <li><a href="#">Kontak</a></li>
          <li><a href="#">Syarat & Ketentuan</a></li>
          <li><a href="#">Kebijakan Privasi</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Lokasi</h4>
        <img src="../photos/image 13.png" alt="Map lokasi" />
      </div>
    </div>
</footer>

    <script src="../script/about-us.js"></script>
</body>
</html>