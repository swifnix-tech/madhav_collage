<?php 

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'enrollment_no', 
        'name', 
        'father_name', 
        'mother_name', 
        'dob', 
        'mobile', 
        'email', 
        'abc_id', 
        'category',
        'gender',
        'address',
        'created_date',
        'updated_date',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_date' ;
    protected $updatedField  = 'updated_date';
}








?>