<?php
session_start();

// Cek apakah user sudah login dan apakah rolenya sesuai
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: ../" . $_SESSION['role'] . "/index.php");
    exit();
}

echo "<h1>Welcome, Pengguna!!</h1>";
echo "<a href='../inc/logout.php'>Logout</a>";

?>