<?php
session_start();
include '../config.php';
include '../includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Ambil ID santri yang akan diedit
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM santri WHERE id = '$id' LIMIT 1";
  $result = mysqli_query($conn, $query);
  $santri = mysqli_fetch_assoc($result);

  if (!$santri) {
    echo "<script>alert('Santri tidak ditemukan.'); window.location='manage_santri.php';</script>";
  }
}

// Proses update data santri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];

  // Query untuk memperbarui data santri
  $update_query = "UPDATE santri SET nama = '$nama', alamat = '$alamat', email = '$email' WHERE id = '$id'";
  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Data santri berhasil diperbarui!'); window.location='manage_santri.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui data santri.');</script>";
  }
}
?>

<div class="container py-5">
  <h2>Edit Data Santri</h2>
  <form action="edit_santri.php?id=<?= $santri['id']; ?>" method="POST">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?= $santri['nama']; ?>" required>
    </div>

    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $santri['alamat']; ?></textarea>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= $santri['email']; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
