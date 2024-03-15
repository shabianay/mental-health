<?php
session_start();

checkAgreement();
function checkAgreement()
{
    // Periksa apakah sudah ada sesi persetujuan
    if (!isset($_SESSION['agreement']) || $_SESSION['agreement'] !== true) {
        // Jika belum ada, redirect ke halaman skrining.php
        header("Location: skrining.php");
        exit();
    }
}
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

if ($_SESSION['role'] == 'admin') {
    header("Location: ../admin/admin_dashboard.php");
    exit();
}

// Lakukan koneksi ke database
require_once '../include/koneksi.php';

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    // Error saat mengambil data dari database
    die("Query error: " . mysqli_error($koneksi));
}
$user = mysqli_fetch_assoc($result);

$query = "SELECT questions.id_soal, questions.question_text, soal_group.name AS question_group, questions.nilai_a, questions.nilai_b FROM questions JOIN soal_group ON questions.question_group = soal_group.id";

// $query = "SELECT questions.id_soal, questions.question_text, soal_group.name AS question_group, questions.nilai_a, questions.nilai_b, subkriteria.subkriteria AS subgroup_name FROM questions JOIN soal_group ON questions.question_group = soal_group.id JOIN subkriteria ON questions.subkriteria = subkriteria.id_subkriteria";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

// Jika ada data yang dikirimkan melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap nilai totalSkor dari form
    $totalSkor = $_POST['totalSkor'];

    // Ambil hasil skrining
    $hasil = '';
    if ($totalSkor >= 20) {
        $hasil = 'Butuh Penanganan';
    } else if ($totalSkor >= 8 && $totalSkor < 15) {
        $hasil = 'Perlu Perhatian';
    } else {
        $hasil = 'Sehat';
    }

    // Tanggal skrining
    $waktu = date('Y-m-d');

    // Query untuk menyimpan data ke dalam tabel skrining
    $query_insert = "INSERT INTO skrining (hasil, nilai, waktu, user_id) VALUES ('$hasil', $totalSkor, '$waktu', $user_id)";
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

    <title>Dashboard User</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet" />
    <style>
        /* CSS untuk tampilan waktu */
        #timer {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        require_once('../include/navbar_user.php')
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once('../include/topbar_user.php')
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Mulai Skrining</h1>
                    <?php
                    // Eksekusi query
                    if (!empty($query_insert)) {
                        if (mysqli_query($koneksi, $query_insert)) {
                            // Tampilkan pesan berhasil disimpan
                            echo '<div class="alert alert-success" role="alert">Data skrining berhasil disimpan.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>';
                        } else {
                            echo "Error: " . $query_insert . "<br>" . mysqli_error($koneksi);
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="text-primary" id="timer">00:00:00</div>
                                <div class="card-body">
                                    <form id="skriningForm" method="POST" action="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pertanyaan</th>
                                                        <th>Iya</th>
                                                        <th>Tidak</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $counter = 1;
                                                    $current_group = "";
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($row['question_group'] != $current_group) {
                                                            echo "<tr><td colspan='4'><strong>Kategori : " . $row['question_group'] . "</strong></td></tr>";
                                                            $current_group = $row['question_group'];
                                                        }
                                                        echo "<tr>";
                                                        echo "<td>" . $counter . "</td>";
                                                        echo "<td>" . $row['question_text'] . "</td>";
                                                        echo "<td class='text-center'><input type='radio' name='jawaban_" . $row['id_soal'] . "' value='" . $row['nilai_a'] . "' style='width: 20px; height: 20px; cursor: pointer;' required></td>";
                                                        echo "<td class='text-center'><input type='radio' name='jawaban_" . $row['id_soal'] . "' value='" . $row['nilai_b'] . "' style='width: 20px; height: 20px; cursor: pointer;' required></td>";
                                                        echo "</tr>";
                                                        $counter++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <input type="hidden" id="totalSkor" name="totalSkor" value="">
                                            <div class="card-footer" style="text-align: right;">
                                                <button type="button" class="btn btn-primary" id="btnFinish">Akhiri Sesi Skrining</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="..js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <script>
        // Set waktu awal
        var timer = 0;

        // Fungsi untuk menampilkan waktu
        function displayTimer() {
            var hours = Math.floor(timer / 3600);
            var minutes = Math.floor((timer % 3600) / 60);
            var seconds = timer % 60;

            // Tampilkan waktu dengan format HH:MM:SS
            document.getElementById('timer').innerHTML = pad(hours) + ":" + pad(minutes) + ":" + pad(seconds);
        }

        // Fungsi untuk menambahkan angka 0 di depan angka < 10
        function pad(num) {
            return num < 10 ? "0" + num : num;
        }

        // Fungsi untuk menghitung waktu setiap detik
        var timerInterval = setInterval(function() {
            timer++;
            displayTimer();
        }, 1000);

        // Event listener untuk tombol Selesai
        $('#btnFinish').on('click', function() {
            // Cek apakah semua pertanyaan telah terisi
            if ($('input[type="radio"]:checked').length < <?php echo $counter - 1; ?>) {
                alert('Harap isi semua pertanyaan sebelum mengakhiri sesi.');
                return;
            }

            // Hitung total skor
            var totalSkor = 0;
            $('input[type="radio"]:checked').each(function() {
                totalSkor += parseInt($(this).val());
            });

            // Set nilai totalSkor ke dalam input hidden
            $('#totalSkor').val(totalSkor);

            // Submit form
            $('#skriningForm').submit();

            // Lakukan sesuatu saat tombol Selesai diklik
            // Hentikan timer
            clearInterval(timerInterval);
        });
    </script>
</body>

</html>