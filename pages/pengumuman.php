<?php
session_start();
include '../config.php';
include '../includes/header.php';

$query = "SELECT * FROM pengumuman ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container py-5">
  <h2>Pengumuman Pesantren</h2>
  <ul class="list-group">
    <?php while ($pengumuman = mysqli_fetch_assoc($result)) { ?>
      <li class="list-group-item">
        <h5><?= $pengumuman['judul'] ?></h5>
        <p><?= $pengumuman['isi'] ?></p>
        <small>Diposting pada: <?= $pengumuman['tanggal'] ?></small>
      </li>
    <?php } ?>
  </ul>
</div>

<?php include '../includes/footer.php'; ?>
