<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'tb_customer';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name','address','phone','email','area_seq','pic_1_name','pic_1_phone','pic_1_email','pic_2_name','pic_2_phone','pic_2_email','emp_fc_seq','entry_user_seq','status','created_at','created_by','deleted_at','deleted_by','delete_reason'
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

    public $workerTable = 'tb_worker';
    public function workerJoin(){
        return 'tb_working_unit.spv_worker_seq = '.$this->workerTable.'.id';
    }
    public $areaTable = 'tb_area';
    public function areaJoin(){
        return 'tb_working_unit.area_seq = '.$this->areaTable.'.id';
    }
}