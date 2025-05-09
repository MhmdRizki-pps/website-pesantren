<?php
session_start();         // Mulai session
session_unset();         // Hapus semua variabel session
session_destroy();       // Hancurkan session

// Arahkan kembali ke halaman utama
header("Location: index.php");
exit;
