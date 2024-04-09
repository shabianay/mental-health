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

$query = "SELECT * FROM soal_group";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
}
$groups = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require_once('../include/navbar_admin.php')
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once('../include/topbar_admin.php')
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Detail Perhitungan Kriteria</h1>
                    <p class="mb-4">Detail perhitungan AHP untuk menentukan hasil skrining kesehatan mental berdasarkan kriteria, subkriteria dan alternatif yang telah ditentukan.</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Matriks Penjumlahan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            <?php foreach ($groups as $group) : ?>
                                                <th><?php echo $group['name']; ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($groups as $group) : ?>
                                            <tr>
                                                <th><?php echo $group['name']; ?></th>
                                                <?php foreach ($groups as $inner_group) : ?>
                                                    <?php if ($group['id'] == $inner_group['id']) : ?>
                                                        <td contenteditable="false">1</td>
                                                    <?php else : ?>
                                                        <td contenteditable="true" data-groupid="<?php echo $group['id']; ?>" data-innergroupid="<?php echo $inner_group['id']; ?>"></td>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menghitung Prioritas Elemen Nilai Eigen dan Vektor Eigen</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            <th colspan='4' style="text-align: center;">Nilai Eigen</th>
                                            <th>Jumlah</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Gejala kognitif</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>1</td>
                                            <td>0.250</td>
                                        </tr>
                                        <tr>
                                            <td>Gejala cemas-depresi</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>1</td>
                                            <td>0.250</td>
                                        </tr>
                                        <tr>
                                            <td>Gejala somatik</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>1</td>
                                            <td>0.250</td>
                                        </tr>
                                        <tr>
                                            <td>Gejala penurunan energi</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>0.250</td>
                                            <td>1</td>
                                            <td>0.250</td>
                                        </tr>
                                        <tr>
                                            <th colspan='5' style="text-align: center;">Matriks Ternormalisasi</th>
                                            <th>Jumlah</th>
                                            <th>1</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Menghitung Rasio Konsistensi Rasio Konsistensi (CR)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td>Lamda Max</td>
                                            <td>4</td>
                                        </tr>
                                        <tr>
                                            <td>CI = (Lamda Max-n)/(n-1)</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>CR = CI/IR</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="text-align: center;">KONSISTEN</td>
                                        </tr>
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
    <a class=" scroll-to-top rounded" href="#page-top">
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

    <!-- Page level custom scripts
    <script src="../js/demo/datatables-demo.js"></script> -->
</body>

</html>