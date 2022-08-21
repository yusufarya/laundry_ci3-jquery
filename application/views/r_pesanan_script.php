<script>
    function nilaiLNDR(kode, penilaian) {
        $('#kodePesan').val(kode)
        if (penilaian == 'Y') {
            $('#PenilaianM1').modal('show')

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: "<?= base_url('Pesan/getNilai') ?>",
                data: {
                    kode: kode
                },
                success: function(e) {
                    console.log(e)
                    $('#stars').empty()
                    for (let i = 0; i < e.nilai; i++) {
                        const stars = '⭐'
                        $('#stars').append(stars)
                    }
                    var sisa = 5 - e.nilai
                    for (let i = 0; i < sisa; i++) {
                        const stars = ' <i class="bi bi-star"> </i> '
                        $('#stars').append(stars)
                    }
                    $('#isikomen').val(e.komentar)
                }
            })
        } else {
            $('#PenilaianM').modal('show')
        }
    }
    $('#1').on('click', function() {
        $('#rate').val(1)
        $('#1').text('⭐')
        $('#2').html('<i class="bi bi-star"></i>')
        $('#3').html('<i class="bi bi-star"></i>')
        $('#4').html('<i class="bi bi-star"></i>')
        $('#5').html('<i class="bi bi-star"></i>')
    })
    $('#2').on('click', function() {
        $('#rate').val(2)
        $('#1').text('⭐')
        $('#2').text('⭐')
        $('#3').html('<i class="bi bi-star"></i>')
        $('#4').html('<i class="bi bi-star"></i>')
        $('#5').html('<i class="bi bi-star"></i>')
    })
    $('#3').on('click', function() {
        $('#rate').val(3)
        $('#1').text('⭐')
        $('#2').text('⭐')
        $('#3').text('⭐')
        $('#4').html('<i class="bi bi-star"></i>')
        $('#5').html('<i class="bi bi-star"></i>')
    })
    $('#4').on('click', function() {
        $('#rate').val(4)
        $('#1').text('⭐')
        $('#2').text('⭐')
        $('#3').text('⭐')
        $('#4').text('⭐')
        $('#5').html('<i class="bi bi-star"></i>')
    })
    $('#5').on('click', function() {
        $('#rate').val(5)
        $('#1').text('⭐')
        $('#2').text('⭐')
        $('#3').text('⭐')
        $('#4').text('⭐')
        $('#5').text('⭐')
    })

    $('#btn-nilai').on('click', function() {
        var kode = $('#kodePesan').val()
        var rate = $('#rate').val()
        var nama = $('#nama').val()
        var komentar = $('#komentar').val()

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: "<?= base_url('Pesan/penilaian') ?>",
            data: {
                kode: kode,
                rate: rate,
                nama: nama,
                komentar: komentar
            },
            success: function(e) {
                console.log(e)
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function() {
                alert('Proses gagal')
            }
        })

    })
</script>