<?php
namespace App\Models;

use CodeIgniter\Model;

class UserActivityModel extends Model
{
    protected $table = 'user_activities';
    protected $primaryKey = 'id';
   protected $allowedFields = [
    'username',
    'activity',
    'ip_address',
    'mac_address',
    'created_at'
];

    protected $updatedField  = '';
}
