<?php
$data = json_decode(json_encode($pageInfo), True);
$dataBrg = $this->db->query("SELECT * FROM `data_barang`")->result_array();
$kodebrg = $this->db->query("SELECT kode FROM `data_barang` ORDER BY kode DESC LIMIT 1")->row_array();
$kodebrg = $kodebrg['kode'];
$kode = sprintf('%03d', $kodebrg + 1);
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
        <button class="btn btn-primary col-lg-2 mb-1" id="add">
            Tambah data barang
        </button>
        <table class="table table-sm table-striped">
            <thead class="bg-info">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th style="width:90px; text-align:left;">Harga</th>
                    <th style="text-align:right;">Aksi &nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataBrg as $key => $val) { ?>
                    <tr>
                        <td style="width: 70px;"><?= $val['kode'] ?></td>
                        <td><?= $val['nama'] ?></td>
                        <td style="width:90px;">Rp.<?= number_format($val['harga'], 2) ?></td>
                        <td style="text-align:right; width:90px;">
                            <a href="#" onclick="updateBrg('<?= $val['kode'] ?>','<?= $val['nama'] ?>','<?= $val['harga'] ?>')" class="badge bg-success"><i class="bi bi-pencil"></i></a>
                            <a href="#" onclick="deleteBrg('<?= $val['kode'] ?>')" class="badge bg-danger"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div><br><br><br>
    <br>
    <hr>

</div>
<!-- /.container-fluid -->

<div class="modal" id="myModal" tabindex="-1">
    <div class="modal-dialog modal-lg rounded" style="box-shadow: 20PX 20px 99px #000000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Order Pesanan</h5>
            </div>
            <div class="modal-body p-3" id="isibody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary px-4">Print</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal DelBrg" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control-plaintext" id="delkode">
         <p id="hapus"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btnDel">Ya, hapus</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah data barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Kode Barang<input type="text" class="form-control" id="kode1">
                <div class="mb-3 mt-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama1" placeholder="Brg01">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga/unit</label>
                    <input type="text" class="form-control" id="harga1" placeholder="Rp.000">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSaveAdd">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="update" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update data barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Kode Barang<input type="text" class="form-control" id="kode">
                <div class="mb-3 mt-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama" placeholder="Brg01">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga/unit</label>
                    <input type="text" class="form-control" id="harga" placeholder="Rp.000">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="btnSave">Simpan</button>
            </div>
        </div>
    </div>
</div>