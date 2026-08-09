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
    <!-- Select2 -->
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
            <h1><?=session()->get('title')?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calon TAD Diterima</li>
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
            <form id="form_filter">
            <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Pencarian</h3>
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
                  <div class="col-sm-3">
                    <div class="form-group">
                      <select class="form-control" id="filter_type" name="filter_type">
                        <option value=0 selected disabled>Tanpa Filter</option>
                        <option value="name">Nama</option>
                        <option value="position">Posisi</option>
                        <option value="sim">SIM</option>
                        <option value="education">Pendidikan Terakhir</option>
                        <option value="notes">Catatan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <input class="form-control" id="filter_key" name="filter_key" disabled>
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
                <table id="data_table" class="table table-bordered table-striped table-sm">
                
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
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-success">
              <h4 class="modal-title">Input Calon TAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new'>
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="new_name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="new_name" name="new_name" placeholder="Nama Lengkap" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_ktp" class="col-sm-3 col-form-label">Foto KTP</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="new_ktp" name="new_ktp" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="new_ktp" id='new_ktp_label'>Foto KTP</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_pas_photo" class="col-sm-3 col-form-label">Pas Photo</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="new_pas_foto" name="new_pas_foto" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="new_pas_foto_label" id='new_pas_foto_label'>Pas Photo</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_phone" class="col-sm-3 col-form-label">Telepon/WA</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="new_phone" name="new_phone" placeholder="Telepon/WA" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_position" class="col-sm-3 col-form-label">Posisi</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="new_position" name="new_position" placeholder="Posisi Dilamar" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_sim" class="col-sm-3 col-form-label">SIM</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='new_sim' name='new_sim' placeholder='SIM' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_sim_photo" class="col-sm-3 col-form-label">Foto SIM</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="new_sim_foto" name="new_sim_foto" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="new_sim_foto" id='new_sim_foto_label'>Foto SIM</label>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="new_education" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                      <div class="col-sm-9">
                        <input class="form-control" id="new_education"  name="new_education" placeholder="Pendidikan" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="new_note" class="col-sm-3 col-form-label">Catatan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="new_note"  name="new_note" placeholder="Catatan" required></textarea>
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
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Edit Calon TAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit'>
              <input type="hidden" name="edit_id" id="edit_id">
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="edit_name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Nama Lengkap" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_phone" class="col-sm-3 col-form-label">Telepon/WA</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_phone" name="edit_phone" placeholder="Telepon/WA" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_position" class="col-sm-3 col-form-label">Posisi</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="edit_position" name="edit_position" placeholder="Posisi Dilamar" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_sim" class="col-sm-3 col-form-label">SIM</label>
                      <div class="col-sm-9">
                        <input class="form-control" id='edit_sim' name='edit_sim' placeholder='SIM' required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="edit_education" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                      <div class="col-sm-9">
                        <input class="form-control" id="edit_education"  name="edit_education" placeholder="Pendidikan" required>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label for="edit_note" class="col-sm-3 col-form-label">Catatan</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="edit_note"  name="edit_note" placeholder="Catatan" required></textarea>
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
      <div class="modal fade " id="modal-change-ktp">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Ganti Gambar KTP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_change_ktp'>
              <input type="hidden" id="change_id">
                <div class="modal-body">
                    <div class="form-group row">
                      <label for="new_ktp" class="col-sm-3 col-form-label">Foto KTP</label>
                      <div class="col-sm-9">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="change_ktp_file" name="change_ktp_file" accept=".jpg,.png,.jpeg">
                              <label class="custom-file-label" for="new_ktp" id='change_ktp_label'>Foto KTP</label>
                            </div>
                          </div>
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
              <h4 class="del_title">Hapus Calon TAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <center><h3 id="delete_confirm"></h3></center>
                  <div class="form-group row">
                    <label for="new_education" class="col-sm-3 col-form-label">Alasan </label>
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

      <div class="modal fade" id="modal-import">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <h4 class="del_title">Import Data Lamaran</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_import' action=''>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="import_file" name="import_file" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                        <label class="custom-file-label" for="exampleInputFile"><i class="fas fa-file-excel"></i> <span id="file_placeholder">Choose file</span></label>
                      </div>
                      <div class="input-group-append">
                        <a href="<?=base_url('upload/system/import_lamaran.xlsx')?>" type="button" class="btn btn-info"><i class="fas fa-download"></i> Download Template</a>
                      </div>
                    </div>
                  </div>
                  <p>*pastikan preview sesuai sebelum menyimpan data</p>
                  <table id="import_preview_table" class="table table-bordered table-striped table-sm">
                
                </table>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <div class="btn-group"><button type="button" onclick="loadPreview()" class="btn btn-info float-right"><i class="far fa-eye"></i> Preview</button><button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button></div>
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
<?=$this->include('jquery_option');?>


<!-- Page specific script -->
<script>
  var table;
  var import_preview_table;
  var limit_rows = $('#limit_rows').val();
  $(function () {
    $(document).keydown(function(event) { 
      if (event.keyCode == 27) { 
        $('.modal').modal('hide');
      }
    });
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    loadTableData();
 });

  $("#new_ktp").change(function (){
     var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
     //alert(fileName);
     $('#new_ktp_label').text(fileName);
  });

  $("#new_pas_foto").change(function (){
     var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
     //alert(fileName);
     $('#new_pas_foto_label').text(fileName);
  });

  $("#new_sim_foto").change(function (){
     var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
     //alert(fileName);
     $('#new_sim_foto_label').text(fileName);
  });

  $('#form_new').validate({
    rules: {
      new_name: {
        required: true,
      },
      new_ktp: {
        required: true,
        accept: "image/*",
        fileSizeLimit: 1024000,
      },
      new_pas_foto: {
        required: true,
        accept: "image/*",
        fileSizeLimit: 1024000,
      },
      new_sim_foto: {
        required: true,
        accept: "image/*",
        fileSizeLimit: 1024000,
      },
      new_phone: {
        required: true,
        digits:true,
      },
      new_position: {
        required: true,
      },
      new_sim: {
        required: true,
      },
      new_education: {
        required: true,
      },
      new_note: {
        required: true,
      },
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
      var file_ktp = $('#new_ktp')[0].files;
      var file_pas = $('#new_pas_foto')[0].files;
      var file_sim = $('#new_sim_foto')[0].files;
      var form_data = new FormData();
      form_data.append('file_ktp',file_ktp[0]);
      form_data.append('file_pas',file_pas[0]);
      form_data.append('file_sim',file_sim[0]);
      form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
      form_data.append('name',$('#new_name').val());
      form_data.append('phone',$('#new_phone').val());
      form_data.append('position',$('#new_position').val());
      form_data.append('sim',$('#new_sim').val());
      form_data.append('education',$('#new_education').val());
      form_data.append('note',$('#new_note').val());
      let url="<?=base_url('/candidate/new/submit')?>";
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
          toastr.success('Calon TAD berhasil disimpan');
          table.ajax.reload();
          $('#form_new')[0].reset();
          $('#modal-new').modal('hide');
        }else{
          toastr.error('Gagal menyimpan data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  jQuery.validator.addMethod('fileSizeLimit', function(value, element, limit) {
      console.log(element.files[0].size);
      return !element.files[0] || (element.files[0].size <= limit);
  }, 'File is too big max 1 mb');

  function showModalEdit(data){
    $('#modal-edit').modal('show');
    $('#edit_id').val(data.id);
    $('#edit_name').val(data.name);
    $('#edit_phone').val(data.phone);
    $('#edit_sim').val(data.sim);
    $('#edit_position').val(data.position);
    $('#edit_education').val(data.education);
    $('#edit_note').val(data.notes);
  }

  $('#form_edit').validate({
    rules: {
      edit_name: {
        required: true,
      },
      edit_phone: {
        required: true,
        digits:true,
      },
      edit_position: {
        required: true,
      },
      edit_sim: {
        required: true,
      },
      edit_education: {
        required: true,
      },
      edit_note: {
        required: true,
      },
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
      form_data.append('id',$('#edit_id').val());
      form_data.append('name',$('#edit_name').val());
      form_data.append('phone',$('#edit_phone').val());
      form_data.append('position',$('#edit_position').val());
      form_data.append('sim',$('#edit_sim').val());
      form_data.append('education',$('#edit_education').val());
      form_data.append('note',$('#edit_note').val());
      let url="<?=base_url('/candidate/edit/submit')?>";
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
          toastr.success('Perubahan berhasil disimpan');
          table.ajax.reload();
          $('#form_edit')[0].reset();
          $('#modal-edit').modal('hide');
        }else{
          toastr.error('Gagal menyimpan data');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
    }
  });

  $("#change_ktp_file").change(function (){
     var fileName = $(this).val().replace(/C:\\fakepath\\/i, '');
     //alert(fileName);
     $('#change_ktp_label').text(fileName);
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
      let url="<?=base_url('/candidate/delete/submit')?>";
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

  $("#filter_type").change(function (){
      if($(this).val() != 0){
         $("#filter_key").prop('disabled', false);
      }else{
        $("#filter_key").prop('disabled', true);
      }
  });

  $('#form_filter').validate({
    rules: {
      filter_type: {
        required: true,
      },
      filter_key: {
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
      toastr.info('Memuat pencarian');
      table.ajax.reload();
    }
  });

  $('#form_limit').validate({
    rules: {
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
      toastr.info('Memuat max '+$('#limit_rows').val()+' data');
      table.ajax.reload();
    }
  });

  $('#form_import').validate({
      rules: {
        import_file: {
          required: true,
        },
      },
      messages: {
        import_file: {
          required: "Harap pilih file",
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
        submitImport();
      }
  });
  function submitImport(){
    var files = $('#import_file')[0].files;
    // Create an FormData object 
    var form_data = new FormData();
    form_data.append('import_file',files[0]);
    form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
    form_data.append('id',$('#change_id').val());
    var request = $.ajax({
          url: '<?=base_url('/job_application/import/submit')?>',
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
        $('#form_import')[0].reset();
        if($.fn.DataTable.isDataTable('#import_preview_table')) {
            $('#import_preview_table').DataTable().clear().destroy();
        }
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        $('#modal-import').modal('hide');
        table.ajax.reload();
        alert('Sukses :'+reply['total_imported']+' lamaran berhasil diimport');
      });
      request.fail(function(){
        alert('request failed');
      });
  }
  function loadPreview(){
    if($.fn.DataTable.isDataTable('#import_preview_table')) {
        $('#import_preview_table').DataTable().clear().destroy();
    }
    var files = $('#import_file')[0].files;
    // Create an FormData object 
    var form_data = new FormData();
    form_data.append('import_file',files[0]);
    form_data.append([<?=csrf_token()?>],$('#<?=csrf_token()?>').val());
    
    var request = $.ajax({
          url: '<?=base_url('/job_application/import/preview')?>',
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
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        import_preview_table = $('#import_preview_table').DataTable({
          columnDefs: [{ visible: false, targets: [5] }], 
          dom: '<"container-fluid"<"row"<"col"l>>>rt<"row"<"col"i><"col"p>>',
          data: reply.data,
          columns: [
            { data: null,type:'text',title:'Nama',className:'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              return '<a href="<?=base_url()?>candidate/'+row.id+'">'+row.name+'</a>';
              }
            },
           
            { data: 'position_name',type:'text',title:'Posisi',defaultContent: row.position_manual},
            { data: 'join_date_manual',type:'text',title:'Join Date'},
            { data: 'ttl_manual',type:'text',title:'Tempat, Tanggal lahir'},            
            { data: 'resident_id',type:'text',title:'NIK'},
            { data: 'address',type:'text',title:'Alamat'},
            { data: 'phone',type:'text',title:'Telepon'},
            { data: 'working_unit_manual',type:'text',title:'Customer/Unit Kerja'},
            { data: 'education_manual',type:'text',title:'Pendidikan'},
            { data: 'entry_date_manual',type:'text',title:'Entry date'},
            { data: 'sim_manual',type:'text',title:'SIM'},
            { data: 'bpjs_tk',type:'text',title:'BPJS Ket'},
            { data: 'tax_number',type:'text',title:'NPWP'},
            { data: 'spk',type:'text',title:'SPK'},
            {data: null,
            defaultContent: '<div class="btn-group"><button type="button" id="lihat" class="btn btn-info btn-xs"><i class="far fa-eye"></i> Lihat</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</button></div>',
            targets: -1,className: 'dt-body-center'},         
        ], 
          responsive: true,
          lengthChange: false, 
          autoWidth: false,
          buttons: [],
        });
      });
      request.fail(function(){
        alert('request failed');
      });
  }
  $('#import_file').bind( "change", function() {
      var filename = $('#import_file').val().replace(/C:\\fakepath\\/i, '');
      console.log(filename+' ('+(Math.round(this.files[0].size) / 1000)+' kb)');
      $("#file_placeholder").text(filename+' ('+(Math.round(this.files[0].size) / 1000)+' kb)');
  });
  function showModalImport() {
    $('#modal-import').modal('show');
    // body...
  }

  function loadTableData(){
    table = $("#data_table").DataTable({
      columnDefs: [{ visible: false, targets: [] }], 
     dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      order: [[3, 'desc']],
      ajax:{
        url:"<?=base_url('/candidate/datatable')?>",
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              is_accepted:1,
              limit: function() { return $('#limit_rows').val(); },
              filter_type: function() { return $('#filter_type').val(); },
              filter_key: function() { return $('#filter_key').val(); },
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
        { data: null,type:'text',title:'Nama',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
              return '<img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>'+row.foto_pas_path+''+row.foto_pas+'" alt="Pas Foto"> <a href="<?=base_url()?>candidate/'+row.id+'">'+row.name+'</a> <div class="btn-group"><button type="button" id="edit" title="Edit" class="btn btn-primary btn-xs"><i class="far fa-edit"></i></button><button type="button" id="delete" title="Hapus" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button></div>';
              }
            },
        { data: 'phone',type:'text',title:'Telepon',className:'dt-body-center dt-head-center align-middle',render: function (data, type, row, meta) {
                  return data+' <a href="https://wa.me/' + data.replace("0", "62") + '" target="_blank"><i class="fab fa-whatsapp"></i></a>';
          }},
        { data: 'position',type:'text',title:'Posisi',className:'dt-body-center dt-head-center align-middle'},
        { data: 'customer',type:'text',title:'Customer',className:'dt-body-center dt-head-center align-middle'},
        { data: 'customer_location',type:'text',title:'Lokasi',className:'dt-body-center dt-head-center align-middle'},
        { data: 'join_date',type:'text',title:'Tanggal Bergabung',className:'dt-body-center dt-head-center align-middle'},
        { data: 'sim',type:'text',title:'SIM',className:'dt-body-center dt-head-center align-middle'},
        { data: 'education',type:'text',title:'Pendidikan Terakhir',className:'dt-body-center dt-head-center align-middle'},
        { data: 'notes',type:'text',title:'Catatan',className:'dt-body-center dt-head-center align-middle'},    
    ], 
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{extend :"colvis", className : 'btn btn-warning btn-sm'},
                {extend :"excel", className : 'btn btn-primary btn-sm'},
                {
                    text: '<i class="fas fa-plus"></i> New',
                    className: 'btn btn-success btn-sm',
                    action: function (e, dt, node, config) {
                      $('#modal-new').modal('show');
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

    table.on('click', '#edit ', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        showModalEdit(data);
    });
    table.on('click', '#delete ', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        $('#delete_confirm').text('Hapus Calon TAD '+data.name+'?');
        $('#delete_id').val(data.id);
        $('#modal-delete').modal('show');
    });
  }

</script>
</body>
</html>
