<?php

namespace App\Libraries;

use Firebase\JWT\JWT;

class Profilelib
{
    private $_db;
    private $tb_profil_user;
    private $_session;
    function __construct()
    {
        helper(['text', 'session', 'cookie', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->_session      = \Config\Services::session();
        $this->tb_profil_user  = $this->_db->table('_users_profil_tb');
    }

    public function user()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    // $select = "a.id, a.peserta_didik_id, a.sekolah_id, a.fullname, a.npsn, a.sekolah_asal, a.nisn, a.latitude, a.longitude, a.email, a.details, a.no_hp as noHp, a.provinsi, a.kabupaten, a.kecamatan, a.kelurahan, a.dusun, a.alamat, a.npsn, a.profile_picture as imageProfile, a.role_user as roleUser, a.created_at as createdAt, a.updated_at as updated_at, a.last_active as lastActive";
                    // $user = $this->_db->table('_users_profil_tb a')
                    $user = $this->_db->table('v_tb_user_peserta a')
                        // ->select($select)
                        // ->join('_users_tb b', 'a.id = b.id', 'LEFT')
                        // ->join('ref_kecamatan c', 'b.kecamatan = c.id', 'LEFT')
                        ->where('a.id', $userId)
                        ->get()->getRowObject();
                    if ($user) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $user;
                    } else {
                        $response = new \stdClass;
                        $response->code = 401;
                        $response->message = "User tidak ditemukan.";
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah habis.";
                }
            } catch (\Exception $e) {

                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
            }
        } else {
            $response = new \stdClass;
            $response->code = 401;
            $response->message = "Session telah habis.";
        }

        return $response;
    }

    public function userSekolah()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    // $select = "a.id, a.fullname, a.email, a.no_hp as noHp, a.provinsi, a.kabupaten, a.kecamatan, a.kelurahan, a.sekolah, a.profile_picture as imageProfile, b.role_user as roleUser, a.created_at as createdAt, a.updated_at as updated_at, b.last_login as lastActive";
                    // $select = "a.id, a.peserta_didik_id, a.sekolah_id, a.fullname, a.npsn, a.sekolah_asal, a.nisn, a.latitude, a.longitude, a.email, a.details, a.no_hp as noHp, a.provinsi, a.kabupaten, a.kecamatan, a.kelurahan, a.dusun, a.alamat, a.npsn, a.profile_picture as imageProfile, a.role_user as roleUser, a.created_at as createdAt, a.updated_at as updated_at, a.last_active as lastActive";
                    $user = $this->_db->table('v_tb_user_sekolah a')
                        // ->select($select)
                        // ->join('_users_tb b', 'a.id = b.id', 'LEFT')
                        // ->join('ref_kecamatan c', 'b.kecamatan = c.id', 'LEFT')
                        ->where('a.id', $userId)
                        ->get()->getRowObject();
                    if ($user) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $user;
                    } else {
                        $response = new \stdClass;
                        $response->code = 401;
                        $response->message = "User tidak ditemukan.";
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah habis.";
                }
            } catch (\Exception $e) {

                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
            }
        } else {
            $response = new \stdClass;
            $response->code = 401;
            $response->message = "Session telah habis.";
        }

        return $response;
    }
}
