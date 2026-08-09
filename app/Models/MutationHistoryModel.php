<?php

namespace App\Models;

use CodeIgniter\Model;

class MutationHistoryModel extends Model
{
    protected $table = 'tb_mutation_history';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_seq', 'prev_position','prev_customer_location','note','created_by'
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