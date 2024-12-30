<?php
session_start(); // Mulai session jika belum dimulai
include '../config/database.php'; // Koneksi ke database

// Cek apakah pengguna sudah login dan id ada dalam session
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['id']) || $_SESSION['id'] == NULL) {
    header("Location: ../login.php"); // Jika belum login, arahkan ke login
    exit(); // Jika sesi tidak ada atau id kosong, hentikan proses
}

$id_user = $_SESSION['id']; // Mengambil ID pengguna dari sesi
$tanggal = $_POST['tanggal'];
$status = $_POST['status'];
$alasan = isset($_POST['alasan']) ? $_POST['alasan'] : null; // Alasan hanya ada jika sakit/izin

// Pastikan ID user valid dan tidak kosong
if (empty($id_user) || !is_numeric($id_user)) {
    echo "ID pengguna tidak valid.";
    exit();
}

// Cek apakah absensi sudah diisi hari ini
$sql_check = "SELECT * FROM absensi WHERE id_user = '$id_user' AND tanggal = '$tanggal'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Jika absensi sudah diisi, update status dan alasan
    $sql_update = "UPDATE absensi SET status = '$status', alasan = '$alasan' WHERE id_user = '$id_user' AND tanggal = '$tanggal'";
    if ($conn->query($sql_update)) {
        $_SESSION['message'] = "Absensi berhasil diperbarui."; // Simpan pesan sukses ke dalam session
    } else {
        $_SESSION['message'] = "Gagal memperbarui absensi."; // Simpan pesan error ke dalam session
    }
} else {
    // Jika absensi belum diisi, insert data absensi baru
    $sql_insert = "INSERT INTO absensi (id_user, tanggal, status, alasan) VALUES ('$id_user', '$tanggal', '$status', '$alasan')";
    if ($conn->query($sql_insert)) {
        $_SESSION['message'] = "Absensi berhasil dikirim."; // Simpan pesan sukses ke dalam session
    } else {
        $_SESSION['message'] = "Gagal mengirim absensi."; // Simpan pesan error ke dalam session
    }
}

// Redirect kembali ke halaman absensi agar pesan bisa muncul
header("Location: dashboard_user.php?page=absensiAnak"); // Redirect ke halaman absensi setelah proses selesai
exit();
?>
