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
              <li class="breadcrumb-item active">Area</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box bg-info">
                    <div class="inner">
                      <h3><sup style="font-size: 20px"><span id="total_division"><?=$total_customer ?: '-'?></span></sup></h3>
                      <p>Total Customer</p>
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
                      <h3><sup style="font-size: 20px"><span id="total_employee"><?=$total_employee ?: '-'?></span></sup></h3>
                      <p>Total Karyawan</p>
                    </div>
                    <div class="icon">
                      <i class="fas fa-user"></i>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

            


        <div class="card card-primary card-outline">
          <div class="card-body">
            <table id="wu_table" class="table table-sm table-bordered table-striped compact">
              
            </table>
          </div>
          <!-- /.card-body -->
        </div>
            <!-- /.card -->
      </div>
          <!-- /.col -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Area Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
                <input type="hidden" id='edt_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="edt_name" class="col-sm-3 col-form-label">Nama Area</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edt_name" name="edt_name" placeholder="Nama area" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edt_desc" name="edt_desc" placeholder="Keterangan">
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
<!-- ChartJS -->
<script src="<?= base_url('/plugins/chart.js/Chart.min.js')?>"></script>
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
<!-- Page specific script -->
<script>
var table;

$(function () {
 loadDatatable();
});

$('#form_edit').validate({
      rules: {
        edt_name:{
          required:true,
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
          let url="<?=base_url('/area/edit/submit')?>";
          var request = $.ajax({
          method: "POST",
          async: false,
          cache: false,
          timeout: 30000,
          url: url,
          data: {
            [csrfName] : '<?=csrf_hash()?>',
            id : <?=$area['id']?>,
            name: $('#edt_name').val(),
            desc: $('#edt_desc').val(),
          },
        });
          request.done(function( reply ) {
            if(reply['status'] == 1 ){
               $('#modal-edit').modal('hide');
               $('#text_name').text(reply['update']['name']);
               $('#text_desc').text(reply['update']['description']);
            }else{
              alert('Perubahan tidak disimpan');
            }
          });
          request.fail(function( jqXHR, textStatus, error ) {
            var err = eval("(" + jqXHR.responseText + ")");
            alert(err.message);
          });
      }
  });
function showModalEdit(){
  let url="<?=base_url('/area/data/').$area['id']?>";
  var request = $.ajax({
        method: "get",
        async: false,
        cache: false,
        timeout: 30000,
        url: url,
        data: {
        },
      });
  request.done(function( reply ) {
    if(reply['status'] == 1 ){
      $('#modal-edit').modal('show');
      var dat = reply['data'];
      $('#edt_name').val(dat['name']);
      $('#edt_desc').val(dat['description']);

    }else{
      alert('Tidak dapat mengedit');
    }
  });
  request.fail(function( jqXHR, textStatus, error ) {
    var err = eval("(" + jqXHR.responseText + ")");
    alert(err.message);
  });
}

function loadDatatable(){
  table = $("#wu_table").DataTable({
      dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',
      ajax:{
        url:"<?=base_url('/area/customer/datatable')?>",
        type:"post",
        data:{"<?= csrf_token()?>":$("#<?= csrf_token()?>").val(),
              'id': <?=$area['id']?>,
        },
        dataSrc : function ( json ) {
                //Make your callback here.
                $("#<?= csrf_token()?>").val(json.new_csrf);
                return json.data;
        },
        "destroy" : true,
      },
    columns: [
        /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
            $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
        }},*/
        { data: 'name',type:'text',title:'Unit Kerja',className: 'dt-body-center dt-head-center'},
        { data: 'fc',type:'text',title:'Koordinator Lapangan',className: 'dt-head-center dt-body-center'},
        {data: null,
        defaultContent: '<div class="btn-group"><button type="button" id="lihat" class="btn btn-info btn-xs"><i class="far fa-eye"></i> Lihat</button></div>',
        targets: -1,className: 'dt-body-center'},
    ],
      responsive: true,
      lengthChange: false, 
      autoWidth: false,
      buttons: [],
    });
    table.on('click', '#lihat', function (e) {
        let data = table.row(e.target.closest('tr')).data();
        window.location = "<?= base_url('/customer/')?>"+data['id'];
        //alert(data['id'] + "'s salary is: " + data[5]);
    });
}


</script>
</body>
</html>
