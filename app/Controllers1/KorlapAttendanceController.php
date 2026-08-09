<?php

namespace App\Controllers;

class KorlapAttendanceController extends BaseController
{
    public function inputStart()
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $input_user_id = session()->get('user_data')['user_id'];
        echo $input_user_id;
        
        $viewdata['active'] = 'attendance';
        $viewdata['active_sub'] = 'attendance_input';
        
        //print_r($viewdata['wu_option']);
        //$view = view('attendance_input_start',$viewdata);
        //return $view;
    }
        
    public function getOptionAll()
    {
        $bankModel = new \App\Models\BankModel();
        $banks = $bankModel->select('id,name_abbr,name')->findAll();
        return $this->response->setJSON($banks);
    }
    
}