      <div class="modal fade " id="modal-reset-password">
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <div class="modal-header bg-warning">
              <h4 id="reset_password_head" class="modal-title">Reset Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_reset_password' action=''>
                <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password Baru</label>
                  <div class="col-sm-9">
                    <input type='password' id="reset_password" name="reset_password" class="form-control" style="width: 100%;">
                    </input>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Ketik Ulang Password</label>
                  <div class="col-sm-9">
                    <input type='password' id="reset_password_retype" name="reset_password_retype" class="form-control" style="width: 100%;">
                    </input>
                  </div>s
                </div> 
                <input type="hidden" id="reset_id" name="reset_id"/>           
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
    <script>
        function resetPassword(id, name) {
            $('#reset_id').val(id);
            $("#reset_password_head").text('Reset Password for ' + name);
            $('#modal-reset-password').modal('show');
        }

        $('#form_reset_password').validate({
            rules: {
                reset_password: {
                    required: true,
                    minlength: 8,
                },
                reset_password_retype: {
                    required: true,
                    equalTo: "#reset_password"
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
            $(element).addClass('is-valid');
        },
        submitHandler:function(event){
            var csrfName = '<?=csrf_token()?>';
            let url="<?=base_url('api/user_manager/reset_password')?>";
            var request = $.ajax({
            method: "POST",
            async: false,
            cache: false,
            timeout: 30000,
            url: url,
            data: {
                [csrfName] : '<?=csrf_hash()?>',
                id : $('#reset_id').val(),
                password : $('#reset_password').val(),
                },
            });
            request.done(function( reply ) {
                if(reply['status'] == 1 ){
                $('#modal-reset-password').modal('hide');
                table.ajax.reload();
                $("#form_reset_password")[0].reset();
                }else{
                alert('Password Gagal Direset');
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