<?php

// 1 get_detail of app
// 2 get User Permissions list;


function getAppDetails($rows ,$filds){
 $model = db_connect();
    if($filds === null){
        return "null";
    }
  $row = $model->table('setting')->where("id",$rows)->get()->getResult("array");
  if($row ===null){ 
      return "null";
  }else
  {
    return $row[0][$filds];
  }
 }

//give  normal password 
function get_Permission($email , $password){
    $db = db_connect();
    
   if($email && $password ==null){
      throw new Exception("User Permission not found Wrong emailPassword");
      return;
   }
   // fetching user info 
   $row = $db->table("user")->where("email",$email)->get()->getResultArray();
   // if password match 
   if($row && password_verify($password ,$row[0]['password'])){
     
   $user_persmisson =  $db->table("user_permission")->where("user",$row[0]['id'])->get()->getResult("array");
   return $user_persmisson[0];
   }

}

function setUserPersmissions($role,$user_id){
   $db  = db_connect();
   $data = [
    "user"=>$user_id,
    "user_group"=>$role,
   ];

   if($db->table("user_permission")->insert($data)){
     return true;
   }
   return false;
  }



?>