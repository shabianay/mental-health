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
$retrieveQuery = "SELECT * FROM `questions`";
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
    <title>Soal</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Daftar Soal</h1>
                    <!-- Tombol untuk membuat artikel baru -->
                    <a href="buat_soal.php" class="btn btn-primary mb-3">Buat Soal</a>
                    <!-- Display existing questions -->
                    <?php
                    // Include the database connection file
                    include "koneksi.php";
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'delete') {
                            // If the value is 'delete', display a success message
                            echo '<div class="alert alert-success" role="alert">Soal berhasil dihapus.</div>';
                        }
                    }
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'update') {
                            // If the value is 'update', display a success message
                            echo '<div class="alert alert-success" role="alert">Soal berhasil diperbarui.</div>';
                        }
                    }
                    ?>
                    <table class="table">
                        <!-- Table headers -->
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Soal</th>
                                <th>Grup Soal</th>
                                <th>Dibuat</th>
                                <th>Diperbarui</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Query to retrieve articles from the database
                            $query = "SELECT * FROM questions";
                            $result = mysqli_query($koneksi, $query);
                            // Loop through the retrieved data and display it in a table
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id_soal'] . "</td>";
                                echo "<td>" . $row['question_text'] . "</td>";
                                echo "<td>" . $row['question_group_id'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['updated_at'] . "</td>";
                                echo "<td><a href='edit_soal.php?id=" . $row['id_soal'] . "' class='btn btn-primary btn-sm'>Edit</a></td>";
                                echo "<td><a href='hapus_soal.php?id=" . $row['id_soal'] . "' class='btn btn-danger btn-sm'>Hapus</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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