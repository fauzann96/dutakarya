<?php

namespace App\Controllers;

class CalendarManagerController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Pengaturan Kalender']);
        session()->set(['active'=>'Pengaturan Kalender']);
    }
    public function index(): string
    {   
        $date1 = str_replace('-', '/', $this->latestLockDate());
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $viewdata['min_date'] = $tomorrow;

        return view('calendar_manager/index',$viewdata);
    }






}