<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
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
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Mental Health</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="admin_dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item collapsed <?php echo basename($_SERVER['PHP_SELF']) === 'soal.php' || basename($_SERVER['PHP_SELF']) === 'soal_group.php' ? 'active' : ''; ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSoal" aria-expanded="true" aria-controls="collapseSoal">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Soal</span>
                </a>
                <div id="collapseSoal" class="collapse" aria-labelledby="headingSoal" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="soal.php">Soal</a>
                        <a class="collapse-item" href="soal_group.php">Kategori Soal</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'artikel.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="artikel.php">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Artikel</span></a>
            </li>

            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'rumahsakit.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="rumahsakit.php">
                    <i class="fas fa-fw fa-hospital"></i>
                    <span>Rumah Sakit</span></a>
            </li>

            <!-- Nav Item - Data Pengguna -->
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'pengguna.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="pengguna.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pengguna</span></a>
            </li>

            <!-- Nav Item - Laporan -->
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="laporan.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Laporan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block" />

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600"></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Buat Artikel</h1>
                    <!-- Tombol untuk membuat artikel baru -->
                    <a href="buat_artikel.php" class="btn btn-primary mb-3">Buat Artikel Baru</a>
                    <?php
                    require_once "koneksi.php";
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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2023</span>
                    </div>
                </div>
            </footer>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get all the navigation links
            var navLinks = document.querySelectorAll('.nav-link');

            // Add click event listeners to each link
            navLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    // Remove the "active" class from all links
                    navLinks.forEach(function(navLink) {
                        navLink.classList.remove('active');
                    });

                    // Add the "active" class to the clicked link
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>

</html>