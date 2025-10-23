<?php
require_once '../config/db-connection.php';
session_start();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['name'];
                $success = "Login berhasil!";
                echo "<script>
                        alert('Login berhasil!');
                        window.location.href = 'homepage.php';
                      </script>";
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Email tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LapanganKu Sign-In</title>
  <link rel="stylesheet" href="../style/sign-in.css" />
  <link rel="stylesheet" href="../style/error.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <div class="left">
      <h2>Sign in</h2>
      <p>Tidak punya akun? <a href="sign-up.php">Buat sekarang</a></p>

      <?php if (!empty($error)): ?>
        <div class="error-box"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form id="signInForm" method="POST" action="">
        <div class="form-group">
          <label>E-mail</label>
          <input type="email" id="email" name="email" placeholder="example@gmail.com" required />
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" id="password" name="password" placeholder="••••••" required />
          <span class="toggle-password" onclick="togglePassword()">
            <img id="eyeIcon" src="../photos/Password.png" alt="Show" width="20" />
          </span>
        </div>

        <div class="options">
          <label><input type="checkbox" id="rememberMe" /> Remember me</label>
          <a href="forgot-password.php">Forgot Password?</a>
        </div>

        <button type="submit" class="btn">Sign in</button>

        <div class="divider">
          <hr /><span>OR</span><hr />
        </div>

        <button type="button" class="social-btn">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" />
          Continue with Google
        </button>

        <button type="button" class="social-btn">
          <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" />
          Continue with Facebook
        </button>
      </form>
    </div>

    <div class="right">
      <img src="../photos/Lapangan.png" alt="Lapangan" />
      <h2>Welcome to LapanganKu</h2>
      <p>Lapangan terbaik se Indonesia yang menyediakan berbagai fasilitas yang menyenangkan dan pelayanan yang sangat bagus.</p>
    </div>
  </div>

  <script src="../script/sign-in.js?v=2"></script>
</body>
</html>
