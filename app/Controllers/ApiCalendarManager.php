<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ApiCalendarManager extends BaseController
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

        $data = model('CalendarDayOffModel');
        $totalRecords = $data->countAllResults();
        $builder = $data
        ->select('tb_calendar_day_off.*, tp.name as tp_name')
        ->join('tb_do_type tp','tp.id=type');

        if (!empty($search)) {

            $builder->groupStart()
                ->like('tb_calendar_day_off.name', $search)
                ->orLike('tb_calendar_day_off.date', $search)
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
                "date" => $row['date'],
                "tp_name" => $row['tp_name'],
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
    public function data($id){
        $data = model('CalendarDayOffModel')->select('tb_calendar_day_off.*, tp.name as tp_name')
        ->join('tb_do_type tp','tp.id=type')
        ->where('tb_calendar_day_off.id',$id)->first();
        if($data){
            $reply['status'] = 1;
            $reply['data'] = $data;
        }else{
            $reply['status'] = 0;
            $reply['data'] = [];
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function doTypeOptions(){
        $data = model('DayOffTypeModel')->select('id,name')->findAll();
        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function newSubmit(){
        $data = [
            'name' => $this->request->getPost('name'),
            'date' => $this->request->getPost('date'),
            'type' => $this->request->getPost('type'),
            'created_by' => session()->get('user_id'),
        ];
        $insert = $this->calDayOffModel->insert($data);
        if($insert){
            $reply['status'] = 1;
            $reply['insert'] = $insert;
        }else{
            $reply['status'] = 0;
            $reply['insert'] = $insert;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function update(){
        $data = [
            'name' => $this->request->getPost('name'),
            'date' => $this->request->getPost('date'),
            'type' => $this->request->getPost('type'),
            'created_by' => session()->get('user_id'),
        ];
        $update = $this->calDayOffModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function delete(){
        $delete = $this->calDayOffModel->delete($this->request->getPost('id'));
        if($delete){
            $update = $this->calDayOffModel->set(['deleted_by'=>session()->get('user_id')])->where('id',$this->request->getPost('id'))->update();
            $reply['status'] = 1;
            $reply['data'] = $delete;
        }else{
            $reply['status'] = 0;
            $reply['data'] = $delete;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

        public function dayOffTypeOption(){
        $data = $this->dayOffTypeModel->select('id,name')->findAll();
        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

}
