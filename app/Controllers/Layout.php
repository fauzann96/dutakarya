<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Layout extends BaseController
{
    public function index()
    {   
        return view('adminlte_layout/index');
    }
    public function setSidebar(){
       session()->set('auto_sidebar', $this->request->getPost('auto_sidebar'));
       return $this->response->setStatusCode(ResponseInterface::HTTP_OK)->setJSON(
        ['status' => 'success',
        'session_auto_sidebar' => session()->get('auto_sidebar'),
        ]);  
    }
}
