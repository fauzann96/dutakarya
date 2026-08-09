<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table = 'tb_candidate';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'foto_ktp_path',
        'foto_ktp',
        'foto_pas_path',
        'foto_pas',
        'foto_sim_path',
        'foto_sim',
        'phone',
        'position',
        'sim',
        'education',
        'employee_seq',
        'notes',
        'created_by',
        'deleted_by',
        'delete_reason',
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