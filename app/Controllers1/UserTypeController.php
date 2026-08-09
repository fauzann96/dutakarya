<?php

namespace App\Controllers;

class UserTypeController extends BaseController
{
	public function option()
    {
        $data = $this->userTypeModel->select('id,name')->find();
        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
}