<?php

namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;
use \Dompdf\Dompdf;
class AttendanceControllerKorlap extends BaseController
{
    protected $excelHead = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'top' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
    ];
    protected $excelAttBody = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];
    public function __construct() {
        session()->set(['title'=>'Absensi']);
        session()->set(['active'=>'attendance']);
    }
    public function index(): string
    {
        session()->set(['active_sub'=>'attendance_index']);
        $view = view('attencance_input',$viewdata);
        return $view;
    }

    public function input()
    {
        session()->set(['title'=>'Input Absensi']);
        session()->set(['active'=>'attendance']);
        session()->set(['active_sub'=>'attendance_input']);
        //check for lock
        $latestLock = $this->lockModel->selectMax('date')->first();

        $date = $latestLock['date'];
        $date1 = str_replace('-', '/', $date);
        $tomorrow = date('Y-m-d',strtotime($date1 . "+0 days"));
        $viewdata['min_date'] = $tomorrow;

        $atttendanceType = $this->attTypeModel->where('enabled',1)->findAll();

        $viewdata['att_type'] = $atttendanceType;
        $view = view('attendance/attendance_input_korlap',$viewdata);
        return $view;
    }

    public function checkIfExist(){
        $data = $this->attRecModel;
        if($this->request->getPost('employee')){
            $data->where('employee_seq',$this->request->getPost('employee'));
        }else{
            $data->where('customer_seq',$this->request->getPost('customer'));
        }
        $data = $data->where('date',$this->request->getPost('date'))->find();
        if($data){
            $reply['status'] = 0;
            $reply['message'] = "Data absensi ".$this->request->getPost('date')." ditemukan, submit berikutnya akan mengupdate data yang sudah ada.";
        }else{
            $reply['status'] = 1;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function formData()
    {
        $selectedDate = $this->request->getPost('date');
        $employeeData = $this->employeeModel;
        $employeeData->select('id,name,join_date,resign_date,customer_seq,deleted_at');
        if($this->request->getPost('employee')!=0){
            $employeeData->where('id',$this->request->getPost('employee'));
        }else{
            $employeeData->where('customer_seq',session()->get('customer'));
        }
        
        $employeeData->where('join_date <=',$selectedDate);
        $employeeData->groupStart()->where('resign_date',null)->orWhere('resign_date >',$selectedDate)->groupEnd();
        $employeeData = $employeeData->find();

        $backupEmployeeData = $this->backupAssignModel->select('emp.id as id, emp.name, join_date, resign_date, emp.customer_seq, emp.deleted_at,tb_backup_assignment.id as backup,cust.name as emp_customer_name')
            ->join('tb_employee emp','emp.id = tb_backup_assignment.employee_seq')
            ->join('tb_customer cust','cust.id = emp.customer_seq');
        if($this->request->getPost('employee')!=0){
            $backupEmployeeData->where('tb_backup_assignment.employee_seq',$this->request->getPost('employee'));
        }else{
            $backupEmployeeData->where('tb_backup_assignment.customer_seq',session()->get('customer'));
        }
        $backupEmployeeData=$backupEmployeeData->where('tb_backup_assignment.date',$this->request->getPost('date'))->find();
        foreach ($backupEmployeeData as $backupEmployeeData_key => $backupEmployeeData_value) {
            $backupEmployeeData[$backupEmployeeData_key]['name'] = $backupEmployeeData_value['name'].' (backup)';
        }
        $reply['employee_data'] = array_merge($employeeData,$backupEmployeeData);
        $reply['shift_code'] = $this->shiftCodeModel->findAll();

        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }
    public function inputSubmit()
    {
        $insert = '';
        $update = '';

        foreach ( $this->request->getPost('attendance_form_data') as $att_form_data_key => $att_form_data_item) {
            $data = [
                'employee_seq' =>$att_form_data_item['employee_id'],
                'attendance_type_seq' => $att_form_data_item['employee_attendance_type'],
                'shift_code_seq'=>$att_form_data_item['employee_shift_code'],
                'customer_seq'=>session()->get('customer'),
                'date'=>$this->request->getPost('attendance_date'),
                'created_by'=> session()->get('user_id'),
                'admin_seq'=> null,
                'korlap_seq' => session()->get('employee_id'),
             ];

            //cek backup
            if($att_form_data_item['employee_backup_assignment'] == 'undefined' || empty($att_form_data_item['employee_backup_assignment'])){
                $data['backup_assignment_seq'] = null;
            }else{
                $data['backup_assignment_seq'] = $att_form_data_item['employee_backup_assignment'];
            }
            $checkIfExist = $this->attRecModel->where('employee_seq',$att_form_data_item['employee_id'])->where('date',$this->request->getPost('attendance_date'))->find();
            if($checkIfExist){
                $update = $this->attRecModel->set($data)->where('employee_seq',$att_form_data_item['employee_id'])->where('date',$this->request->getPost('attendance_date'))->update();
            }else{
                $insert = $this->attRecModel->insert($data);
            }

        }
        if($insert || $update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
        
    }

    public function dataView(){
        session()->set(['active'=>'attendance']);
        session()->set(['active_sub'=>'attendance_data']);
        $attendanceType = $this->attTypeModel->findAll();
        $shiftCode = $this->shiftCodeModel->findAll();
        $viewData['attendance_type'] = $attendanceType;
        $viewData['shift_code'] = $shiftCode;
        $view = view('attendance/attendance_data_korlap',$viewData);
        return $view;
    }

    public function fetch(){
        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');
        $calendar = $this->generateDateList($startDate,$endDate);
        $customer = session()->get('customer');

        $employeeList = $this->attRecModel->select('emp.id,nip,name,position,emp.join_date,emp.resign_date')
        ->join('tb_employee emp','employee_seq = emp.id')
        ->where('tb_attendance_record.customer_seq',$customer)
        ->where('backup_assignment_seq',null)
        ->where('join_date <=',$endDate)
        ->groupBy('nip')
        ->groupStart()->where('resign_date',null)->orWhere('resign_date >',$startDate)->groupEnd()
        ->where('date>=',$startDate)->where('date<=',$endDate)
        ->find();
        //get backup employee
        $backupEmployeeList = $this->attRecModel->select('emp.id,nip,name,position,backup_assignment_seq as backup,emp.join_date,emp.resign_date')->join('tb_employee emp','emp.id = employee_seq')
        ->where('tb_attendance_record.customer_seq',$customer)
        ->where('backup_assignment_seq !=',null)
        ->orderBy('backup','ASC')
        ->where('date>=',$startDate)->where('date<=',$endDate)
        ->groupStart()->where('resign_date',null)->orWhere('resign_date >',$startDate)->groupEnd()
        ->groupBy('nip')->find();

        if(!empty($backupEmployeeList)){
            $employeeList = array_merge($employeeList,$backupEmployeeList);
        }
        
        foreach ($employeeList as $employeeList_key => $employeeList_value) {
            $employeeAttData = [];
            for ($countSelectedDays=0; $countSelectedDays < count($calendar['date_list']) ; $countSelectedDays++) { 
                $attendanceData = $this->attRecModel->select('tp.code,date,tp.color,tp.use_shift_color,sc.code as sc_code,sc.color as sc_color')->where('date',$calendar['date_list'][$countSelectedDays]['date'])->where('employee_seq',$employeeList_value['id'])->join('tb_attendance_type tp','tp.id = attendance_type_seq')->join('tb_shift_code sc','sc.id = shift_code_seq')->first();
                $employeeAttData[$countSelectedDays] = $attendanceData;
            }
            $employeeList[$employeeList_key]['att']=$employeeAttData;
        }

        $reply['employee_list'] = $employeeList;
        $reply['calendar'] = $calendar;
        $reply['status'] = 1;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function generateExcel($startDate,$endDate){
        $customerData = $this->customerModel->select('')->find(session()->get('customer'));
        $customer = session()->get('customer');
        $spreadsheet = new Spreadsheet();
    // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'NIP')
                ->setCellValue('B1', 'Nama')
                ->setCellValue('C1', 'Jabatan')
                ->setCellValue('D1', 'Lokasi')
                ->getStyle('A1:D1')->applyFromArray($this->excelHead);
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(60, 'pt');
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(120, 'pt');
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('C')->setWidth(80, 'pt');
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('D')->setWidth(80, 'pt');
        $calendar = $this->generateDateList($startDate,$endDate);
        $alphabetRange = range('A', 'Z');
        foreach ($calendar['date_list'] as $cal_key => $cal_value) {
            if($cal_key+4 > 25){
                $cell = 'A'.$alphabetRange[$cal_key+4-26].'1';
                $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('A'.$alphabetRange[$cal_key+4-26])->setWidth(35, 'pt');
            }else{
                $cell = $alphabetRange[$cal_key+4].'1';
                $spreadsheet->setActiveSheetIndex(0)->getColumnDimension($alphabetRange[$cal_key+4])->setWidth(35, 'pt');
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell,$this->dateMonthOnly($cal_value['date']))->getStyle($cell)->applyFromArray($this->excelHead);
            $last_cal_key = $cal_key;
        }
        //totalan
        if($last_cal_key+4 > 25){
            $cell = 'A'.$alphabetRange[$last_cal_key+4-26+1].'1';
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('A'.$alphabetRange[$last_cal_key+4-26])->setWidth(40, 'pt');
        }else{
            $cell = $alphabetRange[$last_cal_key+4+1].'1';
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension($alphabetRange[$last_cal_key+4])->setWidth(40, 'pt');
        }
        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell,'Kehadiran')->getStyle($cell)->applyFromArray($this->excelHead);
        //totalan-end

        $employeeList = $this->attRecModel->select('emp.id,nip,emp.name as name,position,emp.join_date,emp.resign_date,backup_assignment_seq as backup,cust_loc.name as customer_location_name')
        ->join('tb_employee emp','employee_seq = emp.id')
        ->join('tb_customer_location cust_loc','emp.customer_location_seq = cust_loc.id')
        ->where('tb_attendance_record.customer_seq',$customer)
        ->where('backup_assignment_seq',null)
        ->where('join_date <=',$endDate)
        ->groupBy('nip')
        ->groupStart()->where('resign_date',null)->orWhere('resign_date >',$startDate)->groupEnd()
        ->where('date>=',$startDate)->where('date<=',$endDate)
        ->find();
        //get backup employee
        $backupEmployeeList = $this->attRecModel->select('emp.id,nip,emp.name as name,position,backup_assignment_seq as backup,emp.join_date,emp.resign_date,cust_loc.name as customer_location_name')
        ->join('tb_employee emp','emp.id = employee_seq')
        ->join('tb_customer_location cust_loc','emp.customer_location_seq = cust_loc.id')
        ->where('tb_attendance_record.customer_seq',$customer)
        ->where('backup_assignment_seq !=',null)
        ->orderBy('backup','ASC')
        ->where('date>=',$startDate)->where('date<=',$endDate)
        ->groupStart()->where('resign_date',null)->orWhere('resign_date >',$startDate)->groupEnd()
        ->groupBy('nip')->find();

        if(!empty($backupEmployeeList)){
            $employeeList = array_merge($employeeList,$backupEmployeeList);
        }

        foreach ($employeeList as $employeeList_key => $employeeList_value) {
            $employeeAttData = [];
            for ($countSelectedDays=0; $countSelectedDays < count($calendar['date_list']) ; $countSelectedDays++) { 
                $attendanceData = $this->attRecModel->select('tp.code,date,tp.color,tp.use_shift_color,sc.code as sc_code,sc.color as sc_color')->where('date',$calendar['date_list'][$countSelectedDays]['date'])->where('employee_seq',$employeeList_value['id'])->join('tb_attendance_type tp','tp.id = attendance_type_seq')->join('tb_shift_code sc','sc.id = shift_code_seq')->first();
                $employeeAttData[$countSelectedDays] = $attendanceData;
            }
            $employeeList[$employeeList_key]['att']=$employeeAttData;
        }
        $rowStart = 2;
        foreach($employeeList as $employeeList_key =>$employeeList_value){
            $total_in = 0;
            //nip nama jabatan lokasi
            //echo 'A'.$rowStart;
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$rowStart, $employeeList_value['nip'])
            ->setCellValue('B'.$rowStart, $employeeList_value['name'])
            ->setCellValue('C'.$rowStart, $employeeList_value['position'])
            ->setCellValue('D'.$rowStart, $employeeList_value['customer_location_name']);
            if($employeeList_value['backup'] != null){
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$rowStart, $employeeList_value['name'].' (backup)');
            }
            $spreadsheet->setActiveSheetIndex(0)->getStyle('A'.$rowStart)->applyFromArray($this->excelAttBody);
            //  print_r($employeeList_value['att']);
            
            $firstColumnForDate = 4;
            foreach ($calendar['date_list'] as $cal_key => $cal_value) {
                if($cal_key+$firstColumnForDate > 25){
                    $cell = 'A'.$alphabetRange[$cal_key+$firstColumnForDate-26].$rowStart;
                }else{
                    $cell = $alphabetRange[$cal_key+$firstColumnForDate].$rowStart;
                }
                //echo $employeeList_value['att'][1];
                if($employeeList_value['att'][$cal_key] != null){
                    if($employeeList_value['att'][$cal_key]['code'] == 1){
                        $total_in++;
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell, $employeeList_value['att'][$cal_key]['code']);
                        $spreadsheet->setActiveSheetIndex(0)->getStyle($cell)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB(str_replace('#', '', '#95F067'));
                    }else{
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell, $employeeList_value['att'][$cal_key]['code']);
                        $spreadsheet->setActiveSheetIndex(0)->getStyle($cell)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB(str_replace('#', '', $employeeList_value['att'][$cal_key]['sc_color']));
                    }
                }else{
                    $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell, '-');
                }
                $spreadsheet->setActiveSheetIndex(0)->getStyle($cell)->applyFromArray($this->excelAttBody);
                $last_cal_key = $cal_key;
            }
            if($last_cal_key+$firstColumnForDate > 25){
                $cell = 'A'.$alphabetRange[$last_cal_key+$firstColumnForDate-26+1].$rowStart;
            }else{
                $cell = $alphabetRange[$last_cal_key+$firstColumnForDate+1].$rowStart;
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue($cell, $total_in);
            $spreadsheet->setActiveSheetIndex(0)->getStyle($cell)->applyFromArray($this->excelAttBody);
            $rowStart++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Absensi '.$customerData['name'].' '.$this->dateTextIndo($startDate).'-'.$this->dateTextIndo($endDate);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
        //2024-03-13
    }

    public function generatePdf($startDate,$endDate)
    {
        $customerData = $this->customerModel->select('')->find(session()->get('customer'));
        $customer = session()->get('customer');
        $calendar = $this->generateDateList($startDate,$endDate);
        foreach($calendar['day_off_event'] as $key => $value){
            $calendar['day_off_event'][$key]['date'] = $this->dateTextIndo($value['date']);
        }

        $employeeList = $this->attRecModel->select('emp.id,nip,emp.name as name,position,emp.join_date,emp.resign_date,backup_assignment_seq as backup,cust_loc.name as customer_location_name')
        ->join('tb_employee emp','employee_seq = emp.id')
        ->join('tb_customer_location cust_loc','emp.customer_location_seq = cust_loc.id')
        ->where('tb_attendance_record.customer_seq',$customer)
        ->where('backup_assignment_seq',null)
        ->where('join_date <=',$endDate)
        ->groupBy('nip')
        ->groupStart()->where('resign_date',null)->orWhere('resign_date >',$startDate)->groupEnd()
        ->where('date>=',$startDate)->where('date<=',$endDate)
        ->find();
        //get backup employee
        $backupEmployeeList = $this->attRecModel->select('emp.id,nip,emp.name as name,position,backup_assignment_seq as backup,emp.join_date,emp.resign_date,cust_loc.name as customer_location_name')
        ->join('tb_employee emp','emp.id = employee_seq')
        ->join('tb_customer_location cust_loc','emp.customer_location_seq = cust_loc.id')
        ->where('tb_attendance_record.customer_seq',$customer)
        ->where('backup_assignment_seq !=',null)
        ->orderBy('backup','ASC')
        ->where('date>=',$startDate)->where('date<=',$endDate)
        ->groupStart()->where('resign_date',null)->orWhere('resign_date >',$startDate)->groupEnd()
        ->groupBy('nip')->find();

        if(!empty($backupEmployeeList)){
            $employeeList = array_merge($employeeList,$backupEmployeeList);
        }

        foreach ($employeeList as $employeeList_key => $employeeList_value) {
            $employeeAttData = [];
            for ($countSelectedDays=0; $countSelectedDays < count($calendar['date_list']) ; $countSelectedDays++) { 
                $attendanceData = $this->attRecModel->select('tp.code,date,tp.color,tp.use_shift_color,sc.code as sc_code,sc.color as sc_color')->where('date',$calendar['date_list'][$countSelectedDays]['date'])->where('employee_seq',$employeeList_value['id'])->join('tb_attendance_type tp','tp.id = attendance_type_seq')->join('tb_shift_code sc','sc.id = shift_code_seq')->first();
                $employeeAttData[$countSelectedDays] = $attendanceData;
            }
            $employeeList[$employeeList_key]['att']=$employeeAttData;
        }
        $viewData['customer'] = $customerData;
        $viewData['employee_list'] = $employeeList;
        $viewData['att_type'] = $this->attTypeModel->where('enabled',1)->findAll();
        $viewData['shift_code'] = $this->shiftCodeModel->findAll();
        $viewData['company_img'] = $this->imageToBase64(ROOTPATH . '/public/upload/system/logo_dks.jpg');
        $viewData['export_date'] = $this->dateTextIndo(date("Y-m-d"));
        $viewData['active'] = 'attendance';
        $viewData['active_sub'] = 'attendance_data';
        $viewData['start_date'] = $this->dateTextIndo($startDate);
        $viewData['end_date'] = $this->dateTextIndo($endDate);
        $viewData['date_list'] = $calendar['date_list'];

        $dompdf = new Dompdf;
        $html = view('attendance/attendance_generate_pdf_korlap',$viewData);
        //return $html;/*
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_base_path(base_url());
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('att_rep_'.$customerData['name'].'_'.$viewData['start_date'].'-'.$viewData['end_date']);

    }
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
    $bulan = $month_name[substr($date_param, 5, -3 )];
    $tahun = substr($date_param,0,4); //console.log(tanggal+" "+bulan+" "+tahun);
    return $tanggal." ".$bulan." ".$tahun;
  }
  private function generateDateList($startDate,$endDate)
  {
            //buat list
        $dates = array();
        $dateStart = strtotime($startDate);
        $dateEnd = strtotime($endDate);
        $stepVal = '+1 day';
        while( $dateStart <= $dateEnd ) {
             $dates[] = date('Y-m-d', $dateStart);
             $dateStart = strtotime($stepVal, $dateStart);
        }
        //cek kalau minggu/ada libur
        $calendar['date_list'] = [];
        $calendar['day_off_event'] = [];
        foreach ($dates as $date) {
            $is_sunday = 0;
            $is_day_off = 0;
            //cek minggu
            //echo date('l', strtotime($date)).date('w', strtotime($date)).','.$date;
            if(date('w', strtotime($date)) == 0){
               // echo 'true';
                $is_sunday = 1;
            }else{
                //echo 'false';
                $is_sunday = 0;
            }
            //get day off
            $dayOff = $this->calDayOffModel->select('tb_calendar_day_off.date,tb_calendar_day_off.name,type,type.name as type_name')->where('date',$date)
            ->join('tb_do_type type','type.id = type')
            ->find();
            if($dayOff){
                foreach($dayOff as $key => $off){
                    array_push($calendar['day_off_event'],$off);
                }
                $is_day_off =1;
            }
            //echo '<br/>';
            array_push($calendar['date_list'],
                array('date'=>$date,
                'is_sunday'=>$is_sunday,
                'is_day_off' => $is_day_off,
                )
            );
        }        

        return $calendar;
      // code...
  }


  
}