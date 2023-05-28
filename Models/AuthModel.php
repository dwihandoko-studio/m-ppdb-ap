<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class AuthModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function getByOauthId($id)
    {
        return $this->db->table('_users_tb')->where('oauth_google', $id)->get()->getRowObject();
    }

    public function getEmail($email)
    {
        return $this->db->table('_users_tb')->where('email', $email)->get()->getRowObject();
    }

    public function insertGoogle($data)
    {
        $this->db->table('_users_tb')->insert($data);
        return $this->db->affectedRows();
    }

    public function insertProfilGoogle($data)
    {
        $this->db->table('_users_profil_tb')->insert($data);
        return $this->db->affectedRows();
    }

    public function updateGoogle($data, $id)
    {
        $this->db->table('_users_tb')->where('oauth_google', $id)->update($data);
        return $this->db->affectedRows();
    }

    public function updateProfilGoogle($data, $id)
    {
        $this->db->table('_users_profil_tb')->where('id', $id)->update($data);
        return $this->db->affectedRows();
    }
}
