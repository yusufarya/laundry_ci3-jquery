<script>
    $('.cclose').click(function() {
        $('#myModal').hide()
    })

    function accBooking(kode, ongkos, jns_brg, brg) {
        $('#kode').val(kode)
        $('#ongkos').val(ongkos)
        $('#jns_brg').val(jns_brg)
        $('#acc').modal('show')
        $('.brgunit').css('display', 'none')
        $('#nama_brg').val(brg)
    }

    $('#qty').on('keyup', function() {
        var brg = $('#nama_brg').val()
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "<?= base_url('DriverPage/cariNamabrg') ?>",
            data: {
                barang: brg
            },
            async: false,
            success: function(res) {
                var hrgU = res;
                $('#hargaU').val(hrgU)
            }
        })
        var harga1 = ''
        var diskon = 5;
        let qty = $('#qty').val()
        let ongkos = $('#ongkos').val()
        ongkos = parseInt(ongkos)
        let jns_brg = $('#jns_brg').val()
        // var hrg = '';
        if (jns_brg == 'KG') {
            var hrg = 5000;
        } else {
            var hrg = $('#hargaU').val()
            // console.log(hrg)
        }
        if (jns_brg == 'KG') {
            $('.brgunit').css('display', 'none')
            harga1 = hrg * qty
        } else {
            harga1 = hrg * qty
            $('.brgunit').css('display', 'block')
            $('#nama_brg').val(brg)
        }
        harga = harga1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#harga').val(harga)
        var diskon1 = 0;
        if (qty > 10) {
            var dis1 = harga1 * (diskon / 100)
            diskon1 = dis1.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        } else {
            var dis1 = 0;
            var diskon = 0;
        }
        $('#diskon').val(diskon)
        $('#diskon1').val(diskon1)
        const netto = harga1 - dis1 + ongkos
        nettoV = netto.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#netto').val(nettoV)

        // hidden input
        $('#hargaIn').val(harga1)
        $('#nettoIn').val(netto)
        $('#disp').val(dis1)

    })

    // $('#jns_brg').on('change', function() {
    //     const hrg = 5000;
    //     let qty = $('#qty').val()
    //     let jns_brg = $('#jns_brg').val()
    //     if (jns_brg == 'KG') {
    //         hrg = hrg * qty
    //     }
    //     $('#harga').val(hrg)
    // })

    $('#btnSave').on('click', function() {
        var kode = $('#kode').val()
        var qty = $('#qty').val()
        var harga = $('#hargaIn').val()
        var diskon = $('#disp').val()
        var netto = $('#nettoIn').val()
        let jns_brg = $('#jns_brg').val()

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('DriverPage/Updatebooking') ?>',
            data: {
                kode: kode,
                qty: qty,
                jns_brg: jns_brg,
                harga: harga,
                diskon: diskon,
                netto: netto
            },
            success: function(res) {
                $('#acc').modal('hide')
                bootbox.alert('Kode Pesanan ' + kode + ' berhasil DiUpdate.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        });
    })
</script>