<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = '_users_tb a';
    protected $primarykey = 'a.id';
    protected $returnType     = 'object';
    protected $allowedFields = ['a.id', 'a.password', 'a.email', 'a.email_verified', 'a.is_active', 'a.created_at', 'a.updated_at'];

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);
        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
    
    public function search($keyword) 
    {
        $where = "a.email LIKE '%$keyword%'";
        return $this->table('_users_tb a')->where($where);
        // return $this->table('_sekolah_tb a')->where(['a.id' => $keyword, 'a.alamat_sekolah' => $keyword, 'a.tingkat_sekolah' => $keyword]);
    }
}
