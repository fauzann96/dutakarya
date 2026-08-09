<?php

namespace App\Controllers;

class FcNewController extends BaseController
{
    public function newSubmit(){
        $employee = $this->employeeModel->find($this->request->getPost('emp_id'));
        $data = array(
            'username' => $this->request->getPost('username'),
            'name' => $employee['name'],
            'password' => $this->request->getPost('password'),
            'user_type_seq' => 3,
            'employee_seq' => $this->request->getPost('emp_id'),
            'entry_user_seq' =>session()->get('user_id'),
        );
        $insert = $this->userModel->insert($data);
        $reply=[];
        if($insert){
            $reply['status'] = 'success';
        }else{
            $reply['status'] = 'failed';
        }
        return $this->response->setJSON($reply);
    }
    public function checkUsername(){
        $username = $this->userModel->where('username',$this->getPost('username'))->find();
        if($username){
            $reply['is_exist'] = true;
        }else{
             $reply['is_exist'] = false;
        }
    }
    
}