<?php
include '../auth.php';
checkRole('admin');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin TK</title>
    <link rel="stylesheet" href="../assets/admin_dashboard.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>TK Negeri Kota Baru</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="?page=lihatSiswa"><i class="fas fa-users"></i> Lihat Siswa</a></li>
                    <li><a href="?page=lihatAbsensi"><i class="fas fa-calendar-check"></i> Rekap Presensi</a></li>
                    <li><a href="?page=uploadFoto"><i class="fas fa-upload"></i> Upload Foto</a></li>
                    <li><a href="?page=buatInformasi"><i class="fas fa-bullhorn"></i> Buat Informasi Kegiatan</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <header>
                <h1>Dashboard Admin</h1>
                <div class="user-info">
                    <span>Welcome, Admin</span>
                    <a href="../logout.php" class="sign-out"><i class="fas fa-sign-out-alt"></i> Log out</a>
                </div>
            </header>

            <main>
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    switch ($page) {
                        case 'lihatSiswa':
                            include 'lihat_siswa.php';
                            break;
                        case 'lihatAbsensi':
                            include 'rekap_absensi.php';
                            break;
                        case 'uploadFoto':
                            include 'upload_foto.php';
                            break;
                        case 'buatInformasi':
                            include 'buat_informasi.php';
                            break;
                        default:
                            echo "<p>Halaman tidak ditemukan.</p>";
                            break;
                    }
                } else {
                    echo "<p>Selamat datang di Dashboard Admin TK. Pilih menu di samping untuk melanjutkan.</p>";
                }
                ?>
            </main>
        </div>
    </div>
</body>
</html>