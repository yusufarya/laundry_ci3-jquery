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
          <th style="width:30px; text-align:center;">Jam</th>
          <th style="width:320px; text-align:left;">Alamat</th>
          <th style="width:70px; text-align:center;">Jasa</th>
          <th style="text-align:center;">Aksi &nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['pesanan'] as $key => $val) { ?>
          <tr>
            <td style="width:60px;"><?= $val['kode'] ?></td>
            <td style="width:130px;"><?= $val['nama_cust'] ?></td>
            <td style="width:30px; text-align:center;"><?= $val['jam'] ?></td>
            <td style="width:320px; text-align:left;"><?= $val['alamat'] ?></td>
            <td style="width:50px; text-align:center;"><?= $val['jasa'] ?></td>
            <td style="text-align:center; width:50px;">
              <?php
              if ($val['status'] == 'D' && $val['harga'] == NULL) { ?>
                <button class="btn btn-sm btn-info px-2" disabled>Penjemputan</button>
              <?php } else if ($val['status'] == 'D' && $val['harga'] != NULL) { ?>
                <button class="btn btn-sm btn-danger px-2" disabled>Sampai toko</button>
              <?php } else if ($val['status'] == 'Y' && $val['harga'] == NULL) { ?>
                <button class="btn btn-sm btn-warning px-2" onclick="accBooking('<?= $val['kode'] ?>')">Acc Pesanan</button>
              <?php } else if ($val['status'] == 'A' && $val['harga'] != null) { ?>
                <button class="btn btn-sm btn-success px-2" onclick="antarPsn('<?= $val['kode'] ?>')">Antar Pesanan</button>
              <?php } else if ($val['status'] == 'S' && $val['harga'] != null && $val['bayar'] == 'YY') { ?>
                <button class="btn btn-sm btn-primary px-2">Telah Selesai</button>
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
          <p>Klik 'ya' untuk mengambil pesanan pelanggan</p>
          <input type="hidden" id="kodeP" name="kodeP">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary px-4" id="btnSave">Ya</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="acc1" tabindex="-1">
  <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
    <div class="modal-content">
      <div class="modal-body p-3" id="isibody">
        <div class="row">
          <p>Klik 'ya' untuk menyelesaikan pesanan</p>
          <input type="hidden" id="kodeP" name="kodeP">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cclose" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary px-4" id="btnSaveA">Ya</button>
      </div>
    </div>
  </div>
</div>