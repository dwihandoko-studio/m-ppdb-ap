<?php

namespace App\Models;

use CodeIgniter\Model;

class PtkModel extends Model
{
    protected $table = '_ptk_tb a';
    protected $primarykey = 'a.id';
    protected $returnType     = 'object';
    protected $allowedFields = ['a.id, a.nama, a.nik, a.nuptk, a.nip, a.nrg, a.jenis_kelamin, a.tempat_lahir, a.tgl_lahir, a.status_tugas, a.tempat_tugas, a.npsn, a.kecamatan, a.id_kecamatan, a.no_hp, a.sk_cpns, a.tgl_cpns, a.sk_pengangkatan, a.tmt_pengangkatan, a.jenis_ptk, a.pendidikan, a.bidang_studi_pendidikan, a.bidang_studi_sertifikasi, a.status_kepegawaian, a.mapel_diajarkan, a.jam_mengajar_perminggu, a.jabatan_kepsek, a.pangkat_golongan, a.nomor_sk_pangkat, a.tgl_sk_pangkat, a.tmt_pangkat, a.masa_kerja_tahun, a.masa_kerja_bulan, a.gaji_pokok, a.sk_kgb, a.tgl_sk_kgb, a.tmt_sk_kgb, a.masa_kerja_tahun_kgb, a.masa_kerja_bulan_kgb, a.gaji_pokok_kgb, a.created_at, a.updated_at'];
    
    public function search($keyword) 
    {
        $where = "a.nama LIKE '%$keyword%' OR a.nik LIKE '%$keyword%' OR a.nuptk LIKE '%$keyword%' OR a.nip LIKE '%$keyword%' OR a.nrg LIKE '%$keyword%' OR a.npsn LIKE '%$keyword%'";
        return $this->table('_ptk_tb a')->where($where);
        // return $this->table('_sekolah_tb a')->where(['a.id' => $keyword, 'a.alamat_sekolah' => $keyword, 'a.tingkat_sekolah' => $keyword]);
    }

}
