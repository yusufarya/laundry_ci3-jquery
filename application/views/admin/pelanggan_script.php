<script>
    function updateP(kode) {
        $('.UpCust').modal('show')
        
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Admin/getCust') ?>",
            data: { kode: kode},
            success: function(res) {
                var nama = res[0].nama
                $('#nama').val(nama)
                $('#nama').css('font-weight', '600')
                $('#kode').val(kode)
            }
        })
    }
    
    function deleteP(kode) {
        $('.DelCust').modal('show')
        $('#hapus').text('Yakin ingin menghapus pelanggan '+kode + '?')
        $('#delkode').val(kode)
    }
    
</script>
<script>
    $('#btn_save').on('click', function() {
        var kode = $('#kode').val()
        var status = $('#sts').val()
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Admin/updateCust') ?>",
            data: {
                kode: kode, status: status
            },
            success: function(res) {
                // alert(res)
                $('.UpCust').modal('hide')
                bootbox.alert(' Pelanggan ' + kode + ' berhasil diubah.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function(res) {
                alert(res)
            }
        })
    });

    $('#btnDel').on('click', function() {
        var kode = $('#delkode').val() 
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Admin/deleteCust') ?>",
            data: { kode: kode },
            success: function(res) {
                $('.DelCust').modal('hide')
                bootbox.alert(' Pelanggan ' + kode + ' berhasil di hapus.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })
</script>