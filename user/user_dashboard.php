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
  <link rel="icon" href="../favicon.ico" type="image/x-icon">

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
          <h2 class="card" style="background-color: #69BE9D; color: white; padding: 25px 50px;">Dashboard</h2>
          <div class="button-nearby">
            <a href="https://www.google.com/maps/search/?api=1&query=psikolog+terdekat&query_place_id=current+location" class="btn btn-primary mb-3"><i class="mr-3 fa-solid fa-magnifying-glass"></i>Cari psikolog disekitarmu</a>
          </div>
          <!-- Content Row -->
          <div class="card shadow mb-4">
            <div class="information" style="text-align:center">
              <h1 class="mt-4 h4 text-gray-800 font-weight-bold">Selamat Datang, <?php echo $user['Namalengkap']; ?></h1>
            </div>
            <div class="card-body" style="text-align:center">
              <p>
                Anda merasa depresi?
                <br>
                Anda merasa cemas?
                <br>
                Anda merasa stres?
                <br>
                Dengan Serenity Anda dapat melakukan deteksi dini mengenai gangguan kesehatan mental yang Anda alami.
              </p>
            </div>
            <div class="card-body text-center">
              <a href="konsul_depresi.php" class="btn btn-primary mb-3 mr-3 mr-md-2">Konsultasi Depresi</a>
              <a href="konsul_kecemasan.php" class="btn btn-primary mb-3 mr-3 mr-md-2">Konsultasi Kecemasan</a>
              <a href="konsul_stres.php" class="btn btn-primary mb-3 mr-3 mr-md-2">Konsultasi Stres</a>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Riwayat</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Hasil</th>
                      <th>Tanggal Tes</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once "../include/koneksi.php";
                    // Query untuk mengambil data pengguna dari database sesuai dengan user_id
                    $query = "SELECT * FROM consultation_results WHERE user_id = $user_id ORDER BY timestamp DESC";
                    $result = mysqli_query($koneksi, $query);

                    if ($result) {
                      $counter = 1; // Inisialisasi counter
                      while ($row = mysqli_fetch_assoc($result)) {
                        $formatted_timestamp = date('d F Y', strtotime($row['timestamp']));

                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row['result_category'] . "</td>";
                        echo "<td>" . $formatted_timestamp . "</td>";
                        echo "<td style='text-align: center;'>";
                        echo "<a href='perhitungan.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Detail</a>";
                        echo "&nbsp;";
                        echo "</td>";
                        echo "</tr>";
                        $counter++; // Tingkatkan counter setelah setiap baris
                      }
                    } else {
                      echo "Error: " . mysqli_error($koneksi);
                    }

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
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- <script>
    $(document).ready(function() {
      // Fetch data from database for the Area Chart
      $.ajax({
        url: 'fetch_area_data.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
          var labels = [];
          var stresData = [];
          var kecemasanData = [];
          var depresiData = [];

          // Extract data from the response
          data.forEach(function(item) {
            labels.push(item.bulan);
            stresData.push(item.stres);
            kecemasanData.push(item.kecemasan);
            depresiData.push(item.depresi);
          });

          // Create the Area Chart
          var ctx = document.getElementById('myAreaChart').getContext('2d');
          var myAreaChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [{
                  label: 'Stres',
                  data: stresData,
                  backgroundColor: 'rgba(78, 115, 223, 0.1)',
                  borderColor: 'rgba(78, 115, 223, 1)',
                  pointRadius: 3,
                  pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                  pointBorderColor: 'rgba(78, 115, 223, 1)',
                  pointHoverRadius: 3,
                  pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                  pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                  fill: 'origin',
                },
                {
                  label: 'Kecemasan',
                  data: kecemasanData,
                  backgroundColor: 'rgba(28, 200, 138, 0.1)',
                  borderColor: 'rgba(28, 200, 138, 1)',
                  pointRadius: 3,
                  pointBackgroundColor: 'rgba(28, 200, 138, 1)',
                  pointBorderColor: 'rgba(28, 200, 138, 1)',
                  pointHoverRadius: 3,
                  pointHoverBackgroundColor: 'rgba(28, 200, 138, 1)',
                  pointHoverBorderColor: 'rgba(28, 200, 138, 1)',
                  fill: 'origin',
                },
                {
                  label: 'Depresi',
                  data: depresiData,
                  backgroundColor: 'rgba(255, 193, 7, 0.1)',
                  borderColor: 'rgba(255, 193, 7, 1)',
                  pointRadius: 3,
                  pointBackgroundColor: 'rgba(255, 193, 7, 1)',
                  pointBorderColor: 'rgba(255, 193, 7, 1)',
                  pointHoverRadius: 3,
                  pointHoverBackgroundColor: 'rgba(255, 193, 7, 1)',
                  pointHoverBorderColor: 'rgba(255, 193, 7, 1)',
                  fill: 'origin',
                },
              ],
            },
            options: {
              maintainAspectRatio: false,
              tooltips: {
                mode: 'index',
                intersect: false,
              },
              hover: {
                mode: 'nearest',
                intersect: true,
              },
              scales: {
                xAxes: [{
                  display: true,
                  scaleLabel: {
                    display: true,
                    labelString: 'Bulan'
                  }
                }],
                yAxes: [{
                  display: true,
                  scaleLabel: {
                    display: true,
                    labelString: 'Jumlah'
                  }
                }]
              },
              legend: {
                display: true,
                position: 'bottom',
              },
            }
          });
        }
      });
    });
  </script> -->
</body>

</html>