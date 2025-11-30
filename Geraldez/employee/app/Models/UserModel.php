<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    // Removed 'email'
    protected $allowedFields = [
        'fullname', 'username', 'password', 'role', 'status', 'last_login'
    ];

    protected $useTimestamps = true;
}
