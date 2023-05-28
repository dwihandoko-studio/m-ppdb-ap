<?php

namespace App\Libraries;

class Penggunalib
{
    private $_db;
    private $tb_user;
    private $_session;
    function __construct()
    {
        helper(['text', 'session', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->_session      = \Config\Services::session();
        $this->tb_user  = $this->_db->table('_users_tb');
        $this->tb_profil_user  = $this->_db->table('_profil_users_tb');
    }

    public function sekolah($keyword = "", $limit = 20, $start = 0)
    {
        $select = "a.id, a.email, a.is_active as isActive, a.email_verified as emailVerified, b.fullname, b.no_hp as noHp, b.npsn as npsn, b.profile_picture as imageProfile, b.last_active as lastActive, b.role_user as roleUser";
        if ($keyword != "") {
            $where = "b.role_user = 0 AND (b.email LIKE '%$keyword%' OR b.fullname LIKE '%$keyword%' OR b.npsn LIKE '%$keyword%')";
        } else {
            $where = "b.role_user = 0";
        }
        $users = $this->_db->table('_profil_users_tb b')
            ->select($select)
            ->join('_users_tb a', 'b.id = a.id', 'LEFT')
            ->where($where)
            ->limit($limit, $start)
            ->get()->getResult();

        $countUsers = $this->_db->table('_profil_users_tb b')->where($where)->countAllResults();
        if ($countUsers > 0) {
            $response = new \stdClass;
            $response->code = 200;
            $response->jumlahData = $users;
            $response->data = $users;
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Belum ada User Sekolah.";
        }

        return $response;
    }
}
