<?php

namespace App\Controllers;

class AuthKorlapController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'Login Korlap']);
    }

    public function loginPage(): string
    {
        session()->set(['title'=>'Login']);
        return view('auth/login_page_korlap');
    }

    public function loginSubmit(){
        $nip = $this->request->getPost('nip');//pakai nip
        $password = $this->request->getPost('password');

        //tahap1 pakai npk
        $userData = $this->employeeModel->select('tb_employee.*')->where('nip',$nip)->join('tb_customer cust','cust.emp_fc_seq = tb_employee.id')->first();

        if($userData){
            if(password_verify($password,$userData['password'])){
                $currentUser = [
                    'username'=>$userData['name'],
                    'nip' => $userData['nip'],
                    'name'=>$userData['name'],
                    'employee_id' =>$userData['id'],
                    'customer' => $userData['customer_seq'],
                    'user_type' => null,
                ];
                session()->logged = true;
                session()->set($currentUser);
                return redirect()->to('/korlap/employee');
            }else{
                session()->setFlashdata('msg', 'Password tidak sesuai.');
                return redirect()->back()->withInput();
            }
        }else{
            session()->setFlashdata('msg', 'Akun tidak dapat digunakan, hubungi admin');
            return redirect()->back()->withInput();
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('login');
    }

    public function forgot_password(): string{
        return view('auth/forgot_password');
    }

}
