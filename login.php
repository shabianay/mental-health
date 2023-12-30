<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Include file koneksi ke database
  include "koneksi.php";

  // Ambil nilai dari form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query untuk mencari user berdasarkan email dan password
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
  $result = mysqli_query($koneksi, $query);

  // Periksa apakah query berhasil dijalankan dan data ditemukan
  if ($result && mysqli_num_rows($result) > 0) {
    // Data ditemukan, buat session untuk user
    $user = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

    // Redirect ke halaman user_dashboard.php setelah login berhasil
    header("Location: user_dashboard.php");
    exit();
  } else {
    // Data tidak ditemukan, beri pesan error
    $error_message = "Email atau password salah. Silakan coba lagi.";
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

  <title>Masuk</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body class="bg-gradient-primary">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Hai, Silakan Masuk!</h1>
                  </div>
                  <form class="user" method="post" action="login_process.php">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email" required />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required />
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Masuk
                    </button>
                  </form>
                  <hr />
                  <!-- <div class="text-center">
                      <a class="small" href="forgot-password.html"
                        >Lupa password?</a
                      >
                    </div> -->
                  <div class="text-center">
                    <a class="small" href="register.php">Buat akunmu</a>
                  </div>
                </div>
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
</body>

</html>