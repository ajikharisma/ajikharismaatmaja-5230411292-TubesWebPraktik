<?php
include '../config/database.php'; // Menghubungkan dengan database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap data dari formulir
    $nama_siswa = $_POST['nama_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nama_orangtua = $_POST['nama_orangtua'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    // Proses unggah foto
    $foto = $_FILES['foto'];
    $foto_name = $foto['name'];
    $foto_tmp_name = $foto['tmp_name'];
    $foto_error = $foto['error'];

    // Menentukan lokasi upload
    $upload_dir = '../uploads/foto_siswa';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $foto_path = $upload_dir . basename($foto_name);

    // Memeriksa apakah ada error pada foto yang diunggah
    if ($foto_error === 0) {
        if (move_uploaded_file($foto_tmp_name, $foto_path)) {
            // Menyimpan data ke database
            $query = "INSERT INTO siswa (nama_siswa, tanggal_lahir, nama_orangtua, no_telepon, alamat, foto)
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $nama_siswa, $tanggal_lahir, $nama_orangtua, $no_telepon, $alamat, $foto_name);

            if ($stmt->execute()) {
                echo "Pendaftaran berhasil!";
                header("Location: sukses.php"); // Ganti dengan halaman sukses
                exit;
            } else {
                echo "Gagal menyimpan data.";
            }
        } else {
            echo "Gagal mengunggah foto.";
        }
    } else {
        echo "Ada masalah dengan file foto.";
    }
}
?>
