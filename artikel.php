<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}
require_once "koneksi.php";

// Inisialisasi variabel
$title = "";
$content = "";
$image_path = "";

// Jika tombol "Submit" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $title = $_POST["title"];
    $content = $_POST["content"];

    // Ambil informasi file gambar
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $image_path = "uploads/" . $image_name;

    // Periksa ukuran file gambar (maksimal 2MB)
    if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran file gambar melebihi batas maksimal (2MB).');</script>";
    } else {
        // Pindahkan file gambar ke folder uploads
        move_uploaded_file($image_tmp, $image_path);

        // Query untuk menyimpan artikel ke database
        $query = "INSERT INTO articles (title, content, image_path) VALUES ('$title', '$content', '$image_path')";
        $result = mysqli_query($koneksi, $query);

        // Jika query berhasil dijalankan
        if ($result) {
            echo "<script>alert('Artikel berhasil ditambahkan');</script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
                <?php
                require_once('topbar_admin.php')
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Halaman Artikel</h1>
                    <!-- Tombol untuk membuat artikel baru -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addArticleModal">
                        Tambah Artikel Baru
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addArticleModalLabel">Tambah Artikel Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Isi formulir untuk menambahkan artikel -->
                                    <form method="post" action="artikel.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Isi</label>
                                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Gambar (maksimal 2MB)</label>
                                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required maxlength="2097152">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <a href="buat_artikel.php" class="btn btn-primary mb-3">Buat Artikel Baru</a> -->
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
                        echo "<div class='card shadow mb-4'>";
                        echo "<div class='card-header py-3'>";
                        echo "<h6 class='m-0 font-weight-bold text-primary'>";
                        echo "Data Artikel";
                        echo "</h6>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>No</th>";
                        echo "<th>Judul</th>";
                        echo "<th>Isi</th>";
                        echo "<th>Gambar</th>";
                        echo "<th>Dibuat</th>";
                        echo "<th>Diperbarui</th>";
                        echo "<th>Aksi</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $counter = 1; // Inisialisasi counter
                        // Loop through the result set and display the articles
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['content'] . "</td>";
                            echo "<td><img src='" . $row['image_path'] . "' alt='Article Image' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>" . $row['updated_at'] . "</td>";
                            echo "<td style='text-align: center'>";
                            echo "<a href='edit_artikel.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                            echo "&nbsp;";
                            echo "<a href='hapus_artikel.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                            $counter++; // Tingkatkan counter setelah setiap baris
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>"; // This closes the div for the DataTables Example

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
                <!-- Footer -->
                <?php
                require_once('footer.php')
                ?>
                <!-- End of Footer -->
            </div>
            <!-- End of Main Content -->

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