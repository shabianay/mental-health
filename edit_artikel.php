<?php
// Include the database connection file
include_once "koneksi.php";

// Periksa apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Query untuk mengambil data artikel berdasarkan id
    $query = "SELECT * FROM articles WHERE id = $article_id";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil
    if ($result) {
        // Ambil data artikel dari hasil query
        $article = mysqli_fetch_assoc($result);
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

// Tangani permintaan perubahan artikel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Periksa apakah file gambar baru diunggah
    if ($_FILES['image']['size'] > 0) {
        $image_name = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_path = "uploads/" . $image_name;

        // Pindahkan file gambar ke folder uploads
        move_uploaded_file($image_temp, $image_path);

        // Update artikel beserta gambar baru
        $updateQuery = "UPDATE articles SET title = '$title', content = '$content', image_path = '$image_path' WHERE id = $article_id";
    } else {
        // Jika tidak ada gambar baru diunggah, update artikel tanpa mengubah gambar
        $updateQuery = "UPDATE articles SET title = '$title', content = '$content' WHERE id = $article_id";
    }

    // Eksekusi query untuk memperbarui artikel dalam database
    $updateResult = mysqli_query($koneksi, $updateQuery);

    // Periksa apakah query berhasil
    if ($updateResult) {
        // Redirect kembali ke halaman artikel dengan pesan sukses
        header("Location: artikel.php?id=" . $article_id . "&success=1");
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

    <title>Dashboard Admin</title>

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
                <h1 class="h3 mb-4 text-gray-800">Edit Artikel</h1>
                <!-- Form untuk mengedit artikel -->
                <form method="post" action="edit_artikel.php?id=<?php echo $article_id; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $article['title']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label for="content">Isi</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required><?php echo $article['content']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar (maksimal 2MB)</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" maxlength="2097152" />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="artikel.php" class="btn btn-secondary">Kembali</a>
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