<?php

namespace App\Controllers;
use \Dompdf\Dompdf;
use \Dompdf\Options;

class PayslipController extends BaseController

{
    public $email;
    public function __construct() {
        $this->email = \Config\Services::email();
        session()->set(['title'=>'Slip Gaji']);
        session()->set(['active'=>'payslip']);
    }

    public function index()//terpakai
    {
        session()->set(['active_sub'=>'payslip_data']);
        session()->set(['title'=>'Slip Gaji']);
        $date1 = str_replace('-', '/', $this->latestLockDate());
        $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
        $viewdata['min_date'] = $tomorrow;

        return view('payslip/payslip_index_admin',$viewdata);
    }
    public function datatable(){
        $data = $this->paySlipModel
        ->select('tb_payslip.*,cust.name as customer_name,cust_loc.name as customer_location_name')
        ->join('tb_customer cust','cust.id=tb_payslip.customer_seq')
        ->join('tb_customer_location cust_loc','cust_loc.id=tb_payslip.customer_location_seq');

        //filter
        if($this->request->getPost('limit')){
            $data->limit($this->request->getPost('limit'));
        }
        if($this->request->getPost('filter_type') == 'name'){
            $data->like('tb_payslip.name',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'nip'){
            $data->like('tb_payslip.nip',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'position'){
            $data->like('tb_payslip.position',$this->request->getPost('filter_input'));
        }
        if($this->request->getPost('filter_type') == 'customer'){
            $data->where('tb_payslip.customer_seq',$this->request->getPost('filter_selection'));
        }
        if($this->request->getPost('filter_type') == 'period'){
            $data->where('tb_payslip.period',$this->request->getPost('filter_month'));
        }

        $data = $data->findAll();
        foreach ($data as $key => $value) {
            $data[$key]['period_text'] = $this->monthTextIndo($value['period']);
        }
        $reply['data'] = $data;
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJson($reply);
    }
    public function data(){
        $data = $this->paySlipModel;

        if($this->request->getPost('type') == 'view'){
            $data->select('tb_payslip.*,cust.name as customer_name,cust_loc.name as location_name')
            ->join('tb_customer cust','cust.id=customer_seq')
            ->join('tb_customer_location cust_loc','cust_loc.id=customer_location_seq');
        }

        $data = $data->find($this->request->getPost('id'));

        if($this->request->getPost('type') == 'view'){
            $data['period'] =  $this->monthTextIndo($data['period']);
            $data['total_penghasilan'] = 0+
            $data['gaji_pokok']+
            $data['transport']+
            $data['insentif']+
            $data['lembur']+
            $data['kelebihan_hari']+
            $data['shift']+
            $data['dinas_luar']+
            $data['kelebihan_hari_m-1'];

            $data['total_potongan']= 0+
            $data['bpjs_tk']+
            $data['bpjs_kes']+
            $data['bpjs_ht']+
            $data['pph_21']+
            $data['absensi']+
            $data['payroll']+
            $data['mcu']+
            $data['pinjaman'];

            $data['netto'] = $data['total_penghasilan']-$data['total_potongan'];
        }
        if($data){
            $reply['data'] = $data;
            $reply['status'] = 1;
        }else{
            $reply['status'] =0;
        }
        $reply['new_csrf']=csrf_hash();
        
        return $this->response->setJson($reply);
    }

    public function checkIfExist(){//terpakai
        $slip = $this->paySlipModel->where('period',$this->request->getPost('period'))->where('employee_seq',$this->request->getPost('employee_id'))->find();
        if($slip){
            $reply['exist'] = 1;
            $reply['data'] = $slip;
        }else{
            $reply['exist'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function newSubmit(){//terpakai
        $employeeData = $this->employeeModel->find($this->request->getPost('employee_id'));
        $data = [
            'employee_seq' => $this->request->getPost('employee_id'),
            'name' => $employeeData['name'],
            'nip' => $employeeData['nip'],
            'position' => $employeeData['position'],
            'customer_seq' =>$employeeData['customer_seq'],
            'customer_location_seq' => $employeeData['customer_location_seq'],
            'period' => $this->request->getPost('period'),
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'transport' => $this->request->getPost('transport'),
            'insentif' => $this->request->getPost('insentif'),
            'kelebihan_hari' => $this->request->getPost('kelebihan_hari'),
            'lembur' => $this->request->getPost('lembur'),
            'shift' => $this->request->getPost('shift'),
            'dinas_luar' => $this->request->getPost('dinas_luar'),
            'kelebihan_hari_m-1' => $this->request->getPost('kelebihan_hari_m-1'),
            'bpjs_tk' => $this->request->getPost('bpjs_tk'),
            'bpjs_kes' => $this->request->getPost('bpjs_kes'),
            'bpjs_ht' => $this->request->getPost('bpjs_ht'),
            'pph_21' => $this->request->getPost('pph_21'),
            'absensi' => $this->request->getPost('absensi'),
            'payroll' => $this->request->getPost('payroll'),
            'mcu' => $this->request->getPost('mcu'),
            'pinjaman' => $this->request->getPost('pinjaman'),
            'created_by' => session()->get('user_id'),
        ];
        $insertPayslip = $this->paySlipModel->insert($data);
        $reply = [];
        if($insertPayslip){
            $reply['status'] = 1;
            $reply['message'] = "Slip gaji berhasil diinput";
            if($this->request->getPost('send_email') == 1){
                //print_r($this->generatePdf($insertPayslip)->output());
                //echo $insertPayslip;
                $fileName ='slip_'.$data['nip'].'_'.$data['period'].'.pdf'; 
                file_put_contents($this->storage_path.$this->payslip_pdf_path.$fileName,$this->generatePdf($insertPayslip)->output());
                $reply['email'] = $this->sendEmail($employeeData['email'],$this->request->getPost('period'),$employeeData['name'],$this->storage_path.$this->payslip_pdf_path.$fileName);
            }
        }else{
            $reply['status'] = 0;
            $reply['message'] = "Slip gaji gagal diinput";
        }
        return $this->response->setJSON($reply);
    }
    
  
    public function prevMonthTextIndo($month){//terpakai
        $month_name = array(
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember",
        ); 
        if((int)substr($month, 5 )-1 < 1){
            return $month_name[12].' '.substr($month,0,4);
        }else{
            return $month_name[(int)substr($month, 5 )-1].' '.substr($month,0,4);
        }
        
    }
    public function generatePdf($id){
        $data = $this->paySlipModel
        ->select('tb_payslip.*,cust.name as customer,cust_loc.name as location')
        ->where('tb_payslip.id',$id)
        ->join('tb_customer cust','cust.id = customer_seq')
        ->join('tb_customer_location cust_loc','cust_loc.id = customer_location_seq')
        ->join('tb_employee emp','emp.id = employee_seq')
        ->first();
        $data['prev_period'] = $this->prevMonthTextIndo($data['period']);
        $data['period'] =  $this->monthTextIndo($data['period']);
        $data['total_penghasilan'] = 0+
        $data['gaji_pokok']+
        $data['transport']+
        $data['insentif']+
        $data['lembur']+
        $data['kelebihan_hari']+
        $data['shift']+
        $data['dinas_luar']+
        $data['kelebihan_hari_m-1'];

        $data['total_potongan']= 0+
        $data['bpjs_tk']+
        $data['bpjs_kes']+
        $data['bpjs_ht']+
        $data['pph_21']+
        $data['absensi']+
        $data['payroll']+
        $data['mcu']+
        $data['pinjaman'];

        $data['netto'] = $data['total_penghasilan']-$data['total_potongan'];

        $user = $this->userModel->select('tb_user.*,tp.name as user_type')->join('tb_user_type tp','tp.id=user_type_seq')->find(session()->get('user_id'));
        $viewdata['company_img'] = $this->imageToBase64(ROOTPATH . '/public/upload/system/logo_dks.jpg');
        $viewdata['sign_img'] = $this->imageToBase64(ROOTPATH . '/public/'.$user['signature']);
        //$viewdata['sign_img'] = base_url($user['signature']);
        
        $viewdata['export_date'] = $this->dateTextIndo(date("Y-m-d"));
        $viewdata['current_user'] = $user['name'];
        $viewdata['user_type'] = $user['user_type'];

        $viewdata['payslip']=$data;

        $dompdf = new Dompdf;
        $html = view('payslip/payslip_pdf',$viewdata);
        //$html = '123123';
        
        //return $html;
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->set_base_path(base_url());
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        //file_put_contents($this->storage_path.$this->payslip_pdf_path.'1231.pdf',$dompdf->output());
        return $dompdf;
        //echo $this->storage_path.$this->payslip_pdf_path;
        //$dompdf->stream('slip_'.$data['nip'].'_'.$data['period']);
    }

    public function downloadPdf($id){
        $data = $this->paySlipModel
        ->select('tb_payslip.*')
        ->where('tb_payslip.id',$id)
        ->first();
        $data['period'] =  $this->monthTextIndo($data['period']);
        //$this->generatePdf($id);
        $this->generatePdf($id)->stream('slip_'.$data['nip'].'_'.$data['period']);
    }

    public function imageToBase64($path) {
        $path = $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function editSubmit(){
        $data = [
            'gaji_pokok' => $this->request->getPost('gaji_pokok'),
            'transport' => $this->request->getPost('transport'),
            'insentif' => $this->request->getPost('insentif'),
            'kelebihan_hari' => $this->request->getPost('kelebihan_hari'),
            'lembur' => $this->request->getPost('lembur'),
            'shift' => $this->request->getPost('shift'),
            'dinas_luar' => $this->request->getPost('dinas_luar'),
            'kelebihan_hari_m-1' => $this->request->getPost('kelebihan_hari_m-1'),
            'bpjs_tk' => $this->request->getPost('bpjs_tk'),
            'bpjs_kes' => $this->request->getPost('bpjs_kes'),
            'bpjs_ht' => $this->request->getPost('bpjs_ht'),
            'pph_21' => $this->request->getPost('pph_21'),
            'absensi' => $this->request->getPost('absensi'),
            'payroll' => $this->request->getPost('payroll'),
            'mcu' => $this->request->getPost('mcu'),
            'pinjaman' => $this->request->getPost('pinjaman'),
        ];
        $insertPayslip = $this->paySlipModel->set($data)->where('id', $this->request->getPost('id'))->update();
        $reply = [];
        if($insertPayslip){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }

        return $this->response->setJSON($reply);
    }
        
    public function deleteSubmit($value='')
    {
        $delete = $this->paySlipModel->where('id',$this->request->getPost('id'))->delete();
        if($delete){
            $reply['status'] = 1;
            $update = $this->paySlipModel->set(['deleted_by'=>session()->get('user_id'),'delete_reason'=>$this->request->getPost('reason')])->where('id',$this->request->getPost('id'))->update();
        }else{
            $reply['status'] = 0;
        }
        $reply['new_csrf']=csrf_hash();
        return $this->response->setJSON($reply);
    }

    public function sendEmail($email_address,$periode_slip,$nama,$attachment){

        $this->email->setFrom('smtpfauzan@gmail.com','Duta Karya');
        $this->email->setTo($email_address);

        $this->email->attach($attachment);

        $this->email->setSubject('Slip Gaji Dutakarya '.$this->monthTextIndo($periode_slip));
        $this->email->setMessage('Kepada Yth Saudara/i '.$nama);

        if(! $this->email->send()){
            return 0;
        }else{
            return 1;
        }
        if(file_exists($attachment) && !is_dir($attachment)){
           unlink($attachment); 
        }
    }

    public function sendEmailre(){
        $data = $this->paySlipModel->select('tb_payslip.*,emp.email')->join('tb_employee emp','emp.id = employee_seq')->find($this->request->getPost('id'));
        $fileName ='slip_'.$data['nip'].'_'.$data['period'].'.pdf'; 
        file_put_contents($this->storage_path.$this->payslip_pdf_path.$fileName,$this->generatePdf($this->request->getPost('id'))->output());
        $reply['status'] = $this->sendEmail($data['email'],$data['period'],$data['name'],$this->storage_path.$this->payslip_pdf_path.$fileName);
        $reply['email'] = $data['email'];
        $reply['new_csrf']=csrf_hash();

        return $this->response->setJSON($reply);
    }

}