<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

require_once "koneksi.php";

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

    <title>Rumah Sakit</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        require_once('navbar_admin.php')
        ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php
                require_once('topbar_admin.php')
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Halaman Daftar Rumah Sakit</h1>
                    <!-- Tombol untuk membuat rs baru -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahRumahSakitModal">
                        Tambah Rumah Sakit
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="tambahRumahSakitModal" tabindex="-1" role="dialog" aria-labelledby="tambahRumahSakitModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahRumahSakitModalLabel">Tambah Rumah Sakit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add your form here -->
                                    <form method="post" action="rumahsakit.php" enctype="multipart/form-data" id="tambahRumahSakitForm">
                                        <!-- Your form fields here -->
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
                                        <!-- Other form fields -->
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" form="tambahRumahSakitForm" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once "koneksi.php";
                    if (isset($_GET['success'])) {
                        if ($_GET['success'] === 'delete') {
                            echo '<div class="alert alert-success" role="alert">Rumah Sakit berhasil dihapus.</div>';
                        } elseif ($_GET['success'] === 'edit') {
                            echo '<div class="alert alert-success" role="alert">Rumah Sakit berhasil diperbarui.</div>';
                        } elseif ($_GET['success'] === 'add') {
                            echo '<div class="alert alert-success" role="alert">Rumah Sakit berhasil ditambahkan.</div>';
                        }
                    }

                    $query = "SELECT * FROM hospitals";
                    $result = mysqli_query($koneksi, $query);

                    if ($result) {
                        echo "<div class='card shadow mb-4'>";
                        echo "<div class='card-header py-3'>";
                        echo "<h6 class='m-0 font-weight-bold text-primary'>";
                        echo "Data Daftar Rumah Sakit";
                        echo "</h6>";
                        echo "</div>";
                        echo "<div class='card-body'>";
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>No</th>";
                        echo "<th>Nama</th>";
                        echo "<th>Alamat</th>";
                        echo "<th>Telepon</th>";
                        echo "<th>Email</th>";
                        echo "<th>Website</th>";
                        echo "<th>Gambar</th>";
                        echo "<th>Dibuat</th>";
                        echo "<th>Diperbarui</th>";
                        echo "<th>Aksi</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        $counter = 1; // Inisialisasi counter
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['website'] . "</td>";
                            echo "<td><img src='" . $row['image_path'] . "' alt='Rumah Sakit Image' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td>" . $row['created_at'] . "</td>";
                            echo "<td>" . $row['updated_at'] . "</td>";
                            echo "<td style='text-align:center'>";
                            echo "<a href='edit_rs.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit<i class='ml-2 far fa-pen-to-square'></i></a>";
                            echo "&nbsp;"; // Add a non-breaking space here for spacing
                            echo "<a href='hapus_rs.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Hapus<i class='ml-2 fa-regular fa-trash-can'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                            $counter++;
                        }

                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>"; // This closes the div for the DataTables Example

                        mysqli_free_result($result);
                    } else {
                        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
                    }
                    mysqli_close($koneksi);
                    ?>
                </div>
                <?php
                require_once('footer.php')
                ?>
            </div>
            <!-- End of Main Content -->
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