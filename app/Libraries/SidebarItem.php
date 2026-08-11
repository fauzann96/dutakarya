<?php

namespace App\Libraries;

class SidebarItem
{
	public array $sidebar_items = [];

    public function __construct(){
    	$this->sidebar_items = [
            1 => ['type'=>'nav-header','text' => 'MAIN ACTIVITY','link'=> '#','nav-icon' => 'bi bi-bus-front','child' => []
            ],

            2 => ['type'=>'nav-item','text' => 'Pengiriman','link'=> '#','nav-icon' => 'bi bi-truck','child' => [
                    0 => ['text' => 'Memuat','link'=> base_url('trip?status=memuat')],
                    1 => ['text' => 'Dalam Perjalanan','link'=> base_url('trip?status=dalam perjalanan')],
                    2 => ['text' => 'Tiba Di Tujuan','link'=> base_url('trip?status=tiba')],
                ]
            ],

            3 => ['type'=>'nav-item','text' => 'Ranking Supir','link'=> base_url('driver-rank'),'nav-icon' => 'bi bi-bus-front','child' => []
            ],


            4 => ['type'=>'nav-header','text' => 'PENGATURAN KENDARAAN','link'=> '#','nav-icon' => 'bi bi-bus-front','child' => []
            ],

            5 => ['type'=>'nav-item','text' => 'Kendaraan','link'=> base_url('vehicle'),'nav-icon' => 'bi bi-bus-front','child' => []
            ],
            6 => ['type'=>'nav-item','text' => 'Jenis Kendaraan','link'=> base_url('vehicle-type'),'nav-icon' => 'bi bi-bus-front','child' => []
            ],

            7 => ['type'=>'nav-header','text' => 'PENGATURAN PERSONIL','link'=> '#','nav-icon' => 'bi bi-bus-front','child' => []
            ],

            8 => ['type'=>'nav-item','text' => 'Supir','link'=> base_url('driver'),'nav-icon' => 'bi bi-bus-front','child' => []
            ],
            9 => ['type'=>'nav-item','text' => 'Kasbon Supir','link'=> base_url('cash-advance'),'nav-icon' => 'bi bi bi-cash','child' => []
            ],
            10 => ['type'=>'nav-item','text' => 'Gaji Supir','link'=> base_url('salary'),'nav-icon' => 'bi bi bi-cash','child' => []
            ],

            11 => ['type'=>'nav-header','text' => 'KEUANGAN','link'=> '#','nav-icon' => 'bi bi-bus-front','child' => []
            ],

            12 => ['type'=>'nav-item','text' => 'Customer/DO','link'=> base_url('customer'),'nav-icon' => 'bi bi-wallet2','child' => []
            ],
            13 => ['type'=>'nav-item','text' => 'Invoice','link'=> '#','nav-icon' => 'bi bi-wallet2','child' => [
                    0 => ['text' => 'Menunggu Pembayaran','link'=> base_url('invoice')],
                    1 => ['text' => 'Sudah Dibayar','link'=> base_url('invoice')],
                    2 => ['text' => 'Dibatalkan','link'=> base_url('invoice')],
                ]
            ],

            14 => ['type'=>'nav-item','text' => 'Pembayaran Invoice','link'=> base_url('payment'),'nav-icon' => 'bi bi-wallet2','child' => []
            ],

            15 => ['type'=>'nav-header','text' => 'PENGATURAN SISTEM','link'=> '#','nav-icon' => 'bi bi-bus-front','child' => []
            ],

            16 => ['type'=>'nav-item','text' => 'Users','link'=> base_url('admin/users'),'nav-icon' => 'bi bi-people-fill','child' => []
            ],


        ];

        if(session()->get('user_role') == 'SYS_ADMIN'){
            $master_user_menu = ['type'=>'nav-item','text' => 'Master Data','link'=> '#','nav-icon' => 'fas fa-database','child' => [
                1 => ['text' => 'User ','link'=> base_url('user')],
                ],

            ];
            array_push($this->sidebar_items, $master_user_menu);
            
        }
    }
    public function GetSidebarItems()
    {
    	return $this->sidebar_items;
    }

}