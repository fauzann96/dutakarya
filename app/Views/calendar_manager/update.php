<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id='form_edit' action=''>
                <input type="hidden" id='edit_id' value="">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="edit_name" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit_date" class="col-sm-4 col-form-label">Tanggal</label>
                        <div class="col-sm-8">
                        <input type="date" class="form-control" id="edit_date" name="edit_date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="edit_type" class="col-sm-4 col-form-label">Tipe</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="edit_type" name="edit_type"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
          <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>
<?= $this->section('page_script') ?>
    <script type="text/javascript">
        function showEditModal(id){
            var request = $.ajax({
                url: '<?=base_url('/api/calendar_manager/data/')?>'+id,
                type: 'GET',
                async: false,
                cache: false,
                timeout: 30000,
            });
            request.done(function(reply){
                reply = reply['data'];
                $('#edit_id').val(reply['id']);
                $('#edit_name').val(reply['name']);
                $('#edit_date').val(reply['date']);
                $('#edit_type').val(reply['type']);
                $('#modal-edit').modal('show');
            });
            request.fail(function(){
                toastr.error('request failed');
            });
        }
        $('#form_edit').validate({
            rules: {
                    edit_name: {
                    required: true,
                    },
                    edit_date: {
                    required: true,
                    },
                    edit_type: {
                    required: true,
                    },
                },
                messages: {
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group div').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler:function(event){
                    var csrfName = '<?=csrf_token()?>';
                    var request = $.ajax({
                        url: '<?=base_url('/calendar_manager/edit/submit')?>',
                        type: 'POST',
                        async: false,
                        cache: false,
                        timeout: 30000,
                        data:{
                            '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
                            name : $('#edit_name').val(),
                            date : $('#edit_date').val(),
                            type : $('#edit_type').val(),
                            id:$('#edit_id').val(),
                    }
                });
                request.done(function(reply){
                    $('#<?=csrf_token()?>').val(reply['new_csrf']);
                    if(reply['status'] == 1){
                    toastr.success('Data berhasil diubah');
                    $('#modal-edit').modal('hide');
                    table.ajax.reload();
                    }else{
                    toastr.error('Perubahan gagal disimpan');
                    }
                });
                request.fail(function(){
                    toastr.error('request failed');
                });
            }
        });

    </script>
<?= $this->endSection() ?>