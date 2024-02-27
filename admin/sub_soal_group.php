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
$retrieveQuery = "SELECT * FROM `subkriteria`";
$retrieveResult = mysqli_query($koneksi, $retrieveQuery);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $subkriteria = $_POST['subkriteria'];
    $nilai = $_POST['nilai'];

    // Check if subkriteria is not empty
    if (!empty($subkriteria)) {
        // Insert data into the database
        $insertQuery = "INSERT INTO subkriteria (subkriteria, nilai) VALUES (?, ?)";
        $stmt = mysqli_prepare($koneksi, $insertQuery);
        mysqli_stmt_bind_param($stmt, "ss", $subkriteria, $nilai);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data berhasil ditambahkan.");</script>';
        } else {
            echo "Error creating soal: " . mysqli_error($koneksi);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo '<script>alert("Sub-Kriteria tidak boleh kosong.");</script>';
    }
}


// Include file koneksi ke database
require_once "../include/koneksi.php";

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
        <?php
        require_once('../include/navbar_admin.php')
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                require_once('../include/topbar_admin.php')
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Halaman Sub Kriteria</h1>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSubkriteriaModal"><i class="fa-solid fa-plus mr-2"></i>
                        Tambah Sub-Kriteria
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="addSubkriteriaModal" tabindex="-1" role="dialog" aria-labelledby="addSubkriteriaModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addSubkriteriaModalLabel">Tambah Sub-Kriteria Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Isi formulir untuk menambahkan artikel -->
                                    <form method="post" action="sub_soal_group.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="subkriteria">Sub-Kriteria</label>
                                            <input type="text" class="form-control" id="subkriteria" name="subkriteria" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nilai">Nilai</label>
                                            <input type="number" class="form-control" id="nilai" name="nilai" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Tambah Sub-Kriteria</button>
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
                            echo '<div class="alert alert-success" role="alert">
                            Sub Group Soal berhasil dihapus.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                        }
                    }
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'update') {
                            // If the value is 'update', display a success message
                            echo '<div class="alert alert-success" role="alert">
                            Sub Group Soal berhasil diperbarui.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button></div>';
                        }
                    }
                    ?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Sub Kriteria</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sub-Kriteria</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once "../include/koneksi.php";
                                        // Query untuk mengambil data pengguna dari database
                                        $query = "SELECT * FROM subkriteria";
                                        $result = mysqli_query($koneksi, $query);
                                        // Jika query berhasil dijalankan
                                        if ($result) {
                                            $counter = 1; // Inisialisasi counter
                                            // Tampilkan data pengguna ke dalam tabel HTML
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Output data from each row into table cells
                                                echo "<tr>";
                                                echo "<td>" . $counter . "</td>";
                                                echo "<td>" . $row['subkriteria'] . "</td>";
                                                echo "<td>" . $row['nilai'] . "</td>";
                                                echo "<td style='text-align: center'>";
                                                echo "<a href='edit_sub_soal_group.php?id=" . $row['id_subkriteria'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                                                echo "&nbsp;"; // Add a non-breaking space here for spacing
                                                echo "<a href='../hapus_sub_soal_group.php?id=" . $row['id_subkriteria'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $counter++; // Tingkatkan counter setelah setiap baris
                                            }
                                            // Free result set
                                            mysqli_free_result($result);
                                        } else {
                                            // Jika query gagal dijalankan
                                            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                                        }

                                        // Tutup koneksi ke database
                                        mysqli_close($koneksi);
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once('../include/footer.php')
            ?>
        </div>
    </div>

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