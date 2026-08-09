<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT DKS | Data Absensi</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('/plugins/fontawesome-free/css/all.min.css')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('/plugins/select2/css/select2.min.css')?>">
  <link rel="stylesheet" href="<?= base_url('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('/dist/css/adminlte.min.css')?>">
  <style type="text/css">
    .table-css{
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
       overflow-y: scroll;
      border: 1px solid black;
    }
    th,td{
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){
      background-color: #f2f2f2;
    }
    tr:hover{
      background-color: #d7cfb2;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?=$this->include('preloader');?>
  <?=$this->include('navbar_lte');?>
  <?=$this->include(session()->get('sidebar'))?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Absensi <?= $working_unit['name']?></h1>
            <h5><?= $start_date.' - '.$end_date?></h5>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-body" style="overflow-x: auto;">
                <table class="table-css">
                    <tr>
                      <th style="text-align: center;">Nama</th>
                      <th style="text-align: center;">NPK</th>
                      <th style="text-align: center;">Posisi</th>
                      <?php foreach ($date_list as $key => $dt) {
                        if($dt['is_sunday'] || $dt['is_day_off']){echo '<td class="bg-danger" style="text-align: center;">'.substr($dt['date'],8).'</td>';}else{
                          echo '<td style="text-align: center;">'.substr($dt['date'],8).'</td>';
                        }
                      }?>
                      <th style="text-align: center;">Ijin</th>
                      <th style="text-align: center;">Sakit</th>
                      <th style="text-align: center;">Alpha</th>
                      <th style="text-align: center;">Total</th>
                      <th style="text-align: center;">Efektif</th>
                      <th style="text-align: center;">Lembur</th>
                    </tr>
                    <?php foreach ($positions as $key => $value) {?>
                    <?php
                  foreach( $value['pos_emp'] as $emp_key => $emp){?>
                    <tr>
                      <td style="white-space: nowrap;"><?=$emp['name']?><?php if($emp['backup_assignment_seq']){echo'(backup)';}?></td>
                      <td style="text-align: center;"><?=$emp['npk']?></td>
                      <td style="white-space: nowrap;text-align: center;"><?=$emp['pos_name']?></td>
                      <?php 
                      foreach($emp['att'] as $attKey => $att){?><td class="<?php if(($date_list[$attKey]['is_sunday'] && !$att) || ($date_list[$attKey]['is_day_off'] && !$att)){echo 'bg-danger';}elseif($att){echo 'bg-'.$att['color'];} ?> disabled" style="text-align:center;"><b><?php
                        if($att){echo $att['type_code'];}else{echo '-';}?></b>
                      </td>
                    <?php }?>
                      <td style="text-align: center;"><?= $emp['att_summary'][8]?></td>
                      <td style="text-align: center;"><?= $emp['att_summary'][3]?></td>
                      <td style="text-align: center;"><?= $emp['att_summary'][4]?></td>
                      <td style="text-align: center;"><?= ($emp['att_summary'][1]+$emp['att_summary'][6])?></td>
                      <td style="text-align: center;"><?= $emp['att_summary'][1]?></td>
                      <td style="text-align: center;"><?= $emp['att_summary'][6]?></td>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php } ?>
                </table>
                <?php if(!$positions) {echo 'data tidak ditemukan';}?>
              </div>
              
              <!-- /.card-body -->
              <div class="card-footer">
                <a href="<?=base_url('/korlap/attendance/report/pdf/').$date_start_date.'/'.$date_end_date?>"><button type="submit" class="btn btn-primary float-right"><i class="fas fa-download"></i> Cetak</button></a>
              </div>
            </div><!-- /.card -->
            <div class="card">
              <div class="card-header">
                Keterangan
              </div>
              <div class="card-body row">
                <div class="col-sm-3">
                  <table class="table table-sm">
                    <tr>
                      <th>Kode</th>
                      <th>Keterangan</th>
                    </tr>
                    <?php 
                    foreach ($att_type as $key => $value) { 
                      ?>
                    <tr>
                      <td><?=$value['code']?></td>
                      <td class="bg-<?=$value['color']?>"><?=$value['name']?></td>
                    </tr>
                      <?php
                    } 
                    ?>
                  </table>
                </div>
                <div class="col-sm-3">
                  <table class="table table-sm">
                    <tr>
                      <th>Tanggal</th>
                      <th>Keterangan</th>
                    </tr>
                    <?php 
                    foreach ($day_off as $key => $value) { 
                      ?>
                    <tr class="bg-danger disabled">
                      <td><?=$value['date']?></td>
                      <td><?=$value['name']?></td>
                    </tr>
                      <?php
                    } 
                    ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
<!-- AdminLTE App -->
<script src="<?= base_url('/dist/js/adminlte.min.js')?>"></script>
<!-- Select2 -->
<script src="<?= base_url('/plugins/select2/js/select2.full.min.js')?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('/plugins/jquery-validation/jquery.validate.min.js')?>"></script>
<script src="<?= base_url('/plugins/jquery-validation/additional-methods.min.js')?>"></script>
<script>
  let working_unit = $("#working_unit");
  let attendance_period = $("#attendance_period");
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();
        //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })


    $.validator.setDefaults({
      submitHandler: function () {
        submitForm();
      }
    });
    $('#choose_period').validate({
      rules: {
        working_unit: {
          required: true,
        },
        attendance_period: {
          required: true,
        },
      },
      messages: {
        working_unit:{
          required: "Harap isi pilih unit kerja"
        },
        attendance_period:{
          required: "Harap pilih periode",
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

  });

  function submitForm(){
    window.location = "<?= base_url('/attendance/data/')?>"+working_unit.val()+"/"+attendance_period.val();
  }
  
</script>
</body>
</html>
