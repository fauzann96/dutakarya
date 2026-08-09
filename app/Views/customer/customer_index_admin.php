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
<body class="hold-transition sidebar-mini layout-fixed">
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

      <div class="modal fade" id="modal-korlap">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Pilih Korlap</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_korlap' action=''>
                <input type="hidden" id='korlap_id' name='korlap_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="korlap_korlap" class="col-sm-3 col-form-label">Korlap</label>
                    <div class="col-sm-9">
                      <select class="form-control" id='korlap_korlap' name='korlap_korlap'></select>
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

      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Edit Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit' action=''>
                <input type="hidden" id='edit_id' name='edit_id' value="">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group row">
                        <label for="new_cust_name" class="col-sm-3 col-form-label">Nama Customer</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_cust_name' name='edit_cust_name' required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new_cust_email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_cust_email' name='edit_cust_email' required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new_cust_phone" class="col-sm-3 col-form-label" required>Telepon</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_cust_phone' name='edit_cust_phone'>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new_cust_address" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                          <textarea class="form-control" id='edit_cust_address' name='edit_cust_address'></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="new_cust_area" class="col-sm-3 col-form-label" required>Area</label>
                        <div class="col-sm-9">
                          <select class="form-control" id='edit_cust_area' name='edit_cust_area'></select>
                        </div>     
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group row">
                        <label for="edit_pic1_name" class="col-sm-3 col-form-label">Nama PIC 1</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_pic1_name' name='edit_pic1_name' required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="edit_pic1_phone" class="col-sm-3 col-form-label">Telepon PIC 1</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_pic1_phone' name='edit_pic1_phone' required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="edit_pic1_email" class="col-sm-3 col-form-label">Email PIC 1</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_pic1_email' name='edit_pic1_email' required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="edit_pic2_name" class="col-sm-3 col-form-label">Nama PIC 2</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_pic2_name' name='edit_pic2_name'>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="edit_pic2_phone" class="col-sm-3 col-form-label">Telepon PIC 2</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_pic2_phone' name='edit_pic2_phone'>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="edit_pic2_email" class="col-sm-3 col-form-label">Email PIC 2</label>
                        <div class="col-sm-9">
                          <input class="form-control" id='edit_pic2_email' name='edit_pic2_email'>
                        </div>
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
   
      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Hapus Customer</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_delete' action=''>
                <input type="hidden" id='delete_id' name='delete_id' value="">
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

      <div class="modal fade" id="modal-new">
        <div class="modal-dialog">
          <div class="modal-content text-sm">
            <div class="modal-header">
              <h4 class="modal-title">Customer Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_new' action=''>
                <input type="hidden" id='user_id' value="">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="new_cust_name" class="col-sm-3 col-form-label">Nama Customer</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='new_cust_name' name='new_cust_name' required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_cust_email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='new_cust_email' name='new_cust_email' required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_cust_phone" class="col-sm-3 col-form-label" required>Telepon</label>
                    <div class="col-sm-9">
                      <input class="form-control" id='new_cust_phone' name='new_cust_phone'>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_cust_address" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id='new_cust_address' name='new_cust_address'></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="new_cust_area" class="col-sm-3 col-form-label" required>Area</label>
                    <div class="col-sm-9">
                      <select class="form-control" id='new_cust_area' name='new_cust_area'>
                    </select>
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

      

      <!-- /. modal -->
      <input type="hidden" id="<?= csrf_token() ?>" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?=$this->include('footer');?>
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
  <script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
    <!-- Toastr -->
  <script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
  <!-- jquery-validation -->
  <!-- AdminLTE App -->
  <script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
  <?=$this->include('option/area_option');?>
  <?=$this->include('option/customer_korlap_option');?>
  <!-- Page specific script -->
  <script>
    var table;
    var limit_rows = $('#limit_rows').val();
    $(function () {
      // body...
      table = $("#data_table").DataTable({
        dom: '<"container-fluid"<"row"<"col"B><"col"f>>rt<"row"<"col"i><"col"p>>>',
        ajax:{
          url:"<?=base_url('/customer/datatable')?>",
          type:"post",
          data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
                id:'123',
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
          { data: null,type:'text',title:'Nama Customer',className:'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              return row.name+'<br><div class="btn-group"><button type="button" id="view" class="btn btn-info btn-xs"><i class="fas fa-eye"></i></button><button type="button" id="edit" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> Edit</button><button type="button" id="delete" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</button></div>'
            }
          },
          { data: 'email',type:'text',title:'Email',className: ' dt-head-center dt-body-center',render: function (data, type, row, meta) {
                  return data+' <a href="mailto:' + data + '" target="_blank"><i class="far fa-envelope"></i></a>';
          }},
          { data: 'phone',type:'text',title:'Telepon',className:'dt-body-center dt-head-center',render: function (data, type, row, meta) {
                  return data+' <a href="https://wa.me/' + data + '" target="_blank"><i class="fab fa-whatsapp"></i></a>';
          }},
          { data: 'address',type:'text',title:'Alamat',className: ' dt-head-center'},
          { data: 'area_name',type:'text',title:'Area',className: ' dt-head-center dt-body-center'},
          { data: null,type:'text',title:'Korlap',className:'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              if(row.korlap_name == null){
                return '<button type="button" id="edit_korlap" class="btn btn-info btn-xs">Pilih Korlap</i>';
              }else{
                return row.korlap_name+' - '+row.korlap_nip+'<br><div class="btn-group"><button type="button" id="edit_korlap" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Ganti</button></div>';
              }
            }
          },
          { data: null,type:'text',title:'PIC 1',className:'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              return 'Nama: '+row.pic_1_name+'<br>Telepon : '+row.pic_1_phone+'<br>Email :'+row.pic_1_email;
            }
          },
          { data: null,type:'text',title:'PIC 2',className:'dt-body-center dt-head-center',render:function (data, type, row, meta) {
              return 'Nama: '+row.pic_2_name+'<br>Telepon :'+row.pic_2_phone+'<br>Email :'+row.pic_2_email;
            }
          },
      ],
        responsive: true,
        lengthChange: false, 
        autoWidth: false,
        buttons: [{
                      text: '<i class="fas fa-plus"></i> Customer Baru',
                      className: 'btn btn-success btn-sm',
                      action: function (e, dt, node, config) {
                        loadAreaOption($('#new_cust_area'));
                        $('#modal-new').modal('show');
                      }
                  },
                  {
                      text: 'Limit (<span id="limit_txt">123</span>)',
                      className: 'btn btn-info btn-sm',
                      action: function (e, dt, node, config) {
                        showModalLimit();
                      }
                  },'colvis',
                  ],
      });
      table.on('click', '#view', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        window.location = "<?= base_url('/customer/')?>"+data['id'];
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
        showModalDelete(data);
      });
      table.on('click', '#edit_korlap', function (e) {
        var data = table.row(this).data();
        if(data==null){
          data = table.row(e.target.closest('tr')).data();
        }
        customerKorlapOption($('#korlap_korlap'),data['id']);
        $('#korlap_id').val(data['id']);
        $('#modal-korlap').modal('show');
      });
    });

    $('#form_korlap').validate({
        rules: {
          korlap_korlap :{
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
          $(element).addClass('is-valid');
        },
        submitHandler:function(event){
          var request = $.ajax({
            url: "<?=base_url('/customer/korlap/submit')?>",
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            'customer_id' : $('#korlap_id').val(),
            'korlap' : $('#korlap_korlap').val(),
            },
          });
          request.done(function(reply){
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1){
              toastr.success('Customer Berhasil Diupdate');
              $('#modal-korlap').modal('hide');
              $('#form_korlap')[0].reset();
              table.ajax.reload();
            }else{
              toastr.error('Customer Gagal Diedit');
            }
          });
          request.fail(function (jqXHR, textStatus) {
            toastr.error(jqXHR.status);
          });
        }
    });

    function showModalKorlap(data){
      customerKorlapOption($('#korlap_korlap'),data.id);
      $('#korlap_id').val(data.id);
      $('#korlap_korlap').val(data.emp_fc_seq);
      $('#modal-korlap').modal('show');
    }

    $('#form_edit').validate({
        rules: {
          edit_cust_name :{
            required:true,
          },
          edit_cust_email :{
            required:true,
            email:true,
          },
          edit_cust_phone :{
            required:true,
            digits:true,
          },
          edit_cust_address :{
            required:true,
            maxlength:50,
          },
          edit_cust_area :{
            required:true,
          },
          edit_pic1_name:{
            required:true,
          },
          edit_pic1_phone:{
            required:true,
            digits:true,
          },
          edit_pic1_email:{
            required:true,
            email:true,
          }
        },
        messages: {
          delete_reason :{
            required:"Tuliskan alasan penghapusan",
            maxlength :50,
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
          $(element).addClass('is-valid');
        },
        submitHandler:function(event){
          var request = $.ajax({
            url: "<?=base_url('/customer/edit/submit')?>",
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            'id' : $('#edit_id').val(),
            'name' : $('#edit_cust_name').val(),
            'phone' : $('#edit_cust_phone').val(),
            'email' : $('#edit_cust_email').val(),
            'address' : $('#edit_cust_address').val(),
            'area' : $('#edit_cust_area').val(),
            'pic_1_name' : $('#edit_pic1_name').val(),
            'pic_1_phone' : $('#edit_pic1_phone').val(),
            'pic_1_email' : $('#edit_pic1_email').val(),
            'pic_2_name' : $('#edit_pic2_name').val(),
            'pic_2_phone' : $('#edit_pic2_phone').val(),
            'pic_2_email' : $('#edit_pic2_email').val(),
            },
          });
          request.done(function(reply){
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1){
              toastr.success('Customer Berhasil Diupdate');
              $('#modal-edit').modal('hide');
              $('#form_edit')[0].reset();
              table.ajax.reload();
            }else{
              toastr.error('Customer Gagal Diedit');
            }
          });
          request.fail(function (jqXHR, textStatus) {
            toastr.error(jqXHR.status);
          });
        }
    });

    function showModalEdit(data){
      toastr.info('Requesting data');
      var request = $.ajax({
        url: "<?=base_url('/customer/data')?>",
        type: 'POST',
        async: false,
        cache: false,
        timeout: 30000,
        data:{
        '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
        'id' : data.id,
        },
      });
      request.done(function(reply){
        loadAreaOption($('#edit_cust_area'));
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        $('#edit_id').val(reply.data['id']);
        $('#edit_cust_name').val(reply.data['name']);
        $('#edit_cust_email').val(reply.data['email']);
        $('#edit_cust_phone').val(reply.data['phone']);
        $('#edit_cust_address').val(reply.data['address']);
        $('#edit_cust_area').val(reply.data['area_seq']);
        $('#edit_pic1_name').val(reply.data['pic_1_name']);
        $('#edit_pic1_phone').val(reply.data['pic_1_phone']);
        $('#edit_pic1_email').val(reply.data['pic_1_email']);
        $('#edit_pic2_name').val(reply.data['pic_2_name']);
        $('#edit_pic2_phone').val(reply.data['pic_2_phone']);
        $('#edit_pic2_email').val(reply.data['pic_2_email']);
        $('#modal-edit').modal('show');
      });
    }

    $('#form_delete').validate({
        rules: {
          delete_id :{
            required:true,
          },
          delete_reason :{
            required:true,
          },
        },
        messages: {
          delete_reason :{
            required:"Tuliskan alasan penghapusan",
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
          $(element).addClass('is-valid');
        },
        submitHandler:function(event){
          var request = $.ajax({
            url: "<?=base_url('/customer/delete/submit')?>",
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
            [<?=csrf_token()?>] : $('#<?=csrf_token()?>').val(),
            'id' : $('#delete_id').val(),
            'delete_reason' : $('#delete_reason').val(),
            },
          });
          request.done(function(reply){
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1){
              toastr.success('Customer Berhasil Dihapus');
              $('#modal-delete').modal('hide');
              $('#form_delete')[0].reset();
              table.ajax.reload();
            }else{
              toastr.error('Customer Gagal Dihapus');
            }
          });
          request.fail(function (jqXHR, textStatus) {
            toastr.error(jqXHR.status);
          });
        }
    });

    function showModalDelete(data){
      $('#delete_confirm').text('Hapus Customer '+data.name+'?');
      $('#delete_id').val(data.id);
      $('#modal-delete').modal('show');
    }

    $('#form_new').validate({
        rules: {
          new_cust_name :{
            required:true,
          },
          new_cust_email :{
            required:true,
            email: true,
          },
          new_cust_phone :{
            required:true,
            digits:true,
          },
          new_cust_address :{
            required:true,
          },
        },
        messages: {
          new_cust_name :{
            required:"Harap isi nama customer",
          },
          new_cust_email :{
            required:"Harap isi email customer",
          },
          new_cust_phone :{
            required:"Harap isi telepon customer",
          },
          new_cust_address :{
            required:"Harap isi alamat customer",
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
            url: "<?=base_url('/customer/new/submit')?>",
            type: 'POST',
            async: false,
            cache: false,
            timeout: 30000,
            data:{
            '<?=csrf_token()?>' : $('#<?=csrf_token()?>').val(),
            'name' : $('#new_cust_name').val(),
            'email' : $('#new_cust_email').val(),
            'phone' : $('#new_cust_phone').val(),
            'address' : $('#new_cust_address').val(),
            'area' : $('#new_cust_area').val(),
            },
          });
          request.done(function(reply){
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1){
              toastr.success('Customer berhasil ditambahkan');
              $('#modal-new').modal('hide');
              $('#form_new')[0].reset();
              table.ajax.reload();
            }else{
              toastr.error('Gagal menambahkan customer');
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



  </script>
</body>
</html>
