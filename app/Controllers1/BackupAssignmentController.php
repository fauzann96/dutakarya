<?php

namespace App\Controllers;

class BackupAssignmentController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Penugasan Backup']);
        session()->set(['active' => 'attendance']);
        session()->set(['active_sub' => 'attendance_backup']);
    }

    public function index(): string//terpakai
    {
        //check for lock
        $date1 = str_replace('-', '/', $this->latestLockDate());
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $viewdata['min_date'] = $tomorrow;
        
        return view('backup_assignment/backup_index_admin',$viewdata);
    }

    public function dataTable(){//terpakai
        $data = $this->backupAssignModel
        ->select('tb_backup_assignment.*,emp.nip,emp.name as employee, cust.name as customer, cust_loc.name as customer_location')
        ->join('tb_customer cust','cust.id = customer_seq')
        ->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq')
        ->join('tb_employee emp','emp.id = employee_seq');

        if($this->request->getPost('limit')){
            $data->limit($this->request->getPost('limit'));
        }

        if($this->request->getPost('filter_type') == 'name'){
            $data->like('emp.name',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'nip'){    
            $data->like('emp.nip',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'position'){
            $data->like('tb_backup_assignment.position',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'date'){
            $data->where('date',$this->request->getPost('filter_date'));
        }
        if($this->request->getPost('filter_type') == 'customer'){
            $data->where('tb_backup_assignment.customer_seq',$this->request->getPost('filter_selection'));
        }


        $data = $data->findAll();
        foreach($data as $key => $value){
            $data[$key]['date'] = $this->dateTextIndo($value['date']);
        }
        $reply['data']=$data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function checkIfExist(){
        $data = $this->backupAssignModel->where('date',$this->request->getPost('date'))->where('employee_seq',$this->request->getPost('employee_id'))->find();
        if($data){
            $reply = false;
        }else{
            $reply = true;
        }
        return $this->response->setJSON($reply);
    }

    public function data(){//terpakai -> show edit modal
        $data = $this->backupAssignModel
        ->select('tb_backup_assignment.*, emp.name as employee_name,cust.name as customer_name,emp.customer_seq as emp_customer')
        ->join('tb_customer cust','cust.id = customer_seq')
        ->join('tb_employee emp','emp.id = employee_seq')
        ->find($this->request->getPost('id'));
        if($data){
            $reply['status'] = 1;
            $reply['data'] = $data;
            $reply['hash'] = csrf_hash();
        }else{
            $reply['status'] = 0;
            $reply['hash'] = csrf_hash();
        }
        $reply['data']=$data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function editSubmit()//terpakai -> submit edit modal
    {
        $data = [
            'customer_seq' => $this->request->getPost('customer'),
            'customer_location_seq' =>$this->request->getPost('customer_location'),
            'position' => $this->request->getPost('position'),
            'date' => $this->request->getPost('date'),
            'note' => $this->request->getPost('note'),
        ];
        $update = $this->backupAssignModel->set($data)->where('id',$this->request->getPost('id'))->update();
        $reply = [];
        if($update){
            $reply['status'] = 1;
            $reply['message'] = 'Perubahan berhasi disimpan';
        }else{
            $reply['status'] = 0;
            $reply['message'] = 'Perubahan backup gagal disimpan';
        }
        //print_r($data);
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function newSubmit()//->terpakai modal new submit
    {
        $data = [
            'customer_seq' => $this->request->getPost('customer'),
            'customer_location_seq' =>$this->request->getPost('customer_location'),
            'position' => $this->request->getPost('position'),
            'date' => $this->request->getPost('date'),
            'employee_seq' => $this->request->getPost('employee_id'),
            'assigned_by' => session()->get('user_id'),//current user
            'created_by' => session()->get('user_id'),//current user
            'note' => $this->request->getPost('note'),
        ];
        //cek dulu sebelum insert
        $insert = $this->backupAssignModel->insert($data);
        $reply = [];
        if($insert){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['data']=$data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function deleteSubmit(){
        
        $delete = $this->backupAssignModel->where('id',$this->request->getPost('id'))->delete();
        if($delete){
            $reply['status'] = 1;
            $update = $this->backupAssignModel->set(['deleted_by'=>session()->get('user_id'),'delete_reason'=>$this->request->getPost('reason')])->where('id',$this->request->getPost('id'))->update();
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function indexInKorlap(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'backup_assignment';
        $viewdata['active_sub'] = 'backup_in';
        $viewdata['in_out'] = 'Masuk';
        $viewdata['working_unit'] = $this->workingUnitModel->where('emp_fc_seq',session()->get('employee_seq'))->first(); 

        $viewdata['bcp_assign'] = $this->backupAssignModel
        ->select('emp.name, emp.npk, tb_backup_assignment.*,emp_wu.name as emp_wu_name, ass_wu.name as ass_wu_name,div.name as div_name, pos.name as pos_name')
        ->where('tb_backup_assignment.working_unit_seq',$viewdata['working_unit']['id'])
        ->join('tb_employee emp','emp.id = employee_seq')
        ->join('tb_working_unit emp_wu','emp_wu.id = emp_working_unit_seq')
        ->join('tb_working_unit ass_wu','ass_wu.id = working_unit_seq')
        ->join('tb_working_unit_division div','div.id = division_seq')
        ->join('tb_position pos','pos.id = position_seq')
        ->findAll();
        foreach($viewdata['bcp_assign'] as $key => $value){
            $viewdata['bcp_assign'][$key]['date'] = $this->dateTextIndo($value['date']);
        }
        return view('backup_index_in_korlap',$viewdata);
    }

    public function indexOutKorlap(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'backup_assignment';
        $viewdata['active_sub'] = 'backup_in';
        $viewdata['in_out'] = 'Masuk';
        $viewdata['working_unit'] = $this->workingUnitModel->where('emp_fc_seq',session()->get('employee_seq'))->first(); 

        $viewdata['bcp_assign'] = $this->backupAssignModel
        ->select('emp.name, emp.npk, tb_backup_assignment.*,emp_wu.name as emp_wu_name, ass_wu.name as ass_wu_name,div.name as div_name, pos.name as pos_name')
        ->where('tb_backup_assignment.emp_working_unit_seq',$viewdata['working_unit']['id'])
        //->where('assigned_by',session()->get('user_id'))
        ->join('tb_employee emp','emp.id = employee_seq')
        ->join('tb_working_unit emp_wu','emp_wu.id = emp_working_unit_seq')
        ->join('tb_working_unit ass_wu','ass_wu.id = working_unit_seq')
        ->join('tb_working_unit_division div','div.id = division_seq')
        ->join('tb_position pos','pos.id = position_seq')
        ->findAll();
        foreach($viewdata['bcp_assign'] as $key => $value){
            $viewdata['bcp_assign'][$key]['date'] = $this->dateTextIndo($value['date']);
        }
        $date1 = str_replace('-', '/', $this->latestLockDate());
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $viewdata['min_date'] = $tomorrow;
        return view('backup_index_out_korlap',$viewdata);
    }

    public function viewNewKorlap(){
        $viewdata['active'] = 'assignment';
        $viewdata['active_sub'] = 'assignment';
        $viewdata['working_unit'] = $this->workingUnitModel->where('emp_fc_seq',session()->get('employee_seq'))->first(); 
        $viewdata['wu_option'] = $this->workingUnitModel->select('id,name')
        ->where('id !=',$viewdata['working_unit']['id'])
        ->findAll();
        $viewdata['employee_option'] = $this->employeeModel->select('id,name,npk')->where('current_working_unit_seq',$viewdata['working_unit']['id'])->findAll();
        $viewdata['pos_option'] = $this->positionModel->select('id,name')->findAll();
        $date1 = str_replace('-', '/', $this->latestLockDate());
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $viewdata['min_date'] = $tomorrow;
        return view('backup_new_korlap',$viewdata);
    }

    public function viewNew(){
        $viewdata['active'] = 'assignment';
        $viewdata['active_sub'] = 'assignment';
        $viewdata['wu_option'] = $this->workingUnitModel->select('id,name')->findAll();
        $viewdata['pos_option'] = $this->positionModel->select('id,name')->findAll();
        return view('backup_new',$viewdata);
    }
        
    

    public function jqNewSubmitKorlap()
    {
        $employee = $this->employeeModel->find($this->request->getPost('employee'));
        $viewdata['working_unit'] = $this->workingUnitModel->where('emp_fc_seq',session()->get('employee_seq'))->first(); 
        //protection
        if($employee['current_working_unit_seq'] != $viewdata['working_unit']['id']){
            return redirect()->to('akses_diblokir');
        }else{
            $data = [
                'working_unit_seq' => $this->request->getPost('working_unit'),
                'division_seq' =>$this->request->getPost('division'),
                'position_seq' => $this->request->getPost('position'),
                'date' => $this->request->getPost('date'),
                'employee_seq' => $this->request->getPost('employee'),
                'emp_working_unit_seq' => $employee['current_working_unit_seq'],
                'assigned_by' => session()->get('user_id'),//current user
                'note' => $this->request->getPost('note'),
            ];
            $insert = $this->backupAssignModel->insert($data);
            $reply = [];
            if($insert){
                $reply['status'] = 'success';
                $reply['message'] = 'Penugasan backup berhasi disimpan';
            }else{
                $reply['status'] = 'fail';
                $reply['message'] = 'Penugasan backup gagal disimpan';
            }
            return $this->response->setJSON($reply);
        }
    }

    public function viewEdit($id){
        $viewdata['active'] = 'assignment';
        $viewdata['active_sub'] = 'assignment';
        $viewdata['backup_assignment'] = $this->backupAssignModel->find($id);
        if($viewdata['backup_assignment']){
            $viewdata['employee'] = $this->employeeModel->find($viewdata['backup_assignment']['employee_seq']);
            $viewdata['wu_option'] = $this->workingUnitModel->select('id,name')->findAll();
            $viewdata['pos_option'] = $this->positionModel->select('id,name')->findAll();
            return view('backup_edit',$viewdata);
        }else{
            return redirect()->to('assignment/backup/');
        }
    }



    public function getAll()
    {
        $positionModel = new \App\Models\PositionModel();
        $positions = $positionModel->findAll();
        $dummy_position = array();
        array_push($dummy_position, array('id' => 1,'name' => 'Driver'));
        array_push($dummy_position, array('id' => 2,'name' => 'Mandor'));
        array_push($dummy_position, array('id' => 3,'name' => 'Tukang'));
        array_push($dummy_position, array('id' => 4,'name' => 'Las'));
        echo json_encode($dummy_position);
    }
    public function getOptionAll(){
        $genderModel = new \App\Models\GenderModel();
        $gender = $genderModel->select('id,name')->findAll();
        return $this->response->setJSON($gender);
    }
}
/*CREATE TABLE `absensi_dks`.`t_position` (`id` INT NOT NULL AUTO_INCREMENT , `name` TINYTEXT NULL , `status` BOOLEAN NOT NULL DEFAULT TRUE , `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`), UNIQUE `position_name` (`name`)) ENGINE = InnoDB;*/