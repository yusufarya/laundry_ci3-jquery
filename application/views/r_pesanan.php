<?php
$data = json_decode(json_encode($pageInfo), True);
$Pesanan = $data['pesananSaya'];

// $pembayaran = $Pesanan[0]['bayar'];
// $kodeP = $Pesanan[0]['kode'];
$me = $data['Me'];
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
                    <th style="text-align:left;">Harga</th>
                    <th style="text-align:center;">~~~~</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Pesanan as $key => $val) { ?>
                    <?php if ($val['status'] == 'S') { ?>
                        <tr>
                            <td><?= $val['kode'] ?></td>
                            <td><?= $val['jenis_barang'] ?></td>
                            <td><?= $val['qty'] ?></td>
                            <td><?= $val['jasa'] ?></td>
                            <td><?= $val['alamat'] ?></td>
                            <?php
                            $hrg = $val['harga'];

                            ?>
                            <td style="width:110px;"><?= number_format($hrg, 2); ?></td>
                            <td style="width:50px;">
                                <?php if ($val['penilaian'] == 'Y') { ?>
                                    <a class="btn btn-sm text-dark bg-warning px-3" onclick="nilaiLNDR('<?= $val["kode"] ?>','<?= $val["penilaian"] ?>')"> <i class="bi bi-eye-fill"></i>
                                    <?php } else { ?>
                                        <a class="btn btn-sm text-dark bg-warning" onclick="nilaiLNDR('<?= $val["kode"] ?>','<?= $val["penilaian"] ?>')">Nilai</a>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table><br>
    <?php } else { ?>
        <div class="container text-center">
            <h4 class="text-center text-danger">Anda belum memiliki riwayat pesanan.</h4><br>
            <a href="<?= base_url('pesan') ?>" class="btn btn-sm btn-info">Pesan sekarang.</a>
        </div>
        <br><br><br><br><br><br><br><br><br><br>
    <?php } ?>
    <br>
    <hr>
</div>


<div class="modal" id="PenilaianM" tabindex="-1">
    <div class="modal-dialog modal-lg rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penilaian</h5>
            </div>
            <div class="modal-body p-3" id="isibody">
                <div class="row mt-1">
                    <input type="hidden" class="form-control" name="kodePesan" id="kodePesan">
                    <div class="mb-2 col-lg-4">
                        <label for="nama" class="form-label">Nama <span id="harus">*</span></label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $me['nama'] ?>" readonly>
                    </div>
                    <div class="mb-2 col-lg-4">
                        <input type="hidden" class="form-control" name="rate" id="rate" readonly>
                        <label class="form-label">&nbsp; </label><br>
                        <label for="nilai" class="form-label">Nilai <span id="harus">* &nbsp;</span></label>
                        <a href="#" id="1" class="text-decoration-none text-dark"><i class="bi bi-star"></i></a>
                        <a href="#" id="2" class="text-decoration-none text-dark"><i class="bi bi-star"></i></a>
                        <a href="#" id="3" class="text-decoration-none text-dark"><i class="bi bi-star"></i></a>
                        <a href="#" id="4" class="text-decoration-none text-dark"><i class="bi bi-star"></i></a>
                        <a href="#" id="5" class="text-decoration-none text-dark"><i class="bi bi-star"></i></a>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="komentar" name="komentar"></textarea>
                        <label for="floatingTextarea"> &nbsp; Komentar...</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary px-4" id="btn-nilai">Kirim</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="PenilaianM1" tabindex="-1">
    <div class="modal-dialog modal-lg rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penilaian Saya</h5>
            </div>
            <div class="modal-body p-3" id="isibody">
                <div class="row mt-1">
                    <!-- <input type="hidden" class="form-control" name="kodePesan1" id="kodePesan1"> -->
                    <div class="mb-2 col-lg-4">
                        <label class="form-label">&nbsp; </label><br>
                        <input type="text" class="form-control" value="<?= $me['nama'] ?>" readonly>
                    </div>
                    <div class="mb-2 col-lg-4">
                        <label class="form-label">&nbsp; </label><br>
                        <label for="nilai" class="form-label">Nilai &nbsp; <span id="stars"> &nbsp;</span></label>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="isikomen" name="isikomen" disabled></textarea>
                        <label for="floatingTextarea" id="isikomen"> &nbsp; Komentar saya...</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary px-4" id="btn-nilai">Kirim</button> -->
            </div>
        </div>
    </div>
</div>