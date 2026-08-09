<?php

namespace App\Controllers;

class FcEditController extends BaseController
{
    public function getData()
    {
        $reply['fc_data'] = $this->userModel->find($this->request->getPost('id'));

        if($reply['fc_data']){
            $reply['status'] = 'success';
        }else{
            $reply['status'] = 'fail';
        }
        return $this->response->setJSON($reply);
    }
    public function submit(){
        $data = array(
            'username' => $this->request->getPost('username'),
            'status' => $this->request->getPost('status')
        );
        $update = $this->userModel->set($data)->where('id',$this->request->getPost('user_id'))->update();
        $reply=[];
        if($update){
            $reply['status'] = 'success';
        }else{
            $reply['status'] = 'failed';
        }
        return $this->response->setJSON($reply);
    }
    
}