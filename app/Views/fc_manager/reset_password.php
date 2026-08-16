    <div class="modal fade" id="modal-reset">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Reset Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_reset' action=''>
                <input type="hidden" id='reset_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="reset_password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="reset_password" name="reset_password" placeholder="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_pass_re" class="col-sm-4 col-form-label">Ketik Ulang Password</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="reset_password_retype" name="reset_password_retype" placeholder="ulangi password" required>
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
      function showResetModal(id){
        $('#reset_id').val(id);
        $('#modal-reset').modal('show');
      }
      $('#form_reset').validate({
          rules: {
            reset_password :{
              required:true,
              minlength: 8,
            },
            reset_password_retype :{
              required:true,
              equalTo : reset_password,
            },
          },
          messages: {
            
          },
          errorElement: 'span',
          errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
          },
          submitHandler:function(event){
            var request = $.ajax({
              url: "<?=base_url('/fc_manager/reset_password')?>",
              type: 'POST',
              async: false,
              cache: false,
              timeout: 30000,
              data:{
              '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
              'id' : $('#reset_id').val(),
              'password' : $('#reset_password').val(),
              },
            });
            request.done(function(reply){
              $('#<?=csrf_token()?>').val(reply['new_csrf']);
              if(reply['status'] == 1){
                toastr.success('Password Berhasil Diupdate');
                $('#form_reset')[0].reset();
                $('#modal-reset').modal('hide');
              }else{
                toastr.error('Password Gagal Diedit');
              }
            });
            request.fail(function (jqXHR, textStatus) {
              toastr.error(jqXHR.status);
            });
          }
      });
  </script>
<?= $this->endSection() ?>