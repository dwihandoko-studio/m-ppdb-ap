<?php

namespace App\Libraries\V1\Superadmin\Usulan;
use App\Libraries\Uuid;
// use App\Libraries\Settinglib;
use App\Libraries\V1\Reftahuntwlib;

class Usulantamsillib
{
    private $_db;
    private $tb_usulan;
    private $tb_usulan_list_ptk;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb_usulan  = $this->_db->table('_tb_usulan_tamsil');
        $this->tb_usulan_list_ptk  = $this->_db->table('_tb_usulan_detail_tamsil');
    }
    
    // public function getUsulanPtk($id) {
    //     $builder = $this->_db->table('_daftar_ptk_usulan_tpg a');
    //     $select = "a.id, a.kode_usulan, a.id_ptk, a.semester, a.tahun, a.status_usulan, a.admin_approve, a.date_approve, a.admin_reject, a.date_reject, a.keterangan_reject, a.created_at as dateUsulan, a.updated_at as datePerubahanUsulan, b.id as idUsulan, b.npsn, b.jumlah_ptk_diusulkan, b.status_usulan as statusUsulanGroup, b.id as idKodeUsul, b.lampiran_sptjm, b.lampiran_slip_gaji, b.lampiran_sk_pembagian_tugas, b.created_at as created_at_firs, b.updated_at as updated_at_firs, b.created_at_to_process, c.nama, c.nip, c.nik, c.nuptk, c.nrg, c.no_peserta, c.npwp, c.no_rekening, c.cabang_bank, c.jenis_kelamin, c.tempat_lahir, c.tgl_lahir, c.status_tugas, c.tempat_tugas, c.kecamatan, c.id_kecamatan, c.no_hp, c.sk_cpns, c.tgl_cpns, c.sk_pengangkatan, c.tmt_pengangkatan, c.jenis_ptk, c.pendidikan, c.bidang_studi_pendidikan, c.bidang_studi_sertifikasi, c.status_kepegawaian, c.mapel_diajarkan, c.mengajar_lain_satmikal, c.jam_mengajar_perminggu, c.jabatan_kepsek, c.pangkat_golongan, c.nomor_sk_pangkat, c.tgl_sk_pangkat, c.tmt_pangkat, c.masa_kerja_tahun, c.masa_kerja_bulan, c.gaji_pokok, c.sk_kgb, c.tgl_sk_kgb, c.tmt_sk_kgb, c.masa_kerja_tahun_kgb, c.masa_kerja_bulan_kgb, c.gaji_pokok_kgb, c.lampiran_foto, c.lampiran_karpeg, c.lampiran_kgb, c.lampiran_ktp, c.lampiran_nrg, c.lampiran_nuptk, c.lampiran_pangkat, c.lampiran_pernyataan_individu, c.lampiran_serdik, c.lampiran_keterangan_tambahan_jam, c.lampiran_npwp, c.lampiran_buku_rekening, c.lampiran_cuti, c.is_cuti, c.is_locked, c.nomor_sk_impassing, c.tgl_sk_impassing, c.tmt_sk_impassing, c.jabatan_angka_kredit, c.pangkat_golongan_ruang, c.masa_kerja_tahun_impassing, c.masa_kerja_bulan_impassing, c.jumlah_tunjangan_pokok_impassing, c.lampiran_impassing";
    //     $builder->select($select);
    //     $builder->join('_daftar_usulan_tpg b', 'a.kode_usulan = b.kode_usulan', 'LEFT');
    //     $builder->join('_ptk_tb c', 'a.id_ptk = c.id', 'LEFT');
    //     $where = "a.id = '$id'";
    //     $builder->where($where);
    //     $builder->orderBy('c.nama', 'ASC');
    //     return $builder->get()->getRowObject();
    // }
    
    public function getUsulan($id) {
        
        $twLib = new Reftahuntwlib();
        
        $twAktive = $twLib->getCurrentTahunTw();
        
        if(!$twAktive) {
            return [];
        }
        
        $idTw = $twAktive->id;
        
        $builder = $this->_db->table('_tb_usulan_detail_tamsil a');
        $select = "a.*, b.id as idUsulan, b.npsn, b.jumlah_ptk_diusulkan, b.status_usulan as statusUsulanGroup, b.lampiran_sptjm, b.created_at as created_at_firs, b.updated_at as updated_at_firs, b.created_at_to_process, c.nama, c.nip, c.nik, c.nuptk, c.nrg, c.no_peserta, c.npwp, c.no_rekening, c.cabang_bank, c.jenis_kelamin, c.tempat_lahir, c.tgl_lahir, c.status_tugas, c.tempat_tugas, c.kecamatan, c.id_kecamatan, c.no_hp, c.sk_cpns, c.tgl_cpns, c.sk_pengangkatan, c.tmt_pengangkatan, c.jenis_ptk, c.pendidikan, c.bidang_studi_pendidikan, c.bidang_studi_sertifikasi, c.status_kepegawaian, c.mapel_diajarkan, c.jam_mengajar_perminggu, c.jabatan_kepsek, c.pangkat_golongan, c.nomor_sk_pangkat, c.tgl_sk_pangkat, c.tmt_pangkat, c.masa_kerja_tahun, c.masa_kerja_bulan, c.sk_kgb, c.tgl_sk_kgb, c.tmt_sk_kgb, c.masa_kerja_tahun_kgb, c.masa_kerja_bulan_kgb, c.gaji_pokok_kgb, c.lampiran_foto, c.lampiran_karpeg, c.lampiran_ktp, c.lampiran_nrg, c.lampiran_nuptk, c.lampiran_serdik, c.lampiran_npwp, c.lampiran_buku_rekening, c.lampiran_cuti, c.is_cuti, c.is_locked, c.nomor_sk_impassing, c.tgl_sk_impassing, c.tmt_sk_impassing, c.jabatan_angka_kredit, c.pangkat_golongan_ruang, c.masa_kerja_tahun_impassing, c.masa_kerja_bulan_impassing, c.jumlah_tunjangan_pokok_impassing, c.lampiran_impassing, (SELECT id FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as id_kh, (SELECT bulan_1 FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as bulan_1, (SELECT bulan_2 FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as bulan_2, (SELECT bulan_3 FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as bulan_3, (SELECT gaji_pokok FROM ref_gaji WHERE pangkat = c.pangkat_golongan AND masa_kerja = c.masa_kerja_tahun LIMIT 1) as gajiPokok";
        $builder->select($select);
        $builder->join('_tb_usulan_tamsil b', 'a.kode_usulan = b.kode_usulan', 'LEFT');
        $builder->join('_ptk_tb c', 'a.id_ptk = c.id', 'LEFT');
        $where = "a.kode_usulan = '$id'";
        // $where = "a.kode_usulan = (SELECT kode_usulan FROM _tb_usulan_tpg WHERE id='$id')";
        $builder->where($where);
        $builder->orderBy('c.nama', 'ASC');
        return $builder->get()->getResultObject();
    }
    
    public function getUsulanWithId($id) {
        
        $twLib = new Reftahuntwlib();
        
        $twAktive = $twLib->getCurrentTahunTw();
        
        if(!$twAktive) {
            return [];
        }
        
        $idTw = $twAktive->id;
        
        $builder = $this->_db->table('_tb_usulan_detail_tamsil a');
        $select = "a.*, b.id as idUsulan, b.npsn, b.jumlah_ptk_diusulkan, b.status_usulan as statusUsulanGroup, b.lampiran_sptjm, b.created_at as created_at_firs, b.updated_at as updated_at_firs, b.created_at_to_process, c.nama, c.nip, c.nik, c.nuptk, c.nrg, c.no_peserta, c.npwp, c.no_rekening, c.cabang_bank, c.jenis_kelamin, c.tempat_lahir, c.tgl_lahir, c.status_tugas, c.tempat_tugas, c.kecamatan, c.id_kecamatan, c.no_hp, c.sk_cpns, c.tgl_cpns, c.sk_pengangkatan, c.tmt_pengangkatan, c.jenis_ptk, c.pendidikan, c.bidang_studi_pendidikan, c.bidang_studi_sertifikasi, c.status_kepegawaian, c.mapel_diajarkan, c.jam_mengajar_perminggu, c.jabatan_kepsek, c.pangkat_golongan, c.nomor_sk_pangkat, c.tgl_sk_pangkat, c.tmt_pangkat, c.masa_kerja_tahun, c.masa_kerja_bulan, c.sk_kgb, c.tgl_sk_kgb, c.tmt_sk_kgb, c.masa_kerja_tahun_kgb, c.masa_kerja_bulan_kgb, c.gaji_pokok_kgb, c.lampiran_foto, c.lampiran_karpeg, c.lampiran_ktp, c.lampiran_nrg, c.lampiran_nuptk, c.lampiran_serdik, c.lampiran_npwp, c.lampiran_buku_rekening, c.lampiran_cuti, c.is_cuti, c.is_locked, c.nomor_sk_impassing, c.tgl_sk_impassing, c.tmt_sk_impassing, c.jabatan_angka_kredit, c.pangkat_golongan_ruang, c.masa_kerja_tahun_impassing, c.masa_kerja_bulan_impassing, c.jumlah_tunjangan_pokok_impassing, c.lampiran_impassing, (SELECT id FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as id_kh, (SELECT bulan_1 FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as bulan_1, (SELECT bulan_2 FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as bulan_2, (SELECT bulan_3 FROM _absen_kehadiran WHERE id_ptk = a.id_ptk AND id_tahun_tw = '$idTw' ORDER BY created_at DESC LIMIT 1) as bulan_3, (SELECT gaji_pokok FROM ref_gaji WHERE pangkat = c.pangkat_golongan AND masa_kerja = c.masa_kerja_tahun LIMIT 1) as gajiPokok, d.nama_sekolah";
        $builder->select($select);
        $builder->join('_tb_usulan_tamsil b', 'a.kode_usulan = b.kode_usulan', 'LEFT');
        $builder->join('_ptk_tb c', 'a.id_ptk = c.id', 'LEFT');
        $builder->join('_sekolah_tb d', 'b.npsn = d.id', 'LEFT');
        $where = "a.kode_usulan = (SELECT kode_usulan FROM _tb_usulan_tamsil WHERE id='$id')";
        // $where = "a.kode_usulan = (SELECT kode_usulan FROM _tb_usulan_tpg WHERE id='$id')";
        $builder->where($where);
        $builder->orderBy('c.nama', 'ASC');
        return $builder->get()->getResultObject();
    }
    
    // public function getUsulanFromKode($kode) {
    //     $builder = $this->_db->table('_daftar_ptk_usulan_tpg a');
    //     $select = "a.id, a.kode_usulan, a.id_ptk, a.semester, a.tahun, a.status_usulan, a.admin_approve, a.date_approve, a.admin_reject, a.date_reject, a.keterangan_reject, a.created_at as dateUsulan, a.updated_at as datePerubahanUsulan, b.id as idUsulan, b.npsn, b.jumlah_ptk_diusulkan, b.status_usulan as statusUsulanGroup, b.id as idKodeUsul, b.lampiran_sptjm, b.lampiran_slip_gaji, b.lampiran_sk_pembagian_tugas, b.created_at as created_at_firs, b.updated_at as updated_at_firs, b.created_at_to_process, c.nama, c.nip, c.nik, c.nuptk, c.nrg, c.no_peserta, c.npwp, c.no_rekening, c.cabang_bank, c.jenis_kelamin, c.tempat_lahir, c.tgl_lahir, c.status_tugas, c.tempat_tugas, c.kecamatan, c.id_kecamatan, c.no_hp, c.sk_cpns, c.tgl_cpns, c.sk_pengangkatan, c.tmt_pengangkatan, c.jenis_ptk, c.pendidikan, c.bidang_studi_pendidikan, c.bidang_studi_sertifikasi, c.status_kepegawaian, c.mapel_diajarkan, c.jam_mengajar_perminggu, c.jabatan_kepsek, c.pangkat_golongan, c.nomor_sk_pangkat, c.tgl_sk_pangkat, c.tmt_pangkat, c.masa_kerja_tahun, c.masa_kerja_bulan, c.gaji_pokok, c.sk_kgb, c.tgl_sk_kgb, c.tmt_sk_kgb, c.masa_kerja_tahun_kgb, c.masa_kerja_bulan_kgb, c.gaji_pokok_kgb, c.lampiran_foto, c.lampiran_karpeg, c.lampiran_kgb, c.lampiran_ktp, c.lampiran_nrg, c.lampiran_nuptk, c.lampiran_pangkat, c.lampiran_pernyataan_individu, c.lampiran_serdik, c.lampiran_keterangan_tambahan_jam, c.lampiran_npwp, c.lampiran_buku_rekening, c.lampiran_cuti, c.is_cuti, c.is_locked, c.nomor_sk_impassing, c.tgl_sk_impassing, c.tmt_sk_impassing, c.jabatan_angka_kredit, c.pangkat_golongan_ruang, c.masa_kerja_tahun_impassing, c.masa_kerja_bulan_impassing, c.jumlah_tunjangan_pokok_impassing, c.lampiran_impassing";
    //     $builder->select($select);
    //     $builder->join('_daftar_usulan_tpg b', 'a.kode_usulan = b.kode_usulan', 'LEFT');
    //     $builder->join('_ptk_tb c', 'a.id_ptk = c.id', 'LEFT');
    //     $where = "a.kode_usulan = '$kode'";
    //     $builder->where($where);
    //     $builder->orderBy('c.nama', 'ASC');
    //     return $builder->get()->getResultObject();
    // }
    
    // private function _cekPtkAlreadyUsul($id, $tahun, $semester) {
    //     $where = "id_ptk = '$id' AND semester = '$semester' AND tahun = '$tahun' AND (status_usulan IN (0,1,2))";
    //     return $this->tb_usulan_list_ptk->where($where)->countAllResults();
    // }

    // public function createUsulanTpg($userId, $npsn, $listPtk) {
    //     $token = random_string('alnum', 4);
    //     $kode = 'TPG' . '-' .$npsn . '-' . $token . '-' . TIME();
        
    //     $settingLib = new Settinglib();
            
    //     $tahunAnggaran = $settingLib->getCurrentTahunAnggaran();
        
    //     if($tahunAnggaran) {
        
    //         $uuidLib = new Uuid();
            
    //         $dataUsulan = [
    //             'id' => $uuidLib->v4(),
    //             'kode_usulan' => $kode,
    //             'user_id' => $userId,
    //             'npsn' => $npsn,
    //             'tahun' => $tahunAnggaran->tahun,
    //             'semester' => $tahunAnggaran->semester,
    //             'jumlah_ptk_diusulkan' => count($listPtk),
    //             'created_at' => date('Y-m-d H:i:s')
    //         ];
            
    //         $this->_db->transBegin();
            
    //         foreach ($listPtk as $value) {
    //             $uuid = new Uuid();
                
    //             $alreadyOnUsul = $this->_cekPtkAlreadyUsul($value, $tahunAnggaran->tahun, $tahunAnggaran->semester);
                
    //             if($alreadyOnUsul > 0) {
    //                 $ptkActive = $this->_db->table('_ptk_tb')->where('id', $value)->get()->getRowObject();
    //                 if($ptkActive) {
    //                     $this->_db->transRollback();
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "PTK ". $ptkActive->nama . " sudah dalam pengusulan aktif";
    //                     return $response;
    //                 } else {
    //                     $this->_db->transRollback();
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "PTK tidak ditemukan";
    //                     return $response;
    //                 }
    //             }
                
    //             $dataUsulanPtk = [
    //                 'id' => $uuid->v4(),
    //                 'kode_usulan' => $dataUsulan['kode_usulan'],
    //                 'id_ptk' => $value,
    //                 'tahun' => $tahunAnggaran->tahun,
    //                 'semester' => $tahunAnggaran->semester,
    //                 'created_at' => $dataUsulan['created_at']
    //             ];
                
    //             try {
    //                 $this->tb_usulan_list_ptk->insert($dataUsulanPtk);
    //                 $builderUpdateLock = $this->_db->table('_ptk_tb');
    //                 $builderUpdateLock->set('is_locked', 1)->where('id', $value)->update();
    //             } catch (\Throwable $e) {
    //                 $this->_db->transRollback();
                
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = $e;
    //                 return $response;
    //             }
    //         }
            
    //         try {
    //             $builder = $this->tb_usulan->insert($dataUsulan);
    //         } catch (\Throwable $th) {
    //             $this->_db->transRollback();
                
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = $th;
    //             return $response;
    //         }
            
            
    //         $this->_db->transCommit();
            
    //         $response = new \stdClass;
    //         $response->code = 200;
    //         $response->data = $dataUsulan;
    //         $response->message = "Usulan berhasil dibuat";
    //         return $response;
    //     } else {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Belum ada tahun anggaran dan semester di aktifkan.";
    //         return json_encode($response);
    //     }
    // }
    
    // public function updateUsulanToProcess($kodeUsulan) {
    //     $this->_db->transBegin();
    //     $builder = $this->_db->table('_daftar_usulan_tpg');
    //     try {
    //         $builder->set('status_usulan', 1)->where('kode_usulan', $kodeUsulan)->update();
    //     } catch (\Throwable $th) {
    //         $this->_db->transRollback();
    //         return false;
    //     }
        
    //     $builderPtk = $this->_db->table('_daftar_ptk_usulan_tpg');
        
    //     try {
    //         $builderPtk->set('status_usulan', 1)->where('kode_usulan', $kodeUsulan)->update();
    //     } catch (\Throwable $th) {
    //         $this->_db->transRollback();
    //         return false;
    //     }
        
    //     $this->_db->transCommit();
    //     return true;
    // }

}
