<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotapendaftaranModel;
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
        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        $detail = $this->_db->table('ref_sekolah a')
            ->select("a.id, ((SELECT count(id) FROM _tb_pendaftar_temp WHERE via_jalur = 'ZONASI') + (SELECT count(id_pendaftaran) FROM _tb_pendaftar WHERE via_jalur = 'ZONASI')) as zonasi, ((SELECT count(id) FROM _tb_pendaftar_temp WHERE via_jalur = 'AFIRMASI') + (SELECT count(id_pendaftaran) FROM _tb_pendaftar WHERE via_jalur = 'AFIRMASI')) as afirmasi, ((SELECT count(id) FROM _tb_pendaftar_temp WHERE via_jalur = 'MUTASI') + (SELECT count(id_pendaftaran) FROM _tb_pendaftar WHERE via_jalur = 'MUTASI')) as mutasi, ((SELECT count(id) FROM _tb_pendaftar_temp WHERE via_jalur = 'PRESTASI') + (SELECT count(id_pendaftaran) FROM _tb_pendaftar WHERE via_jalur = 'PRESTASI')) as prestasi, ((SELECT count(id) FROM _tb_pendaftar_temp WHERE via_jalur = 'SWASTA') + (SELECT count(id_pendaftaran) FROM _tb_pendaftar WHERE via_jalur = 'SWASTA')) as swasta, ((SELECT count(id) FROM _tb_pendaftar_temp) + (SELECT count(id_pendaftaran) FROM _tb_pendaftar)) as total ")
            ->limit(1)
            ->get()
            ->getRowObject();

        $data['grafik_statistik'] = $detail;

        return view('new-web/page/statistik', $data);
    }

    public function getPendaftaranSekolah()
    {
        $request = Services::request();
        $datamodel = new KuotapendaftaranModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";

            $lists = $datamodel->get_datatables($filterKecamatan, $filterJenjang);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row['no'] = $no;
                $row['button'] = '<div style="vertical-align: inherit;"><button style="height: 38px; width: 38px; border-radius: 50%; padding: 0.75rem 0; justify-content: center;margin: 0; display: inline-flex; cursor: pointer; user-select: none; align-items: center; vertical-align: inherit; text-align: center; overflow: hidden; position: relative; font-size: 1rem; transition: background-color .2s,color .2s,border-color .2s,box-shadow .2s; color: #fff; background: #4527a4; border: 1px solid #4527a4;" type="button" onclick="actionDetailPendaftar(\'' . $list->sekolah_id . '\', \'' . $list->npsn . '\');"><i class="fas fa-search-plus"></i></button></div>';
                $row['id'] = $list->sekolah_id;
                // $row['npsn'] = $list->npsn;
                $row['nama'] = '<div style="font-size: 13px; vertical-align: inherit;">' . $list->nama_sekolah . '<br/>' . $list->npsn . '<br/>' . $list->nama_kecamatan . '<br/><b>Total Kuota : ' . ($list->zonasi + $list->afirmasi + $list->mutasi + $list->prestasi) . '</b><br/><b>Total Diterima : ' . ($list->terverifikasi_zonasi + $list->terverifikasi_afirmasi + $list->terverifikasi_mutasi + $list->terverifikasi_prestasi + $list->terverifikasi_swasta) . '</b><br/><b>Sisa Kuota : ' . (($list->zonasi + $list->afirmasi + $list->mutasi + $list->prestasi) - ($list->terverifikasi_zonasi + $list->terverifikasi_afirmasi + $list->terverifikasi_mutasi + $list->terverifikasi_prestasi + $list->terverifikasi_swasta)) . '</b></div>';
                if ($list->status_sekolah == 1) {
                    $row['zonasi'] = '<div style="font-size: 13px;">Kuota : <b>' . $list->zonasi . '</b>'
                        . '<br/>' . 'Pendaftar : <b>' . $list->pendaftar_zonasi . '</b>'
                        . '<br/>' . 'Terverifikasi : <b>' . $list->terverifikasi_zonasi . '</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>' . $list->belum_verifikasi_zonasi . '</b></div>';
                    $row['afirmasi'] = '<div style="font-size: 13px;">Kuota : <b>' . $list->afirmasi . '</b>'
                        . '<br/>' . 'Pendaftar : <b>' . $list->pendaftar_afirmasi . '</b>'
                        . '<br/>' . 'Terverifikasi : <b>' . $list->terverifikasi_afirmasi . '</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>' . $list->belum_verifikasi_afirmasi . '</b></div>';
                    $row['mutasi'] = '<div style="font-size: 13px;">Kuota : <b>' . $list->mutasi . '</b>'
                        . '<br/>' . 'Pendaftar : <b>' . $list->pendaftar_mutasi . '</b>'
                        . '<br/>' . 'Terverifikasi : <b>' . $list->terverifikasi_mutasi . '</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>' . $list->belum_verifikasi_mutasi . '</b></div>';
                    $row['prestasi'] = '<div style="font-size: 13px;">Kuota : <b>' . $list->prestasi . '</b>'
                        . '<br/>' . 'Pendaftar : <b>' . $list->pendaftar_prestasi . '</b>'
                        . '<br/>' . 'Terverifikasi : <b>' . $list->terverifikasi_prestasi . '</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>' . $list->belum_verifikasi_prestasi . '</b></div>';
                    $row['swasta'] = '<div style="font-size: 13px;">Kuota : <b>0</b>'
                        . '<br/>' . 'Pendaftar : <b>0</b>'
                        . '<br/>' . 'Terverifikasi : <b>0</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>0</b></div>';
                } else {
                    $row['zonasi'] = '<div style="font-size: 13px;">Kuota : <b>0</b>'
                        . '<br/>' . 'Pendaftar : <b>0</b>'
                        . '<br/>' . 'Terverifikasi : <b>0</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>0</b></div>';
                    $row['afirmasi'] = '<div style="font-size: 13px;">Kuota : <b>0</b>'
                        . '<br/>' . 'Pendaftar : <b>0</b>'
                        . '<br/>' . 'Terverifikasi : <b>0</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>0</b></div>';
                    $row['mutasi'] = '<div style="font-size: 13px;">Kuota : <b>0</b>'
                        . '<br/>' . 'Pendaftar : <b>0</b>'
                        . '<br/>' . 'Terverifikasi : <b>0</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>0</b></div>';
                    $row['prestasi'] = '<div style="font-size: 13px;">Kuota : <b>0</b>'
                        . '<br/>' . 'Pendaftar : <b>0</b>'
                        . '<br/>' . 'Terverifikasi : <b>0</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>0</b></div>';
                    $row['swasta'] = '<div style="font-size: 13px;">Kuota : <b>' . ((int)$list->zonasi + (int)$list->afirmasi + (int)$list->mutasi + (int)$list->prestasi) . '</b>'
                        . '<br/>' . 'Pendaftar : <b>' . $list->pendaftar_swasta . '</b>'
                        . '<br/>' . 'Terverifikasi : <b>' . $list->terverifikasi_swasta . '</b>'
                        . '<br/>' . 'Belum Verifikasi : <b>' . $list->belum_verifikasi_swasta . '</b></div>';
                }
                // $row['datazonasi'] = zonasiDetailWeb($list->npsn);

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterKecamatan, $filterJenjang),
                "recordsFiltered" => $datamodel->count_filtered($filterKecamatan, $filterJenjang),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function getDetailPendaftaran()
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

            // $detail = $this->_db->table('ref_sekolah a')
            //     ->select("a.npsn, a.status_sekolah, a.id, a.bentuk_pendidikan_id, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'ZONASI') as zonasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'AFIRMASI') as afirmasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'MUTASI') as mutasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'PRESTASI') as prestasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'SWASTA') as swasta_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'ZONASI') as zonasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'AFIRMASI') as afirmasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'MUTASI') as mutasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'PRESTASI') as prestasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'SWASTA') as swasta_terverifikasi")
            //     ->where('a.id', $id)
            //     ->limit(1)
            //     ->get()
            //     ->getRowObject();

            // if ($detail) {
            //     $detail->zonasi = (int)$detail->zonasi_terverifikasi + (int)$detail->zonasi_belum_terverifikasi;
            //     $detail->afirmasi = (int)$detail->afirmasi_terverifikasi + (int)$detail->afirmasi_belum_terverifikasi;
            //     $detail->mutasi = (int)$detail->mutasi_terverifikasi + (int)$detail->mutasi_belum_terverifikasi;
            //     $detail->prestasi = (int)$detail->prestasi_terverifikasi + (int)$detail->prestasi_belum_terverifikasi;
            //     $detail->swasta = (int)$detail->swasta_terverifikasi + (int)$detail->swasta_belum_terverifikasi;

            //     $detail->total_swasta = $detail->zonasi + $detail->afirmasi + $detail->mutasi + $detail->prestasi + $detail->swasta;
            //     $detail->total_swasta_terverifikasi = (int)$detail->zonasi_terverifikasi + (int)$detail->afirmasi_terverifikasi + (int)$detail->mutasi_terverifikasi + (int)$detail->prestasi_terverifikasi + (int)$detail->swasta_terverifikasi;
            //     $detail->total_swasta_belum_terverifikasi = (int)$detail->zonasi_belum_terverifikasi + (int)$detail->afirmasi_belum_terverifikasi + (int)$detail->mutasi_belum_terverifikasi + (int)$detail->prestasi_belum_terverifikasi + (int)$detail->swasta_belum_terverifikasi;
            // }

            $terverifikasi = $this->_db->table('v_tb_pendaftar')
                ->select("id, kode_pendaftaran, via_jalur, fullname,nisn,nama_sekolah_asal, count(nisn) as jumlahDaftar")
                ->where('tujuan_sekolah_id_1', $id)
                ->groupBy('nisn')
                ->orderBy('waktu_pendaftaran', 'asc')
                ->get()->getResult();

            $belumverifikasi = $this->_db->table('v_tb_pendaftar_temp')
                ->select("id, kode_pendaftaran, via_jalur, fullname,nisn,nama_sekolah_asal, count(nisn) as jumlahDaftar")
                ->where('tujuan_sekolah_id_1', $id)
                ->groupBy('nisn')
                ->orderBy('waktu_pendaftaran', 'asc')
                ->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Data ditemukan.";
            // $response->data = $detail;
            $response->data_terverifikasi = $terverifikasi;
            $response->data_belum_verifikasi = $belumverifikasi;
            return json_encode($response);
        }
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
