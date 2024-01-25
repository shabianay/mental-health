<?php
session_start();

// Memasukkan file koneksi database
require_once "../include/koneksi.php";

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

// Ambil informasi pengguna dari database
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $query = "SELECT * FROM users WHERE id = $user_id";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
  }
  $user = mysqli_fetch_assoc($result);
} else {
  // Jika user_id tidak tersedia dalam sesi, mungkin ada masalah dengan sesi
  die("User ID tidak ditemukan dalam sesi.");
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
          <h1 class="h3 mb-2 text-gray-800">Halaman Pengguna</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Email</th>
                      <th>Telepon</th>
                      <th>Angkatan</th>
                      <th>Foto</th>
                      <th>Gender</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once "../include/koneksi.php";
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                      // Check the value of the 'success' parameter
                      if ($_GET['success'] === 'delete') {
                        // If the value is 'delete', display a success message
                        echo '<div class="alert alert-success" role="alert">Pengguna berhasil dihapus.</div>';
                      }
                    }
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                      // Check the value of the 'success' parameter
                      if ($_GET['success'] === '1') {
                        // If the value is '1', display a success message
                        echo '<div class="alert alert-success" role="alert">Pengguna berhasil diperbarui.</div>';
                      }
                    }
                    // Query untuk mengambil data pengguna dari database
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($koneksi, $query);
                    // Jika query berhasil dijalankan
                    if ($result) {
                      $counter = 1; // Inisialisasi counter
                      // Tampilkan data pengguna ke dalam tabel HTML
                      while ($row = mysqli_fetch_assoc($result)) {
                        // Output data from each row into table cells
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row['Namalengkap'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['phoneNumber'] . "</td>";
                        echo "<td>" . $row['angkatan'] . "</td>";
                        if (!empty($row['profile_image'])) {
                          echo "<td><img src='" . $row['profile_image'] . "' alt='Profil Image' width='50'></td>";
                        } else {
                          echo "<td>No Image</td>";
                        }
                        // Tampilkan badge sesuai dengan gender pengguna
                        if ($row['gender'] == 'Laki-Laki') {
                          echo '<td><span class="badge badge-info">' . $row['gender'] . '</span></a>';
                        } elseif ($row['gender'] == 'Perempuan') {
                          echo '<td><span class="badge badge-danger">' . $row['gender'] . '</span></a>';
                        } else {
                          echo $row['gender'];
                        }
                        echo "</td>";
                        echo "<td>";
                        // Tampilkan badge sesuai dengan peran (role) pengguna
                        if ($row['role'] == "admin") {
                          echo "<span class='badge badge-primary'>" . $row['role'] . "</span>";
                        } else if ($row['role'] == "user") {
                          echo "<span class='badge badge-success'>" . $row['role'] . "</span>";
                        } else {
                          echo $row['role'];
                        }
                        echo "</td>";
                        // Tambahkan kolom untuk Actions dengan tautan Edit dan Delete
                        echo "<td>";
                        echo "<a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                        echo "&nbsp;"; // Add a non-breaking space here for spacing
                        echo "<a href='../hapus_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
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
        <!-- /.container-fluid -->
      </div>
      <?php
      require_once('../include/footer.php')
      ?>
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