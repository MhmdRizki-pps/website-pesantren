<?php
session_start();
include '../config.php';
include '../includes/header.php';

if (isset($_GET['token'])) {
  $token = $_GET['token'];

  // Cek apakah token valid
  $query = "SELECT * FROM users WHERE reset_token = '$token' AND reset_expiry > NOW() LIMIT 1";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $new_password = $_POST['new_password'];
      $confirm_password = $_POST['confirm_password'];

      // Validasi password baru
      if ($new_password === $confirm_password) {
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password baru di database
        $update_query = "UPDATE users SET password = '$new_password_hashed', reset_token = NULL, reset_expiry = NULL WHERE reset_token = '$token'";
        mysqli_query($conn, $update_query);

        echo "<script>alert('Password berhasil diperbarui!'); window.location='login.php';</script>";
      } else {
        echo "<script>alert('Konfirmasi password tidak cocok!');</script>";
      }
    }
  } else {
    echo "<script>alert('Link reset password tidak valid atau telah kedaluwarsa.');</script>";
  }
} else {
  header("Location: forgot_password.php");
  exit;
}
?>

<div class="container py-5">
  <h2>Reset Password</h2>
  <form action="reset_password.php?token=<?= $_GET['token']; ?>" method="POST">
    <div class="mb-3">
      <label for="new_password" class="form-label">Password Baru</label>
      <input type="password" class="form-control" id="new_password" name="new_password" required>
    </div>

    <div class="mb-3">
      <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
    </div>

    <button type="submit" class="btn btn-primary">Ubah Password</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
