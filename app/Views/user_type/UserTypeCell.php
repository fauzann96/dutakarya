<?php namespace App\Views\user_type;

use CodeIgniter\View\Cells\Cell;

class UserTypeCell
{
    public function Options($id = "user_type_id", $name = "user_type_id")
    {
        $ViewData = [
            "id"       => $id,
            "name"     => $name,
            "endpoint" => "/api/user-type/options/",
        ];

        return view("user_type/option", $ViewData);
    }

}