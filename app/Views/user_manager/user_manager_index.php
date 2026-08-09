<!DOCTYPE html>
<html lang="en">
<head>
  <?=$this->include('meta')?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
               <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('/plugins/toastr/toastr.min.css')?>">
</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
  <?=$this->include('preloader');?>
  <?=$this->include('navbar_lte');?>
  <?=$this->include(session()->get('sidebar'));?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Manager</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Manager</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data_table" style="width: 100%;" class="table table-sm table-bordered table-striped display compact">
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
                  <!-- modal -->
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
      <input type="hidden" id="<?= csrf_token() ?>" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    </section>
   <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?=$this->include('footer');?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('/plugins/jquery/jquery.min.js')?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-responsive/js/dataTables.responsive.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-buttons/js/dataTables.buttons.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')?>"></script>
<script src="<?= base_url('/plugins/jszip/jszip.min.js')?>"></script>
<script src="<?= base_url('/plugins/pdfmake/pdfmake.min.js')?>"></script>
<script src="<?= base_url('/plugins/pdfmake/vfs_fonts.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-buttons/js/buttons.html5.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-buttons/js/buttons.print.min.js')?>"></script>
<script src="<?= base_url('/plugins/datatables-buttons/js/buttons.colVis.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
<!-- Page specific script -->
<?=$this->include('option/user_type_option');?>
<script>
  var table;
  $(function () {
    loadTableData();
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



  function loadTableData(){
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
          url:"<?=base_url('/user_manager/datatable')?>",
          type:"post",
          data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
          },
          dataSrc : function ( json ) {
                  $("#<?= csrf_token()?>").val(json.new_csrf);
                  return json.data;
          },
          "destroy" : true,
        },
      order: [[2, 'asc']],
    columns: [
        /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
        }},*/
        { data: 'username',type:'text',title:'Username',className: ' dt-head-center dt-body-center'},
        { data: 'name',type:'text',title:'Nama',className: ' dt-head-center dt-body-center'},
        { data: 'user_type',type:'text',title:'Tipe',className: 'dt-head-center dt-body-center'},
        { data: null,type:'text',title:'Status',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
            if(row.status == 1){
              return 'Aktif <button id="status" type="button" class="btn btn-danger btn-xs">Nonaktifkan</button>';
            }else{
              return 'Non Aktif <button id="status" type="button" class="btn btn-success btn-xs">Aktifkan</button>';
            }
          }
        },
        {data: null,
        defaultContent: '<div class="btn-group"><button type="button" id="edit" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Edit</button><button type="button" id="reset" class="btn btn-warning btn-xs"><i class="fas fa-key"></i> Reset password</button></div>',
        targets: -1,className: 'dt-body-center'},
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{
                    text: '<i class="fas fa-plus"></i> Pengguna Baru',
                    className: 'btn-success btn-sm',
                    action: function (e, dt, node, config) {   
                      $('#modal-new').modal('show');
                      loadUserTypeOption($('#new_user_type'));
                    }
                }],
    });
    table.on('click', '#edit', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      loadUserTypeOption($('#edit_user_type'));
      $('#edit_user_type').val(data['user_type_seq']);
      $('#edit_username').val(data['username']);
      $('#edit_name').val(data['name']);
      $('#edit_id').val(data['id']);
      $('#modal-edit').modal('show');
    });
    table.on('click', '#reset', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
          // body...
      $('#reset_id').val(data['id']);
      $( "#reset_password_head" ).text('Reset Password ('+data['name']+')');
      $('#modal-reset-password').modal('show');
    });
    table.on('click', '#status', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      var form_data = new FormData();
      form_data.append('id',data['id']);
      if(data['status'] == 1){
        form_data.append('set_to',0);
      }else{
        form_data.append('set_to',1);
      }
      var request = $.ajax({
            url: '<?=base_url('/user_manager/toggle_status')?>',
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
          toastr.success('Status berhasil diubah');
          table.ajax.reload();
        }else{
          toastr.error('Status gagal diubah');
        }
      });
    });
  }



</script>
</body>
</html>
