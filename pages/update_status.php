<?php
session_start();
include '../config.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Ambil ID dan status dari URL
if (isset($_GET['id']) && isset($_GET['status'])) {
  $id = $_GET['id'];
  $status = $_GET['status'];

  // Update status pendaftaran di database
  $update_query = "UPDATE pendaftaran SET status = '$status' WHERE id = '$id'";
  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Status pendaftaran berhasil diperbarui!'); window.location='manage_pendaftaran.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui status pendaftaran.'); window.location='manage_pendaftaran.php';</script>";
  }
}
?>
