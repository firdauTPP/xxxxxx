<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'kenderaanilp');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errMsg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE userid = ? AND password = SHA2(?, 256)");
    $stmt->bind_param("ss", $userid, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['login_user'] = $userid;
        header("Location: index.php");
        exit();
    } else {
        $errMsg = "User ID atau kata laluan salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Kenderaan</title>
    <style>
        body { font-family: Arial; background: #f4f4f9; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .login-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px; }
        .login-box h2 { margin-bottom: 20px; text-align: center; }
        .login-box input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
        .login-box button { width: 100%; padding: 10px; background: #2c3e50; color: white; border: none; border-radius: 5px; }
        .error { color: red; font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <form class="login-box" method="POST" action="login.php">
        <h2>Login Pengguna</h2>
        <?php if ($errMsg): ?><p class="error"><?php echo $errMsg; ?></p><?php endif; ?>
        <input type="text" name="userid" placeholder="User ID" required>
        <input type="password" name="password" placeholder="Kata Laluan" required>
        <button type="submit">Log Masuk</button>
    </form>
</body>
</html>
