<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "login";

// Membuat koneksi
$conn = new mysqli($server, $username, $password, $db);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>