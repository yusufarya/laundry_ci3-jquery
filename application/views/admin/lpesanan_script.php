<script>
    function loadPopInfo(kode) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/getPesanInfo') ?>',
            data: {
                kode: kode
            },
            success: function(result) {
                var data = result.data
                getDetail(data)
            }
        })
    }

    function getDetail(data) {
        // console.log(data)
        var kode = data['getPesanInfo'][0].kode
        var driver = data['getPesanInfo'][0].driver
        var nama = data['getPesanInfo'][0].customer
        var alamat = data['getPesanInfo'][0].alamatc
        var no_telp = data['getPesanInfo'][0].no_telp
        var ket = data['getPesanInfo'][0].keterangan
        var tanggal = data['getPesanInfo'][0].tanggal == null || data['getPesanInfo'][0].tanggal == '' ? '' : data['getPesanInfo'][0].tanggal
        var status = data['getPesanInfo'][0].status
        if (status == ' ') {
            status = 'Belum Diterima'
        } else if (status == 'Y') {
            status = 'Belum diterima driver'
        } else if (status == 'P') {
            status = 'Proses laundry'
        } else if (status == 'D') {
            status = 'Penjemputan'
        } else if (status == 'A') {
            status = 'Sedang Diantar'
        }

        $('#myModal .modal-content .modal-body').empty()
        $('#myModal').modal('show')
        var htmlDetail = '';

        var header = '<table>' +
            '<tr>' +
            '<th style="width: 120px;">Kode</th>' +
            '<th style="width: 700px;">: ' + kode + '</th>' +
            '<th style="width: 80px; text-align:left;">Tanggal</th>' +
            '<th style="width: 700px; ">&nbsp; : ' + tanggal + '</th>' +
            '</tr>' +
            '<tr>' +
            '<th style="width: 120px;">Nama</th>' +
            '<th style="width: 700px;">: ' + nama + '</th>' +
            '<th style="width: 80px; text-align:left;">Status</th>' +
            '<th style="width: 700px;">&nbsp; : ' + status + '</th>' +
            '</tr>' +
            '</table><br>';

        var body = '<table class="table">' +
            '<tr>' +
            '<th style="text-align:left; width:90px;">Jenis jasa</th>' +
            '<th style="text-align:left; width:110px;">Jam pesan</th>' +
            '<th style="text-align:left;">Alamat</th>' +
            '<th style="text-align:left;">Driver</th>' +
            '</tr>' +
            '<tr>' +
            '<td style="text-align:left;">' + data['getPesanInfo'][0].jasa + '</td>' +
            '<td style="text-align:left;">' + data['getPesanInfo'][0].jam + '</td>' +
            '<td style="text-align:left;">' + alamat + '</td>' +
            '<td style="text-align:left;">' + driver + '</td>' +
            // '<td style="text-align:left;">Rp. '+netto+'</td>'+
            '</tr>' +
            '</table>';

        var jns_brg = data['getPesanInfo'][0].jenis_barang
        var barang = data['getPesanInfo'][0].barang
        var qty = data['getPesanInfo'][0].qty
        var hargaa = data['getPesanInfo'][0].harga
        if (hargaa != null) {
            harga = hargaa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            var diskon = data['getPesanInfo'][0].diskon
            diskon = diskon.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            var netto = data['getPesanInfo'][0].netto
            netto = netto.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            if (jns_brg == "UNIT") {
                body += '<table class="table">' +
                    '<tr>' +
                    '<th style="text-align:left; width:90px;">Qty</th>' +
                    '<th style="text-align:left;">Nama Barang</th>' +
                    '<th style="text-align:left;">Harga</th>' +
                    '<th style="text-align:left;">Diskon</th>' +
                    '<th style="text-align:left;">Netto</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td style="text-align:left;">' + qty + ' ' + jns_brg + '</td>' +
                    '<td style="text-align:left;">' + barang + '</td>' +
                    '<td style="text-align:left;">Rp. ' + harga + '</td>' +
                    '<td style="text-align:left;">Rp. ' + diskon + '</td>' +
                    '<td style="text-align:left;">Rp. ' + netto + '</td>' +
                    // '<td style="text-align:left;">Rp. '+netto+'</td>'+
                    '</tr>' +
                    '</table>';
            } else {
                body += '<table class="table">' +
                    '<tr>' +
                    '<th style="text-align:left; width:90px;">Qty</th>' +
                    '<th style="text-align:left;">Harga</th>' +
                    '<th style="text-align:left;">Diskon</th>' +
                    '<th style="text-align:left;">Netto</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td style="text-align:left;">' + qty + ' ' + jns_brg + '</td>' +
                    '<td style="text-align:left;">' + harga + '</td>' +
                    '<td style="text-align:left;">' + diskon + '</td>' +
                    '<td style="text-align:left;">' + netto + '</td>' +
                    // '<td style="text-align:left;">Rp. '+netto+'</td>'+
                    '</tr>' +
                    '</table>';
            }
        }

        var footer = '<table style="margin-top:10px;">' +
            '<tr>' +
            '<td style="text-align:center; width:100%;">"' + ket + '"</ttd>' +
            '</tr>' +
            '</table>';

        htmlDetail += header
        htmlDetail += body
        htmlDetail += footer

        $('#myModal .modal-content .modal-body').append(htmlDetail);

    }

    $('.cclose').click(function() {
        $('#myModal').hide()
    })

    function Progres(kode) {
        $('#kodeP').val(kode)
        $('#acc').modal('show')
    }
    $('#btnSave').on('click', function() {
        let kode = $('#kodeP').val()
        let status = $('#status').val()
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/progresAcc') ?>',
            data: {
                kode: kode,
                status: status
            },
            success: function(res) {
                $('#acc').modal('hide')
                bootbox.alert('Kode Pesanan ' + kode + ' berhasil diterima.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })

    function Selesaikan(kode) {
        $('#kodeP').val(kode)
        $('#done').modal('show')
    }
    $('#btnDone').on('click', function() {
        let kode = $('#kodeP').val()
        let status = 'S'
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/progresAcc') ?>',
            data: {
                kode: kode,
                status: status
            },
            success: function(res) {
                $('#acc').modal('hide')
                bootbox.alert('Kode Pesanan ' + kode + ' berhasil diselesaikan. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })

    function AntarPsn(kode) {
        $('#kodePs').val(kode)
        $('#antarP').modal('show')
    }
    $('#btnSaveA').on('click', function() {
        let kode = $('#kodePs').val()
        let driver = $('#driver').val()
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/antarPesanan') ?>',
            data: {
                kode: kode,
                driver: driver
            },
            success: function(res) {
                $('#acc').modal('hide')
                bootbox.alert('Kode Pesanan ' + kode + ' berhasil diterima.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })

    function lihatBukti(kode) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/BuktiBayar') ?>',
            data: {
                kodePesan: kode
            },
            success: function(res) {
                $('#buktiBayar .modal-content .gambar').empty();
                var gambar = res.gambar
                $('#buktiBayar').modal('show')

                var html = '<img src="<?php echo base_url(); ?>assets/img/pembayaran/' + gambar + '" style="height: auto; width: 460px;">'

                $('#buktiBayar .modal-content .gambar').append(html);
            }
        })
    }
</script>