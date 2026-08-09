<?php

namespace App\Controllers;

class ImportController extends BaseController
{
    public function viewImportEmployee(): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'import';
        $viewdata['active_sub'] = 'import_employee';

        return view('import_employee_start',$viewdata);
    }

    public function viewImportWuEmployee($wu_id): string
    {
        //set 3 tipe user berbeda, super admin, admin, korlap
        $viewdata['active'] = 'working_unit';
        $viewdata['active_sub'] = 'working_unit_data';

        $viewdata['working_unit'] = $this->workingUnitModel->find($wu_id);

        return view('import_wu_employee',$viewdata);
    }

    public function submitImportWuEmployee(){

        $file_excel = $this->request->getFile('fileexcel');
        $ext = $file_excel->getClientExtension();
        if($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $render->load($file_excel);

        $dataExist=[];
        $dataInserted=[];
        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach($data as $x => $row) {
            if ($x == 0) {
                continue;//ignore first line
            }
            //print_r($row);
            $empData = [
                'name' => $row[1],
                'npk' => $row[2],
                'current_position_manual' => $row[3],
                'current_working_unit_seq' => $this->request->getPost('working_unit_id'),
                'join_date_manual' => $row[4],
                'ttl_manual' => $row[5],
                'resident_id' => $row[6],
                'address' => $row[7],
                'phone' => $row[8],
                'email' => $row[9],
                'bank_acc_number' => $row[10],
                'health_insurance_number' => $row[11],
                'employee_insurance_number' => $row[12],
                'tax_number' => $row[13],
                'contract_number' => $row[14],
                'family_card_number' => $row[15],
                'spouse_name' => $row[16],
                'spouse_job' => $row[17],
                'mother_name' => $row[18],
                'driving_lisence_manual' => $row[25],
            ];
            //echo '<br/>';
            print_r($empData);

            //check if npk exist
            
            $isExist = $this->employeeModel->where('npk',$empData['npk'])->first();
            if($isExist){
                array_push($dataExist,$isExist);
            }else{
                $insertEmp = $this->employeeModel->insert($empData);

                if($insertEmp){
                    $empId = $insertEmp;
                    array_push($dataInserted,$empData);
                    $children = [];
                //3 anak
                if(($row[19] && $row[20]) && ((strtolower($row[19]) != 'belum') && (strtolower($row[20]) != 'belum'))){
                    array_push($children,array(
                            'name' => $row[19],
                            'birth_date_manual' => $row[20],
                            'child_order' => 1,
                            'employee_seq' => $empId,
                        ));
                    }
                    if(($row[21] && $row[22]) && ((strtolower($row[21]) != 'belum') && (strtolower($row[22]) != 'belum'))){
                        array_push($children,array(
                            'name' => $row[21],
                            'birth_date_manual' => $row[22],
                            'child_order' => 2,
                            'employee_seq' => $empId,
                        ));
                    }
                    if(($row[23] && $row[24]) && ((strtolower($row[23]) != 'belum') && (strtolower($row[24]) != 'belum'))){
                        array_push($children,array(
                            'name' => $row[23],
                            'birth_date_manual' => $row[24],
                            'child_order' => 3,
                            'employee_seq' => $empId,
                        ));
                    }
                    foreach($children as $key => $child){
                        $this->empChildModel->insert($child);
                    }
                }
            }
            echo '<br/>is exist';
            print_r($dataExist);
            echo '<br/>is inserted';
            print_r($dataInserted);
            /*
            $Nis = $row[0];
            $NamaSiswa = $row[1];
            $Alamat = $row[2];

            $db = \Config\Database::connect();

            $cekNis = $db->table('siswa')->getWhere(['Nis'=>$Nis])->getResult();

            if(count($cekNis) > 0) {
                session()->setFlashdata('message','<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
            } else {

            $simpandata = [
                'Nis' => $Nis, 'NamaSiswa' => $NamaSiswa, 'Alamat'=> $Alamat
            ];

            $db->table('siswa')->insert($simpandata);
            session()->setFlashdata('message','Berhasil import excel'); */
        }
    }
        

    public function submitImportEmployeeStart()
        {
            $file_excel = $this->request->getFile('fileexcel');
            $ext = $file_excel->getClientExtension();
            if($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);
    
            $data = $spreadsheet->getActiveSheet()->toArray();
            foreach($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }
                print_r($row);
                /*
                $Nis = $row[0];
                $NamaSiswa = $row[1];
                $Alamat = $row[2];
    
                $db = \Config\Database::connect();

                $cekNis = $db->table('siswa')->getWhere(['Nis'=>$Nis])->getResult();

                if(count($cekNis) > 0) {
                    session()->setFlashdata('message','<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
                } else {
    
                $simpandata = [
                    'Nis' => $Nis, 'NamaSiswa' => $NamaSiswa, 'Alamat'=> $Alamat
                ];
    
                $db->table('siswa')->insert($simpandata);
                session()->setFlashdata('message','Berhasil import excel'); */
            }
        
            
           // return redirect()->to('/siswa');
        }
        
    public function getAll()
    {
        $areaModel = new \App\Models\AreaModel();
        $areas = $areaModel->findAll();
        return $this->response->setJSON($areas);
    }
}