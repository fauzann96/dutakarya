<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTypeAccess extends Model
{
    protected $table = 'tb_user_type_access';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_type_seq', 'module_seq'
    ];
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    //protected $deletedField  = 'deleted_at';

    protected $skipValidation = true;

}