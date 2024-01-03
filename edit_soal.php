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
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id_soal = $_GET['id'];

    // Retrieve the question data from the database
    $query = "SELECT * FROM questions WHERE id_soal = ?";
    $stmt = mysqli_prepare($koneksi, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_soal);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Display the form with the question data for editing
        } else {
            echo "Question not found!";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request!";
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
    <title>Manage Questions</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body>
    <div id="wrapper">
        <?php include('navbar_admin.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include('topbar_admin.php') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Soal</h1>
                    <form method="post" action="update_soal.php">
                        <input type="hidden" name="id_soal" value="<?php echo $row['id_soal']; ?>">
                        <div class="form-group">
                            <label for="questionText">Soal</label>
                            <textarea class="form-control" id="questionText" name="questionText"><?php echo $row['question_text']; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="nilaiA">Nilai A</label>
                            <input type="number" class="form-control" id="nilaiA" name="nilaiA" value="<?php echo $row['nilai_a']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nilaiB">Nilai B</label>
                            <input type="number" class="form-control" id="nilaiB" name="nilaiB" value="<?php echo $row['nilai_b']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nilaiC">Nilai C</label>
                            <input type="number" class="form-control" id="nilaiC" name="nilaiC" value="<?php echo $row['nilai_c']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="opsiA">Opsi A</label>
                            <input type="text" class="form-control" id="opsiA" name="opsiA" value="<?php echo $row['opsi_a']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="opsiB">Opsi B</label>
                            <input type="text" class="form-control" id="opsiB" name="opsiB" value="<?php echo $row['opsi_b']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="opsiC">Opsi C</label>
                            <input type="text" class="form-control" id="opsiC" name="opsiC" value="<?php echo $row['opsi_c']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_group">Update soal grup</button>
                        <a href="soal_group.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php') ?>
    <!-- Logout Modal-->
    <?php include('logout.php') ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>