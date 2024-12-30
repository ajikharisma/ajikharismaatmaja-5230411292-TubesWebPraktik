<?php
// Pastikan koneksi database
include '../config/database.php';

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel
$tanggal = null;
$filterQuery = "";

// Cek jika ada input tanggal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tanggal']) && !empty($_POST['tanggal'])) {
    $tanggal = $_POST['tanggal'];
    $filterQuery = " WHERE absensi.tanggal = ?";
}

// Query untuk mendapatkan data absensi
$sql = "SELECT absensi.*, users.username 
        FROM absensi 
        INNER JOIN users ON absensi.id_user = users.id";
$sql .= $filterQuery . " ORDER BY absensi.tanggal DESC";

// Siapkan statement
$stmt = $conn->prepare($sql);
if (!empty($tanggal)) {
    $stmt->bind_param('s', $tanggal);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rekap Absensi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .form-container {
            margin: 20px 0;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-export {
            background-color: #007BFF;
        }
        .btn-export:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h3>Rekap Absensi</h3>

    <!-- Form untuk memilih tanggal -->
    <form method="POST" action="" class="form-container">
        <label for="tanggal">Pilih Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>">
        <button type="submit" class="btn">Tampilkan</button>
    </form>

    <!-- Tombol Export ke CSV -->
    <form method="POST" action="export_absensi.php">
        <input type="hidden" name="tanggal" value="<?php echo htmlspecialchars($tanggal); ?>">
        <button type="submit" name="export" class="btn btn-export">Export ke CSV</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Tanggal</th>
                <th>Status Absensi</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['alasan'] ?: '-') . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data absensi.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
