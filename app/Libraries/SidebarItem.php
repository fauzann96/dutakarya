<?php

namespace App\Libraries;

class SidebarItem
{
	public array $sidebar_items = [];

    public function __construct(){
    	$this->sidebar_items = [
            1 => ['type'=>'nav-header','text' => 'Tenaga Alih Daya','link'=> '#','nav-icon' => 'bi bi-bus-front','child' => []
            ],

            2 => ['type'=>'nav-item',
                'text' => 'Data TAD',
                'link'=> '#',
                'nav-icon' => 'fas fa-user-tie',
                'child' => [
                    0 => ['text' => 'Aktif','link'=> base_url('employee')],
                    1 => ['text' => 'Resign','link'=> base_url('employee/resigned')],
                ]
            ],

            3 => ['type'=>'nav-item',
                'text' => 'Calon TAD',
                'link'=> '#',
                'nav-icon' => 'fas fa-file',
                'child' => [
                    0 => ['text' => 'Aktif','link'=> base_url('/candidate')],
                    1 => ['text' => 'Resign','link'=> base_url('/candidate/accepted')],
                ]
            ],

            4 => ['type'=>'nav-item',
                'text' => 'Absensi',
                'link'=> '#',
                'nav-icon' => 'fas fas fa-user-check',
                'child' => [
                    0 => ['text' => 'Input Absensi','link'=>base_url('/attendance/input')],
                    1 => ['text' => 'Data Absensi','link'=>base_url('/attendance/data')],
                    2 => ['text' => 'Penugasan Backup','link'=>base_url('/assignment/backup')],
                ]
            ],

            5 => ['type'=>'nav-item',
                'text' => 'Penggajian',
                'link'=> '#',
                'nav-icon' => 'fas fa-money-bill-wave-alt',
                'child' => [
                    0 => ['text' => 'Aktif','link'=>base_url('/payslip')],
                ]
            ],

            6 => ['type'=>'nav-item',
                'text' => 'Customer',
                'link'=> '#',
                'nav-icon' => 'fas fa-hand-holding',
                'child' => [
                    0 => ['text' => 'Data Customer','link'=>base_url('customer')],
                    1 => ['text' => 'Area','link'=>base_url('area')],
                ]
            ],

            7 => ['type'=>'nav-item',
                'text' => 'Pengaturan User',
                'link'=> base_url('user-setting'),
                'nav-icon' => 'fas fa-user',
                'child' => [
                ]
            ],

            8 => ['type'=>'nav-item',
                'text' => 'Pengaturan Korlap',
                'link'=> base_url('fc_manager'),
                'nav-icon' => 'fas fa-users',
                'child' => [    
                ]
            ],
            9 => ['type'=>'nav-item',
                'text' => 'Pengaturan Kalender',
                'link'=> base_url('calendar_manager'),
                'nav-icon' => 'fas fa-calendar-alt',
                'child' => [    
                ]
            ],
            10 => ['type'=>'nav-item',
                'text' => 'User Manager',
                'link'=> base_url('user_manager'),
                'nav-icon' => 'fas fa-user',
                'child' => [
                ]
            ],

        ];
    }
    public function GetSidebarItems()
    {
    	return $this->sidebar_items;
    }

}