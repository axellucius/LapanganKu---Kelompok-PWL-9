
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../style/pembayaran.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>

    <div class="container">
      <div class="pesanan">
        <h2>Pesanan Anda</h2>
        <div class="detail-pesanan">
          <img src="../photos/dpnkwabotttfihp7gf3r.jpg" alt="" width="150px" height="120px">
          <div class="info-pesanan">
            <strong>Lapangan Badminton</strong>
            <div class="info-detail">
              <p>Lapangan: 1 & 2</p>
              <p>Tanggal: 22 Agustus 2025</p>
              <p>Jam: 19:00-20:00</p>
            </div>
          </div>
          <div class="harga">Rp 50.000</div>
        </div>
        <div class="garis-putus"></div>
        <div class="total">
          <strong>Total: Rp 50.000</strong>
        </div>

      </div>
      <div class="pembayaran">
        <h2>Pembayaran</h2>
        <form action="simpan-pembayaran.php" method="POST">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" />
          <label for="email">Email/No-Hp</label>
          <input type="text" id="email" name="email" placeholder="Masukkan email atau nomor HP" />
          <div class="metode-pembayaran">Metode Pembayaran</div>
          <label class="opsi-pembayaran">
            <input type="radio" name="metode" value="transfer" /> Transfer Bank </label>
          <label class="opsi-pembayaran">
            <input type="radio" name="metode" value="ewallet" /> E-Wallet </label>
          <label class="opsi-pembayaran">
            <input type="radio" name="metode" value="virtual" /> Virtual Account </label>
          <label class="opsi-pembayaran">
            <input type="radio" name="metode" value="kartu" /> Kartu Debit/Kredit </label>
          <label class="opsi-pembayaran">
            <input type="radio" name="metode" value="cod" /> Bayar di Tempat </label>

          <button type="submit">Pay Now</button>
        </form>
      </div>
    </div>
  </body>
</html>