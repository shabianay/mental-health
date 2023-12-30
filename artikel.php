<?php
session_start();
// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika tidak, redirect ke halaman login
    header("Location: login.php");
    exit();
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
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        include('navbar_admin.php')
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                include('topbar_admin.php')
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Buat Artikel</h1>
                    <!-- Tombol untuk membuat artikel baru -->
                    <a href="buat_artikel.php" class="btn btn-primary mb-3">Buat Artikel Baru</a>
                    <?php
                    // Include the database connection file
                    include "koneksi.php";
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'delete') {
                            // If the value is 'delete', display a success message
                            echo '<div class="alert alert-success" role="alert">Artikel berhasil dihapus.</div>';
                        }
                    }
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === '1') {
                            // If the value is '1', display a success message
                            echo '<div class="alert alert-success" role="alert">Artikel berhasil diperbarui.</div>';
                        }
                    }
                    // Query to retrieve articles from the database
                    $query = "SELECT * FROM articles";
                    $result = mysqli_query($koneksi, $query);
                    // Check if the query was successful
                    if ($result) {
                        // Display the table headers
                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Judul</th>";
                        echo "<th>Isi</th>";
                        echo "<th>Gambar</th>";
                        echo "<th>Dibuat</th>";
                        echo "<th>Diperbarui</th>";
                        echo "<th>Edit</th>";
                        echo "<th>Hapus</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        // Loop through the result set and display the articles
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['content'] . "</td>";
                            echo "<td><img src='" . $row['image_path'] . "' alt='Article Image' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>" . $row['updated_at'] . "</td>";
                            echo "<td><a href='edit_artikel.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a></td>"; // Tombol edit dengan link ke halaman edit_artikel.php dengan parameter id artikel
                            echo "<td><a href='hapus_artikel.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus</a></td>"; // Tombol hapus dengan link ke halaman hapus_artikel.php dengan parameter id artikel
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free the result set
                        mysqli_free_result($result);
                    } else {
                        // If the query was not successful, display an error message
                        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                    }
                    // Close the database connection
                    mysqli_close($koneksi);
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include('footer.php')
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

    <!-- Logout Modal-->
    <?php
    include('logout.php')
    ?>

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