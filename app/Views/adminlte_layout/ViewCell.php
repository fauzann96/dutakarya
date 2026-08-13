<?php namespace App\Views\adminlte_layout;

use CodeIgniter\View\Cells\Cell;
use App\Libraries\SidebarItem;

class ViewCell extends Cell
{
    public function LoadPreloader()
    {
        $ViewData = [

        ];
        return view("adminlte_layout/preloader",$ViewData);
    }
    public function LoadHead()
    {
        $ViewData = [

        ];
        return view("adminlte_layout/head",$ViewData);
    }

    public function LoadScript($value='')
    {
        $ViewData = [

        ];
        return view("adminlte_layout/script",$ViewData);
    }

    public function LoadContentHeader($value='')
    {
        $ViewData = [

        ];
        return view("adminlte_layout/content_header",$ViewData);
    }
    public function LoadNavbar($value='')
    {
        $myLib = new SidebarItem();
        $ViewData = [
            
        ];
        return view("adminlte_layout/navbar",$ViewData);
    }
    public function LoadSidebar($value='')
    {
        $myLib = new SidebarItem();
        $ViewData = [
            "sidebar_items" => $myLib->getSidebarItems(),
        ];
        return view("adminlte_layout/sidebar",$ViewData);
    }
    public function LoadFooter($value='')
    {
        $ViewData = [

        ];
        return view("adminlte_layout/footer",$ViewData);
    }
}