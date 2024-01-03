<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}
// Include database connection
include "koneksi.php";

// Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_group"])) {
    $name = $_POST["name"];
    $normalWeight = $_POST["normal_weight"];
    $perbatasanWeight = $_POST["perbatasan_weight"];
    $abnormalWeight = $_POST["abnormal_weight"];

    $query = "INSERT INTO `soal_group` (`name`, `normal_weight`, `perbatasan_weight`, `abnormal_weight`) 
                  VALUES ('$name', '$normalWeight', '$perbatasanWeight', '$abnormalWeight')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Soal group created successfully');</script>";
    } else {
        echo "Error creating soal group: " . mysqli_error($koneksi);
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

    <title>Buat Soal Group</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('navbar_admin.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('topbar_admin.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Buat Soal Group</h1>
                    <form method="post" action="buat_soal_group.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nama grup soal:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="normla_weight">Normal Weight: (desimal)</label>
                            <input type="number" class="form-control" id="normal_weight" name="normal_weight" step="0.01" min="0" value="1.0" required>
                        </div>
                        <div class="form-group">
                            <label for="perbatasan_weight">Perbatasan Weight: (desimal)</label>
                            <input type="number" class="form-control" id="perbatasan_weight" name="perbatasan_weight" step="0.01" min="0" value="1.0" required>
                        </div>
                        <div class="form-group">
                            <label for="abnormal_weight">Abnormal Weight: (desimal)</label>
                            <input type="number" class="form-control" id="abnormal_weight" name="abnormal_weight" step="0.01" min="0" value="1.0" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_group">Buat Soal Grup</button>
                        <a href="soal_group.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('footer.php') ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include('logout.php') ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>