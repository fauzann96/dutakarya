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
            <h1>Data TAD Resign</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data TAD</li>
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
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="filter_position">Jabatan</label>
                      <select class="form-control" id="filter_position" name="filter_position"></select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label for="filter_customer">Customer</label>
                      <select class="form-control select2bs4" id="filter_customer" name="filter_customer"></select>
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
              <h4 class="modal-title">Hapus Data TAD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <center><h3 id="delete_confirm"></h3></center>
                    <div class="form-group row">
                      <input type="text" class="form-control" id="delete_reason" name="delete_reason" placeholder="Alasan penghapusan" required>
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

      <div class="modal fade" id="modal-cancel-resign">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Batal Resign</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_cancel_resign' action=''>
                <input type="hidden" id='cancel_resign_id' value="">
                <div class="modal-body">
                  <center><h3 id="cancel_resign_confirm"></h3></center>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-info">Ya</button>
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
<?=$this->include('option/customer_option');?>
<!-- Page specific script -->
<script>
  var table;
  var limit_rows = $('#limit_rows').val();
  $(function () {
    table = $("#employee_table").DataTable({
      columnDefs: [{ visible: false, targets: [] }], 
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
        url:"<?=base_url('/employee/datatable')?>",
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              is_resigned : 1,
              filter_type : function() { return $('#filter_type').val(); },
              filter_input : function() { return $('#filter_input').val(); },
              filter_selection : function() { return $('#filter_selection').val(); },
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
              return '<img class="profile-user-img img-fluid img-circle" src="<?=base_url()?>'+row.foto_pas_path+''+row.foto_pas+'" alt="Pas Foto"><br><a href="<?=base_url()?>employee/'+row.id+'">'+row.name+'</a><br><div class="btn-group"><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</button><button type="button" id="cancel" class="btn btn-warning btn-xs"><i class="fas fa-undo"></i> Undo</button></div>';
            }
            else{
              return '<a href="<?=base_url()?>employee/'+row.id+'">'+row.name+'</a><br><div class="btn-group"><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</button><button type="button" id="cancel" class="btn btn-warning btn-xs"><i class="fas fa-undo"></i> Undo</button></div>';
            }
          }
        },
        { data: 'nip',type:'text',title:'NIP',className: 'dt-body-center dt-head-center align-middle'},
        { data: null,type:'text',title:'Customer',className:'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
            return row.customer_name+' ('+row.customer_location+')';
          }
        },
        { data: 'position',type:'text',title:'Jabatan',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'resign_date',type:'text',title:'Tanggal resign',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'spk',type:'text',title:'SPK',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'pkwt',type:'text',title:'PKWT',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'sim',type:'text',title:'SIM',className: 'dt-body-center dt-head-center align-middle'},
        { data: null,type:'text',title:'Tempat, Tanggal Lahir',className: 'dt-body-center dt-head-center align-middle',render:function (data, type, row, meta) {
            return row.birth_place+', '+row.birth_date;
          }
        },
        { data: 'address',type:'text',title:'Alamat',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'phone',type:'text',title:'No Telepon',className: 'dt-body-center dt-head-center',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'email',type:'text',title:'Email',className: 'dt-body-center dt-head-center',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'no_rekening',type:'text',title:'Rekening',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'bpjs_kes',type:'text',title:'BPJS Kesehatan',className: 'dt-body-center dt-head-center',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'bpjs_tk',type:'text',title:'BPJS Ketenagakerjaan',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'npwp',type:'text',title:'NPWP',className: 'dt-body-center dt-head-center align-middle'},
        { data: 'nik',type:'text',title:'NIK',className: 'dt-body-center dt-head-center align-middle'},
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
        {
          text: 'Limit (<span id="limit_txt"></span>)',
          className: 'btn btn-info btn-sm',
          action: function (e, dt, node, config) {
              //window.location = "<?= base_url('/working_unit/data/new')?>";
            showModalLimit();
          }
        },
        {
            text: '<i class="fas fa-plus"></i> TAD Baru',
            className: 'btn btn-success btn-sm',
            action: function (e, dt, node, config) {
                $('#modal-new').modal('show');
                loadGenderOption($('#new_gender'));
                loadCustomerOption($('#new_customer'));
                loadCandidateOption($('#new_candidate'));
                loadMarritalOption($('#new_marrital_status'));
                $('#div_spouse_name').fadeOut();
                $("#new_spouse_name").prop('required',false);
                $('#div_spouse_job').fadeOut();
                $("#new_spouse_job").prop('required',false);
                $('#div_child_name_1').fadeOut();
                $("#new_child_name_1").prop('required',false);
                $('#div_child_ttl_1').fadeOut();
                $("#new_child_ttl_1").prop('required',false);
                $('#div_child_name_2').fadeOut();
                $("#new_child_name_3").prop('required',false);
                $('#div_child_ttl_2').fadeOut();
                $("#new_child_ttl_2").prop('required',false);
                $('#div_child_name_3').fadeOut();
                $("#new_child_name_3").prop('required',false);
                $('#div_child_ttl_3').fadeOut();
                $("#new_child_ttl_2").prop('required',false);
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
    table.on('click', '#delete', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        showModalDelete(data);
    });
    table.on('click', '#cancel', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        showModalCancelResign(data);
    });
  });

  function showModalCancelResign(data){
    $('#cancel_resign_confirm').text('Batal resign '+data.name+'?');
    $('#cancel_resign_id').val(data.id);
    $('#modal-cancel-resign').modal('show');
  }
  $('#form_cancel_resign').validate({
      rules: {
        cancel_resign_id: {
          required: true,
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
        toastr.info('Mengupdate data...');
        let url="<?=base_url('/employee/cancel_resign/submit')?>";
        var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            id : $('#cancel_resign_id').val(),
          },
        });
          request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              toastr.success('Perubanan berhasil disimpan');
              table.ajax.reload();
              $('#form_cancel_resign')[0].reset();
              $('#modal-cancel-resign').modal('hide');
            }else{
              toastr.error('Gagal mengupdate data');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
      }
  });

  function showModalDelete(data){
    $('#delete_confirm').text('Hapus data '+data.name+'?');
    $('#delete_id').val(data.id);
    $('#modal-delete').modal('show');
  }

  $('#form_delete').validate({
      rules: {
        delete_reason: {
          required: true,
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
        toastr.info('Menghapus data...');
        let url="<?=base_url('/employee/delete/submit')?>";
        var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            id : $('#delete_id').val(),
          },
        });
          request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              toastr.success('Perubanan berhasil dihapus');
              table.ajax.reload();
              $('#form_delete')[0].reset();
              $('#modal-delete').modal('hide');
            }else{
              toastr.error('Gagal menghapus');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
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
