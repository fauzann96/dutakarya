<?php

namespace App\Controllers;

class MarritalStatusController extends BaseController
{
    public function option()
    {
        $msModel = new \App\Models\MarritalStatusModel();

        $data = $msModel->select('id,name')->findAll();
        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
}