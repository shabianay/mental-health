<?php
session_start();

// Set session timeout in seconds (e.g., 30 minutes)
$session_timeout = 1800; // 30 minutes * 60 seconds

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Check the time of the last activity
    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_timeout) {
        // Session has expired, destroy the session and redirect to the login page
        session_unset();
        session_destroy();
        header("Location: ../login.php");
        exit();
    } else {
        // Update the last activity time
        $_SESSION['last_activity'] = time();
    }
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: ../login.php");
    exit();
}
require_once "../include/koneksi.php";

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
    $angkatan = $_POST['angkatan'];
    $gender = $_POST['gender'];

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
            $updateQuery = "UPDATE users SET Namalengkap = '$namaLengkap', email = '$newEmail', password = '$newPassword', phoneNumber = '$phoneNumber', gender = '$gender', angkatan = '$angkatan' WHERE id = $user_id";
        } else {
            // Jika newPassword tidak diisi, jangan update password
            $updateQuery = "UPDATE users SET Namalengkap = '$namaLengkap', email = '$newEmail', phoneNumber = '$phoneNumber', gender = '$gender', angkatan = '$angkatan' WHERE id = $user_id";
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

    <title>Dashboard User</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <?php require_once('../include/navbar_user.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once('../include/topbar_user.php') ?>
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
                        <div class="form-group">
                            <label for="angkatan">Angkatan</label>
                            <select class="form-control" id="angkatan" name="angkatan">
                                <option value="2020" <?php if ($user['angkatan'] == '2020') echo 'selected'; ?>>2020</option>
                                <option value="2021" <?php if ($user['angkatan'] == '2021') echo 'selected'; ?>>2021</option>
                                <option value="2022" <?php if ($user['angkatan'] == '2022') echo 'selected'; ?>>2022</option>
                                <option value="2023" <?php if ($user['angkatan'] == '2023') echo 'selected'; ?>>2023</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="Laki-Laki" <?php if ($user['gender'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if ($user['gender'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-4"><i class="fa-solid fa-rotate mr-2"></i>Perbarui Profil</button>
                        <a href="user_dashboard.php" class="btn btn-secondary mt-3 mb-4"><i class="fa-solid fa-angle-left mr-2"></i> Kembali </a>
                    </form>
                    <!-- Button to go back to user_dashboard.php -->
                </div>
            </div>
            <?php require_once('../include/footer.php') ?>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>