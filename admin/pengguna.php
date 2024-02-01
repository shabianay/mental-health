<?php
session_start();

// Include database connection file
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

if ($_SESSION['role'] == 'user') {
  header("Location: ../user/user_dashboard.php");
  exit();
}

// Jika tombol "Buat akun" diklik
if (isset($_POST['submit'])) {
  // Ambil nilai dari form
  $namaLengkap = $_POST['Namalengkap'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phoneNumber = $_POST['phoneNumber'];
  $angkatan = $_POST['angkatan'];
  $gender = $_POST['gender'];
  $confirmPassword = $_POST['confirmPassword'];

  // Inside the submit block, after the validation check
  if (empty($namaLengkap) || empty($email) || empty($password) || empty($phoneNumber) || empty($angkatan) || empty($gender) || $password !== $confirmPassword) {
    $pesan = "Harap isi semua kolom dengan benar atau pastikan password dan konfirmasi password sama.";
  } else {
    // Query untuk memeriksa apakah email sudah ada di database
    $checkQuery = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
      // Jika email sudah ada, tampilkan pesan kesalahan
      $pesan = "Email sudah digunakan, gunakan email lain";
    } else {
      // Jika email belum ada, lakukan penyimpanan data
      // Set default role to "user"
      $role = "user";

      // Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Query untuk menyimpan data ke dalam database, termasuk role dan gender
      $query = "INSERT INTO users (Namalengkap, email, password, phoneNumber, angkatan, role, gender) VALUES ('$namaLengkap', '$email', '$hashedPassword', '$phoneNumber', '$angkatan', '$role', '$gender')";

      if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman pengguna.php dengan pesan sukses
        header("Location: pengguna.php?success=register");
        exit();
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
      }
    }
  }
  // Tutup koneksi ke database
  mysqli_close($koneksi);
}

// Retrieve user information from the database
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $query = "SELECT * FROM users WHERE id = $user_id";
  $result = mysqli_query($koneksi, $query);
  if (!$result) {
    // Error fetching data from the database
    die("Query error: email telah terdaftar " . mysqli_error($koneksi));
  }
  $user = mysqli_fetch_assoc($result);
} else {
  // If user_id is not available in session, there might be an issue with the session
  die("User ID not found in session.");
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
          <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPenggunaModal"><i class="fa-solid fa-plus mr-2"></i>
            Tambah Pengguna
          </button>
          <?php
          // Tambahkan kode untuk menampilkan pesan jika pengguna berhasil ditambahkan
          if (isset($_GET['success']) && $_GET['success'] === 'register') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  Pengguna berhasil ditambahkan.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
          }
          ?>
          <div class="modal fade" id="tambahPenggunaModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenggunaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="tambahPenggunaModalLabel">Tambah Pengguna</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="pengguna.php" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="Namalengkap">Nama Lengkap</label>
                      <input type="text" class="form-control" id="Namalengkap" name="Namalengkap" placeholder="Nama Lengkap" />
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="(?=.*\d).{8,}" title="Password harus terdiri dari minimal 8 karakter dan mengandung angka" required />
                    </div>
                    <div class="form-group">
                      <label for="confirmPassword">Konfirmasi Password</label>
                      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Password" pattern="(?=.*\d).{8,}" title="Password harus terdiri dari minimal 8 karakter dan mengandung angka" required />
                    </div>
                    <div class="form-group">
                      <label for="phoneNumber">Nomor HP</label>
                      <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Nomor HP" pattern="[0-9]{10,}" title="Nomor HP harus terdiri dari minimal 10 angka" required />
                    </div>
                    <div class="form-group">
                      <label for="angkatan">Angkatan</label>
                      <select class="form-control" id="angkatan" name="angkatan">
                        <option value="" selected disabled hidden>Pilih Angkatan</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="gender">Jenis Kelamin</label>
                      <select class="form-control" id="gender" name="gender" required>
                        <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="submit">Tambah Pengguna</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
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
                    // Query to retrieve user data from the database
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($koneksi, $query);
                    if ($result) {
                      $counter = 1; // Initialize counter
                      // Display user data in HTML table
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
                        // Display badge based on user's gender
                        if ($row['gender'] == 'Laki-Laki') {
                          echo '<td><span class="badge badge-info">' . $row['gender'] . '</span></a>';
                        } elseif ($row['gender'] == 'Perempuan') {
                          echo '<td><span class="badge badge-danger">' . $row['gender'] . '</span></a>';
                        } else {
                          echo $row['gender'];
                        }
                        echo "</td>";
                        echo "<td>";
                        // Display badge based on user's role
                        if ($row['role'] == "admin") {
                          echo "<span class='badge badge-primary'>" . $row['role'] . "</span>";
                        } else if ($row['role'] == "user") {
                          echo "<span class='badge badge-success'>" . $row['role'] . "</span>";
                        } else {
                          echo $row['role'];
                        }
                        echo "</td>";
                        echo "<td>";
                        echo "<a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                        echo "&nbsp;"; // Add a non-breaking space here for spacing
                        echo "<a href='../hapus_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                        $counter++; // Increment counter after each row
                      }
                      mysqli_free_result($result);
                    } else {
                      echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                    }
                    // Close database connection
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
  <script>
    function validatePassword() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;

      if (password != confirmPassword) {
        alert("Password dan konfirmasi password harus sama.");
        return false;
      }
      return true;
    }
  </script>
</body>

</html>