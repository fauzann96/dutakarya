<?php

namespace App\Models;

use CodeIgniter\Model;

class EducationModel extends Model
{
    protected $table = 'tb_education';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','created_at'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}