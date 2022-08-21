<?php
$cekSession = $this->db->get_where('customer', ['email' => $this->session->userdata('email')])->row_array();
?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light" style="background:linear-gradient(45deg, #E6E6FA, #F8F8FF);">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('home') ?>" style="font-family:hobo std;">LAUNDRY </a>||
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 pt-2 ms-3 mb-lg-0" style="font-family: helvetica !important; font-size: 13.5px;">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active == 'HOME' ? 'active' : '' ?>" href="<?= base_url('home') ?>">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active == 'PESANAN' ? 'active' : '' ?>" href="<?= base_url('home/pesanan') ?>">PESANAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active == 'RPESANAN' ? 'active' : '' ?>" href="<?= base_url('home/riwayatPesanan') ?>">RIWAYAR PESANAN</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <button type="button" class="btn btn-info  text-white info-topBar"><i class="bi bi-info-square"></i></button> &nbsp; || &nbsp;
                    <?php
                    if ($cekSession == '' or $cekSession == NULL) { ?>
                        <a href="<?= base_url('login') ?>" class="text-dark btn btn-outline-warning py-1">Login <i class="bi bi-box-arrow-in-right"></i></a>
                    <?php } else { 
                        $me = $cekSession;
                    ?>
                        <a href="<?php echo base_url('me') ?>" class="text-decoration-none" style="font-weight:600;"><?= $me['nama'] ?></a> &nbsp;&nbsp;&nbsp;
                        <button class="text-dark btn btn-outline-secondary py-1" data-bs-toggle="modal" data-bs-target="#logout">Logout <i class="bi bi-box-arrow-right"></i></button>
                    <?php } ?>
                </span>
            </div>
        </div>
    </nav>
</div>