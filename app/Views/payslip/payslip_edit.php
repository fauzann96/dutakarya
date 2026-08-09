<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT DKS | Edit Slip Gaji</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
   <style type="text/css">
    .currency {
      text-align: right;
    }

    input[type=number] {
      text-align: center;
    }
  </style>
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
            <h1>Edit Slip Gaji</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penggajian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <table>
                  <tr>
                    <th style="width: 140px;">Nama</th>
                    <td>: <?= $employee['name']?></td>
                  </tr>
                  <tr>
                    <th>No Karyawan</th>
                    <td>: <?= $employee['npk']?></td>
                  </tr>
                  <tr>
                    <th>Divisi/Jabatan</th>
                    <td>: <?= $employee['position_name']?></td>
                  </tr>
                  <tr>
                    <th>Lokasi/Cabang</th>
                    <td>: <?= $employee['working_unit_name']?></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6">
                <p class="float-right"><?= $payslip['period_name']?></p>
              </div>
            </div>
          </div>
        </div>
        <form id="payslip_form" name="payslip_form" method="post" action="" onsubmit="">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Data Slip Gaji</h3>
            <div class="card-tools">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Gaji Pokok</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="salary" name="salary" class="form-control currency" value="<?=$payslip['salary']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="resident_id">Transport</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="transport_allowance" name="transport_allowance" class="form-control currency" value="<?=$payslip['transport_allowance']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="gender">Insentif</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="incentive" name="incentive" class="form-control currency" value="<?=$payslip['incentive']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Insentif Kelebihan hari</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                          <input type="number" id="day_surplus" name="day_surplus" class="form-control currency" value="<?=$payslip['day_surplus']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">Hari</span>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" id="day_surplus_allowance" name="day_surplus_allowance" class="form-control currency" value="<?=$payslip['day_surplus_allowance']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Insentif Lembur</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                          <input type="number" id="overtime" name="overtime" class="form-control currency" value="<?=$payslip['overtime_hr']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">Jam</span>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" id="overtime_allowance" name="overtime_allowance" class="form-control currency" value="<?=$payslip['overtime_allowance']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Tunjagan Shift</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="shift_allowance" name="shift_allowance" class="form-control currency" value="<?=$payslip['shift_allowance']?>">
                      <div class="input-group-append" >
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Dinas Luar Kota</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="oot_allowance" name="oot_allowance" class="form-control currency" value="<?=$payslip['out_of_town_allowance']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Kelebihan Hari Desember</label>
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="input-group">
                          <input type="number" id="prev_day_surplus" name="prev_day_surplus" class="form-control currency" value="<?=$payslip['prev_day_surplus']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">Hari</span>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-9">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" id="prev_day_surplus_allowance" name="prev_day_surplus_allowance" class="form-control currency" value="<?=$payslip['prev_day_surplus_allowance']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-4">
                      <b>TOTAL PENGHASILAN</b>
                    </div>
                    <div class="col-sm-8">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" id="total_income" name="total_income" class="form-control currency" disabled value=10000 style="font-weight:bold;" value="<?=$payslip['total_income']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>   
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                    <label for="name">BPJS Ketenagakerjaan</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="bpjs_tk" name="bpjs_tk" class="form-control currency" value="<?=$payslip['bpjs_tk']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  <label for="resident_id">BPJS Kesehatan</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="bpjs_kes" name="bpjs_kes" class="form-control currency" value="<?=$payslip['bpjs_kes']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="gender">BPJS Pensiun</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="bpjs_pens" name="bpjs_pens" class="form-control currency" value="<?=$payslip['bpjs_pens']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">PPH 21</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="pph_21" name="pph_21" class="form-control currency" value="<?=$payslip['pph_21']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Absensi</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="absensi" name="absensi" class="form-control currency" value="<?=$payslip['absensi']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Payroll</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="payroll" name="payroll" class="form-control currency" value="<?=$payslip['payroll']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">MCU</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="mcu" name="mcu" class="form-control currency" value="<?=$payslip['mcu']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="birth">Pinjaman (SPH)</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="text" id="rental" name="rental" class="form-control currency" value="<?=$payslip['rental']?>">
                      <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-4">
                      <b>TOTAL POTONGAN</b>
                    </div>
                    <div class="col-sm-8">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" id="total_deduction" name="total_deduction" class="form-control currency" disabled style="font-weight:bold;" value="<?=$payslip['total_deductions']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-4">
                      <b>GAJI BERSIH</b>
                    </div>
                    <div class="col-sm-8">
                      <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                          </div>
                          <input type="text" id="net_salary" name="net_salary" class="form-control currency" disabled style="font-weight:bold;" value="<?=$payslip['net_income']?>">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success float-right">Simpan</button>
          </div>
        </div>
        <!-- /.card -->
        </form>
      </div>
      <!-- /.container-fluid -->
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
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>

<!-- Page specific script -->
<script>

$(function () {

$('.currency').keypress(function (e) {    
    var charCode = (e.which) ? e.which : event.keyCode    
    if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    return false;
});

$( ".currency" ).on( "focus", function() {
  if($(this).val() == 0){
    $(this).val('');
  }
});

$( ".currency" ).on( "focusout", function() {
  if($(this).val() == ''){
    $(this).val(0);
  }
});

$('.currency').change(function(){
  totalAll();
});

  $("form").submit(function(e){
    e.preventDefault();
    submitForm();
  });

  totalAll()
});

let salary = $("#salary");
let transport_allowance = $("#transport_allowance");
let incentive = $("#incentive");
let day_surplus = $("#day_surplus");
let day_surplus_allowance = $("#day_surplus_allowance");
let overtime = $("#overtime");
let overtime_allowance = $("#overtime_allowance");
let shift_allowance = $("#shift_allowance");
let oot_allowance = $("#oot_allowance");
let prev_day_surplus = $("#prev_day_surplus");
let prev_day_surplus_allowance = $("#prev_day_surplus_allowance");
let total_income = $("#total_income");

let bpjs_tk = $("#bpjs_tk");
let bpjs_kes = $("#bpjs_kes");
let bpjs_pens = $("#bpjs_pens");
let pph_21 = $("#pph_21");
let absensi = $("#absensi");
let payroll = $("#payroll");
let mcu = $("#mcu");
let rental = $("#rental");
let total_deduction = $("#total_deduction");

let net_salary = $("#net_salary");

function totalAll() {
  var penghasilan = 
  parseInt(salary.val())+parseInt(transport_allowance.val())+parseInt(incentive.val())+parseInt(day_surplus_allowance.val())+parseInt(overtime_allowance.val())+parseInt(shift_allowance.val())+parseInt(oot_allowance.val())+parseInt(prev_day_surplus_allowance.val());
  total_income.val(penghasilan);

  var potongan = parseInt(bpjs_tk.val())+parseInt(bpjs_kes.val())+parseInt(bpjs_pens.val())+parseInt(pph_21.val())+parseInt(absensi.val())+parseInt(payroll.val())+parseInt(mcu.val())+parseInt(rental.val());
  total_deduction.val(potongan);

  net_salary.val(penghasilan-potongan);
 // alert(5+salary.val());
}

function submitForm(){
  var url = '<?= base_url('payslip/edit/submit')?>';
  var formData = {
    payslip_id:<?=$payslip['id']?>,
    employee:<?= $employee['id']?>,
    working_unit:<?= $employee['wu_id']?>,
    period: "<?=$payslip['period']?>",
    salary : salary.val(),
    transport_allowance : transport_allowance.val(),
    incentive : incentive.val(),
    day_surplus : day_surplus.val(),
    day_surplus_allowance : day_surplus_allowance.val(),
    overtime :overtime.val(),
    overtime_allowance : overtime_allowance.val(),
    shift_allowance : shift_allowance.val(),
    oot_allowance:oot_allowance.val(),
    prev_day_surplus:prev_day_surplus.val(),
    prev_day_surplus_allowance:prev_day_surplus_allowance.val(),
    bpjs_tk:bpjs_tk.val(),
    bpjs_kes:bpjs_kes.val(),
    bpjs_pens:bpjs_pens.val(),
    pph_21:pph_21.val(),
    absensi:absensi.val(),
    payroll:payroll.val(),
    mcu:mcu.val(),
    rental:rental.val(),
  };
  var request = $.ajax({
            method: "POST",
            url: url,
            data: formData,
          });
  request.done(function( reply ) {
              if(reply['status'] == "success"){
                alert( 'success :'+reply["message"] );
                window.location = "<?= base_url('/payslip/').$payslip['id']?>";
              }else{
                alert(reply["status"]+' : '+reply["message"]);
              }
            });
  request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
            });
}

</script>
</body>
</html>
