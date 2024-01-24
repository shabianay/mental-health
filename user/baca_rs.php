<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: ../login.php");
    exit(); // Stop further execution
}

// Check if the full name is set in the session
if (isset($_SESSION['namaLengkap'])) {
    $namaLengkap = $_SESSION['namaLengkap'];
} else {
    // Handle if the full name is not set in the session
    $namaLengkap = "Nama Lengkap Tidak Tersedia";
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
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        require_once('../include/navbar_user.php')
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                require_once('../include/topbar_user.php')
                ?>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 style="text-align: center" class="h2 mb-4 text-gray-800">Daftar Data Rumah Sakit</h1>
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
                                echo "<div class='col-md-4'>";
                                echo "<div class='card hospital-card'>";
                                echo "<img src='" . $row['image_path'] . "' class='card-img-top' alt='Gambar Rumah Sakit'>";
                                echo "<div class='card-body'>";
                                echo "<h5 class='card-title'>" . $row['name'] . "</h5>";
                                echo "<p class='card-text'>Alamat: " . $row['address'] . "</p>";
                                echo "<p class='card-text'>Telepon: " . $row['phone'] . "</p>";
                                echo "<p class='card-text'>Email: " . $row['email'] . "</p>";
                                echo "<p class='card-text'>Website: " . $row['website'] . "</p>";
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
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            require_once('../include/footer.php')
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
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