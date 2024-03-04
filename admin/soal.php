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
$retrieveQuery = "SELECT * FROM `questions`";
$retrieveResult = mysqli_query($koneksi, $retrieveQuery);

// Retrieve question groups from the database
$retrieveQuery = "SELECT id, name FROM soal_group";
$retrieveResult = mysqli_query($koneksi, $retrieveQuery);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $questionText = $_POST['questionText'];
    $questionGroupName = $_POST['questionGroup'];
    $nilaiA = $_POST['nilaiA'];
    $nilaiB = $_POST['nilaiB'];

    $insertQuery = "INSERT INTO questions (question_group, nilai_a, nilai_b, question_text) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $insertQuery);
    mysqli_stmt_bind_param($stmt, "ssss", $questionGroupName, $nilaiA, $nilaiB, $questionText);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Data berhasil ditambahkan.");</script>';
    } else {
        echo "Error creating soal: " . mysqli_error($koneksi);
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
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php require_once('../include/navbar_admin.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once('../include/topbar_admin.php')
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Halaman Daftar Soal</h1>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addQuestionModal"><i class="fa-solid fa-plus mr-2"></i>
                        Tambah Soal
                    </button>
                    <div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addQuestionModalLabel">Tambah Soal Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="soal.php">
                                        <div class="form-group">
                                            <label for="questionText">Soal</label>
                                            <textarea class="form-control" id="questionText" name="questionText" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="questionGroup">Soal Grup</label>
                                            <select class="form-control" id="questionGroup" name="questionGroup" required>
                                                <option value="">Pilih Soal Grup</option>
                                                <?php
                                                // Use the $retrieveResult variable to populate the options
                                                while ($row = mysqli_fetch_assoc($retrieveResult)) {
                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nilaiA">Nilai Opsi Iya</label>
                                            <input type="number" class="form-control" id="nilaiA" name="nilaiA" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nilaiB">Nilai Opsi Tidak</label>
                                            <input type="number" class="form-control" id="nilaiB" name="nilaiB" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="opsiA">Opsi Jawaban Iya</label>
                                            <input type="text" class="form-control" id="opsiA" name="opsiA" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="opsiB">Opsi Jawaban Tidak</label>
                                            <input type="text" class="form-control" id="opsiB" name="opsiB" required>
                                        </div> -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Tambah Soal</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Display existing questions -->
                    <?php
                    require_once "../include/koneksi.php";
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'delete') {
                            // If the value is 'delete', display a success message
                            echo '<div class="alert alert-success" role="alert">
                            Soal berhasil dihapus.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                        }
                    }
                    // Check if the 'success' parameter exists in the URL
                    if (isset($_GET['success'])) {
                        // Check the value of the 'success' parameter
                        if ($_GET['success'] === 'update') {
                            // If the value is 'update', display a success message
                            echo '<div class="alert alert-success" role="alert">
                            Soal berhasil diperbarui.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button></div>';
                        }
                    }
                    // Query to retrieve articles from the database
                    $query = "SELECT questions.id_soal, questions.question_text, soal_group.name AS group_name, questions.nilai_a, questions.nilai_b FROM questions JOIN soal_group ON questions.question_group = soal_group.id";
                    $result = mysqli_query($koneksi, $query);
                    // Check if the query was successful
                    if ($result) {
                        // Display the table headers
                        echo "<div class='card shadow mb-4'>";
                        echo "<div class='card-header py-3'>";
                        echo "<h6 class='m-0 font-weight-bold text-primary'>";
                        echo "Data Soal";
                        echo "</h6>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>No</th>";
                        echo "<th>Soal</th>";
                        echo "<th>Grup Soal</th>";
                        echo "<th>Nilai Opsi Iya</th>";
                        echo "<th>Nilai Opsi Tidak</th>";
                        // echo "<th>Opsi A</th>";
                        // echo "<th>Opsi B</th>";
                        echo "<th>Aksi</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $counter = 1; // Inisialisasi counter
                        // Loop through the result set and display the articles
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . $row['question_text'] . "</td>";
                            echo "<td>" . $row['group_name'] . "</td>";
                            echo "<td>" . $row['nilai_a'] . "</td>";
                            echo "<td>" . $row['nilai_b'] . "</td>";
                            // echo "<td>" . $row['opsi_a'] . "</td>";
                            // echo "<td>" . $row['opsi_b'] . "</td>";
                            echo "<td style='text-align: center'>";
                            echo "<a href='edit_soal.php?id=" . $row['id_soal'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                            echo "&nbsp;";
                            echo "<a href='../hapus_soal.php?id=" . $row['id_soal'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                            $counter++; // Tingkatkan counter setelah setiap baris
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>"; // This closes the div for the DataTables Example

                        // Free the result set
                        mysqli_free_result($result);
                    } else {
                        // If the query was not successful, display an error message
                        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                    }
                    // Close the database connection
                    mysqli_close($koneksi);
                    ?>
                </div>
                <?php require_once('../include/footer.php') ?>
            </div>
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

</body>

</html>