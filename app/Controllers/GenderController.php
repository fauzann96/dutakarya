<?php

namespace App\Controllers;

class GenderController extends BaseController
{
    public function option(){
        $genderModel = new \App\Models\GenderModel();
        $data = $genderModel->select('id,name')->findAll();

        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
}