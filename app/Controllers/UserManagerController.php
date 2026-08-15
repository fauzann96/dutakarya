<?php

namespace App\Controllers;

class UserManagerController extends BaseController
{
     public function __construct() {
        session()->set(['title'=>'User Manager']);
        session()->set(['active'=>'User Manager']);
    }
    public function index(): string
    {
        session()->set(['active_sub'=>'user_manager']);
        return view('user_manager/index');
    }

}