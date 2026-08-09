<!DOCTYPE html>
<html lang="en">
<head>
  <?=$this->include('meta')?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?=$this->include('preloader');?>
  <?=$this->include('navbar_lte');?>
  <?=$this->include(session()->get('sidebar'))?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengaturan Pengguna</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Profil Pengguna</h3>
                <div class="card-tools">
                <button type="button" class="btn bg-warning btn-sm" onclick="showModalEdit()">
                  <i class="fas fa-pencil-alt"></i> Ubah
                </button>
                <button type="button" class="btn bg-danger btn-sm" onclick="showModalPassword()">
                  <i class="fas fa-key"></i> Ganti Password
                </button>
              </div>
              </div>
              
              <div class="card-body">
                  <h3 class="profile-username" id="text-name"><?=$user['name']?></h3>
                  <p class="text-muted" id="text-username"><?=$user['username']?></p>
              </div>
              <div class="card-footer">
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tanda tangan</h3>
              </div>
                <div class="card-body row">
                  <div class="col-md-3 text-center">
                    <img id='view_sign_img' class="img-fluid img-square" src="<?=base_url().$user['signature']?>" alt="User signature">
                  </div>
                  <div class="col-md-9">
                    <form id='sign_img_form' enctype="multipart/form-data">
                      <input type="hidden" id="csrf" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                      <div class="form-group">
                        <label for="exampleInputFile">Gambar tanda tangan</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file">
                            <label class="custom-file-label" for="sign_img">Pilih file png transparan</label>
                          </div>
                          <div class="input-group-append">
                            <button type='submit' class="btn btn-success">Upload</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              
              <div class="card-footer">
              </div>

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <!-- modal -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Profil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='modal_edit' action=''>
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
      <!-- modal -->
      <div class="modal fade" id="modal-password">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ganti Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_password' action=''>
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
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<script>
  $(function () {
    $('#modal_edit').on('submit',function(e){
      e.preventDefault();
      submitModalEdit();
    });

    $('#sign_img_form').on('submit',function(e){
      e.preventDefault();
      submitSignImg();
    });

    $("#file").change(function (){
       var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
       //alert(fileName);
       $('[for="sign_img"]').text(fileName);
     });
  });

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
          let url="<?=base_url('/user_setting/password/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [csrfName] : '<?=csrf_hash()?>',
            password : $('#edt_pass').val(),
          },
        });
          request.done(function( reply ) {
            if(reply['status'] == 1 ){
              table.ajax.reload();
               $('#modal-password').modal('hide');
               alert('Password berhasil diganti');
            }else{
              alert('Password gagal diganti');
            }
          });
          request.fail(function( jqXHR, textStatus, error ) {
            var err = eval("(" + jqXHR.responseText + ")");
            alert(err.message);
          });
      }
  });

  function showModalEdit(argument) {
    $('#modal-edit').modal('show');
    $('#name').val($('#text-name').text());
    $('#username').val($('#text-username').text());
    // body...
  }
  function submitModalEdit(){
    var csrfName = '<?=csrf_token()?>';
      var request = $.ajax({
          url: '<?=base_url('/user_setting/profile_edit/submit')?>',
          type: 'POST',
          async: false,
          cache: false,
          timeout: 30000,
          data:{
            [csrfName] : '<?=csrf_hash()?>',
            username : $('#username').val(),
            name : $('#name').val(),
          }
      });
      request.done(function(reply){
        if(reply['status'] == 'success'){
          alert('perubahan berhasil disimpan');
          $('#text-name').text(reply['name']);
          $('#text-username').text(reply['username']);
          $('#modal-edit').modal('hide');
        }else{
          //$('#username').val(reply['fc_data']['username']);
          alert('perubahan gagal disimpan');
        }
      });
      request.fail(function(){
        alert('request failed');
      });
  }
  function submitSignImg(){
    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
    var csrfHash = $('.txt_csrfname').val(); // CSRF hash
    var files = $('#file')[0].files;
    // Create an FormData object 
    var form_data = new FormData();
    form_data.append('file',files[0]);
    form_data.append([csrfName],csrfHash);
    
    var request = $.ajax({
          url: '<?=base_url('/user_setting/upload_sign')?>',
          type: 'POST',
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          data : form_data,
          dataType: 'json',
      });
      request.done(function(reply){
        if(reply['status'] == 1){
          $('#view_sign_img').attr("src", reply['filepath']);
        }else{
          //$('#username').val(reply['fc_data']['username']);
          alert(reply['error']);
        }
        $('#csrf').val(reply['token']);
      });
      request.fail(function(){
        alert('request failed');
      });
  }
  
</script>
</body>
</html>
