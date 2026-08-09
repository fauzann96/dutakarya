<?php

namespace App\Controllers;

class CandidateController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Calon TAD']);
        session()->set(['active'=>'candidate']);
    }

    public function index(): string //ok
    {
        session()->set(['active_sub'=>'candidate_active']);
        $view = view('candidate/candidate_index');
        return $view;
    }

    public function indexAccepted(): string //ok
    {
        session()->set(['title'=>'Calon TAD Diterima']);
        session()->set(['active_sub'=>'candidate_accepted']);
        $view = view('candidate/candidate_accepted_index');
        return $view;
    }

    public function dataTable(){
        $data = $this->candidateModel->select('tb_candidate.*');
        //filter
        if($this->request->getPost('filter_type')){
            $data->like($this->request->getPost('filter_type'),$this->request->getPost('filter_key'));
        }
        if($this->request->getPost('is_accepted') == 1){
            $data->where('employee_seq !=',null)->join('tb_employee emp','emp.id = employee_seq')->join('tb_customer cust','cust.id = emp.customer_seq')->join('tb_customer_location cust_loc','cust_loc.id = emp.customer_location_seq')->select('emp.join_date,cust.name as customer,emp.position, cust_loc.name as customer_location');
        }else{
            $data->where('employee_seq',null);
        }
        $data = $data->find();

        foreach ($data as $key => $value) {
            if($this->request->getPost('is_accepted') == 1){
                $data[$key]['join_date'] = $this->dateTextIndo($value['join_date']);
            }   
        }

        $reply = [];

        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function option(){
        $data = $this->candidateModel->select('id,name')->where('employee_seq',null);
        $data = $data->find();

        $reply = [];

        $reply['data']=$data;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function view($id){ //ok
        $candidateData = $this->candidateModel->find($id);
        session()->set(['title'=>$candidateData['name']]);
        //print_r($candidateData);
        $viewData['data'] = $candidateData;
        return view('candidate/candidate_view',$viewData);
    }

    public function newSubmit(){ //ok
        $file_ktp = $this->request->getFile('file_ktp');
        $file_ktp_new_name = $file_ktp->getRandomName();
        
        $file_pas_photo = $this->request->getFile('file_pas');
        $file_pas_photo_name = $file_pas_photo->getRandomName();

        $file_sim_photo = $this->request->getFile('file_sim');
        $file_sim_photo_name = $file_sim_photo->getRandomName();

        $data = [
            'name' => $this->request->getPost('name'),
            'foto_ktp_path' => $this->foto_ktp_path,
            'foto_ktp' => $file_ktp_new_name,
            'foto_pas_path' => $this->foto_pas_path,
            'foto_pas' => $file_pas_photo_name,
            'foto_sim_path' => $this->foto_sim_path,
            'foto_sim' => $file_sim_photo_name,
            'position' => $this->request->getPost('position'),
            'phone' => $this->request->getPost('phone'),
            'sim' => $this->request->getPost('sim'),
            'education' => $this->request->getPost('education'),
            'notes' => $this->request->getPost('note'),
            'created_by'=>session()->get('user_id'),
        ];

        $insert = $this->candidateModel->insert($data);
        if($insert){
            $reply['status'] = 1;
            // Store file
            $file_ktp->move($this->storage_path.$this->foto_ktp_path.'/',$file_ktp_new_name);
            $file_pas_photo->move($this->storage_path.$this->foto_pas_path.'/',$file_pas_photo_name);
            $file_sim_photo->move($this->storage_path.$this->foto_sim_path.'/',$file_sim_photo_name);
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        $reply['data']=$data;
        return $this->response->setJSON($reply);
    }

    public function data(){ //ok
        $data = $this->candidateModel->find($this->request->getPost('id'));
       
        $reply['new_csrf']=csrf_hash();
        if($data){
            $reply['status'] = 1;
             $reply['data']=$data;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }

    public function editSubmit(){ //ok
        $data = [
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'phone' => $this->request->getPost('phone'),
            'sim' => $this->request->getPost('sim'),
            'education' => $this->request->getPost('education'),
            'notes' => $this->request->getPost('note'),
        ];

        $update = $this->candidateModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function changeKtpSubmit(){ //ok
        // delete previouse file
        $candidateData = $this->candidateModel->find($this->request->getPost('id'));
        $fileLocation = $this->storage_path.$candidateData['foto_ktp_path'].$candidateData['foto_ktp'];
        if(file_exists($fileLocation) && !is_dir($fileLocation)){
           unlink($fileLocation); 
        }
    
        $file_ktp = $this->request->getFile('file_ktp');
        $file_ktp_new_name = $file_ktp->getRandomName();

        $data = [
            'foto_ktp_path' => $this->foto_ktp_path,
            'foto_ktp' => $file_ktp_new_name,
        ];

        $update = $this->candidateModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
            $file_ktp->move('../public'.$this->foto_ktp_path.'/',$file_ktp_new_name);
            $reply['new_path'] = $data['foto_ktp_path'].'/'.$data['foto_ktp'];
        }else{
            $reply['status'] = 0;
        }

        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function changePasFotoSubmit(){ //ok
        // delete previouse file
        $candidateData = $this->candidateModel->find($this->request->getPost('id'));
        $fileLocation = $this->storage_path.$candidateData['foto_pas_path'].$candidateData['foto_pas'];
        if(file_exists($fileLocation) && !is_dir($fileLocation)){
           unlink($fileLocation); 
        }
    
        $file_pas = $this->request->getFile('file_pas');
        $file_pas_new_name = $file_pas->getRandomName();

        $data = [
            'foto_pas_path' => $this->foto_pas_path,
            'foto_pas' => $file_pas_new_name,
        ];

        $update = $this->candidateModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
            $file_pas->move('../public'.$this->foto_pas_path.'/',$file_pas_new_name);
            $reply['new_path'] = $data['foto_pas_path'].'/'.$data['foto_pas'];
        }else{
            $reply['status'] = 0;
        }
        //print_r($fileLocation);
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function changeSimSubmit(){ //ok
        // delete previouse file
        $candidateData = $this->candidateModel->find($this->request->getPost('id'));
        $fileLocation = $this->storage_path.$candidateData['foto_sim_path'].$candidateData['foto_sim'];
        if(file_exists($fileLocation) && !is_dir($fileLocation)){
           unlink($fileLocation); 
        }
    
        $file_sim = $this->request->getFile('file_sim');
        $file_sim_new_name = $file_sim->getRandomName();

        $data = [
            'foto_sim_path' => $this->foto_sim_path,
            'foto_sim' => $file_sim_new_name,
        ];

        $update = $this->candidateModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
            $file_sim->move('../public'.$this->foto_sim_path.'/',$file_sim_new_name);
            $reply['new_path'] = $data['foto_sim_path'].'/'.$data['foto_sim'];
        }else{
            $reply['status'] = 0;
        }
        //print_r($fileLocation);
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function deleteSubmit(){
        $delete = $this->candidateModel->delete($this->request->getPost('id'));
        $reply = [];
        if($delete){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function viewAccepted($value='')//ok
    {
        session()->set(['title'=>'Lamaran Kerja Diterima']);
        session()->set(['active_sub'=>'accepted_application']);
        return view('job_application/job_application_accepted');
    }
    public function importPreview(){
        $file_excel = $this->request->getFile('import_file');
        $ext = $file_excel->getClientExtension();
        if($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $jobAppData = [];
        foreach($data as $key=>$value){
            if ($key == 0) {
                continue;//ignore first line
            }
            array_push($jobAppData,[
                'name'=>$value[1],
                'position_manual'=>$value[3],
                'join_date_manual'=>$value[4],
                'ttl_manual'=>$value[5],
                'resident_id'=>$value[6],
                'address'=>$value[7],
                'phone'=>$value[8],
                'working_unit_manual'=>$value[9],
                'education_manual'=>$value[10],
                'entry_date_manual'=>$value[11],
                'sim_manual'=>$value[12],
                'bpjs_tk'=>$value[13],
                'tax_number'=>$value[14],
                'spk'=>$value[15],
            ]);
        }
        $reply = [];

        $reply['data']=$jobAppData;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function importSubmit(){
        $file_excel = $this->request->getFile('import_file');
        $ext = $file_excel->getClientExtension();
        if($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $jobAppData = [];
        foreach($data as $key=>$value){
            if ($key == 0) {
                continue;//ignore first line
            }
            array_push($jobAppData,[
                'name'=>$value[1],
                'position_manual'=>$value[3],
                'join_date_manual'=>$value[4],
                'ttl_manual'=>$value[5],
                'resident_id'=>$value[6],
                'address'=>$value[7],
                'phone'=>$value[8],
                'working_unit_manual'=>$value[9],
                'education_manual'=>$value[10],
                'entry_date_manual'=>$value[11],
                'sim_manual'=>$value[12],
                'bpjs_tk'=>$value[13],
                'tax_number'=>$value[14],
                'spk'=>$value[15],
                'is_imported'=>true,
                'created_by'=>session()->get('user_id'),
            ]);
        }
        $total_inserted = 0;
        foreach($jobAppData as $key=>$data){
            $insert=$this->jobAppModel->insert($data);
            if($insert){
                $total_inserted++;
            }
        }
        $reply = [];
        $reply['total_imported'] = $total_inserted;
        $reply['data']=$jobAppData;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }




    
    public function acceptSubmit(){
        $jobAppData = $this->jobAppModel->find($this->request->getPost('id'));
        $newEmpData = [
            'name'=>$jobAppData['name'],
            'npk'=>$this->request->getPost('npk'),
            'spk'=>$this->request->getPost('spk'),
            'current_position_seq'=>$this->request->getPost('position'),
            'current_working_unit_seq'=>$this->request->getPost('working_unit'),
            'current_division_seq'=>$this->request->getPost('division'),
            'join_date'=>date("Y-m-d"),//current date
            'ttl_manual'=>$jobAppData['ttl_manual'],
            'resident_id'=>$jobAppData['resident_id'],
            'address'=>$jobAppData['address'],
            'phone'=>$jobAppData['phone'],
            'email'=>$jobAppData['email'],
            'education_manual'=>$jobAppData['education_manual'],
            'sim_manual'=>$jobAppData['sim_manual'],
        ];
        $insertNewEmp = $this->employeeModel->insert($newEmpData);
        if($insertNewEmp){
            $jobAppUpdate = $this->jobAppModel->set([
                'is_accepted'=>true,
                'join_date'=>date("Y-m-d"),
                'employee_seq'=>$insertNewEmp,
            ])->where('id',$this->request->getPost('id'))->update();
        }
        $reply = [];
        $reply['new_csrf']=csrf_hash();
        if($insertNewEmp && $jobAppUpdate){
            $reply['new_emp_id'] = $insertNewEmp;
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }

    public function viewAccept($id){//ok

        session()->set(['active'=>'job_application']);
        session()->set(['active_sub'=>'job_application']);
        $viewdata['job_application_id'] = $id;
        $viewdata['job_application'] = $this->jobAppModel->find($id);
        $data = $this->jobAppModel->find($id);
        session()->set(['title'=>'Terima Lamaran Kerja '.$data['name']]);
        if($viewdata['job_application']['is_accepted']){
            echo 'sudah diterima';
        }else{
            $view = view('job_application/job_application_accept',$viewdata);
            return $view;
        }
    }

 

    

    public function acceptSubmitUnused(){//ok
        $data = [];
        $data += ['name'=>$this->request->getPost('name')];
        $data += ['npk'=>$this->request->getPost('npk')];//masih random, nanti diubah
        $data += ['resident_id'=>$this->request->getPost('resident_id')];
        $data += ['gender_seq'=>$this->request->getPost('gender')];
        $data += ['last_education_seq'=>$this->request->getPost('education')];
        $data += ['address'=>$this->request->getPost('address')];
        $data += ['ttl_manual'=>$this->request->getPost('ttl')];
        $data += ['current_position_seq'=>$this->request->getPost('position')];
        $data += ['current_working_unit_seq'=>$this->request->getPost('working_unit')];
        $data += ['phone'=>$this->request->getPost('phone')];
        $data += ['email'=>$this->request->getPost('email')];
        $data += ['health_insurance_number'=>$this->request->getPost('health_insurance_number')];
        $data += ['employee_insurance_number'=>$this->request->getPost('employee_insurance_number')];
        $data += ['tax_number'=>$this->request->getPost('tax_number')];
        $data += ['join_date'=>date("Y-m-d")];//current date
        $data += ['contract_number'=>$this->request->getPost('contract_number')];
        $data += ['sim_manual'=>$this->request->getPost('driving_lisence')];
        $data += ['family_card_number'=>$this->request->getPost('family_card_number')];
        $data += ['mother_name'=>$this->request->getPost('mother_name')];
        $data += ['marrital_status_seq'=>$this->request->getPost('marrital_status')];
        $data += ['spouse_name'=>$this->request->getPost('spouse_name')];
        $data += ['spouse_job'=>$this->request->getPost('spouse_job')];
        $data += ['entry_user_seq'=>session()->get('user_id')];

        $newEmployeeId = $this->employeeModel->insert($data);
        
        if($newEmployeeId != null){
            $childrenIdList = [];
            $children = $this->request->getPost('children');
            if($children){
                foreach ($children as $key => $value) {
                    // code...
                    $childModel = new \App\Models\EmployeeChildModel();
                    $childData = array();
                    $childData += ['child_order'=>$value['child_order']];
                    $childData += ['name'=>$value['child_name']];
                    $childData += ['gender_seq'=>$value['child_gender']];
                    $childData += ['birth_date'=>$value['child_birth_date']];
                    $childData += ['employee_seq'=>$newEmployeeId];
                    array_push($childrenIdList,$childModel->insert($childData));
                }
            }
            $reply['status'] = "success";
            $reply['message'] = "Data karyawan diterima atas nama ".$this->request->getPost('name')." berhasil diinput";
            $reply['new_id'] = $newEmployeeId;
            $this->jobAppModel->set([
                'is_accepted' => 1,
                'employee_seq' => $newEmployeeId,
            ])->where('id',$this->request->getPost('jobAppId'))->update();
        }else{
            $reply['status'] = "fail";
            $reply['message'] = "Data karyawan".$this->request->getPost('name')." gagal diinput";
        }
        //print_r($data);
        return $this->response->setJSON($reply);
    }

    public function data1($id){ //terpakai 
        $jobAppModel = new \App\Models\JobApplicationModel();
        $app = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        entry_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        working_unit_seq,
        position_seq,
        last_education_seq as education,
        sim_manual,
        gender_seq,
        resident_id,
        birth_date,
        ttl_manual,
        tb_job_application.address as address,
        tb_job_application.phone as phone,
        tb_job_application.email as email,
        cb.name as birth_city,')
       ->join($jobAppModel->birthCityTable,$jobAppModel->birthCityJoin(),'left')
       ->join($jobAppModel->addressCityTable,$jobAppModel->addressCityJoin(),'left')
       ->join($jobAppModel->workingUnitTable,$jobAppModel->workingUnitJoin(),'left')
       ->join($jobAppModel->positionTable,$jobAppModel->positionJoin(),'left')
       ->join($jobAppModel->educationTable,$jobAppModel->educationJoin(),'left')
       ->find($id);
        if($app != null){
            $reply['status'] = "success";
            $reply['message'] = "Lamaran Kerja ".$app['name']." berhasil dimuat";
            $reply['data'] = array(
                    "id"=>$app['id'],
                    "name"=>$app['name'],
                    "entry_date"=>$this->dateTextIndo($app['entry_date']),
                    "position_seq"=>$app['position_seq'],
                    "position"=>$app['position'],
                    "working_unit"=>$app['working_unit'],
                    "working_unit_seq"=>$app['working_unit_seq'],
                    "education"=>$app['education'],
                    "sim_manual"=>$app['sim_manual'],
                    "address"=>$app['address'],
                    "phone"=>$app['phone'],
                    "email"=>$app['email'],
                    "gender_seq"=>$app['gender_seq'],
                    "ttl"=>$app['ttl_manual'],
                    "resident_id"=>$app['resident_id'],
                    "address"=>$app['address'],
                );
        }else{
            $reply['status'] = "fail";
            $reply['message'] = "Lamaran Kerja tidak ditemukan";
        }
        return $this->response->setJSON($reply);
    }
    public function datatableAccepted()//terpakai
    {   

       $jobAppModel = new \App\Models\JobApplicationModel();
       $apps = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        tb_job_application.entry_date,
        emp.join_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        tb_education.name as education,
        tb_job_application.sim_manual,
        emp.resident_id,
        emp.ttl_manual,
        emp.address,
        emp.phone,
        emp.email,emp.npk')
       ->join($jobAppModel->workingUnitTable,$jobAppModel->workingUnitJoin(),'left')
       ->join($jobAppModel->positionTable,$jobAppModel->positionJoin(),'left')
       ->join($jobAppModel->educationTable,$jobAppModel->educationJoin(),'left')
       ->join($jobAppModel->drivingLisenceTable,$jobAppModel->drivingLisenceJoin(),'left')
       ->join('tb_employee emp','emp.id = employee_seq')
       ->where('is_accepted',true)->where('is_rejected',false)
       ->findAll();
        if($apps != null){
            foreach($apps as $key => $value){
                $apps[$key]['entry_date'] = $this->dateTextIndo($value['entry_date']);
                $apps[$key]['join_date'] = $this->dateTextIndo($value['join_date']);
            }
        }
       // print_r($apps);
        //return $this->response->setJSON($apps);
        return $this->response->setJSON($apps);
    }
    public function datatableActive()//terpakai
    {   

       $jobAppModel = new \App\Models\JobApplicationModel();
       $apps = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        entry_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        tb_education.name as education,
        sim_manual,
        resident_id,
        birth_date,
        ttl_manual,
        tb_job_application.address as address,
        tb_job_application.phone as phone,
        tb_job_application.email as email,
        cb.name as birth_city,')
       ->join($jobAppModel->birthCityTable,$jobAppModel->birthCityJoin(),'left')
       ->join($jobAppModel->addressCityTable,$jobAppModel->addressCityJoin(),'left')
       ->join($jobAppModel->workingUnitTable,$jobAppModel->workingUnitJoin(),'left')
       ->join($jobAppModel->positionTable,$jobAppModel->positionJoin(),'left')
       ->join($jobAppModel->educationTable,$jobAppModel->educationJoin(),'left')
       ->join($jobAppModel->drivingLisenceTable,$jobAppModel->drivingLisenceJoin(),'left')
       ->where('is_accepted',false)->where('is_rejected',false)
       ->findAll();
        $reply=[];
        if($apps != null){
            foreach($apps as $app){
                array_push($reply,array(
                    "id"=>$app['id'],
                    "name"=>$app['name'],
                    "entry_date"=>$this->dateTextIndo($app['entry_date']),
                    "position"=>$app['position'],
                    "working_unit"=>$app['working_unit'],
                    "education"=>$app['education'],
                    "sim_manual"=>$app['sim_manual'],
                    "address"=>$app['address'],
                    "phone"=>$app['phone'],
                    "email"=>$app['email'],
                    "ttl"=>$app['ttl_manual'],
                    "resident_id"=>$app['resident_id'],
                    "address"=>$app['address'],
                )) ;
            }
        }
        return $this->response->setJSON($reply);
    }
}