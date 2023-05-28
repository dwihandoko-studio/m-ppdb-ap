<?php

namespace App\Libraries\V1;

use Firebase\JWT\JWT;

class Verifikasihakakseslib
{
    private $_db;
    private $tb;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb  = $this->_db->table('_role_access_user');
    }

    public function cekHakAkses()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    return $this->tb->where('id_user', $userId)->get()->getRowObject();
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
}
