<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeChildModel extends Model
{
    protected $table = 'tb_employee_child';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','birth_date','birth_date_manual','gender_seq','child_order','employee_seq','created_at'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;


}