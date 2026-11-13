<?php

namespace App\Models;

use CodeIgniter\Model;

class SiparisModel extends Model
{
    protected $table = 'orders';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['table_id', 'table_name', 'user_id', 'status', 'is_closed'];
}
