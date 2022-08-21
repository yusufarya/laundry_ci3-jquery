<?php
$getRating = $this->db->query('SELECT * FROM komentar ORDER BY waktu DESC')->result();
$hrgSat = $this->db->query('SELECT * FROM harga_satuan')->row_array();
$brgInfo = $this->db->query('SELECT * FROM data_barang')->result_array();
?>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url('assets/img/1.png') ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption text-dark d-none d-md-block">
        <a href="<?= base_url('pesan') ?>" class="btn bg-info mx-auto py-2" style="width:30%; border-radius:8px; font-weight:600;">Pesan sekarang</a>
        <p class="mt-2">Memilih laundry xyz adaalah pilihan yang tepat.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('assets/img/2.png') ?>" class="d-block w-100" alt="...">
      <div class="carousel-caption text-dark d-none d-md-block">
        <a href="<?= base_url('pesan') ?>" class="btn bg-info mx-auto py-2" style="width:30%; border-radius:8px; font-weight:600;">Pesan sekarang</a>
        <p class="mt-2">Dengan proses yang sangat baik & super cepat.</p>
      </div>
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<hr>
<div class="container-fluid">
  <div class="row mt-4">
    <div class="col-lg-6 pb-4 bg-light shadow-sm rounded">
      <h5 class="text-dark mt-2 rounded py-2 px-3 me-2">
        <?= 'Harga Rp.' . number_format($hrgSat['harga'], 2) . ' /Kg' ?>
      </h5>
      <h5 class="text-dark mt-2 rounded px-3 me-2">
        Daftar harga satuan
      </h5>
      <?php foreach ($brgInfo as $key => $val) { ?>
        <li class="ms-3 text-dark"><?= $val['nama'] . ' - Rp.' . number_format($val['harga'], 2) ?></li>
      <?php } ?>
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-5">
      <h4>Review & rating</h3>
        <?php
        foreach ($getRating as $key => $value) {
        ?>
          <li class="list-group-item d-flex justify-content-between align-items-start mt-2" style="background: azure;">
            <div class="ms-2" style="width:100%;">
              <div class="fw-bold"><?= $value->nama ?></div>
              <span style="font-size:13px;"><?= $value->komentar ?></span>
              <hr>
              <small style="float:left; font-size:11px; bottom:0; color:#A9A9A9;"><?= $value->waktu ?></small>
            </div>
            <span class="badge rounded-pill" style="background: lightblue; padding-bottom:7px; font-size:11px;">
              <?php
              for ($i = 0; $i < $value->nilai; $i++) {
                echo '⭐';
              }
              $maxrate = 5;
              $sisa = $maxrate-$value->nilai;
              for ($i = 0; $i < $sisa; $i++) {
                echo ' <i class="bi bi-star"> </i> ';
              }
              ?>
            </span>
          </li>

        <?php
        }
        ?>
    </div>
  </div>
</div>
<br>
<hr>