<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeePosHistoryModel extends Model
{
    protected $table = 'tb_emp_pos_history';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employee_seq','prev_wu_seq','prev_division_seq','prev_position_seq','next_wu_seq','next_division_seq','next_position_seq','entry_user_seq'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}