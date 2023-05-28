<?php

namespace App\Libraries\V1;
use App\Libraries\Uuid;

class Reftahuntwlib
{
    private $_db;
    private $tb_setting;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb_setting  = $this->_db->table('_ref_tahun_tw');
    }

    public function createTahunAnggaran($tahun, $tw, $is_current = 0) {
        
        $uuidLib = new Uuid();
        
        $data = [
            'id' => $uuidLib->v4(),
            'tahun' => $tahun,
            'tw' => $tw,
            'is_current' => $is_current,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->_db->transBegin();
        try {
            $builder = $this->tb_setting->insert($data);
        } catch (\Throwable $th) {
            $this->_db->transRollback();
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Gagal Menyimpan Tahun TW.";
            return $response;
        }
        
        if($this->_db->affectedRows() > 0) {
            $this->_db->transCommit();
            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "Tahun triwulan berhasil di buat";
            return $response;
        } else {
            $this->_db->transRollback();
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Gagal Menyimpan Tahun TW.";
            return $response;
        }
    }
    
    public function updateTahunAnggaran($id, $tahun, $semester, $max_tmt) {
        $this->tb_setting->set(['tahun' => $tahun, 'semester' => $semester, 'max_tmt' => $max_tmt])->where('id', $id)->update();
        $result = $this->_db->affectedRows();
        
        if($result > 0) {
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Tahun anggaran berhasil di update";
            return $response;
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tahun anggaran gagal di update.";
            return $response;
        }
    }
    
    public function getAllTahunAnggaran() {
        return $this->tb_setting->orderBy('tahun', 'DESC')->orderBy('semester', 'DESC')->get()->getResultObject();
    }
    
    public function getCurrentTahunTw() {
        return $this->tb_setting->where('is_current', 1)->orderBy('tahun', 'DESC')->orderBy('tw', 'DESC')->get()->getRowObject();
    }

}
