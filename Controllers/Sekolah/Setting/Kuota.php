<?php

namespace App\Controllers\Sekolah\Setting;

use App\Controllers\BaseController;
// use App\Models\Sekolah\ZonasiModel;
// use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Sekolah\Datalib;
use App\Libraries\Sekolah\Riwayatlib;
use Firebase\JWT\JWT;

class Kuota extends BaseController
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
        $data['title'] = 'Setting Kuota';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $sekolahId = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

                    if (!$sekolahId) {
                        return view('404');
                    }

                    $kuota = $this->_db->table('_setting_kuota_tb')->where('sekolah_id', $sekolahId->sekolah_id)->get()->getRowObject();
                    if ($kuota) {
                        $data['kuota'] = $kuota;
                    }
                    return view('sekolah/setting/kuota/index', $data);
                } else {
                    return redirect()->to(base_url('dashboard'));
                }
            } catch (\Exception $e) {
                return redirect()->to(base_url('dashboard'));
            }
        } else {
            return redirect()->to(base_url('dashboard'));
        }
    }

    public function add()
    {
        if ($this->request->getMethod() != 'get') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canSetting();

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('sekolah/setting/kuota/add');
        return json_encode($response);
    }

    public function edit()
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

            $dataLib = new Datalib();
            $canDaftar = $dataLib->canSetting();

            if ($canDaftar->code !== 200) {
                return json_encode($canDaftar);
            }

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {
                try {
                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $sekolahId = $this->_db->table('_users_profil_tb a')
                            ->select("a.*, b.bentuk_pendidikan_id")
                            ->join('ref_sekolah b', 'a.sekolah_id = b.id', 'left')
                            ->where('a.id', $userId)->get()->getRowObject();

                        if (!$sekolahId) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                            return json_encode($response);
                        }
                        if ($sekolahId->sekolah_id === null) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                            return json_encode($response);
                        }

                        $dataLib = new Datalib();
                        $canDaftar = $dataLib->canSetting();

                        if ($canDaftar->code !== 200) {
                            return json_encode($canDaftar);
                        }

                        $cekData = $this->_db->table('_setting_kuota_tb')->where(['sekolah_id' => $sekolahId->sekolah_id, 'is_locked' => 1])->countAllResults();

                        if ($cekData > 0) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Pengajuan Untuk Kuota Kesiapan Telah Diverifikasi Dan Dikunci. Silahkan Hubungi Admin PPDB Dinas, Apabila Data Kuota Kesiapan Sekolah Anda Masih Belum Sesuai Dengan Ketentuan Yang Telah Ditetapkan.";
                            return json_encode($response);
                        }

                        $id = htmlspecialchars($this->request->getVar('id'), true);

                        $oldData = $this->_db->table('_setting_kuota_tb')->where('id', $id)->get()->getRowObject();

                        if (!$oldData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan";
                            return json_encode($response);
                        }

                        $data['data'] = $oldData;
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Permintaan diizinkan";
                        $response->data = view('sekolah/setting/kuota/edit', $data);
                        return json_encode($response);
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

    public function addSave()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'jumlahKelas' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jumlah kelas tidak boleh kosong. ',
                ]
            ],
            'jumlahRombelCurrent' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jumlah rombel akhir saat ini tidak boleh kosong. ',
                ]
            ],
            'jumlahRombelKebutuhan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jumlah kebutuhan rombel tidak boleh kosong. ',
                ]
            ],
            'radius' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Radius zonasi tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('radius') . $this->validator->getError('jumlahKelas') . $this->validator->getError('jumlahRombelCurrent') . $this->validator->getError('jumlahRombelKebutuhan');
            return json_encode($response);
        } else {
            $jumlahKelas = htmlspecialchars($this->request->getVar('jumlahKelas'), true);
            $jumlahRombelCurrent = htmlspecialchars($this->request->getVar('jumlahRombelCurrent'), true);
            $jumlahRombelKebutuhan = htmlspecialchars($this->request->getVar('jumlahRombelKebutuhan'), true);
            $radius = htmlspecialchars($this->request->getVar('radius'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $sekolahId = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

                        if (!$sekolahId) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                            return json_encode($response);
                        }
                        if ($sekolahId->sekolah_id === null) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                            return json_encode($response);
                        }

                        $cekData = $this->_db->table('_setting_kuota_tb')->where('sekolah_id', $sekolahId->sekolah_id)->get()->getRowObject();

                        if ($cekData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Kuota untuk sekolah anda sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                            return json_encode($response);
                        }

                        $refSekolah = $this->_db->table('ref_sekolah')->where('id', $sekolahId->sekolah_id)->get()->getRowObject();
                        if (!$refSekolah) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah tidak ditemukan.";
                            return json_encode($response);
                        }

                        $prosentaseJalur = getProsentaseJalur($refSekolah->bentuk_pendidikan_id);

                        if (!$prosentaseJalur) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Referensi prosentase tidak ditemukan.";
                            return json_encode($response);
                        }

                        if ($refSekolah->bentuk_pendidikan_id == "6" || $refSekolah->bentuk_pendidikan_id == "10" || $refSekolah->bentuk_pendidikan_id == "31" || $refSekolah->bentuk_pendidikan_id == "32" || $refSekolah->bentuk_pendidikan_id == "33" || $refSekolah->bentuk_pendidikan_id == "35" || $refSekolah->bentuk_pendidikan_id == "36") {
                            $jumlahSiswa = 32 * (int)$jumlahRombelKebutuhan;
                            $kZonasi = ceil(($prosentaseJalur->zonasi / 100) * $jumlahSiswa);
                            $kAfirmasi = ceil(($prosentaseJalur->afirmasi / 100) * $jumlahSiswa);
                            $kMutasi = ceil(($prosentaseJalur->mutasi / 100) * $jumlahSiswa);
                            $kPrestasi = $jumlahSiswa - ($kZonasi + $kAfirmasi + $kMutasi);
                        } else {
                            $jumlahSiswa = 28 * (int)$jumlahRombelKebutuhan;
                            $kZonasi = ceil(($prosentaseJalur->zonasi / 100) * $jumlahSiswa);
                            $kAfirmasi = ceil(($prosentaseJalur->afirmasi / 100) * $jumlahSiswa);
                            $kMutasi = ceil(($prosentaseJalur->mutasi / 100) * $jumlahSiswa);
                            $kPrestasi = $jumlahSiswa - ($kZonasi + $kAfirmasi + $kMutasi);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        $data = [
                            'id' => $uuid,
                            'sekolah_id' => $sekolahId->sekolah_id,
                            'bentuk_pendidikan_id' => $refSekolah->bentuk_pendidikan_id,
                            'npsn' => $sekolahId->npsn,
                            'jumlah_kelas' => $jumlahKelas,
                            'jumlah_rombel_current' => $jumlahRombelCurrent,
                            'jumlah_rombel_kebutuhan' => $jumlahRombelKebutuhan,
                            'zonasi' => $kZonasi,
                            'afirmasi' => $kAfirmasi,
                            'mutasi' => $kMutasi,
                            'prestasi' => $kPrestasi,
                            'radius_zonasi' => $radius,
                            'is_locked' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_setting_kuota_tb')->insert($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menambahkan setting kuota sekolah", "Menambahkan Kuota Sekolah", "submit");
                                } catch (\Throwable $th) {
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data berhasil disimpan.";
                                $response->data = $data;
                                return json_encode($response);
                            } else {
                                $this->_db->transRollback();
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Gagal menyimpan kuota.";
                                return json_encode($response);
                            }
                        } catch (\Throwable $th) {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal menyimpan kuota. terjadi kesalahan.";
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

    public function editSave()
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
            'jumlahKelas' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jumlah kelas tidak boleh kosong. ',
                ]
            ],
            'jumlahRombelCurrent' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jumlah rombel akhir saat ini tidak boleh kosong. ',
                ]
            ],
            'jumlahRombelKebutuhan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jumlah kebutuhan rombel tidak boleh kosong. ',
                ]
            ],
            'radius' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Radius zonasi tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . $this->validator->getError('radius') . $this->validator->getError('jumlahKelas') . $this->validator->getError('jumlahRombelCurrent') . $this->validator->getError('jumlahRombelKebutuhan');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $jumlahKelas = htmlspecialchars($this->request->getVar('jumlahKelas'), true);
            $jumlahRombelCurrent = htmlspecialchars($this->request->getVar('jumlahRombelCurrent'), true);
            $jumlahRombelKebutuhan = htmlspecialchars($this->request->getVar('jumlahRombelKebutuhan'), true);
            $radius = htmlspecialchars($this->request->getVar('radius'), true);

            $oldData = $this->_db->table('_setting_kuota_tb')->where('id', $id)->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            if (((int)$oldData->jumlah_kelas == (int)$jumlahKelas) && ((int)$oldData->jumlah_rombel_current == (int)$jumlahRombelCurrent) && ((int)$oldData->jumlah_rombel_kebutuhan == (int)$jumlahRombelKebutuhan) && ((int)$oldData->radius_zonasi == (int)$radius)) {
                $response = new \stdClass;
                $response->code = 201;
                $response->message = "Tidak ada perubahan data perlu yang disimpan.";
                return json_encode($response);
            }

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $sekolahId = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

                        if (!$sekolahId) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                            return json_encode($response);
                        }
                        if ($sekolahId->sekolah_id === null) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                            return json_encode($response);
                        }

                        if ((int)$oldData->is_locked == 1) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Setingan kuota sudah terkunci. Silahkan hubungi admin panitia PPDB dinas untuk merubah data.";
                            return json_encode($response);
                        }

                        $refSekolah = $this->_db->table('ref_sekolah')->where('id', $sekolahId->sekolah_id)->get()->getRowObject();
                        if (!$refSekolah) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah tidak ditemukan.";
                            return json_encode($response);
                        }

                        $prosentaseJalur = getProsentaseJalur($refSekolah->bentuk_pendidikan_id);

                        if (!$prosentaseJalur) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Referensi prosentase tidak ditemukan.";
                            return json_encode($response);
                        }

                        if ($refSekolah->bentuk_pendidikan_id == "6" || $refSekolah->bentuk_pendidikan_id == "10" || $refSekolah->bentuk_pendidikan_id == "31" || $refSekolah->bentuk_pendidikan_id == "32" || $refSekolah->bentuk_pendidikan_id == "33" || $refSekolah->bentuk_pendidikan_id == "35" || $refSekolah->bentuk_pendidikan_id == "36") {
                            $jumlahSiswa = 32 * (int)$jumlahRombelKebutuhan;
                            $kZonasi = ceil(($prosentaseJalur->zonasi / 100) * $jumlahSiswa);
                            $kAfirmasi = ceil(($prosentaseJalur->afirmasi / 100) * $jumlahSiswa);
                            $kMutasi = ceil(($prosentaseJalur->mutasi / 100) * $jumlahSiswa);
                            $kPrestasi = $jumlahSiswa - ($kZonasi + $kAfirmasi + $kMutasi);
                        } else {
                            $jumlahSiswa = 28 * (int)$jumlahRombelKebutuhan;
                            $kZonasi = ceil(($prosentaseJalur->zonasi / 100) * $jumlahSiswa);
                            $kAfirmasi = ceil(($prosentaseJalur->afirmasi / 100) * $jumlahSiswa);
                            $kMutasi = ceil(($prosentaseJalur->mutasi / 100) * $jumlahSiswa);
                            $kPrestasi = $jumlahSiswa - ($kZonasi + $kAfirmasi + $kMutasi);
                        }

                        $this->_db->transBegin();

                        $data = [
                            'jumlah_kelas' => $jumlahKelas,
                            'jumlah_rombel_current' => $jumlahRombelCurrent,
                            'jumlah_rombel_kebutuhan' => $jumlahRombelKebutuhan,
                            'zonasi' => $kZonasi,
                            'afirmasi' => $kAfirmasi,
                            'mutasi' => $kMutasi,
                            'prestasi' => $kPrestasi,
                            'radius_zonasi' => $radius,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_setting_kuota_tb')->where('id', $id)->update($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Mengupdate setting kuota sekolah", "Mengupdate Kuota Sekolah", "update");
                                } catch (\Throwable $th) {
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data berhasil diupdate.";
                                $response->data = $data;
                                return json_encode($response);
                            } else {
                                $this->_db->transRollback();
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Gagal mengupdate kuota.";
                                return json_encode($response);
                            }
                        } catch (\Throwable $th) {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal mengupdate kuota. terjadi kesalahan.";
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
