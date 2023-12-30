<?php
include "koneksi.php";

// Inisialisasi variabel
$name = "";
$address = "";
$phone = "";
$email = "";
$website = "";
$image_path = "";

// Jika tombol "Submit" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $website = $_POST["website"];

    // Ambil informasi file gambar
    $image_name = $_FILES["image"]["name"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $image_path = "uploads/" . $image_name;

    // Periksa ukuran file gambar (maksimal 2MB)
    if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
        echo "<script>alert('Ukuran file gambar melebihi batas maksimal (2MB).');</script>";
    } else {
        // Pindahkan file gambar ke folder uploads
        move_uploaded_file($image_tmp, $image_path);

        // Query untuk menyimpan rumah sakit ke database
        $query = "INSERT INTO hospitals (name, address, phone, email, website, image_path) VALUES ('$name', '$address', '$phone', '$email', '$website', '$image_path')";
        $result = mysqli_query($koneksi, $query);

        // Jika query berhasil dijalankan
        if ($result) {
            echo "<script>alert('Rumah Sakit berhasil ditambahkan');</script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
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

    <title>Tambah Rumah Sakit</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Tambah Rumah Sakit</h1>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nama Rumah Sakit</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website">
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar (maksimal 2MB)</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required maxlength="2097152">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="rumahsakit.php" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>