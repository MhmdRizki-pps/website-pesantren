<?php
session_start();
include '../config.php';
include '../includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Ambil data pendaftaran dengan status diterima
$query = "SELECT * FROM pendaftaran WHERE status = 'diterima'";
$result = mysqli_query($conn, $query);
?>

<div class="container py-5">
  <h2>Hasil Seleksi Santri</h2>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Status</th>
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
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
