<?php

namespace App\Models;

use CodeIgniter\Model;

class GenderModel extends Model
{
    protected $table = 'tb_gender';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','created_at'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}