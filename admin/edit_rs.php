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

// Periksa apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    $hospital_id = $_GET['id'];

    // Query untuk mengambil data rumah sakit berdasarkan id
    $query = "SELECT * FROM hospitals WHERE id = $hospital_id";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil
    if ($result) {
        // Ambil data rumah sakit dari hasil query
        $hospital = mysqli_fetch_assoc($result);
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Bebaskan hasil query
    mysqli_free_result($result);
} else {
    // Jika parameter id tidak ditemukan, redirect ke halaman lain atau tampilkan pesan error
    header("Location: ../index.php");
    exit();
}

// Tangani permintaan perubahan rumah sakit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $website = $_POST['website'];
    $maps = $_POST['maps'];

    // Periksa apakah file gambar baru diunggah
    if ($_FILES['image']['size'] > 0) {
        $image_name = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_path = "../uploads/" . $image_name;

        // Pindahkan file gambar ke folder uploads
        move_uploaded_file($image_temp, $image_path);

        // Update rumah sakit beserta gambar baru
        $updateQuery = "UPDATE hospitals SET name = '$name', address = '$address', phone = '$phone', website = '$website', image_path = '$image_path', maps = '$maps' WHERE id = $hospital_id";
    } else {
        // Jika tidak ada gambar baru diunggah, update rumah sakit tanpa mengubah gambar
        $updateQuery = "UPDATE hospitals SET name = '$name', address = '$address', phone = '$phone', website = '$website', maps = '$maps' WHERE id = $hospital_id";
    }

    // Eksekusi query untuk memperbarui rumah sakit dalam database
    $updateResult = mysqli_query($koneksi, $updateQuery);

    // Periksa apakah query berhasil
    if ($updateResult) {
        // Redirect kembali ke halaman daftar rumah sakit dengan pesan sukses
        header("Location: rumahsakit.php?success=edit");
        exit();
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error updating record: " . mysqli_error($koneksi);
    }
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
// Tutup koneksi database
mysqli_close($koneksi);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Edit Rumah Sakit</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <?php require_once('../include/navbar_admin.php') ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once('../include/topbar_admin.php') ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Rumah Sakit</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="post" action="edit_rs.php?id=<?php echo $hospital_id; ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $hospital['name']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $hospital['address']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $hospital['phone']; ?>" required />
                                </div>
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" value="<?php echo $hospital['website']; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="maps">Maps</label>
                                    <input type="text" class="form-control" id="maps" name="maps" value="<?php echo $hospital['maps']; ?>" />
                                </div>
                                <div>
                                    <label for="content">Tampilan gambar: </label>
                                    <br>
                                    <?php if (!empty($hospital['image_path'])) : ?>
                                        <img src="<?php echo $hospital['image_path']; ?>" alt="Rumah Sakit Image" style="max-width: 300px;">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group mt-3">
                                    <label style="cursor: pointer;" for="image">Perbarui gambar (maksimal 2MB)</label>
                                    <input style="cursor: pointer;" type="file" class="form-control-file mb-3" id="image" name="image" accept="image/*" maxlength="2097152" />
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
                                                Apakah Anda yakin ingin memperbarui Rumah Sakit?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" id="confirmButton">Perbarui</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 mb-4"><i class="fa-solid fa-rotate mr-2"></i>Perbarui Rumah Sakit</button>
                                <a href="rumahsakit.php" class="btn btn-secondary mt-3 mb-4"><i class="fa-solid fa-angle-left mr-2"></i> Kembali </a>
                            </form>
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