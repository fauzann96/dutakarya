<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
  <title>PT DKS | Slip Gaji PDF</title>
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
  background-color: #04AA6D;
  color: white;
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
        <small style="float:right;">Slip gaji <?=$payslip['period']?></small>
      </td>
    </tr>
  </table>
  <div style="width: 100%;background-color: blue;height: 5px;"></div>
  <table class="no_padding" style="width:100%;">
    <tr>
      <td colspan=12>
        <table class="no_padding">
                    <tr>
                      <td style="width: 150px;">Nama</td>
                      <td><b><?=$payslip['name']?></b></td>
                    </tr>
                    <tr>
                      <td style="width: 150px;">NIP</td>
                      <td><b><?= $payslip['nip']?></b></td>
                    </tr>
                    <tr>
                      <td style="width: 150px;">Divisi/Jabatan</td>
                      <td><b><?= $payslip['position']?></b></td>
                    </tr>
                    <tr>
                      <td style="width: 150px;">Lokasi/Cabang</td>
                      <td><b><?= $payslip['customer']?></b></td>
                    </tr>

                  </table>
      </td>
      <td colspan=8>
        <div style="margin: 10px; border: 2px solid black; height: 80px; text-align: center;">
                    Ttd Karyawan
                  </div>
      </td>
    </tr>
  </table>
  <table class="no_padding" style="width:100%;">
    <tr>
      <td style="width:55%">
        <table class="no_padding bordered" style="width:100%">
                    <thead>
                    <tr>
                      <th style="text-align: center;" colspan="2">Penghasilan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td style="width:65%">Gaji Pokok</td>
                      <td class="currency"><b><?=$payslip['gaji_pokok']?></b></td>
                    </tr>
                    <tr>
                      <td>Transport</td>
                      <td class="currency"><b><?=$payslip['transport']?></b></td>
                    </tr>
                    <tr>
                      <td>Insentif</td>
                      <td class="currency"><b><?=$payslip['insentif']?></b></td>

                    </tr>
                    <tr>
                      <td>Lembur</td>
                      <td class="currency"><b><?=$payslip['lembur']?></b></td>
                    </tr>
                    <tr>
                      <td>Kelebihan Hari</td>
                      <td class="currency"><b><?=$payslip['kelebihan_hari']?></b></td>
                    </tr>
                    <tr>
                      <td>Tunjangan Shift</td>
                      <td class="currency"><b><?=$payslip['shift']?></b></td>
                    </tr>
                    <tr>
                      <td>Dinas Luar Kota</td>
                      <td class="currency"><b><?=$payslip['dinas_luar']?></b></td>
                    </tr>
                    <tr>
                      <td>Kelebihan Hari (<?=$payslip['prev_period']?>)</td>
                      <td class="currency"><b><?=$payslip['kelebihan_hari_m-1']?></b></td>
                    </tr>
                    </tbody>
                  </table>
      </td>
      <td style="width:45%">
        <table class="no_padding bordered" style="width:100%">
                    <thead>
                    <tr>
                      <th style="text-align: center;" colspan="2">Potongan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td style="width:55%">BPJS Tenaga Kerja</td>
                      <td class="currency"><b><?=$payslip['bpjs_tk']?></b></td>
                    </tr>
                    <tr>
                      <td>BPJS Kesehatan</td>
                      <td class="currency"><b><?=$payslip['bpjs_kes']?></b></td>
                    </tr>
                    <tr>
                      <td>BPJS Hari Tua</td>
                      <td class="currency"><b><?=$payslip['bpjs_ht']?></b></td>

                    </tr>
                    <tr>
                      <td>PPH 21</td>
                      <td class="currency"><b><?=$payslip['pph_21']?></b></td>
                    </tr>
                    <tr>
                      <td>Absensi</td>
                      <td class="currency"><b><?=$payslip['absensi']?></b></td>
                    </tr>
                    <tr>
                      <td>Payroll</td>
                      <td class="currency"><b><?=$payslip['payroll']?></b></td>
                    </tr>
                    <tr>
                      <td>MCU</td>
                      <td class="currency"><b><?=$payslip['mcu']?></b></td>
                    </tr>
                    <tr>
                      <td>Pinjaman SPH</td>
                      <td class="currency"><b><?=$payslip['pinjaman']?></b></td>
                    </tr>
                    </tbody>
                  </table>
      </td>
    </tr>
  </table>
  <table style="width:100%">
    <tr>
      <td style="width:50%;text-align: center;">
         <div style="margin: 10px; height: 50px;">
                    Surabaya, <?= $export_date?></br>
<img src="<?=$sign_img?>" style="height: 80px;position: relative;top:-10px">
          </div>
                  <u><?= $current_user ?></u></br>
                  <?= $user_type?>
      </td>
      <td style="width:50%;vertical-align: top;">
        <table style="width: 100%;" class="no_padding bordered">
                      <tr>
                        <td style="width:50%">Penghasilan :</td>
                        <td class="currency"><b><?=$payslip['total_penghasilan']?></b></td>
                      </tr>
                      <tr>
                        <td>Potongan</td>
                        <td class="currency"><b><?=$payslip['total_potongan']?></b></td>
                      </tr>
                      <tr>
                        <td>Penghasilan Bersih</td>
                        <td class="currency"><b><?=$payslip['netto']?></b></td>
                      </tr>
                    </table>
      </td>
    </tr>
    
  </table>

<!-- Page specific script -->
<script>
  //window.addEventListener("load", window.print());
</script>
</body>
</html>
