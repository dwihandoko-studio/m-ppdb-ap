<?php

namespace App\Controllers\Peserta;

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
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $userId = $user->data->id;

        // $data['informasi'] = $this->_db->table('_tb_infopop')->where(['tampil' => 1, 'status' => 1])->whereIn('tujuan_role', [0, 2, 1])->orderBy('created_at', 'desc')->get()->getRowObject();
        $data['pengumumans'] = $this->_db->table('_tb_info_pengumuman')->where(['tampil' => 1, 'status' => 1])->orderBy('created_at', 'desc')->get()->getResult();

        $data['lengkap_data'] = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();
        $data['lengkap_berkas'] = $this->_db->table('_upload_kelengkapan_berkas')->where('user_id', $userId)->get()->getRowObject();
        $statusDaftar = $this->_db->table('_tb_pendaftar a')
            ->select("a.*, b.nama as nama_sekolah, b.npsn as npsn_sekolah")
            ->join('ref_sekolah b', 'a.tujuan_sekolah_id = b.id', 'LEFT')
            ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")->orderBy('a.created_at', 'DESC')->limit(1)->get()->getRowObject();
        if (!($statusDaftar)) {
            $statusDaftar = $this->_db->table('_tb_pendaftar_temp a')
                ->select("a.*, b.nama as nama_sekolah, b.npsn as npsn_sekolah")
                ->join('ref_sekolah b', 'a.tujuan_sekolah_id = b.id', 'LEFT')
                ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")->orderBy('a.created_at', 'DESC')->limit(1)->get()->getRowObject();
        }

        $data['status_pendaftaran'] = $statusDaftar;

        // var_dump($data);
        // die;

        // $data['statusPendaftaran'] = $this->_db->table('_tb_pendaftar_temp a')
        //                 ->select('a.id, a.kode_pendaftaran, a.via_jalur, a.lampiran, a.keterangan, a.keterangan_penolakan, a.status_pendaftaran, a.created_at, a.updated_at, a.updated_aproval, a.updated_registered, b.sekolah_id as idSekolahAsal, b.nama as namaSekolahAsal, b.npsn as npsnSekolahAsal, e.sekolah_id as idSekolahAsalLuar, e.nama as namaSekolahAsalLuar, e.npsn as npsnSekolahAsalLuar, c.sekolah_id as idSekolahTujuan, c.nama as namaSekolahTujuan, c.npsn as npsnSekolahTujuan, d.nama as namaSiswa, d.nisn, d.nik, d.tempat_lahir, d.tanggal_lahir, d.jenis_kelamin')
        //                 ->join('_ref_sekolah b', 'a.from_sekolah_id = b.sekolah_id', 'LEFT')
        //                 ->join('_ref_sekolah_luar_kabupaten e', 'a.from_sekolah_id = e.sekolah_id', 'LEFT')
        //                 ->join('_ref_sekolah c', 'a.tujuan_sekolah_id = c.sekolah_id', 'LEFT')
        //                 ->join('_ref_peserta_didik d', 'a.peserta_didik_id = d.peserta_didik_id', 'LEFT')
        //                 ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _ref_peserta_didik WHERE nisn = '$nisn')")
        //                 ->orderBy('a.created_at', 'desc')
        //                 ->get()->getRowObject();

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('peserta/home', $data);
    }
}
