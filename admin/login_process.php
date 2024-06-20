<?php
session_start();
include("../inc/inc_koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Menggunakan MD5 untuk menyamakan dengan yang ada di database

    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: home.php");
    } else {
        echo "<script>alert('Username atau password salah');window.location='login.php';</script>";
    }

    $stmt->close();
}
