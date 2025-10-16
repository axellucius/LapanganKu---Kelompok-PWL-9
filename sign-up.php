<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up LapanganKu</title>
    <link rel="stylesheet" href="Sign Up.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
    <div class="left">
      <h2>Sign up</h2>
      <p>Sudah punya akun? <a href="Sign In.html">Login disini</a></p>
    
     <form>
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" placeholder="example@gmail.com" required>
        </div>

        <div class="form-group">
          <label>Nomor Telepon</label>
          <input type="tel" placeholder="+62" required>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" placeholder="••••••" required>
          <span class="toggle-password" onclick="togglePassword('password', 'eyeIcon1')">
            <img src="Foto/Password.png" id="eyeIcon1">
          </span>
        </div>

        <div class="form-group">
          <label>Konfirmasi Password</label>
          <input type="password" placeholder="••••••" required>
          <span class="toggle-password" onclick="togglePassword('confirmPassword', 'eyeIcon2')">
            <img src="Foto/Password.png" id="eyeIcon2">
          </span>
        </div>

        <div class="form-group checkbox-group">
        <label>
            <input type="checkbox" required> Setuju dengan setiap syarat dan ketentuan
        </label>
        </div>

        <button type="submit" class="btn">Sign up</button>

        <div class="divider">
          <hr><span>OR</span><hr>
        </div>

        <button class="social-btn">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
          Continue with Google
        </button>

        <button class="social-btn">
          <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook">
          Continue with Facebook
        </button>
      </form>
    </div>

    <div class="right">
      <img src="Foto/Lapangan.png" alt="Lapangan">
      <h2>Welcome to LapanganKu</h2>
      <p>Lapangan terbaik se Indonesia yang menyediakan berbagai fasilitas yang menyenangkan dan pelayanan yang sangat bagus</p>
    </div>
  </div>

</body>
</html>