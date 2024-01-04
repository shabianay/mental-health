<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin_dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mental Health</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="admin_dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item collapsed <?php echo basename($_SERVER['PHP_SELF']) === 'soal.php' || basename($_SERVER['PHP_SELF']) === 'soal_group.php' ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSoal" aria-expanded="true" aria-controls="collapseSoal">
            <i class="fas fa-fw fa-cog"></i>
            <span>Soal</span>
        </a>
        <div id="collapseSoal" class="collapse" aria-labelledby="headingSoal" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="soal.php">Soal</a>
                <a class="collapse-item" href="soal_group.php">Kategori Soal</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed <?php echo basename($_SERVER['PHP_SELF']) === 'artikel.php' || basename($_SERVER['PHP_SELF']) === 'rumahsakit.php' ? 'active' : ''; ?>" href="#" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="true" aria-controls="collapseMasterData">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse" aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="artikel.php">Artikel</a>
                <a class="collapse-item" href="rumahsakit.php">Rumah Sakit</a>
            </div>
        </div>
    </li> -->

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'artikel.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="artikel.php">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Artikel</span></a>
    </li>

    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'rumahsakit.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="rumahsakit.php">
            <i class="fas fa-fw fa-hospital"></i>
            <span>Rumah Sakit</span></a>
    </li>

    <!-- Nav Item - Data Pengguna -->
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'pengguna.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="pengguna.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pengguna</span></a>
    </li>

    <!-- Nav Item - Laporan -->
    <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'laporan.php' ? 'active' : ''; ?>">
        <a class="nav-link" href="laporan.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span></a>
    </li>

    <!-- Divider -->
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