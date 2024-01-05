<?php
require_once "koneksi.php";

// Periksa apakah ada parameter ID rumah sakit yang dikirimkan melalui URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitasi ID rumah sakit yang dikirimkan melalui URL
    $hospital_id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk menghapus rumah sakit berdasarkan ID
    $deleteQuery = "DELETE FROM hospitals WHERE id = $hospital_id";
    $deleteResult = mysqli_query($koneksi, $deleteQuery);

    if ($deleteResult) {
        // Jika penghapusan berhasil, redirect ke halaman daftar rumah sakit dengan pesan sukses
        header("Location: rumahsakit.php?success=delete");
        exit();
    } else {
        // Jika terjadi kesalahan saat menghapus rumah sakit, tampilkan pesan kesalahan
        echo "Error: " . $deleteQuery . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika tidak ada parameter ID rumah sakit yang dikirimkan melalui URL, redirect ke halaman daftar rumah sakit
    header("Location: rumahsakit.php");
    exit();
}

// Tutup koneksi ke database
mysqli_close($koneksi);
