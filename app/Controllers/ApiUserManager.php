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

        public function datataqbles()
    {
        $request = service('request');

        $draw   = $request->getPost('draw');
        $start  = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'];
        $orderColumnIndex = $this->request->getPost('order')[0]['column']; 
        $orderDir = $this->request->getPost('order')[0]['dir']; 
        $orderColumnName = $this->request->getPost('columns')[$orderColumnIndex]['name'];
        
        $model = model('User');
        $builder = $model
            ->select('users.*');

        if (!empty($search)) {

            $builder->groupStart()
                ->like('users.name', $search)
                ->orLike('users.email', $search)
                ->groupEnd();
        }

        $recordsFiltered = clone $builder;

        $totalFiltered = $builder->countAllResults(false);

        if (!empty($orderColumnName) && $orderColumnName !== 'no') {
            $builder->orderBy($orderColumnName, $orderDir);
        }
        $records = $builder          
            ->findAll($length, $start);

        $totalRecords = model('User')->countAll();

        $data = [];

        foreach ($records as $row){

            $data[] = [

                "id" => $row['id'],
                "name" => $row['name'],
                "email" => $row['email'],
                "role" => $row['role'] ?: 'not implemented',
                "status" => $row['status'] ?: 'ACTIVE',

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
}
