<?php
$data = json_decode(json_encode($pageInfo), True);
$me = $data['me'];

if ($me['jenis_kel'] == 'Laki-laki' || $me['jenis_kel'] == 'Perempuan') {
    $jnskel = 'selected';
} else {
    $jnskel = '';
}

if ($me['status'] == 1) {
    $status = 'selected';
} else {
    $status = '';
}

?>
<div class="container-fluid">
    <h2 class="text-center py-1 mt-3"><?= $data['title'] ?></h2>
    <hr><br>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <img src="<?= base_url('assets/img/user/') . $me['gambar'] ?>" alt="" width="250" style="float:right;">
                <input type="file" name="gambar" id="gambar" class="">
            </div>
            <div class="col-lg-7">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <td>Nama</td>
                            <th><?= $me['nama'] ?></th>
                        </tr>
                        <tr>
                            <td>Tanggal lahir</td>
                            <th><?= $me['tgl_lahir'] ?></th>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <th><?= $me['jenis_kel'] ?></th>
                        </tr>
                        <tr>
                            <td>No. Telp</td>
                            <th><?= $me['no_telp'] ?></th>
                        </tr>
                        <tr>
                            <td>ALamat</td>
                            <th><?= $me['alamat'] ?></th>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <th><?= $me['email'] ?></th>
                        </tr>
                        <tr>
                            <td>Member sejak</td>
                            <th><?= $me['tgl_dibuat'] ?></th>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" onclick="btnEdit()">Edit biodata</button>
                            </td>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>
    </div> <br><br><br>

</div>


<div class="modal" id="updateModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Biodata</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-1 row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nama">
                <input type="hidden" class="form-control-plaintext" id="kode">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="staticTgllahir" class="col-sm-3 col-form-label">Tanggal lahir</label>
            <div class="col-sm-8">
                <input type="date" class="form-control" id="tgl_lahir">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="staticJnskel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-8">
                <select name="jnskel" id="jnskel" class="form-select">
                    <option value="">Pilih</option>
                    <option <?= $me['jenis_kel'] == 'Laki-laki' ? $jnskel : '' ?> value="Laki-laki">Laki-laki</option>
                    <option <?= $me['jenis_kel'] == 'Perempuan' ? $jnskel : '' ?> value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-1 row">
            <label for="staticAlamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="alamat">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="staticNotelp" class="col-sm-3 col-form-label">No. Telp</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="no_telp">
            </div>
        </div>
        <div class="mb-1 row">
            <label for="inputPassword" class="col-sm-3 col-form-label">Status Akun</label>
            <div class="col-sm-8">
                <select name="status" id="status" class="form-select">
                    <!-- <option value="">Status</option> -->
                    <option <?= $me['status'] == 1 ? $status : '' ?> value="1">Aktif</option>
                    <option <?= $me['status'] == 0 ? $status : '' ?> value="0">Tidak Aktif</option>
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