<?php


namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{    
    protected $validation;
    protected $usermodel;
    public function __construct() {
        if (session()->get("role") !== ADMIN_ROLE) {
            echo "Direct Access is not allowed";
            die;
        }
       // initilize code here 
       $this->validation = \Config\Services::validation();
       $this->usermodel = new UserModel();
    }

   
    public function index()
    {  
        $data['page_title'] = "Users";

        
        return view('admin/user/add_user',$data);
    }
    public function indsex()
    {  
        $data['page_title'] = "Users";

    

        
        return view('admin/user/add_user',$data);
    }

    public function save_user(){
        
      
      
        $this->validation->setRules([
            'username' => 'required',
            'email' => 'required|valid_email',
            'mobile' => 'required|numeric|max_length[11]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ]);

        if (!$this->validate($this->validation->getRules())) {
            return view('admin/user/add_user', ['validation' => $this->validator,'page_title'=>"Users"]);
        }
        $seletecd_role = "";
        $message = "";
        $username = (string) $this->request->getPost('username');
        $email = (string) $this->request->getPost('email');
        $mobile = $this->request->getPost('mobile');
        $password = (string) $this->request->getPost('password');
        $seletecd_role = $this->request->getPost('user');
      
        if($seletecd_role == "accoun"){
            $seletecd_role = ACCOUNTANT_USER;
             $message = ACCOUNTANT_ROLE; 
        }else{
            $seletecd_role = STUDENT_USER;
            $message = STUDENTS_ROLE;
        }
        
        $user_obj = [
            "username"=>$username,
            "email"=>$email,
            "mobile"=>$mobile,
            "password"=>password_hash($password,PASSWORD_DEFAULT),
        ];
        //insert success other then error 
       if($this->usermodel->insert($user_obj)){
        $id  =   $this->usermodel->getInsertID();
        // seting permission to the user 
        if(setUserPersmissions($seletecd_role,$id)){
            return redirect()->to('users')->with('success', ' '.$message.' Successfully Created');        
         }
       }

       session()->setFlashdata('error', 'Error Creating User');
       return view('admin/user/add_user', ['page_title'=>"Users"]);
    }
 
    
    
   public function User_table(){
    $data['page_title'] = "User List";
    $all  =  $this->usermodel->findAll();
    $data['userlist'] = $all;
    return view(ADMIN."user/index", $data);
   } 

  
   public function edit_user($id){
     echo "saurbh";  
    

   }



}










?>