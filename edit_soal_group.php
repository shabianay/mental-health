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
// Include database connection
include "koneksi.php";
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
    header("Location: index.php");
    exit();
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

    <title>Edit Soal Group</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include('navbar_admin.php') ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include('topbar_admin.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Edit Soal Group</h1>
                    <form method="post" action="update_soal_group.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <div class="form-group">
                            <label for="name">Nama grup soal:</label>
                            <input class="form-control" type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="normal_weight">Normal Weight: (desimal)</label>
                            <input class="form-control" type="number" id="normal_weight" name="normal_weight" step="0.01" min="0" value="<?php echo $row['normal_weight']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="perbatasan_weight">Perbatasan Weight: (desimal)</label>
                            <input class="form-control" type="number" id="perbatasan_weight" name="perbatasan_weight" step="0.01" min="0" value="<?php echo $row['perbatasan_weight']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="abnormal_weight">Abnormal Weight: (desimal)</label>
                            <input class="form-control" type="number" id="abnormal_weight" name="abnormal_weight" step="0.01" min="0" value="<?php echo $row['abnormal_weight']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_group">Update soal grup</button>
                        <a href="soal_group.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <?php include('footer.php') ?>
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include('logout.php') ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>