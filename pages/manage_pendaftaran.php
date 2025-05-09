<?php
session_start();
include '../config.php';
include '../includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Ambil data pendaftaran dari database
$query = "SELECT * FROM pendaftaran";
$result = mysqli_query($conn, $query);
?>

<div class="container py-5">
  <h2>Pengelolaan Pendaftaran Santri</h2>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($pendaftaran = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$pendaftaran['nama']}</td>
                <td>{$pendaftaran['email']}</td>
                <td>{$pendaftaran['status']}</td>
                <td>
                  <a href='update_status.php?id={$pendaftaran['id']}&status=diterima' class='btn btn-success btn-sm'>Terima</a>
                  <a href='update_status.php?id={$pendaftaran['id']}&status=ditolak' class='btn btn-danger btn-sm'>Tolak</a>
                </td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
