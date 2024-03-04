<?php
require_once "./include/koneksi.php";

// Deklarasi variabel pesan
$pesan = '';

// Jika tombol "Buat akun" diklik
if (isset($_POST['submit'])) {
  // Ambil nilai dari form
  $namaLengkap = $_POST['Namalengkap'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phoneNumber = $_POST['phoneNumber'];
  $angkatan = $_POST['angkatan'];
  $gender = $_POST['gender'];

  // Validasi form (pastikan semua field terisi)
  if (empty($namaLengkap) || empty($email) || empty($password) || empty($phoneNumber) || empty($angkatan) || empty($gender)) {
    $pesan = "Harap isi semua kolom";
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

      // Jalankan query
      if (mysqli_query($koneksi, $query)) {
        // Redirect ke halaman login.php
        header("Location: register.php?success=register");
        exit();
      } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
      }
    }
  }

  // Tutup koneksi ke database
  mysqli_close($koneksi);
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

  <title>Daftar Akun</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />

  <style>
    .card {
      max-width: 500px;
      margin: 0 auto;
    }
  </style>
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row d-flex align-items-center" style="min-height: 100vh;">
      <div class="col-lg-12">
        <div class="card o-hidden border-0 shadow-lg my-5 mx-auto" style="max-width: 500px;">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Daftar Akun</h1>
              </div>
              <!-- Check if the 'success' parameter exists in the URL -->
              <?php if (isset($_GET['success']) && $_GET['success'] === 'register') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Berhasil Daftar, Silahkan
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <a class="regular" href="login.php">Masuk</a>
                </div>
              <?php endif; ?>
              <?php if (!empty($pesan)) : ?>
                <div class="alert alert-danger"><?php echo $pesan; ?></div>
              <?php endif; ?>
              <form class="user" method="post" action="" onsubmit="return validatePassword()">
                <div class="form-group">
                  <!-- <label for="Namalengkap">Nama Lengkap</label> -->
                  <input type="text" class="form-control" id="Namalengkap" name="Namalengkap" placeholder="Nama Lengkap" />
                </div>
                <div class="form-group">
                  <!-- <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" /> -->
                </div>
                <div class="form-group">
                  <!-- <label for="password">Password</label> -->
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="(?=.*\d).{8,}" title="Password harus terdiri dari minimal 8 karakter dan mengandung angka" required />
                </div>
                <div class="form-group">
                  <!-- <label for="confirmPassword">Konfirmasi Password</label> -->
                  <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Password" pattern="(?=.*\d).{8,}" title="Password harus terdiri dari minimal 8 karakter dan mengandung angka" required />
                </div>
                <div class="form-group">
                  <!-- <label for="phoneNumber">Nomor HP</label> -->
                  <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Nomor HP" pattern="[0-9]{10,}" title="Nomor HP harus terdiri dari minimal 10 angka" required />
                </div>
                <div class="form-group">
                  <!-- <label for="angkatan">Angkatan</label> -->
                  <select class="form-control" id="angkatan" name="angkatan">
                    <option value="" selected disabled hidden>Pilih Angkatan</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
                <div class="form-group">
                  <!-- <label for="gender">Jenis Kelamin</label> -->
                  <select class="form-control" id="gender" name="gender" required>
                    <option value="" selected disabled hidden>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <input type="submit" name="submit" value="Buat akun" class="btn btn-primary btn-user btn-block">
              </form>

              <!-- <div class="text-center">
                  <a class="small" href="forgot-password.html"
                    >Lupa password?</a
                  >
                </div> -->
              <hr />

              <div class="text-center mt-3">
                <a class="small" href="login.php">Sudah punya akun? Masuk</a>
              </div>
              <div class="text-center mt-2">
                <a class="small" style="color:black" href="index.php">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script>
    // Fungsi untuk memeriksa apakah kolom password dan konfirmasi password sama
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