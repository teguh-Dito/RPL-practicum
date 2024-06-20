<?php 
$host = "localhost";
$user = "root";
$password = "";
$db = "onlinecourse";

$koneksi = mysqli_connect($host, $user, $password, $db);
$con = mysqli_connect('localhost', 'root', '', 'onlinecourse');

// if($koneksi){
//     echo "Berhasil!";
// }else{
//     die("Gagal Terkoneksi!");
// }