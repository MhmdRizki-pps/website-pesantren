<?php
session_start();
include '../config.php';
include '../includes/header.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Ambil data user berdasarkan role
if ($role == 'admin') {
  $query = "SELECT * FROM users WHERE id = '$user_id' LIMIT 1";
} else if ($role == 'user') {
  $query = "SELECT * FROM santri WHERE user_id = '$user_id' LIMIT 1";
}

$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Proses perubahan password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // Cek apakah password saat ini benar
  if (password_verify($current_password, $user_data['password'])) {
    // Validasi password baru
    if ($new_password === $confirm_password) {
      // Hash password baru
      $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

      // Update password
      if ($role == 'admin') {
        $update_query = "UPDATE users SET password = '$new_password_hashed' WHERE id = '$user_id'";
      } else if ($role == 'user') {
        $update_query = "UPDATE santri SET password = '$new_password_hashed' WHERE user_id = '$user_id'";
      }

      if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Password berhasil diperbarui!'); window.location='dashboard.php';</script>";
      } else {
        echo "<script>alert('Gagal memperbarui password!');</script>";
      }
    } else {
      echo "<script>alert('Konfirmasi password baru tidak cocok!');</script>";
    }
  } else {
    echo "<script>alert('Password saat ini salah!');</script>";
  }
}
?>

<div class="container py-5">
  <h2>Ubah Password</h2>
  <form action="change_password.php" method="POST">
    <div class="mb-3">
      <label for="current_password" class="form-label">Password Saat Ini</label>
      <input type="password" class="form-control" id="current_password" name="current_password" required>
    </div>

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
