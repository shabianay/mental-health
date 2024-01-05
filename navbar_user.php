<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}
// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}

// Lakukan koneksi ke database
require_once 'koneksi.php';
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="user_dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mental Health</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'user_dashboard.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="user_dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Tambahan</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="baca_artikel.php">Artikel</a>
                <a class="collapse-item" href="baca_rs.php">Daftar Rumah Sakit</a>
            </div>
        </div>
</li> -->
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'skrining.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="skrining.php">
            <i class="fas fa-fw fa-heart"></i>
            <span>Tes Skrining</span></a>
    </li>
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'hasil.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="hasil.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Hasil</span></a>
    </li>
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'baca_artikel.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="baca_artikel.php">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel</span></a>
    </li>
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'baca_rs.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="baca_rs.php">
            <i class="fas fa-fw fa-hospital"></i>
            <span>Rumah Sakit</span></a>
    </li>
    <!-- Nav Item - Charts -->
    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'chatbot.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="chatbot.php">
            <i class="fas fa-fw fa-robot"></i>
            <span>Chatbot</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<!-- chatbot
    <div class="chatbot-button">
        <button class="fas fa-fw fa-robot" id="open-chatbot-btn"></button>
        <div id="chatbot-container"></div>
    </div> -->
<!-- End of Sidebar -->
<!-- JavaScript with jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var chatbotOpen = false; // Menyimpan status chatbot (terbuka atau tidak)

        $('#open-chatbot-btn').on('click', function() {
            if (!chatbotOpen) {
                // Jika chatbot belum terbuka, buka chatbot
                $.ajax({
                    url: 'chatbot.php',
                    type: 'GET',
                    success: function(response) {
                        // Menempatkan respons dari chatbot.php ke dalam #chatbot-container
                        $('#chatbot-container').html(response);
                        chatbotOpen = true;
                    },
                    error: function(xhr, status, error) {
                        // Menangani kesalahan jika permintaan AJAX gagal
                        console.error(error);
                    }
                });
            } else {
                // Jika chatbot sudah terbuka, tutup chatbot
                $('#chatbot-container').empty(); // Menghapus konten chatbot
                chatbotOpen = false;
            }
        });
    });
</script>