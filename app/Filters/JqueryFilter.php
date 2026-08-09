<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class JqueryFilter implements FilterInterface
{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->logged){
            //echo '123';
            session()->setFlashdata('msg', 'Sesi kadaluarsa, permintaan tidak dapat dilakukan');
            return redirect()->to('login');
        }
        //$session->set('sidebar','sidebar_admin');
        // Do something here
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}