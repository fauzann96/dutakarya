<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT DKS | <?=session()->get('title')?></title>

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
            <h1><?=session()->get('title')?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Posisi</li>
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
              <div class="card-body">
                <table id="data_table" class="table table-sm table-bordered table-striped compact">
                  
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

      <div class="modal fade " id="modal-new">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header bg-success">
              <h4 class="modal-title">Posisi Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new' action=''>
                <input type="hidden" id='user_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="new_position_name" class="col-sm-3 col-form-label">Nama Posisi</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='new_position_name' name='new_position_name' required>
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
              <h4 class="modal-title">Hapus Posisi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete'>
                <input type="hidden" id='delete_id' value="">
                <div class="modal-body">
                  <h3 id='delete_confirm_text'></h3>
                  <div class="form-group row">
                    <label for="delete_reason" class="col-sm-3 col-form-label">Alasan Penghapusan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id='delete_reason' name='delete_reason' placeholder="Alasan" required></textarea>
                    </div>
                  </div> 
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Posisi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
              <input type="hidden" class="form-control" id='edit_id' name='edit_id'>
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="edit_name" class="col-sm-3 col-form-label">Nama Posisi</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id='edit_name' name='edit_name' required>
                    </div>
                  </div>
                  <p>*Perubahan nama akan mempengaruhi export selanjutnya</p>             
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
<!-- jquery-validation -->
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<?=$this->include('jquery_option');?>
<!-- Page specific script -->
<script>
  var table;
  var limit_rows = $('#limit_rows').val();
  $(function () {
    // body...
    table = $("#data_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"f>>rt<"row"<"col"i><"col"p>>>',
      ajax:{
        url:"<?=base_url('/position/datatable')?>",
        type:"post",
        data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
              id:'123',
              limit: function() { return $('#limit_rows').val(); },
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                $('#modal-limit').modal('hide');
                return json.data;
        },
        "destroy" : true,
      },
    columns: [
        /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
        }},*/
        { data: 'name',type:'text',title:'Nama Posisi',className: ''},
        {data: null,
        defaultContent: '<div class="btn-group"><button type="button" id="edit" class="btn btn-info btn-xs"><i class="far fa-edit"></i> Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</button></div>',
        targets: -1,className: 'dt-body-center'},
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [{
                    text: '<i class="fas fa-plus"></i> Posisi Baru',
                    className: 'btn btn-success btn-sm',
                    action: function (e, dt, node, config) {
                        //window.location = "<?= base_url('/working_unit/data/new')?>";
                      showModalNew();
                    }
                },
                ],
    });
    table.on('click', '#delete', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
       showModalDelete(data['id'],data['name']);
    });
    table.on('click', '#edit', function (e) {
      var data = table.row(this).data();
      if(data==null){
        data = table.row(e.target.closest('tr')).data();
      }
      showModalEdit(data['id'],data['name']);
    });
  });

  $('#form_edit').validate({
  rules: {
    edit_name :{
      required:true,
    },
  },
  messages: {
    edit_name :{
      required:"Harap isi nama",
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
      url: "<?=base_url('/position/edit/submit')?>",
      type: 'POST',
      async: false,
      cache: false,
      timeout: 30000,
      data:{
      [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
      id: $('#edit_id').val(),
      name : $('#edit_name').val(),
      position : $('#edit_position').val(),
      },
    });
    request.done(function(reply){
      $('#<?=csrf_token()?>').val(reply['new_csrf']);
      if(reply['status'] == 1){
        $('#form_edit')[0].reset();
        $('#modal-edit').modal('hide');
        table.ajax.reload();
      }else if(reply['status'] == 2){
        alert(reply['message']);
        window.location = "<?= base_url('/login/')?>";
      }else{
        alert('Gagal menyimpan perubahan');
      }
    });
  }
});


function showModalEdit(id,name){
  $('#modal-edit').modal('show');
  $('#edit_id').val(id);
  $('#edit_name').val(name);
}

  function showModalDelete(id,name) {
    $('#delete_id').val(id);
    $('#delete_confirm_text').text('Hapus divisi '+name+'?');
    $('#modal-delete').modal('show');
  }
  $('#form_delete').validate({
      rules: {
        delete_id: {
          required: true,
        },
        delete_reason: {
          required: true,
          maxlength: 50,
        },
      },
      messages: {
        delete_reason: {
          required: "Harap tuliskan alasan",
          maxlength: "Maksimal 50 karakter",
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
          let url="<?=base_url('/position/delete/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            ["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
            id : $('#delete_id').val(),
            delete_reason : $('#delete_reason').val(),
          },
        });
          request.done(function( reply ) {
            $("#<?= csrf_token()?>").val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              table.ajax.reload();
              $('#modal-delete').modal('hide');
            }else if(reply['status'] == 2){
              alert(reply['message']);
              window.location = "<?= base_url('/login/')?>";
            }else{
              alert('Gagal menghapus posisi');
            }
          });
          request.fail(function( jqXHR, textStatus, error ) {
            var err = eval("(" + jqXHR.responseText + ")");
            alert(err.message);
          });
      }
  });

  function showModalNew(){
    $('#modal-new').modal('show');
  }

  $('#form_new').validate({
      rules: {
        new_position_name :{
          required:true,
        },
      },
      messages: {
        new_position_name :{
          required:"Harap isi nama posisi",
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
        submitNewCustomer();
      }
  });

  function submitNewCustomer(){
    var request = $.ajax({
      url: "<?=base_url('/position/new/submit')?>",
      type: 'POST',
      async: false,
      cache: false,
      timeout: 30000,
      data:{
      [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
      'name' : $('#new_position_name').val(),
      },
    });
    request.done(function(reply){
      $('#<?=csrf_token()?>').val(reply['new_csrf']);
      if(reply['status'] == 1){
        alert('Posisi ditambahkan');
        $('#modal-new').modal('hide');
        $('#form_new')[0].reset();
        table.ajax.reload();
      }else{
        alert('Gagal menambahkan posisi');
      }
    });
  }

</script>
</body>
</html>
