<!--pick layout-->
<?= $this->extend('adminlte_layout/main') ?>

<?= $this->section('page_content') ?>

<div class="row">
    <div class="col-12">

        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <?=$this->include('user_manager/datatable');?>
            </div>
            <!-- /.card-body -->
        </div>
    <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection() ?>

<?= $this->section('page_modal') ?>

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
                  <div class="col-sm-9">
                    <select id="new_user_type" name="new_user_type" class="form-control" style="width: 100%;">
                    </select>
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

                        <!-- modal -->
      <div class="modal fade " id="modal-edit">
        <div class="modal-dialog modal-md">
          <div class="modal-content text-sm">
            <form id='form_edit' action=''>
              <input type="hidden" name="edit_id" id='edit_id'>
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Pengguna</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Tipe Pengguna</label>
                <div class="col-sm-9">
                  <select id="edit_user_type" name="edit_user_type" class="form-control" style="width: 100%;">
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                  <input id="edit_username" name="edit_username" class="form-control" style="width: 100%;">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input id="edit_name" name="edit_name" class="form-control" style="width: 100%;">
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
                  <label class="col-sm-3 col-form-label">Password</label>
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
                  </div>
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

<?= $this->endSection() ?>

<?= $this->section('on_document_ready_script') ?>

<?= $this->endSection() ?>

<?= $this->section('page_script') ?>

<script>
  var table;
  $(function () {

    // body...
    $.validator.addMethod("uniqueUsername", function (value, element) {
    let result = false;
    $.ajax({
      type: "POST",
      url: "<?=base_url('user_manager/check_username')?>",
      dataType: "JSON",
      data: {
                '<?=csrf_token()?>':$('#<?=csrf_token()?>').val(),
                'new_username':value,
                'edit_id':$('#edit_id').val()
            },
      success: function (reply) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if (reply.data === 1) {
          // console.log(data.data.email + ': This email exists.');
          result = false;
        } else {
          // console.log(data.data.email + ': This email does not exist.');
          result = true;
        }
      },
      async: false
    });
    // console.log(result);
    return result;
  });
  });

  $('#form_reset_password').validate({
      rules: {
        reset_password: {
          required: true,
          minlength: 8,
        },
        reset_password_re: {
          required: true,
          equalTo : reset_password,
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
          let url="<?=base_url('/user_manager/reset_password/submit')?>";
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
              url: '<?=base_url('/user_manager/new/submit')?>',
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

  $('#form_edit').validate({
      rules: {
        edit_user_type: {
          required: true,
        },
        edit_username: {
          required: true,
          uniqueUsername: true,
        },
        edit_name: {
          required: true,
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
        form_data.append('id',$('#edit_id').val());
        form_data.append('user_type',$('#edit_user_type').val());
        form_data.append('username',$('#edit_username').val());
        form_data.append('name',$('#edit_name').val());
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      
        var request = $.ajax({
              url: '<?=base_url('/user_manager/edit/submit')?>',
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
            toastr.success('User berhasil diupdate');
            $('#modal-edit').modal('hide');
            table.ajax.reload();
            $("#form_edit")[0].reset();
          }else{
            toastr.danger('User gagal diupdate');
          }
        });
        request.fail(function( jqXHR, textStatus, error ) {
          var err = eval("(" + jqXHR.responseText + ")");
          toastr.danger(err.message);
        });
      }
  });

   $('#form_reset_password').validate({
      rules: {
        reset_password: {
          required: true,
          minlength: 8,
        },
        reset_password_retype: {
          required: true,
          equalTo : new_password,
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
        var form_data = new FormData();
        form_data.append('id',$('#reset_id').val());
        form_data.append('password',$('#reset_password').val());;
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      
        var request = $.ajax({
              url: '<?=base_url('/user_manager/reset_password/submit')?>',
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
            toastr.success('Password berhasil diubah');
            $('#modal-reset-password').modal('hide');
            //table.ajax.reload();
            $("#form_reset_password")[0].reset();
          }else{
            toastr.danger('Password gagal diubah');
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
