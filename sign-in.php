<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapanganKu Sign-In</title>
    <link rel="stylesheet" href="sign-in.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="left">      
      <h2>Sign in</h2>
      <p>Tidak punya akun? <a href="sign-up.html">Buat sekarang</a></p>

      <form id="signInForm">
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" name="email" placeholder="example@gmail.com" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="••••••" required>
          <span class="toggle-password" onclick="togglePassword()">
          </span>
        </div>

        <div class="options">
          <label><input type="checkbox"> Remember me</label>
          <a href="forgot-password.php">Forgot Password?</a>
        </div>

        
        <button type="submit" class="btn">Sign in</button>

        <div class="divider">
          <hr><span>OR</span><hr>
        </div>

        <button type="button" class="social-btn">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google">
          Continue with Google
        </button>

        <button type="button" class="social-btn">
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


  <script src="sign-in.js"></script>
</body>
</html>
