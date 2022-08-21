<?php
$data = json_decode(json_encode($pageInfo), True);

$getDay = "SELECT * FROM `hari`";
$days = $this->db->query($getDay)->result_array();

$dates = date('Y-m-d');
$d = explode('-',$dates);
$tgl = '01';
$bln = $d[1];
$thn = $d[0];
$date = $thn.'-'.$bln.'-'.$tgl;
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-3 text-dark"><?= $data['title'] ?></h1>
        <hr><br><br>

    </div>
    <!-- Content Row -->
    <div class="row mt-4 mt-5 mb-5">
        <div class="col-lg-8 mb-5">
            <!-- <form action="" method="post"> -->
            <div class="row">

                <div class="mb-3 col-lg-6">
                    <label for="kodeP" class="form-label">Kode Pesanan</label>
                    <input type="text" placeholder="LNDXXXXXXXXX" class="form-control" name="kodeP" id="kodeP">
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="statusP" class="form-label">Status Pesanan</label>
                    <select name="statusP" id="statusP" class="form-select">
                        <option value="">Pilih semua</option>
                        <option value="D">Penjemputan</option>
                        <option value="P">Sedang di proses</option>
                        <option value="A">Pengantaran</option>
                        <option value="S">Telah selesai</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="tgl" class="form-label">Tanggal <span id="harus">*</span></label>
                    <input type="date" class="form-control" name="tgl" id="tgl">
                </div>
                <div class="mb-3 col-lg-6">
                    <label for="tgl" class="form-label">S/D <span id="harus">*</span></label>
                    <input type="date" class="form-control" name="tgls" id="tgls">
                </div>
                <div class="mb-3 col-lg-6 ">
                    <label for="hari" class="form-label">Urutkan berdasarkan <span id="harus">*</span></label>
                    <select name="orderby" id="orderby" class="form-select">
                        <!-- <option value="">Urutkan berdasarkan</option> -->
                        <option value="kode">Kode</option>
                        <option value="nama_pelanggan">Nama</option>
                        <option value="tanggal">Tanggal</option>
                    </select>
                </div>
                <div class="mb-3 col-lg-6 pt-2">
                    <button class="btn btn-warning mt-4" id="btn-rekap"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
    <br>
    <br>
    <hr>

</div>
<!-- /.container-fluid -->