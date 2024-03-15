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

if ($_SESSION['role'] == 'user') {
    header("Location: ../user/user_dashboard.php");
    exit();
}

require_once "../include/koneksi.php";
$retrieveQuery = "SELECT * FROM `soal_group`";
$retrieveResult = mysqli_query($koneksi, $retrieveQuery);

// Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_group"])) {
    $name = $_POST["name"];

    $query = "INSERT INTO `soal_group` (`name`) 
              VALUES ('$name')";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Soal group created successfully');</script>";
    } else {
        echo "Error creating soal group: " . mysqli_error($koneksi);
    }
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_group"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];

    $query = "UPDATE `soal_group` SET `name`='$name' WHERE `id`='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Soal group updated successfully');</script>";
    } else {
        echo "Error updating soal group: " . mysqli_error($koneksi);
    }
}

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

    <title>Dashboard Admin</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once('../include/navbar_admin.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once('../include/topbar_admin.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Halaman Soal Grup</h1>
                    <!-- Tombol untuk membuat artikel baru -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSoalGroupModal"><i class="fa-solid fa-plus mr-2"></i>
                        Tambah Soal Grup
                    </button>
                    <div class="modal fade" id="addSoalGroupModal" tabindex="-1" role="dialog" aria-labelledby="addSoalGroupModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addSoalGroupModalLabel">Tambah Soal Grup</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your form for adding Soal Group here -->
                                    <form method="post" action="soal_group.php" enctype="multipart/form-data">
                                        <!-- Your form fields for adding Soal Group -->
                                        <div class="form-group">
                                            <label for="name">Keterangan: </label>
                                            <input type="text" class="form-control" id="name" name="name" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="create_group">Tambah Soal Grup</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Display existing questions -->
                    <?php
                    require_once "../include/koneksi.php";
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'delete') {
                            // If the value is 'delete', display a success message
                            echo '<div class="alert alert-success" role="alert">Grup Soal berhasil dihapus.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></div>';
                        }
                    }
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'update') {
                            // If the value is 'update', display a success message
                            echo '<div class="alert alert-success" role="alert">Grup Soal berhasil diperbarui.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button></div>';
                        }
                    }
                    // Check if the query was successful
                    if ($retrieveResult) {
                        // Display the table headers
                    ?>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Data Soal Grup
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counter = 1; // Inisialisasi counter
                                            $kriteria = []; // Inisialisasi variabel $kriteria
                                            // Loop through the result set and display the articles
                                            while ($row = mysqli_fetch_assoc($retrieveResult)) {
                                                $kriteria[] = $row['name']; // Tambahkan kriteria ke array $kriteria
                                                echo "<tr>";
                                                echo "<td>" . $counter . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td style='text-align: center'>";
                                                echo "<a href='edit_soal_group.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                                                echo "&nbsp;";
                                                echo "<a href='../hapus_soal_group.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $counter++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    <?php
                        // Free the result set
                        mysqli_free_result($retrieveResult);
                    } else {
                        // If the query was not successful, display an error message
                        echo "Error: " . $retrieveQuery . "<br>" . mysqli_error($koneksi);
                    }
                    // Close the database connection
                    mysqli_close($koneksi);
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <?php require_once('../include/footer.php') ?>
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
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
</body>

</html>