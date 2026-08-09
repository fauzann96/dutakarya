<?php

namespace App\Controllers;

class JobApplicationJqueryController extends BaseController
{
	public function submitAccepted(){//submit form penerimaan input ke tabel employee dan children(jika ada)
        $current_user_id = session()->get('user_id');//session jangan lupa

        $employeeModel = new \App\Models\EmployeeModel();

        $data = array(
        	'name' => $this->request->getPost('name'),
        	'npk' => $this->request->getPost('npk'),
        	'resident_id' => $this->request->getPost('resident_id'),
        	'last_education_seq' => $this->request->getPost('last_education'),
        	'birth_city_manual' => $this->request->getPost('birth_city_manual'),
        	'birth_date' => $this->request->getPost('birth_date'),
        	'current_position_seq' => $this->request->getPost('position'),
        	'current_division_seq' => $this->request->getPost('division'),
        	'current_position_seq' => $this->request->getPost('position'),
        	'phone' => $this->request->getPost('phone'),
        	'email' => $this->request->getPost('email'),
        	'health_insurance_number' => $this->request->getPost('health_insurance_number'),
        	'employee_insurance_number'=>$this->request->getPost('employee_insurance_number'),
        	'tax_number'=>$this->request->getPost('tax_number'),
        	'join_date'=>date("YYYY-mm-dd"),
        	'contract_number'=>$this->request->getPost('contract_number'),
        	'driving_lisence_seq'=>$this->request->getPost('driving_lisence'),
        	'family_card_number'=>$this->request->getPost('family_card_number'),
        	'spouse_name'=>$this->request->getPost('spouse_name'),
        	'spouse_job'=>$this->request->getPost('spouse_job'),
        	'entry_user_seq'=> session()->get('user_id'),
        );
        print_r($data);
        /*

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
        return $this->response->setJSON($reply);*/

    }

}