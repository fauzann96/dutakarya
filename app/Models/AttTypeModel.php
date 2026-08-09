<?php

namespace App\Models;

use CodeIgniter\Model;

class AttTypeModel extends Model
{
    protected $table = 'tb_attendance_type';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','short','color',
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}