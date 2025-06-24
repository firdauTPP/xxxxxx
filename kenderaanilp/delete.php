<?php
// Mulakan sesi untuk menyimpan pemberitahuan
session_start();

// Sambungan ke database
$conn = new mysqli('localhost', 'root', '', 'kenderaanilp');

// Periksa sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dapatkan ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Query untuk memadamkan rekod berdasarkan ID
    $sql = "DELETE FROM kenderaan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Jika berjaya, simpan mesej pemberitahuan dan alihkan ke halaman utama (index)
        $_SESSION['message'] = "Rekod berjaya dipadam.";
        $_SESSION['message_type'] = "success"; // jenis mesej: success
    } else {
        // Jika gagal, simpan mesej pemberitahuan dan alihkan ke halaman utama
        $_SESSION['message'] = "Gagal memadamkan rekod.";
        $_SESSION['message_type'] = "error"; // jenis mesej: error
    }
} else {
    $_SESSION['message'] = "ID tidak sah.";
    $_SESSION['message_type'] = "error"; // jenis mesej: error
}

$conn->close();

// Alihkan semula ke halaman utama
header("Location: index.php");
exit();
?>
