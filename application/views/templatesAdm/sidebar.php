<?php
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-bath" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Laundry <sup>ID</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $data['active'] == 'Dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Mbarang -->
    <li class="nav-item <?php echo $data['active'] == 'Mbarang' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/mBarang') ?>">
            <i class="fas fa-cube"></i>
            <span>Master Barang</span>
        </a>
    </li>
    <!-- Nav Item - Pesanan -->
    <li class="nav-item <?php echo $data['active'] == 'Pesanan' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/pesanan') ?>">
            <i class="fas fa-shopping-cart"></i>
            <span>Pesanan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Pengguna
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?php echo $data['active'] == 'Pengguna' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Pengguna</span>
        </a>
        <div id="collapsePages1" class="collapse <?php echo $data['active'] == 'Pengguna' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="<?= base_url('admin/custList') ?>">Data Pelanggan</a>
                <a class="collapse-item" href="<?= base_url('admin/driverList') ?>">Data Driver</a>
                <!-- <div class="collapse-divider"></div> -->

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?php echo $data['active'] == 'Laporan' ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan</span>
        </a>
        <div id="collapsePages" class="collapse <?php echo $data['active'] == 'Laporan' ? 'show' : '' ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="<?= base_url('admin/Lpesanan') ?>">Laporan Pesanan</a>
                <a class="collapse-item" href="<?= base_url('admin/transaksi') ?>">Laporan Transaksi</a>
                <a class="collapse-item" href="<?= base_url('admin/laprekap') ?>">Laporan Rekapulasi</a>
                <!-- <div class="collapse-divider"></div> -->

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    <!-- Nav Item - Tables -->
    <li class="nav-item <?php echo $data['active'] == 'Password' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/ubahPassword') ?>">
            <i class="fas fa-fw fa-table"></i>
            <span>Ubah Kata Sandi</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->