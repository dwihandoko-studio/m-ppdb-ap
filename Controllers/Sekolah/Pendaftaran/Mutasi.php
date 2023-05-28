<?php

namespace App\Controllers\Sekolah\Pendaftaran;

use App\Controllers\BaseController;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Sekolah\Datalib;
use App\Libraries\Sekolah\Riwayatlib;
use App\Libraries\Sekolah\Updatedatalib;
use Firebase\JWT\JWT;
use App\Libraries\Notificationlib;
use App\Libraries\Fcmlib;

class Mutasi extends BaseController
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

                    $where = "a.tujuan_sekolah_id = '$getCurrentUser->sekolah_id' AND a.via_jalur = 'MUTASI' AND (a.status_pendaftaran = 0)";
                    
                    if($keyword !== "") {
                        $where .= " AND (a.kode_pendaftaran LIKE '%$keyword%')";
                    }
                    
                    $data['result'] = $this->_db->table('_tb_pendaftar_temp a')
                        // $data['result'] = $this->_db->table('ref_provinsi a')
                        //         //RUMUS JARAK (111.111 *
                        // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
                        //      * COS(RADIANS(b.Latitude))
                        //      * COS(RADIANS(a.Longitude - b.Longitude))
                        //      + SIN(RADIANS(a.Latitude))
                        //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
                        ->select("b.*, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
                        ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                        ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                        ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                        ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
                        ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
                        ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
                        ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
                        ->join('ref_kecamatan g', 'b.kelurahan = g.id', 'LEFT')
                        ->join('ref_kecamatan h', 'b.dusun = h.id', 'LEFT')
                        ->where($where)
                        ->orderBy('a.created_at', 'asc')
                        ->limit($limit_per_page, $start)
                        ->get()->getResult();
                    $data['countData'] = $this->_db->table('_tb_pendaftar_temp a')->where($where)->countAllResults();
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
                            $response->data = view('sekolah/pendaftaran/mutasi/pilihan-zonasi', $data);
                            $response->pagination = view('sekolah/pendaftaran/mutasi/pilihan-pagination', $data);
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
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah habis.";
                    return json_encode($response);
                }
            } catch (\Exception $e) {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }
        } else {
            $response = new \stdClass;
            $response->code = 401;
            $response->message = "Session telah habis.";
            return json_encode($response);
        }
    }

    public function index()
    {
        $data['title'] = 'PENDAFTAR JALUR MUTASI';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        return view('sekolah/pendaftaran/mutasi/index', $data);
    }

    public function detail()
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

            $oldData = $this->_db->table('_tb_pendaftar_temp a')
                ->select("b.*, k.lampiran_kk, k.lampiran_lulus, k.lampiran_pernyataan, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
                ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
                ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
                ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
                ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
                ->join('ref_dusun h', 'b.dusun = h.id', 'LEFT')
                ->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT')
                ->where('a.id', $id)
                ->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $data['data'] = $oldData;

            $response = new \stdClass;
            $response->code = 200;
            $response->result = $oldData;
            $response->data = view('sekolah/pendaftaran/mutasi/detail', $data);
            $response->message = "Data ditemukan.";
            return json_encode($response);
        }
    }

    public function aksiverifikasi()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("MUTASI");

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'name' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Name tidak boleh kosong. ',
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
            $response->message = $this->validator->getError('name') . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $name = htmlspecialchars($this->request->getVar('name'), true);
            $id = htmlspecialchars($this->request->getVar('id'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('id', $id)->get()->getRowArray();

                        if (!$cekRegisterTemp) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan.";
                            return json_encode($response);
                        }

                        $cekRegisterTemp['updated_at'] = date('Y-m-d H:i:s');
                        $cekRegisterTemp['updated_aproval'] = date('Y-m-d H:i:s');
                        $cekRegisterTemp['admin_approval'] = $userId;
                        $cekRegisterTemp['status_pendaftaran'] = 1;

                        $this->_db->transBegin();
                        $this->_db->table('_tb_pendaftar')->insert($cekRegisterTemp);
                        if ($this->_db->affectedRows() > 0) {
                            $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();
                            if ($this->_db->affectedRows() > 0) {
                                
                                // try {
                                    
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Memverifikasi Pendaftaran $name via Jalur Mutasi dengan No Pendaftaran : " . $cekRegisterTemp['kode_pendaftaran'], "Memverifikasi Pendaftaran Jalur Mutasi", "submit");
                                    
                                    $saveNotifSystem = new Notificationlib();
                                    $saveNotifSystem->send([
                                        'judul' => "Pendaftaran Jalur Mutasi Telah Diverifikasi.",
                                        'isi' => "Pendaftaran anda melalui jalur mutasi telah diverifikasi oleh sekolah tujuan, selanjutnya silahkan menunggu pengumuman sesuai jadwal yang telah ditentukan.",
                                        'action_web' => 'peserta/riwayat/pendaftaran',
                                        'action_app' => 'riwayat_pendaftaran_page',
                                        'token' => $cekRegisterTemp['kode_pendaftaran'],
                                        'send_from' => $userId,
                                        'send_to' => $cekRegisterTemp['user_id'],
                                    ]);
                    
                                    $onesignal = new Fcmlib();
                                    $send = $onesignal->pushNotifToUser([
                                        'title' => "Pendaftaran Jalur Mutasi Telah Diverifikasi.",
                                        'content' => "Pendaftaran anda melalui jalur mutasi telah diverifikasi oleh sekolah tujuan, selanjutnya silahkan menunggu pengumuman sesuai jadwal yang telah ditentukan.",
                                        'send_to' => $cekRegisterTemp['user_id'],
                                        'app_url' => 'riwayat_pendaftaran_page',
                                    ]);
                                // } catch (\Throwable $th) {
                                // }
                                $this->_db->transCommit();
                                
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Verifikasi pendaftaran $name berhasil dilakukan.";
                                return json_encode($response);
                            } else {
                                $this->_db->transRollback();
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Gagal memverifikasi status pendaftaran peserta. $name";
                                return json_encode($response);
                            }
                        } else {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal memverifikasi pendaftaran peserta. $name";
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
    }

    public function aksitolakverifikasi()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("MUTASI");

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'name' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Name tidak boleh kosong. ',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Keterangan tidak boleh kosong. ',
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
            $response->message = $this->validator->getError('keterangan') . $this->validator->getError('name') . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $name = htmlspecialchars($this->request->getVar('name'), true);
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $keterangan = htmlspecialchars($this->request->getVar('keterangan'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('id', $id)->get()->getRowArray();

                        if (!$cekRegisterTemp) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan.";
                            return json_encode($response);
                        }

                        $cekRegisterTemp['updated_at'] = date('Y-m-d H:i:s');
                        $cekRegisterTemp['update_reject'] = date('Y-m-d H:i:s');
                        $cekRegisterTemp['admin_approval'] = $userId;
                        $cekRegisterTemp['keterangan_penolakan'] = $keterangan;
                        $cekRegisterTemp['status_pendaftaran'] = 3;

                        $this->_db->transBegin();
                        $this->_db->table('_tb_pendaftar_tolak')->insert($cekRegisterTemp);
                        if ($this->_db->affectedRows() > 0) {
                            $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();
                            if ($this->_db->affectedRows() > 0) {
                                $updatelockLib = new Updatedatalib();
                                $berhasil = $updatelockLib->unlockUpdate($cekRegisterTemp['user_id']);
                                
                                // try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menolak Pendaftaran $name via Jalur Mutasi dengan No Pendaftaran : " . $cekRegisterTemp['kode_pendaftaran'], "Tolak Pendaftaran Jalur Mutasi", "tolak");
                                    
                                    $saveNotifSystem = new Notificationlib();
                                    $saveNotifSystem->send([
                                        'judul' => "Pendaftaran Jalur Mutasi Ditolak.",
                                        'isi' => "Pendaftaran anda melalui jalur mutasi ditolak dengan keterangan: $keterangan.",
                                        'action_web' => 'peserta/riwayat/pendaftaran',
                                        'action_app' => 'riwayat_pendaftaran_page',
                                        'token' => $cekRegisterTemp['kode_pendaftaran'],
                                        'send_from' => $userId,
                                        'send_to' => $cekRegisterTemp['user_id'],
                                    ]);
                    
                                    $onesignal = new Fcmlib();
                                    $send = $onesignal->pushNotifToUser([
                                        'title' => "Pendaftaran Jalur Mutasi Ditolak.",
                                        'content' => "Pendaftaran anda melalui jalur mutasi ditolak dengan keterangan: $keterangan.",
                                        'send_to' => $cekRegisterTemp['user_id'],
                                        'app_url' => 'riwayat_pendaftaran_page',
                                    ]);
                                // } catch (\Throwable $th) {
                                // }
                                $this->_db->transCommit();
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Tolak Verifikasi pendaftaran $name berhasil dilakukan.";
                                return json_encode($response);
                            } else {
                                $this->_db->transRollback();
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Gagal menolak verifikasi status pendaftaran peserta. $name";
                                return json_encode($response);
                            }
                        } else {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal menolak verifikasi pendaftaran peserta. $name";
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
    }
}
