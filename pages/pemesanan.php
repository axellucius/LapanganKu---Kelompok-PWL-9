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
            
            <div class="promo">
                Promo Hari ini : Diskon 10%
            </div>

            <div class="sports">
                <button class="sport active" data-sport="Basket">
                    <div class="icon">🏀</div>
                    <div class="name">Basket</div>
                </button>
                <button class="sport" data-sport="Futsal">
                    <div class="icon">⚽</div>
                    <div class="name">Futsal</div>
                </button>
                <button class="sport" data-sport="Badminton">
                    <div class="icon">🏸</div>
                    <div class="name">Badminton</div>
                </button>
            </div>
        </div>

   
        <div class="bottom-section">
            
            <div class="form-section">
                <h2 class="title">Pemesanan Lapangan</h2>
                <p class="info">Pilih tanggal, lapangan, dan jam bermain (09.00 - 23.00)</p>

            
                <div class="field">
                    <label class="label">Tanggal Bermain</label>
                    <select id="tanggal" class="select">
                        <option value="">Pilih tanggal</option>
                    </select>
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
                    <label class="label">Pilih Jam Bermain</label>
                    <div class="times">
                        <button class="time" data-time="09.00">09.00</button>
                        <button class="time" data-time="10.00">10.00</button>
                        <button class="time" data-time="11.00">11.00</button>
                        <button class="time" data-time="12.00">12.00</button>
                        <button class="time" data-time="13.00">13.00</button>
                        <button class="time" data-time="14.00">14.00</button>
                        <button class="time" data-time="15.00">15.00</button>
                        <button class="time" data-time="16.00">16.00</button>
                        <button class="time" data-time="17.00">17.00</button>
                        <button class="time" data-time="18.00">18.00</button>
                        <button class="time" data-time="19.00">19.00</button>
                        <button class="time" data-time="20.00">20.00</button>
                        <button class="time" data-time="21.00">21.00</button>
                        <button class="time" data-time="22.00">22.00</button>
                        <button class="time" data-time="23.00">23.00</button>
                    </div>
                </div>
            </div>

        
            <div class="summary-section">
                <div class="summary">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>
                    
                    <div class="summary-row">
                        <div class="summary-label">Lapangan:</div>
                        <div class="summary-value" id="s-sport">Basket -</div>
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

                    <button class="btn">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../script/pemesanan.js"></script>
</body>
</html>