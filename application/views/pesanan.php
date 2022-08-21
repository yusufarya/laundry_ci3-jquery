<?php
$data = json_decode(json_encode($pageInfo), True);
$Pesanan = $data['pesananSaya'];
// echo count($Pesanan);
$pembayaran = '';
// $kodeP = '';
if (count($Pesanan) > 0) {
    $pembayaran = $Pesanan[0]['bayar'];
    // $kodeP = $Pesanan[0]['kode'];
}


$getDataBank = $this->db->query("SELECT * FROM BANK")->result();

?>
<h2 class="text-center py-2 mt-4"><?= $data['title'] ?> Saya</h2>
<hr><br>
<div class="container-fluid px-5">
    <?php echo $this->session->flashdata('message'); ?>
    <!-- <button class="btn btn-sm btn-primary my-2" style="float:right;">+ Pesanan</button> -->
    <?php if ($Pesanan) { ?>
        <table class="table table-sm">
            <thead>
                <tr style="background: #E6E6FA">
                    <th>Kode Pesan</th>
                    <th>Jenis Barang</th>
                    <th>Qty</th>
                    <th>Jenis Jasa</th>
                    <th>Alamat Anda</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Pesanan as $key => $val) { ?>
                    <?php if ($val['status'] != 'S') {
                        $kode = $val['kode'];
                    ?>
                        <tr>
                            <td><?= $kode ?></td>
                            <td><?= $val['jenis_barang'] ?></td>
                            <td><?= $val['qty'] ?></td>
                            <td><?= $val['jasa'] ?></td>
                            <td><?= $val['alamat'] ?></td>
                            <?php
                            $status = $val['status'];
                            $sts = '';
                            $tdbyr = '';
                            if ($status == ' ' || $status == null) {
                                $sts = '<div class="badge text-dark bg-warning">Menunggu pesanan di terima</div>';
                            } else if ($status == 'Y') {
                                $sts = '<div class="badge text-dark bg-info">Mempersiapkan driver</div>';
                            } else if ($status == 'D' && $val['harga'] == '') {
                                $sts = '<div class="badge text-dark bg-success">Driver menuju lokasi anda</div>';
                            } else if ($val['harga'] != null && $status == 'D') {
                                $sts = '<a class="btn btn-sm text-white bg-success">Antrian Pengerjaan</a>';
                                $tdbyr = '<td style="text-align: right; width:60px;"><a onclick="bayar(`' . $val["kode"] . '`)" class="btn btn-sm text-white bg-warning">Bayar</a></td>';
                            } else if ($val['harga'] != null && $status == 'P') {
                                $sts = '<a class="btn btn-sm text-white bg-success">Proses Pengerjaan</a>';
                                $tdbyr = '<td style="text-align: right; width:60px;"><a onclick="bayar(`' . $val["kode"] . '`)" class="btn btn-sm text-white bg-warning">Bayar</a></td>';
                            } else if ($val['harga'] != null && $status == 'A') {
                                $tdbyr = '<td style="text-align: right; width:60px;"><a onclick="bayar(`' . $val["kode"] . '`)" class="btn btn-sm text-white bg-warning">Bayar</a></td>';
                                $sts = '<a class="btn btn-sm text-white bg-success">Sedang di antar</a>';
                            }
                            ?>
                            <td style="width:180px;"><?= $sts; ?></td>
                            <?php if ($val['bayar'] != '') { ?>
                                <td style="text-align: right; width:100px;"><a class="btn btn-sm text-white bg-info" onclick="upimg('<?= $val["kode"] ?>','<?= $val["bayar"] ?>')">Kirim bukti</a>
                                <?php } else { ?>
                                <td style="text-align: right; width:100px;"><a class="btn btn-sm text-white"></a>
                                <?php } ?>
                                <?= $tdbyr ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table><br>
    <?php } else { ?>
        <div class="container text-center">
            <h4 class="text-center text-danger">Anda belum memiliki pesanan.</h4><br>
            <a href="<?= base_url('pesan') ?>" class="btn btn-sm btn-info">Pesan sekarang.</a>
        </div>
        <br><br><br><br><br><br><br><br><br><br>
    <?php } ?>
    <br>
    <hr>
</div>

<div class="modal mbayar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mt-2">
                        <table>
                            <tr>
                                <th style="width:140px;">Kode Pesan</th>
                                <td id="kode">:</td>
                            </tr>
                            <tr id="unit" style="display: none;">
                                <th style="width:140px;">Nama Barang</th>
                                <td id="nama_brg">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Qty</th>
                                <td id="qty">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Driver</th>
                                <td id="driver">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Jenis Jasa</th>
                                <td id="jasa">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Tanggal Pesanan</th>
                                <td id="tgl">:</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table">
                            <tr>
                                <th style="width:140px;">Harga</th>
                                <td id="harga">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Diskon</th>
                                <td id="diskon">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Ongkos</th>
                                <td id="ongkos">:</td>
                            </tr>
                            <tr>
                                <th style="width:140px;">Harga Netto</th>
                                <td id="netto" style="background:cyan;">:</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row justify-content-center mx-auto">
                        <select class="form-select form-select-md mb-3" name="bank" id="bank">
                            <option value="">Pilih metode pembayaran</option>
                            <?php foreach ($getDataBank as $bank) { ?>
                                <option value="<?= $bank->nama ?>"><?= $bank->nama . ' - ' . $bank->no_rek ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="kodeP" id="kodeP">
                        <!-- <?php if ($pembayaran == '' ) { ?> -->
                        <!-- <?php } else { ?>
                            <div class="col-lg-8 mt-4">
                                <h5 class="text-center bg-info py-2">Telah dibayar ✔️</h5>
                            </div>
                        <?php }  ?> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="lbayar" class="btn btn-warning">Lanjut Pembayaran</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal sbayar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Status Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="row justify-content-center mx-auto">
                        <div class="col-lg-8 mt-4">
                            <h5 class="text-center bg-info py-2">Telah dibayar ✔️</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="lbayar" class="btn btn-warning">Lanjut Pembayaran</button> 
            </div>
        </div>
    </div>
</div>

<div class="modal" id="tfbayar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mtitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="h2 alert alert-primary text-center" id="noRek"></p>
                <small>Lakukan pembayaran sebelum 5 jam kedepan</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary selesai" data-bs-dismiss="modal">Selesai</button>
                <!-- <button type="button" class="btn btn-primary">Selesai</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal" id="bukti" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kodebayar"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php echo form_open_multipart('Pesan/kirimBuktiBayar'); ?>
            <div class="modal-body">
                <div class="input-group tbayar">
                    <input type="file" class="form-control" id="img" name="img" aria-label="Upload">
                    <button class="btn btn-outline-secondary" type="button">Cari</button><br>
                </div>
                <input type="hidden" class="form-control" id="kd_byr" name="kd_byr">

            </div>
            <div class="modal-footer kirim">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>