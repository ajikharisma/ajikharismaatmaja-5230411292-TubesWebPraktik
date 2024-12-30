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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto Galeri</title>

    <!-- Tambahkan CSS di sini -->
    <style>
        /* Gaya untuk upload container */
        .upload-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .upload-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Tombol Submit */
        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 12px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Pesan sukses dan error */
        .success {
            color: #28a745;
            font-weight: bold;
            margin-top: 10px;
        }

        .error {
            color: #dc3545;
            font-weight: bold;
            margin-top: 10px;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .upload-container {
                padding: 15px;
                width: 90%;
            }

            .form-group input[type="text"],
            .form-group input[type="file"],
            button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Upload Foto Galeri -->
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
</body>
</html>
