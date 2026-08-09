<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $session;
    protected $company_user;
    
    protected $storage_path;
    protected $foto_ktp_path;
    protected $foto_sim_path;
    protected $foto_pas_path;

    protected $paySlipModel;
    protected $employeeModel;
    protected $empChildModel;
    protected $areaModel;
    protected $positionModel;
    protected $empPosHistoryModel;
    protected $userModel;
    protected $userTypeModel;
    protected $attRecModel;
    protected $attTypeModel;
    protected $backupAssignModel;
    protected $calDayOffModel;
    protected $jobAppModel;
    protected $genderModel;
    protected $drivingLisenceModel;
    protected $educationModel;
    protected $marritalModel;
    protected $dayOffTypeModel;
    protected $lockModel;
    protected $mutationHistoryModel;
    protected $shiftCodeModel;

    public $db;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->session = \Config\Services::session();
        $this->company_user = 'DKS123';
        session()->set(['company_name'=>'PT DKS']);
        $this->storage_path = '../public';
        $this->foto_ktp_path = '/uploads/ktp/';
        $this->foto_pas_path = '/uploads/pas_foto/';
        $this->foto_sim_path = '/uploads/sim/';
        $this->payslip_pdf_path = '/uploads/payslip/';

        //model
        $this->paySlipModel = new \App\Models\PaySlipModel();
        $this->employeeModel = new \App\Models\EmployeeModel();
        $this->empChildModel = new \App\Models\EmployeeChildModel();
        $this->candidateModel = new \App\Models\CandidateModel();
        $this->customerModel = new \App\Models\CustomerModel();
        $this->areaModel = new \App\Models\AreaModel();
        $this->customerLocationModel = new \App\Models\CustomerLocationModel();
        $this->positionModel = new \App\Models\PositionModel();
        $this->empPosHistoryModel = new \App\Models\EmployeePosHistoryModel();
        $this->userModel = new \App\Models\UserModel();
        $this->userTypeModel = new \App\Models\UserTypeModel();
        $this->backupAssignModel = new \App\Models\BackupAssignmentModel();
        $this->attRecModel = new \App\Models\AttendanceRecordModel();
        $this->attTypeModel = new \App\Models\AttTypeModel();
        $this->dayModel = new \App\Models\DayModel();
        $this->calDayOffModel = new \App\Models\CalendarDayOffModel();
        $this->genderModel = new \App\Models\GenderModel();
        $this->drivingLisenceModel = new \App\Models\DrivingLisenceModel();
        $this->educationModel = new \App\Models\EducationModel();
        $this->marritalModel = new \App\Models\MarritalStatusModel();
        $this->dayOffTypeModel = new \App\Models\DayOffTypeModel();
        $this->lockModel = new \App\Models\LockModel();
        $this->mutationHistoryModel = new \App\Models\MutationHistoryModel();
        $this->shiftCodeModel = new \App\Models\ShiftCodeModel();

        $this->db = \Config\Database::connect();
    }
    public function latestLockDate()
    {
        $latestLock = $this->lockModel->selectMax('date')->first();
        return $latestLock['date'];
    }
    public function dayTextIndo($date_param){
        $day_name = array(
        "Monday" => "Senin",
        "Tuesday" => "Selasa",
        "Wednesday" => "Rabu",
        "Thursday" => "Kamis",
        "Friday" => "Jumat",
        "Saturday" => "Sabtu",
        "Sunday" => "Minggu",
    );
        return $day_name[date('l', strtotime($date_param))].', '.$this->dateTextIndo($date_param);
    }
    //2024-03-13
    public function dateTextIndo($date_param){
    $month_name = array(
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember",
    ); 
    $tanggal = substr($date_param,8);
    if (array_key_exists(substr($date_param, 5, -3 ),$month_name))
      {
      $bulan = $month_name[substr($date_param, 5, -3 )];
      }
    else
      {
      $bulan = 'undefined';
    }
    $tahun = substr($date_param,0,4);    //console.log(tanggal+" "+bulan+" "+tahun);
    return $tanggal." ".$bulan." ".$tahun;
    }
    //2024-03
    public function monthTextIndo($date_param){
    $month_name = array(
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember",
    ); 
    if (array_key_exists(substr($date_param, 5),$month_name))
      {
      $bulan = $month_name[substr($date_param, 5)];
      }
    else
      {
      $bulan = 'undefined';
    }
    $tahun = substr($date_param,0,4);    //console.log(tanggal+" "+bulan+" "+tahun);
    return $bulan." ".$tahun;
    }

    public function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    public function dateMonthOnly($date_param){
        $tanggal = substr($date_param,8);
        $bulan = substr($date_param, 5, -3 );
        return $tanggal.'-'.$bulan;
    }

}
