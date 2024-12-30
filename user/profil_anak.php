<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Mulai sesi hanya jika belum dimulai
}
include '../config/database.php';

// Periksa apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php'); // Arahkan ke halaman login jika belum login
    exit();
}

// Ambil username yang sedang login
$username = $_SESSION['username'];

// Query untuk mengambil data profil anak berdasarkan username
$query = "SELECT nama_siswa, tanggal_lahir, nama_orangtua, no_telepon, alamat, foto 
          FROM siswa 
          WHERE nama_siswa = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Jika data tidak ditemukan, tampilkan pesan
if (!$data) {
    echo "<p>Data profil anak tidak ditemukan.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Anak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .kepala {
            text-align: center;
            margin-bottom: 30px;
            background:  #007BFF;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .kepala h1 {
            margin: 0;
            font-size: 1.8em;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .profile {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .profile img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            border: 3px solid #4a90e2;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-info th, .profile-info td {
            text-align: left;
            padding: 8px;
        }

        .profile-info th {
            width: 40%;
            color: #555;
        }

        .profile-info td {
            font-weight: bold;
            color: #333;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 600px) {
            .profile {
                flex-direction: column;
                text-align: center;
            }
            .profile img {
                margin-bottom: 20px;
            }
            .profile-info table {
                margin-top: 10px;
            }
            .kepala h1 {
                font-size: 1.5em;
            }
            .container {
                margin: 20px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="kepala">
            <h1>Profil Anak</h1>
        </div>

        <div class="profile">
            <img src="../uploads/foto_siswa<?= htmlspecialchars($data['foto']) ?>" alt="Foto Siswa">
            <div class="profile-info">
                <table>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td><?= htmlspecialchars($data['nama_siswa']) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?= htmlspecialchars($data['tanggal_lahir']) ?></td>
                    </tr>
                    <tr>
                        <th>Nama Orang Tua/Wali</th>
                        <td><?= htmlspecialchars($data['nama_orangtua']) ?></td>
                    </tr>
                    <tr>
                        <th>Nomor Telepon</th>
                        <td><?= htmlspecialchars($data['no_telepon']) ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= htmlspecialchars($data['alamat']) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>