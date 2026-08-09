<?php

namespace App\Controllers;

class BaseAuthController extends BaseController
{
    public function BaseAuthController()
    {
        parent::BaseController();
        echo '123';
        if(session()->get('username')){
            return redirect()->to('login');
        }
    }    

    public function checkSession(){
        return redirect()->to('login');
    }
}