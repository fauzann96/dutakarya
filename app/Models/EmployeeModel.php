<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'tb_employee';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'name',
        'nip',
        'resident_id',
        'gender_seq',
        'birth_date',
        'birth_place',
        'join_date',
        'position',
        'customer_seq',
        'customer_location_seq',
        'last_education',
        'address',
        'phone',
        'email',
        'no_rekening',
        'bpjs_kes',
        'bpjs_tk',
        'npwp',
        'spk',
        'pkwt',
        'nik',
        'kk',
        'mother_name',
        'marrital_status_seq',
        'spouse_name',
        'spouse_job',
        'child_1_name',
        'child_1_ttl',
        'child_2_name',
        'child_2_ttl',
        'child_3_name',
        'child_3_ttl',
        'sim',
        'resign_date',
        'resign_reason',
        'resigned_by',
        'created_by',
        'deleted_by',
        'password',
        'emergency_contact',
        'foto_ktp_path',
        'foto_ktp',
        'foto_pas_path',
        'foto_pas',
        'foto_sim_path',
        'foto_sim',
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

    public $birthCityTable = 'tb_city cb';
    public function birthCityJoin(){
        return $this->table.'.birth_city_seq = cb.id';
    }
    public $addressCityTable = 'tb_city ca';
    public function addressCityJoin(){
        return $this->table.'.address_city_seq = ca.id';
    }
    public $workingUnitTable = 'tb_working_unit';
    public function workingUnitJoin(){
        return $this->table.'.current_working_unit_seq = tb_working_unit.id';
    }
    public $positionTable = 'tb_position';
    public function positionJoin(){
        return $this->table.'.current_position_seq = tb_position.id';
    }
    public $educationTable = 'tb_education';
    public function educationJoin(){
        return $this->table.'.last_education_seq = tb_education.id';
    }
    public $drivingLisenceTable = 'tb_driving_lisence';
    public function drivingLisenceJoin(){
        return $this->table.'.driving_lisence_seq = tb_driving_lisence.id';
    }
    public $genderTable = 'tb_gender';
    public function genderJoin(){
        return $this->table.'.gender_seq = tb_gender.id';
    }
    public $divisionTable = 'tb_working_unit_division';
    public function divisionJoin(){
        return $this->table.'.current_division_seq = tb_working_unit_division.id';
    }
    public $marritalStatusTable = 'tb_marrital_status';
    public function marritalStatusJoin(){
        return $this->table.'.marrital_status_seq = tb_marrital_status.id';
    }

}