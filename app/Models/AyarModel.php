<?php

namespace App\Models;

use CodeIgniter\Model;

class AyarModel extends Model
{
    protected $table = 'settings';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['restaurant_name', 'address', 'phone', 'kitchen_pin_hash'];
}
