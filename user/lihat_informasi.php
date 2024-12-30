<?php

// Koneksi ke database
include '../config/database.php';

// Ambil data kegiatan dari database
$query = "SELECT * FROM jadwal_kegiatan ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Kegiatan</title>
    <link rel="stylesheet" href="../assets/admin_dashboard.css">
    <style>
        .sidebar {
            background-color: #f1f1f1;
        }

        .header {
            background-color: blue !important;
        }

        .sidebar a:hover {
            background-color: blue;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }

        .event-container {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .event-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .event-container th, .event-container td {
            padding: 10px 15px;
            text-align: left;
        }

        .event-container th {
            background-color: #007BFF;
            color: white;
            text-align: left;
        }

        @media (max-width: 768px) {
            .event-container {
                border: 1px solid #ddd;
                margin-bottom: 20px;
                padding: 10px;
                border-radius: 8px;
            }

            .event-container table {
                width: 100%;
                border: none;
            }

            .event-container th, .event-container td {
                display: block;
                width: 100%;
                padding: 10px 0;
            }

            .event-container th {
                background-color: transparent;
                color: #333;
                font-weight: bold;
            }

            .event-container td {
                border: none;
                padding-left: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="content-container">
        <h2>Informasi Kegiatan</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="event-container">
                    <table>
                        <tr>
                            <th>Nama Acara</th>
                            <td><?= htmlspecialchars($row['nama_acara']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?= htmlspecialchars($row['tanggal']); ?></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td><?= nl2br(htmlspecialchars($row['keterangan'])); ?></td>
                        </tr>
                    </table>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-data">Tidak ada informasi kegiatan yang tersedia.</p>
        <?php endif; ?>
    </div>
</body>
</html>
