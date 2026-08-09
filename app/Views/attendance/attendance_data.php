<!DOCTYPE html>
<html lang="en">
<head>
  <?=$this->include('meta')?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
               <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url('/plugins/toastr/toastr.min.css')?>">
  <style type="text/css">
    table{
      border-collapse: collapse;;
     }
    td, th {
      border: 1px solid black;
    }
  </style>
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
            <h1>Data Absensi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Absensi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12 col-sm-12">
            <form id="choose_form" name="choose_period">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pilih Data untuk ditampilkan</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Customer</label>
                  <div class="col-sm-10">
                    <select id="choose_customer" name="choose_customer" class="form-control select2" style="width: 100%;">
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="choose_start" class="col-sm-2 col-form-label">Periode</label>
                  <div class="col-sm-4">
                    <input type="date" id="choose_start" name="choose_start" class="form-control"  placeholder="">
                  </div>
                  <label for="choose_end" style="text-align: center;"class="col-sm-2 col-form-label">sampai</label>
                  <div class="col-sm-4">
                    <input type="date" id="choose_end" name="choose_end" class="form-control"  placeholder="">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Tampilkan Data</button>
              </div>
            </div>
            </form>
          </div>
          <div class="col-12 col-sm-12" id="attendance_table_div">
            <div class="card overflow-auto">
              <div class="card-body">
                <table id="attendance_table col-12 col-sm-12">
                  <thead id="attendance_table_head" class="text-center">

                  </thead>
                  <tbody id="attendance_table_body">
                    
                  </tbody>
                </table>
                <div class="row col-sm-12 col-12">
                  <table class="mt-3 col-12 col-sm-6">
                    <thead>
                      <tr >
                        <th class="text-center px-3">Code</th>
                        <th class="text-center px-3">Tipe Kehadiran</th>
                      </tr>
                    </thead>
                    <tbody id="attendance_table_body">
                      <?php 
                      foreach ($attendance_type as $at_key => $at_value) {
                        ?>
                        <tr class="text-center">
                          <td class="bg-<?=$at_value['color']?>"><?=$at_value['code']?></td>
                          <td><?=$at_value['name']?></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                                                    
                  <table class="mt-3 col-12 col-sm-6">
                    <thead>
                      <tr >
                        <th class="text-center px-3">Kode Shift</th>
                        <th class="text-center px-3">Shift</th>
                      </tr>
                    </thead>
                    <tbody id="attendance_table_body">
                      <?php 
                      foreach ($shift_code as $sc_key => $sc_value) {
                        ?>
                        <tr class="text-center">
                          <td style="background-color: <?=$sc_value['color']?> ;"><?=$sc_value['code']?></td>
                          <td><?=$sc_value['name']?></td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>

              </div>
              <div class="card-footer">
                <div class="btn-group float-right"><button class="btn bg-danger" onclick="generatePDF()"><i class="fas fa-file-pdf"></i> PDF</button><button class="btn bg-success" onclick="generateExcel()"><i class="fas fa-file-excel"></i> Excel</button></div>
              </div>
            </div>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
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
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<!-- Toastr -->
<script src="<?= base_url('plugins/toastr/toastr.min.js')?>"></script>
<?=$this->include('option/customer_option');?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
        //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    loadCustomerOption($('#choose_customer'));

    $.validator.setDefaults({
      submitHandler: function () {
        submitForm();
      }
    });
    $('#choose_form').validate({
      rules: {
        choose_customer: {
          required: true,
        },
        choose_start: {
          required: true,
        },
        choose_end: {
          required: true,
        },
      },
      messages: {
        choose_customer:{
          required: "Harap isi pilih customer"
        },
        choose_start:{
          required: "Harap pilih periode mulai",
        },
        choose_end:{
          required: "Harap pilih periode akhir",
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
      }
    });
    //validation end

    //$('#attendance_table_div').fadeOut();

  });

  function submitForm(){
    //window.location = "<?= base_url('/attendance/data/')?>"+$('#choose_customer').val()+"/"+$('#choose_start').val()+"/"+$('#choose_end').val();
    var form_data = new FormData();
    form_data.append('customer',$('#choose_customer').val());
    form_data.append('start_date',$('#choose_start').val());
    form_data.append('end_date',$('#choose_end').val());
    form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
    
    var request = $.ajax({
          url: '<?=base_url('/attendance/data/fetch')?>',
          type: 'POST',
          contentType: false,
          processData: false,  // Important!
          async: false,
          cache: false,
          timeout: 30000,
          data : form_data,
          dataType: 'json',
          beforeSend: function() {
           toastr.info('Memuat data ...');
          },
      });
      request.done(function(reply){
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply.status == 1){
          $('#attendance_table_div').fadeIn();
          $('#attendance_table_head').empty();
          $('#attendance_table_head').append('<th>Nama</th>                    <th>Nip</th>                    <th>Jabatan</th>');
          $.each(reply.calendar.date_list,function(calendar_key, calendar_item){
            $('#attendance_table_head').append('<th id="th-'+calendar_item.date+'">'+calendar_item.date.slice(-2)+'</th>');
            if(calendar_item.is_day_off == 1 || calendar_item.is_sunday == 1){
              $('#th-'+calendar_item.date).attr("class","bg-danger");
            }
            
          });

          $('#attendance_table_head').append('<th id="th-hadir">Kehadiran</th>');

          $('#attendance_table_body').empty();
          if($.isEmptyObject(reply.employee_list)){
            toastr.info('Tidak ditemukan record absensi pada tanggal tersebut');
          }else{
            $.each(reply.employee_list,function (employee_list_key,employee_list_item) {
              var total_in = 0;
              var att_td='';
              $.each(reply.calendar.date_list, function(date_key,date_item){
                var emp_name = '';
                if(employee_list_item.att[date_key] != null){
                  if(employee_list_item.att[date_key].code == 1){
                    total_in = total_in+1;
                    att_td = att_td+'<td class="text-center bg-'+employee_list_item.att[date_key].color+'">'+employee_list_item.att[date_key].code+'</td>';
                  }else{
                    if(employee_list_item.att[date_key].use_shift_color == 1){
                      att_td = att_td+'<td style="background-color: '+employee_list_item.att[date_key].sc_color+'" class="text-center">'+employee_list_item.att[date_key].code+'</td>';
                    }else{
                      att_td = att_td+'<td class="text-center bg-'+employee_list_item.att[date_key].color+'">'+employee_list_item.att[date_key].code+'</td>';
                    }
                  }
                }else{
                  att_td = att_td+'<td></td>';
                }
                
              });
              att_td = att_td+'<td class="text-center">'+total_in+'</td>';

              if(employee_list_item.backup != null){
                emp_name = employee_list_item.name+' (backup)';
              }else{
                emp_name = employee_list_item.name;
              }
              $('#attendance_table_body').append(
                '<tr>'+
                '<td class="pl-1 pr-3">'+emp_name+'</td>'+
                '<td class="px-1">'+employee_list_item.nip+'</td>'+
                '<td class="px-1">'+employee_list_item.position+'</td>'+
                att_td+
                '</tr>'
                );
            })
          }
        }
        
      });

  }

  function generateExcel() {
    if($('#choose_start').val() && $('#choose_end').val() && $('#choose_customer').val()){
      window.location = "<?=base_url()?>"+'attendance/data/generate/excel/'+$('#choose_customer').val()+'/'+$('#choose_start').val()+'/'+$('#choose_end').val();
    }else{
      toastr.error('Harap lengkapi pilihan');
    }
  }

  function generatePDF(argument) {
    if($('#choose_start').val() && $('#choose_end').val() && $('#choose_customer').val()){
      window.location = "<?=base_url()?>"+'attendance/data/generate/pdf/'+$('#choose_customer').val()+'/'+$('#choose_start').val()+'/'+$('#choose_end').val();
    }else{
      toastr.error('Harap lengkapi pilihan');
    }
  }
  
</script>
</body>
</html>
