<?php

namespace App\Libraries\Sekolah;

class Updatedatalib
{
    private $_db;
    private $tb;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function unlockUpdate($id) {
        $data = [
            'edited_map' => 0,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->_db->table('_users_profil_tb')->where('id', $id)->update($data);
        $this->_db->table('_upload_kelengkapan_berkas')->where('user_id', $id)->update(['is_locked' => 0]);
        
        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Update Biodata Pengguna berhasil diunlock.";
        return $response;
    }
}
