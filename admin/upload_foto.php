<?php
// Menghubungkan ke database
include '../config/database.php';

// Periksa apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['files']['name']) && count($_FILES['files']['name']) > 0) {
        $deskripsi = $_POST['deskripsi'] ?? ''; // Deskripsi opsional
        $target_dir = "uploads/galeri/"; // Pastikan direktori ini ada

        // Iterasi melalui semua file yang diunggah
        foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                $file_name = basename($_FILES['files']['name'][$key]);
                $target_file = $target_dir . $file_name;

                // Pindahkan file ke folder uploads/galeri
                if (move_uploaded_file($tmp_name, "../" . $target_file)) {
                    // Simpan path dan deskripsi ke database
                    $sql = "INSERT INTO photos (file_name, file_path, deskripsi) 
                            VALUES ('$file_name', '$target_file', '$deskripsi')";

                    if (mysqli_query($conn, $sql)) { // Gunakan $conn untuk koneksi
                        echo "<p class='success'>Foto <strong>$file_name</strong> berhasil diunggah!</p>";
                    } else {
                        echo "<p class='error'>Gagal menyimpan foto <strong>$file_name</strong> ke database: " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    echo "<p class='error'>Gagal mengunggah file <strong>$file_name</strong>.</p>";
                }
            }
        }
    } else {
        echo "<p class='error'>Tidak ada file yang diunggah.</p>";
    }
}
?>

<div class="upload-container">
    <h2>Upload Foto Galeri</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="deskripsi">Deskripsi (Opsional):</label>
            <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi untuk semua foto">
        </div>

        <div class="form-group">
            <label for="files">Upload Foto:</label>
            <input type="file" id="files" name="files[]" multiple required>
        </div>

        <button type="submit">Upload Foto</button>
    </form>
</div>
