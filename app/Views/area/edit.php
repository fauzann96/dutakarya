<div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Info Area</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
                <input type="hidden" id='edt_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="edt_name" class="col-sm-3 col-form-label">Nama Area</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edt_name" name="edt_name" placeholder="Nama area" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edt_desc" name="edt_desc" placeholder="Keterangan">
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
        function showEditModal(id){
            let url="<?=base_url('/area/data/')?>"+id;
            var request = $.ajax({
                    method: "get",
                    async: false,
                    cache: false,
                    timeout: 30000,
                    url: url,
                    data: {
                    },
                });
            request.done(function( reply ) {
                if(reply['status'] == 1 ){
                $('#modal-edit').modal('show');
                var dat = reply['data'];
                $('#edt_id').val(id);
                $('#edt_name').val(dat['name']);
                $('#edt_desc').val(dat['description']);

                }else{
                alert('Tidak dapat mengedit');
                }
            });
            request.fail(function( jqXHR, textStatus, error ) {
                var err = eval("(" + jqXHR.responseText + ")");
                alert(err.message);
            });
        }
        $('#form_edit').validate({
            rules: {
                edt_name:{
                required:true,
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
                let url="<?=base_url('/api/area/update')?>";
                var request = $.ajax({
                method: "POST",
                async: false,
                cache: false,
                timeout: 30000,
                url: url,
                data: {
                    [csrfName] : '<?=csrf_hash()?>',
                    id : $('#edt_id').val(),
                    name: $('#edt_name').val(),
                    desc: $('#edt_desc').val(),
                },
                });
                request.done(function( reply ) {
                    if(reply['status'] == 1 ){
                    $('#modal-edit').modal('hide');
                        table.ajax.reload();
                        toastr.success('Perubahan berhasil disimpan');
                    }else{
                        toastr.error('Perubahan tidak disimpan');
                    }
                });
                request.fail(function( jqXHR, textStatus, error ) {
                    var err = eval("(" + jqXHR.responseText + ")");
                    alert(err.message);
                });
            }
        });       
    </script>
<?= $this->endSection() ?>