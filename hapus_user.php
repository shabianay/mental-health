<?php
require_once "./include/koneksi.php";

// Pastikan id pengguna tersedia dalam parameter URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Query untuk menghapus pengguna berdasarkan id
    $deleteQuery = "DELETE FROM users WHERE id = $userId";
    $deleteResult = mysqli_query($koneksi, $deleteQuery);

    // Periksa apakah pengguna berhasil dihapus
    if ($deleteResult) {
        header("Location: ./admin/pengguna.php?success=delete");
        exit();
    } else {
        echo "Error: " . $deleteQuery . "<br>" . mysqli_error($koneksi);
    }
} else {
    header("Location: ./admin/pengguna.php");
    exit();
}
// Tutup koneksi ke database
mysqli_close($koneksi);
