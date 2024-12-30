<?php
include 'auth.php';
include 'config/database.php'; // Pastikan ini menginisialisasi koneksi dengan benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true; // Menyimpan status login
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['id'] = $user['id']; // Menyimpan ID pengguna (sesuaikan dengan kolom id)

            // Redirect berdasarkan peran
            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard_admin.php");
            } else {
                header("Location: user/dashboard_user.php");
            }
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #64b5f6, #1e88e5); /* Gradasi Biru */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        form h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #1e88e5;
        }
        form input[type="text"], form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s ease;
        }
        form input[type="text"]:focus, form input[type="password"]:focus {
            border-color: #1e88e5;
        }
        form button {
            background-color: #1e88e5;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #1565c0;
        }
        .btn-secondary {
            margin-top: 10px;
            background-color: #9e9e9e;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #757575;
        }
        form p {
            margin-top: 10px;
            font-size: 0.9em;
            color: red;
        }
        @media (max-width: 600px) {
            form {
                padding: 15px 20px;
            }
            form h2 {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <a href="pages/home.php" class="btn-secondary" style="display: inline-block; text-decoration: none; padding: 10px 20px; text-align: center; border-radius: 5px; background-color:rgb(234, 8, 8); color: white; margin-top: 10px;">Kembali ke Halaman Utama</a>
    </form>
</body>
</html>
