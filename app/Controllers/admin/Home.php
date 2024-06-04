<?php


namespace App\Controllers\admin;
use App\Controllers\BaseController;

class Home extends BaseController
{
    public function __construct() {
      if(session()->get("role") !== ADMIN_ROLE){
       echo "Direct Access is not alled";
       die;
       return;
      }
 }
    //home function dashboard start from here
    public function index(): string
    {   $data['page_title'] = "Dashboard";
      
        return view(ADMIN.'dashboard',$data);
    }

    
}
