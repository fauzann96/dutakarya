<!DOCTYPE html>
<html lang="en">
<head>
   <?=$this->include('meta')?>
  <style type="text/css">
 body{
  line-height: 1;
 }
 .no_padding td, .no_padding th{
  padding: 0;
 }

table{
  border-collapse: collapse;;
 }
.bordered td, .bordered th {
  border: 1px solid black;
}
table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  text-align: left;
  background-color: #d6cf80;
}
.table-css, .table-css td, .table-css th{
  border: 1px solid;
}
.vertical div {
  writing-mode: vertical-lr;
  display: inline-block;
  height: 60px;
  width: 15px;
  margin: 0px;
}

.currency { 
    text-align: right; /* Align the value to the righthand side of the cell */
}
.currency::before { 
    content: "Rp"; /* Set the currency symbol */
    float: left; /* Align symbol to the left */
    margin-left: 2mm; /* Add space before the symbol */
}
.currency::after { 
    content: ",00"; /* Set the currency symbol */
    float: right; /* Align symbol to the left */
    margin-right: 2mm; /* Add space before the symbol */
}
.bg-danger{
  background-color: #ff2e2e;
}
  </style>
</head>
<body>
  <table class="no_padding" style="width:100%;">
    <tr>
      <td colspan=10 style="font-size: 20px; vertical-align:middle;">
            <h4 style="margin:0;"><img src="<?=$company_img?>" alt="CompanyLogo" style="opacity: 1; height: 35px;">
            PT Duta Karya Sinergi</h4>
      </td>
      <td colspan=10>
        <small style="float:right;">Report Absensi</small>
      </td>
    </tr>
  </table>
  <div style="width: 100%;background-color: blue;height: 5px;"></div>
  <table style="margin-top:10px">
    <tr>
      <td style="width:100px">Customer</td>
      <td>: <?=$customer['name']?></td>
    </tr>
    <tr>
      <td>Periode</td>
      <td>: <?=$start_date.' - '.$end_date?></td>
    </tr>
    <tr>
      <td>Korlap</td>
      <td>: <?=session()->get('name')?> (<?=session()->get('nip')?>)</td>
    </tr>
  </table>
  <h3>Absensi</h3>
  <table class="table-css" style="width: 100%; margin-top: 10px; font-size: 11px;">
    <tr>
      <th style="width: 60px">Nama</th>
      <th style="text-align:center; width: 30px;">NIP</th>
      <th style="text-align:center; width: 30px">Jabatan</th>
        <?php foreach ($date_list as $date_list_key => $date_list_value) { ?>
          <?php if($date_list_value['is_sunday'] || $date_list_value['is_day_off']){ ?>
            <th class="bg-danger" style="text-align: center; width:20px"><?=substr($date_list_value['date'],8)?></th>
          <?php }else{ ?>
            <th style="text-align: center;width:20px"><?=substr($date_list_value['date'],8)?></th>
          <?php } ?>
        <?php } ?>
        <th style="text-align:center; width: 20px">Kehadiran</th>
    </tr>
      <?php foreach ($employee_list as $employee_list_key => $employee_list_value) { ?>
    <tr>
        <?php if($employee_list_value['backup']!=null){ ?>
        <td><?=$employee_list_value['name']?> (backup)</td>
        <?php }else{ ?>
        <td><?=$employee_list_value['name']?></td>
        <?php } ?>
        <td style="text-align: center"><?=$employee_list_value['nip']?></td>
        <td><?=$employee_list_value['position']?></td>
        <?php $total_in = 0; ?>
        <?php foreach ($employee_list_value['att'] as $emp_list_att_key => $emp_list_att_value) { ?>
          <?php if($emp_list_att_value != null){ ?>
            <?php if($emp_list_att_value['code'] == 1){ ?>
              <?php $total_in++; ?>
            <td style="text-align: center;background-color: #28a745"><?=$emp_list_att_value['code']?></td>
            <?php }else{ ?>
              <?php if($emp_list_att_value['use_shift_color'] == 1){ ?>
            <td style="text-align: center;background-color:<?=$emp_list_att_value['sc_color']?>"><?=$emp_list_att_value['code']?></td>
              <?php }else{ ?>
            <td style="text-align: center;background-color:#17a2b8"><?=$emp_list_att_value['code']?></td>
              <?php } ?>
            <?php } ?>
          <?php }else{ ?>
            <td style="text-align: center">-</td>
          <?php } ?>
        <?php } ?>
        <td style="text-align: center;"><?=$total_in?></td>
    </tr>
      <?php } ?>

  </table>
  <div style="display: flex;">
  <table class="table-css" style="width: 20%; margin-top: 10px; font-size: 11px; float: left;">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($att_type as $att_type_key => $att_type_value) { ?>
      <tr>
        <td style="text-align: center"><?= $att_type_value['code']?></td>
        <td><?= $att_type_value['name']?></td>
      </tr>
        
      <?php } ?>
    </tbody>
  </table>
  <table class="table-css" style="width: 20%; margin-top: 10px; font-size: 11px; margin-left: 25%;">
    <thead>
      <tr>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($shift_code as $shift_code_key => $shift_code_value) { ?>
      <tr>
        <td style="text-align: center; background-color: <?= $shift_code_value['color']?> ;"><?= $shift_code_value['name']?></td>
      </tr>
        
      <?php } ?>
    </tbody>
  </table>
  </div>
  <table>
    <tr>
      <td style="width:50%;text-align: center;">
    
          
                 
      </td>
      <td style="width:50%;vertical-align: top;">

      </td>
    </tr>
  </table>

<!-- Page specific script -->
<script>
  //window.addEventListener("load", window.print());
</script>
</body>
</html>
