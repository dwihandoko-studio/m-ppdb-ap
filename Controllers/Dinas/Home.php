<?php

namespace App\Controllers\Dinas;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;

class Home extends BaseController
{
    var $folderImage = 'masterdata';
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
        $user = $Profilelib->user();
        // var_dump($user);
        // die;
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['pengumumans'] = $this->_db->table('_tb_info_pengumuman')->where(['tampil' => 1, 'status' => 1])->orderBy('created_at', 'desc')->get()->getResult();
        $data['jumlahPendaftar'] = $this->_db->table('_users_tb')
            ->select("id, (SELECT count(*) from v_tb_pendaftar where via_jalur = 'ZONASI') as pendaftarZonasiVerified, (SELECT count(*) from v_tb_pendaftar where via_jalur = 'AFIRMASI') as pendaftarAfirmasiVerified, (SELECT count(*) from v_tb_pendaftar where via_jalur = 'MUTASI') as pendaftarMutasiVerified, (SELECT count(*) from v_tb_pendaftar where via_jalur = 'PRESTASI') as pendaftarPrestasiVerified, (SELECT count(*) from v_tb_pendaftar where via_jalur = 'SWASTA') as pendaftarSwastaVerified, (SELECT count(*) from v_tb_pendaftar_temp where via_jalur = 'ZONASI') as pendaftarZonasiAntrian, (SELECT count(*) from v_tb_pendaftar_temp where via_jalur = 'AFIRMASI') as pendaftarAfirmasiAntrian, (SELECT count(*) from v_tb_pendaftar_temp where via_jalur = 'MUTASI') as pendaftarMutasiAntrian, (SELECT count(*) from v_tb_pendaftar_temp where via_jalur = 'PRESTASI') as pendaftarPrestasiAntrian, (SELECT count(*) from v_tb_pendaftar_temp where via_jalur = 'SWASTA') as pendaftarSwastaAntrian")
            ->where('id', $user->data->id)
            ->get()->getRowObject();

        // var_dump($data['jumlahPendaftar']);
        // die;

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('dinas/home', $data);
    }
}
