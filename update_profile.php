<?php
// Lakukan koneksi ke database

// Ambil data dari form
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password']; 
$phoneNumber = $_POST['phoneNumber'];
$angkatan = $_POST['angkatan'];

// Redirect ke halaman profil setelah update berhasil
header("Location: profile.php");
exit();
