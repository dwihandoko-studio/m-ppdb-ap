<?php

namespace App\Controllers\Peserta\Pendaftaran;

use App\Controllers\BaseController;
use App\Libraries\Peserta\Datalib;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Peserta\Riwayatlib;
use Firebase\JWT\JWT;

class Zonasi extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function getAllSekolahZonasi()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

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
                    if ((int)$dataCurrentUser->tingkat_pendidikan == 6) {
                        $andWhere = "a.bentuk_pendidikan_id IN (6,10,31,32,33,35,36)";
                    } else {
                        $andWhere = "a.bentuk_pendidikan_id IN (5,9,30,31,32,33,38)";
                    }

                    // $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND a.kelurahan_id = '{$getCurrentUser->kelurahan}' AND a.dusun_id = '{$getCurrentUser->dusun}' AND ($andWhere)";
                    $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND ($andWhere)";

                    if ($keyword !== "") {
                        $where .= " AND (a.npsn = '$keyword' OR a.nama LIKE '%$keyword%')";
                    }

                    $data['result'] = $this->_db->table('v_tb_sekolah_zonasi a')
                        // $data['result'] = $this->_db->table('ref_provinsi a')
                        //         //RUMUS JARAK (111.111 *
                        // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
                        //      * COS(RADIANS(b.Latitude))
                        //      * COS(RADIANS(a.Longitude - b.Longitude))
                        //      + SIN(RADIANS(a.Latitude))
                        //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
                        // ->select("b.*, a.dusun as dusun_id, c.nama as nama_jenjang_pendidikan, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, ")
                        // ->join('ref_sekolah b', 'a.sekolah_id = b.id')
                        // ->join('ref_bentuk_pendidikan c', 'a.bentuk_pendidikan_id = c.id')
                        // ->join('ref_kecamatan f', 'b.kode_wilayah = f.id')
                        // ->join('ref_kabupaten e', 'f.id_kabupaten = e.id')
                        // ->join('ref_provinsi d', 'e.id_provinsi = d.id')
                        ->where($where)
                        ->orderBy('a.created_at', 'asc')
                        // ->limit($limit_per_page, $start)
                        ->get()->getResult();
                    $data['countData'] = $this->_db->table('v_tb_sekolah_zonasi a')->where($where)->countAllResults();
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
                            $response->data = view('peserta/pendaftaran/zonasi/pilihan', $data);
                            // $response->pagination = view('peserta/pendaftaran/zonasi/pilihan-pagination', $data);
                            return json_encode($response);
                        } else {
                            $response = new \stdClass;
                            $response->code = 204;
                            $response->message = "Tidak ada data.";
                            $response->data = view('peserta/pendaftaran/zonasi/pilihan', $data);
                            return json_encode($response);
                        }
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Tidak ada data.";
                        $response->data = view('peserta/pendaftaran/zonasi/pilihan', $data);
                        return json_encode($response);
                    }
                } else {
                    delete_cookie('jwt');
                    session()->destroy();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah habis.";
                    return json_encode($response);
                }
            } catch (\Exception $e) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->error = $e;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }
        } else {
            delete_cookie('jwt');
            session()->destroy();
            $response = new \stdClass;
            $response->code = 401;
            $response->message = "Session telah habis.";
            return json_encode($response);
        }
    }

    public function getAll()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

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
                    if ((int)$dataCurrentUser->tingkat_pendidikan == 6) {
                        $andWhere = "a.bentuk_pendidikan_id IN (6,10,31,32,33,35,36)";
                    } else {
                        $andWhere = "a.bentuk_pendidikan_id IN (5,9,30,31,32,33,38)";
                    }

                    // $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND a.kelurahan_id = '{$getCurrentUser->kelurahan}' AND a.dusun_id = '{$getCurrentUser->dusun}' AND ($andWhere)";
                    $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND a.kelurahan_id = '{$getCurrentUser->kelurahan}' AND ($andWhere)";

                    if ($keyword !== "") {
                        $where .= " AND (a.npsn = '$keyword' OR a.nama LIKE '%$keyword%')";
                    }

                    $data['result'] = $this->_db->table('v_tb_sekolah_zonasi a')
                        // $data['result'] = $this->_db->table('ref_provinsi a')
                        //         //RUMUS JARAK (111.111 *
                        // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
                        //      * COS(RADIANS(b.Latitude))
                        //      * COS(RADIANS(a.Longitude - b.Longitude))
                        //      + SIN(RADIANS(a.Latitude))
                        //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
                        // ->select("b.*, a.dusun as dusun_id, c.nama as nama_jenjang_pendidikan, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, ")
                        // ->join('ref_sekolah b', 'a.sekolah_id = b.id')
                        // ->join('ref_bentuk_pendidikan c', 'a.bentuk_pendidikan_id = c.id')
                        // ->join('ref_kecamatan f', 'b.kode_wilayah = f.id')
                        // ->join('ref_kabupaten e', 'f.id_kabupaten = e.id')
                        // ->join('ref_provinsi d', 'e.id_provinsi = d.id')
                        ->where($where)
                        ->orderBy('a.created_at', 'asc')
                        ->limit($limit_per_page, $start)
                        ->get()->getResult();
                    $data['countData'] = $this->_db->table('v_tb_sekolah_zonasi a')->where($where)->countAllResults();
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
                            $response->data = view('peserta/pendaftaran/zonasi/pilihan-zonasi', $data);
                            $response->pagination = view('peserta/pendaftaran/zonasi/pilihan-pagination', $data);
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
                } else {
                    delete_cookie('jwt');
                    session()->destroy();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah habis.";
                    return json_encode($response);
                }
            } catch (\Exception $e) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->error = $e;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }
        } else {
            delete_cookie('jwt');
            session()->destroy();
            $response = new \stdClass;
            $response->code = 401;
            $response->message = "Session telah habis.";
            return json_encode($response);
        }
    }

    public function index()
    {
        $data['title'] = 'DAFTAR JALUR ZONASI';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;

        $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();

        $dataCurrentUser = json_decode($getCurrentUser->details);
        if ((int)$dataCurrentUser->tingkat_pendidikan == 6) {
            $andWhere = "a.bentuk_pendidikan_id IN (6,10,31,32,33,35,36)";
        } else {
            $andWhere = "a.bentuk_pendidikan_id IN (5,9,30,31,32,33,38)";
        }

        // $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND a.kelurahan_id = '{$getCurrentUser->kelurahan}' AND a.dusun_id = '{$getCurrentUser->dusun}' AND ($andWhere)";
        $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND ($andWhere)";

        $data['result'] = $this->_db->table('v_tb_sekolah_zonasi a')
            // $data['result'] = $this->_db->table('ref_provinsi a')
            //         //RUMUS JARAK (111.111 *
            // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
            //      * COS(RADIANS(b.Latitude))
            //      * COS(RADIANS(a.Longitude - b.Longitude))
            //      + SIN(RADIANS(a.Latitude))
            //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
            // ->select("b.*, a.dusun as dusun_id, c.nama as nama_jenjang_pendidikan, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, ")
            // ->join('ref_sekolah b', 'a.sekolah_id = b.id')
            // ->join('ref_bentuk_pendidikan c', 'a.bentuk_pendidikan_id = c.id')
            // ->join('ref_kecamatan f', 'b.kode_wilayah = f.id')
            // ->join('ref_kabupaten e', 'f.id_kabupaten = e.id')
            // ->join('ref_provinsi d', 'e.id_provinsi = d.id')
            ->where($where)
            ->orderBy('a.created_at', 'asc')
            // ->limit($limit_per_page, $start)
            ->get()->getResult();
        $data['countData'] = $this->_db->table('v_tb_sekolah_zonasi a')->where($where)->countAllResults();
        // $data['countData'] = $this->_db->table('ref_provinsi a')->where($where)->countAllResults();
        $data['usernya'] = $getCurrentUser;

        return view('peserta/pendaftaran/zonasi/index-new', $data);
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
        $canDaftar = $dataLib->canRegister();

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'sekolah1' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Sekolah pilihan pertama tidak boleh kosong. ',
                ]
            ],
            'sekolah2' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Sekolah pilihan kedua tidak boleh kosong. ',
                ]
            ],
            'sekolah3' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Sekolah pilihan ketiga tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('sekolah1')
                . $this->validator->getError('sekolah2')
                . $this->validator->getError('sekolah3');
            return json_encode($response);
        } else {
            $sekolah1 = htmlspecialchars($this->request->getVar('sekolah1'), true);
            $sekolah2 = htmlspecialchars($this->request->getVar('sekolah2'), true);
            $sekolah3 = htmlspecialchars($this->request->getVar('sekolah3'), true);

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
                ->select("a.*, b.lampiran_kk, b.lampiran_lulus, b.lampiran_afirmasi, b.lampiran_prestasi, b.lampiran_mutasi, b.lampiran_lainnya")
                ->join('_upload_kelengkapan_berkas b', 'a.id = b.user_id', 'LEFT')
                ->where('a.id', $user->data->id)
                ->get()->getRowObject();
            if (!$peserta) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data anda belum lengkap, silahkan lengkapi data terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_akta == null || $peserta->lampiran_kk == null) {
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
                    $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran surat keterangan lulu (sertifikat kelulusan) terlebih dahulu.";
                    return json_encode($response);
                }
            }

            $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();
            if ($cekRegisterApprove) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                return json_encode($response);
            }

            $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();

            if ($cekRegisterTemp) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas. Silahkan menggunakan tombol batal pendaftaran pada menu riwayat / aktifitas.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'kode_pendaftaran' => createKodePendaftaran("ZONAZI", $peserta->nisn),
                'user_id' => $user->data->id,
                'peserta_didik_id' => $peserta->peserta_didik_id,
                'from_sekolah_id' => $peserta->sekolah_asal,
                'tujuan_sekolah_id_1' => $sekolah1,
                'tujuan_sekolah_id_2' => $sekolah2,
                'tujuan_sekolah_id_3' => $sekolah3,
                'via_jalur' => "ZONASI",
                'status_pendaftaran' => 0,
                'lampiran' => null,
                'keterangan' => null,
                'pendaftar' => 'SISWA',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar_temp')->insert($data);
            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                try {
                    $riwayatLib = new Riwayatlib();
                    $riwayatLib->insert("Mendaftar via Jalur Zonasi, dengan No Pendaftaran : " . $data['kode_pendaftaran'], "Daftar Jalur Zonasi");
                } catch (\Throwable $th) {
                }
                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->message = "Pendaftaran via jalur Zonasi berhasil dilakukan. Kode pendaftaran anda : " . $data['kode_pendaftaran'] . ". Selanjutnya Silahkan cetak bukti pendaftaran anda.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pendaftaran via jalur Zonasi gagal dilakukan.";
                return json_encode($response);
            }




            // $dir = "";
            // $namaFile = "";

            // if ($id === "_file_kk") {
            //     $lampiran = $this->request->getFile('file');
            //     $newNamelampiran = _create_name_foto($filename);

            //     if ($lampiran->isValid() && !$lampiran->hasMoved()) {
            //         $dir = FCPATH . "uploads/peserta/kk";

            //         $lampiran->move($dir, $newNamelampiran);
            //         $data['lampiran_kk'] = $newNamelampiran;
            //         $namaFile = $newNamelampiran;
            //     } else {
            //         $response = new \stdClass;
            //         $response->code = 400;
            //         $response->message = "Upload file gagal.";
            //         return json_encode($response);
            //     }
            // } else if ($id === "_file_lulus") {
            //     $lampiran = $this->request->getFile('file');
            //     $newNamelampiran = _create_name_foto($filename);

            //     if ($lampiran->isValid() && !$lampiran->hasMoved()) {
            //         $dir = FCPATH . "uploads/peserta/lulus";

            //         $lampiran->move($dir, $newNamelampiran);
            //         $data['lampiran_lulus'] = $newNamelampiran;
            //         $namaFile = $newNamelampiran;
            //     } else {
            //         $response = new \stdClass;
            //         $response->code = 400;
            //         $response->message = "Upload file gagal.";
            //         return json_encode($response);
            //     }
            // } else if ($id === "_file_prestasi") {
            //     $lampiran = $this->request->getFile('file');
            //     $filesNamelampiran = $lampiran->getName();
            //     $newNamelampiran = _create_name_foto($filename);

            //     if ($lampiran->isValid() && !$lampiran->hasMoved()) {
            //         $dir = FCPATH . "uploads/peserta/prestasi";

            //         $lampiran->move($dir, $newNamelampiran);
            //         $data['lampiran_prestasi'] = $newNamelampiran;
            //         $namaFile = $newNamelampiran;
            //     } else {
            //         $response = new \stdClass;
            //         $response->code = 400;
            //         $response->message = "Upload file gagal.";
            //         return json_encode($response);
            //     }
            // } else {
            //     $response = new \stdClass;
            //     $response->code = 400;
            //     $response->message = "Id tidak diketahui.";
            //     return json_encode($response);
            // }

        }
    }

    // public function hapusLampiran()
    // {
    //     if ($this->request->getMethod() != 'post') {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Permintaan tidak diizinkan";
    //         return json_encode($response);
    //     }

    //     $rules = [
    //         'id' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Token tidak boleh kosong.',
    //             ]
    //         ],
    //         'nama' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Nama tidak boleh kosong.',
    //             ]
    //         ],
    //         'jenis' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Jenis upload tidak boleh kosong.',
    //             ]
    //         ],
    //     ];

    //     if (!$this->validate($rules)) {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama') . " " . $this->validator->getError('jenis');
    //         return json_encode($response);
    //     } else {
    //         $id = htmlspecialchars($this->request->getVar('id'), true);
    //         $nama = htmlspecialchars($this->request->getVar('nama'), true);
    //         $jenis = htmlspecialchars($this->request->getVar('jenis'), true);

    //         $oldData = $this->_db->table('_upload_kelengkapan_berkas')->where('id', $id)->get()->getRowObject();
    //         $data = [];

    //         $dir = "";
    //         $namaFile = "";

    //         if ($oldData) {
    //             if ($jenis === "_file_kk") {
    //                 $dir = FCPATH . "uploads/peserta/kk";
    //                 $namaFile = $oldData->lampiran_kk;
    //                 $data['lampiran_kk'] = null;
    //             } else if ($jenis === "_file_lulus") {
    //                 $dir = FCPATH . "uploads/peserta/lulus";
    //                 $namaFile = $oldData->lampiran_lulus;
    //                 $data['lampiran_lulus'] = null;
    //             } else if ($jenis === "_file_prestasi") {
    //                 $dir = FCPATH . "uploads/peserta/prestasi";
    //                 $namaFile = $oldData->lampiran_prestasi;
    //                 $data['lampiran_prestasi'] = null;
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Jenis hapus file tidak dikenali";
    //                 return json_encode($response);
    //             }

    //             $data['updated_at'] = date('Y-m-d H:i:s');
    //             $this->_db->table('_upload_kelengkapan_berkas')->where('id', $oldData->id)->update($data);
    //             if ($this->_db->affectedRows() > 0) {
    //                 if ($jenis === "_file_kk") {
    //                     try {
    //                         if ($oldData->lampiran_kk !== null) {
    //                             unlink($dir . '/' . $namaFile);
    //                         }
    //                     } catch (\Exception $e) {
    //                     }
    //                 } else if ($jenis === "_file_lulus") {
    //                     try {
    //                         if ($oldData->lampiran_lulus !== null) {
    //                             unlink($dir . '/' . $namaFile);
    //                         }
    //                     } catch (\Exception $e) {
    //                     }
    //                 } else if ($jenis === "_file_prestasi") {
    //                     try {
    //                         if ($oldData->lampiran_prestasi !== null) {
    //                             unlink($dir . '/' . $namaFile);
    //                         }
    //                     } catch (\Exception $e) {
    //                     }
    //                 } else {
    //                 }

    //                 $response = new \stdClass;
    //                 $response->code = 200;
    //                 $response->message = "Dokumen " . $nama . " berhasil dihapus.";
    //                 return json_encode($response);
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Dokumen " . $nama . " gagal dihapus.";
    //                 return json_encode($response);
    //             }
    //         } else {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Dokumen " . $nama . " tidak ditemukan.";
    //             return json_encode($response);
    //         }
    //     }
    // }
}
