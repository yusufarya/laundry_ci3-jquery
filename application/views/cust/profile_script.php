<script>
    function btnEdit() {
        var me = <?= json_encode($me) ?>;
        $('#updateModal').modal('show')
        $('#kode').val(me.kode)
        $('#nama').val(me.nama)
        $('#tgl_lahir').val(me.tgl_lahir)
        $('#alamat').val(me.alamat)
        $('#no_telp').val(me.no_telp)
    }
</script>

<script>
    $('#btn_save').on('click',function () {
        var kode = $('#kode').val()
        var nama = $('#nama').val()
        var alamat = $('#alamat').val()
        var no_telp = $('#no_telp').val()
        var tgl_lahir = $('#tgl_lahir').val()
        var jnskel = $('#jnskel').val()
        var status = $('#status').val()
        
        $.ajax({
            type    : "POST",
            dataType: "JSON",
            url     : "<?= base_url('Customer/updateProfile') ?>",
            data    : {
                kode:kode, nama:nama, alamat:alamat, tgl_lahir:tgl_lahir, no_telp:no_telp, jnskel:jnskel, status:status
            },
            success: function (res) {
                // alert(res)
                bootbox.alert('Berhasil ubah biodata.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
        })
    })
</script>