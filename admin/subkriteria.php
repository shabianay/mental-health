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
                    <h1 class="h3 mb-2 text-gray-800">Detail Perhitungan Sub-Kriteria</h1>
                    <p class="mb-4">Detail perhitungan AHP untuk menentukan hasil skrining kesehatan mental berdasarkan kriteria, subkriteria dan alternatif yang telah ditentukan.</p>
                    <!-- Gejala Kognitif -->
                    <h5 class="mb-3 mt-5 font-weight-bold text-primary">Kriteria Gejala Kognitif</h5>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Matriks Penjumlahan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sub-Kriteria</th>
                                            <td>Kesulitan Konsentrasi</td>
                                            <td>Kehilangan Daya Ingat</td>
                                            <td>Kesulitan dalam Pengambilan Keputusan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kesulitan Konsentrasi</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Kehilangan Daya Ingat</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Kesulitan dalam Pengambilan Keputusan</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah</th>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                        </tr>
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
                                            <th>Sub-Kriteria</th>
                                            <th colspan='3' style="text-align: center;">Nilai Eigen</th>
                                            <th>Jumlah</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kesulitan Konsentrasi</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Kehilangan Daya Ingat</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Kesulitan dalam Pengambilan Keputusan</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <th colspan='4' style="text-align: center;">Matriks Ternormalisasi</th>
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
                                            <td>3</td>
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
                    <!-- Gejala cemas-depresi -->
                    <h5 class="mb-3 mt-5 font-weight-bold text-primary">Kriteria Gejala cemas-depresi</h5>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Matriks Penjumlahan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sub-Kriteria</th>
                                            <td>Perasaan Gelisah</td>
                                            <td>Perasaan Sedih yang Berkepanjangan</td>
                                            <td>Gangguan Tidur</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Perasaan Gelisah</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Perasaan Sedih yang Berkepanjangan</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Gangguan Tidur</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah</th>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                        </tr>
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
                                            <th>Sub-Kriteria</th>
                                            <th colspan='3' style="text-align: center;">Nilai Eigen</th>
                                            <th>Jumlah</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Perasaan Gelisah</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Perasaan Sedih yang Berkepanjangan</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Gangguan Tidur</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <th colspan='4' style="text-align: center;">Matriks Ternormalisasi</th>
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
                                            <td>3</td>
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
                    <!-- Gejala somatik -->
                    <h5 class="mb-3 mt-5 font-weight-bold text-primary">Kriteria Gejala somatik</h5>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Matriks Penjumlahan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sub-Kriteria</th>
                                            <td>Sakit Kepala</td>
                                            <td>Gangguan Pencernaan</td>
                                            <td>Nyeri Tubuh</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sakit Kepala</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Gangguan Pencernaan</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Nyeri Tubuh</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah</th>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                        </tr>
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
                                            <th>Sub-Kriteria</th>
                                            <th colspan='3' style="text-align: center;">Nilai Eigen</th>
                                            <th>Jumlah</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sakit Kepala</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Gangguan Pencernaan</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Nyeri Tubuh</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <th colspan='4' style="text-align: center;">Matriks Ternormalisasi</th>
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
                                            <td>3</td>
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
                    <!-- Gejala penurunan energi-->
                    <h5 class="mb-3 mt-5 font-weight-bold text-primary">Kriteria Gejala Penurunan Energi</h5>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Matriks Penjumlahan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sub-Kriteria</th>
                                            <td>Kelelahan yang Berkelanjutan</td>
                                            <td>Kurangnya Motivasi</td>
                                            <td>Kurangnya Energi untuk Aktivitas Sehari-hari</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kelelahan yang Berkelanjutan</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Kurangnya Motivasi</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td>Kurangnya Energi untuk Aktivitas Sehari-hari</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah</th>
                                            <td>3</td>
                                            <td>3</td>
                                            <td>3</td>
                                        </tr>
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
                                            <th>Sub-Kriteria</th>
                                            <th colspan='3' style="text-align: center;">Nilai Eigen</th>
                                            <th>Jumlah</th>
                                            <th>Rata-rata</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Kelelahan yang Berkelanjutan</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Kurangnya Motivasi</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <td>Kurangnya Energi untuk Aktivitas Sehari-hari</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>0.333</td>
                                            <td>1</td>
                                            <td>0.333</td>
                                        </tr>
                                        <tr>
                                            <th colspan='4' style="text-align: center;">Matriks Ternormalisasi</th>
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
                                            <td>3</td>
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