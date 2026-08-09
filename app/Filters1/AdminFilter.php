<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->logged){
            session()->setFlashdata('msg', 'Harap login dahulu');
            if($request->is('post')){
                return redirect()->to('login');
            }else{
                return redirect()->to('login'); 
            }
        }else if(session()->get('user_type') == 1){
            return redirect()->to('akses_diblokir'); 
        }else if(session()->get('user_type') == 4){
            $routes = $request->uri->getSegment(1); //route dari module
            if($routes == 'payslip'){
                session()->set('sidebar','sidebar_staff');
                return redirect()->to('akses_diblokir');
            }else{
                session()->set('sidebar','sidebar_staff');
            }
        }else if(session()->get('user_type') == null){
            return redirect()->to('akses_diblokir');
        }
        else{
            session()->set('sidebar','sidebar_admin');
        }
        // Do something here
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if($request->is('post') && !session()->logged){
            $reply['status'] = 2;//for session expired
            $reply['message'] = 'session expired';
            return $response->setJSON($reply);
        }
    }
}