<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama     = htmlspecialchars($_POST['nama']);
  $username = htmlspecialchars($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password

  // Cek apakah username sudah digunakan
  $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah terdaftar!'); window.location='register.php';</script>";
  } else {
    $query = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', 'user')";

    if (mysqli_query($conn, $query)) {
      echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
      echo "Gagal mendaftar: " . mysqli_error($conn);
    }
  }
} else {
  header("Location: register.php");
}
?>
