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
require_once "../include/koneksi.php";
// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the Soal Group data from the database based on the provided ID
    $query = "SELECT * FROM `soal_group` WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    // Check if the Soal Group with the provided ID exists
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // Display the form to edit the Soal Group
    } else {
        // If the Soal Group with the provided ID does not exist, display an error message
        echo "Soal Group not found";
    }
} else {
    // If the ID parameter is not provided in the URL, redirect to the appropriate page
    header("Location: ../index.php");
    exit();
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

    <title>Edit Soal Group</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once('../include/navbar_admin.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once('../include/topbar_admin.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Soal Group</h1>
                    <form method="post" action="../update_soal_group.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label for="name">Nama grup soal:</label>
                            <input class="form-control" type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="sehat">Sehat: (desimal)</label>
                            <input class="form-control" type="number" id="sehat" name="sehat" step="0.01" min="0" value="<?php echo $row['sehat']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="perlu_perhatian">Perlu Perhatian: (desimal)</label>
                            <input class="form-control" type="number" id="perlu_perhatian" name="perlu_perhatian" step="0.01" min="0" value="<?php echo $row['perlu_perhatian']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="butuh_penanganan">Butuh Penanganan: (desimal)</label>
                            <input class="form-control" type="number" id="butuh_penanganan" name="butuh_penanganan" step="0.01" min="0" value="<?php echo $row['butuh_penanganan']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_group">Update soal grup</button>
                        <a href="soal_group.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <?php require_once('../include/footer.php') ?>
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
</body>

</html>