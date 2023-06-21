<?php

namespace App\Libraries\Dinas;

use App\Libraries\Uuid;
use Firebase\JWT\JWT;

class Prosesluluslib
{
    private $_db;
    private $tb;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function prosesLulusAfirmasi($data, $jumlah)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $jumlahData = $this->_db->table('_tb_pendaftar_lolos')->where(['status_pendaftaran' => 2, 'tujuan_sekolah_id_1' => $value->tujuan_sekolah_id_1])->countAllResults();
                if ($jumlahData < $jumlah) {
                    $this->luluskanA($value->id_pendaftaran);
                } else {
                    continue;
                }
            }

            return true;
        }

        return true;
    }

    public function prosesLulusMutasi($data)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanM($value->id_pendaftaran);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusPrestasi($data)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanP($value->id_pendaftaran);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusZonasi($data)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanZ($value->id_pendaftaran);
            }

            return true;
        }

        return true;
    }

    private function luluskanA($id)
    {
        return $data = $this->_db->table('_tb_pendaftar_lolos')->where('id', $id)->update(['status_pendaftaran' => 2]);
    }

    private function luluskanM($id)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update(['status_pendaftaran' => 2]);
    }

    private function luluskanP($id)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update(['status_pendaftaran' => 2]);
    }

    private function luluskanZ($id)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update(['status_pendaftaran' => 2]);
    }


    // public function insert($keterangan, $aksi = "merubah data", $icon = "submit")
    // {
    //     $jwt = get_cookie('jwt');
    //     $token_jwt = getenv('token_jwt.default.key');
    //     if ($jwt) {

    //         try {

    //             $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
    //             if ($decoded) {
    //                 $userId = $decoded->data->id;
    //                 $role = $decoded->data->role;
    //                 $uuidLib = new Uuid();
    //                 $uuid = $uuidLib->v4();
    //                 $dataInsert = [
    //                     'id' => $uuid,
    //                     'user_id' => $userId,
    //                     'keterangan' => $keterangan,
    //                     'aksi' => $aksi,
    //                     'icon' => $icon,
    //                     'created_at' => date('Y-m-d H:i:s'),
    //                 ];
    //                 return $this->_db->table('riwayat_system_dinas')->insert($dataInsert);
    //             } else {
    //                 return true;
    //             }
    //         } catch (\Exception $e) {
    //             return true;
    //         }
    //     } else {
    //         return true;
    //     }
    // }
}
