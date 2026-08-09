<?php

namespace App\Controllers;

class ErrorController extends BaseController
{
    public function viewRestricted()
    {
        $viewdata['active'] = '';
        $viewdata['active_sub'] = '';

        return view('error_access_restricted',$viewdata);
    }
        
    public function getOptionAll()
    {
        $bankModel = new \App\Models\BankModel();
        $banks = $bankModel->select('id,name_abbr,name')->findAll();
        return $this->response->setJSON($banks);
    }
    
}