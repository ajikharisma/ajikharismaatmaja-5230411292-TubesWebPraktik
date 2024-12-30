<?php
include '../config/database.php';

// Cek apakah ID siswa diterima dari parameter URL
if (isset($_GET['id'])) {
    $siswaId = $_GET['id'];

    // Query untuk mengambil data siswa berdasarkan ID
    $query = "SELECT id, nama_siswa, tanggal_lahir, nama_orangtua, no_telepon, alamat FROM siswa WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $siswaId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $siswa = $result->fetch_assoc();
    } else {
        die("Siswa tidak ditemukan.");
    }
} else {
    die("ID siswa tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_siswa = $_POST['nama_siswa'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $nama_orangtua = $_POST['nama_orangtua'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    // Query untuk mengupdate data siswa
    $query = "UPDATE siswa SET nama_siswa = ?, tanggal_lahir = ?, nama_orangtua = ?, no_telepon = ?, alamat = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $nama_siswa, $tanggal_lahir, $nama_orangtua, $no_telepon, $alamat, $siswaId);

    if ($stmt->execute()) {
        echo "Data siswa berhasil diupdate!";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            margin-top: 5px;
        }
    </style>
</head>
<body>

<h1>Edit Data Siswa <?= htmlspecialchars($siswa['nama_siswa']) ?></h1>

<form method="POST">
    <div class="form-group">
        <label for="nama_siswa">Nama Siswa</label>
        <input type="text" id="nama_siswa" name="nama_siswa" value="<?= htmlspecialchars($siswa['nama_siswa']) ?>" required>
    </div>

    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($siswa['tanggal_lahir']) ?>" required>
    </div>

    <div class="form-group">
        <label for="nama_orangtua">Nama Orang Tua/Wali</label>
        <input type="text" id="nama_orangtua" name="nama_orangtua" value="<?= htmlspecialchars($siswa['nama_orangtua']) ?>" required>
    </div>

    <div class="form-group">
        <label for="no_telepon">Nomor Telepon</label>
        <input type="text" id="no_telepon" name="no_telepon" value="<?= htmlspecialchars($siswa['no_telepon']) ?>" required>
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" id="alamat" name="alamat" value="<?= htmlspecialchars($siswa['alamat']) ?>" required>
    </div>

    <button type="submit">Simpan Perubahan</button>
</form>

</body>
</html>
