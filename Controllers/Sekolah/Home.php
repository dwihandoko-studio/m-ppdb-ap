<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;

// header("Access-Control-Allow-Origin: * ");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
        $user = $Profilelib->userSekolah();

        if ($user->code != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['pengumumans'] = $this->_db->table('_tb_info_pengumuman')->where(['tampil' => 1, 'status' => 1])->orderBy('created_at', 'desc')->get()->getResult();

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('sekolah/home', $data);
    }


    public function statistik()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();

        if ($user->code != 200) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $detail = $this->_db->table('ref_sekolah a')
            ->select("a.npsn, a.status_sekolah, a.id, a.bentuk_pendidikan_id, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'ZONASI') as zonasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'AFIRMASI') as afirmasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'MUTASI') as mutasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'PRESTASI') as prestasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'SWASTA') as swasta_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'ZONASI') as zonasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'AFIRMASI') as afirmasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'MUTASI') as mutasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'PRESTASI') as prestasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'SWASTA') as swasta_terverifikasi")
            ->where('a.id', $user->data->sekolah_id)
            ->limit(1)
            ->get()
            ->getRowObject();

        if ($detail) {
            $detail->zonasi = (int)$detail->zonasi_terverifikasi + (int)$detail->zonasi_belum_terverifikasi;
            $detail->afirmasi = (int)$detail->afirmasi_terverifikasi + (int)$detail->afirmasi_belum_terverifikasi;
            $detail->mutasi = (int)$detail->mutasi_terverifikasi + (int)$detail->mutasi_belum_terverifikasi;
            $detail->prestasi = (int)$detail->prestasi_terverifikasi + (int)$detail->prestasi_belum_terverifikasi;
            $detail->swasta = (int)$detail->swasta_terverifikasi + (int)$detail->swasta_belum_terverifikasi;

            $detail->total_swasta = $detail->zonasi + $detail->afirmasi + $detail->mutasi + $detail->prestasi + $detail->swasta;
            $detail->total_swasta_terverifikasi = (int)$detail->zonasi_terverifikasi + (int)$detail->afirmasi_terverifikasi + (int)$detail->mutasi_terverifikasi + (int)$detail->prestasi_terverifikasi + (int)$detail->swasta_terverifikasi;
            $detail->total_swasta_belum_terverifikasi = (int)$detail->zonasi_belum_terverifikasi + (int)$detail->afirmasi_belum_terverifikasi + (int)$detail->mutasi_belum_terverifikasi + (int)$detail->prestasi_belum_terverifikasi + (int)$detail->swasta_belum_terverifikasi;

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = $detail;
            return json_encode($response);
        }
    }
}
