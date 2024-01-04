<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
    <style>
        .alert-danger {
            text-align: center;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #2b52c5;
            /* Set background color */
        }
    </style>
</head>
<form class="user" method="post" action="login_process.php">
    <!-- ... (rest of your form elements) ... -->
    <!-- Display error message if exists -->
    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger error-message" role="alert">
            <?php echo $error_message; ?>
            <br>
            <a href="login.php" class="btn btn-primary">Kembali ke Halaman Login</a>
        </div>
    <?php endif; ?>
    <!-- ... (rest of your form elements) ... -->
</form>

</html>