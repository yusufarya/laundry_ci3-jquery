<?php
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 mx-2 text-dark"><?= $data['title'] ?></h1>
        <hr>
    </div>
    <!-- Content Row -->
    <div class="row mt-4 mx-2">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th style="width:50px; text-align:center;">Jam</th>
                    <th style="width:300px; text-align:left;">Alamat</th>
                    <th style="width:70px; text-align:center;">Jasa</th>
                    <th style="text-align:right;">Aksi &nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pesanan'] as $key => $val) { ?>
                    <tr>
                        <td style="width:90px;"><?= $val['kode'] ?></td>
                        <td style="width:100px;"><?= $val['nama_cust'] ?></td>
                        <td style="width:30px; text-align:center;"><?= $val['jam'] ?></td>
                        <td style="width:320px; text-align:left;"><?= $val['alamat'] ?></td>
                        <td style="width:50px; text-align:center;"><?= $val['jasa'] ?></td>
                        <td style="text-align:right; width:50px;">
                            <?php
                            if ($val['harga'] != '') { ?>
                                <button class="btn btn-sm px-4 btn-light">✔️</button>
                            <?php } else { ?>
                                <button class="btn btn-sm btn-success" onclick="accBooking('<?= $val['kode'] ?>', '<?= $val['ongkos'] ?>', '<?= $val['jenis_barang'] ?>', '<?= $val['barang'] ?>')">Update</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table><br>
    </div><br><br><br><br><br>
    <br><br><br><br>
    <br>
    <hr>

</div>
<!-- /.container-fluid -->

<div class="modal" id="acc" tabindex="-1">
    <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-body p-3" id="isibody">
                <div class="row">
                    <div class="col-lg-4">Quantity</div>
                    <input type="hidden" class="form-control" name="kode" id="kode">
                    <div class="col-lg-2">
                        <input type="text" class="form-control" name="qty" id="qty" placeholder="0.00" autocomplete='off'>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="jns_brg" id="jns_brg" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 col-lg-4">Harga</div>
                    <div class="mb-2 col-lg-6">
                        <input type="text" class="form-control" name="harga" id="harga" placeholder="0.00" readonly>
                        <input type="hidden" class="form-control" name="hargaU" id="hargaU" placeholder="0.00" readonly>
                        <input type="hidden" class="form-control" name="hargaIn" id="hargaIn" placeholder="0.00" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 col-lg-4">Diskon %</div>
                    <div class="mb-2 col-lg-2">
                        <input type="text" class="form-control" name="diskon" id="diskon" value="0.00" readonly>
                    </div>
                    <div class="mb-2 col-lg-4">
                        <!-- <label for="diskon1" class="form-label">Harga diskon</label> -->
                        <input type="text" class="form-control" name="diskon1" id="diskon1" placeholder="0.00" readonly>
                        <input type="hidden" class="form-control" name="disp" id="disp" value="0.00" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 col-lg-4">Ongkos Kirim</div>
                    <div class="mb-2 col-lg-6">
                        <!-- <label for="ongkos" class="form-label">Ongkir</label> -->
                        <input type="text" class="form-control" name="ongkos" id="ongkos" placeholder="0.00" readonly>
                        <input type="hidden" class="form-control" name="ongkosIn" id="ongkosIn" placeholder="0.00" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-2 col-lg-4">Harga Netto</div>
                    <div class="mb-2 col-lg-6">
                        <!-- <label for="netto" class="form-label">Harga Nett</label> -->
                        <input type="text" class="form-control" name="netto" id="netto" placeholder="0.00" readonly>
                        <input type="hidden" class="form-control" name="nettoIn" id="nettoIn" placeholder="0.00" readonly>
                    </div>
                </div>
                <div class="row brgunit">
                    <div class="mb-2 col-lg-4">Nama Barang</div>
                    <div class="mb-2 col-lg-10">
                        <input type="text" class="form-control" name="nama_brg" id="nama_brg" readonly>
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