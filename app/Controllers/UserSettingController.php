<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

class UserSettingController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Pengaturan User']);
        session()->set(['active'=>'Pengaturan User']);
        $this->areaModel = new \App\Models\AreaModel();
        $this->customerModel = new \App\Models\CustomerModel();
    }
    public function index(): string
    {
        session()->set(['active_sub'=>'Pengaturan User']);
        $viewdata['user'] = $this->userModel->find(session()->get('user_id'));

        return view('user_setting/index',$viewdata);
    }
    

}