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


class Home extends BaseController
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

    public function getjadwal()
    {
        $jadwal = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();
        if (!$jadwal) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Data tidak ditemukan";
            return json_encode($response);
        }

        $data['data'] = $jadwal;
        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('web/page/component-index/content-jadwal', $data);
        return json_encode($response);
    }

    public function getRekapitulasi()
    {
        $request = Services::request();
        $datamodel = new RekapModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

            $lists = $datamodel->get_datatables($filterJenjang);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                // $row[] = $no;
                // $row['button'] = '<button type="button" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                $row['button'] = '<button type="button" onclick="actionDetailRekapitulasi(\'' . $list->sekolah_id . '\');" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                // $row['jenjang'] = $list->nama_jenjang;
                $row['npsn'] = $list->npsn;
                $row['nama'] = $list->nama;
                $row['jumlah_kuota'] = (int)$list->kuota;
                $row['jumlah_pendaftar'] = (int)$list->pendaftar_terverifikasi + (int)$list->pendaftar_belum_terverifikasi;
                $row['belum_verifikasi'] = (int)$list->pendaftar_belum_terverifikasi;
                $row['terverifikasi'] = (int)$list->pendaftar_terverifikasi;
                $row['id'] = $list->sekolah_id;


                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterJenjang),
                "recordsFiltered" => $datamodel->count_filtered($filterJenjang),
                "data" => $data
            ];
            echo json_encode($output);
        }





        // $output = [
        //     "draw" => $request->getPost('draw'),
        //     "recordsTotal" => 0,
        //     "recordsFiltered" => 0,
        //     "data" => []
        // ];
        // echo json_encode($output);
    }

    public function getKuotasekolah()
    {
        $request = Services::request();
        $datamodel = new KuotaModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

            $lists = $datamodel->get_datatables($filterKecamatan, $filterJenjang);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                // $row[] = $no;
                $row['button'] = '<button type="button" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                // $row['button'] = '<button type="button" onclick="actionDetailKuota(\'' . $list->id . '\');" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                $row['nama'] = $list->nama_sekolah;
                $row['npsn'] = $list->npsn;
                $row['kecamatan'] = $list->nama_kecamatan;
                $row['jumlah'] = (int)$list->zonasi + (int)$list->afirmasi + (int)$list->mutasi + (int)$list->prestasi;
                $row['zonasi'] = $list->zonasi;
                $row['afirmasi'] = $list->afirmasi;
                $row['mutasi'] = $list->mutasi;
                $row['prestasi'] = $list->prestasi;
                $row['id'] = $list->id;


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

    public function getZonasiSekolah()
    {
        $request = Services::request();
        $datamodel = new ZonasiModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

            $lists = $datamodel->get_datatables($filterJenjang);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row['no'] = $no;
                $row['button'] = '<button type="button" onclick="actionDetailZonasi(\'' . $list->id . '\', \'' . $list->npsn . '\');" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                $row['id'] = $list->id;
                $row['npsn'] = $list->npsn;
                $row['nama'] = $list->nama;
                $row['jumlah'] = $list->jumlah . ' Wilayah';
                // $row['datazonasi'] = zonasiDetailWeb($list->npsn);

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterJenjang),
                "recordsFiltered" => $datamodel->count_filtered($filterJenjang),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function getDetailRekapitulasi()
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

            $detail = $this->_db->table('ref_sekolah a')
                ->select("a.npsn, a.status_sekolah, a.id, a.bentuk_pendidikan_id, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'ZONASI') as zonasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'AFIRMASI') as afirmasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'MUTASI') as mutasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'PRESTASI') as prestasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id = a.id AND via_jalur = 'SWASTA') as swasta_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'ZONASI') as zonasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'AFIRMASI') as afirmasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'MUTASI') as mutasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'PRESTASI') as prestasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id = a.id AND via_jalur = 'SWASTA') as swasta_terverifikasi")
                ->where('a.id', $id)
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
            }

            $terverifikasi = $this->_db->table('v_tb_pendaftar')
                ->select("id, kode_pendaftaran,fullname,nisn,nama_sekolah_asal, count(nisn) as jumlahDaftar")
                ->where('tujuan_sekolah_id', $id)
                ->groupBy('nisn')
                ->orderBy('waktu_pendaftaran', 'asc')
                ->get()->getResult();

            $belumverifikasi = $this->_db->table('v_tb_pendaftar_temp')
                ->select("id, kode_pendaftaran,fullname,nisn,nama_sekolah_asal, count(nisn) as jumlahDaftar")
                ->where('tujuan_sekolah_id', $id)
                ->groupBy('nisn')
                ->orderBy('waktu_pendaftaran', 'asc')
                ->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Data ditemukan.";
            $response->data = $detail;
            $response->data_terverifikasi = $terverifikasi;
            $response->data_belum_verifikasi = $belumverifikasi;
            return json_encode($response);
        }
    }

    public function getDetailZonasi()
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
            'name' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Name tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . $this->validator->getError('name');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $name = htmlspecialchars($this->request->getVar('name'), true);

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Data ditemukan.";
            $response->data = zonasiDetailWeb($name);
            return json_encode($response);
        }
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

        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();

        $data['jadwal'] = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        $totalZonasi = $this->_db->table('_setting_kuota_tb')->select("sum(zonasi) as zonasi, sum(afirmasi) as afirmasi, sum(mutasi) as mutasi, sum(prestasi) as prestasi, (select count(*) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'ZONASI') AS pendaftar_zonasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'ZONASI') AS pendaftar_zonasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'AFIRMASI') AS pendaftar_afirmasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'AFIRMASI') AS pendaftar_afirmasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'MUTASI') AS pendaftar_mutasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'MUTASI') AS pendaftar_mutasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'PRESTASI') AS pendaftar_prestasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'PRESTASI') AS pendaftar_prestasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'SWASTA') AS pendaftar_swasta_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'SWASTA') AS pendaftar_swasta_antrian")->limit(1)->get()->getRowObject();

        $data['jumlah_kuota'] = $totalZonasi;

        // $data['jumlah_kuota'] = $this->_db->table('v_jumlah_kuota')
        //     ->select("SUM(zonasi) as zonasi, SUM(afirmasi) as afirmasi, SUM(prestasi) as prestasi, SUM(mutasi) as mutasi, SUM(pendaftar_zonasi_terverifikasi) as pendaftar_zonasi_terverifikasi, SUM(pendaftar_zonasi_antrian) as pendaftar_zonasi_antrian, SUM(pendaftar_afirmasi_terverifikasi) as pendaftar_afirmasi_terverifikasi, SUM(pendaftar_afirmasi_antrian) as pendaftar_afirmasi_antrian, SUM(pendaftar_mutasi_terverifikasi) as pendaftar_mutasi_terverifikasi, SUM(pendaftar_mutasi_antrian) as pendaftar_mutasi_antrian, SUM(pendaftar_prestasi_terverifikasi) as pendaftar_prestasi_terverifikasi, SUM(pendaftar_prestasi_antrian) as pendaftar_prestasi_antrian, SUM(pendaftar_swasta_terverifikasi) as pendaftar_swasta_terverifikasi, SUM(pendaftar_swasta_antrian) as pendaftar_swasta_antrian")
        //     ->get()->getRowObject();

        return view('new-web/page/index', $data);
    }

    public function cari()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'keyword' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Keyword tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('keyword');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('keyword'), true);

            if ($id == "") {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }

            $siswa = $this->_db->table('_users_profil_tb')->select('peserta_didik_id')->where("nisn = '$id' OR nip = '$id'")->get()->getRowObject();

            if (!$siswa) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            if ($siswa->peserta_didik_id == NULL || $siswa->peserta_didik_id == "") {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Dataditemukan.";
            $response->url = base_url('web/home/detail') . '?token=' . $siswa->peserta_didik_id;
            return json_encode($response);
        }
    }

    public function detail()
    {
        $id = htmlspecialchars($this->request->getGet('token'), true);

        // if ($id == "") {
        $response = new \stdClass;
        $response->code = 400;
        $response->token = $id;
        $response->message = "Data tidak ditemukan";
        return json_encode($response);
        // }
    }

    public function indexold()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        // var_dump($user);
        // die;
        if ($user->code == 200) {
            $data['user'] = $user->data;
        }

        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();

        $data['jadwal'] = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        $totalZonasi = $this->_db->table('_setting_kuota_tb')->select("sum(zonasi) as zonasi, sum(afirmasi) as afirmasi, sum(mutasi) as mutasi, sum(prestasi) as prestasi, (select count(*) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'ZONASI') AS pendaftar_zonasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'ZONASI') AS pendaftar_zonasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'AFIRMASI') AS pendaftar_afirmasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'AFIRMASI') AS pendaftar_afirmasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'MUTASI') AS pendaftar_mutasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'MUTASI') AS pendaftar_mutasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'PRESTASI') AS pendaftar_prestasi_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'PRESTASI') AS pendaftar_prestasi_antrian,(select count(0) from _tb_pendaftar where _tb_pendaftar.via_jalur = 'SWASTA') AS pendaftar_swasta_terverifikasi,(select count(0) from _tb_pendaftar_temp where _tb_pendaftar_temp.via_jalur = 'SWASTA') AS pendaftar_swasta_antrian")->limit(1)->get()->getRowObject();

        $data['jumlah_kuota'] = $totalZonasi;

        // $data['jumlah_kuota'] = $this->_db->table('v_jumlah_kuota')
        //     ->select("SUM(zonasi) as zonasi, SUM(afirmasi) as afirmasi, SUM(prestasi) as prestasi, SUM(mutasi) as mutasi, SUM(pendaftar_zonasi_terverifikasi) as pendaftar_zonasi_terverifikasi, SUM(pendaftar_zonasi_antrian) as pendaftar_zonasi_antrian, SUM(pendaftar_afirmasi_terverifikasi) as pendaftar_afirmasi_terverifikasi, SUM(pendaftar_afirmasi_antrian) as pendaftar_afirmasi_antrian, SUM(pendaftar_mutasi_terverifikasi) as pendaftar_mutasi_terverifikasi, SUM(pendaftar_mutasi_antrian) as pendaftar_mutasi_antrian, SUM(pendaftar_prestasi_terverifikasi) as pendaftar_prestasi_terverifikasi, SUM(pendaftar_prestasi_antrian) as pendaftar_prestasi_antrian, SUM(pendaftar_swasta_terverifikasi) as pendaftar_swasta_terverifikasi, SUM(pendaftar_swasta_antrian) as pendaftar_swasta_antrian")
        //     ->get()->getRowObject();

        return view('web/page/index', $data);
    }

    public function register()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code == 200) {
            return redirect()->to(base_url('web/home'));
        }

        $jadwal = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        if (!$jadwal) {
            return redirect()->to(base_url('web/home'));
        }

        $today = date("Y-m-d H:i:s");

        $startdate = strtotime($today);
        $enddateAwal = strtotime($jadwal->tgl_awal_pendaftaran_zonasi);

        if ($startdate < $enddateAwal) {
            return redirect()->to(base_url('web/home'));
        }

        $enddateAkhir = strtotime($jadwal->tgl_akhir_pendaftaran_zonasi);
        if ($startdate > $enddateAkhir) {
            return redirect()->to(base_url('web/home'));
        }

        $data['page'] = "REGISTER || PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'REGISTER || PPDB ONLINE TA. 2023 - 2024';

        return view('web/page/register/index-text', $data);
    }

    public function registertest()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code == 200) {
            return redirect()->to(base_url('web/home'));
        }

        // $jadwal = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        // if(!$jadwal) {
        //     return redirect()->to(base_url('web/home'));
        // }

        // $today = date("Y-m-d H:i:s");

        // $startdate = strtotime($today);
        // $enddateAwal = strtotime($jadwal->tgl_awal_pendaftaran_zonasi);

        // if ($startdate < $enddateAwal) {
        //     return redirect()->to(base_url('web/home'));
        // }

        // $enddateAkhir = strtotime($jadwal->tgl_akhir_pendaftaran_zonasi);
        // if ($startdate > $enddateAkhir) {
        //     return redirect()->to(base_url('web/home'));
        // }

        $data['page'] = "REGISTER || PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'REGISTER || PPDB ONLINE TA. 2023 - 2024';

        return view('web/page/register/index-text', $data);
    }

    public function registerbelumsekolah()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code == 200) {
            return redirect()->to(base_url('web/home'));
        }

        $jadwal = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        if (!$jadwal) {
            return redirect()->to(base_url('web/home'));
        }

        $today = date("Y-m-d H:i:s");

        $startdate = strtotime($today);
        $enddateAwal = strtotime($jadwal->tgl_awal_pendaftaran_zonasi);

        if ($startdate < $enddateAwal) {
            return redirect()->to(base_url('web/home'));
        }

        $enddateAkhir = strtotime($jadwal->tgl_akhir_pendaftaran_zonasi);
        if ($startdate > $enddateAkhir) {
            return redirect()->to(base_url('web/home'));
        }

        $data['page'] = "REGISTER BELUM SEKOLAH || PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'REGISTER BELUM SEKOLAH || PPDB ONLINE TA. 2023 - 2024';

        return view('web/page/register/belum-sekolah', $data);
    }


    public function referensizonasi()
    {

        $data['page'] = "REFERENSI ZONASI SEKOLAH";
        $data['title'] = 'REFERENSI ZONASI SEKOLAH';

        return view('web/page/referensi/zonasi', $data);
    }

    public function rekapitulasi()
    {

        $data['page'] = "REKAPITULASI PPDB";
        $data['title'] = 'REKAPITULASI PPDB';

        return view('web/page/referensi/rekapitulasi', $data);
    }

    public function pengumumanpeserta()
    {
        if (!$this->request->getGet('sekolah')) {
            return redirect()->to(base_url('web/home'));
        }

        $id = htmlspecialchars($this->request->getGet('sekolah'), true);

        $kuota = $this->_db->table('_setting_kuota_tb')->select("zonasi, afirmasi, mutasi, prestasi")->where('sekolah_id', $id)->get()->getRowObject();

        if (!$kuota) {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }

        $sekolah = $this->_db->table('ref_sekolah')->where('id', $id)->get()->getRowObject();

        if (!$sekolah) {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }

        if ((int)$sekolah->status_sekolah != 1) {
            $select = "b.id, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.kode_pendaftaran, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


            $afirmasiData = $this->_db->table('_tb_pendaftar a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id', $id)
                ->where('a.status_pendaftaran', 2)
                ->where('a.via_jalur', 'SWASTA')
                ->orderBy('jarak', 'ASC')
                ->orderBy('a.created_at', 'ASC')
                ->limit((int)$kuota->afirmasi)
                ->get()->getResult();

            $data['data_lolos'] = $afirmasiData;
            $data['sekolah'] = $sekolah;
            return view('web/page/referensi/detaillampiran', $data);
        } else {

            $select = "b.id, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.kode_pendaftaran, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


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
                ->get()->getResultArray();

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
                ->get()->getResultArray();

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
                ->get()->getResultArray();

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
                ->get()->getResultArray();

            $data['data_lolos'] = array_merge($zonasiData, $afirmasiData, $mutasiData, $prestasiData);
            $data['sekolah'] = $sekolah;

            // $response = new \stdClass;
            // $response->code = 200;
            // $response->message = "Data ditemukan.";
            // $response->data_lolos_zonasi = $zonasiData;
            // $response->data_lolos_afirmasi = $afirmasiData;
            // $response->data_lolos_mutasi = $mutasiData;
            // $response->data_lolos_prestasi = $prestasiData;
            return view('web/page/referensi/detaillampiran', $data);
            // $response->data = view('sekolah/riwayat/cetak-pendaftaran', $data);
            // return json_encode($response);
        }
    }

    public function pengumuman()
    {
        $data['title'] = 'Rekapitulasi Analysis Proses';

        return view('web/page/referensi/pengumuman', $data);
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


    public function testAnalisisPageTabulasi()
    {
        // $id = 'F019FA74-8B18-E111-BA17-A569BE39D1A0';
        // $npsn = htmlspecialchars($this->request->getGet('npsn'), true);
        $pengsss = $this->_db->table('_users_tb a')
            ->select("b.*, a.email as username, a.is_active, a.email_verified, c.role, d.nama, d.npsn, e.nama as nama_kecamatan")
            ->join('_users_profil_tb b', 'a.id = b.id', 'LEFT')
            ->join('_role_user c', 'b.role_user = c.id', 'LEFT')
            ->join('ref_sekolah d', 'b.sekolah_id = d.id', 'LEFT')
            ->join('ref_kecamatan e', 'b.kecamatan = e.id', 'LEFT')
            ->where('b.role_user', 4)
            ->orderBy('d.bentuk_pendidikan_id', 'DESC')
            ->get()->getResult();

        $data['data_lolos_zonasi'] = [];
        $data['data_lolos_afirmasi'] = [];
        $data['data_lolos_mutasi'] = [];
        $data['data_lolos_prestasi'] = [];

        foreach ($pengsss as $key => $as) {

            $sekolah = $this->_db->table('ref_sekolah')->select("id, npsn, nama, status_sekolah")->where('npsn', $as->npsn)->get()->getRowObject();

            if (!$sekolah) {
                continue;
                // $response = new \stdClass;
                // $response->code = 400;
                // $response->message = "Ref Sekolah Tidak Ditemukan";
                // return json_encode($response);
            }

            $id = $sekolah->id;

            $kuota = $this->_db->table('_setting_kuota_tb')->select("zonasi, afirmasi, mutasi, prestasi")->where('sekolah_id', $id)->get()->getRowObject();

            if (!$kuota) {
                continue;
                // $response = new \stdClass;
                // $response->code = 400;
                // $response->message = "Kuota Sekolah Tidak Ditemukan";
                // return json_encode($response);
            }

            if ((int)$sekolah->status_sekolah != 1) {
                $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, b.details as data_rinci_peserta, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";

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

                // $response = new \stdClass;
                // $response->code = 200;
                // $response->message = "Data ditemukan.";
                // $response->data_lolos = $zonasiData;
                // return json_encode($response);

                $data['data_lolos_zonasi'] = array_merge($data['data_lolos_zonasi'], $zonasiData);
                // $data['sekolah'] = $sekolah;
                // $data['data_lolos_afirmasi'] = $afirmasiData;
                // $data['data_lolos_mutasi'] = $mutasiData;
                // $data['data_lolos_prestasi'] = $prestasiData;

                // return view('web/page/preview_table', $data);
            } else {

                $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, b.details as data_rinci_peserta, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


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

                $data['data_lolos_zonasi'] = array_merge($data['data_lolos_zonasi'], $zonasiData);
                $data['data_lolos_afirmasi'] = array_merge($data['data_lolos_afirmasi'], $afirmasiData);
                $data['data_lolos_mutasi'] = array_merge($data['data_lolos_mutasi'], $mutasiData);
                $data['data_lolos_prestasi'] = array_merge($data['data_lolos_prestasi'], $prestasiData);

                // $data['data_lolos_zonasi'] = $zonasiData;
                // $data['data_lolos_afirmasi'] = $afirmasiData;
                // $data['data_lolos_mutasi'] = $mutasiData;
                // $data['data_lolos_prestasi'] = $prestasiData;
                // $data['sekolah'] = $sekolah;

                // return view('web/preview_table', $data);
                // return json_encode($response);
            }
        }

        return view('web/preview_table', $data);
    }
}
