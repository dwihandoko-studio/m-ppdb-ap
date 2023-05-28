<?php

namespace App\Libraries\V1;
use App\Libraries\Uuid;

class Settingsptjmlib
{
    private $_db;
    private $tb_setting;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb_setting  = $this->_db->table('_setting_sptjm_tb');
    }

    public function getSptjm() {
        return $this->tb_setting->where('id', 2)->get()->getRowObject();
    }

    public function getSptjmTamsil() {
        return $this->tb_setting->where('id', 3)->get()->getRowObject();
    }

}
