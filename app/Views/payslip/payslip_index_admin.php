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
    <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
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
            <h1><?=session()->get('title');?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Slip Gaji</li>
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
                          <option value="position" type='input'>Jabatan</option>
                          <option value="period" type='month'>Periode</option>
                          <option value="customer" type='selection'>Customer</option>
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
                    <div class="col-sm-4" id='filter_month_div'>
                      <div class="form-group">
                        <label for="filter_selection">Pilih</label>
                        <input type='month' class="form-control" id="filter_month" name="filter_month">
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
                <table id="data_table" style="width:100%" class="table table-sm table-bordered table-striped">
                  
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
      <div class="modal fade" id="modal-new-slip">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Input Slip Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new_slip' action=''>
                <div class="modal-body">
                  <center class='text text-muted mt-0'><b>TAD</b></center>
                  <div class="row">
                    <div class="form-group col-12 col-sm-4">
                      <label for="new_customer" class="col-form-label">Customer</label>
                      <select class="form-control select2bs4" id='new_customer' name='new_customer' required>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-4">
                      <label for="new_employee" class="col-form-label">Tenaga Alih Daya</label>
                      <select class="form-control select2bs4" id='new_employee' name='new_employee' required>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-4">
                      <label for="new_period" class="col-form-label">Periode Slip</label>
                      <input type="month" id="new_period" name="new_period" class="form-control" placeholder="" min='<?=substr($min_date, 0, -3 )?>' required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <hr class="mb-0"><center class='text text-muted mt-0'><b>Penghasilan</b></center>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_gaji_pokok">Gaji Pokok</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_gaji_pokok" name="new_gaji_pokok" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="new_transport">Transport</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_transport" name="new_transport" class="form-control currency"required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="new_insentif">Insentif</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_insentif" name="new_insentif" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="new_kelebihan_hari">Insentif (Kelebihan Hari)</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_kelebihan_hari" name="new_kelebihan_hari" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="new_lembur">Insentif (Lembur)</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_lembur" name="new_lembur" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="new_shift">Tunjangan Shift</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_shift" name="new_shift" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="new_dinas_luar">Dinas Luar</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_dinas_luar" name="new_dinas_luar" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="new_kelebihan_m-1">Kelebihan Hari (M-1)</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_kelebihan_hari_m-1" name="new_kelebihan_hari_m-1" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <hr class="mb-0"><center class='text text-muted mt-0'><b>Potongan</b></center>
                      <div class="form-group row">
                          <label class="col-12 col-sm-4" for="new_bpjs_tk">BPJS Ketenagakerjaan</label>
                          <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_bpjs_tk" name="new_bpjs_tk" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_bpjs_kes">BPJS Kesehatan</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_bpjs_kes" name="new_bpjs_kes" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_bpjs_ht">BPJS Hari Tua</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_bpjs_ht" name="new_bpjs_ht" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_pph_21">PPH 21</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_pph_21" name="new_pph_21" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_absensi">Absensi</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_absensi" name="new_absensi" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_payroll">Payroll</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_payroll" name="new_payroll" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_mcu">MCU</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_mcu" name="new_mcu" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="new_pinjaman">Pinjaman (SPH)</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="new_pinjaman" name="new_pinjaman" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="new_send_email" checked>
                        <label for="new_send_email" class="custom-control-label">Send email </label>
                      </div>
                    </div>
                  </div>
                  

                </div>

                <input type="hidden" id="csrf" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />  
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

      <?=$this->include('payslip/modal_payslip_edit');?>
      <?=$this->include('payslip/modal_payslip_view');?>

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
              <h4 class="del_title">Hapus Slip</h4>
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
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
<?=$this->include('option/customer_option');?>
<?=$this->include('option/customer_employee_option');?>
<!-- Page specific script -->
<script>
  var table;
  var limit_rows = $('#limit_rows').val();
  $(function () {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    loadTable();

    $('#form_new_slip').on('submit',function(e){
      e.preventDefault();
      submitNewForm();
    });
    $('#filter_input_div').fadeOut();
    $('#filter_selection_div').fadeOut();
    $('#filter_month_div').fadeOut();
  });

  $("#filter_type").change(function (){
    $('#filter_selection').val('');
    $('#filter_input').val('');
    $('#filter_month').val('');
    if($('option:selected', this).attr('type') == 'input'){
      $('#filter_selection_div').fadeOut();
      $('#filter_input_div').fadeIn();
      $('#filter_month_div').fadeOut();
    }else if($('option:selected', this).attr('type') == 'selection'){
      $('#filter_input_div').fadeOut();
      $('#filter_selection_div').fadeIn();
      $('#filter_month_div').fadeOut();
      if($('option:selected', this).val() == 'customer'){
        loadCustomerOption($('#filter_selection'));
      }
    }else if($('option:selected', this).attr('type') == 'month'){
      $('#filter_input_div').fadeOut();
      $('#filter_selection_div').fadeOut();
      $('#filter_month_div').fadeIn();
    }
  });

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

  function resetFilter(){
    $('#form_filter')[0].reset();
    table.ajax.reload();
  }

  $('#form_new_slip').validate({
    rules: {
    
    },
    messages:{
      
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
    submitHandler: function () {
      var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('employee_id',$('#new_employee').val());
      form_data.append('period',$('#new_period').val());
      form_data.append('gaji_pokok',$('#new_gaji_pokok').val());
      form_data.append('transport',$('#new_transport').val());
      form_data.append('insentif',$('#new_insentif').val());
      form_data.append('kelebihan_hari',$('#new_kelebihan_hari').val());
      form_data.append('lembur',$('#new_lembur').val());
      form_data.append('shift',$('#new_shift').val());
      form_data.append('dinas_luar',$('#new_dinas_luar').val());
      form_data.append('kelebihan_hari_m-1',$('#new_kelebihan_hari_m-1').val());
      form_data.append('bpjs_tk',$('#new_bpjs_tk').val());
      form_data.append('bpjs_kes',$('#new_bpjs_kes').val());
      form_data.append('bpjs_ht',$('#new_bpjs_ht').val());
      form_data.append('pph_21',$('#new_pph_21').val());
      form_data.append('absensi',$('#new_absensi').val());
      form_data.append('payroll',$('#new_payroll').val());
      form_data.append('mcu',$('#new_mcu').val());
      form_data.append('pinjaman',$('#new_pinjaman').val());
      form_data.append('send_email',$('#new_send_email').prop('checked') ? 1 :0);

      let url="<?=base_url('/payslip/new/submit')?>";
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
          toastr.success('Slip gaji berhasil diinput');
          if(reply['email'] == 1){
            toastr.success('Email berhasil dikirim');
          }else{
            toastr.success('Email gagal dikirim');
          }
          table.ajax.reload();
          $('#form_new_slip')[0].reset();
          $('#modal-new-slip').modal('hide');
        }else{
          toastr.error('Gagal menyimpan data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  $("#new_customer").change(function (){
    console.log('changed');
    loadcustomerEmployeeOption($('#new_employee'),$('#new_customer').val());
  });

  $("#new_period").change(function (){
    var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('employee_id',$('#new_employee').val());
      form_data.append('period',$('#new_period').val());

      let url="<?=base_url('/payslip/checkifexist')?>";
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
        if(reply['exist'] == 1 ){
          toastr.error('Slip TAD periode tersebut sudah diinput');
          $('#new_period').val('');
        }else{
          //toastr.error('Gagal menyimpan data'); do nothing
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
  });

  $('#form_edit_slip').validate({
    rules: {
    
    },
    messages:{
      
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
    submitHandler: function () {
      var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#edit_id').val())
      form_data.append('gaji_pokok',$('#edit_gaji_pokok').val());
      form_data.append('transport',$('#edit_transport').val());
      form_data.append('insentif',$('#edit_insentif').val());
      form_data.append('kelebihan_hari',$('#edit_kelebihan_hari').val());
      form_data.append('lembur',$('#edit_lembur').val());
      form_data.append('shift',$('#edit_shift').val());
      form_data.append('dinas_luar',$('#edit_dinas_luar').val());
      form_data.append('kelebihan_hari_m-1',$('#edit_kelebihan_hari_m-1').val());
      form_data.append('bpjs_tk',$('#edit_bpjs_tk').val());
      form_data.append('bpjs_kes',$('#edit_bpjs_kes').val());
      form_data.append('bpjs_ht',$('#edit_bpjs_ht').val());
      form_data.append('pph_21',$('#edit_pph_21').val());
      form_data.append('absensi',$('#edit_absensi').val());
      form_data.append('payroll',$('#edit_payroll').val());
      form_data.append('mcu',$('#edit_mcu').val());
      form_data.append('pinjaman',$('#edit_pinjaman').val());

      let url="<?=base_url('/payslip/edit/submit')?>";
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
          toastr.success('Slip gaji berhasil diupdate');
          //table.ajax.reload();
          $('#form_edit_slip')[0].reset();
          $('#modal-edit-slip').modal('hide');
        }else{
          toastr.error('Gagal menyimpan data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  $('#form_delete').validate({
    rules: {
      delete_id: {
        required: true,
      },
      delete_reason: {
        required: true,
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
    },
    submitHandler: function () {
      var form_data = new FormData();
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('id',$('#delete_id').val());
      form_data.append('reason',$('#delete_reason').val());
      let url="<?=base_url('/payslip/delete/submit')?>";
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
          toastr.success('Data berhasil dihapus');
          table.ajax.reload();
          $('#form_delete')[0].reset();
          $('#modal-delete').modal('hide');
        }else{
          toastr.error('Gagal menghapus data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  function loadTable(){
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
        url:"<?=base_url('/payslip/datatable')?>",
        type:"post",
        data:{"<?= csrf_token()?>":$("#<?= csrf_token()?>").val(),
              filter_type : function() { return $('#filter_type').val(); },
              filter_input : function() { return $('#filter_input').val(); },
              filter_selection : function() { return $('#filter_selection').val(); },
              filter_month : function() { return $('#filter_month').val(); },
              limit: function() { return $('#limit_rows').val(); },
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                $('#limit_txt').text(limit_rows);
                $('#modal-limit').modal('hide');
                return json.data;
        },
        "destroy" : true,
      },
    columns: [
        { data: 'nip',type:'text',title:'NIP',className: 'dt-body-center dt-head-center'},
        { data: 'name',type:'text',title:'Nama',className: 'dt-head-center dt-body-center'},
        { data: 'period_text',type:'text',title:'Periode Slip',className: 'dt-head-center dt-body-center'},
        { data: 'position',type:'text',title:'Posisi/Jabatan',className: 'dt-head-center dt-body-center'},
        { data: 'customer_name',type:'text',title:'Customer',className: 'dt-head-center dt-body-center'},
        { data: 'customer_location_name',type:'text',title:'Lokasi',className: 'dt-head-center dt-body-center'},
        {data: 'period',
          render : function ( data, type, row ) {
              if (row.period < '<?=substr($min_date, 0, -3 )?>'){
                  return '<div class="btn-group"><button type="button" id="view" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>Lihat</button><button type="button" id="pdf" class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i>PDF</button><button type="button" title="kirim email" id="email" class="btn btn-secondary btn-xs"><i class="fas fa-at" aria-hidden="true"></i>Email</button><button type="button" id="edit" class="btn btn-warning btn-xs" disabled><i class="far fa-edit"></i>Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i>Hapus</button></div>';
              } else {
                  return '<div class="btn-group"><button type="button" id="view" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>Lihat</button><button type="button" id="pdf" class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i>PDF</button><button type="button" title="kirim email" id="email" class="btn btn-secondary btn-xs"><i class="fas fa-at" aria-hidden="true"></i>Email</button><button type="button" id="edit" class="btn btn-warning btn-xs"><i class="far fa-edit"></i>Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i>Hapus</button></div>';
              }
          },className: 'dt-body-center dt-head-center align-middle',targets: -1,
        },
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{
                    text: '<i class="fas fa-plus"></i> Buat Slip Baru',
                    className: 'btn-success btn-sm',
                    action: function (e, dt, node, config) {
                      loadCustomerOption($('#new_customer'));
                      $('#modal-new-slip').modal('show');
                    }
                },
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
        showModalEdit(data);
    });
    table.on('click', '#delete', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        $('#delete_id').val(data['id']);
        $('#delete_confirm').text('Hapus slip '+data['nip']+' '+data['period_text']+'?')
        $('#modal-delete').modal('show');
    });
    table.on('click', '#email', function (e) {
        
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
          async: true,
          cache: false,
          timeout: 30000,
          url: url,
          data: form_data,
          dataType: 'json',
          beforeSend: function() {
              toastr.info('Mengirim email ...');
           },
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
