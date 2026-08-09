<?php

namespace App\Controllers;

class JqueryOptionController extends BaseController
{
    public function workingUnit($area='')
    {
        if($area != ''){
            $option = $this->workingUnitModel->select('id,name,is_main_company')->where('area_seq',$area)->find();
        }else{
            $option = $this->workingUnitModel->select('id,name,is_main_company')->findAll();
        }
        foreach($option as $key => $value){
            if($value['is_main_company'] == true){
                $option[$key]['name'] = '[INTERNAL] '.$value['name'];
            }
        }
        return $this->response->setJSON($option);
    }
    public function position()
    {
        $option = $this->positionModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }
    public function drivingLisence()
    {
        $option = $this->drivingLisenceModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }
    public function education()
    {
        $option = $this->educationModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }
    public function division($wu='')
    {
        if($wu != ''){
            $option = $this->divisionModel->select('id,name')->where('working_unit_seq',$wu)->find();
        }else{
            $option = $this->divisionModel->select('id,name')->findAll();
        }
        return $this->response->setJSON($option);
    }
    public function gender()
    {
        $option = $this->genderModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }

    public function marrital()
    {
        $option = $this->marritalModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }
    public function employeeWu($wu = '')
    {
        if($wu != ''){
            $option = $this->employeeModel->select('id,name,npk')->where('current_working_unit_seq',$wu)->where('is_resigned',0)->find();
        }else{
            $option = $this->employeeModel->select('id,name,npk')->where('is_resigned',0)->find();
        }
        return $this->response->setJSON($option);
    }
     public function area()
    {
        $option = $this->areaModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }
    public function custArea()
    {
        $option = $this->areaModel->select('id,name')->where('is_company_area',false)->find();
        return $this->response->setJSON($option);
    }
     public function korlap()
    {
        $option = $this->employeeModel->select('id,name,npk')->where('current_position_seq',4)->findAll();
        return $this->response->setJSON($option);
    }

    public function dayOffType(){
        $option = $this->dayOffTypeModel->select('id,name')->findAll();
        return $this->response->setJSON($option);
    }
}