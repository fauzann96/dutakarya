<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ApiArea extends BaseController
{
    public function dataTa1ble()//yg bukan internal 
    {
        $data = $this->areaModel->find();//yg non editable punya sistem
        $reply=[];
        $reply['new_csrf']=csrf_hash();
        if($data){
            $reply['data'] = $data;
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function dataTable(){
        $request = service('request');
        $draw   = $request->getPost('draw');
        $start  = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'];
        $orderColumnIndex = $request->getPost('order')[0]['column']; 
        $orderDir = $request->getPost('order')[0]['dir']; 
        $orderColumnName = $request->getPost('columns')[$orderColumnIndex]['name'];

        $data = model('AreaModel');
        $totalRecords = $data->countAllResults();
        $builder = $data
        ->select('*');

        if (!empty($search)) {

            $builder->groupStart()
                ->like('tb_area.name', $search)
                ->orLike('tb_area.description', $search)
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
                "name" => $row['name'],
                "description" => $row['description'],
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
    public function create()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('desc'),
            'created_by' => session()->get('user_id'),
            'is_company_area' => false,
        ];

        $insert = $this->areaModel->insert($data);
        $reply = [];
        $reply['new_csrf']=csrf_hash();
        if($insert){
            $reply['status'] = 1;
            $reply['message'] = 'Area '.$data['name'].' berhasil disimpan';
        }else{
            $reply['status'] = 0;
            $reply['message'] = 'Area '.$data['name'].' gagal disimpan';
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
        // code...
    }
    public function delete()
    {
        $delete = $this->areaModel->where('id',$this->request->getPost('id'))->delete();
        $reply=[];
        $reply['new_csrf']=csrf_hash();
        if($delete){
            $update = $this->areaModel->set(['deleted_by'=>session()->get('user_id')])->where('id',$this->request->getPost('id'))->withDeleted()->update();
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function update(){//terpakai
        $data=[
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('desc'),
        ];
        $update = $this->areaModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
            $reply['message'] = 'Perubahan berhasil disimpan';
            $reply['update'] = $data;
        }else{
            $reply['status'] = 0;
            $reply['message'] = 'Perubahan gagal disimpan';
        }
        return $this->response->setJSON($reply);
    }
}
