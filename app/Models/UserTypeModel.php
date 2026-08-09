<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTypeModel extends Model
{
    protected $table = 'tb_user_type';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}