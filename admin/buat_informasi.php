<?php

// Koneksi ke database
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_acara = mysqli_real_escape_string($conn, $_POST['nama_acara']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    // Validasi data
    if (empty($nama_acara) || empty($tanggal) || empty($keterangan)) {
        $message = "Semua kolom wajib diisi.";
    } else {
        // Simpan ke database
        $query = "INSERT INTO jadwal_kegiatan (nama_acara, tanggal, keterangan) VALUES ('$nama_acara', '$tanggal', '$keterangan')";
        if (mysqli_query($conn, $query)) {
            $message = "Informasi kegiatan berhasil disimpan.";
        } else {
            $message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Informasi Kegiatan</title>
    <link rel="stylesheet" href="../assets/admin_dashboard.css">
</head>
<body>
    <div class="form-container">
        <h2>Buat Informasi Kegiatan</h2>
        <?php if (!empty($message)): ?>
            <p class="message"> <?= $message; ?> </p>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="nama_acara">Nama Acara</label>
                <input type="text" id="nama_acara" name="nama_acara" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Simpan Informasi</button>
            </div>
        </form>
    </div>
</body>
</html>
