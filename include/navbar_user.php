<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="user_dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-spa"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MIndful</div>
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
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'riwayat.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="riwayat.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Riwayat Skrining</span></a>
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
        <a href="#" class="nav-link" data-toggle="modal" data-target="#logoutConfirmationModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw"></i>
            <span>Keluar</span>
        </a>
    </li>
    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="logoutConfirmationModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa-regular fa-face-smile mr-2"></i>Batal</button>
                    <a href="../include/logout.php" class="btn btn-primary"><i class="fa-regular fa-face-frown mr-2"></i>Yakin dong</a>
                </div>
            </div>
        </div>
    </div>

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