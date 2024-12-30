<?php
session_start(); // Memulai sesi untuk menghentikannya
session_destroy(); // Menghapus semua data sesi
header("Location:login.php"); // Redirect ke halaman login
exit;
?>
