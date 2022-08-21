<script> 
    function updateD(kode) {
        $('.UpDriver').modal('show')
        
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Admin/getDriver') ?>",
            data: { kode: kode},
            success: function(res) {
                
                var nama = res[0].nama
                $('#nama').val(nama)
                $('#nama').css('font-weight', '600')
                $('#kode').val(kode)
            }
        })
    }
    
    function deleteD(kode) {
        $('.DelDriver').modal('show')
        $('#hapus').text('Yakin ingin menghapus driver '+kode + '?')
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
            url: "<?= base_url('Admin/updateDriver') ?>",
            data: {
                kode: kode, status: status
            },
            success: function(res) {
                // alert(res)
                $('.UpDriver').modal('hide')
                bootbox.alert(' Pelanggan ' + kode + ' berhasil diubah.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },
            error: function(res) {
                alert(res)
            }
        })
    })

    $('#btnDel').on('click', function() {
        var kode = $('#delkode').val() 
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "<?= base_url('Admin/deleteDriver') ?>",
            data: { kode: kode },
            success: function(res) {
                $('.DelDriver').modal('hide')
                bootbox.alert(' Driver ' + kode + ' berhasil di hapus.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })
</script> 