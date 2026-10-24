<?php

namespace App\Models;

use CodeIgniter\Model;

class KullaniciModel extends Model
{
    protected $table = 'users';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['restaurant_id', 'role', 'name', 'tc', 'username', 'password_hash', 'is_active'];
}
