<?php

namespace App\Controllers;

class LockController extends BaseController
{
    public function index(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        session()->set(['active'=>'lock']);
        session()->set(['active_sub'=>'lock']);
        return view('lock/lock_index');
    }

    public function datatable(){
        $data = $this->lockModel->select('tb_lock.*, usr.username')->join('tb_user usr','usr.id = entry_user_seq')->findAll();
        if($data){
            foreach ($data as $key => $value) {
                $data[$key]['date'] = $this->dateTextIndo($value['date']);
            }
        }
        $reply['data'] = $data;
        return $this->response->setJSON($reply);
    }
    public function checkDate(){
        $data = $this->lockModel->where('date >=',$this->request->getPost('new_date'))->first();
        if($data){
            echo 'false';
            //$reply['status'] = 1;
            //$reply['message'] = 'Tanggal '.$this->request->getPost('new_date').' sudah dikunci';
        }else{
            echo 'true';
            //$reply['status'] = 0;
        }
       // return $this->response->setJSON($reply);
    }
    public function newSubmit(){
        $data = [
            'date'=>$this->request->getPost('date'),
            'description'=>$this->request->getPost('description'),
            'entry_user_seq'=>session()->get('user_id')
        ];
        $insert = $this->lockModel->insert($data);
        if($insert){
            $reply['status'] = 1;
            $reply['date'] = $this->dateTextIndo($data['date']);
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
    public function editSubmit(){
        $data = [
            'date'=>$this->request->getPost('date'),
            'description'=>$this->request->getPost('description'),
            'entry_user_seq'=>session()->get('user_id')
        ];
        $update = $this->lockModel->update($this->request->getPost('id'),$data);
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
    public function data()
    {
        $data = $this->lockModel->find($this->request->getPost('id'));
        if($data){
            $reply['status'] = 1;
            $reply['data'] = $data;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
        
    public function getOptionAll()
    {
        $bankModel = new \App\Models\BankModel();
        $banks = $bankModel->select('id,name_abbr,name')->findAll();
        return $this->response->setJSON($banks);
    }
    
}