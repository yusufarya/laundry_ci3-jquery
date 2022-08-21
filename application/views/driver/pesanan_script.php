<script>
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
            url: '<?= base_url('DriverPage/accBooking') ?>',
            data: {
                kode: kode
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
    function antarPsn(kode) {
        $('#kodeP').val(kode)
        $('#acc1').modal('show')
    }
    $('#btnSaveA').on('click', function() {
        let kode = $('#kodeP').val()
        let driver = $('#driver').val()
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '<?= base_url('DriverPage/antarPsn') ?>',
            data: {
                kode: kode
            },
            success: function(res) {
                $('#acc').modal('hide')
                bootbox.alert('Kode Pesanan ' + kode + ' telah selesai.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })
</script>