<?php

namespace App\Models;

use CodeIgniter\Model;

class SiparisModel extends Model
{
    protected $table = 'orders';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['restaurant_id', 'table_id', 'user_id', 'status', 'is_closed'];
}
