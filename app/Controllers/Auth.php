<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index(): string
    {
        echo 'this is auth';
        //return view('welcome_message');
    }
    public function login_page(): string
    {
        session()->set(['title'=>'Login']);
        return view('auth/login_page');
    }

    public function loginSubmit(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userData = $this->userModel->select('*')->where('username',$username)
        ->first();

        if($userData){
            if(password_verify($password,$userData['password'])){
                if($userData['status'] == 1){
                    $currentUser = [
                        'username'=>$username,
                        'name'=>$userData['name'],
                        'user_id' => $userData['id'],
                        'user_type' => $userData['user_type_seq'],
                    ];
                    session()->set($currentUser);   
                    if($userData['user_type_seq'] == 2){
                        session()->logged = true;
                        return redirect()->to('employee');
                    }else if($userData['user_type_seq'] == 1){
                        session()->logged = true;
                        //print_r($userData);
                        return redirect()->to('user_manager');
                    }else if($userData['user_type_seq'] == 4){
                        session()->logged = true;
                        return redirect()->to('employee');
                    }
                    else{
                        session()->setFlashdata('msg', 'Akun error, hubungi admin.');
                        return redirect()->back()->withInput(); 
                    }
                }else{
                   session()->setFlashdata('msg', 'Akun dinonaktifkan, hubungi admin.');
                    return redirect()->back()->withInput(); 
                }
            }else{
                session()->setFlashdata('msg', 'Password tidak sesuai.');
                return redirect()->back()->withInput();
            }
        }else{
            session()->setFlashdata('msg', 'Username tidak terdaftar.');
            return redirect()->back()->withInput();
        }
    }

    public function logout(){
        $redirect = 'login';
        if(session()->get('employee_id')!=null){
            $redirect = 'korlap/login';
        }
        session()->destroy();
        return redirect()->to($redirect);
    }

    public function forgot_password(): string{
        return view('auth/forgot_password');
    }

}
