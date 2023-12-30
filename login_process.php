<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi ke database
    include "koneksi.php";

    // Ambil nilai dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan email dan password
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dijalankan dan data ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        // Data ditemukan, ambil informasi user
        $user = mysqli_fetch_assoc($result);

        // Set session untuk user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        // Periksa apakah user adalah admin
        if ($user['role'] == 'admin') {
            $_SESSION['is_admin'] = true;
            // Redirect ke halaman admin_dashboard.php jika user adalah admin
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Redirect ke halaman user_dashboard.php jika user bukan admin
            header("Location: user_dashboard.php");
            exit();
        }
    } else {
        // Data tidak ditemukan, beri pesan error
        $error_message = "Email atau password salah. Silakan coba lagi.";
    }

    // Tutup koneksi ke database
    mysqli_close($koneksi);
}
