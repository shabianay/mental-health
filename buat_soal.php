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
    include "koneksi.php";

    // Retrieve question groups from the database
    $retrieveQuery = "SELECT id, name FROM soal_group";
    $retrieveResult = mysqli_query($koneksi, $retrieveQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Manage Questions</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Buat Soal</h1>
                    <!-- Form to add new questions -->
                    <form method="post" action="process_add_question.php">
                        <div class="form-group">
                            <label for="questionText">Question Text</label>
                            <textarea class="form-control" id="questionText" name="questionText" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="questionGroup">Question Group</label>
                            <select class="form-control" id="questionGroup" name="questionGroup" required>
                                <option value="">Select a Question Group</option>
                                <?php
                                    while ($row = mysqli_fetch_assoc($retrieveResult)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="nilaiA">Nilai A</label>
                                <input type="number" class="form-control" id="nilaiA" name="nilaiA" required>
                            </div>
                            <div class="form-group">
                                <label for="nilaiB">Nilai B</label>
                                <input type="number" class="form-control" id="nilaiB" name="nilaiB" required>
                            </div>
                            <div class="form-group">
                                <label for="nilaiC">Nilai C</label>
                                <input type="number" class="form-control" id="nilaiC" name="nilaiC" required>
                            </div>
                            <div class="form-group">
                                <label for="opsiA">Opsi A</label>
                                <input type="text" class="form-control" id="opsiA" name="opsiA" required>
                            </div>
                            <div class="form-group">
                                <label for="opsiB">Opsi B</label>
                                <input type="text" class="form-control" id="opsiB" name="opsiB" required>
                            </div>
                            <div class="form-group">
                                <label for="opsiC">Opsi C</label>
                                <input type="text" class="form-control" id="opsiC" name="opsiC" required>
                            </div>
                        <button type="submit" class="btn btn-primary">Tambah Soal</button>
                        <a href="soal.php" class="btn btn-secondary">Kembali</a>
                    </form>
                    <hr>
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
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
