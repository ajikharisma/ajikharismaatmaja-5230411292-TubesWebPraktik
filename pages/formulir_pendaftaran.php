<?php
include '../config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    /* Body styling */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    }

    /* Form container */
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Heading */
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    /* Label styling */
    label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 8px;
    }

    /* Input and textarea styling */
    input[type="text"],
    input[type="date"],
    input[type="file"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        background-color: #f9f9f9;
    }

    input[type="file"] {
        padding: 5px;
    }

    /* Button styling */
    button {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #3498db;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2980b9;
    }

    /* Responsive design */
    @media (max-width: 600px) {
        form {
            width: 90%;
        }
    }
    </style>


</head>
<body>
    <h2>Formulir Pendaftaran</h2>
    <form action="proses_pendaftaran.php" method="post" enctype="multipart/form-data">
        <label for="nama_siswa">Nama Lengkap:</label>
        <input type="text" name="nama_siswa" required><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" required><br>

        <label for="nama_orangtua">Nama Orang Tua/Wali:</label>
        <input type="text" name="nama_orangtua" required><br>

        <label for="no_telepon">Nomor Telepon:</label>
        <input type="text" name="no_telepon" required><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea><br>

        <label for="foto">Unggah Foto Siswa:</label>
        <input type="file" name="foto" id="foto" accept="image/*" required><br>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>


