<?php

namespace App\Controllers;

class CalendarManagerController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Calendar Manager']);
        session()->set(['active'=>'calendar_manager']);
    }
    public function index(): string
    {   
        session()->set(['active_sub'=>'calendar_manager']);
        $date1 = str_replace('-', '/', $this->latestLockDate());
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $viewdata['min_date'] = $tomorrow;

        return view('calendar_manager/calendar_manager_index',$viewdata);
    }

    public function dataTable(){
        $data = $this->calDayOffModel->
        select('tb_calendar_day_off.*,tp.name as tp_name')->join('tb_do_type tp','tp.id=type')->orderBy('date','DESC');

        if($this->request->getPost('filter_type') == 'name'){
            $this->calDayOffModel->like('tb_calendar_day_off.name',$this->request->getPost('filter_input'));
        }

        if($this->request->getPost('filter_type') == 'type'){
            $this->calDayOffModel->like('tb_calendar_day_off.type',$this->request->getPost('filter_selection'));
        }

        if($this->request->getPost('filter_type') == 'year'){
            $this->calDayOffModel->like('tb_calendar_day_off.date',$this->request->getPost('filter_input'));
        }


        $data = $data->find();
        foreach ($data as $key => $value) {
            $data[$key]['date_text'] = $this->dateTextIndo($value['date']);
        }
        $reply['data']=$data;
        $reply['status'] = 1;
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

    public function editSubmit(){
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
    public function deleteSubmit(){
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

}