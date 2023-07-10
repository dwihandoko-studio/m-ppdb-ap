<?php

namespace App\Controllers\Dinas;

use App\Controllers\BaseController;
use App\Models\Dinas\StatistikModel;
use App\Models\Dinas\StatistikswastaModel;
use App\Models\Dinas\StatistikjeniskelaminModel;
use App\Models\Dinas\StatistikkoordinatModel;
// use App\Models\Dinas\Analisis\ProsessekolahhasilModel;
// use App\Models\Dinas\Analisis\ProsessekolahproseshasilModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Prosesluluslib;
use Firebase\JWT\JWT;

class Statistik extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    // public function getAll()
    // {
    //     $request = Services::request();
    //     $datamodel = new ProseshasilModel($request);


    //     $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
    //     $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";
    //     $sekolah_id = htmlspecialchars($request->getVar('sekolah_id'), true) ?? "";

    //     $lists = $datamodel->get_datatables($filterJenjang, $filterJalur, $sekolah_id);
    //     // $lists = [];
    //     $data = [];
    //     $no = $request->getPost("start");
    //     foreach ($lists as $list) {
    //         $no++;
    //         $row = [];

    //         // $row[] = $no;
    //         $action = '<div class="dropup">
    //                     <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //                         <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
    //                     </div>
    //                     <div class="dropdown-menu">
    //                         <button onclick="actionDetail(\'' . $list->id_pendaftaran . '\')" type="button" class="dropdown-item">
    //                             <i class="fa fa-eye"></i>
    //                             <span>Detail</span>
    //                         </button>
    //                     </div>
    //                 </div>';
    //         $row[] = $action;
    //         $row[] = $no;

    //         $row[] = $list->fullname;
    //         $row[] = $list->nisn;
    //         $row[] = $list->via_jalur;
    //         $row[] = $list->jarak . ' Km';
    //         // $row[] = $list->latitude . ' - ' . $list->longitude;
    //         $row[] = $list->nama_sekolah_asal . ' (' . $list->npsn_sekolah_asal . ')';
    //         $row[] = $list->nama_sekolah_tujuan . ' (' . $list->npsn_sekolah_tujuan . ')';

    //         $data[] = $row;
    //     }
    //     $output = [
    //         "draw" => $request->getPost('draw'),
    //         // "recordsTotal" => 0,
    //         // "recordsFiltered" => 0,
    //         "recordsTotal" => $datamodel->count_all($filterJenjang, $filterJalur, $sekolah_id),
    //         "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterJalur, $sekolah_id),
    //         "data" => $data
    //     ];
    //     echo json_encode($output);
    // }

    public function getAllLolos()
    {
        $request = Services::request();
        $datamodel = new StatistiklolosModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        // $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang);
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
            //                 <a target="_blank" href="' . base_url('dinas/analisis/hasil/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </a>';
            // $row[] = $action;
            if ($list->bentuk_pendidikan_id == 6) {
                $row[] = "SMP";
            } else if ($list->bentuk_pendidikan_id == 5) {
                $row[] = "SD";
            } else {
                $row[] = "Not Known";
            }
            $row[] = $list->npsn_sekolah;
            $row[] = $list->nama_sekolah;
            $row[] = $list->nama_kecamatan;
            if ($list->status_sekolah == 1) {
                $row[] = $list->diterima_afirmasi;
                $row[] = $list->diterima_zonasi;
                $row[] = $list->diterima_mutasi;
                $row[] = $list->diterima_prestasi;
                $row[] = 0;
            } else {
                $row[] = 0;
                $row[] = 0;
                $row[] = 0;
                $row[] = 0;
                $row[] = $list->diterima_swasta;
            }
            $row[] = ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta);

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

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new StatistikModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        // $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang);
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
            //                 <a target="_blank" href="' . base_url('dinas/analisis/hasil/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </a>';
            // $row[] = $action;
            if ($list->bentuk_pendidikan_id == 6) {
                $row[] = "SMP";
            } else if ($list->bentuk_pendidikan_id == 5) {
                $row[] = "SD";
            } else {
                $row[] = "Not Known";
            }
            $row[] = $list->npsn_sekolah;
            $row[] = $list->nama_sekolah;
            $row[] = $list->nama_kecamatan;
            $row[] = $list->jumlah_pendaftar_afirmasi;
            $row[] = $list->jumlah_pendaftar_zonasi_1;
            $row[] = $list->jumlah_pendaftar_zonasi_2;
            $row[] = $list->jumlah_pendaftar_zonasi_3;
            $row[] = $list->jumlah_pendaftar_mutasi;
            $row[] = $list->jumlah_pendaftar_prestasi;

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

    public function getAllJenisKelamin()
    {
        $request = Services::request();
        $datamodel = new StatistikjeniskelaminModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        // $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang);
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
            //                 <a target="_blank" href="' . base_url('dinas/analisis/hasil/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </a>';
            // $row[] = $action;
            if ($list->bentuk_pendidikan_id == 6) {
                $row[] = "SMP";
            } else if ($list->bentuk_pendidikan_id == 5) {
                $row[] = "SD";
            } else {
                $row[] = "Not Known";
            }
            $row[] = $list->npsn_sekolah;
            $row[] = $list->nama_sekolah;
            $row[] = $list->nama_kecamatan;
            $row[] = $list->jumlah_l;
            $row[] = $list->jumlah_p;
            $row[] = $list->jumlah_l + $list->jumlah_p;
            // $row[] = $list->jumlah_pendaftar_zonasi_1;
            // $row[] = $list->jumlah_pendaftar_zonasi_2;
            // $row[] = $list->jumlah_pendaftar_zonasi_3;
            // $row[] = $list->jumlah_pendaftar_mutasi;
            // $row[] = $list->jumlah_pendaftar_prestasi;

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

    public function getAllSwasta()
    {
        $request = Services::request();
        $datamodel = new StatistikswastaModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        // $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang);
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
            //                 <a target="_blank" href="' . base_url('dinas/analisis/hasil/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </a>';
            // $row[] = $action;
            if ($list->bentuk_pendidikan_id == 6) {
                $row[] = "SMP";
            } else if ($list->bentuk_pendidikan_id == 5) {
                $row[] = "SD";
            } else {
                $row[] = "Not Known";
            }
            $row[] = $list->npsn_sekolah;
            $row[] = $list->nama_sekolah;
            $row[] = $list->nama_kecamatan;
            $row[] = $list->jumlah_pendaftar;
            // $row[] = $list->jumlah_pendaftar_zonasi_1;
            // $row[] = $list->jumlah_pendaftar_zonasi_2;
            // $row[] = $list->jumlah_pendaftar_zonasi_3;
            // $row[] = $list->jumlah_pendaftar_mutasi;
            // $row[] = $list->jumlah_pendaftar_prestasi;

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

    public function getAllKoordinat()
    {
        $request = Services::request();
        $datamodel = new StatistikkoordinatModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        // $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang);
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
            //                 <a target="_blank" href="' . base_url('dinas/analisis/hasil/sekolah') . '?token=' . $list->tujuan_sekolah_id_1 . '" class="btn btn-primary btn-sm">
            //                     <i class="fa fa-eye"></i>
            //                     <span>Detail</span>
            //                 </a>';
            // $row[] = $action;
            $row[] = $list->nisn;
            $row[] = $list->nama;
            $row[] = $list->npsn_sekolah_asal;
            $row[] = $list->nama_sekolah_asal;
            $row[] = $list->npsn_sekolah_tujuan;
            $row[] = $list->nama_sekolah_tujuan;
            // $row[] = $list->nama_kecamatan;
            $row[] = $list->jarak . ' Km';
            // $row[] = $list->jumlah_pendaftar_zonasi_1;
            // $row[] = $list->jumlah_pendaftar_zonasi_2;
            // $row[] = $list->jumlah_pendaftar_zonasi_3;
            // $row[] = $list->jumlah_pendaftar_mutasi;
            // $row[] = $list->jumlah_pendaftar_prestasi;

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

    public function index()
    {
        return redirect()->to(base_url('dinas/statistik/data'));
    }

    public function data()
    {
        $data['title'] = 'Rekapitulasi Pelaksanaan Sebelum Analisis Zonasi, Mutasi dan Prestasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/statistik/index', $data);
    }

    public function dataswasta()
    {
        $data['title'] = 'Rekapitulasi Pelaksanaan Sebelum Analisis Zonasi, Mutasi dan Prestasi Jalur Swasta';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/statistik/index-swasta', $data);
    }

    public function datalolos()
    {
        $data['title'] = 'Rekapitulasi Hasil Pelaksanaan Peserta Lolos';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/statistik/index-lolos', $data);
    }

    public function datajeniskelamin()
    {
        $data['title'] = 'Rekapitulasi Pelaksanaan Pendaftara Yang Lolos Berdasarkan Jenis Kelamin';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/statistik/index-jenis-kelamin', $data);
    }

    public function datakoordinat()
    {
        $data['title'] = 'Rekapitulasi Pelaksanaan Pendaftaran Data Koordinat';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/statistik/index-koordinat', $data);
    }

    public function sekolah()
    {
        $data['title'] = 'Rekapitulasi Hasil Analysis';
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
        $data['title'] = 'Rekapitulasi Analysis Hasil';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/analisis/hasil/proses', $data);
    }

    // public function proseskelulusan()
    // {

    //     $selectSekolah = "a.id as id_pendaftaran, a.tujuan_sekolah_id_1, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, a.via_jalur, a.created_at, count(a.peserta_didik_id) as jumlah_pendaftar";  //14
    //     $dataSekolahs = $this->_db->table('_tb_pendaftar_lolos a')
    //         ->select($selectSekolah)
    //         ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
    //         ->where('a.status_pendaftaran', 1)
    //         ->groupBy('a.tujuan_sekolah_id_1')
    //         ->where('j.bentuk_pendidikan_id', 6)
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


            $afirmasiData = $this->_db->table('_tb_pendaftar_lolos a')
                ->select($select)
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
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
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->where('a.tujuan_sekolah_id_1', $id)
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
