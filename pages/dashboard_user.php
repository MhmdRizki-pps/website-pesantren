<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'user') {
  header("Location: ../pages/login.php");
  exit;
}
include '../config.php';
include '../includes/header.php';

$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM santri WHERE user_id = '$user_id'");
$data = mysqli_fetch_assoc($query);
?>

<div class="container py-5">
  <h2>Dashboard Santri</h2>
  <p>Selamat datang, <?= $_SESSION['nama']; ?></p>

  <?php if ($data): ?>
    <ul>
      <li><strong>Nama:</strong> <?= $data['nama']; ?></li>
      <li><strong>Status Seleksi:</strong> <?= $data['status_seleksi']; ?></li>
    </ul>
  <?php else: ?>
    <p>Anda belum mendaftar. <a href="pendaftaran.php">Klik di sini untuk mendaftar.</a></p>
  <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
