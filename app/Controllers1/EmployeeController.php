<?php

namespace App\Controllers;

class EmployeeController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Tenaga Alih Daya']);
        session()->set(['active'=>'employee']);
    }
    public function index()//terpakai
    {
        session()->set(['active_sub' => 'employee_active']);
        return view('employee/employee_index_admin');
    }

    public function indexResigned()//terpakai
    {
        session()->set(['active' => 'employee']);
        session()->set(['active_sub' => 'employee_resigned']);

        return view('employee/employee_index_resigned');
        // code...
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
        $employees = $employees->find();

        foreach ($employees as $key => $value) {
            // code...
            $employees[$key]['join_date'] = $this->dateTextIndo($value['join_date']);
            $employees[$key]['resign_date'] = $this->dateTextIndo($value['resign_date']);

        }    
        $reply = [];

        $reply['data']=$employees;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function view($id){//terpakai
        session()->set(['active' => 'employee']);
        
        $employeeModel = new \App\Models\EmployeeModel();
        $viewdata['employee'] = $employeeModel
        ->select('tb_employee.*,cust.name as customer_name, cust_loc.name as customer_location_name, gd.name as gender_name, mar.name as marrital_status')
        ->join('tb_customer cust','cust.id = customer_seq','left')
        ->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq','left')
        ->join('tb_gender gd','gd.id = gender_seq','left')
        ->join('tb_marrital_status mar','mar.id = marrital_status_seq','left')
        ->find($id);
        if($viewdata['employee']['resign_date'] != null){
            session()->set(['active_sub' => 'employee_resigned']);
        }else{
            session()->set(['active_sub' => 'employee_active']);
        }
        //print_r($viewdata['employee']);
        session()->set(['title'=>'Tenaga Alih Daya : '.$viewdata['employee']['name']]);
        if($viewdata['employee']){
            $viewdata['employee']['join_date'] = $this->dateTextIndo($viewdata['employee']['join_date']);
            $viewdata['employee']['birth_date'] = $this->dateTextIndo($viewdata['employee']['birth_date']);
            if($viewdata['employee']['resign_date']){
                $viewdata['employee']['resign_date'] = $this->dateTextIndo($viewdata['employee']['resign_date']);
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
            $view = view('employee/employee_view_admin',$viewdata);

        }else{
            return view('error_not_found',$viewdata);
        }
        
        return $view;
    }
    public function data(){
        if($this->request->getPost('data_type') == 1){//job data
            $data = $this->employeeModel->select('sim,last_education,no_rekening,bpjs_kes,bpjs_tk,npwp,address,phone,email,emergency_contact')->find($this->request->getPost('id'));
        }else if($this->request->getPost('data_type') == 2){//private data
            $data = $this->employeeModel->select('nik,gender_seq,birth_place,birth_date,mother_name,marrital_status_seq,spouse_name,spouse_job,child_1_name,child_1_ttl,child_2_name,child_2_ttl,child_3_name,child_3_ttl')->find($this->request->getPost('id'));
        }else if($this->request->getPost('data_type') == 3){//spk pkwt
            $data = $this->employeeModel->select('spk,pkwt')->find($this->request->getPost('id'));
        }
        
        if($data){
            $reply['status'] = 1;
            $reply['data'] = $data;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function mutationSubmit(){//terpakai
        $data=[
            'customer_seq' => $this->request->getPost('customer'),
            'customer_location_seq' => $this->request->getPost('customer_location'),
            'position' => $this->request->getPost('position'),
        ];

        $mutationHistoryData = [
            'employee_seq' => $this->request->getPost('id'),
            'prev_customer_location' => $this->request->getPost('customer_location'),
            'prev_position' => $this->request->getPost('position'),
            'note' => $this->request->getPost('note'),
            'created_by' => session()->get('user_id'),
        ];
        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
        $insert = $this->mutationHistoryModel->insert($mutationHistoryData);
        if($update){
            $reply['status'] = 1;
            $reply['updates'] = $this->employeeModel
            ->select('cust.name as customer_name, cust_loc.name as customer_location_name, position')
            ->join('tb_customer cust','cust.id = customer_seq')->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq')
            ->find($this->request->getPost('id'));
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }

    public function spkUpdateSubmit(){//terpakai
        $data=[
            'spk' => $this->request->getPost('spk'),
            'pkwt' => $this->request->getPost('pkwt'),
        ];
        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('emp_id'))->update();
        if($update){
            $reply['status'] = 1;
            $reply['spk'] = $this->request->getPost('spk');
            $reply['pkwt'] = $this->request->getPost('pkwt');
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function resignSubmit(){//terpakai
        $data=[
            'is_resigned'=>true,
            'resign_reason' => $this->request->getPost('reason'),
            'resign_date' => date("Y-m-d"),
            'resigned_by' => session()->get('user_id'),
            //'note' => $this->request->getPost('note'),
        ];
        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('emp_id'))->update();
        if($update){
            $reply['status'] = 1;
            //$reply['spk'] = $this->request->getPost('spk');
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function newSubmit(){
        $candidateData = $this->candidateModel->where('id',$this->request->getPost('candidate_id'))->where('employee_seq',null)->first();
        if($candidateData){
            $newEmployeedata = [
                'name' => $this->request->getPost('name'),
                'gender_seq' => $this->request->getPost('gender'),
                'nip' => $this->request->getPost('nip'),
                'spk' => $this->request->getPost('spk'),
                'pkwt' => $this->request->getPost('pkwt'),
                'customer_seq' => $this->request->getPost('customer'),
                'customer_location_seq' => $this->request->getPost('location'),
                'join_date' => date('Y-m-d'),
                'sim' => $this->request->getPost('sim'),
                'position' => $this->request->getPost('position'),
                'last_education' => $this->request->getPost('education'),
                'no_rekening' => $this->request->getPost('bank_acc'),
                'bpjs_kes' => $this->request->getPost('bpjs_kes'),
                'bpjs_tk' => $this->request->getPost('bpjs_tk'),
                'npwp' => $this->request->getPost('npwp'),
                'address' => $this->request->getPost('address'),
                'phone' => $this->request->getPost('phone'),
                'email' => $this->request->getPost('email'),
                'emergency_contact' => $this->request->getPost('emergency'),
                'birth_place' => $this->request->getPost('birth_place'),
                'birth_date' => $this->request->getPost('birth_date'),
                'nik' => $this->request->getPost('nik'),
                'kk' => $this->request->getPost('kk'),
                'mother_name' => $this->request->getPost('mother_name'),
                'marrital_status_seq' => $this->request->getPost('marrital_status'),
                'created_by' => session()->get('user_id'),
                'foto_ktp_path'=>$candidateData['foto_ktp_path'],
                'foto_ktp'=>$candidateData['foto_ktp'],
                'foto_pas_path'=>$candidateData['foto_pas_path'],
                'foto_pas'=>$candidateData['foto_pas'],
                'foto_sim_path'=>$candidateData['foto_sim_path'],
                'foto_sim'=>$candidateData['foto_sim'],
            ];

            if($this->request->getPost('marrital_status') == 1){
                $familyData = [
                'spouse_name' => null,
                'spouse_job' => null,
                'child_1_name' => null,
                'child_1_ttl' => null,
                'child_2_name' => null,
                'child_2_ttl' => null,
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 2){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => null,
                'child_1_ttl' => null,
                'child_2_name' => null,
                'child_2_ttl' => null,
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 3){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => $this->request->getPost('child_1_name'),
                'child_1_ttl' => $this->request->getPost('child_1_ttl'),
                'child_2_name' => null,
                'child_2_ttl' => null,
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 4){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => $this->request->getPost('child_1_name'),
                'child_1_ttl' => $this->request->getPost('child_1_ttl'),
                'child_2_name' => $this->request->getPost('child_2_name'),
                'child_2_ttl' => $this->request->getPost('child_2_ttl'),
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 5){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => $this->request->getPost('child_1_name'),
                'child_1_ttl' => $this->request->getPost('child_1_ttl'),
                'child_2_name' => $this->request->getPost('child_2_name'),
                'child_2_ttl' => $this->request->getPost('child_2_ttl'),
                'child_3_name' => $this->request->getPost('child_3_name'),
                'child_3_ttl' => $this->request->getPost('child_3_ttl'),];
            }
            $newEmployeedata= array_merge($newEmployeedata,$familyData);
            $insert = $this->employeeModel->insert($newEmployeedata);
            if($insert){
                $reply['status'] = 1;
                $reply['id'] = $insert;
                $updateCandidate = $this->candidateModel->set(['employee_seq'=>$insert])->where('id',$this->request->getPost('candidate_id'))->update();
            }else{
                $reply['status'] =0;
            }
        }else{
            $reply['status'] =0;
            $reply['message'] = 'invalid candidate data';
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function editSubmit()//terpakai
    {
        if($this->request->getPost('data_type') == 1){//job data
            $data = [
                'sim'=>$this->request->getPost('sim'),
                'last_education'=>$this->request->getPost('education'),
                'no_rekening' =>$this->request->getPost('bank_number'),
                'bpjs_kes'=>$this->request->getPost('bpjs_kes'),
                'bpjs_tk'=>$this->request->getPost('bpjs_tk'),
                'npwp'=>$this->request->getPost('npwp'),
                'address'=>$this->request->getPost('address'),
                'phone'=>$this->request->getPost('phone'),
                'email'=>$this->request->getPost('email'),
                'emergency_contact' => $this->request->getPost('emergency'),
            ];
        }else if($this->request->getPost('data_type') == 2){//private data
            $data = [
                'nik'=>$this->request->getPost('nik'),
                'gender_seq'=>$this->request->getPost('gender'),
                'birth_place'=>$this->request->getPost('birth_place'),
                'birth_date'=>$this->request->getPost('birth_date'),
                'mother_name'=>$this->request->getPost('mother_name'),
                'marrital_status_seq'=>$this->request->getPost('marrital_status'),
            ];

            if($this->request->getPost('marrital_status') == 1){
                $familyData = [
                'spouse_name' => null,
                'spouse_job' => null,
                'child_1_name' => null,
                'child_1_ttl' => null,
                'child_2_name' => null,
                'child_2_ttl' => null,
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 2){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => null,
                'child_1_ttl' => null,
                'child_2_name' => null,
                'child_2_ttl' => null,
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 3){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => $this->request->getPost('child_1_name'),
                'child_1_ttl' => $this->request->getPost('child_1_ttl'),
                'child_2_name' => null,
                'child_2_ttl' => null,
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 4){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => $this->request->getPost('child_1_name'),
                'child_1_ttl' => $this->request->getPost('child_1_ttl'),
                'child_2_name' => $this->request->getPost('child_2_name'),
                'child_2_ttl' => $this->request->getPost('child_2_ttl'),
                'child_3_name' => null,
                'child_3_ttl' => null,];
            }else if($this->request->getPost('marrital_status') == 5){
                $familyData = [
                'spouse_name' => $this->request->getPost('spouse_name'),
                'spouse_job' => $this->request->getPost('spouse_job'),
                'child_1_name' => $this->request->getPost('child_1_name'),
                'child_1_ttl' => $this->request->getPost('child_1_ttl'),
                'child_2_name' => $this->request->getPost('child_2_name'),
                'child_2_ttl' => $this->request->getPost('child_2_ttl'),
                'child_3_name' => $this->request->getPost('child_3_name'),
                'child_3_ttl' => $this->request->getPost('child_3_ttl'),];
            }
            $data = array_merge($data,$familyData);
        }

        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
        //$reply['update'] = $update;
        if($update && $this->request->getPost('data_type') == 1){
            $reply['data'] = $data;
            $reply['status'] = 1;
        }else if($update && $this->request->getPost('data_type') == 2){
            $reply['data'] = $this->employeeModel->select('nik,gd.name as gender_name,birth_place,birth_date,mother_name,mar.name as marrital_status_name,spouse_name,spouse_job,child_1_name,child_1_ttl,child_2_name,child_2_ttl,child_3_name,child_3_ttl')->join('tb_marrital_status mar','mar.id = marrital_status_seq','left')->join('tb_gender gd','gd.id = gender_seq','left')->find($this->request->getPost('id'));
            $reply['data']['birth_date'] = $this->dateTextIndo($reply['data']['birth_date']);
            if($this->request->getPost('marrital_status') == 3){
                $reply['data']['child_1_ttl'] = $this->dateTextIndo($reply['data']['child_1_ttl']);
            }else if($this->request->getPost('marrital_status') == 4){
                $reply['data']['child_2_ttl'] = $this->dateTextIndo($reply['data']['child_2_ttl']);
            }else if($this->request->getPost('marrital_status') == 5){
                $reply['data']['child_3_ttl'] = $this->dateTextIndo($reply['data']['child_3_ttl']);
            }
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function deleteSubmit(){
        $delete = $this->employeeModel->where('id',$this->request->getPost('id'))->delete();
        if($delete){
            $updateCandidate = $this->candidateModel->set(['employee_seq'=>null])->where('employee_seq',$this->request->getPost('id'))->update();
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function cancelResignSubmit(){
        $update = $this->employeeModel->set(['resign_date' =>null])->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function checkNip()
    {
        $data = $this->employeeModel->where('nip',$this->request->getPost('new_nip'))->find();
        if($data){
            $reply['data'] = 1;
        }else{
            $reply['data'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }


    public function changeKtpSubmit(){ //ok
        // delete previouse file
        $employeeData = $this->employeeModel->find($this->request->getPost('id'));
        $fileLocation = $this->storage_path.$employeeData['foto_ktp_path'].$employeeData['foto_ktp'];
        if(file_exists($fileLocation) && !is_dir($fileLocation)){
           unlink($fileLocation); 
        }
    
        $file_ktp = $this->request->getFile('file_ktp');
        $file_ktp_new_name = $file_ktp->getRandomName();

        $data = [
            'foto_ktp_path' => $this->foto_ktp_path,
            'foto_ktp' => $file_ktp_new_name,
        ];

        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
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
        $employeeData = $this->employeeModel->find($this->request->getPost('id'));
        $fileLocation = $this->storage_path.$employeeData['foto_pas_path'].$employeeData['foto_pas'];
        if(file_exists($fileLocation) && !is_dir($fileLocation)){
           unlink($fileLocation); 
        }
    
        $file_pas = $this->request->getFile('file_pas');
        $file_pas_new_name = $file_pas->getRandomName();

        $data = [
            'foto_pas_path' => $this->foto_pas_path,
            'foto_pas' => $file_pas_new_name,
        ];

        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
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
        $employeeData = $this->employeeModel->find($this->request->getPost('id'));
        $fileLocation = $this->storage_path.$employeeData['foto_sim_path'].$employeeData['foto_sim'];
        if(file_exists($fileLocation) && !is_dir($fileLocation)){
           unlink($fileLocation); 
        }
    
        $file_sim = $this->request->getFile('file_sim');
        $file_sim_new_name = $file_sim->getRandomName();

        $data = [
            'foto_sim_path' => $this->foto_sim_path,
            'foto_sim' => $file_sim_new_name,
        ];

        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
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
        $empData = [];
        foreach($data as $key=>$value){
            if ($key == 0) {
                continue;//ignore first line
            }
            array_push($empData,[
                'name'=>$value[1],
                'npk'=>$value[2],
                'position_manual'=>$value[3],
                'join_date_manual'=>$value[4],
                'ttl_manual'=>$value[5],
                'resident_id'=>$value[6],
                'address'=>$value[7],
                'phone'=>$value[8],
                'email'=>$value[9],
                'bank_acc_number'=>$value[10],
                'bpjs_kes'=>$value[11],
                'bpjs_tk'=>$value[12],
                'npwp'=>$value[13],
                'spk'=>$value[14],
                'family_card_number'=>$value[15],
                'spouse_name'=>$value[16],
                'spouse_job'=>$value[17],
                'mother_name'=>$value[18],
                'child_1_name'=>$value[19],
                'child_1_tl'=>$value[20],
                'child_2_name'=>$value[21],
                'child_2_tl'=>$value[22],
                'child_3_name'=>$value[23],
                'child_3_tl'=>$value[24],
            ]);
        }
        $reply = [];

        $reply['data']=$empData;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
        //print_r($empData);
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
        $empData = [];
        foreach($data as $key=>$value){
            if ($key == 0) {
                continue;//ignore first line
            }
            array_push($empData,[
                'name'=>$value[1],
                'npk'=>$value[2],
                'position_manual'=>$value[3],
                'join_date_manual'=>$value[4],
                'ttl_manual'=>$value[5],
                'resident_id'=>$value[6],
                'address'=>$value[7],
                'phone'=>$value[8],
                'email'=>$value[9],
                'bank_acc_number'=>$value[10],
                'bpjs_kes'=>$value[11],
                'bpjs_tk'=>$value[12],
                'npwp'=>$value[13],
                'spk'=>$value[14],
                'family_card_number'=>$value[15],
                'spouse_name'=>$value[16],
                'spouse_job'=>$value[17],
                'mother_name'=>$value[18],
                'created_by'=>session()->get('user_id'),
            ]);
        }
        $reply = [];
        $total_inserted = 0;
        foreach($empData as $key=>$data){
            $insert=$this->employeeModel->insert($data);
            if($insert){
                $empId = $insert;
                array_push($dataInserted,$empData);
                $children = [];
            //3 anak
                if(($row[19] && $row[20]) && ((strtolower($row[19]) != 'belum') && (strtolower($row[20]) != 'belum'))){
                    array_push($children,array(
                        'name' => $row[19],
                        'birth_date_manual' => $row[20],
                        'child_order' => 1,
                        'employee_seq' => $empId,
                    ));
                }
                if(($row[21] && $row[22]) && ((strtolower($row[21]) != 'belum') && (strtolower($row[22]) != 'belum'))){
                    array_push($children,array(
                        'name' => $row[21],
                        'birth_date_manual' => $row[22],
                        'child_order' => 2,
                        'employee_seq' => $empId,
                    ));
                }
                if(($row[23] && $row[24]) && ((strtolower($row[23]) != 'belum') && (strtolower($row[24]) != 'belum'))){
                    array_push($children,array(
                        'name' => $row[23],
                        'birth_date_manual' => $row[24],
                        'child_order' => 3,
                        'employee_seq' => $empId,
                    ));
                }
                foreach($children as $key => $child){
                    $this->empChildModel->insert($child);
                }
                $total_inserted++;
            }
        }
        $reply = [];
        $reply['total_imported'] = $total_inserted;
        //$reply['']=$jobAppData;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }


    public function month_name($key) {
        $month_name = array(
        "01"=>"Januari",
        "02"=>"Februari",
        "03"=>"Maret",
        "04"=>"April",
        "05"=>"Mei",
        "06"=>"Juni",
        "07"=>"Juli",
        "08"=>"Agustus",
        "09"=>"September",
        "10"=>"Oktober",
        "11"=>"November",
        "12"=>"Desember",
        );
        return $month_name[$key];
    } 


}