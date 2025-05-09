<?php
$host = "localhost";
$user = "root";        // default di XAMPP
$pass = "";            // default kosong di XAMPP
$db   = "pesantren_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
