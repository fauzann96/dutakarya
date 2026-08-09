<?php

namespace App\Models;

use CodeIgniter\Model;

class CalendarDayOffModel extends Model
{
    protected $table = 'tb_calendar_day_off';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;


    protected $allowedFields = [
        'name','date','type','color','created_by','deleted_by',
    ];

    protected $validationRules = [
        'name'=>'required',
        'date'=>'required',
        'type'=>'required'
    ];

    protected $useAutoIncrement = true;

    protected $skipValidation = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}