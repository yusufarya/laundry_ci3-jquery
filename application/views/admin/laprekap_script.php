<script>
    var dates = <?= json_encode($dates) ?>; 
    var date = <?= json_encode($date) ?>; 
    $('#tgl').val(date)
    $('#tgls').val(dates)
    
    $('#btn-rekap').click(function() {
        var kodep = $('#kodeP').val()
        var statusP = $('#statusP').val()
        var tgl = $('#tgl').val()
        var tgls = $('#tgls').val()
        var orderby = $('#orderby').val()

        let url = "<?= base_url('Admin/getRekap') ?>";
        if (0 != 0) {
            alert('Pilih tanggal terlebih dahulu')
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: {
                    kode: kodep,
                    status: statusP,
                    tgl: tgl,
                    tgls: tgls,
                    order: orderby
                },
                success: function(h) {
                    openRpt()
                }
            })
        }
    })

    function openRpt() {
        // alert('p')
        window.popup = window.open('<?php echo base_url('Admin/lapRekapView') ?>', '', 'width=' + screen.availWidth + ',height=' + screen.availHeight + ', top=100, left=200, toolbar=1');
    }
</script>