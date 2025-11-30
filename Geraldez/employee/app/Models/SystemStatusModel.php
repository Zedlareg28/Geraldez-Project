<?php
namespace App\Models;

use CodeIgniter\Model;

class SystemStatusModel extends Model
{
    protected $table = 'system_status';
    protected $primaryKey = 'id';
    protected $allowedFields = ['status'];
}
