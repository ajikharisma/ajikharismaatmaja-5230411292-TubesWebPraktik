<?php
include '../config/database.php';  // Pastikan koneksi database benar

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $siswa_id = $_POST['siswa_id']; // Ambil ID siswa dari form

    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Role default adalah 'user'
    $role = 'user';

    // Query untuk memasukkan data akun baru ke tabel users
    $queryInsertUser = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($queryInsertUser);
    $stmt->bind_param("sss", $username, $hashedPassword, $role);

    if ($stmt->execute()) {
        // Ambil ID user yang baru saja dibuat
        $user_id = $stmt->insert_id;

        // Update tabel siswa untuk menautkan user_id ke siswa
        $queryUpdateSiswa = "UPDATE siswa SET user_id = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($queryUpdateSiswa);
        $stmtUpdate->bind_param("ii", $user_id, $siswa_id);

        if ($stmtUpdate->execute()) {
            echo "Akun berhasil dibuat dan ID user telah terhubung ke siswa!";
        } else {
            echo "Akun berhasil dibuat, tetapi gagal menghubungkan ID user ke siswa: " . $stmtUpdate->error;
        }
    } else {
        echo "Terjadi kesalahan saat membuat akun: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #4A90E2;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            margin-top: 10px;
        }

        select, input[type="text"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        select:focus, input:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }

        button {
            background-color: #4A90E2;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #357ABD;
        }

        .message {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buat Akun Baru</h1>

        <!-- Form untuk membuat akun baru -->
        <form method="POST">
            <label for="siswa_id">Pilih Siswa</label>
            <select id="siswa_id" name="siswa_id" required>
                <option value="">Pilih Siswa</option>
                <?php
                // Ambil daftar siswa tanpa user_id
                $query = "SELECT id, nama_siswa FROM siswa WHERE user_id IS NULL";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['nama_siswa']}</option>";
                }
                ?>
            </select>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Buat Akun</button>
        </form>

        <div class="message">
            Pastikan semua data telah diisi dengan benar.
        </div>
    </div>
</body>
</html>
