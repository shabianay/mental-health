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

if ($_SESSION['role'] == 'admin') {
    header("Location: ../admin/admin_dashboard.php");
    exit();
}

// Check if the full name is set in the session
if (isset($_SESSION['namaLengkap'])) {
    $namaLengkap = $_SESSION['namaLengkap'];
} else {
    // Handle if the full name is not set in the session
    $namaLengkap = "Nama Lengkap Tidak Tersedia";
}

// Lakukan koneksi ke database
require_once '../include/koneksi.php';
// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
}
$user = mysqli_fetch_assoc($result);
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
        <?php
        require_once('../include/navbar_user.php')
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once('../include/topbar_user.php')
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Rumah Sakit</h1>
                    <div class="button-nearby">
                        <a href="https://www.google.com/maps/search/?api=1&query=psikolog+dan+psikiater&query_place_id=current+location" class="btn btn-primary mb-3"><i class="mr-3 fa-solid fa-magnifying-glass"></i>Cari psikolog disekitarmu</a>
                    </div>
                    <div class="row" id="hospitalList">
                        <?php
                        require_once "../include/koneksi.php";

                        // Query untuk mengambil semua data rumah sakit
                        $query = "SELECT * FROM hospitals";
                        $result = mysqli_query($koneksi, $query);

                        // Periksa apakah query berhasil
                        if ($result) {
                            // Tampilkan data rumah sakit dalam bentuk card
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='col-xl-4 mb-4'>";
                                echo "<div class='card hospital-card'>";
                                echo "<img src='" . $row['image_path'] . "' class='card-img-top' alt='Gambar Rumah Sakit'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title text-primary font-weight-bold'>" . $row['name'] . "</h5>";
                                echo "<p class='card-text'><i class='fa-solid fa-location-dot mr-3'></i>" . $row['address'] . "</p>";
                                echo "<p class='card-text'><i class='fa-solid fa-phone mr-3'></i>" . $row['phone'] . "</p>";
                                echo "<p class='card-text'><i class='fa-solid fa-globe mr-3'></i><a href='" . $row['website'] . "' target='_blank' onclick='window.open(\"" . $row['website'] . "\", \"_blank\")'>" . $row['website'] . "</a></p>";
                                echo "<p class='card-text mt-3'><button onclick='window.open(\"" . $row['maps'] . "\", \"_blank\")' class='btn btn-primary'><i class='fa-solid fa-location-arrow mr-3'></i>Mulai Rute</button></p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                        } else {
                            // Jika query gagal, tampilkan pesan error
                            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                        }

                        // Tutup koneksi ke database
                        mysqli_close($koneksi);
                        ?>
                    </div>
                </div>
            </div>
            <?php
            require_once('../include/footer.php')
            ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>