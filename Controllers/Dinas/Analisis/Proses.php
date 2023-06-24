<?php

namespace App\Controllers\Dinas\Analisis;

use App\Controllers\BaseController;
use App\Models\Dinas\Analisis\ProsesModel;
use App\Models\Dinas\Analisis\ProsessekolahModel;
use App\Models\Dinas\Analisis\ProsessekolahprosesModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Prosesluluslib;
use Firebase\JWT\JWT;

class Proses extends BaseController
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
        $datamodel = new ProsesModel($request);


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
            $row[] = $list->pilihan;
            $row[] = $list->jarak . ' Km';
            $row[] = $list->nama_sekolah_tujuan . ' (' . $list->npsn_sekolah_tujuan . ')';
            // $row[] = $list->latitude . ' - ' . $list->longitude;
            $row[] = $list->nama_sekolah_asal . ' (' . $list->npsn_sekolah_asal . ')';

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
        $datamodel = new ProsessekolahModel($request);


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
            $action =
                '
                            <a target="_blank" href="' . base_url('dinas/analisis/proses/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </a>';
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

        return view('dinas/analisis/proses/sekolah', $data);
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

        return view('dinas/analisis/proses/index', $data);
    }

    public function verified()
    {
        $data = $this->_db->table('_tb_pendaftar_temp')->get()->getResultArray();
        if (count($data) > 0) {
            print_r("MULAI VERIFIED OTOMATIS<br>");
            foreach ($data as $key => $cekRegisterTemp) {
                $cekRegisterTemp['updated_at'] = date('Y-m-d H:i:s');
                $cekRegisterTemp['updated_aproval'] = date('Y-m-d H:i:s');
                $cekRegisterTemp['admin_approval'] = 'system_auto';
                $cekRegisterTemp['status_pendaftaran'] = 1;

                $this->_db->transBegin();
                $this->_db->table('_tb_pendaftar')->insert($cekRegisterTemp);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();
                    if ($this->_db->affectedRows() > 0) {

                        // try {

                        // $riwayatLib = new Riwayatlib();
                        // $riwayatLib->insert("Memverifikasi Pendaftaran $name Melalui Jalur Afirmasi dengan No Pendaftaran : " . $cekRegisterTemp['kode_pendaftaran'], "Memverifikasi Pendaftaran Jalur Afirmasi", "submit");

                        // $saveNotifSystem = new Notificationlib();
                        // $saveNotifSystem->send([
                        //     'judul' => "Pendaftaran Jalur " . $cekRegisterTemp['via_jalur'] ." Telah Diverifikasi.",
                        //     'isi' => "Pendaftaran anda melalui jalur " . $cekRegisterTemp['via_jalur'] ." telah diverifikasi otomatis by system karena proses verifikasi oleh sekolah sudah di, selanjutnya silahkan menunggu pengumuman sesuai jadwal yang telah ditentukan.",
                        //     'action_web' => 'peserta/riwayat/pendaftaran',
                        //     'action_app' => 'riwayat_pendaftaran_page',
                        //     'token' => $cekRegisterTemp['kode_pendaftaran'],
                        //     'send_from' => $userId,
                        //     'send_to' => $cekRegisterTemp['user_id'],
                        // ]);

                        // $onesignal = new Fcmlib();
                        // $send = $onesignal->pushNotifToUser([
                        //     'title' => "Pendaftaran Jalur Afirmasi Telah Diverifikasi.",
                        //     'content' => "Pendaftaran anda melalui jalur afirmasi telah diverifikasi oleh sekolah tujuan, selanjutnya silahkan menunggu pengumuman sesuai jadwal yang telah ditentukan.",
                        //     'send_to' => $cekRegisterTemp['user_id'],
                        //     'app_url' => 'riwayat_pendaftaran_page',
                        // ]);
                        // } catch (\Throwable $th) {
                        // }

                        $this->_db->transCommit();
                        print_r("BERHASIL VERIVIED AUTO<br>");
                        continue;
                        // $response = new \stdClass;
                        // $response->code = 200;
                        // $response->message = "Verifikasi pendaftaran $name berhasil dilakukan.";
                        // return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        print_r("GAGAL VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
                        continue;
                    }
                } else {
                    $this->_db->transRollback();
                    print_r("GAGAL VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
                    continue;
                }
            }
        } else {
            print_r("TIDAK ADA DATA");
        }
    }

    public function proses()
    {
        $data['title'] = 'Rekapitulasi Analysis Proses';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/analisis/proses/proses', $data);
    }

    // public function proseskelulusan()
    // {

    //     $selectSekolah = "a.id as id_pendaftaran, a.tujuan_sekolah_id_1, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, a.via_jalur, a.created_at, count(a.peserta_didik_id) as jumlah_pendaftar";  //14
    //     $dataSekolahs = $this->_db->table('_tb_pendaftar_lolos a')
    //         ->select($selectSekolah)
    //         ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
    //         ->where('a.status_pendaftaran', 1)
    //         ->groupBy('a.tujuan_sekolah_id_1')
    //         ->where('j.bentuk_pendidikan_id', 5)
    //         ->get()->getResult();

    //     if (count($dataSekolahs) > 0) {
    //         print_r("DATA SEKOLAH " . count($dataSekolahs));
    //         foreach ($dataSekolahs as $key => $id) {
    //             // print_r("SELESAI PROSES KELULUSAN ");
    //             $kuota = $this->_db->table('_setting_kuota_tb')->select("afirmasi")->where('sekolah_id', $id->tujuan_sekolah_id_1)->get()->getRowObject();

    //             if (!$kuota) {
    //                 print_r("KUOTA TIDAK DITEMUKAN ");
    //                 continue;
    //             }

    //             $sekolah = $this->_db->table('ref_sekolah')->select("status_sekolah")->where('id', $id->tujuan_sekolah_id_1)->get()->getRowObject();

    //             if (!$sekolah) {
    //                 print_r("SEKOLAH TIDAK DITEMUKAN ");
    //                 continue;
    //             }

    //             if ((int)$sekolah->status_sekolah != 1) {
    //                 print_r("SEKOLAH SWASTA SKIP ");
    //                 continue;
    //             }

    //             // $

    //             // $limitKuotaAfirmasi = 

    //             $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.id as id_pendaftaran, a.tujuan_sekolah_id_1, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";


    //             $afirmasiData = $this->_db->table('_tb_pendaftar_lolos a')
    //                 ->select($select)
    //                 ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //                 ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //                 ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
    //                 ->where('a.tujuan_sekolah_id_1', $id->tujuan_sekolah_id_1)
    //                 ->where('a.status_pendaftaran', 1)
    //                 ->where('a.via_jalur', 'AFIRMASI')
    //                 ->orderBy('jarak', 'ASC')
    //                 ->orderBy('a.created_at', 'ASC')
    //                 ->limit((int)$kuota->afirmasi)
    //                 ->get()->getResult();

    //             // $mutasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //             //                     ->select($select)
    //             //                     ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //             //                     ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //             //                     ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //             //                     ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //             //                     ->where('a.status_pendaftaran', 1)
    //             //                     ->where('a.via_jalur', 'MUTASI')
    //             //                     ->orderBy('jarak', 'ASC')
    //             //                     ->orderBy('a.created_at', 'ASC')
    //             //                     ->limit((int)$kuota->mutasi)
    //             //                     ->get()->getResult();

    //             // $prestasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //             //                     ->select($select)
    //             //                     ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //             //                     ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //             //                     ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //             //                     ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //             //                     ->where('a.status_pendaftaran', 1)
    //             //                     ->where('a.via_jalur', 'PRESTASI')
    //             //                     ->orderBy('jarak', 'ASC')
    //             //                     ->orderBy('a.created_at', 'ASC')
    //             //                     ->limit((int)$kuota->prestasi)
    //             //                     ->get()->getResult();

    //             // $sisaAfirmasi = (int)$kuota->afirmasi - count($afirmasiData);
    //             // $sisaAfirmasiFix = $sisaAfirmasi > 0 ? $sisaAfirmasi : 0;

    //             // $sisaMutasi = (int)$kuota->mutasi - count($mutasiData);
    //             // $sisaMutasiFix = $sisaMutasi > 0 ? $sisaMutasi : 0;

    //             // $sisaPrestasi = (int)$kuota->prestasi - count($prestasiData);
    //             // $sisaPrestasiFix = $sisaPrestasi > 0 ? $sisaPrestasi : 0;

    //             // $limitZonasi = (int)$kuota->zonasi + $sisaAfirmasiFix + $sisaMutasiFix + $sisaPrestasiFix;

    //             // $zonasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //             //                     ->select($select)
    //             //                     ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //             //                     ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //             //                     ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //             //                     ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //             //                     ->where('a.status_pendaftaran', 1)
    //             //                     ->where('a.via_jalur', 'ZONASI')
    //             //                     ->orderBy('jarak', 'ASC')
    //             //                     ->orderBy('a.created_at', 'ASC')
    //             //                     ->limit($limitZonasi)
    //             //                     ->get()->getResult();

    //             $lulusLib = new Prosesluluslib();

    //             if (count($afirmasiData) > 0) {
    //                 $lulusLib->prosesLulusAfirmasi($afirmasiData, (int)$kuota->afirmasi);
    //             }

    //             // if(count($mutasiData) > 0) {
    //             //     $lulusLib->prosesLulusMutasi($mutasiData);
    //             // }

    //             // if(count($prestasiData) > 0) {
    //             //     $lulusLib->prosesLulusPrestasi($prestasiData);
    //             // }

    //             // if(count($zonasiData) > 0) {
    //             //     $lulusLib->prosesLulusZonasi($zonasiData);
    //             // }
    //         }
    //         print_r("SELESAI PROSES KELULUSAN ");
    //     } else {
    //         print_r("DATA SEKOLAH TIDAK DITEMUKAN");
    //     }
    // }


    public function getAllProses()
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
}
