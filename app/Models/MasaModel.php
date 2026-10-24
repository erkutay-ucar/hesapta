<?php

namespace App\Models;

use CodeIgniter\Model;

class MasaModel extends Model
{
    protected $table = 'restaurant_tables';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['restaurant_id', 'name', 'is_active'];
}
