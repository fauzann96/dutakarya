<?php

namespace App\Controllers;

class EmployeeControllerKorlap extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Tenaga Alih Daya']);
        session()->set(['active'=>'employee']);
    }
    public function index()//terpakai
    {
        session()->set(['active_sub' => 'employee_active']);
        return view('employee/employee_index_korlap');
    }

    public function dataTable(){
        $employees = $this->employeeModel
        ->select('tb_employee.*,cust.name as customer_name,cust_loc.name as customer_location')
        ->join('tb_customer cust','cust.id = customer_seq','left')
        ->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq','left');
        //filtering
        
        if($this->request->getPost('is_resigned') == 1){
            $employees->where('resign_date !=',null);
        }else{
            $employees->where('resign_date',null);
        }
        if($this->request->getPost('limit')){
            $employees->limit($this->request->getPost('limit'));
        }
        if($this->request->getPost('filter_type') == 'name'){
            $employees->like('tb_employee.name',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'nip'){
            $employees->like('tb_employee.nip',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'position'){
            $employees->like('position_manual',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'spk'){
            $employees->like('tb_employee.spk',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'pkwt'){
            $employees->like('tb_employee.pkwt',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'customer'){
            $employees->like('tb_employee.customer_seq',$this->request->getPost('filter_selection'));
        }
        $employees = $employees->where('tb_employee.customer_seq',session()->get('customer'))->find();

        foreach ($employees as $key => $value) {
            // code...
            $employees[$key]['join_date'] = $this->dateTextIndo($value['join_date']);
            $employees[$key]['resign_date'] = $this->dateTextIndo($value['resign_date']);

        }    
        $reply = [];
        //echo session()->get('customer');
        $reply['data']=$employees;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function view($id){//terpakai
        session()->set(['active' => 'employee']);
        
        $viewdata['employee'] = $this->employeeModel
        ->select('tb_employee.*,cust.name as customer_name, cust_loc.name as customer_location_name, gd.name as gender_name, mar.name as marrital_status')
        ->join('tb_customer cust','cust.id = customer_seq','left')
        ->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq','left')
        ->join('tb_gender gd','gd.id = gender_seq','left')
        ->join('tb_marrital_status mar','mar.id = marrital_status_seq','left')
        ->find($id);

        
        if($viewdata['employee']){
            if($viewdata['employee']['customer_seq'] != session()->get('customer')){
            return redirect()->to('akses_diblokir'); 
            }
            if($viewdata['employee']['resign_date'] != null){
                session()->set(['active_sub' => 'employee_resigned']);
            }else{
                session()->set(['active_sub' => 'employee_active']);
            }
            //print_r($viewdata['employee']);
            session()->set(['title'=>'Tenaga Alih Daya : '.$viewdata['employee']['name']]);
            $viewdata['employee']['join_date'] = $this->dateTextIndo($viewdata['employee']['join_date']);
            $viewdata['employee']['birth_date'] = $this->dateTextIndo($viewdata['employee']['birth_date']);
            if($viewdata['employee']['resign_date']){
                $viewdata['employee']['resign_date'] = $this->dateTextIndo($viewdata['employee']['resigned_at']);
                $viewdata['active_sub'] = 'resigned_employee';
            }
            if($viewdata['employee']['marrital_status_seq'] == 3){
                $viewdata['employee']['child_1_ttl'] = $this->dateTextIndo($viewdata['employee']['child_1_ttl']);
            }else if($this->request->getPost('marrital_status') == 4){
                $viewdata['employee']['child_2_ttl'] = $this->dateTextIndo($viewdata['employee']['child_2_ttl']);
            }else if($this->request->getPost('marrital_status') == 5){
                $viewdata['employee']['child_3_ttl'] = $this->dateTextIndo($viewdata['employee']['child_3_ttl']);
            }
            //print_r($viewdata['employee']);
            $view = view('employee/employee_view_korlap',$viewdata);

        }else{
            return view('error_not_found',$viewdata);
        }
        
        return $view;
    }

}