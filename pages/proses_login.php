<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = htmlspecialchars($_POST['username']);
  $password = $_POST['password'];

  // Ambil data user dari database
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

  if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
      // Simpan data ke session
      $_SESSION['user_id']  = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['nama']     = $user['nama'];
      $_SESSION['role']     = $user['role']; // Simpan role

      // Arahkan ke dashboard sesuai role
      if ($user['role'] === 'admin') {
        echo "<script>alert('Login Admin berhasil!'); window.location='dashboard_admin.php';</script>";
      } else {
        echo "<script>alert('Login Santri berhasil!'); window.location='dashboard_user.php';</script>";
      }

    } else {
      echo "<script>alert('Password salah!'); window.location='login.php';</script>";
    }

  } else {
    echo "<script>alert('Username tidak ditemukan!'); window.location='login.php';</script>";
  }

} else {
  header("Location: login.php");
  exit;
}
?>
