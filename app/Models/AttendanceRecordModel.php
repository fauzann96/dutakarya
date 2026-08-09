<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceRecordModel extends Model
{
    protected $table = 'tb_attendance_record';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_seq','customer_seq','customer_location_seq','attendance_type_seq','shift_code_seq','backup_assignment_seq','note','date','admin_seq','korlap_seq','entry_date','entry_user_seq','created_by','deleted_by'
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