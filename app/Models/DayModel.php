<?php

namespace App\Models;

use CodeIgniter\Model;

class DayModel extends Model
{
    protected $table = 'tb_day';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'is_day_off',
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}