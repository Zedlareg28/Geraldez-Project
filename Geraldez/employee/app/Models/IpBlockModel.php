<?php
namespace App\Models;

use CodeIgniter\Model;

class IpBlockModel extends Model
{
    protected $table = 'ip_blocks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ip_address', 'reason', 'blocked_by', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}