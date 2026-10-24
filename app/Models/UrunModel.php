<?php

namespace App\Models;

use CodeIgniter\Model;

class UrunModel extends Model
{
    protected $table = 'products';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['restaurant_id', 'category_id', 'name', 'description', 'price', 'is_active'];
}
