<?php
include '../config/database.php';

// Proses hapus siswa jika ada parameter id
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ambil ID dari parameter URL

    // Query untuk menghapus siswa berdasarkan ID
    $queryDelete = "DELETE FROM siswa WHERE id = ?";
    $stmt = $conn->prepare($queryDelete);
    $stmt->bind_param("i", $id); // Bind parameter ID

    // Eksekusi query dan cek apakah berhasil
    if ($stmt->execute()) {
        echo "<script>alert('Siswa berhasil dihapus!'); window.location.href = 'lihat_siswa.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus siswa: " . $stmt->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        /* .header {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        } */
        .main {
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f1f1f1;
        }
        .action-btns a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            text-align: center;
        }
        .action-btns a.edit {
            background-color: blue;
        }
        .action-btns a.delete {
            background-color: red;
        }
        .create-account-btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px 0;
            text-decoration: none;
            color: white;
            background-color: green;
            border-radius: 5px;
        }
        /* Responsiveness */
        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                display: none;
            }
            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }
            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
                border: none;
                border-bottom: 1px solid #ddd;
            }
            td::before {
                content: attr(data-label);
                font-weight: bold;
            }
        }
    </style>
</head>
<body>

<!-- <div class="header">
    Dashboard Admin
</div> -->

<div class="main">
    <h1>Lihat Siswa</h1>

    <a href="buat_akun.php" class="create-account-btn">Buatkan Akun</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Siswa</th>
                <th>Tanggal Lahir</th>
                <th>Nama Orang Tua/Wali</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT id, nama_siswa, tanggal_lahir, nama_orangtua, no_telepon, alamat FROM siswa";
            $result = $conn->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) :
            ?>
            <tr>
                <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
                <td data-label="Nama Siswa"><?= htmlspecialchars($row['nama_siswa']) ?></td>
                <td data-label="Tanggal Lahir"><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                <td data-label="Orang Tua/Wali"><?= htmlspecialchars($row['nama_orangtua']) ?></td>
                <td data-label="Nomor Telepon"><?= htmlspecialchars($row['no_telepon']) ?></td>
                <td data-label="Alamat"><?= htmlspecialchars($row['alamat']) ?></td>
                <td class="action-btns">
                    <a href="edit_siswa.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                    <a href="lihat_siswa.php?id=<?= $row['id'] ?>" class="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Hapus</a>
                </td>
            </tr>
            <?php
                endwhile;
            } else {
                echo "<tr><td colspan='7'>Tidak ada data siswa.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>