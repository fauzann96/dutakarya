<?php

namespace App\Models;

use CodeIgniter\Model;

class BackupAssignmentModel extends Model
{
    protected $table = 'tb_backup_assignment';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'customer_seq','customer_location_seq','position','employee_seq','date','assigned_by','note','created_by','deleted_by','delete_reason',
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