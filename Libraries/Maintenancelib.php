<?php

namespace App\Libraries;

class Maintenancelib
{
    private $_db;
    private $tb;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb  = $this->_db->table('_tb_maintenance');
    }
    
    public function cekMaintenance() {
        return $this->tb->where('status', 1)->countAllResults();
    }
    
    
}
