<?php

namespace App\Models;

use CodeIgniter\Model;

class LockModel extends Model
{
    protected $table = 'tb_lock';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;


    protected $allowedFields = [
        'description','date','entry_user_seq',
    ];

    protected $validationRules = [
        'description'=>'required',
        'date'=>'required',
        'entry_user_seq'=>'required'
    ];

    protected $useAutoIncrement = true;

    protected $skipValidation = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}