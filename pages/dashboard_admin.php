<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
include '../config.php';
include '../includes/header.php';
?>

<div class="container py-5">
  <h2 class="mb-4">Dashboard Admin</h2>

  <div class="mb-3">
    <a href="pendaftaran.php" class="btn btn-success">+ Tambah Pendaftaran</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="table-primary">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Status Seleksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $result = mysqli_query($conn, "SELECT * FROM santri");
      while ($row = mysqli_fetch_assoc($result)):
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $row['nama'] ?></td>
          <td><?= $row['tempat_lahir'] . ', ' . $row['tanggal_lahir'] ?></td>
          <td><?= $row['alamat'] ?></td>
          <td><?= $row['status_seleksi'] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
