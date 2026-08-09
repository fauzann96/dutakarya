<?php

namespace App\Models;

use CodeIgniter\Model;

class MarritalStatusModel extends Model
{
    protected $table = 'tb_marrital_status';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'created_at',
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}