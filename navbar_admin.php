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
    <li class="nav-item active">
        <a class="nav-link" href="admin_dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="soal.php">
            <i class="fas fa-fw fa-cog"></i>
            <span>Bank Soal</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="artikel.php">Crud Artikel</a>
                <a class="collapse-item" href="rumahsakit.php">Crud Rumah Sakit</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Data Pengguna -->
    <li class="nav-item">
        <a class="nav-link" href="pengguna.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Pengguna</span></a>
    </li>

    <!-- Nav Item - Laporan -->
    <li class="nav-item">
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