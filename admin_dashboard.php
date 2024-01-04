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

// Lakukan koneksi ke database
include 'koneksi.php';

// Query untuk mengambil jumlah pengguna dari database (misalnya dari tabel 'users')
$query = "SELECT COUNT(*) AS total_pengguna FROM users";
$result = mysqli_query($koneksi, $query);

if ($result) {
  // Jika query berhasil, ambil hasilnya
  $row = mysqli_fetch_assoc($result);
  $total_pengguna = $row['total_pengguna'];
} else {
  // Jika query gagal, atur jumlah pengguna menjadi 0 atau tampilkan pesan kesalahan
  $total_pengguna = 0;
  echo "Error: " . mysqli_error($koneksi);
}

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
          <h1 class="h3 mb-4 text-gray-800">Halo, Selamat Datang Admin</h1>
          <div class="row">
            <!-- Pengguna -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Jumlah Pengguna
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php echo number_format($total_pengguna); ?> <!-- Tampilkan jumlah pengguna dengan format ribuan -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i> <!-- Ganti ikon dengan ikon pengguna -->
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Soal -->
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="col-xl-3 col-md-6 mb-4">
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
            <div class="card-body">
              <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="...">
              <p>
                Aplikasi mental health ini adalah...
              </p>
            </div>
          </div>
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
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>