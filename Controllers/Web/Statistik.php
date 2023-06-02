<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotaModel;
use App\Models\Web\ZonasiModel;

use App\Models\Web\RekapModel;
use Config\Services;
use App\Libraries\Profilelib;

use App\Models\Dinas\Analisis\ProsesModel;
use App\Models\Dinas\Analisis\ProsessekolahModel;
use App\Models\Dinas\Analisis\ProsessekolahprosesModel;


class Statistik extends BaseController
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
        $data['page'] = "PPDB ONLINE TA. 2022 - 2023";
        $data['title'] = 'PPDB ONLINE TA. 2022 - 2023';

        return view('new-web/page/statistik', $data);
    }

    public function getPengumuman()
    {
        $request = Services::request();
        $datamodel = new ProsessekolahprosesModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang, $filterJalur);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row['no'] = $no;
            // if($hakAksesMenu) {
            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
            //$action = '<button type="button" onclick="actionDetailAnalisis(\'' . $list->tujuan_sekolah_id . '\')" class="btn btn-primary btn-sm">
            //<i class="fa fa-eye"></i>
            //<span>Detail</span>
            //</button>';

            if ((int)$list->status_sekolah == 1) {
                $action = '<button type="button" onclick="actionDetailAnalisis(\'' . $list->tujuan_sekolah_id . '\')" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>';
            } else {
                $action = '<button type="button" onclick="actionDetailAnalisisSwasta(\'' . $list->tujuan_sekolah_id . '\')" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>';
            }

            $row['aksi'] = $action;
            $row['nama_sekolah_tujuan'] = $list->nama_sekolah_tujuan;
            $row['npsn_sekolah_tujuan'] = $list->npsn_sekolah_tujuan;
            $row['jumlah_pendaftar'] = $list->jumlah_pendaftar;
            $row['tujuan_sekolah_id'] = $list->tujuan_sekolah_id;
            $row['status_sekolah'] = $list->status_sekolah;

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            // "recordsTotal" => 0,
            // "recordsFiltered" => 0,
            "recordsTotal" => $datamodel->count_all($filterJenjang, $filterJalur),
            "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterJalur),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function detailpengumuman()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);

            $kuota = $this->_db->table('_setting_kuota_tb')->select("zonasi, afirmasi, mutasi, prestasi")->where('sekolah_id', $id)->get()->getRowObject();

            if (!$kuota) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Kuota Sekolah Tidak Ditemukan";
                return json_encode($response);
            }

            $sekolah = $this->_db->table('ref_sekolah')->select("status_sekolah")->where('id', $id)->get()->getRowObject();

            if (!$sekolah) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Ref Sekolah Tidak Ditemukan";
                return json_encode($response);
            }

            if ((int)$sekolah->status_sekolah != 1) {
                $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";

                $limitZonasi = (int)$kuota->zonasi + (int)$kuota->afirmasi + (int)$kuota->mutasi + (int)$kuota->prestasi;

                $zonasiData = $this->_db->table('_tb_pendaftar a')
                    ->select($select)
                    ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                    ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                    ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                    ->where('a.tujuan_sekolah_id', $id)
                    ->where('a.status_pendaftaran', 2)
                    ->where('a.via_jalur', 'SWASTA')
                    ->orderBy('jarak', 'ASC')
                    ->orderBy('a.created_at', 'ASC')
                    ->limit($limitZonasi)
                    ->get()->getResult();

                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Data ditemukan.";
                $response->data_lolos = $zonasiData;
                return json_encode($response);
            } else {

                $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


                $afirmasiData = $this->_db->table('_tb_pendaftar a')
                    ->select($select)
                    ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                    ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                    ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                    ->where('a.tujuan_sekolah_id', $id)
                    ->where('a.status_pendaftaran', 2)
                    ->where('a.via_jalur', 'AFIRMASI')
                    ->orderBy('jarak', 'ASC')
                    ->orderBy('a.created_at', 'ASC')
                    ->limit((int)$kuota->afirmasi)
                    ->get()->getResult();

                $mutasiData = $this->_db->table('_tb_pendaftar a')
                    ->select($select)
                    ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                    ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                    ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                    ->where('a.tujuan_sekolah_id', $id)
                    ->where('a.status_pendaftaran', 2)
                    ->where('a.via_jalur', 'MUTASI')
                    ->orderBy('jarak', 'ASC')
                    ->orderBy('a.created_at', 'ASC')
                    ->limit((int)$kuota->mutasi)
                    ->get()->getResult();

                $prestasiData = $this->_db->table('_tb_pendaftar a')
                    ->select($select)
                    ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                    ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                    ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                    ->where('a.tujuan_sekolah_id', $id)
                    ->where('a.status_pendaftaran', 2)
                    ->where('a.via_jalur', 'PRESTASI')
                    ->orderBy('jarak', 'ASC')
                    ->orderBy('a.created_at', 'ASC')
                    ->limit((int)$kuota->prestasi)
                    ->get()->getResult();

                $sisaAfirmasi = (int)$kuota->afirmasi - count($afirmasiData);
                $sisaAfirmasiFix = $sisaAfirmasi > 0 ? $sisaAfirmasi : 0;

                $sisaMutasi = (int)$kuota->mutasi - count($mutasiData);
                $sisaMutasiFix = $sisaMutasi > 0 ? $sisaMutasi : 0;

                $sisaPrestasi = (int)$kuota->prestasi - count($prestasiData);
                $sisaPrestasiFix = $sisaPrestasi > 0 ? $sisaPrestasi : 0;

                $limitZonasi = (int)$kuota->zonasi + $sisaAfirmasiFix + $sisaMutasiFix + $sisaPrestasiFix;

                $zonasiData = $this->_db->table('_tb_pendaftar a')
                    ->select($select)
                    ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                    ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                    ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                    ->where('a.tujuan_sekolah_id', $id)
                    ->where('a.status_pendaftaran', 2)
                    ->where('a.via_jalur', 'ZONASI')
                    ->orderBy('jarak', 'ASC')
                    ->orderBy('a.created_at', 'ASC')
                    ->limit($limitZonasi)
                    ->get()->getResult();

                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Data ditemukan.";
                $response->data_lolos_zonasi = $zonasiData;
                $response->data_lolos_afirmasi = $afirmasiData;
                $response->data_lolos_mutasi = $mutasiData;
                $response->data_lolos_prestasi = $prestasiData;
                return json_encode($response);
            }
        }
    }
}
