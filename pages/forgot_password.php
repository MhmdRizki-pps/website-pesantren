<?php
session_start();
include '../config.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];

  // Cek apakah email ada di database
  $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    // Generate token unik untuk reset password
    $token = bin2hex(random_bytes(50)); // Membuat token acak 50 karakter

    // Simpan token di database (tabel users)
    $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid selama 1 jam
    $update_query = "UPDATE users SET reset_token = '$token', reset_expiry = '$expiry_time' WHERE email = '$email'";
    mysqli_query($conn, $update_query);

    // Kirim email dengan link reset password
    $reset_link = "http://localhost/reset_password.php?token=" . $token;
    $subject = "Reset Password Pesantren Modern";
    $message = "Klik link berikut untuk mereset password Anda: " . $reset_link;
    $headers = "From: no-reply@pesantrenmoderat.com";

    if (mail($email, $subject, $message, $headers)) {
      echo "<script>alert('Link reset password telah dikirim ke email Anda.');</script>";
    } else {
      echo "<script>alert('Gagal mengirim email reset password.');</script>";
    }
  } else {
    echo "<script>alert('Email tidak terdaftar.');</script>";
  }
}
?>

<div class="container py-5">
  <h2>Lupa Password</h2>
  <form action="forgot_password.php" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Email Terdaftar</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
