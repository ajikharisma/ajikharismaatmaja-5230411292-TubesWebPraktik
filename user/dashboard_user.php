<?php
include '../auth.php';
checkRole('user');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard TK Negeri Kota Baru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .header {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        .menu-toggle {
            display: none;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        .sidebar {
            width: 250px;
            background-color: #f1f1f1;
            height: 100vh;
            position: fixed;
            top: 50px;
            left: 0;
            padding-top: 20px;
            transition: transform 0.3s ease;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 10px 15px;
            text-decoration: none;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: blue;
            color: white;
        }

        .main {
            margin-left: 250px;
            margin-top: 60px;
            padding: 20px;
        }

        .card {
            background-color: #f9f9f9;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: blue;
            color: white;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout {
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                height: calc(100% - 50px);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
                margin-top: 50px;
            }

            .menu-toggle {
                display: block;
            }

            .header .logo {
                display: none;
            }

            .footer {
                font-size: 14px;
                padding: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <button class="menu-toggle" onclick="toggleSidebar()">&#9776;</button>
        <div class="logo">TK Negeri Kota Baru</div>
        <div class="user">
            Selamat datang, Wali Murid!
            <a href="../logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="sidebar">
        <a href="?page=profilAnak">Profil Anak</a>
        <a href="?page=absensiAnak">Absensi Anak</a>
        <a href="?page=lihatInformasi">Lihat Informasi</a>
        <a href="?page=tambahFoto">Tambah Foto</a>
    </div>

    <div class="main">
        <h1>Selamat Datang di Dashboard TK Negeri Kota Baru</h1>
        <div class="card">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {
                    case 'profilAnak':
                        include 'profil_anak.php';
                        break;
                    case 'absensiAnak':
                        include 'absensi_anak.php';
                        break;
                    case 'lihatInformasi':
                        include 'lihat_informasi.php';
                        break;
                    case 'tambahFoto':
                        include 'tambah_foto.php';
                        break;
                    default:
                        echo "<p>Halaman tidak ditemukan.</p>";
                        break;
                }
            } else {
                echo "<p>Selamat datang di Dashboard Wali Murid TK Ceria. Pilih menu di samping untuk melanjutkan.</p>";
            }
            ?>
        </div>
    </div>

    <div class="footer">
        &copy; 2024 TK NEGERI KOTABARU | TK TERBAIK
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
</body>
</html>
