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
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
              <li class="breadcrumb-item active">Lamaran Kerja</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<form id="job_application_accept_form">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid text-sm">

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Informasi Pekerjaan</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="working_unit">Unit Kerja</label>
                  <select id="working_unit" name="working_unit" class="form-control select2bs4" style="width: 100%;">
                  </select>
                </div>
                <div class="form-group">
                  <label for="division">Divisi</label>
                  <select id="division" name="division" class="form-control select2bs4" style="width: 100%;">
                  </select>
                </div>
                <div class="form-group">
                  <label>Posisi</label>
                  <select id="position" name="position" class="form-control select2bs4" style="width: 100%;">
                  </select>
                </div>
                <div class="form-group">
                    <label for="npk">NPK</label>
                    <input id="npk" name="npk" type="text" class="form-control" placeholder="" onfocusout="checkNpk()">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="tax_number">NPWP</label>
                    <input id="tax_number" name="tax_number" type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                  <label for="health_insurance_number">BPJS Kesehatan</label>
                  <input id="health_insurance_number" name="health_insurance_number" type="text" class="form-control" id="resident_id" placeholder="">
                </div>
                <div class="form-group">
                  <label for="employee_insurance_number">BPJS Ketenagakerjaan</label>
                  <input id="employee_insurance_number" name="employee_insurance_number" type="text" class="form-control" id="resident_id" placeholder="">
                </div>
                <div class="form-group">
                  <label for="contract_number">No SPK</label>
                  <input id="contract_number" name="contract_number" type="text" class="form-control" id="resident_id" placeholder="" onfocusout="checkSpk()">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Informasi Karyawan</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input id="name" name="name" type="text" class="form-control" id="name" placeholder="">
                </div>
                <div class="form-group">
                  <label for="resident_id">NIK</label>
                  <input id="resident_id" name="resident_id" type="text" class="form-control" id="resident_id" placeholder="">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="gender" name="gender" class="form-control select2bs4 text-center" style="width: 100%;">
                    <option selected="true" disabled>--jenis kelamin--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="ttl">Tempat & Tanggal Lahir</label>
                  <input id="ttl" name="ttl" type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea id="address" name="address" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input id="phone" name="phone" type="text" class="form-control" id="resident_id" placeholder="">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input id="email" name="email" type="text" class="form-control" id="resident_id" placeholder="">
                </div>           
                <div class="form-group">
                  <label for="education">Pendidikan Terakhir</label>
                  <select id="education" name="education" class="form-control select2bs4 text-center" style="width: 100%;">
                    <option selected="selected">Alabama</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Surat Ijin Mengemudi</label>
                  <input id="driving_lisence" name="driving_lisence" class="form-control" style="width: 100%;">
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->
        <div class="card card-default collapsed-card">
          <div class="card-header">
            <h3 class="card-title">Informasi Keluarga</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="family_card_number">No KK</label>
                    <input id="family_card_number" name="family_card_number" type="text" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="mother_name">Nama Ibu Kandung</label>
                    <input id="mother_name" name="mother_name" type="text" class="form-control"  placeholder="">
                </div>
                <div class="form-group">
                  <label for="marrital_status">Status Pernikahan</label>
                  <select id="marrital_status" name="marrital_status" class="form-control select2bs4" style="width: 100%;">
                  </select>
                </div>
                <div class="form-group">
                    <label for="spouse_name">Nama Istri/Suami</label>
                    <input id="spouse_name" name="spouse_name" type="text" class="form-control"  placeholder="">
                </div>
                <div class="form-group">
                    <label for="spouse_job">Pekerjaan Istri/Suami</label>
                    <input id="spouse_job" name="spouse_job" type="text" class="form-control"  placeholder="">
                </div>
                
              </div>
              <div class="col-md-6">
                <label for="name">Anak</label>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="child_order">No #</label>
                        <input id="child_order" type="number" min="1" class="form-control text-center" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <label for="child_name">Nama</label>
                        <input id="child_name" type="text" class="form-control" placeholder="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="child_birth_date">Tanggal Lahir</label>
                        <input id="child_birth_date" type="date" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="child_gender">Jenis Kelamin</label>
                        <select id="child_gender" name="child_gender" class="form-control select2bs4 text-center" style="width: 100%;">
                          <option selected="true" disabled>--jenis kelamin--</option>
                        </select> 
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="child_action"></label>
                        <button id="btn_add_child" type="button" class="btn btn-block bg-gradient-primary btn-sm"><i class="fas fa-plus fa-fw"></i></button>
                        <button id="btn_save_child" type="button" class="btn btn-block bg-gradient-primary btn-sm"><i class="fas fa-check fa-fw"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <table id="children_table" class="table table-sm">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nama</th>
                      <th>L/P</th>
                      <th>Tgl Lahir</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
               <!--     <tr>
                      <td>1</td>
                      <td>Update software</td>
                      <td>L</td>
                      <td>
                        20/02/2024
                      </td>
                      <td><button class="btn btn-warning  btn-xs"><i class="fas fa-edit fa-fw"></i></button> <button class="btn btn-danger btn-xs"><i class="fas fa-trash fa-fw"></i></button></td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->
       
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-body">
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</form>
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
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<?=$this->include('jquery_option');?>
<!-- Page specific script -->
<script>
  $(function () {
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    loadWuOption($('#working_unit'));
    loadDivOption($('#division'),<?=$job_application['working_unit_seq']?>);
    loadPosOption($('#position'));
    loadGenderOption($('#gender'));
    loadGenderOption($('#child_gender'));
    loadEduOption($('#education'));
    loadSimOption($('#driving_lisence'));
    loadMarritalOption($('#marrital_status'));
    loadJobApplicationData();
/*
      loadJobApplicationData();
      refreshChildrenTable();*/
  })

$.validator.setDefaults({
    submitHandler: function () {
      submitForm();
      //alert( "Form successful submitted!" );
    }
  });
  $('#job_application_accept_form').validate({
    rules: {
      name: {
        required: true,
      },
      resident_id: {
        required: true,
        number: true,
      },
      family_card_number: {
        number: true,
      },
      ttl: {
        required: true,
      },
      address: {
        required: true,
      },
      phone: {
        required: true,
        number: true,
      },
      email: {
        required: true,
        email: true,
      },
      working_unit: {
        required: true,
      },
      division: {
        required: true,
      },
      position: {
        required: true,
      },
      contract_number: {
        required: true,
      },
      npk: {
        required: true,
        number: true,
        maxlength: 5,
        minlength: 5,
      },
      tax_number: {
        number: true,
      },
      health_insurance_number: {
        number: true,
      },
      employee_insurance_number: {
        number: true,
      },
    },
    messages: {
      name:{
        required: "Harap isi nama pelamar"
      },
      npk:{
        required: "Harap isi NPK",
        number: "Hanya angka",
      },
      resident_id:{
        required: "Harap isi nomor KTP",
        number: "Hanya angka",
      },
      gender:{
        required: "Harap pilih jenis kelamin",
      },
      birth_date:{
        required: "Harap isi tempat dan tanggal kelahiran",
      },
      address:{
        required: "Harap masukkan alamat tinggal",
      },
      phone:{
        required: "Harap masukkan nomor telepon",
        number: "Hanya angka",
      },
      email: {
        required: "Harap masukkan email",
        email: "Alamat email tidak valid"
      },
      working_unit:{
        required: "Harap pilih unit kerja",
      },
      position:{
        required: "Harap pilih posisi",
      },
      last_education:{
        required: "Harap pilih pendidikan terakhir",
      },
      contract_number:{
        required: "Harap isi nomor SPK",
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
    }
  });

  function checkNpk() {
    let url = "<?= base_url('employee/checkNpk')?>";
    var csrfName = '<?=csrf_token()?>';
    var request = $.ajax({
        method: "POST",
        url: url,
        data: {
          [csrfName] : '<?=csrf_hash()?>',
          npk : $("#npk").val(),
        },
      });
      request.done(function(reply){
        if(reply['status'] == "exist"){
          alert(reply['message']);
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        alert( "Tidak dapat memeriksa NPK");
      });
    // body...
  }
  function checkSpk() {
    let url = "<?= base_url('employee/checkSpk')?>";
    var csrfName = '<?=csrf_token()?>';
    var request = $.ajax({
        method: "POST",
        url: url,
        data: {
          [csrfName] : '<?=csrf_hash()?>',
          spk : $("#contract_number").val(),
        },
      });
      request.done(function(reply){
        if(reply['status'] == "exist"){
          alert(reply['message']);
        }
      });
      request.fail(function( jqXHR, textStatus ) {
        alert( "Tidak dapat memeriksa SPK");
      });
    // body...
  }
  //submit accepted applicant
  function submitForm(){
    var csrfName = '<?=csrf_token()?>';
    let formData = {
      [csrfName] : '<?=csrf_hash()?>',
      jobAppId : <?=$job_application['id']?>,
      name :$('#name').val(),
      resident_id : $('#resident_id').val(),
      npk: $('#npk').val(),
      gender : $('#gender').val(),
      ttl: $('#ttl').val(),  
      address : $('#address').val(),
      phone : $('#phone').val(),
      email : $('#email').val(),
      education : $('#education').val(),
      working_unit : $('#working_unit').val(),
      position :$('#position').val(),
      driving_lisence : $('#driving_lisence').val(),
      tax_number : $('#tax_number').val(),
      health_insurance_number : $('#health_insurance_number').val(),
      employee_insurance_number : $('#employee_insurance_number').val(),
      contract_number : $('#contract_number').val(),
      family_card_number : $('#family_card_number').val(),
      mother_name : $('#mother_name').val(),
      marrital_status : $('#marrital_status').val(),
      spouse_name : $('#spouse_name').val(),
      spouse_job : $('#spouse_job').val(),
      children : children,
      };
      //alert(formData);
      let url="<?=base_url('/job_application/accept/submit')?>";
      var request = $.ajax({
        method: "POST",
        url: url,
        data: formData,
      });
      request.done(function(reply){
        if(reply['status'] == "success"){
          alert("success : "+reply['message']);
          location.href = "<?=base_url('/employee')?>" ;
        }else{
          alert("fail"+reply['message']);
        }           
      });
      request.fail(function(xhr, status, error){
        var err = JSON.parse(xhr.responseText);
        alert(err.message);
      });
  };
  //submitAccepted end



  //load ja start
  function loadJobApplicationData(){
    let url="<?=base_url('/job_application/data/')?><?=$job_application_id?>";
    var request = $.ajax({
          method: "GET",
          url: url,
          async: false,
          //data: formData,
        });
          request.done(function( reply ) {
            if(reply['status'] == "success"){
              var app = reply['data'];
              $('#name').val(app["name"]);
              $('#position').val(app["position_seq"]);
              $('#working_unit').val(app["working_unit_seq"]);
              $('#gender').val(app["gender_seq"]);
              $('#ttl').val(app["ttl"]);
              $('#resident_id').val(app["resident_id"]);
              $('#address').val(app["address"]);
              $('#phone').val(app["phone"]);
              $('#email').val(app["email"]);
              $('#education').val(app["education"]);
              $('#driving_lisence').val(app["sim_manual"]);
              console.log('load form data done');
              //location.href = "<?=base_url('/job_application')?>" ;
            }else{
              alert(reply["message"]);
              //location.href = "<?=base_url('/job_application')?>"
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
          });
  }
  //load ja end

  //children table handler start
  let child_order = $('#child_order');
  let child_name = $('#child_name');
  let child_birth_date = $('#child_birth_date');
  let child_gender = $('#child_gender');
  var children=[];
  $("#btn_add_child").click(function(){
    console.log(child_gender.val());
    if (child_order.val() === ''){
      alert("Harap isi urutan anak");
    } else if(child_name.val() === ''){
      alert("Harap isi nama anak");
    } else if(child_birth_date.val() === ''){
      alert("Harap isi tanggal lahir anak");
    } else if(child_gender.val() === null){
      alert("Harap pilih jenis kelamin anak");
    } else{
      var child = {child_order: child_order.val(),
          child_name : child_name.val(),
          child_gender : child_gender.val(),
          child_birth_date : child_birth_date.val()};
      if(children.length != 0){
        var order_is_exist;
        var existing_order;
        $.each(children, function(key,field){
          if(field.child_order == child.child_order){
            order_is_exist = 1;
            existing_order = child.child_order;
          }
        });
        if(order_is_exist == 1){
          alert('Anak ke '+existing_order+' sudah ada');
        }else{
          children.push(child,);
          child_order.val('');
          child_name.val('');
          child_gender.val('');
          child_birth_date.val('');
        }
        order_is_exist = 0;
      }else{
        children.push(child);
        child_order.val('');
        child_name.val('');
        child_gender.val('');
        child_birth_date.val('');
      }
      refreshChildrenTable();
    }//end if
    
  });
  let currentKey ='';
  function showEditChild(e,key){
    e.preventDefault();
    $("#btn_save_child").show();
    $("#btn_add_child").hide();
    currentKey = key;
    child_order.val(children[key].child_order);
    child_name.val(children[key].child_name);
    child_gender.val(children[key].child_gender);
    child_birth_date.val(children[key].child_birth_date);

  }

  $("#btn_save_child").click(function(){

    children[currentKey].child_order = child_order.val();
    children[currentKey].child_name = child_name.val();
    children[currentKey].child_gender =  child_gender.val();
    children[currentKey].child_birth_date = child_birth_date.val();
    currentKey = '';
    child_order.val('');
          child_name.val('');
          child_gender.val('');
          child_birth_date.val('');
    refreshChildrenTable();
    $("#btn_save_child").hide();
    $("#btn_add_child").show();
  });

  function deleteChildren(e,key){
    e.preventDefault();
    children.splice(key,1);
    refreshChildrenTable();
  }

  function refreshChildrenTable() {
    $("#btn_save_child").hide();
    // body...
    let table=$('#children_table tr');
    table.not(':first').remove();
    let rows='';
      $.each(children, function(key, field){
        var genderText;
        if(field.child_gender == 1){
          genderText = "Laki-laki";
        }else{
          genderText = "Perempuan";
        }
        rows += 
        '<tr><td>' + field.child_order + '</td>'+
        '<td>' + field.child_name + '</td>'+
        '<td>' + genderText + '</td>'+
        '<td>' + field.child_birth_date + '</td>'+
        '<td><button class="btn btn-warning  btn-xs" onclick="showEditChild(event,'+key+');"><i class="fas fa-edit fa-fw"></i></button><button onclick="deleteChildren(event,'+key+');"><i class="fas fa-trash fa-fw"></i></button></td>'
        +'</tr>';
      });
      table.first().after(rows);
  }
  //children table hanldler end
</script>
</body>
</html>
