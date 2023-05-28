<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaadminModel extends Model
{
    protected $table = '_profil_users_tb b';
    protected $primarykey = 'b.id';
    protected $returnType     = 'object';
    protected $allowedFields = ['b.id', 'b.email', 'b.nip', 'b.fullname', 'b.nip', 'b.no_hp', 'b.jenis_kelamin', 'b.jabatan', 'b.npsn', 'b.profile_picture', 'b.role_user', 'b.last_active', 'b.created_at', 'b.updated_at'];

    public function search($keyword) 
    {
        $where = "a.email LIKE '%$keyword%'";
        return $this->table('_users_tb a')->where($where);
        // return $this->table('_sekolah_tb a')->where(['a.id' => $keyword, 'a.alamat_sekolah' => $keyword, 'a.tingkat_sekolah' => $keyword]);
    }
}
