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

if ($_SESSION['role'] == 'admin') {
  header("Location: ../admin/admin_dashboard.php");
  exit();
}

// Lakukan koneksi ke database
require_once '../include/koneksi.php';

// Query untuk mengambil jumlah soal dari database 
$query = "SELECT COUNT(*) AS total_soal FROM questions";
$result = mysqli_query($koneksi, $query);

if ($result) {
  // Jika query berhasil, ambil hasilnya
  $row = mysqli_fetch_assoc($result);
  $total_soal = $row['total_soal'];
} else {
  // Jika query gagal, atur jumlah soal menjadi 0 atau tampilkan pesan kesalahan
  $total_soal = 0;
  echo "Error: " . mysqli_error($koneksi);
}

// Query untuk mengambil jumlah artikel dari database 
$query = "SELECT COUNT(*) AS total_artikel FROM articles";
$result = mysqli_query($koneksi, $query);

if ($result) {
  // Jika query berhasil, ambil hasilnya
  $row = mysqli_fetch_assoc($result);
  $total_artikel = $row['total_artikel'];
} else {
  // Jika query gagal, atur jumlah artikel menjadi 0 atau tampilkan pesan kesalahan
  $total_artikel = 0;
  echo "Error: " . mysqli_error($koneksi);
}

// Query untuk mengambil jumlah rs dari database 
$query = "SELECT COUNT(*) AS total_rs FROM hospitals";
$result = mysqli_query($koneksi, $query);

if ($result) {
  // Jika query berhasil, ambil hasilnya
  $row = mysqli_fetch_assoc($result);
  $total_rs = $row['total_rs'];
} else {
  // Jika query gagal, atur jumlah rs menjadi 0 atau tampilkan pesan kesalahan
  $total_rs = 0;
  echo "Error: " . mysqli_error($koneksi);
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

  <title>Dashboard User</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php
    require_once('../include/navbar_user.php')
    ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php
        require_once('../include/topbar_user.php')
        ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="row">
            <!-- Soal -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Jumlah Soal
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo number_format($total_soal); ?> <!-- Tampilkan jumlah soal dengan format ribuan -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tasks fa-2x text-gray-300"></i> <!-- Ganti ikon dengan ikon yang sesuai -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Artikel -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Jumlah Artikel
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo number_format($total_artikel); ?> <!-- Tampilkan jumlah soal dengan format ribuan -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Rumah Sakit -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Jumlah Rumah Sakit
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo number_format($total_rs); ?> <!-- Tampilkan jumlah soal dengan format ribuan -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hospital fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                <i class="mr-2 fas fa-info fa-1x text-gray-500"></i>
                Informasi
              </h6>
            </div>
            <div class="information" style="text-align:center">
              <h1 class="mt-4 h4 text-gray-800 font-weight-bold">Selamat Datang</h1>
              <h1 class="h5 mb-4 text-white badge bg-success">
                <?php echo $user['Namalengkap']; ?>
              </h1> Sebagai
              <h1 class="h5 mb-4 text-white badge bg-success">
                <?php echo $user['role']; ?>
              </h1>
            </div>
            <div class="card-body">
              <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="../img/undraw_posting_photo.svg" alt="...">
              <p>
                Aplikasi MINDFUL ini adalah aplikasi yang dapat membantu kamu untuk skrining (Tahap Awal) mengetahui kesehatan mental. Jika ingin mendalami lebih lanjut tentang kesehatan mental kamu dapat menghubungi psikolog/psikiater atau juga dapat menghubungi SMCC UNESA, & kamu bisa membaca artikel yang telah kami sediakan. Selain itu, kamu juga bisa mencari rumah sakit terdekat yang bisa membantu kamu dalam menangani masalah kesehatan mental. Selamat menggunakan aplikasi MINDFUL! </p>
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
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>