<?php
// Menghubungkan ke database
include '../config/database.php'; // Sudah mendeklarasikan $conn

// Query untuk mengambil 5 foto terakhir dari database
$sql = "SELECT * FROM photos ORDER BY uploaded_at DESC LIMIT 5";
$result = mysqli_query($conn, $sql); // Gunakan $conn yang sudah terhubung
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const scrollElements = document.querySelectorAll(".scroll-effect");

    const elementInView = (el, offset = 100) => {
        const elementTop = el.getBoundingClientRect().top;
        return (
            elementTop <=
            (window.innerHeight || document.documentElement.clientHeight) - offset
        );
    };

    const displayScrollElement = (el) => {
        el.classList.add("show");
    };

    const hideScrollElement = (el) => {
        el.classList.remove("show");
    };

    const handleScrollAnimation = () => {
        scrollElements.forEach((el) => {
            if (elementInView(el, 100)) {
                displayScrollElement(el);
            } else {
                hideScrollElement(el);
            }
        });
    };

    window.addEventListener("scroll", handleScrollAnimation);
    handleScrollAnimation(); // Panggil sekali saat halaman pertama kali dimuat
});
</script>

<body>
    <!-- Header -->
    <header>
        <h1>
            <span class="blue-text">TK Negeri</span> 
            <span class="black-text">Kota Baru</span>
        </h1>
        <a href="../login.php">
            <i class="fas fa-user"></i> Login
        </a>
    </header>


    <!-- Navbar -->
    <nav>
        <div class="menu-toggle" id="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <ul id="nav-menu">
            <li><a href="#home">Home</a></li>
            <li><a href="#visi-misi">Visi Misi Sekolah</a></li>
            <li><a href="#profil-guru">Profil Guru</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="formulir_pendaftaran.php">Pendaftaran</a></li> <!-- Mengarah ke halaman pendaftaran -->
        </ul>
    </nav>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const navMenu = document.getElementById('nav-menu');

        menuToggle.addEventListener('click', function () {
            navMenu.classList.toggle('show');
        });

        // Close menu when a link is clicked
        const navLinks = document.querySelectorAll('#nav-menu a');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navMenu.classList.remove('show');
            });
        });
    </script>

    <!-- Isi Halaman -->
    <!-- Home Section -->
    <section id="home" class="scroll-effect">
        <!-- Elemen Awan -->
        <div class="cloud"></div>
        <div class="cloud"></div>
        <div class="cloud"></div>
        <div class="cloud"></div>
        <div class="cloud"></div>

        <div class="content-container">
            <div class="image-container">
                <img src="../uploads/images/anak tk-home.png" alt="foto anak">
            </div>
            <div class="text-container">
                <h1>Daftarkan Anak Anda</h1>
                <h2>di TK Negeri Kota Baru</h2>
                <p>
                    Kami dengan senang hati mengundang Anda untuk mendaftarkan anak Anda di Taman Kanak-Kanak kami. 
                    Di sini, kami menyediakan lingkungan yang penuh kasih sayang dan stimulasi yang mendukung perkembangan 
                    anak sejak dini. Dengan kurikulum yang dirancang khusus untuk usia dini, anak-anak akan dibimbing untuk belajar, bermain, 
                    dan berkembang dengan cara yang menyenangkan dan mendidik.
                </p>
            </div>
        </div>
    </section>


    <!-- Visi Misi Sekolah Section -->
    <section id="visi-misi" class="scroll-effect">
    <div class="gambar-container">
        <img src="../uploads/images/anak tk-visi misi.png" alt="Anak-anak">
    </div>
    <div class="visi-container">
        <h2>Visi Misi Sekolah</h2>
        <p><strong>Visi:</strong> Terwujudnya Anak yang Kreatif, Berkarakter, Terampil, Sehat, dan Cerdas.</p>
        <p><strong>Misi:</strong></p>
        <ul>
            <li>Membangun anak didik yang memiliki kemampuan yang kreatif, cerdas, dan mudah beradaptasi dengan lingkungan sekitar.</li>
            <li>Memberi layanan pendidikan bagi anak usia dini bagi masyarakat.</li>
            <li>Menumbuhkan rasa tanggung jawab dan kedisiplinan terhadap diri anak.</li>
        </ul>
    </div>
</section>

    <!-- Profil Guru Section -->
    <section id="profil-guru" class="scroll-effect">
    <div class="guru-container">
    <h1>PROFIL GURU</h1>
        <div class="profile-grid">
        <!-- Kepala Sekolah -->
            <div class="profile-card">
                <img src="../uploads/images/kepala sekolah.png" alt="Kepala Sekolah">
                <div class="info">
                <p class="name">EISINAR GRISANG, S.Pd Sd</p>
                <p class="role">KEPALA SEKOLAH</p>
                </div>
            </div>
            </div>

            <div class="profile-grid guru-grid">
            <!-- Guru 1 -->
            <div class="profile-card">
                <img src="../uploads/images/mamak.png" alt="Guru Maryanti">
                <div class="info">
                <p class="name">MARYANTI</p>
                <p class="role">GURU</p>
                </div>
            </div>
            <!-- Guru 2 -->
            <div class="profile-card">
                <img src="../uploads/images/bu siti.png" alt="Guru Siti">
                <div class="info">
                <p class="name">SITI SULASMI S.Pd</p>
                <p class="role">GURU</p>
                </div>
            </div>
            <!-- Guru 3 -->
            <div class="profile-card">
                <img src="../uploads/images/bu linda.png" alt="Guru Linda">
                <div class="info">
                <p class="name">LINDA FENRIANUS S.Pd AUD</p>
                <p class="role">GURU</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri Section -->
    <section id="galeri" class="scroll-effect">
    <div class="galeri-container">
    <h1>Galeri Foto TK Negeri Kota Baru</h1>
        <div class="photo-gallery">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="photo">
                    <img src="../uploads/galeri/<?= $row['file_name']; ?>" alt="<?= $row['file_name']; ?>" width="200">
                    
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Tambahkan div pembungkus untuk tombol -->
        <div class="button-container">
            <a href="../gallery.php">Lihat Selengkapnya</a>
        </div>
    </div>
    </section>


    <!-- Footer -->
    <footer>
        <p>&copy; 2024 TK Negeri Kota Baru. All Rights Reserved.</p>
    </footer>
</body>
</html>