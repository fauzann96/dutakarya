<?php

namespace App\Controllers;

class FCController extends BaseController
{

    public function index(): string
    {
        session()->set(['active'=>'fc_manager']);
        session()->set(['active_sub'=>'fc_manager']);
        return view('fc_manager/fc_manager_index');
    }

    public function dataTable(){
        $data = $this->employeeModel
        ->select('tb_employee.id, tb_employee.name, tb_employee.nip, cust.name as customer_name')
        ->join('tb_customer cust','cust.emp_fc_seq = tb_employee.id')
        ->find();

        $reply['data']=$data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function resetPassword(){
        $data = [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['data'] = $data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function data()
    {
        $reply['data'] = $this->userModel->find($this->request->getPost('id'));

        if($reply['data']){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }

    public function editSubmit()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'status' => $this->request->getPost('status'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $update = $this->userModel->set($data)->where('id',$this->request->getPost('id'))->update();
        $reply=[];
        if($update){
            $reply['status'] = 1;
            $reply['message'] = "Berhasil mengupdate";
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
        // code...
    }

    public function checkUsername(){
        $users = $this->userModel->where('username',$this->request->getPost('username'))->first();
        $edt_id = $this->request->getPost('id');
        if($users){
            if($users['id'] == $edt_id){
               $data = "true"; 
           }else{
            $data = "false";
            }
        }else{
            $data = "true";
        }
        return $this->response->setJSON($data);
    }

}