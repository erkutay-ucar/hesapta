<?php

namespace App\Models;

use CodeIgniter\Model;

class UrunModel extends Model
{
    protected $table = 'products';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['category_id', 'name', 'description', 'price', 'is_active'];
}
