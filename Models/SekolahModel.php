<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends Model
{
    protected $table = '_sekolah_tb a';
    protected $primarykey = 'a.id';
    protected $returnType     = 'object';
    protected $allowedFields = ['a.id, a.nama_sekolah, a.alamat_sekolah, a.kecamatan, a.tingkat_sekolah, a.jenis_sekolah, a.kepala_sekolah, a.status_kepala_sekolah, a.created_at, a.updated_at'];
    
    public function search($keyword) 
    {
        $where = "a.id LIKE '%$keyword%' OR a.alamat_sekolah LIKE '%$keyword%' OR a.tingkat_sekolah LIKE '%$keyword%'";
        return $this->table('_sekolah_tb a')->where($where);
        // return $this->table('_sekolah_tb a')->where(['a.id' => $keyword, 'a.alamat_sekolah' => $keyword, 'a.tingkat_sekolah' => $keyword]);
    }

}
