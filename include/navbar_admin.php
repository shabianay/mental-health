<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-spa"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MIndful</div>
    </a>

    <hr class="sidebar-divider my-0" />
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="admin_dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0" />
    <li class="nav-item collapsed <?php echo basename($_SERVER['PHP_SELF']) === 'soal.php' || basename($_SERVER['PHP_SELF']) === 'soal_group.php' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSoal" aria-expanded="true" aria-controls="collapseSoal">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kelola Soal</span>
        </a>
        <div id="collapseSoal" class="collapse" aria-labelledby="headingSoal" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="soal.php">Butir Soal</a>
                <a class="collapse-item" href="soal_group.php">Grup Soal</a>
                <a class="collapse-item" href="sub_soal_group.php">Sub-Kriteria</a>
                <a class="collapse-item" href="alternatif.php">Alternatif</a>
            </div>
        </div>
    </li>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'artikel.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="artikel.php">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel</span>
        </a>
    </li>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'rumahsakit.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="rumahsakit.php">
            <i class="fas fa-fw fa-hospital"></i>
            <span>Rumah Sakit</span>
        </a>
    </li>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'pengguna.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="pengguna.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pengguna</span>
        </a>
    </li>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="laporan.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span>
        </a>
    </li>

    <hr class="sidebar-divider my-0" />

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'admin_profile.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="admin_profile.php">
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
<!-- End of Sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all the navigation links
        var navLinks = document.querySelectorAll('.nav-link');

        // Add click event listeners to each link
        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Remove the "active" class from all links
                navLinks.forEach(function(navLink) {
                    navLink.classList.remove('active');
                });

                // Add the "active" class to the clicked link
                this.classList.add('active');
            });
        });
    });
</script>