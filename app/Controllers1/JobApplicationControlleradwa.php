<?php

namespace App\Controllers;

class JobApplicationController extends BaseController
{
    public function viewAccepted($value='')
    {
        session()->set(['active'=>'job_application']);
        session()->set(['active_sub'=>'accepted_application']);
        return view('job_application_accepted');
        // code...
    }
    public function index(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'job_application';
        $viewdata['active_sub'] = 'active_application';
        $view = view('job_application_index',$viewdata);
        return $view;
    }
    public function input(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'job_application';
        $viewdata['active_sub'] = 'application_input';
        $view = view('job_application_input',$viewdata);
        return $view;
    }
    public function viewApplicant($id){
        $viewdata['active'] = 'job_application';
        $viewdata['active_sub'] = 'active_application';
        $viewdata['job_application_id'] = $id;
        $view = view('job_application_view',$viewdata);
        return $view;
    }
    public function acceptApplicant($id){//kurang handle kalau data tidak ada cek di view
        $jobAppModel = new \App\Models\JobApplicationModel();

        $viewdata['active'] = 'job_application';
        $viewdata['active_sub'] = '';
        $viewdata['job_application_id'] = $id;
        $for_province = $jobAppModel->select('cb.province_seq as birth_province, ca.province_seq as address_province')
        ->join($jobAppModel->birthCityTable,$jobAppModel->birthCityJoin(),'left')
        ->join($jobAppModel->addressCityTable,$jobAppModel->addressCityJoin(),'left')
        ->find($id);
        $viewdata['province'] = $for_province;
        $view = view('job_application_accept',$viewdata);
        return $view;
        //print_r($viewdata);
    }

    public function jqSubmitFormInput()
    {
        $current_user_id = 1;
        $jobAppModel = new \App\Models\JobApplicationModel();

        $data = [];
        $data += ['name'=>$this->request->getPost('name')];
        $data += ['resident_id'=>$this->request->getPost('resident_id')];
        $data += ['gender_seq'=>$this->request->getPost('gender')];
        $data += ['last_education_seq'=>$this->request->getPost('last_education')];
        $data += ['ttl_manual'=>$this->request->getPost('ttl')];
        $data += ['birth_city_seq'=>$this->request->getPost('birth_city')];
        $data += ['address_city_seq'=>$this->request->getPost('address_city')];
        $data += ['address'=>$this->request->getPost('address')];
        $data += ['birth_date'=>$this->request->getPost('birth_date')];
        $data += ['position_seq'=>$this->request->getPost('position')];
        $data += ['working_unit_seq'=>$this->request->getPost('working_unit')];
        $data += ['phone'=>$this->request->getPost('phone')];
        $data += ['email'=>$this->request->getPost('email')];
        $data += ['driving_lisence_seq'=>$this->request->getPost('driving_lisence')];
        $data += ['entry_user_seq'=>$current_user_id];

        $newApplicationId = $jobAppModel->insert($data);
        if($newApplicationId != null){
            $reply['status'] = "success";
            $reply['message'] = "Lamaran Kerja ".$this->request->getPost('name')." berhasil diinput";
            $reply['new_id'] = $newApplicationId;
        }else{
            $reply['status'] = "fail";
            $reply['message'] = "Lamaran Kerja ".$this->request->getPost('name')." gagal diinput";
        }
        return $this->response->setJSON($reply);
    }

    public function jqSubmitAccept(){//submit form penerimaan input ke tabel employee dan children(jika ada)
        $current_user_id = 1;//session jangan lupa

        $employeeModel = new \App\Models\EmployeeModel();

        $data = [];
        $data += ['name'=>$this->request->getPost('name')];
        $data += ['npk'=>rand(10000,90000)];//masih random, nanti diubah
        $data += ['resident_id'=>$this->request->getPost('resident_id')];
        $data += ['gender_seq'=>$this->request->getPost('gender')];
        $data += ['last_education_seq'=>$this->request->getPost('last_education')];
        $data += ['birth_city_seq'=>$this->request->getPost('birth_city')];
        $data += ['address_city_seq'=>$this->request->getPost('address_city')];
        $data += ['address'=>$this->request->getPost('address')];
        $data += ['birth_date'=>$this->request->getPost('birth_date')];
        $data += ['current_position_seq'=>$this->request->getPost('position')];
        $data += ['current_working_unit_seq'=>$this->request->getPost('working_unit')];
        $data += ['phone'=>$this->request->getPost('phone')];
        $data += ['email'=>$this->request->getPost('email')];
        $data += ['health_insurance_number'=>$this->request->getPost('health_insurance_number')];
        $data += ['employee_insurance_number'=>$this->request->getPost('employee_insurance_number')];
        $data += ['tax_number'=>$this->request->getPost('tax_number')];
        $data += ['join_date'=>date("YYYY-mm-dd")];//current date
        $data += ['contract_number'=>$this->request->getPost('contract_number')];
        $data += ['contract_end_date'=>$this->request->getPost('contract_end_date')];
        $data += ['driving_lisence_seq'=>$this->request->getPost('driving_lisence')];
        $data += ['driving_lisence_exp_date'=>$this->request->getPost('driving_lisence_exp_date')];
        $data += ['resign_date'=>$this->request->getPost('resign_date')];
        $data += ['family_card_number'=>$this->request->getPost('family_card_number')];
        $data += ['mother_name'=>$this->request->getPost('mother_name')];
        $data += ['marrital_status_seq'=>$this->request->getPost('marrital_status')];
        $data += ['spouse_name'=>$this->request->getPost('spouse_name')];
        $data += ['spouse_job'=>$this->request->getPost('spouse_job')];
        $data += ['entry_user_seq'=>$current_user_id];

        $newEmployeeId = $employeeModel->insert($data);
        
        if($newEmployeeId != null){
            $childrenIdList = [];
            $children = $this->request->getPost('children');
            if(count($children)!=0){
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
        }else{
            $reply['status'] = "fail";
            $reply['message'] = "Data karyawan".$this->request->getPost('name')." gagal diinput";
        }
        return $this->response->setJSON($reply);
    }
    public function jqGet($id){
        $jobAppModel = new \App\Models\JobApplicationModel();
        $app = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        entry_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        tb_education.name as education,
        tb_driving_lisence.name as driving_lisence,
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
       ->find($id);
        if($app != null){
            $tanggal_lahir = substr($app['birth_date'], 8 );
            $bulan = $this->month_name(substr($app['birth_date'], 5, -3 ));
            $tahun = substr($app['birth_date'], 0, -6 );
            $reply['status'] = "success";
            $reply['message'] = "Lamaran Kerja ".$app['name']." berhasil dimuat";
            $reply['data'] = array(
                    "id"=>$app['id'],
                    "name"=>$app['name'],
                    "entry_date"=>$this->dateTextIndo($app['entry_date']),
                    "position"=>$app['position'],
                    "working_unit"=>$app['working_unit'],
                    "education"=>$app['education'],
                    "driving_lisence"=>$app['driving_lisence'],
                    "address"=>$app['address'],
                    "phone"=>$app['phone'],
                    "email"=>$app['email'],
                    "ttl"=>$app['ttl_manual'],
                    //"ttl"=>$app['birth_city'].", ".$tanggal_lahir." ".$bulan." ".$tahun,
                    "resident_id"=>$app['resident_id'],
                    "address"=>$app['address'],
                );
        }else{
            $reply['status'] = "fail";
            $reply['message'] = "Lamaran Kerja tidak ditemukan";
        }
        return $this->response->setJSON($reply);
    }
    public function jqData($id){
        $jobAppModel = new \App\Models\JobApplicationModel();
        $app = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        tb_job_application.gender_seq,
        tb_job_application.working_unit_seq,
        tb_job_application.position_seq,
        tb_job_application.last_education_seq,
        tb_job_application.driving_lisence_seq,
        tb_job_application.ttl_manual,
        resident_id,
        birth_date,
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
       ->find($id);
        if($app != null){
            $tanggal_lahir = substr($app['birth_date'], 8 );
            $bulan = $this->month_name(substr($app['birth_date'], 5, -3 ));
            $tahun = substr($app['birth_date'], 0, -6 );
            $reply['status'] = "success";
            $reply['message'] = "Lamaran Kerja ".$app['name']." berhasil dimuat";
            $reply['data'] = array(
                    "id"=>$app['id'],
                    "name"=>$app['name'],
                    "gender"=>$app['gender_seq'],
                    "ttl_manual"=>$app['ttl_manual'],
                    "position"=>$app['position_seq'],
                    "working_unit"=>$app['working_unit_seq'],
                    "education"=>$app['last_education_seq'],
                    "driving_lisence"=>$app['driving_lisence_seq'],
                    "address"=>$app['address'],
                    "phone"=>$app['phone'],
                    "email"=>$app['email'],
                    "resident_id"=>$app['resident_id'],
                    "address"=>$app['address'],
                );
        }else{
            $reply['status'] = "fail";
            $reply['message'] = "Lamaran Kerja tidak ditemukan";
        }
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
        return $month_name['01'];
    } 
        
    public function datatableActive()
    {   

       $jobAppModel = new \App\Models\JobApplicationModel();
       $apps = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        entry_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        tb_education.name as education,
        tb_driving_lisence.name as driving_lisence,
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
                //2024-02-07
                //substr("abcdef", -3, -1);
                $tanggal_lahir = substr($app['birth_date'], 8 );
                $bulan = $this->month_name(substr($app['birth_date'], 5, -3 ));
                $tahun = substr($app['birth_date'], 0, -6 );
                array_push($reply,array(
                    "id"=>$app['id'],
                    "name"=>$app['name'],
                    "entry_date"=>$this->dateTextIndo($app['entry_date']),
                    "position"=>$app['position'],
                    "working_unit"=>$app['working_unit'],
                    "education"=>$app['education'],
                    "driving_lisence"=>$app['driving_lisence'],
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
    public function datatableAccepted()
    {   

       $jobAppModel = new \App\Models\JobApplicationModel();
       $apps = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        tb_job_application.entry_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        tb_education.name as education,
        tb_driving_lisence.name as driving_lisence,
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
            }
        }
       // print_r($apps);
        //return $this->response->setJSON($apps);
        return $this->response->setJSON($apps);
    }
    public function getAllRejected()
    {   

       $jobAppModel = new \App\Models\JobApplicationModel();
       $apps = $jobAppModel->select(
        'tb_job_application.id as id,
        tb_job_application.name,
        entry_date,
        tb_position.name as position,
        tb_working_unit.name as working_unit,
        tb_education.name as education,
        tb_driving_lisence.name as driving_lisence,
        resident_id,
        birth_date,
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
       ->where('is_accepted',false)->where('is_rejected',true)
       ->findAll();
        $reply=[];
        if($apps != null){
            foreach($apps as $app){
                //2024-02-07
                //substr("abcdef", -3, -1);
                $tanggal_lahir = substr($app['birth_date'], 8 );
                $bulan = $this->month_name(substr($app['birth_date'], 5, -3 ));
                $tahun = substr($app['birth_date'], 0, -6 );
                array_push($reply,array(
                    "id"=>$app['id'],
                    "name"=>$app['name'],
                    "entry_date"=>$app['entry_date'],
                    "position"=>$app['position'],
                    "working_unit"=>$app['working_unit'],
                    "education"=>$app['education'],
                    "driving_lisence"=>$app['driving_lisence'],
                    "address"=>$app['address'],
                    "phone"=>$app['phone'],
                    "email"=>$app['email'],
                    "ttl"=>$app['birth_city'].", ".$tanggal_lahir." ".$bulan." ".$tahun,
                    "resident_id"=>$app['resident_id'],
                    "address"=>$app['address'],
                )) ;
            }
        }
       // print_r($apps);
        //return $this->response->setJSON($apps);
        return $this->response->setJSON($reply);
    }
    public function reject($id){
        $jobAppModel = new \App\Models\JobApplicationModel();
        $jobReject = $jobAppModel->set(['is_rejected' => 1])->where('id',$id)->update();
        if($jobReject){
            echo "success";
        }else{
            echo "failed";
        }
    }
    public function getOneJq(){
        $id = $this->request->getPost('id');
        $jobAppModel = new \App\Models\JobApplicationModel();
        $jobApp = $jobAppModel
        ->select('tb_job_application.*,cb.province_seq birth_province,ca.province_seq address_province')
        ->join($jobAppModel->birthCityTable,$jobAppModel->birthCityJoin(),'left')
        ->join($jobAppModel->addressCityTable,$jobAppModel->addressCityJoin(),'left')->find($id);
        return $this->response->setJSON($jobApp);
    }
    public function get($id){
        $jobAppModel = new \App\Models\JobApplicationModel();
        $jobApp = $jobAppModel
        ->select('tb_job_application.*,cb.province_seq birth_province,ca.province_seq address_province')
        ->join($jobAppModel->birthCityTable,$jobAppModel->birthCityJoin(),'left')
        ->join($jobAppModel->addressCityTable,$jobAppModel->addressCityJoin(),'left')->find($id);
        return $this->response->setJSON($jobApp);
    }
    
    /*
    public function acceptApplicant($applicant_id): string
    {
        $viewdata['active'] = 'job_application';
        $viewdata['applicant_id'] = $applicant_id;

        $jobAppModel = new \App\Models\JobApplicationModel();
        $jobApp = $jobAppModel
        ->select('tb_job_application.*,cb.province_seq birth_province,ca.province_seq address_province')
        ->join($jobAppModel->birthCityTable,$jobAppModel->birthCityJoin(),'left')
        ->join($jobAppModel->addressCityTable,$jobAppModel->addressCityJoin(),'left')->find($applicant_id);

        $viewdata['applicant_data']=$jobApp;
        $view = view('job_application_accept',$viewdata);
        return $view;
        // code...
    }*/
    public function acceptApplicantSubmit(){
        $EmployeeModel = new \App\Models\EmployeeModel();
        $newEmployeeData=[];
        $newEmployeeData += ['name'=> $this->request->getPost('name')];
        $newEmployeeData += ['resident_id'=> $this->request->getPost('resident_id')];
        //$newEmployeeData += ['birth_city_seq'=> $this->request->getPost('birth_city')];
        //$newEmployeeData += ['address_city_seq'=> $this->request->getPost('address_city')];
        $newEmployeeData += ['ttl_manual'=> $this->request->getPost('ttl')];
        $newEmployeeData += ['address'=> $this->request->getPost('address')];
        $newEmployeeData += ['phone'=> $this->request->getPost('phone')];
        $newEmployeeData += ['email'=> $this->request->getPost('email')];
        $newEmployeeData += ['current_working_unit_seq'=> $this->request->getPost('working_unit')];
        $newEmployeeData += ['current_position_seq'=> $this->request->getPost('position')];
        $newEmployeeData += ['spk'=> $this->request->getPost('spk')];
        $newEmployeeData += ['bank_seq'=> $this->request->getPost('bank_seq')];
        $newEmployeeData += ['bank_account'=> $this->request->getPost('bank_account')];
        $newEmployeeData += ['bpjs_kes'=> $this->request->getPost('bpjs_kes')];
        $newEmployeeData += ['bpjs_tk'=> $this->request->getPost('bpjs_tk')];
        $newEmployeeData += ['npwp'=> $this->request->getPost('nnpwp')];
        $newEmployeeData += ['family_card_number'=> $this->request->getPost('family_card_number')];
        $newEmployeeData += ['mother_name'=> $this->request->getPost('mother_name')];
        $newEmployeeData += ['marrital_status_seq'=> $this->request->getPost('marrital_status')];
        $newEmployeeData += ['spouse_name'=> $this->request->getPost('spouse_name')];

        $EmployeeDataId = $EmployeeModel->insert($newEmployeeData);

        $children = $this->request->getPost('children');
        if(count($children)!=0){
            foreach ($children as $key => $value) {
                // code...
                $childModel = new \App\Models\EmployeeChildModel();
                $childData = array();
                $childData += ['child_order'=>$value['child_order']];
                $childData += ['name'=>$value['child_name']];
                $childData += ['gender_seq'=>$value['child_gender']];
                $childData += ['birth_date'=>$value['child_birthdate']];
                $childData += ['Employee_seq'=>$EmployeeDataId];
                $childModel->insert($childData);
            }
        }
   /*     
        id: 10
name: Jawa ITmur
resident_id: 212132
birth_date: 2024-02-13
birth_city: 14
address_city: 1
address: Jalan Gajahmada 50
phone: 085708310027
email: dks@gmail.com
working_unit: 22
position: 1
spk: 123
bank: 2
bank_account: 12
bpjs_kes: 12
bpjs_tk: 123
npwp: 123
family_card_number: 123
mother_name: 123
marrital_status: 2
spouse_name: 123
spouse_job: 123
children[0][child_order]: 1
children[0][child_name]: 123
children[0][child_birthdate]: 2024-02-14
children[1][child_order]: 2
children[1][child_name]: 1321
children[1][child_birthdate]: 2024-02-28*/
    }

}