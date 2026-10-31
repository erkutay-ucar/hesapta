<?php

namespace App\Models;

use CodeIgniter\Model;

class KullaniciModel extends Model
{
    protected $table = 'users';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['role', 'name', 'tc', 'password_hash', 'is_active'];
}
