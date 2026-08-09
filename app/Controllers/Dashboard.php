<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'dashboard';
        $viewdata['active_sub'] = 'dashboard';
        $user_type = session()->get('user_type');
        /*if ($user_type == 1){
            $view = view('dashboard_super_admin',$viewdata);
        }elseif ($user_type == 2){
            $view = view('dashboard_admin',$viewdata);
        }elseif ($user_type == 3){
            $view = view('dashboard_korlap',$viewdata);
        }*/
        $view = view('dashboard',$viewdata);

        return $view;
    }
    public function indexKorlap()
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'dashboard';
        $viewdata['active_sub'] = 'dashboard';
        $user_type = 2;
        /*if ($user_type == 1){
            $view = view('dashboard_super_admin',$viewdata);
        }elseif ($user_type == 2){
            $view = view('dashboard_admin',$viewdata);
        }elseif ($user_type == 3){
            $view = view('dashboard_korlap',$viewdata);
        }*/
        $view = view('dashboard',$viewdata);

        return $view;
    }
}