<?php

namespace App\Models;

use CodeIgniter\Model;

class RestoranModel extends Model
{
    protected $table = 'restaurants';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'address', 'phone'];
}
