<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ApiUserManager extends BaseController
{
    public function dataTable(){
        $request = service('request');
        $draw   = $request->getPost('draw');
        $start  = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'];
        $orderColumnIndex = $request->getPost('order')[0]['column']; 
        $orderDir = $request->getPost('order')[0]['dir']; 
        $orderColumnName = $request->getPost('columns')[$orderColumnIndex]['name'];

        $data = model('UserModel');
        $totalRecords = $data->countAll();
        $builder = $data
        ->select('tb_user.*, type.name as type_name')
        ->join('tb_user_type type','type.id = user_type_seq','left');

        if (!empty($search)) {

            $builder->groupStart()
                ->like('users.name', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        $recordsFiltered = clone $builder;
        $totalFiltered = $builder->countAllResults(false);

        if (!empty($orderColumnName) && $orderColumnName !== 'no') {
            $builder->orderBy($orderColumnName, $orderDir);
        }

        $records = $builder->findAll($length, $start);

        $data = [];

        foreach ($records as $row){

            $data[] = [

                "id" => $row['id'],
                "username" => $row['username'],
                "name" => $row['name'],
                "status" => $row['status'],
                "type_name" => $row['type_name'],
                "status" => $row['status'],
            ];
        }

        return $this->response->setJSON([

            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
            'token' => csrf_hash()
        ]);
    }

    public function changeStatus()
    {
        $request = service('request');
        $id = $request->getPost('id');
        $status = $request->getPost('status');

        $userModel = model('UserModel');
        $user = $userModel->find($id);

        if ($user) {
            $user['status'] = $status;
            if ($userModel->save($user)) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status berhasil diubah.',
                    'token' => csrf_hash()
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengubah status.',
                    'token' => csrf_hash()
                ]);
            }
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan.',
                'token' => csrf_hash()
            ]);
        }
    }

    public function resetPassword(){
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

    public function checkUsername(){
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

    public function userData($id)
    {
        $user = $this->userModel->find($id);
        if ($user) {
            return $this->response->setJSON([
                'success' => true,
                'data' => $user,
                'token' => csrf_hash()
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Pengguna tidak ditemukan.',
                'token' => csrf_hash()
            ]);
        }
    }
}
