<?php
session_start();
include '../config.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Hapus santri berdasarkan ID
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $delete_query = "DELETE FROM santri WHERE id = '$id'";
  if (mysqli_query($conn, $delete_query)) {
    echo "<script>alert('Santri berhasil dihapus!'); window.location='manage_santri.php';</script>";
  } else {
    echo "<script>alert('Gagal menghapus santri.'); window.location='manage_santri.php';</script>";
  }
}
