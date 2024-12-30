<?php
include '../config/database.php'; // Koneksi ke database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['id']) || $_SESSION['id'] == NULL) {
    header("Location: ../login.php"); // Jika belum login, arahkan ke login
    exit();
}

$id_user = $_SESSION['id']; // Mengambil ID pengguna dari sesi
$tanggal = date('Y-m-d'); // Mendapatkan tanggal hari ini

// Menampilkan pesan jika ada di session
if (isset($_SESSION['message'])) {
    echo "<div class='notification'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Anak</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f8;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h3 {
            text-align: center;
            color: #4a90e2;
            margin-bottom: 20px;
        }

        /* Notification Box */
        .notification {
            background-color: #dff0d8;
            color: #3c763d;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #d6e9c6;
            border-radius: 5px;
            text-align: center;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        select, textarea, input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 1em;
            width: 100%;
        }

        textarea {
            resize: none;
        }

        /* Button Styling */
        button {
            background-color: #4a90e2;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #357ab8;
        }

        /* Hidden Section Styling */
        #alasanDiv {
            transition: all 0.3s ease-in-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Judul Absensi -->
        <h3>Absensi Anda</h3>

        <!-- Form Absensi -->
        <form action="proses_absensi_anak.php" method="POST">
            <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">

            <label for="status">Status Absensi:</label>
            <select name="status" id="status" onchange="toggleAlasan()">
                <option value="Hadir">Hadir</option>
                <option value="Sakit">Sakit</option>
                <option value="Izin">Izin</option>
            </select>

            <div id="alasanDiv" style="display:none;">
                <label for="alasan">Alasan:</label>
                <textarea name="alasan" id="alasan" rows="4" placeholder="Jelaskan alasan Anda..."></textarea>
            </div>

            <button type="submit">Kirim Absensi</button>
        </form>
    </div>

    <!-- Script untuk Tampilkan Alasan -->
    <script>
        function toggleAlasan() {
            var status = document.getElementById('status').value;
            if (status === 'Sakit' || status === 'Izin') {
                document.getElementById('alasanDiv').style.display = 'block';
            } else {
                document.getElementById('alasanDiv').style.display = 'none';
            }
        }
    </script>
</body>
</html>
