<?php
session_start();          // Mula sesi
session_unset();          // Kosongkan semua data dalam $_SESSION
session_destroy();        // Hapuskan sesi sepenuhnya
header("Location: login.php"); // Alihkan ke halaman login
exit();
?>
