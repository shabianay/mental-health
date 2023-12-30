<?php
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Include the database connection file
    include_once "koneksi.php";

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Query the database to get the user's full name based on their ID
    $query = "SELECT Namalengkap FROM users WHERE id = $user_id";
    $result = mysqli_query($koneksi, $query);

    // Check if the query was successful and if it returned any rows
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user's full name from the query result
        $user = mysqli_fetch_assoc($result);
        $namaLengkap = $user['Namalengkap'];
    } else {
        // Handle the case where the user's full name is not found
        $namaLengkap = "Unknown User";
    }
} else {
    // If the user is not logged in, set a default value for $namaLengkap
    $namaLengkap = "Guest";
}
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $namaLengkap; ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->