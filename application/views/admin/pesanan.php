<?php
$data = json_decode(json_encode($pageInfo), True);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 text-dark">Daftar Order <?= $data['title'] ?></h1>
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
          <th style="text-align:right;">Aksi &nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['pesanan'] as $key => $val) { ?>
          <tr ondblclick="loadPopInfo('<?= $val['kode'] ?>')">
            <td style="width:90px;"><?= $val['kode'] ?></td>
            <td style="width:100px;"><?= $val['nama_cust'] ?></td>
            <td style="width:30px; text-align:center;"><?= $val['jam'] ?></td>
            <td style="width:320px; text-align:left;"><?= $val['alamat'] ?></td>
            <td style="width:50px; text-align:center;"><?= $val['jasa'] ?></td>
            <td style="text-align:right; width:50px;">
              <button class="btn btn-sm btn-warning" onclick="accBooking('<?= $val['kode'] ?>')">ACC</button>
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

<?php
$qry = "SELECT * FROM driver";
$driver = $this->db->query($qry)->result_array();
?>

<div class="modal" id="acc" tabindex="-1">
  <div class="modal-dialog modal-md rounded" style="box-shadow: 20PX 20px 99px #000000;">
    <div class="modal-content">
      <div class="modal-body p-3" id="isibody">
        <div class="row">
          <hr>
          <input type="hidden" id="kodeP" name="kodeP">
          <div class="col-lg-10">
            <select class="form-select" id="driver" name="driver">
              <option selected>Pilih driver</option>
              <?php foreach ($driver as $dr) { ?>
                <option value="<?= $dr['kode']; ?>"><?= $dr['kode'] . ' - ' . $dr['nama'] ?></option>
              <?php } ?>
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