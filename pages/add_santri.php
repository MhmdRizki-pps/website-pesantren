<?php
session_start();
include '../config.php';
include '../includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Proses penyimpanan data santri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_hashed = password_hash($password, PASSWORD_DEFAULT);

  // Query untuk memasukkan data santri
  $query = "INSERT INTO santri (nama, alamat, email, password) VALUES ('$nama', '$alamat', '$email', '$password_hashed')";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Santri berhasil ditambahkan!'); window.location='manage_santri.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan santri.');</script>";
  }
}
?>

<div class="container py-5">
  <h2>Tambah Santri Baru</h2>
  <form action="add_santri.php" method="POST">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
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
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
