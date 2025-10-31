<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LapanganKu - Profile Page</title>
  <link rel="stylesheet" href="../style/Styleprofilpage.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="sidebar">
    <h1>LapanganKu</h1>

    <div class="menu">
      <a href="#" class="item active">
        <span class="icon">🛡️</span>
        <span>Profile</span>
        <span class="arrow">›</span>
      </a>

      <a href="history-pembayaran.php" class="item">
        <span class="icon">📅</span>
        <span>History Pemesanan</span>
        <span class="arrow">›</span>
      </a>

      <a href="homepage.php" class="item">
        <span class="icon">✏️</span>
        <span>Hompage</span>
        <span class="arrow">›</span>
      </a>
    </div>
  </div>

  <div class="main">
    <div class="header">
      <div class="header-left">
        <h2>MY PROFILE</h2>
      </div>
      <div class="header-right">
        <span class="bell">🔔</span>
        <div class="user">
          <img src="../photos/Bryan.png" class="avatar-mini" id="navAvatar" />
          <div>
            <p class="welcome">Welcome back,</p>
            <p class="name">Bryan</p>
          </div>
          <span class="arrow-down">▼</span>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="card-left">
        <div class="photo-section">
          <img src="../photos/Bryan.png" class="avatar" id="profilePhoto" />
          <input type="file" id="photoInput" accept="image/*" hidden />
          <button class="btn-upload" id="uploadBtn">Upload Photo</button>
        </div>

        <div class="form">
          <div class="field">
            <label>Your Name</label>
            <div class="input-wrapper">
              <input type="text" value="Bryan" readonly />
              <span class="edit">Edit</span>
            </div>
          </div>

          <div class="field">
            <label>Email</label>
            <div class="input-wrapper">
              <input type="email" value="Bryan@gmail.com" readonly />
              <span class="edit">Edit</span>
            </div>
          </div>

          <div class="field">
            <label>Phone Number</label>
            <div class="input-wrapper">
              <input type="text" value="+62 69852845732" readonly />
              <span class="edit">Edit</span>
            </div>
          </div>

          <div class="field">
            <label>Tentang Bryan</label>
            <div class="input-wrapper">
              <textarea readonly>Bryan adalah anak SMK kelas 11 yang menyewa lapangan 12 kali di LapanganKu.</textarea>
              <span class="edit">Edit</span>
            </div>
          </div>
        </div>

        <div class="status">
          <h3>Status Akun</h3>
          <div class="row">
            <span>Email</span>
            <span class="badge green">Verified</span>
          </div>
          <div class="row">
            <span>Nomor Telepon</span>
            <span class="badge grey">Verify</span>
          </div>
        </div>
      </div>

      <div class="card-right">
        <button class="btn-mydata">My Data</button>

        <div class="section">
          <h3>Kualifikasi</h3>
          <div class="box-kualifikasi">
            <span>Sudah 1 tahun aktif member</span>
            <div class="trophy">🏆</div>
          </div>
        </div>

        <div class="section">
          <h3>Olahraga Favorit</h3>
          <div class="tags">
            <span class="tag">Basket</span>
            <span class="tag">Padel</span>
          </div>
          <div class="tags">
            <span class="tag">Futsal</span>
            <span class="tag">Badminton</span>
          </div>
        </div>

        <div class="section">
          <h3>Total Pemesanan</h3>
          <div class="box-stat orange">
            <div>
              <div class="number">12</div>
              <div class="text">Booking Lapangan</div>
            </div>
            <div class="icon">⚡</div>
          </div>
        </div>

        <div class="section">
          <h3>Penilaian</h3>
          <div class="box-stat yellow">
            <div>
              <div class="number">4.8</div>
              <div class="text">dari 12x booking lapangan</div>
            </div>
            <div class="icon">⭐</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="toast"></div>
  <script src="../script/profile.js"></script>
</body>
</html>
