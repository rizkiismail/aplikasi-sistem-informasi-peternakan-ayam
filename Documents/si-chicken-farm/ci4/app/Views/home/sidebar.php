<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-archive"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIPDATA <sup>WEB</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">



    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kelola Data</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="/recording">Data Recording</a>
                <a class="collapse-item" href="/pakan">Data Pakan</a>
                <a class="collapse-item" href="/obat">Data Obat</a>
                <a class="collapse-item" href="/bibit">Data Bibit</a>
                <a class="collapse-item" href="/panen">Data Panen</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePage" aria-expanded="true" aria-controls="collapsePage">
            <i class="fas fa-fw fa-table"></i>
            <span>Laporan</span></a>
        </a>
        <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href="/recording/report">Data Recording</a>
                <a class="collapse-item" href="/pakan/report">Data Pakan</a>
                <a class="collapse-item" href="/obatmasuk/report">Data Obat</a>
                <a class="collapse-item" href="/pengobatan/report">Data Pengobatan</a>
                <a class="collapse-item" href="/obat/report">Data Stok Obat</a>
                <a class="collapse-item" href="/bibit/report">Data Bibit</a>
                <a class="collapse-item" href="/panen/report">Data Panen</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/stokayam/index">
            <i class="fas fa-fw fa-cog"></i>
            <span>Atur Ulang Stok</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->