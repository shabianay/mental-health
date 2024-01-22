<?php
session_start();


// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

require_once "./include/koneksi.php";

// Periksa apakah parameter id artikel telah diberikan
if (isset($_GET['id'])) {
    // Sanitasi inputan id artikel
    $article_id = mysqli_real_escape_string($koneksi, $_GET['id']);
    // Query untuk mengambil data artikel berdasarkan id
    $query = "SELECT * FROM articles WHERE id = $article_id";
    $result = mysqli_query($koneksi, $query);
    // Periksa apakah query berhasil
    if ($result) {
        // Ambil data artikel
        $article = mysqli_fetch_assoc($result);
    } else {
        // Jika query gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
} else {
    // Jika parameter id tidak diberikan, redirect ke halaman lain atau tampilkan pesan error
    header("Location: error.php");
    exit();
}
// Tutup koneksi ke database
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

    <title>Detail Artikel</title>

    <!-- Custom fonts for thi s template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" />
    <style>
        .card-img-top {
            width: 100%;
            object-fit: cover;
        }

        .row-artikel-detail {
            margin-top: 20px;
        }

        .article-title {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        require_once('./include/navbar_user.php')
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                require_once('./include/topbar_user.php')
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row-artikel-detail">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h2 class="article-title font-weight-bold text-primary"><?php echo $article['title']; ?></h2>
                                    <small class='card-text'><i class='fas fa-clock mr-2 mb-3'></i><?php echo date('d M Y', strtotime($article['updated_at'])); ?></small>
                                    <img class="card-img-top" src="<?php echo $article['image_path']; ?>" alt="">
                                    <p><?php echo $article['content']; ?></p>
                                    <a href="baca_artikel.php" class="btn btn-primary mb-3">
                                        <i class="fa-solid fa-angle-left"></i> Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php
            require_once('./include/footer.php')
            ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>