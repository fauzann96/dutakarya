<?php

namespace App\Models;

use CodeIgniter\Model;

class PaySlipModel extends Model
{
    protected $table = 'tb_payslip';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'employee_seq',
        'name',
        'nip',
        'position',
        'customer_seq',
        'customer_location_seq',
        'period',
        'gaji_pokok',
        'transport',
        'insentif',
        'lembur',
        'shift',
        'dinas_luar',
        'kelebihan_hari',
        'kelebihan_hari_m-1',
        'bpjs_tk',
        'bpjs_kes',
        'bpjs_ht',
        'pph_21',
        'absensi',
        'payroll',
        'mcu',
        'pinjaman',
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