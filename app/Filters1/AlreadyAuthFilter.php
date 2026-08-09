<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AlreadyAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->logged){
            if(session()->get('user_type') == 3){
                    session()->logged = true;
                    return redirect()->to('korlap/attendance/input/start');
                }if(session()->get('user_type') == 2){
                    session()->logged = true;
                    return redirect()->to('employee');
                }if(session()->get('user_type') == 1){
                    session()->logged = true;
                    return redirect()->to('super_admin/dashboard');
                }
        }else{
        }
        // Do something here
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}