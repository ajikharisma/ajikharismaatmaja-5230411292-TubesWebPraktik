<?php
session_start(); // WAJIB ada di awal
function checkRole($role) {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: ../login.php");
        exit();
    }
    // Tambahkan logika untuk mengecek role jika diperlukan
}
?>
