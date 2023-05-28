<?php

namespace App\Libraries;
use App\Libraries\Uuid;

class Settinglib
{
    private $_db;
    private $tb_setting;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb_setting  = $this->_db->table('_setting_tb');
    }

    public function createTahunAnggaran($tahun, $semester, $max_tmt) {
        
        $uuidLib = new Uuid();
        
        $data = [
            'id' => $uuidLib->v4(),
            'tahun' => $tahun,
            'semester' => $semester,
            'semester' => $semester,
            'max_tmt' => $max_tmt,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->_db->transBegin();
        try {
            $this->tb_setting->set('is_locked', 1)->update();
            $builder = $this->tb_setting->insert($data);
        } catch (\Throwable $th) {
            $this->_db->transRollback();
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $th;
            return $response;
        }
        
        $this->_db->transCommit();
        $response = new \stdClass;
        $response->code = 200;
        $response->data = $data;
        $response->message = "Tahun anggaran berhasil di buat";
        return $response;
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
    
    public function getCurrentTahunAnggaran() {
        return $this->tb_setting->where('is_locked', 0)->orderBy('tahun', 'DESC')->orderBy('semester', 'DESC')->get()->getRowObject();
    }

}
