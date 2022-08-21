<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?> F-ID</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px 10px;
        }
    </style>
</head>

<body>

    <div id="reporting">
        <hidden>
            <div class="report-control">
                <form method="POST" action"">
                    <button style="border:none !important; margin-left: 10px" name="print" value="PRINT" onClick="cetakRkp();"><img src="<?= base_url('assets/img/icon/printer.png'); ?>"></button>
                    <button type="submit" style="border:none !important; margin-left: 10px" name="submitExportPDF" value="PDF"><img src="<?= base_url('assets/img/icon/printpdf.png'); ?>"></button>
                    <a href="#" id="csv">
                        <button type="button" style="border:none !important; margin-left: 10px" name="submitExport" value="CSV"><img src="<?= base_url('assets/img/icon/printcsv.png'); ?>"></button>
                    </a>
                </form>
            </div>
        </hidden>

        <div class="cetak">

            <div class="report-title">
                <h2>
                    <font style="font-size: 24px;"><?= $title; ?></font>
                </h2>
            </div>
            <main>
                <table id="dtReport" style="font-size: 12px; font-family: Arial, Helvetica, sans-serif">
                    <thead>
                        <tr>
                            <th style="width: 85px; text-align: left">Kode</th>
                            <th style="text-align: left">Nama</th>
                            <th style="text-align: left">Jenis Jasa</th>
                            <th style="text-align: left">Qty</th>
                            <th style="text-align: left">Jenis Barang</th>
                            <th style="text-align: left">Nama Barang</th>
                            <th style="text-align: left">Tanggal</th>
                            <th style="text-align: left">Harga</th>
                            <th style="text-align: left">Diskon</th>
                            <th style="text-align: left">Netto</th>
                            <th style="text-align: left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $key => $val) {
                            $barang = $val['barang'];
                            $netto = $val['netto'] == null || $val['netto'] == ' ' ? '0' : $val['netto'];

                            $status = $val['status'];
                            if ($status == '') {
                                $status = 'Belum Diterima';
                            } else if ($status == 'D') {
                                $status = 'Pengiriman';
                            } else if ($status == 'P') {
                                $status = 'Proses Laundry';
                            } else if ($status == 'A') {
                                $status = 'Pengantaran';
                            } else if ($status == 'S') {
                                $status = 'Selesai';
                            }
                        ?>
                            <tr>
                                <td><?= $val['kode'] ?></td>
                                <td><?= $val['nama_pelanggan'] ?></td>
                                <td><?= $val['jenis_jasa'] ?></td>
                                <td><?= $val['qty'] ?></td>
                                <td><?= $val['jenis_barang'] ?></td>
                                <td><?= $barang; ?></td>
                                <td><?= $val['tanggal'] ?></td>
                                <td>Rp.<?= number_format($val['harga'], 2) ?></td>
                                <td>Rp.<?= number_format($val['diskon'], 2) ?></td>
                                <td>Rp.<?= number_format($netto, 2) ?></td>
                                <td><?= $status ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/myscript.js') ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#csv').on('click', function(event) {
            $('.spasi').empty(); //remove &emsp;
            parseFloat($('.kutip').text()); //remove kutip;	
            $('.spasi').empty(); //remove &emsp;
            exportTableToCSV.apply(this, [$('#dtReport'), '<?= $title; ?>.csv']);
            document.location.reload()
        });
    })
</script>
<script>
    function cetakRkp() {
        var isi = document.querySelector('.cetak');
        var htmlToPrint = '' +
            '<style type="text/css">' +
            'h1, h3 {' +
            'font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;' +
            'padding: 0;' +
            'margin: 0;' +
            'text-align: center;' +
            '}' +
            'table {' +
            'margin: 10px auto 0;' +
            'border-collapse: collapse;' +
            'margin-top: 20px;' +
            '}' +
            'table, td, th {' +
            'border: 1px solid black;' +
            'padding: 3px 5px;' +
            '}' +
            '</style>';

        // console.log(htmlToPrint);
        htmlToPrint += isi.innerHTML;
        newWin = window.open("");
        // newWin.document.write("<h3 align='center'>Print Page</h3>");
        newWin.document.write(htmlToPrint);
        newWin.print();
        newWin.close();
        // window.print()
    }
</script>
<style type="text/css">
    #left {
        text-align: right;
        width: 50%;
        float: left;
        font-weight: bold;
        font-size: 14px;
    }

    #right {
        text-align: left;
        width: 50%;
        float: right;
        font-weight: bold;
        font-size: 14px;
    }
</style>

</html>

<?php
$html = '';
if (isset($_POST['submitExportPDF'])) {
    $html = ob_get_clean();
    renderPdf($title, $html);
}
// unset ($_SESSION["kode"]);
// unset ($_SESSION["status"]);
// unset ($_SESSION["tgl"]);
// unset ($_SESSION["tgls"]);
// unset ($_SESSION["order"]);
// print_r($this->session->all_userdata());
?>