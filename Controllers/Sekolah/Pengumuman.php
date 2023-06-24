<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Models\Sekolah\KonfirmasiModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Sekolah\Riwayatlib;
use App\Libraries\Notificationlib;
use App\Libraries\Fcmlib;
use Firebase\JWT\JWT;

class Pengumuman extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function index()
    {
        $data['title'] = 'Rekapitulasi Peserta Lolos';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        return view('sekolah/pengumuman/index', $data);
    }

    public function downloadsptjm()
    {
        $data['title'] = 'Download SPTJM';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $sekolah = $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_id)->get()->getRowObject();

        if ($sekolah) {
            $data['data'] = $sekolah;
            $data['psekolah'] = $this->_db->table('_ref_profil_sekolah')->where('id', $sekolah->id)->get()->getRowObject();
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = view('sekolah/pengumuman/cetak-sptjm', $data);
            return json_encode($response);
        } else {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }
    }

    public function downloadlampiran()
    {
        $data['title'] = 'Download SPTJM';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return view('404', ['data' => "Session Telah Habis."]);
        }

        $id = $user->data->sekolah_id;

        $kuota = $this->_db->table('_setting_kuota_tb')->select("zonasi, afirmasi, mutasi, prestasi")->where('sekolah_id', $id)->get()->getRowObject();

        if (!$kuota) {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }

        $sekolah = $this->_db->table('ref_sekolah')->where('id', $id)->get()->getRowObject();

        if (!$sekolah) {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }

        if ((int)$sekolah->status_sekolah != 1) {
            // $select = "b.id, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.kode_pendaftaran, a.id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";
            $select = "b.id, a.pilihan, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.kode_pendaftaran, a.id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at";


            $afirmasiData = $this->_db->table('_tb_pendaftar_zonasi a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_id = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_id', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'SWASTA')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->afirmasi)
                ->get()->getResult();

            $data['data_lolos'] = $afirmasiData;
            $data['sekolah'] = $sekolah;
            $data['psekolah'] = $this->_db->table('_ref_profil_sekolah')->where('id', $sekolah->id)->get()->getRowObject();
            return view('sekolah/pengumuman/cetak-lampiran-swasta', $data);
        } else {

            // $select = "b.id, a.pilihan, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.kode_pendaftaran, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";
            $select = "b.id, a.pilihan, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.kode_pendaftaran, a.id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at";


            $afirmasiData = $this->_db->table('_tb_pendaftar_zonasi a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'AFIRMASI')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->afirmasi)
                ->get()->getResult();

            $mutasiData = $this->_db->table('_tb_pendaftar_zonasi a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'MUTASI')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->mutasi)
                ->get()->getResult();

            $prestasiData = $this->_db->table('_tb_pendaftar_zonasi a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'PRESTASI')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->prestasi)
                ->get()->getResult();

            $sisaAfirmasi = (int)$kuota->afirmasi - count($afirmasiData);
            $sisaAfirmasiFix = $sisaAfirmasi > 0 ? $sisaAfirmasi : 0;

            $sisaMutasi = (int)$kuota->mutasi - count($mutasiData);
            $sisaMutasiFix = $sisaMutasi > 0 ? $sisaMutasi : 0;

            $sisaPrestasi = (int)$kuota->prestasi - count($prestasiData);
            $sisaPrestasiFix = $sisaPrestasi > 0 ? $sisaPrestasi : 0;

            $limitZonasi = (int)$kuota->zonasi + $sisaAfirmasiFix + $sisaMutasiFix + $sisaPrestasiFix;

            $zonasiData = $this->_db->table('_tb_pendaftar_zonasi a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'ZONASI')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit($limitZonasi)
                ->get()->getResult();

            $data['data_lolos_zonasi'] = $zonasiData;
            $data['data_lolos_afirmasi'] = $afirmasiData;
            $data['data_lolos_mutasi'] = $mutasiData;
            $data['data_lolos_prestasi'] = $prestasiData;
            $data['sekolah'] = $sekolah;

            // $response = new \stdClass;
            // $response->code = 200;
            // $response->message = "Data ditemukan.";
            // $response->data_lolos_zonasi = $zonasiData;
            // $response->data_lolos_afirmasi = $afirmasiData;
            // $response->data_lolos_mutasi = $mutasiData;
            // $response->data_lolos_prestasi = $prestasiData;
            $data['psekolah'] = $this->_db->table('_ref_profil_sekolah')->where('id', $sekolah->id)->get()->getRowObject();
            return view('sekolah/pengumuman/cetak-lampiran', $data);
            // $response->data = view('sekolah/riwayat/cetak-pendaftaran', $data);
            // return json_encode($response);
        }
    }
}
