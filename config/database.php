<?php
// Konfigurasi koneksi database
$host = 'localhost';  // Ganti dengan host database Anda
$username = 'root';   // Ganti dengan username database Anda
$password = '';       // Ganti dengan password database Anda
$dbname = 'sia_tk';    // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
