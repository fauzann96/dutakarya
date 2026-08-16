<?php namespace App\Views\day_off_type;

use CodeIgniter\View\Cells\Cell;

class DoTypeCell
{
    public function Options($id = "do_type_id", $name = "do_type_id")
    {
        $ViewData = [
            "id"       => $id,
            "name"     => $name,
            "endpoint" => "/api/do-type/options/",
        ];

        return view("day_off_type/option", $ViewData);
    }

}