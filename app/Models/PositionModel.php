<?php

namespace App\Models;

use CodeIgniter\Model;

class PositionModel extends Model
{
    protected $table = 'tb_position';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name', 'created_at','deleted_by','delete_reason'
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