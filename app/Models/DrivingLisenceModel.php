<?php

namespace App\Models;

use CodeIgniter\Model;

class DrivingLisenceModel extends Model
{
    protected $table = 'tb_driving_lisence';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','created_at'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}