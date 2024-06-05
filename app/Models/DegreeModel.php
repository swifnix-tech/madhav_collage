<?php

namespace App\Models;

use CodeIgniter\Model;

class DegreeModel extends Model
{
    protected $table      = 'degree';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['name', 'create_dte'];


    
}
