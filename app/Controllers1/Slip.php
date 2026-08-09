<?php

namespace App\Controllers;

class Slip extends BaseController
{
    public function form_slip(): string{
        $user['id'] = "10";
        $user['name'] = "Ahmad";

        $form_data['current_period']=$this->tgl_indo(date('Y-m'));

        $viewdata['current_user'] = $user;
        $viewdata['form_data']= $form_data;
        $viewdata['active'] = 'gaji';
        return view('form_slip',$viewdata);

    }
    public function print_slip(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['nama'] = 'Udi Yanto';
        $viewdata['npk'] = '13663';
        $viewdata['divisi'] = 'Driver';
        $viewdata['lokasi'] = 'PT Cikarang Listrindo Tbk';
        $viewdata['periode_slip'] = 'November 2023';
        $viewdata['gaji_pokok'] = '5.137.575';
        $viewdata['transport'] = '0';
        $viewdata['insentif'] ='0';
        $viewdata['jam_lembur'] = '204';
        $viewdata['lembur'] = '13.690.301';
        $viewdata['kelebihan_hari'] = '0';
        $viewdata['tunjangan_shift'] = '0';
        $viewdata['dinas_luar'] = '140.000';
        $viewdata['kelebihan_hari_m1'] = '0';
        $viewdata['nama_m1'] = 'OKTOBER';
        $viewdata['total_penghasilan'] = '19.267.876';

        $viewdata['bpjs_tk'] = '102.752';
        $viewdata['bpjs_kes'] = '51.376';
        $viewdata['bpjs_pensiun'] = '51.376';
        $viewdata['pph21'] = '1.658.315';
        $viewdata['absensi'] = '0';
        $viewdata['payroll'] = '10.000';
        $viewdata['mcu'] = '0';
        $viewdata['pinjaman'] = '0';
        $viewdata['total_potongan'] = '1.873.818';
        $viewdata['gaji_bersih'] = '17.394.058';

        $viewdata['nama_admin'] = 'Ibnu Mujahid';
        $viewdata['nama_perusahaan'] = 'PT DUTA KARYA SINERGI';
        
        return view('print_slip',$viewdata);
    }
    private function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $bulan[ (int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}