<?php
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-dark"><?= $data['title'] ?></h1>
        <hr>

    </div>
    <!-- Content Row -->
    <div class="row mt-4">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th style="width:90px; text-align:center;">Jam</th>
                    <th style="width:320px; text-align:left;">Alamat</th>
                    <th style="width:70px; text-align:center;">Jasa</th>
                    <th style="text-align:center;">Bayar</th>
                    <th style="text-align:center;">Aksi &nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pesanan'] as $key => $val) { ?>
                    <?php if ($val['status'] != 'S') { ?>
                        <tr ondblclick="loadPopInfo('<?= $val['kode'] ?>')">
                            <td style="width:90px;"><?= $val['kode'] ?></td>
                            <td style="width:100px;"><?= $val['nama_cust'] ?></td>
                            <td style="width:30px; text-align:center;"><?= $val['jam'] ?></td>
                            <td style="width:320px; text-align:left;"><?= $val['alamat'] ?></td>
                            <td style="width:50px; text-align:center;"><?= $val['jasa'] ?></td>
                            <td style="width:50px; text-align:center;">
                                <?php if ($val['bayar'] == 'YY') { ?>
                                    <button type="button" onclick="lihatBukti('<?= $val['kode'] ?>')" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Bukti Pembayaran">Lunas</button>
                                <?php } ?>
                            </td>
                            <td style="text-align:center; width:50px;">
                                <?php if ($val['harga'] == null && $val['status'] == 'D') { ?>
                                    <button class="btn btn-sm btn-info" onclick="Progres('<?= $val['kode'] ?>')">Penjemputan</button>
                                <?php } else if ($val['status'] == 'Y' && $val['harga'] == null) { ?>
                                    <button class="badge text-dark p-2 bg-danger" onclick="Progres('<?= $val['kode'] ?>')">Belum Acc D</button>
                                <?php } else if ($val['status'] == 'A' && $val['harga'] != null) { ?>
                                    <button class="btn btn-sm text-white px-3 bg-success" onclick="Selesaikan('<?= $val['kode'] ?>')">Selesaikan</button>
                                <?php } else if ($val['status'] == 'P' && $val['harga'] != null) { ?>
                                    <button class="btn btn-sm text-white px-3 bg-primary" onclick="AntarPsn('<?= $val['kode'] ?>')">Antar Pesanan</button>
                                <?php } else if ($val['harga'] != null && $val['status'] == 'D') { ?>
                                    <button class="badge text-dark py-2 bg-secondary" onclick="Progres('<?= $val['kode'] ?>')">Sampai toko</button>
                                <?php } ?>
                            </td>

                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table><br>
    </div>
    <br>
    <hr>

</div>
<!-- /.container-fluid -->

<div class="modal" id="myModal" tabindex="-1">
    <div class="modal-dialog modal-lg rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-body p-3" id="isibody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary px-4">Print</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal" id="acc" tabindex="-1">
    <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-body p-3" id="isibody">
                <div class="row">
                    <hr>
                    <input type="hidden" id="kodeP" name="kodeP">
                    <div class="col-lg-10">
                        <select class="form-select" id="status" name="status">
                            <option selected>Proses</option>
                            <option value="P">Proses Laundry</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary px-4" id="btnSave">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="done" tabindex="-1">
    <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-body p-3" id="isibody">
                <div class="row">
                    <hr>
                    <h3>Selesaikan Pesanan</h3>
                    <input type="hidden" id="kodeP" name="kodeP">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary px-4" id="btnDone">Ya</button>
            </div>
        </div>
    </div>
</div>

<?php
$qry = "SELECT * FROM driver";
$driver = $this->db->query($qry)->result_array();
?>

<div class="modal" id="antarP" tabindex="-1">
    <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-body p-3" id="isibody">
                <div class="row">
                    <hr>
                    <input type="hidden" id="kodePs" name="kodePs">
                    <div class="col-lg-10">
                        <select class="form-select" id="driver" name="driver">
                            <option value="">Pilih driver</option>
                            <?php foreach ($driver as $dr) { ?>
                                <option value="<?= $dr['kode']; ?>"><?= $dr['kode'] . ' - ' . $dr['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary px-4" id="btnSaveA">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="buktiBayar" tabindex="-1">
    <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Pembayaran</h5>
            </div>
            <div class="modal-body gambar p-3" id="isibody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary px-4">Print</button> -->
            </div>
        </div>
    </div>
</div>