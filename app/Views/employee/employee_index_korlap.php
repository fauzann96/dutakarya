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
            <h1><?=session()->get('title')?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
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
             <form id="form_search">
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
                        <option value="spk" type='input'>SPK</option>
                        <option value="pkwt" type='input'>PKWT</option>
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
                </div>
                <p class="text-muted mb-0">*data diimport mungkin tidak terfilter</p>
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
                <table id="employee_table" style="width:100%" class="table table-sm display compact table-bordered table-striped">
                  
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

      <div class="modal fade" id="modal-import">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <h4 class="del_title">Import Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_import' action=''>
                <div class="modal-body row">
                  <div class="form-group col-sm-6">
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
                  <div class="form-group col-sm-6">
                      <label for="import_wu">Unit Kerja/Customer Karyawan Diimport</label>
                      <select class="form-control select2bs4" id='import_wu' name='import_wu' required></select>
                  </div>
                  <p class="text-muted">*divisi dan posisi perlu disesuaikan setelah import</p>
                  <div class="col-12">
                    <table id="import_preview_table" class="table table-bordered table-striped table-sm">        
                  </table>
                  </div>
                  
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <div class="btn-group"><button type="button" onclick="loadPreview()" class="btn btn-warning float-right"><i class="far fa-eye"></i> Preview</button><button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button></div>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

                  <!-- modal -->
      <div class="modal fade " id="modal-new">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-success">
              <h4 class="modal-title">TAD Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new'>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="new_candidate" class="col-sm-3 col-form-label">Data Calon TAD</label>
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="new_candidate" name="new_candidate" placeholder="Calon TAD" required></select>
                    </div>
                    <div class="col-12 mt-1 col-sm-3 text-center">
                      <img id='new_candidate_image' class="img-thumbnail" style="opacity: 1;width:80%" src="<?=base_url()?>" alt="Pas Foto">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_name" class="col-sm-3 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_name" name="new_name" placeholder="Nama Lengkap" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_gender" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-9">
                      <select type="text" class="form-control" id="new_gender" name="new_gender" placeholder="Laki-laki/Perempuan" required></select>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row">
                    <label for="new_nip" class="col-sm-3 col-form-label">NIP</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="new_nip" name="new_nip" placeholder="Nomor Induk Pegawai" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_spk" class="col-sm-3 col-form-label">No SPK</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="new_spk" name="new_spk" placeholder="Nomor SPK" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_pkwt" class="col-sm-3 col-form-label">No PKWT</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="new_pkwt" name="new_pkwt" placeholder="Nomor PKWT" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_customer" class="col-sm-3 col-form-label">Customer</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="new_customer" name="new_customer" placeholder="Nama Lengkap" required></select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_location" class="col-sm-3 col-form-label">Lokasi Customer</label>
                    <div class="col-sm-9">
                      <select class="form-control" id="new_location" name="new_location" placeholder="Pilih lokasi" required></select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_location" class="col-sm-3 col-form-label">Jabatan/Posisi</label>
                    <div class="col-sm-9">
                      <input class="form-control" id="new_position" name="new_position" placeholder="Jabatan/Posisi" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_sim" class="col-sm-3 col-form-label">SIM</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_sim" name="new_sim" placeholder="Surat Ijin Mengemudi" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_education" class="col-sm-3 col-form-label">Pendidikan Terakhir</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_education" name="new_education" placeholder="Pendidikan Terakhir" required>
                    </div>
                  </div>
                  <hr class="mb-0"><center class='text text-muted mt-0'><b>Keuangan</b></center>
                  <div class="form-group row">
                    <label for="new_bank_acc" class="col-sm-3 col-form-label">Nomor Rekening</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_bank_acc" name="new_bank_acc" placeholder="Nomor Rekening" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_bpjs_kes" class="col-sm-3 col-form-label">BPJS Kesehatan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_bpjs_kes" name="new_bpjs_kes" placeholder="BPJS Kesehatan" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_bpjs_tk" class="col-sm-3 col-form-label">BPJS Ketenagakerjaan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_bpjs_tk" name="new_bpjs_tk" placeholder="BPJS Ketenagakerjaan" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_npwp" class="col-sm-3 col-form-label">NPWP</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_npwp" name="new_npwp" placeholder="NPWP" required>
                    </div>
                  </div>
                  <hr>
                  <hr class="mb-0"><center class='text text-muted mt-0'><b>Kontak</b></center>
                  <div class="form-group row">
                    <label for="new_address" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_address" name="new_address" placeholder="Alamat Tinggal" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_phone" class="col-sm-3 col-form-label">Telepon/WA</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_phone" name="new_phone" placeholder="Telepon/WA" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_email" name="new_email" placeholder="Email" required>
                    </div>
                  </div>
                  <hr class="mb-0"><center class='text text-muted mt-0'><b>Data Pribadi</b></center>
                  <div class="form-group row">
                    <label for="new_birth_place" class="col-sm-3 col-form-label">Tempat & Tanggal Lahir</label>
                    <div class="col-sm-9 row px-3">
                      <input type="text" class="form-control col-sm-4" id="new_birth_place" name="new_birth_place" placeholder="Tempat Kelahiran" required>

                      <input type="date" class="form-control col-sm-8 text-center" id="new_birth_date" name="new_birth_date" placeholder="Tanggal Kelahiran" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_mother_name" class="col-sm-3 col-form-label">Nama Ibu Kandung</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_mother_name" name="new_mother_name" placeholder="Nama Ibu Kandung" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_nik" class="col-sm-3 col-form-label">No KTP</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_nik" name="new_nik" placeholder="Nomor KTP" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_kk" class="col-sm-3 col-form-label">No KK</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_kk" name="new_kk" placeholder="Nomor KK" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_marrital_status" class="col-sm-3 col-form-label">Status Pernikahan</label>
                    <div class="col-sm-9">
                      <select type="text" class="form-control" id="new_marrital_status" name="new_marrital_status" placeholder="Status Pernikahan" required></select>
                    </div>
                  </div>
                  <div id="div_spouse_name" class="form-group row">
                    <label for="new_spouse_name" class="col-sm-3 col-form-label">Nama Istri/Suami</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_spouse_name" name="new_spouse_name" placeholder="Nama Istri/Suami">
                    </div>
                  </div>
                  <div id="div_spouse_job" class="form-group row">
                    <label for="new_spouse_job" class="col-sm-3 col-form-label">Pekerjaan Istri/Suami</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_spouse_job" name="new_spouse_job" placeholder="Pekerjaan Istri/Suami">
                    </div>
                  </div>
                  <div id="div_child_name_1" class="form-group row">
                    <label for="new_child_name_1" class="col-sm-3 col-form-label">Nama Anak 1</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_child_name_1" name="new_child_name_1" placeholder="Nama anak pertama">
                    </div>
                  </div>
                  <div id="div_child_ttl_1" class="form-group row">
                    <label for="new_child_ttl_1" class="col-sm-3 col-form-label">Ttl Anak 1</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="new_child_ttl_1" name="new_child_ttl_1" placeholder="Tempat tgl lahir anak pertama">
                    </div>
                  </div>
                  <div id="div_child_name_2" class="form-group row">
                    <label for="new_child_name_2" class="col-sm-3 col-form-label">Nama Anak 2</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_child_name_2" name="new_child_name_2" placeholder="Nama anak kedua">
                    </div>
                  </div>
                  <div id="div_child_ttl_2" class="form-group row">
                    <label for="new_child_ttl_2" class="col-sm-3 col-form-label">Ttl Anak 2</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="new_child_ttl_2" name="new_child_ttl_2" placeholder="Tempat tgl lahir anak kedua">
                    </div>
                  </div>
                  <div id="div_child_name_3" class="form-group row">
                    <label for="new_child_name_3" class="col-sm-3 col-form-label">Nama Anak 3</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="new_child_name_3" name="new_child_name_3" placeholder="Nama anak ketiga">
                    </div>
                  </div>
                  <div id="div_child_ttl_3" class="form-group row">
                    <label for="new_child_ttl_3" class="col-sm-3 col-form-label">Ttl Anak 3</label>
                    <div class="col-sm-9">
                      <input type="date" class="form-control" id="new_child_ttl_3" name="new_child_ttl_3" placeholder="Tempat tgl lahir anak ketiga">
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

      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="del_title">Hapus TAD</h4>
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
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>

<?=$this->include('option/gender_option');?>
<?=$this->include('option/customer_option');?>
<?=$this->include('option/candidate_option');?>
<?=$this->include('option/customer_location_option');?>
<?=$this->include('option/marrital_status_option');?>
<?=$this->include('option/position_option');?>
<!-- jquery-validation -->
<!-- Page specific script -->
<script>
  var table
  var limit_rows = $('#limit_rows').val();
  $(function () {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    // body...
    table = $("#employee_table").DataTable({
      columnDefs: [{ visible: false, targets: [] }], 
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
        url:"<?=base_url('/korlap/employee/datatable')?>",
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              is_resigned : 0,
              filter_type : function() { return $('#filter_type').val(); },
              filter_input : function() { return $('#filter_input').val(); },
              filter_selection : function() { return $('#filter_selection').val(); },
              filter_date : function() { return $('#filter_date').val(); },
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
        { data: null,type:'text',title:'Nama',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
            if(row.foto_pas != null){
              return '<img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>'+row.foto_pas_path+''+row.foto_pas+'" alt="Pas Foto"><a href="<?=base_url()?>/korlap/employee/'+row.id+'">'+row.name+'</a>';
            }
            else{
              return '<a href="<?=base_url()?>/korlap/employee/'+row.id+'">'+row.name+'</a>';
            }
          }
        },
        { data: 'nip',type:'text',title:'NIP',className: 'dt-body-center dt-head-center align-middle'},
        { data: null,type:'text',title:'Customer',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
            return row.customer_name+' ('+row.customer_location+')';
          }
        },
        { data: 'position',type:'text',title:'Jabatan',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'join_date',type:'text',title:'Tanggal bergabung',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'spk',type:'text',title:'SPK',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'nik',type:'text',title:'NIK',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'pkwt',type:'text',title:'PKWT',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'sim',type:'text',title:'SIM',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'birth_date',type:'text',title:'Tempat, Tanggal Lahir',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'address',type:'text',title:'Alamat',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'phone',type:'text',title:'No Telepon',className: 'dt-body-center dt-head-center',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'email',type:'text',title:'Email',className: 'dt-body-center dt-head-center',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'no_rekening',type:'text',title:'Rekening',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'bpjs_kes',type:'text',title:'BPJS Kesehatan',className: 'dt-body-center dt-head-center',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'bpjs_tk',type:'text',title:'BPJS Ketenagakerjaan',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'npwp',type:'text',title:'NPWP',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'kk',type:'text',title:'Kartu Keluarga',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'spouse_name',type:'text',title:'Nama Istri/Suami',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'spouse_job',type:'text',title:'Pekerjaan Istri/Suami',className: 'dt-body-center dt-head-center align-middle'},
        { data: null,type:'text',title:'Anak',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
            return 'Anak ke-1 = '+row.child_1_name+' ('+row.child_1_ttl+')<br>Anak ke-2 = '+row.child_2_name+' ('+row.child_2_ttl+')<br>Anak ke-3 = '+row.child_3_name+' ('+row.child_3_ttl+')<br>';
          }
        },
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [
        {extend :"colvis", className : 'btn btn-warning btn-sm'},
        {extend :"excel", className : 'btn btn-primary btn-sm'},
        {
          text: 'Limit (<span id="limit_txt"></span>)',
          className: 'btn btn-info btn-sm',
          action: function (e, dt, node, config) {
              //window.location = "<?= base_url('/working_unit/data/new')?>";
            showModalLimit();
          }
        },
      ],
    });

    table.on('click', '#lihat', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        window.location = "<?= base_url('/employee/')?>"+data['id'];
    });
    table.on('click', '#delete ', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        $('#delete_confirm').text('Hapus TAD '+data.name+'?');
        $('#delete_id').val(data.id);
        $('#modal-delete').modal('show');
    });

    $('#filter_input_div').fadeOut();
    $('#filter_selection_div').fadeOut();
  });

  $("#filter_type").change(function (){
    if($('option:selected', this).attr('type') == 'input'){
      $('#filter_selection_div').fadeOut();
      $('#filter_input_div').fadeIn();
    }else{
      $('#filter_input_div').fadeOut();
      $('#filter_selection_div').fadeIn();
      if($('option:selected', this).val() == 'customer'){
        loadCustomerOption($('#filter_selection'));
      }
    }
  });


  function showModalLimit(){
    $('#modal-limit').modal('show');
  }

  $('#form_limit').validate({
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
        limit_rows = $('#limit_rows').val();
        console.log(limit_rows);
        table.ajax.reload();
      }
  });
  $('#form_search').validate({
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
    $('#form_search')[0].reset();
    $('#filter_customer').val(0);
    $('#filter_position').val(0);
    //table.ajax.reload();
  }

</script>
</body>
</html>
