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

// Proses kemaskini data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari borang
    $jeniskenderaan = $conn->real_escape_string($_POST['jeniskenderaan']);
    $namapemandu = $conn->real_escape_string($_POST['namapemandu']);
    $noplatkenderaan = $conn->real_escape_string($_POST['noplatkenderaan']);
    $catatan = $conn->real_escape_string($_POST['catatan']);

    // Kemaskini rekod dalam pangkalan data
    $sql_update = "UPDATE kenderaan 
                   SET jeniskenderaan = ?, namapemandu = ?, noplatkenderaan = ?, catatan = ? 
                   WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssi", $jeniskenderaan, $namapemandu, $noplatkenderaan, $catatan, $id);

    if ($stmt_update->execute()) {
        // Jika kemaskini berjaya, alihkan ke halaman view.php
        header("Location: view.php?id=$id");
        exit();
    } else {
        echo "Error: " . $stmt_update->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kemaskini Kenderaan</title>
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

        .back-button, .save-button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button:hover, .save-button:hover {
            opacity: 0.9;
        }

        .container {
            padding: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Kemaskini Kenderaan</div>
        <div class="buttons">
            <a href="view.php?id=<?php echo $vehicle['id']; ?>" class="back-button">Back</a>
        </div>
    </div>

    <div class="container">
        <?php if ($vehicle): ?>
            <form action="edit.php?id=<?php echo $vehicle['id']; ?>" method="POST">
                <label for="jenis_kenderaan">Jenis Kenderaan:</label>
                <input type="text" id="jenis_kenderaan" name="jeniskenderaan" value="<?php echo htmlspecialchars($vehicle['jeniskenderaan']); ?>" required>

                <label for="nama_pemandu">Nama Pemandu:</label>
                <input type="text" id="nama_pemandu" name="namapemandu" value="<?php echo htmlspecialchars($vehicle['namapemandu']); ?>" required>

                <label for="noplatkenderaan">Pilih Plat Kenderaan:</label>
                <input type="text" id="noplatkenderaan" name="noplatkenderaan" value="<?php echo htmlspecialchars($vehicle['noplatkenderaan']); ?>" required>

                <label for="tujuan">Tujuan Menggunakan Kenderaan:</label>
                <textarea id="tujuan" name="catatan"><?php echo htmlspecialchars($vehicle['catatan']); ?></textarea>

                <button type="submit" class="save-button">Update</button>
            </form>
        <?php else: ?>
            <p>Kenderaan tidak ditemui.</p>
        <?php endif; ?>
    </div>
</body>
</html>
