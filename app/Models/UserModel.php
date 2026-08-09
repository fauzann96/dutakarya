<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_user';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username','name','first_name','last_name','email','user_type_seq','status','last_session_seq','employee_seq','password','signature','created_at','updated_at','created_by'
    ];
    protected $useAutoIncrement = true;

    protected $skipValidation = true;

}