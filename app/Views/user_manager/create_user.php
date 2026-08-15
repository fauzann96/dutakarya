      <div class="modal fade " id="modal-new">
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <div class="modal-header bg-success">
              <h4 class="modal-title">Pengguna Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new' action=''>
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tipe Pengguna</label>
                  <div class="col-sm-9">s
                    <?= view_cell('App\Views\user_type\UserTypeCell::Options', ['id' => 'new_user_type', 'name' => 'new_user_type']) ?> 
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Username</label>
                  <div class="col-sm-9">
                    <input id="new_username" name="new_username" class="form-control" style="width: 100%;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nama</label>
                  <div class="col-sm-9">
                    <input id="new_name" name="new_name" class="form-control" style="width: 100%;">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-9">
                    <input type='password' id="new_password" name="new_password" class="form-control" style="width: 100%;">
                    </input>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Ketik Ulang Password</label>
                  <div class="col-sm-9">
                    <input type='password' id="new_password_retype" name="new_password_retype" class="form-control" style="width: 100%;">
                    </input>
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

      <script>
        $('#form_new').validate({
        rules: {
          new_user_type: {
            required: true,
          },
          new_username: {
            required: true,
            uniqueUsername: true,
          },
          new_name: {
            required: true,
          },
          new_password: {
            required: true,
            minlength: 8,
          },
          new_password_retype: {
            required: true,
            equalTo : new_password,
          },
        },
        messages: {
          new_username: {
            uniqueUsername: "Username sudah digunakan."
          },
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
        var form_data = new FormData();
        form_data.append('user_type',$('#new_user_type').val());
        form_data.append('username',$('#new_username').val());
        form_data.append('name',$('#new_name').val());
        form_data.append('password',$('#new_password').val());
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      
        var request = $.ajax({
              url: '<?=base_url('/api/user_manager/new/submit')?>',
              type: 'POST',
              contentType: false,
              processData: false,  // Important!
              async: false,
              cache: false,
              timeout: 30000,
              data : form_data,
              dataType: 'json',
          });
        
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            toastr.success('User berhasil dibuat');
            $('#modal-new').modal('hide');
            table.ajax.reload();
            $("#form_new")[0].reset();
          }else{
            toastr.danger('User gagal dibuat');
          }
        });
        request.fail(function( jqXHR, textStatus, error ) {
          var err = eval("(" + jqXHR.responseText + ")");
          toastr.danger(err.message);
        });
      }
  });
      </script>
      <?= $this->endSection() ?>