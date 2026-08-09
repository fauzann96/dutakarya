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
            <h1 id="title_company"><?=session()->get('title')?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Info</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tad" data-toggle="tab">TAD</a></li>
                  <li class="nav-item"><a class="nav-link" href="#location" data-toggle="tab">Lokasi</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="info">
                    <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3><sup style="font-size: 20px"><span id="total_location"></span></sup></h3>
                            <p>Lokasi</p>
                          </div>
                          <div class="icon">
                            <i class="far fa-building"></i>
                          </div>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            <h3><sup style="font-size: 20px"><span id="total_employee"></span></sup></h3>
                            <p>Tenaga Alih Daya</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                          <div class="inner">
                            <h3><sup style="font-size: 20px"><span id="txt_korlap"><?=$customer['fc_name'] ?: ' -'?></span></sup></h3>
                            <p>Korlap</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-user-alt"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            <h3><sup style="font-size: 20px"><span id="txt_area"><?=$customer['area_name'] ?: ' -'?></span></sup></h3>
                            <p>Area</p>
                          </div>
                          <div class="icon">
                            <i class="fas fa-map-marker"></i>
                          </div>
                        </div>
                      </div>
                    </div>

                      <strong><i class="fas fa-book mr-1"></i> Nama Customer</strong>

                      <p class="text-muted" id="txt_name">
                        <?=$customer['name']?>
                      </p>

                      <hr>

                      <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                      <p class="text-muted" id="txt_address"><?=$customer['address']?></p>

                      <hr>
                      <strong><i class="fas fa-phone mr-1"></i> Nomor Telepon</strong>

                      <p class="text-muted" id="txt_phone"><?=$customer['phone']?></p>

                      <hr>
                      <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                      <p class="text-muted" id="txt_email"><?=$customer['email']?></p>

                      <hr>

                      <strong><i class="fas fa-map-marker-alt mr-1"></i> PIC 1</strong>
  
                      <h2 class="lead" id="txt_pic1_name"><b><?=$customer['pic_1_name'] ?: ' -'?></b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li><i class="far fa-lg fa-envelope"></i> <span id="txt_pic1_email"><?=$customer['pic_1_name'] ?: ' -'?></span></li>
                        <li><i class="fas fa-lg fa-phone"></i> <span id="txt_pic1_phone"><?=$customer['pic_1_phone'] ?: '-'?></span></li>
                      </ul>


                      <hr>

                      <strong><i class="fas fa-map-marker-alt mr-1"></i> PIC 2</strong>

                      <h2 class="lead" id="txt_pic2_name"><b><?=$customer['pic_2_name'] ?: ' -'?></b></h2>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li><i class="far fa-lg fa-envelope"></i> <span id="txt_pic2_email"><?=$customer['pic_2_name'] ?: ' -'?></span></li>
                        <li><i class="fas fa-lg fa-phone"></i> <span id="txt_pic2_phone"><?=$customer['pic_2_phone'] ?: ' -'?></span></li>
                      </ul>
                  </div>
                  
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tad">
                      <table id="table_employee" class="table table-sm table-bordered table-striped compact">
                        
                      </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="location">

                      <table id="table_location" class="table table-sm table-bordered table-striped compact">
                        
                      </table>

                  </div>
                  <!-- /.tab-pane -->                
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

      <!-- modal -->

      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
                <div class="modal-body row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="edit_name" class="col-sm-3 col-form-label">Nama Lokasi</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_name' name='edit_name' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_address" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_address' name='edit_address' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_phone" class="col-sm-3 col-form-label">Nomor Telepon</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_phone' name='edit_phone' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_email" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_email' name='edit_email'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_email" class="col-sm-3 col-form-label">Area</label>
                      <div class="col-sm-9">
                        <select class="form-control" id='edit_area' name='edit_area' required></select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_fc" class="col-sm-3 col-form-label">Korlap</label>
                      <div class="col-sm-9">
                        <select class="form-control" id='edit_fc' name='edit_fc'></select>
                      </div>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" id="edit_no_fc" type="checkbox">
                      <label class="form-check-label">Tanpa Korlap</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label for="edit_pic1_name" class="col-sm-3 col-form-label">Nama PIC 1</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_pic1_name' name='edit_pic1_name' >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_pic1_email" class="col-sm-3 col-form-label">Email PIC 1</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_pic1_email' name='edit_pic1_email' >
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_pic1_phone" class="col-sm-3 col-form-label">Telepon PIC 1</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_pic1_phone' name='edit_pic1_phone'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_pic2_name" class="col-sm-3 col-form-label">Nama PIC 2</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_pic2_name' name='edit_pic2_name'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_pic2_email" class="col-sm-3 col-form-label">Email PIC 2</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_pic2_email' name='edit_pic2_email'>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_pic2_phone" class="col-sm-3 col-form-label">Telepon PIC 2</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_pic2_phone' name='edit_pic2_phone'>
                      </div>
                    </div>
                  </div>                 
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-success">Lanjutkan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade " id="modal-new-location">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Lokasi Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new_location' action=''>
                <input type="hidden" id='user_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="new_location_name" class="col-sm-3 col-form-label">Nama Lokasi</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='new_location_name' name='new_location_name' required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_description" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='new_description' name='new_description' required>
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

      <div class="modal fade " id="modal-edit-location">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Lokasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit_location' action=''>
                <input type="hidden" id='edit_div_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="edit_location_name" class="col-sm-3 col-form-label">Nama Lokasi</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='edit_location_name' name='edit_location_name' required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="edit_description" class="col-sm-3 col-form-label">Deskripsi</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='edit_description' name='edit_description' required>
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
      <div class="modal fade" id="modal-delete-location">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus Lokasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete_location' action=''>
                <input type="hidden" id='delete_location_id' name='delete_location_id' value="">
                <div class="modal-body">
                  <center><h3 id="delete_location_confirm"></h3></center>
                    <div class="form-group row">
                      <input type="text" class="form-control" id="delete_location_reason" name="delete_location_reason" placeholder="Alasan penghapusan" required>
                  </div> 
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- /. modal -->
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
<?=$this->include('jquery_option');?>
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
<!-- jquery-validation -->
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<?=$this->include('jquery_option');?>
<!-- Page specific script -->
<script>
var employee_table;
var location_table;

$(function () {
  loadTableEmployee();
  loadTableLocation();
});

$('#form_edit_location').validate({
      rules: {
        edit_location_name :{
          required:true,
        },
        edit_description :{
          required:true,
        },
      },
      messages: {
        edit_location_name :{
          required:"Harap isi nama lokasi",
        },
        edit_description :{
          required:"Harap isi deksripsi",
        },
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
        var request = $.ajax({
          url: "<?=base_url('/customer/location/edit/submit')?>",
          type: 'POST',
          async: false,
          cache: false,
          timeout: 30000,
          data:{
          '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
          name : $('#edit_location_name').val(),
          description : $('#edit_description').val(),
          id:$('#edit_div_id').val(),
          },
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            toastr.success('Lokasi berhasil diupdate');
            $('#modal-edit-location').modal('hide');
            $('#form_edit_location')[0].reset();
            location_table.ajax.reload();
          }else{
            toastr.error('Gagal mengupdate lokasi');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
           toastr.error( "Request failed: " + textStatus );
        });
      }
});

function showModalEditLocation(data){
  $('#modal-edit-location').modal('show');
  $('#edit_location_name').val(data['name']);
  $('#edit_description').val(data['description']);
  $('#edit_div_id').val(data['id']);
}

$('#form_new_location').validate({
      rules: {
        new_location_name :{
          required:true,
        },
        new_description :{
          required:true,
        },
      },
      messages: {
        new_location_name :{
          required:"Harap isi nama lokasi",
        },
        new_description:{
          required:"Harap pilih deskripsi",
        },
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
        var request = $.ajax({
          url: "<?=base_url('/customer/location/new/submit')?>",
          type: 'POST',
          async: false,
          cache: false,
          timeout: 30000,
          data:{
          [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
          name : $('#new_location_name').val(),
          description : $('#new_description').val(),
          customer_id:<?=$id?>,
          },
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            toastr.success('Lokasi berhasil ditambahkan');
            $('#modal-new-location').modal('hide');
            $('#form_new_location')[0].reset();
            location_table.ajax.reload();
          }else{
            toastr.error('Gagal menambahkan lokasi');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
           toastr.error( "Request failed: " + textStatus );
        });
      }
});
$('#form_delete_location').validate({
      rules: {
        delete_location_reason :{
          required:true,
        },
      },
      messages: {
        delete_location_reason:{
          required:"Harap pilih deskripsi",
        },
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
        var request = $.ajax({
          url: "<?=base_url('/customer/location/delete/submit')?>",
          type: 'POST',
          async: false,
          cache: false,
          timeout: 30000,
          data:{
          '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
          id : $('#delete_location_id').val(),
          reason : $('#delete_location_reason').val(),
          },
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            toastr.success('Lokasi berhasil dihapus');
            $('#modal-delete-location').modal('hide');
            $('#form_delete_location')[0].reset();
            location_table.ajax.reload();
          }else{
            toastr.error('Gagal menghapus lokasi');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
           toastr.error( "Request failed: " + textStatus );
        });
      }
});

function showModalNewLocation(){
  $('#modal-new-location').modal('show');
  loadPosOption($('#new_related_pos'));
}

function loadTableLocation(){
  location_table = $("#table_location").DataTable({
      dom: '<"container-fluid"<"row"<"col"B>>rt<"row"<"col"i><"col"p>>>',
      ajax:{
        url:"<?=base_url('/customer/location/datatable')?>",
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              customer_id:'<?=$id?>',
              limit: function() { return $('#limit_rows').val(); },
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                $('#modal-limit').modal('hide');
                $('#total_location').text(json.data.length);
                return json.data;
        },
        "destroy" : true,
      },
    columns: [
        /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
        }},*/
        { data: 'name',type:'text',title:'Nama Lokasi',className: ' dt-head-center'},
        { data: 'description',type:'text',title:'Deskripsi',className: ' dt-head-center dt-body-center'},
        {data: null,
        defaultContent: '<div class="btn-group"><button type="button" id="edit" class="btn btn-info btn-xs"><i class="far fa-edit"></i> Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i> Hapus</button></div>',
        targets: -1,className: 'dt-body-center'},
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{
                    text: '<i class="fas fa-plus"></i> Lokasi Baru',
                    className: 'btn btn-info btn-sm',
                    action: function (e, dt, node, config) {
                      showModalNewLocation();
                    }
                },                ],
    });
    location_table.on('click', '#edit', function (e) {
      var data = location_table.row(this).data();
      if(data==null){
        data = location_table.row(e.target.closest('tr')).data();
      }
        showModalEditLocation(data);
    });
    location_table.on('click', '#delete', function (e) {
      var data = location_table.row(this).data();
      if(data==null){
        data = location_table.row(e.target.closest('tr')).data();
      }
        $('#modal-delete-location').modal('show');
        $('#delete_location_id').val(data['id']);
        $('#delete_location_confirm').text('Hapus '+data['name']+'?');
    });
}

function loadTableEmployee(){
  employee_table = $("#table_employee").DataTable({
      dom: '<"container-fluid"t<"row"<"col"i><"col"p>><"col"B>>',
      "oLanguage": {
          "sEmptyTable": "Tidak ada karyawan"
      },
      ajax:{
        url:"<?=base_url('/customer/employee/datatable')?>",
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              wu_id:'<?=$id?>',
              limit: function() { return $('#limit_rows').val(); },
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                $('#modal-limit').modal('hide');
                $('#total_employee').text(json.data.length);
                return json.data;
        },
        "destroy" : true,
      },
    columns: [
        { data: null,type:'text',title:'Nama TAD',className:'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              return row.name+' <div class="btn-group"><button type="button" id="lihat" class="btn btn-info btn-xs"><i class="far fa-eye"></i>Lihat</button></div>'
            }
          },
        { data: 'nip',type:'text',title:'NIP',className: ' dt-head-center dt-body-center'},
        { data: 'customer_location_name',type:'text',title:'Lokasi',className: ' dt-head-center dt-body-center'},
        { data: 'position',type:'text',title:'Jabatan',className: ' dt-head-center dt-body-center'},
        { data: 'phone',type:'text',title:'Telepon',className:'dt-body-center dt-head-center',render: function (data, type, row, meta) {
                  return data+' <a href="https://wa.me/' + data.replace(0, "62") + '" target="_blank"><i class="fab fa-whatsapp"></i></a>';
        }},
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [],
    });
    employee_table.on('click', '#lihat', function (e) {
      var data = employee_table.row(this).data();
      if(data==null){
        data = employee_table.row(e.target.closest('tr')).data();
      }
        window.location = "<?= base_url('/employee/')?>"+data['id'];
    });
}


</script>
</body>
</html>
