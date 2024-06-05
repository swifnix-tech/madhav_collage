<?php


namespace App\Controllers\admin;
use App\Controllers\BaseController;
use App\Models\DegreeModel;

class Degree extends BaseController
{
    protected $validation;
    protected $degree;
    public function __construct() {
      if(session()->get("role") !== ADMIN_ROLE){
       echo "Direct Access is not alled";
       die;
       return;
      }
      $this->validation = \Config\Services::validation();
     $this->degree =  new DegreeModel();
 }
    public function index(): string
    {   $data['page_title'] = "Degree";
      
        return view(ADMIN.'degree/add_degree',$data);
    }


    public function saveing_degree(){

        $this->validation->setRules([
            'name' => 'required|alpha_space',
        
        ]);

        if (!$this->validate($this->validation->getRules())) {
            return view(ADMIN.'degree/add_degree', ['validation' => $this->validator,'page_title'=>"Degree"]);
        }
       
        $data =  [
            "name" => trim(((string)$this->request->getPost("name")))
        ];
     
         if($this->degree->insert($data))
         {
            return redirect()->to('user_table')->with('success', 'Successfully Created');
         }

    }

    
}
