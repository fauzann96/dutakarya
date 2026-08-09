<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SuperadminFilter implements FilterInterface
{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        //$session = \Config\Services::session();
        if(session()->logged){
            if(session()->get('user_type') != 1){
                return redirect()->to('akses_diblokir');
            }else{
                session()->set(['sidebar'=>'sidebar_superadmin']);
            }
            
            //return redirect()->to('login');
        }else{
            session()->setFlashdata('msg', 'Harap login dahulu');
            return redirect()->to('login');
        }
        // Do something here
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}