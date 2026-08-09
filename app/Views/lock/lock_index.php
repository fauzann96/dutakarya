<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT DKS | Kunci Periode</title>

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
            <h1>Kunci Periode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kunci Periode</li>
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
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
              <div class="modal-body">
                <input type="hidden" id='edt_id' value="">
                  <div class="form-group row">
                    <label for="edt_date" class="col-sm-4 col-form-label">Tanggal Penguncian</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="edt_date" name="new_date">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_description" class="col-sm-4 col-form-label">Deskripsi</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="edt_description" name="edt_description" placeholder="Deskripsi">
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

      <div class="modal fade" id="modal-new">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Kunci Periode Absensi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new' action=''>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="new_date" class="col-sm-4 col-form-label">Tanggal Penguncian</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="new_date" name="new_date">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_description" class="col-sm-4 col-form-label">Deskripsi</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="new_description" name="new_description" placeholder="Deskripsi">
                    </div>
                  </div>
                  <p id="division" class="text-muted">*Ini akan mengunci pengisian dan perubahan absensi, penugasan backup, dan slip gaji untuk periode sebelum tanggal yang dipilih.</p>
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
<!-- Page specific script -->
<script>
  var table;
  $(function () {
    // body...
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax : { url:'<?=base_url('/lock/datatable')?>',
    },
      columns: [
        /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
        }},*/
        { data: 'description',type:'text',title:'Deskripsi',className: ' dt-head-center'},
        { data: 'date',type:'text',title:'Tanggal',className: 'dt-head-center dt-body-center'},
        { data: 'username',type:'text',title:'Username',className: 'dt-body-center dt-head-center'},
        {data: null,
        defaultContent: '<div class="btn-group"><button type="button" id="edit" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Edit</button></div>',
        targets: -1,className: 'dt-body-center'},
      ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{
                    text: '<i class="fas fa-plus"></i> Kunci Baru',
                    className: 'btn btn-success btn-sm',
                    action: function (e, dt, node, config) {
                      $('#modal-new').modal('show');
                    }
                }],
    });
    table.on('click', '#edit', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      showModalEdit(data['id']);
    });

  });

$('#form_new').validate({
    rules: {
      new_description: {
        required: true,
      },
      new_date: {
        required: true,
        minlength: 8,
        remote: {
            url: "lock/check_date",
            type: "post",
        }
      },
    },
    messages: {
      new_date:{
        remote : 'Tanggal sudah dikunci',
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
    submitHandler:function(event){
        var csrfName = '<?=csrf_token()?>';
        var request = $.ajax({
            url: '<?=base_url('/lock/new/submit')?>',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
              [csrfName] : '<?=csrf_hash()?>',
              date : $('#new_date').val(),
              description : $('#new_description').val(),
            }
        });
        request.done(function(reply){
          if(reply['status'] == 1){
            alert('Periode sebelum '+$reply['data']['date']+' telah dikunci.');
            $('#modal-new').modal('hide');
            table.ajax.reload();
          }else{
            //$('#username').val(reply['fc_data']['username']);
            alert('Kunci gagal dibuat');
          }
        });
        request.fail(function(){
          alert('request failed');
        });
      }
});


function showModalEdit(id) {
    var csrfName = '<?=csrf_token()?>';
    var request = $.ajax({
        url: '<?=base_url('/lock/data/')?>',
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
        data:{
          [csrfName] : '<?=csrf_hash()?>',
          id : id,
        }
    });
    request.done(function(reply){
      if(reply['status'] == 1){
        $('#edt_id').val(reply['data']['id']);
        $('#edt_description').val(reply['data']['description']);
        $('#edt_date').val(reply['data']['date']).change();
        $('#modal-edit').modal('show');
      }else{
        //$('#username').val(reply['fc_data']['username']);
        alert('Data tidak ditemukan');
      }
    });
}
$('#form_edit').validate({
    rules: {
      edt_description: {
        required: true,
      },
      edt_date: {
        required: true,
        minlength: 8,
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
            url: '<?=base_url('/lock/edit/submit')?>',
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
              [csrfName] : '<?=csrf_hash()?>',
              id : $('#edt_id').val(),
              date : $('#edt_date').val(),
              description : $('#edt_description').val(),
            }
        });
        request.done(function(reply){
          if(reply['status'] == 1){
            alert('Periode kunci telah ubah.');
            $('#modal-edit').modal('hide');
            table.ajax.reload();
          }else{
            //$('#username').val(reply['fc_data']['username']);
            alert('Kunci gagal diubah');
          }
        });
        request.fail(function(){
          alert('request failed');
        });
      }
});



</script>
</body>
</html>
