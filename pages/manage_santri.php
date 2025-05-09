<?php
session_start();
include '../config.php';
include '../includes/header.php';

// Pastikan hanya admin yang dapat mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
  header("Location: dashboard.php");
  exit;
}

// Ambil data santri dari database
$query = "SELECT * FROM santri";
$result = mysqli_query($conn, $query);
?>

<div class="container py-5">
  <h2>Pengelolaan Santri</h2>
  <a href="add_santri.php" class="btn btn-success mb-3">Tambah Santri Baru</a>

  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      while ($santri = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$santri['nama']}</td>
                <td>{$santri['alamat']}</td>
                <td>{$santri['email']}</td>
                <td>
                  <a href='edit_santri.php?id={$santri['id']}' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='delete_santri.php?id={$santri['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>Hapus</a>
                </td>
              </tr>";
        $no++;
      }
      ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
