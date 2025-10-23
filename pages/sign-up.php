<?php
require_once '../config/db-connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];

    if ($password != $confirm) {
        echo "<script>alert('Password tidak sama!'); window.history.back();</script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: ../pages/sign-in.php");
        exit;
    } else {
        echo "<script>alert('Pendaftaran gagal: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapanganKu Sign-Up</title>
    <link rel="stylesheet" href="../style/sign-in.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="left">      
      <h2>Sign up</h2>
      <p>Sudah punya akun? <a href="../pages/sign-in.php">Sign in</a></p>

      <form id="signUpForm" method="POST">
        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" placeholder="Your full name" required>
        </div>
        
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" name="email" placeholder="example@gmail.com" required>
        </div>
        
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="••••••" required>
        </div>
        
        <div class="form-group">
          <label>Confirm Password</label>
          <input type="password" name="confirm-password" placeholder="••••••" required>
        </div>

        <div class="options">
          <label>
            <input type="checkbox" name="terms" required> 
            I agree to the <a href="#">Terms & Conditions</a>
          </label>
        </div>
        
        <button type="submit" class="btn">Sign up</button>

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
      <img src="../photos/Lapangan.png" alt="Lapangan">
      <h2>Welcome to LapanganKu</h2>
      <p>Lapangan terbaik se Indonesia yang menyediakan berbagai fasilitas yang menyenangkan dan pelayanan yang sangat bagus</p>
    </div>
  </div>

<script src="../script/sign-up.js"></script>
</body>
</html>
