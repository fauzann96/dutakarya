<?php

namespace App\Controllers;

class AreaController extends BaseController
{
    public $areaModel;
    public $customerModel;
    public function __construct() {
        session()->set(['title'=>'Area']);
        session()->set(['active'=>'Customer']);
        $this->areaModel = new \App\Models\AreaModel();
        $this->customerModel = new \App\Models\CustomerModel();
    }
    public function index(): string//terpakai
    {
        session()->set(['active_sub'=>'Area']); 
        return view('/area/index');;
    }
    public function view($id)//terpakai
    {
        $areaData = $this->areaModel->find($id);
        session()->set(['title'=>'Area '.$areaData['name']]);
        $viewdata['area'] = $this->areaModel->find($id);

        $viewdata['total_customer'] = $this->customerModel->where('area_seq',$id)->countAllResults();
        $viewdata['total_employee'] = $this->employeeModel
        ->join('tb_customer cust','cust.id = customer_seq')
        ->join('tb_area area','area.id = cust.area_seq')
        ->where('area_seq',$id)->countAllResults();
        $viewdata['total_customer'] = $this->customerModel->where('area_seq',$id)->countAllResults();
        if(!$viewdata['area']){
            return view('error_not_found');
        }else{
            return view('area/area_view_admin',$viewdata);
        }// code...
    }

    public function option($value='')
    {
        $data = $this->areaModel->select('id,name')->findAll();
        $reply['new_csrf']=csrf_hash();
        if($data){
            $reply['data'] = $data;
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
    




    public function customerDataTable()//terpakai
    {
         $data['data'] = $this->customerModel
        ->select('tb_customer.*,fc_emp.name as fc')
        ->join('tb_employee fc_emp','tb_customer.emp_fc_seq = fc_emp.id','left')
        ->where('area_seq',$this->request->getPost('id'))
        ->find();
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($data);
    }
    public function data($id){//terpakai modal edit
        $data=$this->areaModel->find($id);
        if($data){
            $reply['status'] = 1;
            $reply['data'] = $data;
        }else{
             $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }

    public function editSubmit(){//terpakai
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
        
    public function getAll()
    {
        $areaModel = new \App\Models\AreaModel();
        $areas = $areaModel->findAll();
        return $this->response->setJSON($areas);
    }
}