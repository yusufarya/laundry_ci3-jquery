<script>
    $(document).ready(function() {
        setTimeout(() => {
            $('.errUpload').hide()
        }, 2500);
        setTimeout(() => {
            $('.UploadOk').hide()
        }, 3500);
    })

    function bayar(kode) {

        $('.mbayar').modal('show')
        $('#kodeP').val(kode)

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "<?= base_url('Pesan/cekBayar') ?>",
            async: false,
            data: {
                kode: kode
            },
            success: function(res) {
                var bayar = res[0].bayar
                if (bayar == '') {
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: "<?= base_url('Pesan/getPesankode') ?>",
                        data: {
                            kode: kode
                        },
                        success: function(res) {
                            // console.log(res)
                            var jns_brg = res.jenis_barang
                            var barang = ''
                            if (jns_brg == 'UNIT') {
                                var barang = res.barang
                                $('#unit').css('display', 'table-row')
                                $('#nama_brg').text(barang)
                            } else {
                                $('#unit').css('display', 'none')
                            }
                            var driver = res.ndriver
                            var qty = res.qty
                            var jjasa = res.jjasa
                            var tgl = res.tanggal
                            $('#kode').text(kode)
                            $('#qty').text(qty + ' ' + jns_brg)
                            $('#driver').text(driver)
                            $('#jasa').text(jjasa)
                            $('#tgl').text(tgl)

                            var harga = res.harga
                            var diskon = res.diskon
                            var ongkos = res.ongkos
                            var netto = res.netto
                            $('#harga').text('Rp ' + harga)

                            if (diskon > 0) {
                                $('#diskon').text('Rp ' + diskon)
                            } else {
                                $('#diskon').text(0)
                            }
                            $('#ongkos').text('Rp ' + ongkos)
                            $('#netto').text('Rp ' + netto)
                        }
                    })
                } else if (bayar == 'Y') {
                    $('.mbayar').modal('hide')  
                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: "<?= base_url('Pesan/getNorek') ?>",
                        async: false,
                        data: {
                            kode: kode
                        },
                        success: function (data) {
                            var bank = data.bank 
                            $.ajax({
                                type: 'POST',
                                dataType: 'JSON',
                                url: "<?= base_url('Pesan/noRek') ?>",
                                async: false,
                                data: {
                                    bank: bank
                                },
                                success: function(res) {
                                    var bank = res.nama
                                    var noRek = res.no_rek
                                    setTimeout(() => {
                                        $('#tfbayar').modal('show')
                                        $('#mtitle').text('Transfer ' + bank)
                                        $('#noRek').text(noRek)
                                    }, 500);
                                }
                            });
                        }
                    })
                } else {
                    $('.mbayar').modal('hide')
                    $('.sbayar').modal('show')
                    $('button.btn-secondary').text('Selesai')
                    $('button.btn-warning').hide()
                }
            }
        })

        
    }

    $('#lbayar').on('click', function() {
        var bank = $('#bank').val()
        var kode = $('#kodeP').val()

        var bank = $('#bank').val()
        if (bank == '') {
            alert("Pilih metode pembayaran.")
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?= base_url('Pesan/insertBayar') ?>",
                async: false,
                data: {
                    kode: kode,
                    bank: bank
                },
                success: function(hasil) {
                    // console.log(hasil)
                    $('.mbayar').modal('hide')

                    $.ajax({
                        type: 'POST',
                        dataType: 'JSON',
                        url: "<?= base_url('Pesan/noRek') ?>",
                        async: false,
                        data: {
                            bank: bank
                        },
                        success: function(res) {
                            var bank = res.nama
                            var noRek = res.no_rek
                            setTimeout(() => {
                                $('#tfbayar').modal('show')
                                $('#mtitle').text('Transfer ' + bank)
                                $('#noRek').text(noRek)
                            }, 800);
                        }
                    });
                },
                error: function() {
                    alert('Proses gagal')
                }
            })
        }

    })

    $('button.selesai').on('click', function(){
        window.location.reload();
    })

    function upimg(kode, bayar) {

        $('#bukti').modal('show')

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "<?= base_url('Pesan/kodeRek') ?>",
            async: false,
            data: {
                kodeP: kode
            },
            success: function(e) {
                // console.log(e)
                if (bayar == 'YY') {
                    $('.tbayar').empty()
                    $('.tbayar').html('<h5 class="alert alert-info">&nbsp;Anda telah mengirimkan bukti pembayaran&nbsp;</h5>')
                    $('.kirim').empty()
                    var kodebayar = e.kode
                    $('#kd_byr').val(kodebayar);
                    $('#kodebayar').text(kodebayar);
                } else {
                    $('#kd_byr').val(kode);
                }
            }
        })
    }
</script>