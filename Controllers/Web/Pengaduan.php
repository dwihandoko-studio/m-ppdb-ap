<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotaModel;

use Config\Services;
use App\Libraries\Profilelib;

class Pengaduan extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'cookie', 'session', 'array', 'imageurl', 'web', 'enskripdes', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        // var_dump($user);
        // die;
        if ($user->code == 200) {
            $data['user'] = $user->data;
        }

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();
        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/pengaduan', $data);
    }
}
