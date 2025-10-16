<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapanganKu Forgot Password</title>
    <link rel="stylesheet" href="sign-in.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="left">      
      <h2>Forgot Password</h2>
      <p>Remmember Password? <a href="sign-in.php">Sign in</a></p>

      <form id="forgotPasswordForm">
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" name="email" placeholder="example@gmail.com" required>
        </div>
        
        <p style="font-size: 14px; color: #666; margin: 10px 0;">
          Enter your email address and we'll send you a link to reset your password.
        </p>
        
        <button type="submit" class="btn">Send Reset Link</button>

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

  <!-- Connect to JavaScript -->
  <script src="forgot-password.js"></script>
</body>
</html>
