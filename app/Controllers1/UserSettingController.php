<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

class UserSettingController extends BaseController
{
    public function __construct() {
        session()->set(['title'=>'User Setting']);
        session()->set(['active'=>'user_setting']);
        $this->areaModel = new \App\Models\AreaModel();
        $this->customerModel = new \App\Models\CustomerModel();
    }
    public function index(): string
    {
        session()->set(['active_sub'=>'user_setting']);
        $viewdata['user'] = $this->userModel->find(session()->get('user_id'));

        return view('user_setting/user_setting_index',$viewdata);
    }
    
    public function passwordSubmit(){
        $data = [
            'password'=>password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $update = $this->userModel->set($data)->where('id',session()->get('user_id'))->update();
        if($update){
            $reply['status'] = 1;
        }else{
            $reply['status'] = 0;
        }
        return $this->response->setJSON($reply);
    }
    
    public function profileEditSubmit()
    {
        $data= array(
            'name'=>$this->request->getPost('name'),
            'username'=>$this->request->getPost('username'),
        );
        $update = $this->userModel->set($data)->where('id',session()->get('user_id'))->update();
        $reply = [];
        if($update){
            $reply['status'] = 'success';
            $reply['name'] = $data['name'];
            $reply['username'] = $data['username'];
            session()->set(['username'=>$data['username']]);
        }else{
            $reply['status'] = 'fail';
        }
        return $this->response->setJSON($reply);
        // code...
    }

    public function uploadSignature(){
        // Read new token and assign to $data['token']
         $data['token'] = csrf_hash();

         ## Validation
         $validation = \Config\Services::validation();

         $input = $validation->setRules([
              'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,png],'
         ]);

          if ($validation->withRequest($this->request)->run() == FALSE){

              $data['success'] = 0;
              $data['error'] = $validation->getError('file');// Error response

         }else{

              if($file = $this->request->getFile('file')) {
                    if ($file->isValid() && ! $file->hasMoved()) {
                         // Get file name and extension
                         $name = $file->getName();
                         $ext = $file->getClientExtension();

                         // Get random file name
                         $newName = $file->getRandomName();

                         // Store file in public/uploads/ folder
                         $file->move('../public/uploads/'.session()->get('user_id'), $newName);

                         // File path to display preview
                         $filepath = base_url()."/uploads/".session()->get('user_id').'/'.$newName;

                         // Response
                         $data['status'] = 1;
                         $data['message'] = 'Uploaded Successfully!';
                         $data['filepath'] = $filepath;
                         $data['extension'] = $ext;

                         $this->userModel->set(['signature'=>'/uploads/'.session()->get('user_id').'/'.$newName])
                         ->where('id',session()->get('user_id'))->update();

                    }else{
                         // Response
                         $data['status'] = 2;
                         $data['message'] = 'File not uploaded.'; 
                    }
              }else{
                    // Response
                    $data['status'] = 2;
                    $data['message'] = 'File not uploaded.';
              }
         }
         return $this->response->setJSON($data);
    }
}