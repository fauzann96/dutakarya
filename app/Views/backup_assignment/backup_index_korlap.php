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
    <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
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
            <h1>Penugasan Backup</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Backup</li>
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
            <!-- Filter -->
            <form id="form_filter">
              <div class="card card-primary collapsed-card">
                <div class="card-header">
                  <h3 class="card-title">Advanced Filter</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="filter_type">Jenis Filter</label>
                        <select class="form-control" id="filter_type" name="filter_type">
                          <option disabled selected>Pilih filter</option>
                          <option value="name" type='input'>Nama</option>
                          <option value="nip" type='input'>NIP</option>
                          <option value="position" type='input'>Jabatan/Posisi</option>
                          <option value="date" type='date'>Tanggal</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4" id='filter_input_div'>
                      <div class="form-group">
                        <label for="filter_input">Kata Kunci</label>
                        <input class="form-control" id="filter_input" name="filter_input">
                      </div>
                    </div>
                    <div class="col-sm-4" id='filter_selection_div'>
                      <div class="form-group">
                        <label for="filter_selection">Pilih</label>
                        <select class="form-control select2bs4" id="filter_selection" name="filter_selection"></select>
                      </div>
                    </div>
                    <div class="col-sm-4" id='filter_date_div'>
                      <div class="form-group">
                        <label for="filter_date">Pilih Tanggal</label>
                        <input type='date' class="form-control" id="filter_date" name="filter_date">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-search"></i> Cari</button>
                  <button class="btn btn-sm btn-default float-right" onclick="resetFilter()"><i class="fas fa-redo-alt"></i> Reset</button>
                </div>
              </div>
            </form>
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="data_table" class="table table-sm table-bordered table-striped">
                  
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Penugasan Backup Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new_backup'>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-sm-12">
                      <hr class="mb-0 mt-0"><center class='text text-muted mt-0'><b>TAD Ditugaskan</b></center>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Customer</label>
                        <select id="new_customer" name="new_customer" class="form-control select2bs4" style="width: 100%;" required>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">TAD</label>
                        <select id="new_employee" name="new_employee" class="form-control select2bs4" style="width: 100%;" required>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-12">
                      <hr class="mb-0 mt-0"><center class='text text-muted mt-0'><b>Tujuan Backup</b></center>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Customer</label>
                        <select id="new_customer_destination" name="new_customer_destination" class="form-control select2bs4" style="width: 100%;" required>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Lokasi</label>
                        <select id="new_customer_location" name="new_customer_location" class="form-control select2bs4" style="width: 100%;" required>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Posisi</label>
                        <input type="text" id="new_position" name="new_position" class="form-control" style="width: 100%;" required>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Tanggal</label>
                        <input type="date" id="new_date" name="new_date" class="form-control" style="width: 100%;" required>
                      </div>
                    </div>
                    <div class="col-12 col-sm-12">
                      <div class="form-group">
                        <label class="col-form-label">Catatan</label>
                        <input type="text" id="new_note" name="new_note" class="form-control" style="width: 100%;" required>
                      </div>
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
      <div class="modal fade " id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content text-sm">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Edit Penugasan Backup</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit'>
                <input type='hidden' id='edit_id'>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-12 col-sm-12">
                      <hr class="mb-0 mt-0"><center class='text text-muted mt-0'><b>TAD Ditugaskan</b></center>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Customer</label>
                        <select id="edit_customer" name="edit_customer" class="form-control select2bs4" style="width: 100%;" required disabled>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">TAD</label>
                        <select id="edit_employee" name="edit_employee" class="form-control select2bs4" style="width: 100%;" required disabled>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-12">
                      <hr class="mb-0 mt-0"><center class='text text-muted mt-0'><b>Tujuan Backup</b></center>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Customer</label>
                        <select id="edit_customer_destination" name="edit_customer_destination" class="form-control select2bs4" style="width: 100%;" required>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Lokasi</label>
                        <select id="edit_customer_location" name="edit_customer_location" class="form-control select2bs4" style="width: 100%;" required>
                        </select>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Posisi</label>
                        <input type="text" id="edit_position" name="edit_position" class="form-control" style="width: 100%;" required>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label class="col-form-label">Tanggal</label>
                        <input type="date" id="edit_date" name="edit_date" class="form-control" style="width: 100%;" required>
                      </div>
                    </div>
                    <div class="col-12 col-sm-12">
                      <div class="form-group">
                        <label class="col-form-label">Catatan</label>
                        <input type="text" id="edit_note" name="edit_note" class="form-control" style="width: 100%;" required>
                      </div>
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

      <div class="modal fade" id="modal-limit">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Jumlah Baris</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_limit' action=''>
                <div class="modal-body">
                  <div class="form-group ">
                      <select class="form-control text-center" id='limit_rows' name='limit_rows' required>
                        <option value=10>10</option>
                        <option value=25 selected>25</option>
                        <option value=50>50</option>
                        <option value=100>100</option>
                        <option value=0>Semua</option>
                      </select>
                  </div>
                  <p class="text-center">*Memilih semua mungkin membutuhkan waktu lama</p>                   
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
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="del_title">Hapus Penugasan Backup</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <center><h3 id="delete_confirm"></h3></center>
                  <div class="form-group row">
                    <label for="delete_reason" class="col-sm-3 col-form-label">Alasan </label>
                    <div class="col-sm-9">
                      <input class="form-control" id="delete_reason"  name="delete_reason" placeholder="Alasan penghapusan" required>
                    </div>
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
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>

<!-- jquery-validation -->
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
<?=$this->include('option/customer_option');?>
<?=$this->include('option/customer_employee_option');?>
<?=$this->include('option/customer_location_option');?>

<script type="text/javascript">
  $(function () {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    loadDataTable();
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
      return this.optional(element) || value != param.value;
    }, "Harap pilih lainnya")
    ;
    $('#filter_input_div').fadeOut();
    $('#filter_selection_div').fadeOut();
    $('#filter_date_div').fadeOut();
  });

  $("#filter_type").change(function (){
    if($('option:selected', this).attr('type') == 'input'){
      $('#filter_date_div').fadeOut();
      $('#filter_selection_div').fadeOut();
      $('#filter_input_div').fadeIn();
    }else if($('option:selected', this).attr('type') == 'selection'){
      $('#filter_date_div').fadeOut();
      $('#filter_selection_div').fadeIn();
      $('#filter_input_div').fadeOut();
      if($('option:selected', this).val() == 'customer'){
        loadCustomerOption($('#filter_selection'));
      }
    }
    else{
      $('#filter_date_div').fadeIn();
      $('#filter_selection_div').fadeOut();
      $('#filter_input_div').fadeOut();
    }
  })

  $('#form_filter').validate({
      rules: {
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
        table.ajax.reload();
      }
  });

  $("#new_customer").change(function (){
    loadcustomerEmployeeOption($('#new_employee'),$('#new_customer').val());
  });

  $("#new_customer_destination").change(function (){
    loadCustomerLocationOption($('#new_customer_location'),$("#new_customer_destination").val());
  });

  $('#form_new_backup').validate({
      rules: {
          new_customer_destination: 
          { 
            required:true,
            //notEqual: new_customer, 
          },
          new_date: {
            required: true,
            remote: {
              url: "<?=base_url('/assignment/backup/checkifexist')?>",
              type: "post",
              data: {
                employee_id: function() {
                  return $( "#new_employee" ).val();
                },
                date: function() {
                  return $( "#new_date" ).val();
                }
              },
              /*success: function(reply){
                $("#<?= csrf_token()?>").val(reply.new_csrf);
                if(reply.exist === true){
                  //toastr.error('sudah ada');
                  return false;
                }else{
                  return true;
                }
              },
              error: function(xhr, textStatus, errorThrown)
              {
                  alert('ajax loading error... ... '+url + query);
                  return false;
              },*/
            }
          } 
      },
      messages: {
        new_date: {
          remote: "Sudah ada backup",
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
      },
      submitHandler:function(event){
        var form_data = new FormData();
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
        form_data.append('employee_id',$('#new_employee').val());
        form_data.append('customer',$('#new_customer_destination').val());
        form_data.append('customer_location',$('#new_customer_location').val());
        form_data.append('position',$('#new_position').val());
        form_data.append('date',$('#new_date').val());
        form_data.append('note',$('#new_note').val());
        let url="<?=base_url('/assignment/backup/new/submit')?>";
        var request = $.ajax({
          method: "POST",
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: form_data,
          dataType: 'json',
        });
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            table.ajax.reload();
            $('#form_new_backup')[0].reset();
            $('#modal-new').modal('hide');
            toastr.success('Berhasil menambahkan penugasan backup');
          }else{
            toastr.error('Gagal menambahkan penugasan backup');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
          toastr.error( "Request failed: " + textStatus );
        });
      }
  });

  $("#edit_customer_destination").change(function (){
    loadCustomerLocationOption($('#edit_customer_location'),$("#edit_customer_destination").val());
  });

  $('#form_edit').validate({
      rules: {
          edit_customer_destination: 
          { 
            required:true,
            //notEqual: edit_customer, 
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
      },
      submitHandler:function(event){
        var form_data = new FormData();
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
        form_data.append('id',$('#edit_id').val());
        form_data.append('customer',$('#edit_customer_destination').val());
        form_data.append('customer_location',$('#edit_customer_location').val());
        form_data.append('position',$('#edit_position').val());
        form_data.append('date',$('#edit_date').val());
        form_data.append('note',$('#edit_note').val());
        let url="<?=base_url('/assignment/backup/edit/submit')?>";
        var request = $.ajax({
          method: "POST",
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: form_data,
          dataType: 'json',
        });
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            table.ajax.reload();
            $('#form_edit')[0].reset();
            $('#modal-edit').modal('hide');
            toastr.success('Perubahan berhasil disimpan');
          }else{
            toastr.error('Perubahan gagal disimpan');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
          toastr.error( "Request failed: " + textStatus );
        });
      }
  });

  $('#form_delete').validate({
      rules: {
          edit_id: 
          { 
            required:true,
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
      },
      submitHandler:function(event){
        var form_data = new FormData();
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
        form_data.append('id',$('#delete_id').val());
        form_data.append('reason',$('#delete_reason').val());
        let url="<?=base_url('/assignment/backup/delete/submit')?>";
        var request = $.ajax({
          method: "POST",
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: form_data,
          dataType: 'json',
        });
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            table.ajax.reload();
            $('#form_delete')[0].reset();
            $('#modal-delete').modal('hide');
            toastr.success('Penugasan berhasil dihapus');
          }else{
            toastr.error('Penugasan gagal dihapus');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
          toastr.error( "Request failed: " + textStatus );
        });
      }
  });

  var table;
  
  function loadDataTable(){
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
        url:"<?=base_url('korlap/assignment/backup/datatable')?>",
        type:"post",
        data:{"<?= csrf_token()?>":$("#<?= csrf_token()?>").val(),
              filter_type : function() { return $('#filter_type').val(); },
              filter_input : function() { return $('#filter_input').val(); },
              filter_selection : function() { return $('#filter_selection').val(); },
              filter_date : function() { return $('#filter_date').val(); },
              limit: function() { return $('#limit_rows').val(); },
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                $('#limit_txt').text($('#limit_rows').val());
                $('#modal-limit').modal('hide');
                return json.data;
        },
        "destroy" : true,
      },
    columns: [
        { data: null,type:'text',title:'NIP',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
          return row.nip;
          }
        },
        { data: 'employee',type:'text',title:'Nama',className: 'dt-head-center dt-body-center'},
        { data: 'customer',type:'text',title:'Customer',className: 'dt-head-center dt-body-center'},
        { data: 'customer_location',type:'text',title:'Lokasi',className: 'dt-head-center dt-body-center'},
        { data: 'position',type:'text',title:'Posisi',className: 'dt-head-center dt-body-center'},
        { data: 'date',type:'text',title:'Tanggal',className: 'dt-head-center dt-body-center'},
        { data: 'note',type:'text',title:'Catatan',className: 'dt-head-center dt-body-center'},
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [
                {
                  text: 'Limit (<span id="limit_txt"></span>)',
                  className: 'btn btn-info btn-sm',
                  action: function (e, dt, node, config) {
                    $('#modal-limit').modal('show');
                  }
                },
                ],
    });
    table.on('click', '#view', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        viewSlip(data);
    });
    table.on('click', '#pdf', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        window.location = "<?= base_url('/payslip/download/pdf/')?>"+data['id'];
    });
    table.on('click', '#edit', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        $('#edit_id').val(data['id']);
        toastr.info('Memuat data');
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        var form_data = new FormData();
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
        form_data.append('id',data['id']);
        let url="<?=base_url('/assignment/backup/data')?>";
        var request = $.ajax({
          method: "POST",
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: form_data,
          dataType: 'json',
        });
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            loadCustomerOption($('#edit_customer'));
            $('#edit_customer').val(reply.data.emp_customer);
            loadcustomerEmployeeOption($('#edit_employee'),$('#edit_customer').val());
            $('#edit_employee').val(reply.data.employee_seq);
            loadCustomerOption($('#edit_customer_destination'));
            $('#edit_customer_destination').val(reply.data.customer_seq);
            loadCustomerLocationOption($('#edit_customer_location'),$("#edit_customer_destination").val());
            $('#edit_customer_location').val(reply.data.customer_location_seq);
            $('#edit_position').val(reply.data.position);
            $('#edit_date').val(reply.data.date);
            $('#edit_note').val(reply.data.note);
            $('#modal-edit').modal('show');
          }else{
            
          }
        });
        request.fail(function( jqXHR, textStatus ) {
          toastr.error( "Request failed: " + textStatus );
        });
    });
    table.on('click', '#delete', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        $('#delete_id').val(data['id']);
        $('#delete_confirm').text('Hapus penugasan '+data['employee']+' pada '+data['date']+'?')
        $('#modal-delete').modal('show');
    });
    table.on('click', '#email', function (e) {
        toastr.info('Mengirim email ...');
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        var form_data = new FormData();
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
        form_data.append('id',data['id']);
        let url="<?=base_url('/payslip/send_email')?>";
        var request = $.ajax({
          method: "POST",
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: form_data,
          dataType: 'json',
        });
        request.done(function( reply ) {
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1 ){
            toastr.success('Email berhasil dikirim ke '+reply['email']);
          }else{
            toastr.error('Gagal mengirim email ke '+reply['email']);
          }
        });
        request.fail(function( jqXHR, textStatus ) {
          toastr.error( "Request failed: " + textStatus );
        });
    });
  }
</script>

</body>
</html>
