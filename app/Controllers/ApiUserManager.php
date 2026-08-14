<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ApiUserManager extends BaseController
{
    public function dataTable(){
        $data = $this->userModel
        ->select('tb_user.*, type.name as user_type')
        ->join('tb_user_type type','type.id = user_type_seq','left')
        ->findAll();

        if($data){
            $reply['status'] = 1;
            $reply['data'] = $data;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
}
