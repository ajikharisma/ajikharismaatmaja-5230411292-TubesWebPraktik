<?php
// Menghubungkan ke database
include 'config/database.php';

// Pastikan koneksi berhasil
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Query untuk mengambil semua foto dari database
$sql = "SELECT * FROM photos ORDER BY uploaded_at DESC";
$result = $conn->query($sql);

// Periksa apakah query berhasil
if (!$result) {
    die("Query gagal: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto</title>
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <style>
        /* Reset dan dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            font-size: 2.5em;
            color: #2c3e50;
        }

        /* Gallery Container */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            margin-top: 40px;
        }

        /* Card Foto */
        .photo {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .photo:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .photo img {
            width: 100%; /* Ukuran lebar penuh */
            height: 200px; /* Tinggi yang konsisten untuk semua gambar */
            object-fit: cover; /* Memastikan gambar dipotong agar sesuai */
            border-radius: 8px;
        }

        .photo p {
            margin-top: 10px;
            color: #555;
        }

        .photo strong {
            font-size: 1.1em;
            color: #333;
        }

        /* Link Kembali */
        .button-container {
            display: flex;
            justify-content: center; /* Memposisikan tombol secara horizontal */
            align-items: center; /* Memposisikan tombol secara vertikal */
            margin-top: 20px;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .back-link:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <h1>Galeri Foto</h1>

    <div class="gallery">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="photo">
                <a href="<?= './' . $row['file_path']; ?>" data-lightbox="galeri" data-title="<?= $row['file_name'] . ' - ' . $row['deskripsi']; ?>">
                    <img src="<?= './' . $row['file_path']; ?>" alt="<?= $row['file_name']; ?>">
                </a>
                <p>Diunggah pada: <?= $row['uploaded_at']; ?></p>
                <p>Deskripsi: <?= $row['deskripsi']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <br>
    <div class="button-container">
        <a href="../sia-sederhana/pages/home.php" class="back-link">Kembali ke Halaman Utama</a>
    </div>

    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>
</html>