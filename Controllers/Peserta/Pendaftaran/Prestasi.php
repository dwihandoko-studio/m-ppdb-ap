<?php

namespace App\Controllers\Peserta\Pendaftaran;

use App\Controllers\BaseController;
use App\Libraries\Peserta\Datalib;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Peserta\Riwayatlib;
use Firebase\JWT\JWT;

class Prestasi extends BaseController
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
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            $response = new \stdClass;
            $response->code = 401;
            $response->message = "Session telah habis.";
            return json_encode($response);
        }
        $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();

        if (!$getCurrentUser) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }

        $keyword = htmlspecialchars($this->request->getVar('keyword'), true) ?? "";
        $page = htmlspecialchars($this->request->getVar('page'), true);

        $limit_per_page = 10;

        if ((int)$page == 0 || (int)$page == 1) {
            $page = 1;
            $start = 0;
        } else {
            $page = (int)$page;
            $start = (($page - 1) * $limit_per_page);
        }
        $dataCurrentUser = json_decode($getCurrentUser->details);
        // $andWhere = "a.jumlah_rombel_kebutuhan > 0";
        $andWhere = "a.status_sekolah = '1'";

        if ((int)$dataCurrentUser->tingkat_pendidikan == 6) {
            $andWhere .= " AND (a.bentuk_pendidikan_id IN (6,10,31,32,33,35,36))";
        } else {
            $andWhere .= " AND (a.bentuk_pendidikan_id IN (5,9,30,31,32,33,38))";
        }

        $where = "$andWhere";

        if ($keyword !== "") {
            $where .= " AND (a.npsn = '$keyword' OR a.nama LIKE '%$keyword%')";
        }

        $data['result'] = $this->_db->table('v_tb_sekolah_kuota a')
            ->select("a.*, DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude)) * COS(RADIANS({$getCurrentUser->latitude})) * COS(RADIANS(a.Longitude - {$getCurrentUser->longitude})) + SIN(RADIANS(a.Latitude)) * SIN(RADIANS({$getCurrentUser->latitude}))))) AS distance_in_km")
            ->join('_users_profil_tb b', 'b.sekolah_id = a.id')
            // $data['result'] = $this->_db->table('ref_provinsi a')
            //         //RUMUS JARAK (111.111 *
            // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
            //      * COS(RADIANS(b.Latitude))
            //      * COS(RADIANS(a.Longitude - b.Longitude))
            //      + SIN(RADIANS(a.Latitude))
            //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
            // ->select("b.*, c.nama as nama_jenjang_pendidikan, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, ")
            // ->join('ref_sekolah b', 'a.sekolah_id = b.id')
            // ->join('ref_bentuk_pendidikan c', 'a.bentuk_pendidikan_id = c.id')
            // ->join('ref_kecamatan f', 'b.kode_wilayah = f.id')
            // ->join('ref_kabupaten e', 'f.id_kabupaten = e.id')
            // ->join('ref_provinsi d', 'e.id_provinsi = d.id')
            ->where($where)
            ->orderBy('distance_in_km', 'asc')
            // ->orderBy('a.created_at', 'asc')
            ->limit($limit_per_page, $start)
            ->get()->getResult();
        $data['countData'] = $this->_db->table('v_tb_sekolah_kuota a')
            ->join('_users_profil_tb b', 'b.sekolah_id = a.id')
            ->where($where)->countAllResults();
        // $data['countData'] = $this->_db->table('ref_provinsi a')->where($where)->countAllResults();
        $data['page'] = $page;
        $data['user'] = $getCurrentUser;
        $data['totalPage'] = ($data['countData'] > 0) ? ceil($data['countData'] / $limit_per_page) : 0;
        $data['keyword'] = $keyword;

        if ($data['countData'] > 0) {
            if (count($data['result']) > 0) {
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('peserta/pendaftaran/prestasi/pilihan-zonasi', $data);
                $response->pagination = view('peserta/pendaftaran/prestasi/pilihan-pagination', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 204;
                $response->message = "Tidak ada data.";
                return json_encode($response);
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }
    }

    public function index()
    {
        $data['title'] = 'DAFTAR JALUR PRESTASI';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("PRESTASI");

        if ($canDaftar->code !== 200) {
            $data['jalur'] = "PRESTASI";
            $data['message'] = $canDaftar->message . " untuk <b>Jalur Prestasi</b>.";
            return view('peserta/pendaftaran/tutup', $data);
        }

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
                        $data['can_daftar'] = true;
                        $data['pendaft'] = $cekRegisterApprove;
                        $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
                    } else {
                        $data['can_daftar'] = false;
                        $data['pendaft'] = $cekRegisterApprove;
                        $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                    }
                    break;

                default:
                    $data['error'] = "Anda sudah melakukan pendaftaran lewat jalur <b>'{$cekRegisterApprove->via_jalur}'</b> dan dalam status menunggu verifikasi berkas.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    break;
            }
        }


        return view('peserta/pendaftaran/prestasi/index', $data);
    }

    public function getpilihanprestasi()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("PRESTASI");

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
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
            $response->message = $this->validator->getError('nama') . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $id = htmlspecialchars($this->request->getVar('id'), true);

            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }

            $peserta = $this->_db->table('_users_profil_tb a')
                ->select("a.*, b.lampiran_akta_kelahiran, b.lampiran_kk, b.lampiran_lulus, b.lampiran_afirmasi, b.lampiran_prestasi, b.lampiran_mutasi, b.lampiran_lainnya")
                ->join('_upload_kelengkapan_berkas b', 'a.id = b.user_id', 'LEFT')
                ->where('a.id', $user->data->id)
                ->get()->getRowObject();
            if (!$peserta) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data anda belum lengkap, silahkan lengkapi data terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_akta_kelahiran == null || $peserta->lampiran_kk == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran dokumen Akta dan Kartu Keluarga terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_lulus == null) {
                if (substr($user->data->nisn, 0, 2) == "BS") {
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran surat keterangan lulus (sertifikat kelulusan) terlebih dahulu.";
                    return json_encode($response);
                }
            }

            if ($peserta->lampiran_prestasi == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen prestasi anda belum lengkap, silahkan lengkapi lampiran dokumen prestasi terlebih dahulu.";
                return json_encode($response);
            }

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
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
                        } else {
                            $data['can_daftar'] = false;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                        }
                        break;

                    default:
                        $data['error'] = "Anda sudah melakukan pendaftaran lewat jalur <b>'{$cekRegisterApprove->via_jalur}'</b> dan dalam status menunggu verifikasi berkas.";
                        $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                        $data['pendaft'] = $cekRegisterApprove;
                        break;
                }
            }

            $x['tujuan_sekolah_id'] = $id;
            $x['tujuan_sekolah_nama'] = $nama;

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = view('peserta/pendaftaran/prestasi/pilihan-jenis-prestasi', $x);
            return json_encode($response);
        }
    }

    public function aksidaftar()
    {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Proses pendaftaran peserta dari web masih dalam proses perbaikan. Silahkan gunakan versi android.";
        // return json_encode($response);
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("PRESTASI");

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'tujuan_sekolah_nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'tujuan_sekolah_id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
            'jenis_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenis prestasi tidak boleh kosong. ',
                ]
            ],
        ];

        if (htmlspecialchars($this->request->getVar('jenis_prestasi'), true) == "AKADEMIK") {
            $jenisVali = [
                'peringkat_prestasi' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Peringkat prestasi tidak boleh kosong. ',
                    ]
                ],
                'akreditasi_prestasi' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Akreditasi sekolah asal prestasi tidak boleh kosong. ',
                    ]
                ],
                'nilai_prestasi' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Nilai rata-rata ijazah/SKL tidak boleh kosong. ',
                    ]
                ],
            ];
            $rules = array_merge($rules, $jenisVali);
        } else {
            $jenisVali = [
                'tingkat_prestasi' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Tingkat prestasi tidak boleh kosong. ',
                    ]
                ],
                'juara_prestasi' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Juara prestasi tidak boleh kosong. ',
                    ]
                ],
            ];
            $rules = array_merge($rules, $jenisVali);
        }

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('tujuan_sekolah_nama')
                . $this->validator->getError('tujuan_sekolah_id')
                . $this->validator->getError('jenis_prestasi')
                . $this->validator->getError('peringkat_prestasi')
                . $this->validator->getError('akreditasi_prestasi')
                . $this->validator->getError('nilai_prestasi')
                . $this->validator->getError('tingkat_prestasi')
                . $this->validator->getError('juara_prestasi');
            return json_encode($response);
        } else {
            $tujuan_sekolah_nama = htmlspecialchars($this->request->getVar('tujuan_sekolah_nama'), true);
            $tujuan_sekolah_id = htmlspecialchars($this->request->getVar('tujuan_sekolah_id'), true);
            $jenis_prestasi = htmlspecialchars($this->request->getVar('jenis_prestasi'), true);
            $peringkat_prestasi = htmlspecialchars($this->request->getVar('peringkat_prestasi'), true);
            $akreditasi_prestasi = htmlspecialchars($this->request->getVar('akreditasi_prestasi'), true);
            $nilai_prestasi = htmlspecialchars($this->request->getVar('nilai_prestasi'), true);
            $tingkat_prestasi = htmlspecialchars($this->request->getVar('tingkat_prestasi'), true);
            $juara_prestasi = htmlspecialchars($this->request->getVar('juara_prestasi'), true);

            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }

            $peserta = $this->_db->table('_users_profil_tb a')
                ->select("a.*, b.lampiran_akta_kelahiran, b.lampiran_kk, b.lampiran_lulus, b.lampiran_afirmasi, b.lampiran_prestasi, b.lampiran_mutasi, b.lampiran_lainnya")
                ->join('_upload_kelengkapan_berkas b', 'a.id = b.user_id', 'LEFT')
                ->where('a.id', $user->data->id)
                ->get()->getRowObject();
            if (!$peserta) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data anda belum lengkap, silahkan lengkapi data terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_akta_kelahiran == null || $peserta->lampiran_kk == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran dokumen Akta dan Kartu Keluarga terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_lulus == null) {
                if (substr($user->data->nisn, 0, 2) == "BS") {
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran surat keterangan lulus (sertifikat kelulusan) terlebih dahulu.";
                    return json_encode($response);
                }
            }

            if ($peserta->lampiran_prestasi == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen prestasi anda belum lengkap, silahkan lengkapi lampiran dokumen prestasi terlebih dahulu.";
                return json_encode($response);
            }


            $dataLib = new Datalib();
            $cekAvailableRegistered = $dataLib->cekAlreadyRegistered($peserta->peserta_didik_id);
            if ($cekAvailableRegistered) {
                if ((int)$cekAvailableRegistered->status_pendaftaran !== 3) {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->url = base_url('peserta/home');
                    switch ((int)$cekAvailableRegistered->status_pendaftaran) {
                        case 1:
                            $response->message = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                            break;
                        case 2:
                            $response->message = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/> Melalui Jalur <b>" . $cekAvailableRegistered->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.";
                            break;

                        default:
                            $response->message = "Anda sudah melakukan pendaftaran. Untuk merubah data silahkan batalkan pendaftaran melalui panitia PPDB Sekolah Tujuan.";
                            break;
                    }
                    return json_encode($response);
                }
            }


            // $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();
            // if ($cekRegisterApprove) {
            //     $response = new \stdClass;
            //     $response->code = 400;
            //     $response->message = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
            //     return json_encode($response);
            // }

            // $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();

            // if ($cekRegisterTemp) {
            //     $response = new \stdClass;
            //     $response->code = 400;
            //     $response->message = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas. Silahkan menggunakan tombol batal pendaftaran pada menu riwayat / aktifitas.";
            //     return json_encode($response);
            // }

            $nilai_akumulative = 0;
            if ($jenis_prestasi == "NON AKADEMIK") {
                if ($tingkat_prestasi == "INTERNASIONAL") {
                    $nilai_akumulative = 400;
                } else if ($tingkat_prestasi == "NASIONAL") {
                    if ($juara_prestasi == "JUARA PERTAMA") {
                        $nilai_akumulative = 375;
                    } else if ($juara_prestasi == "JUARA KEDUA") {
                        $nilai_akumulative = 350;
                    } else if ($juara_prestasi == "JUARA KETIGA") {
                        $nilai_akumulative = 325;
                    } else if ($juara_prestasi == "JAMBORE TK. NASIONAL") {
                        $nilai_akumulative = 350;
                    }
                } else if ($tingkat_prestasi == "PROVINSI") {
                    if ($juara_prestasi == "JUARA PERTAMA") {
                        $nilai_akumulative = 350;
                    } else if ($juara_prestasi == "JUARA KEDUA") {
                        $nilai_akumulative = 325;
                    } else if ($juara_prestasi == "JUARA KETIGA") {
                        $nilai_akumulative = 300;
                    }
                } else if ($tingkat_prestasi == "KABUPATEN/KOTA") {
                    if ($juara_prestasi == "JUARA PERTAMA") {
                        $nilai_akumulative = 325;
                    } else if ($juara_prestasi == "JUARA KEDUA") {
                        $nilai_akumulative = 300;
                    } else if ($juara_prestasi == "JUARA KETIGA") {
                        $nilai_akumulative = 275;
                    }
                } else if ($tingkat_prestasi == "KECAMATAN") {
                    if ($juara_prestasi == "JUARA PERTAMA") {
                        $nilai_akumulative = 275;
                    } else if ($juara_prestasi == "JUARA KEDUA") {
                        $nilai_akumulative = 250;
                    } else if ($juara_prestasi == "JUARA KETIGA") {
                        $nilai_akumulative = 225;
                    }
                }
            } else if ($jenis_prestasi == "AKADEMIK") {
                if ($peringkat_prestasi == "PERINGKAT PERTAMA") {
                    if ($akreditasi_prestasi == "AKREDITASI A") {
                        $nilai_akumulative = 225;
                    } else if ($akreditasi_prestasi == "AKREDITASI B") {
                        $nilai_akumulative = 150;
                    } else if ($akreditasi_prestasi == "AKREDITASI C") {
                        $nilai_akumulative = 125;
                    }
                } else if ($peringkat_prestasi == "PERINGKAT KEDUA") {
                    if ($akreditasi_prestasi == "AKREDITASI A") {
                        $nilai_akumulative = 200;
                    } else if ($akreditasi_prestasi == "AKREDITASI B") {
                        $nilai_akumulative = 125;
                    } else if ($akreditasi_prestasi == "AKREDITASI C") {
                        $nilai_akumulative = 100;
                    }
                } else if ($peringkat_prestasi == "PERINGKAT KETIGA") {
                    if ($akreditasi_prestasi == "AKREDITASI A") {
                        $nilai_akumulative = 175;
                    } else if ($akreditasi_prestasi == "AKREDITASI B") {
                        $nilai_akumulative = 100;
                    } else if ($akreditasi_prestasi == "AKREDITASI C") {
                        $nilai_akumulative = 75;
                    }
                }
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'kode_pendaftaran' => createKodePendaftaran("PRESTASI", $peserta->nisn),
                'peserta_didik_id' => $peserta->peserta_didik_id,
                'user_id' => $user->data->id,
                'from_sekolah_id' => $peserta->sekolah_asal,
                'tujuan_sekolah_id_1' => $tujuan_sekolah_id,
                'via_jalur' => "PRESTASI",
                'status_pendaftaran' => 0,
                'lampiran' => null,
                'keterangan' => null,
                'pendaftar' => 'SISWA',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar_temp')->insert($data);
            if ($this->_db->affectedRows() > 0) {
                $this->_db->table('tb_nilai_prestasi')->insert([
                    'id' => $uuid,
                    'id_pendaftaran' => $uuid,
                    'jenis_prestasi' => $jenis_prestasi,
                    'tingkat_prestasi' => $tingkat_prestasi,
                    'juara_prestasi' => $juara_prestasi,
                    'peringkat_prestasi' => $peringkat_prestasi,
                    'akreditasi_prestasi' => $akreditasi_prestasi,
                    'nilai_prestasi' => $nilai_prestasi,
                    'nilai_akumulative' => $nilai_akumulative,
                    'created_at' => $data['created_at'],
                ]);

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Mendaftar via Jalur Prestasi, untuk diverifikasi berkas oleh sekolah tujuan.", "Daftar Jalur Prestasi");
                    } catch (\Throwable $th) {
                    }
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->data = $data;
                    $response->message = "Pendaftaran via jalur Prestasi berhasil dilakukan.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Pendaftaran via jalur Prestasi gagal dilakukan.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pendaftaran via jalur Prestasi gagal dilakukan.";
                return json_encode($response);
            }
        }
    }
}
