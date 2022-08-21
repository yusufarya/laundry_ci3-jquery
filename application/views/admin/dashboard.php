<?php
$data = json_decode(json_encode($pageInfo), True);
$dataAdm = $data['dataAdm'];

$dataP = $this->Pesanan_model->getPesananList();
$dataTr = "SELECT * FROM pesanan WHERE `status` <> 'S' ";
$countTr = $this->db->query($dataTr)->num_rows();
$dataB = "SELECT * FROM pesanan WHERE status = '' ";
$countB = $this->db->query($dataB)->num_rows();

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body px-4">
                    <div class="row no-gutters align-items-center">
                        <div class="col ms-3">
                            <h3 id="date"></h3>
                            <h1 id="month"></h1>
                            <h1 id="dateTime"></h1>
                        </div>
                        <div class="col-auto mr-2">
                            <table class="table-sm" style="font-size: 14px;">
                                <tr>
                                    <th>Nama</th>
                                    <td> &nbsp; :&nbsp; <?php echo $dataAdm['nama'] ?></td>
                                </tr>
                                <tr>
                                    <th>No. Telp</th>
                                    <td> &nbsp; :&nbsp; <?php echo $dataAdm['no_telp'] ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td> &nbsp; :&nbsp; <?php echo $dataAdm['alamat'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body px-4">
                    <div class="row no-gutters align-items-center">
                        <div class="col ml-3">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pesanan
                            </div>
                            <div class="mt-3 mb-0 font-weight-bold text-gray-800"><?= $countTr ?> Pesanan dalam proses</div>
                            <a href="<?= base_url('admin/lpesanan') ?>" class="text-decoration-none text-info" style="font-size:13px;">
                                Selengkapnya..
                            </a>
                        </div>
                        <div class="col-auto me-3">
                            <i class="fas fa-dollar-sign text-warning fa-2x "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body px-4">
                    <div class="row no-gutters align-items-center">
                        <div class="col ml-3">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Pesanan Masuk
                            </div>
                            <div class="mt-3 mb-0 font-weight-bold text-gray-800"><?= $countB ?> Pesanan perlu di konfirmasi</div>
                            <a href="<?= base_url('admin/pesanan') ?>" class="text-decoration-none text-primary" style="font-size:13px;">
                                Selengkapnya..
                            </a>
                        </div>
                        <div class="col-auto me-2 mt-3">
                            <i class="fas fa-clipboard-list fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-8 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Transaksi Terbaru</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row px-3">
                        <?php
                        $data = $dataP;
                        ?>
                        <table>
                            <tr>
                                <th style="width:150px;">Kode Pesanan</th>
                                <th>Nama Customer</th>
                                <th>Jenis Jasa</th>
                                <th>Jam</th>
                            </tr>
                            <?php foreach ($data as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['kode'] ?></td>
                                    <td><?= $value['nama_cust'] ?></td>
                                    <td><?= $value['jasa'] ?></td>
                                    <td><?= $value['jam'] ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <br>
                        <hr>
                    </div>
                    <div class="mt-4 text-center small">
                        <a href="<?= base_url('admin/pesanan') ?>" class="text-decoration-none">Lihat Pesanan</a>
                        <!-- <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->