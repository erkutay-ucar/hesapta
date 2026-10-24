<?php

namespace App\Models;

use CodeIgniter\Model;

class SiparisKalemiModel extends Model
{
    protected $table = 'order_items';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'unit_price', 'note', 'is_cancelled'];
}
