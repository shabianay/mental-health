<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="user_dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mental Health</div>
    </a>

    <hr class="sidebar-divider my-0" />
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'user_dashboard.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="user_dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <hr class="sidebar-divider my-0" />

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

    <hr class="sidebar-divider my-0" />

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="profile.php">
            <i class="fas fa-user fa-sm fa-fw"></i>
            <span>Profil</span></a>
    </li>

    <hr class="sidebar-divider my-0" />
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == '../include/logout.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="../include/logout.php">
            <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
            <span>Keluar</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

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