<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ApiFieldCoordinator extends BaseController
{

    public function dataTable(){
        $request = service('request');
        $draw   = $request->getPost('draw');
        $start  = $request->getPost('start');
        $length = $request->getPost('length');
        $search = $request->getPost('search')['value'];
        $orderColumnIndex = $request->getPost('order')[0]['column']; 
        $orderDir = $request->getPost('order')[0]['dir']; 
        $orderColumnName = $request->getPost('columns')[$orderColumnIndex]['name'];

        $data = model('EmployeeModel');
        
        $builder = $data
        ->select('tb_employee.*, tb_customer.name as customer_name')
        ->join('tb_customer','tb_customer.emp_fc_seq = tb_employee.id');
        $allRecords = clone $builder;
        $totalRecords = $allRecords->countAllResults(false);

        if (!empty($search)) {

            $builder->groupStart()
                ->like('tb_employee.name', $search)
                ->orLike('tb_employee.nip', $search)
                ->orLike('tb_customer.name', $search)
                ->groupEnd();
        }

        $recordsFiltered = clone $builder;
        $totalFiltered = $builder->countAllResults(false);

        if (!empty($orderColumnName) && $orderColumnName !== 'no') {
            $builder->orderBy($orderColumnName, $orderDir);
        }

        $records = $builder->findAll($length, $start);

        $data = [];

        foreach ($records as $row){

            $data[] = [

                "id" => $row['id'],
                "name" => $row['name'],
                "nip" => $row['nip'],
                "customer_name" => $row['customer_name'],
            ];
        }

        return $this->response->setJSON([

            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
            'token' => csrf_hash()
        ]);
    }
    
    public function resetPassword(){
        $data = [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $update = $this->employeeModel->set($data)->where('id',$this->request->getPost('id'))->update();
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['data'] = $data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
}
