<?php
$host = "localhost"; // Host database
$user = "root"; // Username database
$password = ""; // Password database
$database = "platform"; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
