<script>
    function loadPopInfo(kode) {
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('Admin/getPesanInfo') ?>',
            data: { 
                kode:kode
            },
            success: function(result) {
                var data = result.data
                getDetail(data)
            }
        })
    }

    function getDetail(data) {
        console.log(data)
        var kode = data['getPesanInfo'][0].kode
        var nama = data['getPesanInfo'][0].nama
        var nama_tim = data['getPesanInfo'][0].nama_tim
        var hari = data['getPesanInfo'][0].nhari
        var tanggal = data['getPesanInfo'][0].tanggal == null || data['getPesanInfo'][0].tanggal == '' ? '' : data['getPesanInfo'][0].tanggal 
        var status = data['getPesanInfo'][0].flag
        if (status == 'Y') {
            status = 'Belum Selesai'
        } else if (status == 'S') {
            status = 'Selesai'
        }
        
        $('#myModal .modal-content .modal-body').empty()
        $('#myModal').show()
        var htmlDetail = '';

        var header = '<table>'+
                        '<tr>'+
                            '<th style="width: 120px;">Kode</th>'+
                            '<th style="width: 700px;">: '+kode+'</th>'+
                            '<th style="width: 80px; text-align:left;">Tanggal</th>'+
                            '<th style="width: 700px; ">&nbsp; : '+tanggal+'</th>'+
                        '</tr>'+
                        '<tr>'+
                            '<th style="width: 120px;">Nama</th>'+
                            '<th style="width: 700px;">: '+nama+'</th>'+
                            '<th style="width: 80px; text-align:left;">Status</th>'+
                            '<th style="width: 700px;">&nbsp; : '+status+'</th>'+
                        '</tr>'+
                        '<tr>'+
                            '<th style="width: 120px;">Tim</th>'+
                            '<th style="width: 700px;">: '+nama_tim+'</th>'+
                        '</tr>'+
                        '<tr>'+
                            '<th style="width: 120px;">Hari</th>'+
                            '<th>: '+hari+'</th>'+
                        '</tr>'+
                    '</table><br>';

        var hrg = data['getPesanInfo'][0].harga
        var netto = hrg.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
        var disk = data['getPesanInfo'][0].diskon
        diskon = disk.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
        var hargaawal = parseInt(hrg)+parseInt(disk)
        hargaawal = hargaawal.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
        var body = '<table class="table">'+
                    '<tr>'+
                        '<th style="text-align:center; width:110px;">Jam Mulai</th>'+
                        '<th style="text-align:center; width:100px;">Selesai</th>'+
                        '<th style="text-align:center; width:90px;">Paket</th>'+
                        '<th style="text-align:left;">Harga Awal</th>'+
                        '<th style="text-align:left;">Diskon</th>'+
                        '<th style="text-align:left;">Netto</th>'+
                    '</tr>'+
                    '<tr>'+
                        '<td style="text-align:center;">'+data['getPesanInfo'][0].jam_mulai+'</td>'+
                        '<td style="text-align:center;">'+data['getPesanInfo'][0].jam_selesai+'</td>'+
                        '<td style="text-align:center;">'+data['getPesanInfo'][0].paket+' Jam</td>'+
                        '<td style="text-align:left;">Rp. '+hargaawal+'</td>'+
                        '<td style="text-align:left;">Rp. '+diskon+'</td>'+
                        '<td style="text-align:left;">Rp. '+netto+'</td>'+
                    '</tr>'+
                '</table>';

        var footer = '<table style="margin-top:50px;" class="text-center">'+ 
                    '<tr>'+ 
                        '<td style="text-align:left; width:110px; font-size:11px;">Futsal.id</td>'+
                    '</tr>'+ 
                '</table>';

        htmlDetail += header
        htmlDetail += body
        htmlDetail += footer
        
        $('#myModal .modal-content .modal-body').append(htmlDetail);
                

    }
    
    $('.cclose').click(function() {
        $('#myModal').hide()
    })

    function accBooking(kode){
        bootbox.confirm("Selesaikan transaksi kode " +kode+"?", function(result) {
            if (result) {
                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url:'<?= base_url('Admin/accBookingTr') ?>',
                    data: {
                        kode:kode
                    },
                    success: function(res){
                        bootbox.alert('Kode booking '+ kode +' berhasil diterima.. ✔️')
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                })
            }
        });
    }
</script>