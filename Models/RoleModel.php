<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = '_role_user a';
    protected $primarykey = 'a.id';
    protected $returnType     = 'object';
    protected $allowedFields = ['a.id, a.role, a.created_at, a.updated_at'];

}
