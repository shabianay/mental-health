<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <?php
        // Include file koneksi ke database
        include_once "koneksi.php";
        $user_id = $_SESSION['user_id']; // Ambil ID pengguna dari sesi
        // Lakukan query untuk mendapatkan nama lengkap pengguna berdasarkan ID
        $query = "SELECT Namalengkap FROM users WHERE id = $user_id";
        $result = mysqli_query($koneksi, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $namaLengkap = $user['Namalengkap'];
            // Gunakan $full_name untuk menampilkan nama lengkap di halaman
        } else {
            // Handle jika data tidak ditemukan atau ada kesalahan lainnya
        }
        ?>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $namaLengkap; ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->