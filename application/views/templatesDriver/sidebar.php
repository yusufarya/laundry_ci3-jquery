<?php 
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15"> 
            <i class="fa fa-motorcycle" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Laundry <sup>ID</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo $data['active'] == 'Dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard/home') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Pesanan
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php echo $data['active'] == 'Pesanan' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('driverPage/pesanan') ?>">
            <i class="fas fa-shopping-cart"></i>
            <span>Pesanan</span>
        </a>
    </li>
    
    <li class="nav-item <?php echo $data['active'] == 'upPesanan' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('driverPage/upPesanan') ?>">
            <i class="fas fa-shopping-cart"></i>
            <span>Update Pesanan</span>
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