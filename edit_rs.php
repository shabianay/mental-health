<?php
// Include the database connection file
include_once "koneksi.php";

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
    header("Location: index.php");
    exit();
}

// Tangani permintaan perubahan rumah sakit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];

    // Periksa apakah file gambar baru diunggah
    if ($_FILES['image']['size'] > 0) {
        $image_name = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;

        // Pindahkan file gambar ke folder uploads
        move_uploaded_file($image_temp, $image_path);

        // Update rumah sakit beserta gambar baru
        $updateQuery = "UPDATE hospitals SET name = '$name', address = '$address', phone = '$phone', email = '$email', website = '$website', image_path = '$image_path' WHERE id = $hospital_id";
    } else {
        // Jika tidak ada gambar baru diunggah, update rumah sakit tanpa mengubah gambar
        $updateQuery = "UPDATE hospitals SET name = '$name', address = '$address', phone = '$phone', email = '$email', website = '$website' WHERE id = $hospital_id";
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body>
    <!-- Include navbar and other shared components here -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Edit Rumah Sakit</h1>
                <!-- Form untuk mengedit rumah sakit -->
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
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $hospital['email']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" value="<?php echo $hospital['website']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar (maksimal 2MB)</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" maxlength="2097152" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="rumahsakit.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        <!-- End of Main Content -->

        <!-- Include footer and other shared components here -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Include scripts and other shared components here -->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>