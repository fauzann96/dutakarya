<?php

namespace App\Models;

use CodeIgniter\Model;

class DayOffTypeModel extends Model
{
    protected $table = 'tb_do_type';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','color'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;


}