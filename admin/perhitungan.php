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

// Include file koneksi ke database
require_once "../include/koneksi.php";

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
}
$user = mysqli_fetch_assoc($result);

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $skrining_id = $_GET['id'];

    // Query untuk mengambil detail perhitungan dari skrining
    $query = "SELECT skrining.*, users.Namalengkap AS nama_lengkap 
              FROM skrining 
              JOIN users ON skrining.user_id = users.id 
              WHERE skrining.id = $skrining_id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $skrining = mysqli_fetch_assoc($result);
    } else {
        // Jika query gagal dijalankan
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        exit();
    }
} else {
    // Jika parameter 'id' tidak ada di URL atau tidak valid, redirect kembali ke halaman laporan
    header("Location: laporan.php");
    exit();
}

$query = "SELECT 
              questions.id_soal, 
              questions.question_text, 
              soal_group.name AS question_group, 
              questions.subkriteria, 
              subkriteria.subkriteria AS subkriteria, 
              answers.answer
          FROM questions
          LEFT JOIN answers ON questions.id_soal = answers.question_id AND answers.user_id = $user_id
          LEFT JOIN soal_group ON questions.question_group = soal_group.id
          LEFT JOIN subkriteria ON questions.subkriteria = subkriteria.id_subkriteria";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
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
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require_once('../include/navbar_admin.php')
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once('../include/topbar_admin.php')
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Detail Perhitungan</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="laporan.php" class="btn btn-primary">Kembali</a>
                                <br><br>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <th>ID Skrining</th>
                                            <td><?php echo $skrining['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>ID Pengguna</th>
                                            <td><?php echo $skrining['user_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?php echo $skrining['nama_lengkap']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Hasil</th>
                                            <td><?php echo $skrining['hasil']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nilai</th>
                                            <td><?php echo $skrining['nilai']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Tes</th>
                                            <td><?php echo $skrining['waktu']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Tes</th>
                                            <td><?php echo $skrining['timer']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pertanyaan</th>
                                            <th>Jawaban</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Display the questions and answers
                                        $counter = 1;
                                        $current_group = "";
                                        $current_subcategory = "";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['question_group'] != $current_group) {
                                                echo "<tr class='text-gray-800'><td colspan='3'><strong>Kriteria : " . $row['question_group'] . "</strong></td></tr>";
                                                $current_group = $row['question_group'];
                                            }

                                            if ($row['subkriteria'] != null && $row['subkriteria'] != $current_subcategory) {
                                                echo "<tr class='text-gray-800'><td colspan='3'><strong>Subkriteria : " . $row['subkriteria'] . "</strong></td></tr>";
                                                $current_subcategory = $row['subkriteria'];
                                            }

                                            echo "<tr>";
                                            echo "<td>" . $counter . "</td>";
                                            echo "<td>" . $row['question_text'] . "</td>";
                                            echo "<td>";
                                            $question_id = $row['id_soal'];
                                            $query_jawaban = "SELECT answer FROM answers WHERE skrining_id = $skrining_id AND question_id = $question_id";
                                            $result_jawaban = mysqli_query($koneksi, $query_jawaban);
                                            if ($result_jawaban) {
                                                $jawaban = mysqli_fetch_assoc($result_jawaban)['answer'];
                                                echo $jawaban;
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                            $counter++;
                                        }
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
</body>

</html>