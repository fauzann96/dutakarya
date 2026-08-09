<?php

namespace App\Controllers;

class OrganizationController extends BaseController
{
	public $organizationModel;
	public $divisionModel;
	public $areaModel;
	public $positionModel;
	public $employeeModel;

	public function __construct() {
		session()->set(['title'=>'Organisasi [INTERNAL]']);
		session()->set(['active'=>'organization']);
        $this->organizationModel = new \App\Models\WorkingUnitModel();
        $this->divisionModel = new \App\Models\WorkingUnitModel();
        $this->areaModel = new \App\Models\AreaModel();
        $this->positionModel = new \App\Models\PositionModel();
        $this->employeeModel = new \App\Models\employeeModel();
    }
    public function index()
    {	
    	session()->set(['active_sub'=>'organization']);
    	$organization = $this->organizationModel->find(1);
    	$viewData['organization'] = $organization;

    	//count total division
    	$viewData['total_division'] = $this->divisionModel->where('working_unit_seq',1)->countAllResults();
    	//count total area
    	$viewData['total_area'] = $this->areaModel->countAllResults();
    	//count total position
    	$viewData['total_position'] = $this->positionModel->countAllResults();
    	//count total employee
    	$viewData['total_employee'] = $this->employeeModel->where('is_resigned',false)->countAllResults();

    	return view('organization/organization_index',$viewData);
    	//print_r($organization);
    }
    public function data(){
    	$data = $this->organizationModel->find(1);
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($data){
    		$reply['data'] = $data;
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }
    public function editSubmit(){
    	$data = [
    		'name' => $this->request->getPost('name'),
    		'address'=>$this->request->getPost('address') ?: '-',
    		'phone'=>$this->request->getPost('phone')?: '-',
    		'email'=>$this->request->getPost('email')?: '-',
    	];
    	$update = $this->organizationModel->set($data)->where('id',1)->update();
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($update){
    		$reply['new_data'] = $data;
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }
    public function division(){
    	session()->set(['title'=>'Divisi Organisasi [INTERNAL]']);
    	session()->set(['active_sub'=>'division']);
    	return view('organization/organization_division_index');
    }
    public function dataDivision(){
    	$data = $this->divisionModel->find(1);
    	$reply=[];
    	$reply['new_csrf']=csrf_hash();
    	if($data){
    		$reply['data'] = $data;
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);;
    }
    public function datatableDivision(){
    	$data = $this->divisionModel->where('working_unit_seq',1)
    	->select('tb_working_unit_division.*,pos.name as pos_name')
    	->join('tb_position pos','pos.id = group_position_seq','left')
    	->findAll();
    	if($data){
    		$reply['data'] = $data;
    		$reply['status'] = 1;
    	}else{
    		$reply['status'] = 0;
    	}
    	return $this->response->setJSON($reply);
    }
    public function editSubmitDivision(){
        $data = [
            'name' => $this->request->getPost('name'),
            'group_position_seq'=>$this->request->getPost('position') ?: null,
        ];
        $update = $this->divisionModel->set($data)->where('id',$this->request->getPost('id'))->update();
        $reply=[];
        $reply['new_csrf']=csrf_hash();
        if($update){
            $reply['new_data'] = $update;
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
    public function newSubmitDivision(){
        $data = [
            'name' => $this->request->getPost('name'),
            'group_position_seq'=>$this->request->getPost('position') ?: null,
            'created_by'=>session()->get('user_id'),
            'working_unit_seq'=> 1,
        ];
        $insert = $this->divisionModel->insert($data);
        $reply=[];
        $reply['new_csrf']=csrf_hash();
        if($insert){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
    public function deleteSubmitDivision()
    {
        
        $delete = $this->divisionModel->where('id',$this->request->getPost('id'))->delete();
        $reply=[];
        $reply['new_csrf']=csrf_hash();
        if($delete){
            $update = $this->divisionModel
            ->set([
                'deleted_by'=>session()->get('user_id'),
                'delete_reason'=>$this->request->getPost('delete_reason'),
            ])
            ->where('id',$this->request->getPost('id'))->withDeleted()->update();
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
}