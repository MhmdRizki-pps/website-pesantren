<?php
session_start();
include '../config.php';

// Pastikan santri yang sudah login dapat mengakses halaman ini
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data profil santri
$query = "SELECT * FROM pendaftaran WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$santri = mysqli_fetch_assoc($result);

// Proses perubahan profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $telepon = $_POST['telepon'];

  // Update profil santri
  $update_query = "UPDATE pendaftaran SET nama='$nama', alamat='$alamat', email='$email', telepon='$telepon' WHERE id='$user_id'";
  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Profil berhasil diperbarui!'); window.location='edit_profil.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui profil.');</script>";
  }
}
?>

<div class="container py-5">
  <h2>Edit Profil Santri</h2>
  <form action="edit_profil.php" method="POST">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Lengkap</label>
      <input type="text" class="form-control" id="nama" name="nama" value="<?= $santri['nama'] ?>" required>
    </div>

    <div class="mb-3">
      <label for="alamat" class="form-label">Alamat</label>
      <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $santri['alamat'] ?></textarea>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="<?= $santri['email'] ?>" required>
    </div>

    <div class="mb-3">
      <label for="telepon" class="form-label">Nomor Telepon</label>
      <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $santri['telepon'] ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Perbarui Profil</button>
  </form>
</div>

<?php include '../includes/footer.php'; ?>
