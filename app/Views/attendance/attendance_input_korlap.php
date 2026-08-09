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
            <h1>Form Input Absensi</h1>
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
        <form id="form_choose" name="form_choose">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pilih Tanggal Absensi</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" id="choose_date" name="choose_date" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="choose_employee" class="col-sm-2 col-form-label">Tenaga Alih Daya</label>
                  <div class="col-sm-10">
                    <select id="choose_employee" name="choose_employee" class="form-control select2"> </select>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Tampilkan Form</button>
              </div>
            </div>
          </div>

        </form>
        
        <div class="col-12 col-sm-12" id="form_attendance_div">
          <form id="form_attendance" name="form_attendance" method="post">
            <div class="card">
              <div class="card-body" id="form_attendance_list">
       
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-success float-right">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <!--
          <div class="col-12 col-sm-12">
             <div class="card">
              <div class="card-body" id="attendance_form_list">
                <div class="form-group row">
                  <label for="choose_employee" class="col-12 col-sm-2">Tenaga Alih Daya</label>
                  <div class="col-12 col-sm-8 row justify-content-center">
                    <?php 
                    foreach ($att_type as $att_type_key => $att_type_value) { ?>
                      <div class="custom-control custom-checkbox col-12 col-sm-2">
                      <input class="custom-control-input custom-control-input-<?=$att_type_value['color']?>" type="radio" id="1_<?=$att_type_value['code']?>" name="1" <?php if($att_type_value['checked']){echo 'checked';}?>>
                      <label for="1_<?=$att_type_value['code']?>" class="custom-control-label"><?=$att_type_value['name']?></label>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                  <input type="text" class="form-control col-12 col-sm-2" name="">
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-info float-right">Tampilkan Form</button>
              </div>
            </div>
          </div>
        </div>-->
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
<?=$this->include('option/customer_employee_option');?>
<script>
  let working_unit = $("#working_unit");
  let attendance_date = $("#attendance_date");
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
        //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });

    loadAttendanceCustomerEmployeeOption($('#choose_employee'),<?=session()->get('customer')?>);

    $('#form_attendance_div').fadeOut();
    //validation end

  });

  var employeeList;
  $('#form_choose').validate({
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

        //$( "#attendance_form_list" ).append( $( list_format ) );
        
        var form_data = new FormData();
        form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
        form_data.append('date',$('#choose_date').val());
        form_data.append('employee',$('#choose_employee').val());
        let url="<?=base_url('korlap/attendance/input/form_data')?>";
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
            $('#form_attendance_div').fadeIn();
            $('#form_attendance_list').empty();

            var shiftOption = '';
            $.each(reply.shift_code, function(sc_index,sc_value){
              shiftOption=shiftOption+'<option value="'+sc_value.id+'"">'+sc_value.name+'</option>';
            });
            employeeList = reply.employee_data;
            $.each(reply.employee_data, function(employee_data_index, employee_data_item){
              var list_form = '<div class="form-group row">                 <label for="choose_employee" class="col-12 col-sm-2">'+employee_data_item.name+'</label>                  <div class="col-12 col-sm-8 row justify-content-center">                    <?php 
                    foreach ($att_type as $att_type_key => $att_type_value) { ?>
                      <div class="custom-control custom-checkbox col-12 col-sm-2">                      <input class="custom-control-input custom-control-input-<?=$att_type_value['color']?>" value="<?=$att_type_value['id']?>" type="radio" id="'+employee_data_item.id+'_<?=$att_type_value['code']?>" name="'+employee_data_item.id+'" backup="'+employee_data_item.backup+'" <?php if($att_type_value['checked']){echo 'checked';}?>>                      <label for="'+employee_data_item.id+'_<?=$att_type_value['code']?>" class="custom-control-label"><?=$att_type_value['name']?></label>                    </div>                    <?php
                    }
                    ?>
                  </div><select id="shift_code_'+employee_data_item.id+'" class="form-control col-12 col-sm-2 text-center">'+shiftOption+'</select></div>';
              $( "#form_attendance_list" ).append( $(list_form) );
            });
          }else{
            toastr.error('Gagal menambahkan penugasan backup');
          }
        });
        request.fail(function( jqXHR, textStatus ) {
          toastr.error( "Request failed: " + textStatus );
        });
      }
    });

  $("#form_attendance").submit(function(e){
    e.preventDefault();
    var attendance_form_data = [];
    $.each(employeeList, function(employeeList_index, employeeList_item){
      //
      var each_data = {employee_id : employeeList_item.id,
                      employee_attendance_type : $("input[name="+employeeList_item.id+"]:checked").val(),
                      employee_backup_assignment : $("input[name="+employeeList_item.id+"]:checked").attr("backup"),
                      employee_shift_code : $("#shift_code_"+employeeList_item.id).val(),
                    };
                      attendance_form_data.push(each_data);
    });

    let url="<?=base_url('korlap/attendance/input/submit')?>";
        var request = $.ajax({
          method: "POST",
          timeout: 30000,
          url: url,
          data: {
            ['<?=csrf_token()?>'] : $('#<?=csrf_token()?>').val(),
            'attendance_form_data' : attendance_form_data,
            'attendance_date' : $('#choose_date').val(),
          },
          dataType: 'json',
        });
    request.done(function( reply ) {
        $('#<?=csrf_token()?>').val(reply['new_csrf']);
        if(reply['status'] == 1 ){
          toastr.success('Absensi berhasil diinput');
          $('#form_attendance_list').empty();
          $('#form_attendance_div').fadeOut();
        }else{
          toastr.error('Gagal menyimpan absensi');
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        toastr.error( "Request failed: " + textStatus );
      });
  })

</script>
</body>
</html>
