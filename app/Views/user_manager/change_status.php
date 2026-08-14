<?= $this->section('page_script') ?>

<script>

    function changeStatus(id, status) {
        $.ajax({
            url: base_url + '/api/user_manager/change_status',
            type: 'POST',
            data: {
                id: id,
                status: status,
                '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    loadTableData();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Terjadi kesalahan saat mengubah status.');
            }
        });
    }

</script>

<?= $this->endSection() ?>