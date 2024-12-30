<?php
// Pastikan koneksi database
include '../config/database.php';

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil tanggal dari input
$tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
$filterQuery = "";

if (!empty($tanggal)) {
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

// Header untuk CSV
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=absensi_" . date("Ymd_His") . ".csv");
$output = fopen("php://output", "w");

// Tulis header CSV
fputcsv($output, ['Nama Siswa', 'Tanggal', 'Status Absensi', 'Alasan']);

// Tulis data absensi ke CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        htmlspecialchars($row['username']),
        htmlspecialchars($row['tanggal']),
        htmlspecialchars($row['status']),
        htmlspecialchars($row['alasan'] ?: '-')
    ]);
}

fclose($output);
exit();
?>
