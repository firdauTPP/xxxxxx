<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sambungan ke database
    $conn = new mysqli('localhost', 'root', '', 'kenderaanilp');

    // Periksa sambungan
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Dapatkan data dari borang
    $jeniskenderaan = $conn->real_escape_string($_POST['jeniskenderaan']);
    $namapemandu = $conn->real_escape_string($_POST['namapemandu']);
    $noplatkenderaan = $conn->real_escape_string($_POST['noplatkenderaan']);
    $catatan = $conn->real_escape_string($_POST['catatan']);

    // Masukkan data ke dalam jadual
    $sql = "INSERT INTO kenderaan (jeniskenderaan, namapemandu, noplatkenderaan, catatan)
            VALUES ('$jeniskenderaan', '$namapemandu', '$noplatkenderaan', '$catatan')";

    if ($conn->query($sql) === TRUE) {
        // Dapatkan ID kenderaan yang baru ditambah
        $last_id = $conn->insert_id;
        // Alihkan ke halaman view.php untuk melihat rekod
        header("Location: view.php?id=$last_id");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rekod Kenderaan</title>
    <style>
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

        .header button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .header button:hover {
            opacity: 0.9;
        }

        .container {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        button.add {
            background-color: #27ae60;
            color: white;
            font-weight: bold;
        }

        button.add:hover {
            opacity: 0.9;
        }

        /* Notifikasi */
        .notification {
            background-color: #27ae60;
            color: white;
            padding: 10px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            text-align: center;
            font-weight: bold;
            display: none;
            z-index: 999;
        }
    </style>
    <script>
        function showNotification(message) {
            var notification = document.getElementById('notification');
            notification.textContent = message;
            notification.style.display = 'block';
            setTimeout(function() {
                notification.style.display = 'none';
            }, 3000);
        }
    </script>
</head>
<body>
    <div class="notification" id="notification"></div>

    <div class="header">
        <div class="title">Tambah Rekod Kenderaan</div>
        <div class="buttons">
            <button onclick="location.href='index.php'">Back</button>
        </div>
    </div>

    <div class="container">
        <form action="create.php" method="POST">
            <label for="jenis_kenderaan">Jenis Kenderaan:</label>
            <input type="text" id="jenis_kenderaan" name="jeniskenderaan" required>

            <label for="nama_pemandu">Nama Pemandu:</label>
            <input type="text" id="nama_pemandu" name="namapemandu" required>

            <label for="noplatkenderaan">No Plat Kenderaan:</label>
            <input type="text" id="noplatkenderaan" name="noplatkenderaan" required>

            <label for="tujuan">Tujuan Menggunakan Kenderaan:</label>
            <textarea id="tujuan" name="catatan"></textarea>

            <button type="submit" class="add">Add</button>
        </form>
    </div>

</body>
</html>
