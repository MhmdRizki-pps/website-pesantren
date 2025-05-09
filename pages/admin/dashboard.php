<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

include '../config.php';
include '../includes/header.php';

// Ambil jumlah santri terdaftar
$query_santri = "SELECT COUNT(*) AS total_santri FROM santri";
$result_santri = mysqli_query($conn, $query_santri);
$row_santri = mysqli_fetch_assoc($result_santri);

// Ambil jumlah santri yang lolos seleksi
$query_lolos = "SELECT COUNT(*) AS total_lolos FROM santri WHERE status_seleksi = 'Lolos'";
$result_lolos = mysqli_query($conn, $query_lolos);
$row_lolos = mysqli_fetch_assoc($result_lolos);

// Ambil jumlah santri yang tidak lolos seleksi
$query_tidak_lolos = "SELECT COUNT(*) AS total_tidak_lolos FROM santri WHERE status_seleksi = 'Tidak Lolos'";
$result_tidak_lolos = mysqli_query($conn, $query_tidak_lolos);
$row_tidak_lolos = mysqli_fetch_assoc($result_tidak_lolos);
?>

<div class="container py-5">
  <h2>Dashboard Admin</h2>
  <div class="row">
    <div class="col-md-4">
      <div class="card bg-info text-white">
        <div class="card-body">
          <h5 class="card-title">Total Santri Terdaftar</h5>
          <p class="card-text"><?= $row_santri['total_santri']; ?> Santri</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-success text-white">
        <div class="card-body">
          <h5 class="card-title">Total Santri Lolos Seleksi</h5>
          <p class="card-text"><?= $row_lolos['total_lolos']; ?> Santri</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-danger text-white">
        <div class="card-body">
          <h5 class="card-title">Total Santri Tidak Lolos</h5>
          <p class="card-text"><?= $row_tidak_lolos['total_tidak_lolos']; ?> Santri</p>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-4">
    <h3>Menu Admin</h3>
    <ul class="list-group">
      <li class="list-group-item"><a href="hasil_seleksi.php">Manajemen Seleksi Santri</a></li>
      <li class="list-group-item"><a href="pendaftaran.php">Pendaftaran Santri Baru</a></li>
      <li class="list-group-item"><a href="update_seleksi.php">Perbarui Status Seleksi Santri</a></li>
    </ul>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
