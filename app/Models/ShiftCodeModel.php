<?php

namespace App\Models;

use CodeIgniter\Model;

class ShiftCodeModel extends Model
{
    protected $table = 'tb_shift_code';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'code','created_by','deleted_by'
    ];
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $skipValidation = true;

}