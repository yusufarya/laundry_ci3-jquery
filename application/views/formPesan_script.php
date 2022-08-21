<script>
    $(document).ready(function() {
        $('#detail').hide()
        // $('.next').hide()
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        var kodecust = $('#kodecust').val()
        // get current location
        $('.currLoc').on('click', function() {
            bootbox.confirm('Anda ingin menggunakan alamat yg telah ada ?', function(yes) {
                if (yes) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: "<?= base_url('Pesan/getAlamat') ?>",
                        async: false,
                        data: {
                            kodecust: kodecust
                        },
                        success: function(res) {
                            var currlocate = res.success[0]['alamat']
                            if (currlocate != '') {
                                $('#alamat').val(currlocate)
                            } else {
                                var texterr = 'Alamat tidak ditemukan!'
                                $('.errAlamat').text(texterr)
                            }

                        }
                    })
                }
            });
            $('.bootbox-close-button').hide()
        })

        $('#pil_unit').hide()
        $('#jns_brg').on('change', function() {
            let jns_brg = $('#jns_brg').val()
            if (jns_brg == 'UNIT') {
                $('#pil_unit').show()
            } else {
                $('#pil_unit').hide()
            }

        })

        let kode = <?= json_encode($kodes) ?>;
        // btn next //
        $('#btnNext').on('click', function() {
            $('#kode').val(kode)

            let jns_brg = $('#jns_brg').val()
            if (jns_brg == '') {
                var texterr = 'Jenis barang kosong!'
                $('.errSat').text(texterr)
            }

            let no_telp = $('#no_telp').val()
            if (no_telp == '') {
                var texterr = 'No Telp masih kosong!'
                $('.errTelp').text(texterr)
            }
            let alamat = $('#alamat').val()
            if (alamat == '') {
                var texterr = 'Alamat masih kosong!'
                $('.errAlamat').text(texterr)
            }

            let jns_krm = $('#jasa').val()
            if (jns_krm == '') {
                alert('Isi semua form dengan benar')
            } else {
                pesanDetail()
            }
        })

        setTimeout(function() {
            $('.errAlamat').text('')
            $('.errTelp').text('')
            $('.errSat').text('')
        }, 3000);

        function pesanDetail() {
            let kdpesan = $('#kode').val()
            let nama = $('#nama').val()
            let jns_kel = $('#jns_kel').val()
            let no_telp = $('#no_telp').val()
            let alamat = $('#alamat').val()
            let jns_krm = $('#jasa').val()
            let jns_brg = $('#jns_brg').val()
            if (jns_krm == '001') {
                var estimasi = '3 hari'
            } else if (jns_krm == '002') {
                var estimasi = '1 hari'
            }

            var url = '<?= base_url('Pesan/getJns_pengiriman') ?>'

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                async: false,
                data: {
                    kode: jns_krm
                },
                success: function(res) {
                    $('#tr-td').empty();
                    let jasa = res.data['jenis'];
                    let ongkos = res.data['harga'];
                    $('#rinci').empty()
                    $('#modalDetail').modal('show')
                    var rinci = '';
                    if (jns_brg == 'KG') {
                        rinci = '<tr>' +
                            '<th style="width:130px;">Kode Pesanan</th>' +
                            '<td>: ' + kdpesan + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">Nama Pemesan</th>' +
                            '<td>: ' + nama + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">Jenis Kelamin</th>' +
                            '<td>: ' + jns_kel + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">No Telp</th>' +
                            '<td>: ' + no_telp + ' </td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">Jenis Jasa</th>' +
                            '<td>: ' + jasa + ' - ' + estimasi + '</td>' +
                            '</tr>' +
                            '<th style="width:130px;">Jenis Barang</th>' +
                            '<td>: ' + jns_brg + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px; display: block; position: relative;top: 0px;">Alamat</th>' +
                            '<td>: ' + alamat + ' </td>' +
                            '</tr>';
                    } else if (jns_brg == 'UNIT') {
                        var barang = $('#barang').val()
                        rinci = '<tr>' +
                            '<th style="width:130px;">Kode Pesanan</th>' +
                            '<td>: ' + kdpesan + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">Nama Pemesan</th>' +
                            '<td>: ' + nama + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">Jenis Kelamin</th>' +
                            '<td>: ' + jns_kel + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">No Telp</th>' +
                            '<td>: ' + no_telp + ' </td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px;">Jenis Jasa</th>' +
                            '<td>: ' + jasa + ' - ' + estimasi + '</td>' +
                            '</tr>' +
                            '<th style="width:130px;">Jenis Barang</th>' +
                            '<td>: ' + jns_brg + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px; display: block; position: relative;top: 0px;">Alamat</th>' +
                            '<td>: ' + alamat + ' </td>' +
                            '</tr>' +
                            '<tr>' +
                            '<th style="width:130px; display: block; position: relative;top: 0px;">Nama barang</th>' +
                            '<td>: ' + barang + ' </td>' +
                            '</tr>';

                    }
                    $('#rinci').append(rinci)
                }
            })
        }

        $('#btnPesan').on('click', function() {
            let kdpesan = $('#kode').val()
            let kodecust = $('#kodecust').val()
            let no_telp = $('#no_telp').val()
            let alamat = $('#alamat').val()
            let jns_krm = $('#jasa').val()
            let ket = $('#keterangan').val()
            let jam = $('#jam').val()
            let tanggal = $('#tanggal').val()
            let jns_brg = $('#jns_brg').val()
            if (jns_brg == 'UNIT') {
                var barang = $('#barang').val()
            } else {
                var barang = '';
            }

            const urlP = '<?= base_url('Pesan/addPesanan') ?>';
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: urlP,
                async: false,
                data: {
                    kode: kdpesan,
                    kodecust: kodecust,
                    notelp: no_telp,
                    alamat: alamat,
                    ket: ket,
                    jns_jasa: jns_krm,
                    jam: jam,
                    tgl: tanggal,
                    jns_brg: jns_brg,
                    barang: barang
                },
                success: function(res) {
                    $('#modalDetail').modal('hide')
                    bootbox.alert('Berhasil')
                    setTimeout(() => {
                        document.location.href = "<?php echo base_url() . 'home/pesanan' ?>";
                    }, 3000);
                }
            })

        })
    });
</script>