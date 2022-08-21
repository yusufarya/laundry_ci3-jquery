<?php
$data = json_decode(json_encode($pageInfo), True);

$kode = '';
$urut = 000;
// $kode = sprintf("%05d", $kode+1);

$waktu = date('ymd');
$getKode = $this->Pesanan_model->getKodePesan();
$cekkode = count($getKode);
if ($cekkode <= 0) {
    $kodes = 'LND' . $waktu;
    $kode = sprintf('%03d', $urut + 1);
    $kode = $kodes . $kode;
} else {
    $kod = $getKode[0]['kode'];
    $kodes = substr($kod, 0, 9);
    $urut = substr($kod, 9, 11);
    $kode = sprintf('%03d', $urut + 1);
    $kode = $kodes . $kode;
}
$kodes = $kode;

$me = $data['Me'];

$jnsJasa = "SELECT * FROM `jns_jasa`";
$getJnsJasa = $this->db->query($jnsJasa)->result_array();

$dataBrg = "SELECT * FROM `data_barang`";
$getdataBrg = $this->db->query($dataBrg)->result_array();
// print_r($getdataBrg);
?>
<div class="container-fluid">
    <h2 class="text-center py-1 mt-3"><?= $data['title'] ?></h2>
    <hr><br>
    <div class="row px-3">
        <div class="col-lg-12">
            <div class="row mt-1">
                <div class="mb-2 col-lg-2">
                    <label for="kode" class="form-label">Kode Booking <span id="harus">*</span></label>
                    <input type="text" class="form-control" name="kode" id="kode" placeholder="LNDXXXXXXXXX" readonly>
                </div>
                <div class="mb-2 col-lg-4">
                    <label for="nama" class="form-label">Nama <span id="harus">*</span></label>
                    <input type="text" readonly class="form-control" name="nama" id="nama" placeholder="Nama anda" value="<?= $me['nama'] ?>">
                    <input type="hidden" class="form-control" name="kodecust" id="kodecust" value="<?= $me['kode'] ?>">
                </div>
                <div class="mb-2 col-lg-3">
                    <label for="jns_kel" class="form-label">Jenis Kelamin <span id="harus">*</span></label>
                    <input type="text" readonly class="form-control" name="jns_kel" id="jns_kel" value="<?= $me['jenis_kel'] ?>">
                </div>
            </div>
            <div class="row mt-1">
                <div class="mb-2 col-lg-2">
                    <label for="no_telp" class="form-label">No. Telp <span id="harus">*</span></label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="+62 XXXX XXXX XX" value="<?= $me['no_telp'] ?>">
                    <small id="harus" class="errTelp"></small>
                </div>
                <div class="mb-2 col-lg-7">
                    <label for="alamat" class="form-label">Alamat <span id="harus">*</span></label>
                    <button type="button" class="btn btn-sm currLoc" data-bs-toggle="tooltip" data-bs-placement="top" title="Gunakan alamat saat ini">
                        <i class="bi bi-question-diamond text-warning"></i>
                    </button>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat anda">
                    <small id="harus" class="errAlamat"></small>
                </div>

                <div class="col-lg-9 mt-3">
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="jns_brg" class="form-label" require>Jenis barang <span class="text-danger">*</span> </label>
                            <select name="jns_brg" id="jns_brg" class="form-select">
                                <option value="">Pilih jenis barang</option>
                                <option value="KG">KG</option>
                                <option value="UNIT">UNIT</option>
                            </select>
                            <small id="harus" class="errSat"></small>
                            <input type="hidden" class="form-control" name="estimasi" id="estimasi" placeholder="...">
                        </div>
                        <div class="col-lg-8">
                            <label for="keterangan" class="form-label">Catatan </label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="...">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 mt-3" id="pil_unit">
                    <!-- <label for="jasa" class="form-label">Pilih jasa <span id="harus">*</span></label> -->
                    <select name="barang" id="barang" class="form-select">
                        <option value=''> Pilih barang <span class="text-danger">*</span></option>
                        <?php foreach ($getdataBrg as $key => $val) { ?>
                            <option value="<?= $val['nama'] ?>">&nbsp;<?= $val['nama'] . ' &nbsp;&nbsp; /&nbsp;&nbsp; Rp.' . number_format($val['harga']) ?></option>
                        <?php } ?>
                    </select>
                    <small class="text-warning">Jika barang anda tidak ada di daftar ini, maka kami tidak bisa menerima.</small>
                </div>
                <div class="col-lg-9 mt-3">
                    <div class="row next mt-3">
                        <div class="col-lg-5">
                            <!-- <label for="jasa" class="form-label">Pilih jasa <span id="harus">*</span></label> -->
                            <select name="jasa" id="jasa" class="form-select">
                                <option value=''> Pilih jenis jasa <span class="text-danger">*</span></option>
                                <?php foreach ($getJnsJasa as $key => $val) { ?>
                                    <option value="<?= $val['kode'] ?>">&nbsp;<?= $val['kode'] . ' - ' . $val['jenis'] . ' / Rp.' . number_format($val['harga']) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-lg-1">
                            <button class="btn btn-primary" id="btnNext">
                                Lanjutkan
                            </button>
                        </div>
                        <div class="col-lg-2 ms-4">
                            <a href="#" class="badge py-2 mt-2 bg-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Rp.5.000/kg">
                                Info harga
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-9">
                    <table class="table table-sm" id="detail">
                        <thead>
                            <tr style="background: #acacac">
                                <th>&nbsp;Kode</th>
                                <th>Jenis Barang</th>
                                <th style="text-align: left;">Qty</th>
                                <th style="text-align: left;">Satuan</th>
                                <!-- <th style="text-align: center;">Selesai</th> -->
                                <th style="text-align: right;">Aksi &nbsp;</th>
                            </tr>
                        </thead>
                        <tbody id='tr-td'>

                        </tbody>
                    </table>
                </div>
                <!-- <div class="row bottom align-items-center">
                    <div class="col-lg-2">
                        <label for="harga" class="col-form-label">Harga</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" id="harga" name="harga" class="form-control">
                        <input type="hidden" id="harga1" name="harga1" class="form-control">
                    </div>  
                </div>
                
                <div class="row mt-1 bottom align-items-center">
                    <div class="col-lg-2">
                        <label for="diskon" class="col-form-label">Diskon %</label>
                    </div>
                    <div class="col-lg-3">
                        <div class="row">
                            <div style="width:38%; padding-right:2px;">
                                <input type="text" id="diskon" name="diskon" maxlength="2" class="form-control">
                            </div> 
                            <diV style="width:62%; padding-left:1px;;"> 
                                <input type="text" id="diskon1" name="diskon1" class="form-control">
                                <input type="hidden" id="dis1" name="dis1" class="form-control">
                            </diV>
                        </div>
                    </div> 
                </div> 
                
                <div class="row bottom mt-2 align-items-center">
                    <div class="col-lg-2">
                        <label for="ongkos" class="col-form-label">Ongkir</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" id="ongkos" name="ongkos" class="form-control">
                        <input type="hidden" id="ongkos1" name="ongkos1" class="form-control">
                    </div> 
                </div> 
                <div class="row bottom mt-2 align-items-center">
                    <div class="col-lg-2">
                        <label for="harganet" class="col-form-label">Netto</label>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" id="harganet" name="harganet" class="form-control">
                        <input type="hidden" id="harganet1" name="harganet1" class="form-control">
                    </div> 
                </div> 
                <div class="row bottom mt-2 align-items-center"><br><hr>
                    <div class="col-lg-5">
                        <button class="btn btn-primary" id="pesanSekarang">Pesan Sekarang</button>
                        <a href="<?= base_url('home') ?>" class="btn btn-secondary">Batal</a>
                    </div>
                    
                </div>  -->
            </div>

        </div>
    </div>
</div>
<br>
<hr>

<div class="modal" tabindex="-1" id="modalDetail">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-sm" id="rinci">

                        </table>
                        <hr><br>
                        <div style="float:left;">
                            <?php
                            $date = date('Y-m-d');
                            $jam = date('H:i');
                            ?>
                            <b> &nbsp; &nbsp;Jam Pesan &nbsp;&nbsp;&nbsp;&nbsp;</b><input type="time" name="jam" id="jam" class="form-control ms-2" value="<?= $jam ?>">
                            <input type="hidden" name="tanggal" id="tanggal" class="form-control" value="<?= $date ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning" id="btnPesan">Pesan Sekarang</button>
            </div>
        </div>
    </div>
</div>