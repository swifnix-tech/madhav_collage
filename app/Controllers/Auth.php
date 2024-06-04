<?php


namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
  protected $validation;
  public function __construct() {

    $this->validation = \Config\Services::validation();
  }


    // admin login view
    public function index(): string
    {   

      
       return view('login');
    }

    public function get_login()
    {
        $email = (string) $this->request->getPost('email');
        $password = (string) $this->request->getPost('password');
        $remember_me = $this->request->getPost('remember_me');

        $this->validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required'
        ]);

        if (!$this->validate($this->validation->getRules())) {
            return view('login', ['validation' => $this->validator]);
        }

        $userModel = new UserModel();
        $user = $userModel->where("email", $email)->first();
       if($user['status'] == LOGIN_PERMISSION){
        if ($user && password_verify($password, $user['password'])) {
            // Assuming get_Permission is a helper function that returns user permission details
            $permissionRow = get_Permission($email, $password);
            $permission = $permissionRow['user_group'];

            if ($remember_me) {
                $cookie = [
                    'name' => 'remember_me',
                    'value' => base64_encode(json_encode(['email' => $email, 'password' => $user['password']])),
                    'expire' => 30 * 24 * 60 * 60,
                    'httponly' => true,
                ];
                $this->response->setCookie($cookie);
            }

            switch ($permission) {
                case SUPPER_USER:
                    $this->set_UserSession($user, ADMIN_ROLE);
                    return redirect()->to('admin')->with('success', 'Successfully logged In');
                
                case ACCOUNTANT_USER:
                    $this->set_UserSession($user, ACCOUNTANT_ROLE);
                    return redirect()->to('accountant')->with('success', 'Successfully logged In');
                
                case STUDENT_USER:
                    $this->set_UserSession($user, STUDENTS_ROLE);
                    return redirect()->to('student')->with('success', 'Successfully logged In');
                
                default:
                    session()->setFlashdata('error', 'Invalid user group');
                    return view('login');
            }
        }
       }
       else{
        return redirect()->to('login')->with('error', 'You are block by the Administration');
       }
        session()->setFlashdata('error', 'Invalid email or password');
        return view('login');
    }


   // password_hash($password, PASSWORD_DEFAULT);

   public function set_UserSession($data,$role){
    $user = [
        'id' => $data['id'],
        'email' => $data['email'],
        'name' => $data['username'],
        'role' => $role,
        'isLoggedIn' => true
    ];
    session()->set($user);
   }
 


   public function logout()
   {
       session()->destroy();
       delete_cookie('remember_me');
       return redirect()->to('/login');
   }


}
