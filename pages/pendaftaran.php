<?php
session_start();
include '../config.php';
include '../includes/header.php';

// Proses pendaftaran
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $telepon = $_POST['telepon'];
  $status = 'pending'; // Status pendaftaran awal adalah pending

  // Query untuk menyimpan data pendaftaran
  $query = "INSERT INTO pendaftaran (nama, alamat, email, telepon, status) VALUES ('$nama', '$alamat', '$email', '$telepon', '$status')";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Pendaftaran berhasil! Kami akan menghubungi Anda segera.'); window.location='index.php';</script>";
  } else {
    echo "<script>alert('Pendaftaran gagal. Silakan coba lagi.');</script>";
  }
}
?>

<div class="container py-5">
  <h2>Pendaftaran Santri Baru</h2>
  <form action="pendaftaran.php" method="POST">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama" name="nama" required>
    </div>

    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
      <label for="telepon" class="form-label">Nomor Telepon</label>
      <input type="text" class="form-control" id="telepon" name="telepon" required>
    </div>

    <button type="submit" class="btn btn-primary">Daftar</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
