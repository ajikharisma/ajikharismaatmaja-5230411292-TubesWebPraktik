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
        /body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between; /* Membuat elemen di header terpisah antara kiri dan kanan */
            align-items: center;
        }
        .header .logo {
            font-size: 20px;
            font-weight: bold;
        }
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
        .action-btns {
            display: flex;
            gap: 10px;
        }
        .action-btns a {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: blue;
            border-radius: 5px;
            text-align: center;
        }
        .action-btns a.delete {
            background-color: red;
        }
        .create-account-btn {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: green;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

<div class="main">
    <h1>Lihat Siswa</h1>

    <!-- Tombol Buatkan Akun di atas tabel -->
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
            // Query untuk mengambil data siswa
            $query = "SELECT id, nama_siswa, tanggal_lahir, nama_orangtua, no_telepon, alamat FROM siswa";
            $result = $conn->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) :
            ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                <td><?= htmlspecialchars($row['nama_orangtua']) ?></td>
                <td><?= htmlspecialchars($row['no_telepon']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td class="action-btns">
                    <!-- Tombol Edit -->
                    <a href="edit_siswa.php?id=<?= $row['id'] ?>">Edit</a>
                    <!-- Tombol Hapus -->
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

