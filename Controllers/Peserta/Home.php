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
        // $statusDaftar = $this->_db->table('_tb_pendaftar a')
        //     ->select("a.*, b.nama as nama_sekolah, b.npsn as npsn_sekolah")
        //     ->join('ref_sekolah_tujuan b', 'a.tujuan_sekolah_id_1 = b.id', 'LEFT')
        //     ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")->orderBy('a.created_at', 'DESC')->limit(1)->get()->getRowObject();
        // if (!($statusDaftar)) {
        //     $statusDaftar = $this->_db->table('_tb_pendaftar_temp a')
        //         ->select("a.*, b.nama as nama_sekolah, b.npsn as npsn_sekolah")
        //         ->join('ref_sekolah_tujuan b', 'a.tujuan_sekolah_id_1 = b.id', 'LEFT')
        //         ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")->orderBy('a.created_at', 'DESC')->limit(1)->get()->getRowObject();
        // }

        // $data['status_pendaftaran'] = $statusDaftar;

        // $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $user->data->peserta_didik_id)->get()->getRowObject();
        $cekRegisterApprove = $this->_db->query("SELECT * FROM (
			(SELECT * FROM _tb_pendaftar_temp WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar_tolak WHERE peserta_didik_id = '{$user->data->peserta_didik_id}')
		) AS a ORDER BY a.created_at DESC LIMIT 1")->getRow();

        if ($cekRegisterApprove) {
            switch ((int)$cekRegisterApprove->status_pendaftaran) {
                case 1:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. <br/>Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    $data['can_daftar'] = false;
                    break;
                case 2:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['can_daftar'] = false;
                    $data['pendaft'] = $cekRegisterApprove;
                    $data['success'] = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.";
                    break;
                case 3:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    if ($cekRegisterApprove->via_jalur == "AFIRMASI") {
                        if ($cekRegisterApprove->keterangan_penolakan == NULL || $cekRegisterApprove->keterangan_penolakan == "") {
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                        } else {
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = $cekRegisterApprove->keterangan_penolakan;
                        }
                        // $data['can_daftar'] = true;
                        // $data['pendaft'] = $cekRegisterApprove;
                        // $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
                    } else {
                        if ($cekRegisterApprove->keterangan_penolakan == NULL || $cekRegisterApprove->keterangan_penolakan == "") {
                            $data['can_daftar'] = false;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                        } else {
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = $cekRegisterApprove->keterangan_penolakan;
                        }
                    }
                    break;

                default:
                    $data['error'] = "Anda sudah melakukan pendaftaran lewat jalur <b>'{$cekRegisterApprove->via_jalur}'</b> dan dalam status menunggu verifikasi berkas.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    break;
            }
        }

        // $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $user->data->peserta_didik_id)->get()->getRowObject();

        // if ($cekRegisterTemp) {
        //     $data['error'] = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas.";
        //     $data['sekolah_pilihan'] = $cekRegisterTemp;
        // }

        // var_dump($data);
        // die;

        // $data['statusPendaftaran'] = $this->_db->table('_tb_pendaftar_temp a')
        //                 ->select('a.id, a.kode_pendaftaran, a.via_jalur, a.lampiran, a.keterangan, a.keterangan_penolakan, a.status_pendaftaran, a.created_at, a.updated_at, a.updated_aproval, a.updated_registered, b.sekolah_id as idSekolahAsal, b.nama as namaSekolahAsal, b.npsn as npsnSekolahAsal, e.sekolah_id as idSekolahAsalLuar, e.nama as namaSekolahAsalLuar, e.npsn as npsnSekolahAsalLuar, c.sekolah_id as idSekolahTujuan, c.nama as namaSekolahTujuan, c.npsn as npsnSekolahTujuan, d.nama as namaSiswa, d.nisn, d.nik, d.tempat_lahir, d.tanggal_lahir, d.jenis_kelamin')
        //                 ->join('_ref_sekolah_asal b', 'a.from_sekolah_id = b.sekolah_id', 'LEFT')
        //                 ->join('_ref_sekolah_luar_kabupaten e', 'a.from_sekolah_id = e.sekolah_id', 'LEFT')
        //                 ->join('_ref_sekolah_tujuan c', 'a.tujuan_sekolah_id = c.sekolah_id', 'LEFT')
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
