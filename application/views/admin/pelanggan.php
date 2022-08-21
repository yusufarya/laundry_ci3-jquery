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
                    <th style="width:20px;">Kode</th>
                    <th style="width:160px;">Nama</th>
                    <th style="width:110px; text-align:left;">Jns Kelamin</th>
                    <th style="width:300px; text-align:left;">Alamat Pelanggan</th>
                    <th style="width:110px; text-align:center;">No Telp</th>
                    <th style="text-align: left;">Tgl Daftar</th>
                    <th style="text-align: center;">Status</th>
                    <th style="width:60px; text-align:center;">Aksi &nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['cust'] as $key => $val) { ?>
                        <tr>
                            <td style="width:20px;"><?= $val['kode'] ?></td>
                            <td style="width:90px;"><?= $val['nama'] ?></td>
                            <td style="width:90px;"><?= $val['jenis_kel'] ?></td>
                            <td style="width:90px;"><?= $val['alamat'] ?></td>
                            <td style="width:90px;"><?= $val['no_telp'] ?></td>
                            <td style="width:90px;"><?= $val['tgl_dibuat'] ?></td>
                            <?php
                            $status = $val['status'];
                            if ($status == 1) {
                                $stt = "<div class='badge bg-success px-4'>Aktif</div>";
                            } else {
                                $stt = "<div class='badge bg-danger'>Tidak Aktif</div>";
                            }
                            ?>
                            <td style="width:50px; text-align:center; padding:2px;"><?= $stt ?></td>
                            <td>
                                <a href="#" onclick="updateP('<?= $val['kode'] ?>')" class="badge bg-info"><i class="bi bi-pencil"></i></a>
                                <a href="#" onclick="deleteP('<?= $val['kode'] ?>')" class="badge bg-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table><br>
    </div>
    <br>
    <hr>

</div>
<!-- /.container-fluid -->

<div class="modal UpCust" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-1 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="nama">
                <input type="hidden" class="form-control-plaintext" id="kode">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select name="sts" id="sts" class="form-select">
                    <option value="">Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="btn_save">Simpan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal DelCust" tabindex="-1">
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
        <button type="button" class="btn btn-primary" id="btnDel">Simpan</button>
      </div>
    </div>
  </div>
</div>