<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Ubah Profil</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id='modal_edit'>
            <input type="hidden" id='user_id' value="">
            <div class="modal-body">
                <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="username" required>
                </div>
                </div>
                <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" placeholder="username" required>
                </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?= $this->section('page_script') ?>
    <script type="text/javascript">
        function showModalEdit(){
            $('#user_id').val('<?=$user['id']?>');
            $('#name').val('<?=$user['name']?>');
            $('#username').val('<?=$user['username']?>');
            $('#modal-edit').modal('show');
        }
        $('#modal_edit').on('submit',function(e){
            e.preventDefault();
            var csrfName = '<?=csrf_token()?>';
            var request = $.ajax({
                url: '<?=base_url('/api/user-setting/update')?>',
                type: 'POST',
                async: false,
                cache: false,
                timeout: 30000,
                data:{
                    [csrfName] : '<?=csrf_hash()?>',
                    id : $('#user_id').val(),
                    username : $('#username').val(),
                    name : $('#name').val(),
                    },
                dataType: 'json'
            });
            request.done(function(reply){
                if(reply['status'] == 'success'){
                toastr.success('perubahan berhasil disimpan');
                $('#text-name').text(reply['name']);
                $('#text-username').text(reply['username']);
                $('#modal-edit').modal('hide');
                }else{
                //$('#username').val(reply['fc_data']['username']);
                toastr.error('perubahan gagal disimpan');
                }
            });
            request.fail(function(){
                toastr.error('request failed');
            });
        });
    </script>
<?= $this->endSection() ?>