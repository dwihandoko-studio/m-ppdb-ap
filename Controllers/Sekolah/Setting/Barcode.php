<?php

namespace App\Controllers\Sekolah\Setting;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use Firebase\JWT\JWT;

class Barcode extends BaseController
{
    var $folderImage = 'user';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        
        $data['user'] = $user->data;
        
        $sekolah = $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_id)->get()->getRowObject();
        
        if(!$sekolah) {
            return view('view', ['data' => "Data tidak ditemukan."]);
        }
        
        $data['sekolah'] = $sekolah;

        return view('sekolah/setting/barcode/index', $data);
    }

}
