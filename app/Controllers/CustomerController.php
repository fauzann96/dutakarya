<?php

namespace App\Controllers;

class CustomerController extends BaseController

{
	public $customerModel;

	public function __construct() {
		session()->set(['active'=>'customer']);
    }

    public function index(){
        session()->set(['title'=>'Customer']);
    	session()->set(['active_sub'=>'customer_index']);
    	return view('customer/customer_index_admin');	
    }
    public function dataTable(){
    	$limit = $this->request->getPost('limit');
    	$data = $this->customerModel
    	->select('tb_customer.*, area.name as area_name, korlap.name as korlap_name,korlap.nip as korlap_nip')
    	->limit($limit)
    	->join('tb_area area','area.id = area_seq','left')
        ->join('tb_employee korlap','korlap.id = emp_fc_seq','left')
    	->find();
    	$reply = [];

    	$reply['data']=$data;
    	$reply['new_csrf']=csrf_hash();
    	return $this->response->setJSON($reply);
    }
    public function option(){
        $data = $this->customerModel->select('id,name')->find();
        $reply = [];

        $reply['data']=$data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function deleteSubmit(){
        $data = [
            'delete_reason' => $this->request->getPost('delete_reason'),
        ];
        $delete = $this->customerModel->where('id',$this->request->getPost('id'))->delete();
        if($delete){
            $update = $this->customerModel->where('id',$this->request->getPost('id'))->set($data)->update();
            if($update){
                $reply['status'] = 1;
            }
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);

    }
    public function editSubmit()
    {
    	$data = [
    		'name'=>$this->request->getPost('name'),
    		'address'=>$this->request->getPost('address'),
    		'email'=>$this->request->getPost('email'),
    		'phone'=>$this->request->getPost('phone'),
    		'area_seq'=>$this->request->getPost('area'),
    		'pic_1_name'=>$this->request->getPost('pic_1_name'),
    		'pic_1_email'=>$this->request->getPost('pic_1_email'),
    		'pic_1_phone'=>$this->request->getPost('pic_1_phone'),
    		'pic_2_name'=>$this->request->getPost('pic_2_name'),
    		'pic_2_email'=>$this->request->getPost('pic_2_email'),
    		'pic_2_phone'=>$this->request->getPost('pic_2_phone'),
    	];
    	$update=$this->customerModel->set($data)->where('id',$this->request->getPost('id'))->update();
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($update){
    		$reply['status'] = 1;
    		$reply['new_data'] = $this->customerModel
    		->select('tb_customer.*,fc.name as fc_name,area.name as area_name')
	    	->join('tb_employee fc','fc.id = emp_fc_seq','left')
	    	->join('tb_area area','area.id = area_seq','left')
    		->find($this->request->getPost('id'));
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }
    public function korlapOption($value='')
    {
        $data = $this->employeeModel->where('customer_seq',$this->request->getPost('customer_id'))->where('resign_date',null)->find();
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        $reply['data'] = $data;
        return $this->response->setJSON($reply);
    }
    public function employeeOption($value='')
    {
        $data = $this->employeeModel->where('customer_seq',$this->request->getPost('customer_id'))->where('resign_date',null)->find();
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        $reply['data'] = $data;
        return $this->response->setJSON($reply);
    }
    public function korlapSubmit(){
        $data = [
            'emp_fc_seq' => $this->request->getPost('korlap') ?: null,
        ];
        //print_r($data);
        $update = $this->customerModel->set($data)->where('id',$this->request->getPost('customer_id'))->update();
        if($update){
            $reply['status'] =1;
        }else{
            $reply['status']=0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function locationOption($value='')
    {
        $data = $this->customerLocationModel->select('id,name')->where('customer_seq',$this->request->getPost('customer_id'))->find();
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        $reply['data'] = $data;
        return $this->response->setJSON($reply);
    }
    public function dataTableLocation()
    {	
    	$data = $this->customerLocationModel->select('tb_customer_location.*')
    	->where('customer_seq',$this->request->getPost('customer_id'))->find();

    	$reply = [];

    	$reply['data']=$data;
    	$reply['new_csrf']=csrf_hash();
    	return $this->response->setJSON($reply);
    	// code...
    }
    public function locationNewSubmit()
    {
    	$data = [
    		'name'=>$this->request->getPost('name'),
    		'description'=>$this->request->getPost('description'),
    		'customer_seq'=>$this->request->getPost('customer_id'),
            'created_by'=>session()->get('user_id'),
    	];
    	$insert=$this->customerLocationModel->insert($data);
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($insert){
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }

    public function locationEditSubmit()
    {
    	$data = [
    		'name'=>$this->request->getPost('name'),
    		'description'=>$this->request->getPost('description'),
    	];
    	$update=$this->customerLocationModel->set($data)->where('id',$this->request->getPost('id'))->update();
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($update){
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }
    
    public function locationDeleteSumbit()
    {
        $data = [
            'delete_reason'=>$this->request->getPost('reason'),
            'deleted_by' => session()->get('user_id'),
        ];
        $delete = $this->customerLocationModel->where('id',$this->request->getPost('id'))->delete();
        if($delete){
            $update=$this->customerLocationModel->set($data)->where('id',$this->request->getPost('id'))->update();
            if($update){
                $reply['status'] = 1;
            }
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function dataTableEmployee()
    {	
    	$data = $this->employeeModel->select('tb_employee.*,cust_loc.name as customer_location_name')->where('tb_employee.customer_seq',$this->request->getPost('wu_id'))->where('resign_date',null)
    	->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq','left')
    	->find();

    	$reply = [];

    	$reply['data']=$data;
    	$reply['new_csrf']=csrf_hash();
    	return $this->response->setJSON($reply);
    	// code...
    }
    public function newSubmit()
    {
    	$data = [
    		'name'=>$this->request->getPost('name'),
    		'phone'=>$this->request->getPost('phone'),
    		'email'=>$this->request->getPost('email'),
    		'address'=>$this->request->getPost('address'),
    		'area_seq' => $this->request->getPost('area'),
    		'created_by'=>session()->get('user_id'),
    	];
    	$insert=$this->customerModel->insert($data);
    	$reply=[];
        $reply['new_csrf']=csrf_hash();
    	if($insert){
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }
    public function view($id){
    	session()->set(['active_sub'=>'customer_index']);
    	$customer = $this->customerModel
    	->select('tb_customer.*,fc.name as fc_name,area.name as area_name')
    	->join('tb_employee fc','fc.id = emp_fc_seq','left')
    	->join('tb_area area','area.id = area_seq','left')
    	->find($id);

    	session()->set(['title'=>$customer['name']]);
    	$viewData['id'] = $id;
    	$viewData['customer'] = $customer;
        //$viewData['total_employee'] = $this->employeeModel->select('')
    	return view('customer/customer_view',$viewData);
    }
    public function data(){
    	$data = $this->customerModel->find($this->request->getPost('id'));
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($data){
    		$reply['status'] = 1;
    		$reply['data'] = $data;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }

}