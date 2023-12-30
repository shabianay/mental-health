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

    <title>Rumah Sakit</title>

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
                    <h1 class="h3 mb-2 text-gray-800">Daftar Rumah Sakit</h1>
                    <!-- Tombol untuk membuat rs baru -->
                    <a href="buat_rs.php" class="btn btn-primary mb-3">Tambah Data Baru</a>
                    <?php
                    include_once "koneksi.php";

                    if (isset($_GET['success'])) {
                        if ($_GET['success'] === 'delete') {
                            echo '<div class="alert alert-success" role="alert">Rumah Sakit berhasil dihapus.</div>';
                        } elseif ($_GET['success'] === 'edit') {
                            echo '<div class="alert alert-success" role="alert">Rumah Sakit berhasil diperbarui.</div>';
                        } elseif ($_GET['success'] === 'add') {
                            echo '<div class="alert alert-success" role="alert">Rumah Sakit berhasil ditambahkan.</div>';
                        }
                    }

                    $query = "SELECT * FROM hospitals";
                    $result = mysqli_query($koneksi, $query);

                    if ($result) {
                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Nama</th>";
                        echo "<th>Alamat</th>";
                        echo "<th>Telepon</th>";
                        echo "<th>Email</th>";
                        echo "<th>Website</th>";
                        echo "<th>Gambar</th>";
                        echo "<th>Dibuat</th>";
                        echo "<th>Diperbarui</th>";
                        echo "<th>Edit</th>";
                        echo "<th>Hapus</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['website'] . "</td>";
                            echo "<td><img src='" . $row['image_path'] . "' alt='Rumah Sakit Image' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>" . $row['updated_at'] . "</td>";
                            echo "<td><a href='edit_rs.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a></td>";
                            echo "<td><a href='hapus_rs.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus</a></td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";

                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                    }

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