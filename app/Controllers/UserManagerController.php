<?php

namespace App\Controllers;

class UserManagerController extends BaseController
{
     public function __construct() {
        session()->set(['title'=>'User Manager']);
        session()->set(['active'=>'user_manager']);
    }
    public function index(): string
    {
        session()->set(['active_sub'=>'user_manager']);
        return view('user_manager/index');
    }
  
    public function check_username(){
        $users = $this->userModel->where('username',$this->request->getPost('new_username'))->first();
        $edit_id = $this->request->getPost('edit_id');
        if($users){
            if($users['id'] == $edit_id){
               $reply['data'] = 0; 
           }else{
            $reply['data'] = 1 ;
            }
        }else{
            $reply['data'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function newSubmit()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'user_type_seq' => $this->request->getPost('user_type'),
            'password' =>password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_by'=>session()->get('user_id'),
        ];
        $insert =  $this->userModel->insert($data);

        $reply = [];
        if($insert){
            $reply['status'] = 1;
            $reply['message'] = 'Pengguna baru berhasil dibuat';
        }else{
            $reply['status'] = 0;
            $reply['message'] = 'Pengguna baru gagal dibuat';
        }
        // code...
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function editSubmit()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'user_type_seq' => $this->request->getPost('user_type'),
        ];
        $update =  $this->userModel->set($data)->where('id',$this->request->getPost('id'))->update();

        $reply = [];
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        // code...
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function resetPasswordSubmit(){
        $data=[
        'password' =>password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $update = $this->userModel->set($data)->where('id',$this->request->getPost('id'))->update();
        $reply = [];
        if($update){
            $reply['status'] = 1;
            $reply['message'] = 'Password berhasil dirubah';
        }else{
            $reply['status'] = 0;
            $reply['message'] = 'Password gagal dirubah';
        }
        // code...
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

     public function toggleStatus()
    {

        $data = [
            'status' => $this->request->getPost('set_to'),
        ];
        if($this->request->getPost('id') != session()->get('user_id')){
            $update =  $this->userModel->set($data)->where('id',$this->request->getPost('id'))->update();
        }else{
            $update = false;
        }
        $reply = [];
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        // code...
        $reply['ad'] = session()->get('user_id');
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

}