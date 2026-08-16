<div class="modal fade" id="modal-password">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_password'>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="edt_pass" class="col-sm-4 col-form-label">Password baru</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="edt_pass" name="edt_pass" placeholder="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="edt_pass_re" class="col-sm-4 col-form-label">Ketik ulang password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="edt_pass_re" name="edt_pass_re" placeholder="password" >
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
        function showModalPassword(){
            $('#modal-password').modal('show');
        }
        $('#form_password').validate({
            rules: {
                edt_pass: {
                required: true,
                minlength: 8,
                },
                edt_pass_re: {
                required: true,
                equalTo : edt_pass,
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
                let url="<?=base_url('/api/user-setting/change-password')?>";
                var request = $.ajax({
                method: "POST",
                async: false,
                cache: false,
                timeout: 30000,
                url: url,
                data: {
                    [csrfName] : '<?=csrf_hash()?>',
                   
                    id : '<?=$user['id']?>',
                },
                });
                request.done(function( reply ) {
                    if(reply['status'] == 1 ){
                    $('#modal-password').modal('hide');
                    toastr.success('Password berhasil diganti');
                    }else{
                    toastr.error('Password gagal diganti');
                    }
                });
                request.fail(function( jqXHR, textStatus, error ) {
                    var err = eval("(" + jqXHR.responseText + ")");
                    toastr.error(err.message);
                });
            }
        });
    </script>   
<?= $this->endSection() ?>
    