<?php
// Koneksi ke database
require_once '../include/koneksi.php';

// Query untuk mengambil data angkatan dari tabel users
$query = "SELECT angkatan, COUNT(*) as jumlah FROM users GROUP BY angkatan";
$result = mysqli_query($koneksi, $query);

// Buat array untuk menampung data
$data = array();

// Loop untuk menambahkan data ke dalam array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Encode data menjadi format JSON
echo json_encode($data);
