<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit;
}

include '../config.php';
include '../includes/header.php';

// Ambil ID santri yang akan diubah status seleksinya
if (isset($_GET['id'])) {
  $id_santri = $_GET['id'];

  // Ambil data santri berdasarkan ID
  $query = "SELECT * FROM santri WHERE id = '$id_santri'";
  $result = mysqli_query($conn, $query);
  $santri = mysqli_fetch_assoc($result);

  if (!$santri) {
    echo "<script>alert('Santri tidak ditemukan.'); window.location='hasil_seleksi.php';</script>";
    exit;
  }

  // Proses update status seleksi
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status_seleksi = $_POST['status_seleksi'];

    // Update status seleksi santri
    $update_query = "UPDATE santri SET status_seleksi = '$status_seleksi' WHERE id = '$id_santri'";
    if (mysqli_query($conn, $update_query)) {
      echo "<script>alert('Status seleksi berhasil diubah!'); window.location='hasil_seleksi.php';</script>";
    } else {
      echo "<script>alert('Gagal mengubah status seleksi!');</script>";
    }
  }
} else {
  header("Location: hasil_seleksi.php");
  exit;
}

?>

<div class="container py-5">
  <h2>Ubah Status Seleksi Santri</h2>
  <form action="update_seleksi.php?id=<?= $santri['id']; ?>" method="POST">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Santri</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?= $santri['nama']; ?>" disabled>
    </div>
    <div class="mb-3">
      <label for="status_seleksi" class="form-label">Status Seleksi</label>
      <select class="form-control" id="status_seleksi" name="status_seleksi">
        <option value="Belum Diseleksi" <?= $santri['status_seleksi'] == 'Belum Diseleksi' ? 'selected' : ''; ?>>Belum Diseleksi</option>
        <option value="Lolos" <?= $santri['status_seleksi'] == 'Lolos' ? 'selected' : ''; ?>>Lolos</option>
        <option value="Tidak Lolos" <?= $santri['status_seleksi'] == 'Tidak Lolos' ? 'selected' : ''; ?>>Tidak Lolos</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
