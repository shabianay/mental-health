<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}
require_once "koneksi.php";

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
}
$user = mysqli_fetch_assoc($result);

// Tangani permintaan perubahan informasi pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $namaLengkap = $_POST['Namalengkap'];
    $newEmail = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $password = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];

    // Periksa apakah email baru sudah terdaftar dalam database
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$newEmail' AND id != $user_id"; // Pastikan tidak memeriksa email pengguna yang sedang diedit
    $checkEmailResult = mysqli_query($koneksi, $checkEmailQuery);
    if (!$checkEmailResult) {
        // Error saat memeriksa email dalam database
        die("Query error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($checkEmailResult) > 0) {
        // Email baru sudah terdaftar, tampilkan pesan kesalahan
        $pesan = "Email sudah terdaftar. Gunakan email lain.";
    } else {
        // Email baru belum terdaftar, lanjutkan dengan pembaruan profil
        // Perbarui informasi pengguna dalam database
        if (!empty($newPassword)) {
            // Jika newPassword diisi, update password
            $updateQuery = "UPDATE users SET Namalengkap = '$namaLengkap', email = '$newEmail', password = '$newPassword', phoneNumber = '$phoneNumber' WHERE id = $user_id";
        } else {
            // Jika newPassword tidak diisi, jangan update password
            $updateQuery = "UPDATE users SET Namalengkap = '$namaLengkap', email = '$newEmail', phoneNumber = '$phoneNumber' WHERE id = $user_id";
        }

        $updateResult = mysqli_query($koneksi, $updateQuery);
        if (!$updateResult) {
            // Error saat memperbarui data dalam database
            die("Update error: " . mysqli_error($koneksi));
        }

        // Redirect kembali ke halaman profil dengan pesan sukses
        header("Location: profile.php?success=1");
        exit();
    }
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

    <title>Dashboard Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"></nav>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Update Profile</h1>
                    <?php if (isset($_GET['success'])) : ?>
                        <div class="alert alert-success" role="alert">
                            Profile updated successfully!
                        </div>
                    <?php endif; ?>
                    <!-- Form for updating profile -->
                    <form method="post" action="profile.php">
                        <!-- Input fields for updating profile -->
                        <div class="form-group">
                            <label for="Namalengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="Namalengkap" name="Namalengkap" value="<?php echo $user['Namalengkap']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="********" disabled />
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" pattern="(?=.*\d).{8,}" />
                            <span class="text-muted">Password harus terdiri dari minimal 8 karakter dan mengandung angka.</span>
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10,}" value="<?php echo $user['phoneNumber']; ?>" required />
                            <span class="text-muted">Nomor HP harus terdiri dari minimal 10 angka.</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                    <!-- Button to go back to user_dashboard.php -->
                    <a href="user_dashboard.php" class="btn btn-secondary mt-3">Balik ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>