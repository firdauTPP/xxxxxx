<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenis Kenderaan Empayar Kolej</title>
    <style>
        /* Styles untuk halaman */
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
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .header button.add {
            background-color: #27ae60;
        }

        .header button:hover {
            opacity: 0.9;
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #34495e;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .action-buttons button.delete {
            background-color: #e74c3c;
        }

        .action-buttons button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Jenis Kenderaan Empayar Kolej</div>
        <div class="buttons">
            <button class="add" onclick="location.href='create.php'">Add</button>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>
    </div>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Kenderaan</th>
                    <th>Nama Pemandu</th>
                    <th>No Plat Kenderaan</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sambungan ke database
                $conn = new mysqli('localhost', 'root', '', 'kenderaanilp');

                // Periksa sambungan
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Ambil data dari jadual
                $sql = "SELECT id, jeniskenderaan, namapemandu, noplatkenderaan FROM kenderaan";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jeniskenderaan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['namapemandu']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['noplatkenderaan']) . "</td>";
                        echo "<td class='action-buttons'>";
                        // Button More Information
                        echo "<button onclick=\"location.href='view.php?id=" . $row['id'] . "'\">More Information</button> ";
                        // Button Update
                        echo "<button onclick=\"location.href='edit.php?id=" . $row['id'] . "'\">Update</button> ";
                        // Button Delete
                        echo "<button class='delete' onclick=\"if(confirm('Are you sure you want to delete this record?')) location.href='delete.php?id=" . $row['id'] . "';\">Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
