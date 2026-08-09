<?php

namespace App\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table = 'tb_bank';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name_abbr','name','code','created_at'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}