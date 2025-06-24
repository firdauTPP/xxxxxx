<?php
// Sambungan ke database
$conn = new mysqli('localhost', 'root', '', 'kenderaanilp');

// Periksa sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dapatkan ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

$vehicle = null;
if ($id) {
    // Query untuk mendapatkan data berdasarkan ID
    $sql = "SELECT * FROM kenderaan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Bind ID sebagai integer
    $stmt->execute();
    $result = $stmt->get_result();
    $vehicle = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maklumat Kenderaan</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #2c3e50;
            color: white;
        }

        .header .title {
            font-size: 24px;
            font-weight: bold;
        }

        .header .buttons {
            display: flex;
            gap: 10px;
        }

        .back-button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button:hover {
            opacity: 0.9;
        }

        .container {
            padding: 20px;
        }

        .vehicle-info {
            margin-bottom: 20px;
        }

        .vehicle-info label {
            font-weight: bold;
        }

        .vehicle-info p {
            margin: 5px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Keterangan</div>
        <div class="buttons">
            <a href="index.php" class="back-button">Back</a>
        </div>
    </div>

    <div class="container">
        <?php if ($vehicle): ?>
            <div class="vehicle-info">
                <label>Jenis Kenderaan:</label>
                <p><?php echo htmlspecialchars($vehicle['jeniskenderaan'] ?? ''); ?></p>
            </div>
            <div class="vehicle-info">
                <label>Nama Pemandu:</label>
                <p><?php echo htmlspecialchars($vehicle['namapemandu'] ?? ''); ?></p>
            </div>
            <div class="vehicle-info">
                <label>No Plat Kenderaan:</label>
                <p><?php echo htmlspecialchars($vehicle['noplatkenderaan'] ?? ''); ?></p>
            </div>
            <div class="vehicle-info">
                <label>Tujuan Menggunakan Kenderaan:</label>
                <p><?php echo htmlspecialchars($vehicle['catatan'] ?? 'Tiada maklumat'); ?></p>
            </div>
        <?php else: ?>
            <p>Kenderaan tidak ditemui.</p>
        <?php endif; ?>
    </div>
</body>
</html>
