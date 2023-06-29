<?php

namespace App\Controllers\Dinas\Analisis;

use App\Controllers\BaseController;
use App\Models\Dinas\Analisis\ProseshasilModel;
use App\Models\Dinas\Analisis\ProsessekolahhasilModel;
use App\Models\Dinas\Analisis\ProsessekolahproseshasilModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Prosesluluslib;
use Firebase\JWT\JWT;

class Hasil extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new ProseshasilModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";
        $sekolah_id = htmlspecialchars($request->getVar('sekolah_id'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang, $filterJalur, $sekolah_id);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            // if($hakAksesMenu) {
            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
            // $action = '<div class="dropup">
            //             <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            //                 <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
            //             </div>
            //             <div class="dropdown-menu">
            //                 <button onclick="actionDetail(\'' . $list->id . '\')" type="button" class="dropdown-item">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </button>
            //             </div>
            //         </div>';
            $row[] = $no;

            $row[] = $list->fullname;
            $row[] = $list->nisn;
            $row[] = $list->via_jalur;
            $row[] = $list->jarak . ' Km';
            // $row[] = $list->latitude . ' - ' . $list->longitude;
            $row[] = $list->nama_sekolah_asal . ' (' . $list->npsn_sekolah_asal . ')';
            $row[] = $list->nama_sekolah_tujuan . ' (' . $list->npsn_sekolah_tujuan . ')';

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            // "recordsTotal" => 0,
            // "recordsFiltered" => 0,
            "recordsTotal" => $datamodel->count_all($filterJenjang, $filterJalur, $sekolah_id),
            "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterJalur, $sekolah_id),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function getAllSekolah()
    {
        $request = Services::request();
        $datamodel = new ProsessekolahhasilModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang, $filterJalur);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            // if($hakAksesMenu) {
            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
            // $action =
            //     '
            //                 <a target="_blank" href="' . base_url('dinas/analisis/proses/sekolah') . '?token=' . $list->tujuan_sekolah_id . '" class="btn btn-primary btn-sm">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </a>';
            $action = '<div class="dropup">
                    <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                    </div>
                    <div class="dropdown-menu">
                        <a target="_blank" href="' . base_url('dinas/analisis/hasil/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i>
                            <span>Detail</span>
                        </a>
                        <a target="_blank" href="' . base_url('dinas/analisis/hasil/download') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
                            <i class="fa fa-eye"></i>
                            <span>Download Hasil</span>
                        </a>
                    </div>
                </div>';
            $row[] = $action;
            $row[] = $list->nama_sekolah_tujuan;
            $row[] = $list->npsn_sekolah_tujuan;
            $row[] = $list->jumlah_pendaftar;

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

    public function index()
    {
        $data['title'] = 'Rekapitulasi Proses Analysis';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/analisis/hasil/sekolah', $data);
    }

    public function sekolah()
    {
        $data['title'] = 'Rekapitulasi Proses Analysis';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['sekolah_id'] = htmlspecialchars($this->request->getGet('token'), true);
        $data['sekolahname'] = $this->_db->table('ref_sekolah')->select("nama, npsn")->where('id', $data['sekolah_id'])->get()->getRowObject();

        return view('dinas/analisis/hasil/index', $data);
    }

    public function getAllProses()
    {
        $request = Services::request();
        $datamodel = new ProsessekolahproseshasilModel($request);


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
            $action =
                '
                            <button type="button" onclick="actionDetailAnalisis(\'' . $list->tujuan_sekolah_id . '\')" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>';
            $row['aksi'] = $action;
            $row['nama_sekolah_tujuan'] = $list->nama_sekolah_tujuan;
            $row['npsn_sekolah_tujuan'] = $list->npsn_sekolah_tujuan;
            $row['jumlah_pendaftar'] = $list->jumlah_pendaftar;
            $row['tujuan_sekolah_id'] = $list->tujuan_sekolah_id;

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


    public function detailanalisis()
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
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Belum Mapping Proses Swasta";
                return json_encode($response);
            }

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


    public function download()
    {
        $data['title'] = 'Download SPTJM';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return view('404', ['data' => "Session Telah Habis."]);
        }

        $id = htmlspecialchars($this->request->getGet('token'), true);

        $kuota = $this->_db->table('_setting_kuota_tb')->select("zonasi, afirmasi, mutasi, prestasi")->where('sekolah_id', $id)->get()->getRowObject();

        if (!$kuota) {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }

        $sekolah = $this->_db->table('ref_sekolah')->where('id', $id)->get()->getRowObject();

        if (!$sekolah) {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }

        if ((int)$sekolah->status_sekolah != 1) {
            $select = "b.id, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.rangking, a.kode_pendaftaran, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


            $afirmasiData = $this->_db->table('_tb_pendaftar a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'SWASTA')
                ->orderBy('a.rangking', 'ASC')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->afirmasi)
                ->get()->getResult();

            $data['data_lolos'] = $afirmasiData;
            $data['sekolah'] = $sekolah;
            return view('dinas/analisis/hasil/cetak-swasta', $data);
        } else {

            $select = "b.id, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.rangking, a.ket, a.kode_pendaftaran, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


            $afirmasiData = $this->_db->table('_tb_pendaftar a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'AFIRMASI')
                ->orderBy('a.rangking', 'ASC')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->afirmasi)
                ->get()->getResult();

            $mutasiData = $this->_db->table('_tb_pendaftar a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'MUTASI')
                // ->orderBy('jarak', 'ASC')
                ->orderBy('a.rangking', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                // ->limit((int)$kuota->mutasi)
                ->get()->getResult();

            $prestasiData = $this->_db->table('_tb_pendaftar a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'PRESTASI')
                ->orderBy('a.rangking', 'ASC')
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

            $zonasiData = $this->_db->table('_tb_pendaftar a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'ZONASI')
                ->orderBy('a.rangking', 'ASC')
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
            return view('dinas/analisis/hasil/cetak', $data);
            // $response->data = view('sekolah/riwayat/cetak-pendaftaran', $data);
            // return json_encode($response);
        }
    }
}
