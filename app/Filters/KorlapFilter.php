<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class KorlapFilter implements FilterInterface
{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        $employeeModel = new \App\Models\EmployeeModel();
        $customerModel = new \App\Models\CustomerModel();

        if(!session()->logged){
            //echo '123';
            session()->setFlashdata('msg', 'Harap login dahulu');
            return redirect()->to('/korlap/login');
        }else{
            if(session()->get('employee_id') == null){
                return redirect()->to('akses_diblokir');
            }else{
                session()->set('sidebar','sidebar_korlap'); 
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}