<?php
namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employee_id','fullname','position','salary','phone','email','status'
    ];
    protected $useTimestamps = true; // created_at, updated_at
    protected $returnType = 'array';
}
