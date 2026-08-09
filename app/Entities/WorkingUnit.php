<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class WorkingUnit extends Entity
{
    // ...
    public $name,
        $address,
        $address_city,
        $phone,
        $email,
        $pj_1_name,
        $pj_1_phone,
        $pj_1_email,
        $pj_2_name,
        $pj_2_phone,
        $pj_2_email,
        $area,
        $field_coordinator,
        //$data=[],
        $data3=[];

    public function WorkingUnit($name,
        $address,
        $address_city,
        $phone,
        $email,
        $pj_1_name,
        $pj_1_phone,
        $pj_1_email,
        $pj_2_name,
        $pj_2_phone,
        $pj_2_email,
        $area,
        $field_coordinator){
        $this->data=[];
        $this->data += ['name'=>$name];
        $this->data += ['address'=>$address];
        $this->data += ['city_seq'=>$address_city];
        $this->data += ['phone'=>$phone];
        $this->data += ['email'=>$email];
        $this->data += ['area_seq'=>$area];
        $this->data += ['pic_1_name'=>$pj_1_name];
        $this->data += ['pic_1_phone'=>$pj_1_phone];
        $this->data += ['pic_1_email'=>$pj_1_email];
        $this->data += ['pic_2_name'=>$pj_2_name];
        $this->data += ['pic_2_phone'=>$pj_2_phone];
        $this->data += ['pic_2_email'=>$pj_2_email];
        $this->data += ['spv_worker_seq'=>1];//nanti diganti
        $this->data += ['entry_user_seq'=>1]; //nanti diganti
        $this->data += ['status'=>1]; //nanti diganti
        $this->data += ['field_coordinator'=>$field_coordinator];

    }
    public function getArrayData(){        
        return $this->data;
    }

}