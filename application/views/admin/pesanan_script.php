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
        var nama = data['getPesanInfo'][0].customer
        var alamat = data['getPesanInfo'][0].alamatc
        var no_telp = data['getPesanInfo'][0].no_telp
        var ket = data['getPesanInfo'][0].keterangan
        var tanggal = data['getPesanInfo'][0].tanggal == null || data['getPesanInfo'][0].tanggal == '' ? '' : data['getPesanInfo'][0].tanggal
        var status = data['getPesanInfo'][0].status
        if (status == ' ') {
            status = 'Belum Diterima'
        }

        $('#myModal .modal-content .modal-body').empty()
        $('#myModal').show()
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
            '</tr>' +
            '<tr>' +
            '<td style="text-align:left;">' + data['getPesanInfo'][0].jasa + '</td>' +
            '<td style="text-align:left;">' + data['getPesanInfo'][0].jam + '</td>' +
            '<td style="text-align:left;">' + alamat + '</td>' +
            // '<td style="text-align:left;">Rp. '+diskon+'</td>'+
            // '<td style="text-align:left;">Rp. '+netto+'</td>'+
            '</tr>' +
            '</table>';

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

    function accBooking(kode) {
        $('#kodeP').val(kode)
        $('#acc').modal('show')
    }
    $('#btnSave').on('click', function() {
        let kode = $('#kodeP').val()
        let driver = $('#driver').val()
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/accBooking') ?>',
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
</script>