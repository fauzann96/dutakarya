<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT DKS | Report Absensi <?=$working_unit['name']?></title>
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
      <td style="width:100px">Perusahaan</td>
      <td>: <?=$working_unit['name']?></td>
    </tr>
    <tr>
      <td>Periode</td>
      <td>: <?=$start_date.' - '.$end_date?></td>
    </tr>
  </table>
  <h3>Absensi</h3>
  <table class="table-css" style="width: 100%; margin-top: 10px; font-size: 11px;
">
                    <tr>
                      <th style="width: 60px">Nama</th>
          <th style="text-align:center; width: 30px;">NPK</th>
          <th style="text-align:center; width: 30px">Posisi</th>
                      <?php foreach ($date_list as $key => $dt) {
                        if($dt['is_sunday'] || $dt['is_day_off']){echo '<td class="bg-danger" style="text-align: center; width:20px">'.substr($dt['date'],8).'</td>';}else{
                          echo '<td style="text-align: center;width:20px">'.substr($dt['date'],8).'</td>';
                        }
                      }?>
                    </tr>
                    <?php foreach ($positions as $key => $value) {?>
                    <?php
                  foreach( $value['pos_emp'] as $emp_key => $emp){?>
                    <tr>
                      <td style="white-space: nowrap;"><?=$emp['name']?><?php if($emp['backup_assignment_seq']){echo' (backup)';}?></td>
                      <td style="text-align: center;"><?=$emp['npk']?></td>
                      <td style="white-space: nowrap;text-align: center;"><?=$emp['pos_name']?></td>
                      <?php 
                      foreach($emp['att'] as $attKey => $att){?><td class="<?php if($date_list[$attKey]['is_sunday'] || $date_list[$attKey]['is_day_off']){echo 'bg-danger';}?> disabled" style="text-align:center;"><?php
                        if($att){echo $att['type_code'];}else{echo '-';}?>
                      </td>
                    <?php }?>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php } ?>
                </table>
                <?php if(!$positions) {echo 'data tidak ditemukan';}?>

   <h3>Rangkuman</h3>
  <table class="table-css" style="margin-top: 10px; font-size: 12px;">
   
        <tr>
          <th style="width: 100px">Nama</th>
          <th style="text-align:center; width: 60px;">NPK</th>
          <th style="text-align:center; width: 60px">Posisi</th>
          <th style="text-align: center; width: 60px">Ijin</div></th>
          <th style="text-align: center; width: 60px">Sakit</th>
          <th style="text-align: center;width: 60px">Alpha</th>
          <th style="text-align: center; width: 60px">Total</th>
          <th style="text-align: center; width: 60px">Efektif</th>
          <th style="text-align: center; width: 60px">Lembur</th>
        </tr>
        <?php foreach ($positions as $key => $value) {?>
                    <?php
                  foreach( $value['pos_emp'] as $emp_key => $emp){?>
                    <tr>
                      <td style="white-space: nowrap;"><?=$emp['name']?><?php if($emp['backup_assignment_seq']){echo'(backup)';}?></td>
                      <td style="text-align: center;"><?=$emp['npk']?></td>
                      <td style="white-space: nowrap;text-align: center;"><?=$emp['pos_name']?></td>
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
 <table>
    </tr>
    <tr>
      <td style="width:50%;text-align: center;">
         <div style="margin: 10px; height: 50px;">
                    Surabaya, <?= $export_date?></br>
<img src="<?=$sign_img?>" style="height: 80px;position: relative;top:-10px">
          </div>
                  <u><?=$user['name']?></u></br>
                 
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
