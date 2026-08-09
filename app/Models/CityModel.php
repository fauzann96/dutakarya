<?php

namespace App\Models;

use CodeIgniter\Model;

class CityModel extends Model
{
    protected $table = 'tb_city';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','province_seq',
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;


}