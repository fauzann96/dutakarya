<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignmentModel extends Model
{
    protected $table = 'tb_assignment';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'emp_working_unit','emp_division','emp_position','asign_working_unit','asign_division','asign_position','is_cancelled','cancel_reason','date','entry_user_seq','entry_date',
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}