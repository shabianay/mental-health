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

if ($_SESSION['role'] == 'user') {
    header("Location: ../user/user_dashboard.php");
    exit();
}

require_once "../include/koneksi.php";

// Check if ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id_subkriteria = $_GET['id'];

    // Retrieve subkriteria data from database
    $query = "SELECT * FROM subkriteria WHERE id_subkriteria = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_subkriteria);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $subkriteria = mysqli_fetch_assoc($result);
    } else {
        echo "Subkriteria not found.";
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    echo "ID not provided.";
    exit();
}

// Retrieve kriteria data from database
$retrieveQuery = "SELECT * FROM soal_group";
$retrieveResult = mysqli_query($koneksi, $retrieveQuery);

// Update subkriteria data in the database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $subkriteria_baru = $_POST['subkriteria'];
    $kriteria_baru = $_POST['kriteria'];

    // Update data in the database
    $updateQuery = "UPDATE subkriteria SET subkriteria = ?, kriteria = ? WHERE id_subkriteria = ?";
    $stmt = mysqli_prepare($koneksi, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssi", $subkriteria_baru, $kriteria_baru, $id_subkriteria);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header("Location: sub_soal_group.php?success=update");
        exit();
    } else {
        echo "Error updating subkriteria: " . mysqli_error($koneksi);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
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
    <title>Dashboard Admin</title>
    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <?php require_once('../include/navbar_admin.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once('../include/topbar_admin.php')
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Sub Kriteria</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="post" action="edit_sub_soal_group.php?id=<?php echo $id_subkriteria; ?>">
                                <div class="form-group">
                                    <label for="subkriteria">Sub-Kriteria</label>
                                    <input type="text" class="form-control" id="subkriteria" name="subkriteria" value="<?php echo $subkriteria['subkriteria']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kriteria">Kriteria</label>
                                    <select class="form-control" id="kriteria" name="kriteria" required>
                                        <option value="">Pilih Kriteria</option>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($retrieveResult)) {
                                            echo "<option value='" . $row['id'] . "'" . ($subkriteria['kriteria'] == $row['id'] ? ' selected' : '') . ">" . $row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="confirmModalLabel">Konfirmasi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin memperbarui Soal?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="confirmButton">Perbarui</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 mb-4"><i class="fa-solid fa-rotate mr-2"></i>Perbarui Sub-Kriteria</button>
                                <a href="sub_soal_group.php" class="btn btn-secondary mt-3 mb-4"><i class="fa-solid fa-angle-left mr-2"></i> Kembali </a>
                            </form>
                        </div>
                    </div>
                </div>
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
    <script>
        // Function to handle form submission confirmation
        function confirmSubmission(event) {
            event.preventDefault(); // Prevent the default form submission
            $('#confirmModal').modal('show'); // Show the confirmation modal
        }

        // Add event listener to the form submit button
        document.querySelector('form').addEventListener('submit', confirmSubmission);

        // Add event listener to the modal confirm button
        document.getElementById('confirmButton').addEventListener('click', function() {
            // If the user confirms, submit the form
            document.querySelector('form').submit();
        });
    </script>
</body>

</html>