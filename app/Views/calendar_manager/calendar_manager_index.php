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
            <h1>Pengaturan Kalender</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengaturan Kalender</li>
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
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="filter_type">Jenis Filter</label>
                        <select class="form-control" id="filter_type" name="filter_type">
                          <option disabled selected>Pilih filter</option>
                          <option value="name" type='input'>Nama</option>
                          <option value="type" type='selection'>Jenis</option>
                          <option value="year" type='input'>Tahun</option>
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
                </div>
              <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fas fa-search"></i> Cari</button>
                  <button class="btn btn-sm btn-default float-right" onclick="resetFilter()"><i class="fas fa-redo-alt"></i> Reset</button>
                </div>
              </div>
            </form>
            <div class="card">
              
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
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <center><h3 id="delete_confirm"></h3></center>
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

<!-- modal -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
                <input type="hidden" id='edit_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="edit_name" class="col-sm-4 col-form-label">Nama</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="edit_date" class="col-sm-4 col-form-label">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="edit_date" name="edit_date">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="edit_type" class="col-sm-4 col-form-label">Tipe</label>
                    <div class="col-sm-8">
                      <select class="form-control" id="edit_type" name="edit_type"></select>
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

      <div class="modal fade" id="modal-new">
        <div class="modal-dialog">
          <div class="modal-content">
            <form id='form_new' action=''>
              <div class="modal-header bg-success">
                <h4 class="modal-title">Libur/Cuti Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                  <label for="new_name" class="col-sm-4 col-form-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="new_name" name="new_name" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="new_date" class="col-sm-4 col-form-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="new_date" name="new_date">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="new_type" class="col-sm-4 col-form-label">Tipe</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="new_type" name="new_type"></select>
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
<?=$this->include('option/day_off_type_option');?>
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
<script>
  var table;
  $(function () {
    // body...
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
        url:'<?=base_url('calendar_manager/datatable')?>',
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              filter_type : function() { return $('#filter_type').val(); },
              filter_input : function() { return $('#filter_input').val(); },
              filter_selection : function() { return $('#filter_selection').val(); },
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                return json.data;
        },
        "destroy" : true,
      },
      ordering: false,
      columns: [
        { data: 'name',type:'text',title:'Nama',className: ' dt-head-center'},
        { data: 'date_text',type:'text',title:'Tanggal',className: 'dt-head-center dt-body-center'},
        { data: 'tp_name',type:'text',title:'Tipe',className: 'dt-body-center dt-head-center'},
        {data: 'date',
          render : function ( data, type, row ) {
            return '<div class="btn-group"><button type="button" id="edit" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i>Hapus</button></div>';
          },className: 'dt-body-center dt-head-center align-middle',targets: -1,
        },
      ],
      order: [[3,'asc']],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{
                    text: '<i class="fas fa-plus"></i> Tambah',
                    className: 'btn-success btn-sm',
                    action: function (e, dt, node, config) {
                      loadDayOffTypeOption($('#new_type'));
                      $('#modal-new').modal('show');
                    }
                }],
    });
    table.on('click', '#edit', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      $('#modal-edit').modal('show');
      $('#edit_id').val(data['id']);
      $('#edit_name').val(data['name']);
      $('#edit_date').val(data['date']);
      loadDayOffTypeOption($('#edit_type'));
      $('#edit_type').val(data['type']);
    });
    table.on('click', '#delete', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      $('#delete_id').val(data['id']);
      $('#delete_confirm').text('Hapus '+data['name']+'?')
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
    if($('option:selected', this).val() == 'type'){
      loadDayOffTypeOption($('#filter_selection'));
    }
  }
});
function resetFilter(){
  $('#form_filter')[0].reset();
  $('#filter_customer').val(0);
  $('#filter_position').val(0);
  table.ajax.reload();
}
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

$('#form_delete').validate({
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
        var csrfName = '<?=csrf_token()?>';
        var request = $.ajax({
            url: '<?=base_url('/calendar_manager/delete/submit')?>',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
              '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
              id : $('#delete_id').val(),
            }
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            $('#modal-delete').modal('hide');
            table.ajax.reload();
            toastr.success('Data berhasil dihapus');
          }else{
            toastr.error('Data gagal dihapus');
          }
        });
        request.fail(function(){
          alert('request failed');
        });
      }
});


$('#form_new').validate({
    rules: {
      new_name: {
        required: true,
      },
      new_date: {
        required: true,
      },
      new_type: {
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
        var csrfName = '<?=csrf_token()?>';
        var request = $.ajax({
            url: '<?=base_url('/calendar_manager/new/submit')?>',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
              '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
              name : $('#new_name').val(),
              date : $('#new_date').val(),
              type : $('#new_type').val(),
            }
        });
        request.done(function(reply){
          $('#<?=csrf_token()?>').val(reply['new_csrf']);
          if(reply['status'] == 1){
            toastr.success('Libur berhasil ditambahkan');
            $('#modal-new').modal('hide');
            table.ajax.reload();
          }else{
            //$('#username').val(reply['fc_data']['username']);
            toastr.error('Libur gagal disimpan');
          }
        });
        request.fail(function(){
          toastr.error('request failed');
        });
      }
});


$('#form_edit').validate({
  rules: {
    edit_name: {
      required: true,
    },
    edit_date: {
      required: true,
    },
    edit_type: {
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
      var csrfName = '<?=csrf_token()?>';
      var request = $.ajax({
          url: '<?=base_url('/calendar_manager/edit/submit')?>',
          type: 'POST',
          async: false,
          cache: false,
          timeout: 30000,
          data:{
            '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
            name : $('#edit_name').val(),
            date : $('#edit_date').val(),
            type : $('#edit_type').val(),
            id:$('#edit_id').val(),
          }
      });
      request.done(function(reply){
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1){
          toastr.success('Data berhasil diubah');
          $('#modal-edit').modal('hide');
          table.ajax.reload();
        }else{
          toastr.error('Perubahan gagal disimpan');
        }
      });
      request.fail(function(){
        toastr.error('request failed');
      });
    }
});


</script>
</body>
</html>
