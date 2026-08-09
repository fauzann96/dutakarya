<?php

namespace App\Controllers;
use \Dompdf\Dompdf;


class AttendanceExportController extends BaseController
{
    public function reportPdf($wu_id,$startDate,$endDate){
        $viewdata['working_unit'] = $this->workingUnitModel->find($wu_id);
        $att_type = $this->attTypeModel->findAll();
        $calendar = $this->generateDateList($startDate,$endDate);
        //print_r($viewdata['working_unit']); echo "</br></br>";
        $positions = $this->attRecModel->select('pos.id, pos.name, join_prev')->where('att_working_unit_seq',$wu_id)->where('date >=',$startDate)->where('date <=',$endDate)->join('tb_position pos','pos.id=att_position_seq')->groupBy('att_position_seq')->orderBy('pos.disp_order','ASC')->find();
        //print_r($positions);
       // echo 'aaa--------</br>';
        foreach($positions as $key => $pos){
           // echo $pos['name'];
            $employees = $this->attRecModel->select('emp.id, emp.name, emp.npk, tb_attendance_record.emp_working_unit_seq, att_position_seq, pos.name as pos_name, backup_assignment_seq')->where('att_position_seq',$pos['id'])->where('att_working_unit_seq',$wu_id)
            ->join('tb_employee emp','emp.id=employee_seq')
            ->join('tb_position pos','pos.id=att_position_seq')
            ->join('tb_backup_assignment bcp','bcp.id = backup_assignment_seq','left')
            ->orderBy('backup_assignment_seq','ASC')
            ->groupBy('emp.id')
            ->find();
            //echo'</br>----</br>'.count($employee);print_r($employee);
            foreach($employees as $empKey => $emp){
               // echo'</br>';print_r($emp);
                $att_sumary = [];
                foreach($att_type as $type){
                    $att_sumary[$type['id']] = 0;
                }

                $empAtt = [];
                foreach($calendar['date_list'] as $cal => $date){
                    //echo $date['date'];
                    $att = $this->attRecModel->select('tb_attendance_record.id, type.id as type_id, type.code as type_code,color')->where('employee_seq',$emp['id'])->where('date',$date['date'])->where('att_working_unit_seq',$wu_id)->join('tb_attendance_type type','type.id = attendance_type_seq')->first();
                    if($att){
                       $att_sumary[$att['type_id']]++;
                    }
                    //if($att){echo '---ada---'; print_r($att);}
                    //echo '</br>';
                    array_push($empAtt,$att);
                }
                $employees[$empKey]['att'] = $empAtt;
                $employees[$empKey]['att_summary'] = $att_sumary;
                //print_r($employee[$key]['empAtt']);
            }
            //print_r($employees);
            $positions[$key]['pos_emp'] = $employees;

            //$positions[$key]['emp'] = $employee[$key]['empAtt'];
            //print_r($positions[$key]);
        }
        $viewdata['att_type'] = $this->attTypeModel->findAll();

        foreach($calendar['day_off_event'] as $key => $value){
            $calendar['day_off_event'][$key]['date'] = $this->dateTextIndo($value['date']);
        }
        $viewdata['day_off'] = $calendar['day_off_event'];
        
        $viewdata['user'] = $this->userModel->select('name,signature')->find(session()->get('user_id'));
        $viewdata['company_img'] = $this->imageToBase64(ROOTPATH . '/public/upload/system/logo_dks.jpg');
        $viewdata['sign_img'] = $this->imageToBase64(ROOTPATH . '/public/'.$viewdata['user']['signature']);
        $viewdata['export_date'] = $this->dateTextIndo(date("Y-m-d"));
        $viewdata['positions'] = $positions;
        $viewdata['active'] = 'attendance';
        $viewdata['active_sub'] = 'attendance_data';
        $viewdata['start_date'] = $this->dateTextIndo($startDate);
        $viewdata['end_date'] = $this->dateTextIndo($endDate);
        $viewdata['date_list'] = $calendar['date_list'];

        //echo base_url();
        
        $dompdf = new Dompdf;
        $html = view('attendance/attendance_pdf_report',$viewdata);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_base_path(base_url());
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $dompdf->stream('att_rep_'.$viewdata['working_unit']['name'].'_'.$viewdata['start_date'].'-'.$viewdata['end_date']);
        //return $html;*/

        //return view('exportPDF/attendance_report',$viewdata);
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

  public function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
}