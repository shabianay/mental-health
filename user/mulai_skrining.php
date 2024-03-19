<?php
session_start();

// Periksa apakah sudah ada sesi persetujuan
if (!isset($_SESSION['agreement']) || $_SESSION['agreement'] !== true) {
    // Jika belum ada, redirect ke halaman skrining.php
    header("Location: skrining.php");
    exit();
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

// Query untuk mendapatkan daftar pertanyaan
$query = "SELECT questions.id_soal, questions.question_text, soal_group.name AS question_group, questions.nilai_a, questions.nilai_b, subkriteria.subkriteria AS subgroup_name FROM questions JOIN soal_group ON questions.question_group = soal_group.id JOIN subkriteria ON questions.subkriteria = subkriteria.id_subkriteria";

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

    // Ambil nilai timer dari form
    $timerValue = $_POST['timerValue'];
    // Ubah nilai timer menjadi format time (hh:mm:ss)
    $timerFormatted = gmdate("H:i:s", $timerValue);

    // Query untuk menyimpan data ke dalam tabel skrining
    $query_insert = "INSERT INTO skrining (hasil, nilai, waktu, user_id, timer) VALUES ('$hasil', $totalSkor, '$waktu', $user_id, '$timerFormatted')";

    // Ambil ID skrining yang baru saja disimpan
    $skrining_id = mysqli_insert_id($koneksi);

    // Eksekusi query insert skrining
    if (mysqli_query($koneksi, $query_insert)) {
        // Ambil ID skrining yang baru saja disimpan
        $skrining_id = mysqli_insert_id($koneksi);

        // Loop to insert answers
        foreach ($_POST as $key => $value) {
            // Check if the input name corresponds to an answer
            if (strpos($key, 'jawaban_') !== false) {
                // Get the question_id from the input name
                $question_id = substr($key, 8);

                // Query to get the user_id based on the session user_id
                $query_get_user_id = "SELECT id FROM users WHERE id = $user_id";
                $result_get_user_id = mysqli_query($koneksi, $query_get_user_id);

                if (!$result_get_user_id) {
                    // Error handling if the query fails
                    die("Query error: " . mysqli_error($koneksi));
                }

                $user_data = mysqli_fetch_assoc($result_get_user_id);
                $user_id = $user_data['id'];

                // Insert answer into answers table
                $query_insert_jawaban = "INSERT INTO answers (skrining_id, question_id, answer, user_id) VALUES ($skrining_id, $question_id, $value, $user_id)";
                mysqli_query($koneksi, $query_insert_jawaban);
            }
        }
    }
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
                    <?php if (isset($hasil) && !empty($hasil)) : ?>
                        <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resultModalLabel">Hasil Skrining</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h1 class="h3 mb-4 text-gray-700">Hasil skrining Anda</h1>
                                        <p class="text-gray-900">Skor Total: <?php echo $totalSkor; ?></p>
                                        <p class="text-gray-900">Hasil: <?php echo $hasil; ?></p>
                                        <?php
                                        if ($hasil == 'Butuh Penanganan') {
                                            echo "<p>Anda perlu penanganan segera. Silakan hubungi layanan kesehatan terdekat atau konsultasikan hasil skrining Anda dengan dokter/psikolog. Tetap semangat ya!</p>";
                                            // Tampilkan tombol menuju halaman baca_rs.php
                                            echo "<a href='baca_rs.php' class='btn btn-primary mb-3'>Cari Psikolog Terdekat</a>";
                                            echo "<a href='https://www.instagram.com/smccunesa/' class='btn btn-primary'>Kunjungi Akun Instagram SMCC UNESA</a>";
                                            echo "<img src='../img/butuh_perlu.svg' alt='Image' class='img-fluid'>";
                                        } elseif ($hasil == 'Perlu Perhatian') {
                                            echo "<p>Anda perlu perhatian lebih lanjut. Segera lakukan konsultasi dengan dokter untuk evaluasi lebih lanjut. Tetap semangat ya!</p>";
                                            // Tampilkan tombol menuju halaman baca_artikel.php
                                            echo "<a href='baca_rs.php' class='btn btn-primary mb-3'>Cari Psikolog Terdekat</a>";
                                            echo "<a href='https://www.instagram.com/smccunesa/' class='btn btn-primary'>Kunjungi Akun Instagram SMCC UNESA</a>";
                                            echo "<img src='../img/butuh_perlu.svg' alt='Image' class='img-fluid'>";
                                        } else {
                                            echo "<p>Hasil skrining menunjukkan Anda dalam kondisi sehat. Tetap jaga kesehatan mental dan lakukan skrining secara berkala.</p>";
                                            // Tampilkan tombol menuju akun Instagram
                                            echo "<a href='baca_artikel.php' class='btn btn-primary'>Baca Artikel Kesehatan</a>";
                                            echo "<img src='../img/sehat.svg' alt='Image' class='img-fluid'>";
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="text-primary" id="timer">00:00:00</div>
                                <div class="card-body">
                                    <form id="skriningForm" method="POST" action="">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class='text-gray-800'>
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
                                                    $current_subgroup = "";

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        if ($row['question_group'] != $current_group) {
                                                            echo "<tr class='text-gray-800'><td colspan='4'><strong>Kategori : " . $row['question_group'] . "</strong></td></tr>";
                                                            $current_group = $row['question_group'];
                                                        }
                                                        if ($row['subgroup_name'] != null && $row['subgroup_name'] != $current_subgroup) {
                                                            echo "<tr><td colspan='4'><strong>Subkategori : " . $row['subgroup_name'] . "</strong></td></tr>";
                                                            $current_subgroup = $row['subgroup_name'];
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
                                            <input type="hidden" id="timerValue" name="timerValue" value="">
                                            <div class="card-footer" style="text-align: right;">
                                                <button type="button" class="btn btn-primary" id="btnFinish">Akhiri Sesi Skrining</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            </form>
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
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    <!-- Script untuk menampilkan modal saat halaman dimuat -->
    <script>
        $(document).ready(function() {
            $('#resultModal').modal('show');
        });
    </script>

    <script>
        // Tambahkan variabel untuk menyimpan nilai timer
        var timerValue = 0;

        // Fungsi untuk menampilkan waktu
        function displayTimer() {
            var hours = Math.floor(timerValue / 3600);
            var minutes = Math.floor((timerValue % 3600) / 60);
            var seconds = timerValue % 60;

            // Tampilkan waktu dengan format HH:MM:SS
            var formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            document.getElementById('timer').innerHTML = formattedTime;
        }

        // Fungsi untuk menghitung waktu setiap detik
        var timerInterval = setInterval(function() {
            timerValue++;
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

            // Set nilai totalSkor dan timer ke dalam input hidden
            $('#totalSkor').val(totalSkor);
            $('#timerValue').val(timerValue);

            // Submit form
            $('#skriningForm').submit();

            // Lakukan sesuatu saat tombol Selesai diklik
            // Hentikan timer
            clearInterval(timerInterval);
        });
    </script>
</body>

</html>