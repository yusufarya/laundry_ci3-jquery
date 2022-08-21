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
                    <th style="width:90px; text-align:center;">Jam</th>
                    <th style="width:320px; text-align:left;">Alamat</th>
                    <th style="width:70px; text-align:center;">Jasa</th>
                    <th style="text-align:center;">Aksi &nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['pesanan'] as $key => $val) { ?>
                    <?php if ($val['harga'] != '' && $val['status'] == 'S' && $val['bayar'] == 'YY') { ?>
                        <tr ondblclick="loadPopInfo('<?= $val['kode'] ?>')">
                            <td style="width:90px;"><?= $val['kode'] ?></td>
                            <td style="width:100px;"><?= $val['nama_cust'] ?></td>
                            <td style="width:30px; text-align:center;"><?= $val['jam'] ?></td>
                            <td style="width:320px; text-align:left;"><?= $val['alamat'] ?></td>
                            <td style="width:50px; text-align:center;"><?= $val['jasa'] ?></td>
                            <td style="text-align:center; width:50px;">
                                <?php if ($val['harga'] != '' && $val['status'] == 'S' && $val['bayar'] == 'YY') { ?>
                                    <button class="btn btn-sm btn-info" onclick="Progres('<?= $val['kode'] ?>')">✔️ Selesai</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table><br>
    </div>
    <br>
    <br>
    <br>
    <hr>

</div>
<!-- /.container-fluid -->