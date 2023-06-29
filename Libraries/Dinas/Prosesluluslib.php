<?php

namespace App\Libraries\Dinas;

use App\Libraries\Uuid;
use Firebase\JWT\JWT;
use App\Libraries\Notificationlib;
use App\Libraries\Fcmlib;

class Prosesluluslib
{
    private $_db;
    private $tb;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function prosesLulusAfirmasiSisa($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $number = $value->jumlah_lolo_afirmasi;
                $this->luluskanASisa($value->id_pendaftaran, $number + ($key + 1), $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesTidakLulusAfirmasiSisa($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $number = $value->jumlah_lolo_afirmasi;
                $this->tidakluluskanASisa($value->id_pendaftaran, $number + ($key + 1), $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesTidakLulusAfirmasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->tidakluluskanA($value, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesTidakLulusMutasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->tidakluluskanM($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesTidakLulusPrestasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->tidakluluskanP($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesTidakLulusZonasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->tidakluluskanZ($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesTidakLulusSwasta($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->tidakluluskanS($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusAfirmasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanA($value, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusMutasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanM($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusPrestasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanP($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusZonasi($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanZ($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    public function prosesLulusSwasta($data, $userId)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                $this->luluskanS($value->id_pendaftaran, $key + 1, $userId);
            }

            return true;
        }

        return true;
    }

    private function tidakluluskanASisa($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 3,
            'rangking' => $urut,
            'ket' => "Kuota Sudah Terpenuhi.",
        ]);
    }

    private function tidakluluskanA($pen, $urut, $userId)
    {
        $data = $this->_db->table('_tb_pendaftar')->where('id', $pen->id_pendaftaran)->update([
            'status_pendaftaran' => 3,
            'rangking' => $urut,
        ]);

        try {

            // $riwayatLib = new Riwayatlib();
            // $riwayatLib->insert("Memverifikasi Pendaftaran {$pen->fullname} via Jalur Afirmasi dengan No Pendaftaran : {$pen->kode_pendaftaran}", "Memverifikasi Pendaftaran Jalur Afirmasi", "submit");

            $saveNotifSystem = new Notificationlib();
            $saveNotifSystem->send([
                'judul' => "Pendaftaran Jalur Afirmasi Tidak Lolos.",
                'isi' => "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . getNamaAndNpsnSekolah($pen->tujuan_sekolah_id_1) . "</b> Melalui Jalur <b>" . $pen->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).",
                // 'isi' => "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . getNamaAndNpsnSekolah($pen->tujuan_sekolah_id_1) . "</b> Melalui Jalur <b>" . $pen->via_jalur . "</b>.",
                'action_web' => 'peserta/riwayat/pendaftaran',
                'action_app' => 'riwayat_pendaftaran_page',
                'token' => $pen->id_pendaftaran,
                'send_from' => $userId,
                'send_to' => $pen->id,
            ]);

            $onesignal = new Fcmlib();
            $send = $onesignal->pushNotifToUser([
                'title' => "Pendaftaran Jalur Afirmasi Tidak Lolos.",
                'content' => "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . getNamaAndNpsnSekolah($pen->tujuan_sekolah_id_1) . "</b> Melalui Jalur <b>" . $pen->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).",
                'send_to' => $pen->id,
                'app_url' => 'riwayat_pendaftaran_page',
            ]);
        } catch (\Throwable $th) {
        }

        return true;
    }

    private function tidakluluskanM($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 3,
            'rangking' => $urut
        ]);
    }

    private function tidakluluskanP($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 3,
            'rangking' => $urut
        ]);
    }

    private function tidakluluskanZ($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 3,
            'rangking' => $urut
        ]);
    }

    private function tidakluluskanS($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 3,
            'rangking' => $urut
        ]);
    }

    private function luluskanASisa($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 2,
            'rangking' => $urut,
            'ket' => "tambahan kuota dari sisa zonasi.",
        ]);
    }

    private function luluskanA($pen, $urut, $userId)
    {
        $data = $this->_db->table('_tb_pendaftar')->where('id', $pen->id_pendaftaran)->update([
            'status_pendaftaran' => 2,
            'rangking' => $urut,
        ]);

        try {

            // $riwayatLib = new Riwayatlib();
            // $riwayatLib->insert("Memverifikasi Pendaftaran {$pen->fullname} via Jalur Afirmasi dengan No Pendaftaran : {$pen->kode_pendaftaran}", "Memverifikasi Pendaftaran Jalur Afirmasi", "submit");

            $saveNotifSystem = new Notificationlib();
            $saveNotifSystem->send([
                'judul' => "Pendaftaran Jalur Afirmasi Telah Lolos.",
                'isi' => "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . getNamaAndNpsnSekolah($pen->tujuan_sekolah_id_1) . "</b> Melalui Jalur <b>" . $pen->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.",
                'action_web' => 'peserta/riwayat/pendaftaran',
                'action_app' => 'riwayat_pendaftaran_page',
                'token' => $pen->id_pendaftaran,
                'send_from' => $userId,
                'send_to' => $pen->id,
            ]);

            $onesignal = new Fcmlib();
            $send = $onesignal->pushNotifToUser([
                'title' => "Pendaftaran Jalur Afirmasi Telah Lolos.",
                'content' => "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . getNamaAndNpsnSekolah($pen->tujuan_sekolah_id_1) . "</b> Melalui Jalur <b>" . $pen->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.",
                'send_to' => $pen->id,
                'app_url' => 'riwayat_pendaftaran_page',
            ]);
        } catch (\Throwable $th) {
        }

        return true;
    }

    private function luluskanM($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 2,
            'rangking' => $urut
        ]);
    }

    private function luluskanP($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 2,
            'rangking' => $urut
        ]);
    }

    private function luluskanZ($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 2,
            'rangking' => $urut
        ]);
    }

    private function luluskanS($id, $urut, $userId)
    {
        return $data = $this->_db->table('_tb_pendaftar')->where('id', $id)->update([
            'status_pendaftaran' => 2,
            'rangking' => $urut
        ]);
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
