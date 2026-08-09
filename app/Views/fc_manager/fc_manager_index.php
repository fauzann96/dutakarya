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
            <h1>Pengguna Korlap</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengguna Korlap</li>
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
      

<!-- /.modal -->
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
    <!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Page specific script -->
<script>
  var table;
  $(function () {
    // body...
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
          url:'<?=base_url('/fc_manager/datatable')?>',
          type:"post",
          data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
          },
          dataSrc : function ( json ) {
                  $("#<?= csrf_token()?>").val(json.new_csrf);
                  return json.data;
          },
          "destroy" : true,
        },
      columns: [
        /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
        }},*/
        { data: 'name',type:'text',title:'Nama',className: ' dt-head-center'},
        { data: 'nip',type:'text',title:'NIP',className: ' dt-head-center dt-body-center'},
        { data: 'customer_name',type:'text',title:'Korlap Unit Kerja',className: 'dt-head-center dt-body-center'},
        { data: null,type:'text',title:'Action',className: 'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              return '<div class="btn-group"><button type="button" id="reset" class="btn btn-warning btn-xs"><i class="fas fa-key"> Reset Password</i></button></div>'
            }
        },
      ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [],
    });
    table.on('click', '#reset', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      //window.location = "<?= base_url('/fc_manager/user/edit/')?>"+data['id'];
      $('#modal-reset').modal('show');
      $('#reset_id').val(data['id']);
    });

  });

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
</body>
</html>
