<?php
session_start();
$is_logged_in = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true;
$user_name = $_SESSION['user_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LapanganKu - Booking Lapangan Olahraga</title>
  <link rel="stylesheet" href="../style/homepage.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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
            <!-- Jika sudah login -->
            <li><a href="history-pembayaran.php">History</a></li>
            <li><a href="profil-page.php" class="btn-profile">👤 <?php echo htmlspecialchars($user_name); ?></a></li>
            <li><a href="logout.php" class="btn-logout">Logout</a></li>
          <?php else: ?>
            <!-- Jika belum login -->
            <li><a href="sign-in.php" class="btn-login">Login</a></li>
            <li><a href="sign-up.php" class="btn-signup">Daftar</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="container hero-inner">
      <div class="hero-text">
        <h1>Booking Lapangan Olahraga Favoritmu dalam Hitungan Menit</h1>
        <p>Basket &nbsp;&bull;&nbsp; Futsal &nbsp;&bull;&nbsp; Badminton</p>
        <?php if ($is_logged_in): ?>
          <form class="search-form" action="pemesanan.php" method="GET">
            <button type="submit">Pesan Sekarang</button>
          </form>
        <?php else: ?>
          <form class="search-form" action="sign-in.php" method="GET">
            <button type="submit">Login untuk Pesan</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <section class="booking-cepat">
    <div class="container">
      <h2>Fitur Booking Cepat</h2>
      <form class="booking-form" action="pemesanan.php" method="GET">
        <div class="form-group">
          <label for="olahraga">Pilih Olahraga</label>
          <select id="olahraga" name="olahraga" required>
            <option value="">-- Pilih Olahraga --</option>
            <option value="basket">Basket</option>
            <option value="futsal">Futsal</option>
            <option value="badminton">Badminton</option>
          </select>
        </div>
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" id="tanggal" name="tanggal" required />
        </div>
        <div class="form-group">
          <label for="jam">Jam</label>
          <input type="time" id="jam" name="jam" required />
        </div>
        <div class="form-group btn-check">
          <button type="submit">Cek Ketersediaan</button>
        </div>
      </form>
    </div>
  </section>

  <section class="slideshow">
    <div class="slides fade">
      <img src="../slideshow foto/Basket.png" alt="Lapangan 1">
      <div class="caption">Lapangan Basket Nyaman</div>
    </div>

    <div class="slides fade">
      <img src="../slideshow foto/Futsal.png" alt="Lapangan 2">
      <div class="caption">Lapangan Futsal Modern</div>
    </div>

    <div class="slides fade">
      <img src="../slideshow foto/Badminton.jpg" alt="Lapangan 3">
      <div class="caption">Lapangan Badminton Terbaik</div>
    </div>

    <a class="prev" onclick="plusSlides(-1)">
      <img src="../photos/211689_left_arrow_icon.png" alt="Prev">
    </a>
    <a class="next" onclick="plusSlides(1)">
      <img src="../photos/211607_right_arrow_icon.png" alt="Next">
    </a>

    <div class="dots">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
  </section>

  <section class="booking-sekarang">
    <div class="container">
      <h2>Booking Sekarang</h2>
      <div class="cards">
        <article class="card">
          <img src="../photos/Lap Basket.png" alt="Lapangan Basket" />
          <h3>Lapangan Basket</h3>
          <p>Tempat nyaman untuk Basket, siap digunakan</p>
          <p><strong>Rp 50.000 / Jam</strong></p>
          <button onclick="window.location.href='pemesanan.php'">Pesan Sekarang</button>
        </article>
        <article class="card">
          <img src="../photos/Lap Futsal.png" alt="Lapangan Futsal" />
          <h3>Lapangan Futsal</h3>
          <p>Tempat nyaman untuk Futsal, siap digunakan</p>
          <p><strong>Rp 80.000 / Jam</strong></p>
          <button onclick="window.location.href='pemesanan.php'">Pesan Sekarang</button>
        </article>
        <article class="card">
          <img src="../photos/Lap Badminton.png" alt="Lapangan Badminton" />
          <h3>Lapangan Badminton</h3>
          <p>Tempat nyaman untuk Badminton, siap digunakan</p>
          <p><strong>Rp 40.000 / Jam</strong></p>
          <button onclick="window.location.href='pemesanan.php'">Pesan Sekarang</button>
        </article>
      </div>
    </div>
  </section>

<section class="review-pengunjung">
  <h1>Review Pengunjung</h1>
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      
      <div class="swiper-slide">
        <img src="https://i.pravatar.cc/80?img=10" alt="Jessica">
        <h4>Jessica</h4>
        <div class="stars">★★★★★</div>
        <p>Pelayanan ramah, lapangan bersih. Mantap sekali 👍</p>
      </div>

      <div class="swiper-slide">
        <img src="https://i.pravatar.cc/80?img=15" alt="Ryan">
        <h4>Ryan</h4>
        <div class="stars">★★★★★</div>
        <p>Harga sewa sesuai kualitas, pasti balik lagi !!</p>
      </div>

      <div class="swiper-slide">
        <img src="https://i.pravatar.cc/80?img=20" alt="Clara">
        <h4>Clara</h4>
        <div class="stars">★★★★☆</div>
        <p>Lighting oke, cuma parkiran agak sempit hehe 😅</p>
      </div>
    </div>

    <div class="swiper-pagination"></div>
  </div>
</section>

  <section class="sponsor-form">
    <div class="container">
      <img src="../photos/Lap Sponsor.png" alt="Lapangan Sport" />
      <div class="sponsor-text">
        <h2>Ingin kerja sama ataupun Sponsor lapangan?</h2>
        <form>
          <input type="email" placeholder="Email Anda" required />
          <button type="submit">Kirim</button>
        </form>
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


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="../script/slideshow.js"></script>
<script src="../script/swiper.js"></script>
</body>
</html>