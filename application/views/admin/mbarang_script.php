<script>
    function updateBrg(kode, nama, harga) {
        $('#update').modal('show')
        $('#kode').val(kode)
        $('#kode').attr('readonly', true)
        $('#nama').val(nama)
        $('#harga').val(harga)
    }
    $('#add').on('click', function() {
        $('#addModal').modal('show')
        var kdBrg = <?php echo json_encode($kode) ?>;
        $('#kode1').val(kdBrg)
        $('#kode1').attr('readonly', true)
    })

    function deleteBrg(kode) {
        $('.DelBrg').modal('show')
        $('#hapus').text('Yakin ingin menghapus pelanggan '+kode + '?')
        $('#delkode').val(kode)
    }
</script>

<script>
    $('#btnSave').on('click', function() {
        var kode = $('#kode').val()
        var nama = $('#nama').val()
        var harga = $('#harga').val()

        var urlUpdate = "<?= base_url('Admin/updateBarang') ?>"

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: urlUpdate,
            data: {
                kode: kode,
                nama: nama,
                harga: harga
            },
            success: function(res) {
                $('#update').modal('hide')
                bootbox.alert('Kode Barang ' + kode + ' berhasil diubah.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })
    $('#btnSaveAdd').on('click', function() {
        var kode = $('#kode1').val()
        var nama = $('#nama1').val()
        var harga = $('#harga1').val()

        var urlUpdate = "<?= base_url('Admin/addBarang') ?>"

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: urlUpdate,
            data: {
                kode: kode,
                nama: nama,
                harga: harga
            },
            success: function(res) {
                $('#addModal').modal('hide')
                bootbox.alert('Kode Barang ' + kode + ' berhasil diubah.. ✔️')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })
    })

    $('#btnDel').on('click', function() {
        var kode = $('#delkode').val() 
        $('.DelBrg').modal('hide')
        setTimeout(() => {
            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: "<?= base_url('Admin/deleteBrg') ?>",
                data: { kode: kode },
                success: function(res) {
                    $('.DelCust').modal('hide')
                    bootbox.alert(' Data barang ' + kode + ' berhasil di hapus.. ✔️')
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            })
        }, 1000);
    })
</script>