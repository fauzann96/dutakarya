<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinceModel extends Model
{
    protected $table = 'tb_province';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}