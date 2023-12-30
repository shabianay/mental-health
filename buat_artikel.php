<?php
include "koneksi.php";

// Inisialisasi variabel
$title = "";
$content = "";
$image_path = "";

// Jika tombol "Submit" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $title = $_POST["title"];
    $content = $_POST["content"];

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

        // Query untuk menyimpan artikel ke database
        $query = "INSERT INTO articles (title, content, image_path) VALUES ('$title', '$content', '$image_path')";
        $result = mysqli_query($koneksi, $query);

        // Jika query berhasil dijalankan
        if ($result) {
            echo "<script>alert('Artikel berhasil ditambahkan');</script>";
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

    <title>Buat Artikel</title>

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
                    <h1 class="h3 mb-4 text-gray-800">Buat Artikel</h1>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Isi</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Gambar (maksimal 2MB)</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required maxlength="2097152">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="artikel.php" class="btn btn-secondary">Kembali</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>

</html>