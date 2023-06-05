<?php

namespace App\Controllers\Sekolah\Setting;

use App\Controllers\BaseController;
use App\Models\Sekolah\PanitiaModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Sekolah\Datalib;
use App\Libraries\Sekolah\Riwayatlib;
use Firebase\JWT\JWT;

class Panitia extends BaseController
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
                    $request = Services::request();
                    $datamodel = new PanitiaModel($request);

                    if ($request->getMethod(true) == 'POST') {
                        // $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
                        // $filterKelurahan = htmlspecialchars($request->getVar('filter_kelurahan'), true) ?? "";

                        $lists = $datamodel->get_datatables($userId);
                        // $lists = [];
                        $data = [];
                        $no = $request->getPost("start");
                        foreach ($lists as $list) {
                            $no++;
                            $row = [];

                            $row[] = $no;
                            // if($hakAksesMenu) {
                            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
                            $action = '<div class="dropup">
                        <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                        </div>
                        <div class="dropdown-menu">
                            <button onclick="actionDetail(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>
                            <button onclick="actionEdit(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                <i class="ni ni-ruler-pencil"></i>
                                <span>Edit</span>
                            </button>
                            <button onclick="actionHapus(\'' . $list->id . '\', \' ' . $list->nama . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </div>';
                            $row[] = $action;
                            // $row[] = '<a href="javascript:;" class="btn btn-primary btn-sm action-detail" data-id="' . $list->id . '"><i class="fa fa-eye"></i><span>Detail</span></a>';
                            //     } else {
                            //         $row[] = '-';
                            //     }
                            // } else {
                            //     $row[] = '-';
                            // }


                            // $row[] = $no;

                            $row[] = $list->nama;
                            $row[] = $list->no_hp;

                            $data[] = $row;
                        }
                        $output = [
                            "draw" => $request->getPost('draw'),
                            // "recordsTotal" => 0,
                            // "recordsFiltered" => 0,
                            "recordsTotal" => $datamodel->count_all($userId),
                            "recordsFiltered" => $datamodel->count_filtered($userId),
                            "data" => $data,
                            // "er" => $userId
                        ];
                        echo json_encode($output);
                    }
                } else {
                    $output = [
                        "draw" => "1",
                        // "recordsTotal" => 0,
                        // "recordsFiltered" => 0,
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => []
                    ];
                    echo json_encode($output);
                }
            } catch (\Exception $e) {
                $output = [
                    "draw" => "1",
                    // "recordsTotal" => 0,
                    // "recordsFiltered" => 0,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => []
                ];
                echo json_encode($output);
            }
        } else {
            $output = [
                "draw" => "1",
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Setting Panitia';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->where("id != '350000'")->orderBy('nama', 'asc')->get()->getResult();

        return view('sekolah/setting/panitia/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() != 'get') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
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

                    // $dataLib = new Datalib();
                    // $canDaftar = $dataLib->canSetting();

                    // if ($canDaftar->code !== 200) {
                    //     return json_encode($canDaftar);
                    // }

                    $cekData = $this->_db->table('_setting_panitia_tb')->where(['sekolah_id' => $sekolahId->sekolah_id, 'is_locked' => 1])->countAllResults();

                    if ($cekData > 0) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Pengajuan Untuk Panitia PPDB Sekolah Telah Diverifikasi Dan Dikunci. Silahkan Hubungi Admin PPDB Dinas, Apabila Data Panitia PPDB Sekolah Anda Masih Belum Sesuai Dengan Ketentuan Yang Telah Ditetapkan.";
                        return json_encode($response);
                    }

                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Permintaan diizinkan";
                    $response->data = view('sekolah/setting/panitia/add');
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

                        $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $sekolahId->sekolah_id, 'is_locked' => 1])->countAllResults();

                        if ($cekData > 0) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Pengajuan Untuk Pemetaan Zonasi Telah Diverifikasi Dan Dikunci. Silahkan Hubungi Admin PPDB Dinas, Apabila Data Zonasi Sekolah Anda Masih Belum Sesuai Dengan Ketentuan Yang Telah Ditetapkan.";
                            return json_encode($response);
                        }

                        $id = htmlspecialchars($this->request->getVar('id'), true);

                        $select = "a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan";
                        $current = $this->_db->table('_setting_zonasi_tb a')
                            ->select($select)
                            ->join('ref_provinsi b', 'a.provinsi = b.id', 'LEFT')
                            ->join('ref_kabupaten c', 'a.kabupaten = c.id', 'LEFT')
                            ->join('ref_kecamatan d', 'a.kecamatan = d.id', 'LEFT')
                            ->join('ref_kelurahan e', 'a.kelurahan = e.id', 'LEFT')
                            // ->join('ref_dusun f', 'a.dusun = f.id', 'LEFT')
                            ->where('a.id', $id)->get()->getRowObject();

                        if ($current) {
                            $data['data'] = $current;
                            $data['provinsis'] = $this->_db->table('ref_provinsi')->where("id != '350000'")->orderBy('nama', 'asc')->get()->getResult();
                            $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $current->provinsi)->orderBy('nama', 'asc')->get()->getResult();
                            $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $current->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
                            $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $current->kecamatan)->orderBy('nama', 'asc')->get()->getResult();
                            // $data['dusuns'] = $this->_db->table('ref_dusun')->orderBy('urut', 'asc')->get()->getResult();
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = "Permintaan diizinkan";
                            $response->data = view('sekolah/setting/panitia/edit', $data);
                            return json_encode($response);
                        } else {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan";
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

            $select = "a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan";
            // $select = "a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan, f.nama as namaDusun";
            $current = $this->_db->table('_setting_zonasi_tb a')
                ->select($select)
                ->join('ref_provinsi b', 'a.provinsi = b.id', 'LEFT')
                ->join('ref_kabupaten c', 'a.kabupaten = c.id', 'LEFT')
                ->join('ref_kecamatan d', 'a.kecamatan = d.id', 'LEFT')
                ->join('ref_kelurahan e', 'a.kelurahan = e.id', 'LEFT')
                // ->join('ref_dusun f', 'a.dusun = f.id', 'LEFT')
                ->where('a.id', $id)->get()->getRowObject();

            if ($current) {
                $data['data'] = $current;
                $data['provinsis'] = $this->_db->table('ref_provinsi')->where("id != '350000'")->orderBy('nama', 'asc')->get()->getResult();
                $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $current->provinsi)->orderBy('nama', 'asc')->get()->getResult();
                $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $current->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
                $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $current->kecamatan)->orderBy('nama', 'asc')->get()->getResult();
                // $data['dusuns'] = $this->_db->table('ref_dusun')->orderBy('urut', 'asc')->get()->getResult();
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('sekolah/setting/panitia/detail', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }

    public function hapus()
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

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $current = $this->_db->table('_setting_zonasi_tb')->where('id', $id)->get()->getRowObject();

                        if ($current) {

                            if ((int)$current->is_locked == 1) {
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Settingan Zonasi sudah terkunci. Untuk merubah silahkan hubungi admin paniti PPDB Dinas.";
                                return json_encode($response);
                            }
                            $this->_db->table('_setting_zonasi_tb')->where('id', $id)->delete();

                            if ($this->_db->affectedRows() > 0) {
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menghapus setting zonasi sekolah", "Menghapus Zonasi Sekolah", "delete");
                                } catch (\Throwable $th) {
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data zonasi berhasil dihapus.";
                                return json_encode($response);
                            } else {
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Data gagal dihapus.";
                                return json_encode($response);
                            }
                        } else {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan";
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

    public function addSave()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nomor handphone tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nama')
                . $this->validator->getError('nohp');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);

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

                        $cekData = $this->_db->table('_setting_panitia_tb')->where(['sekolah_id' => $sekolahId->sekolah_id, 'nama' => $nama, 'nohp' => $nohp])->get()->getRowObject();

                        if ($cekData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Panitia ini untuk sekolah anda sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        $data = [
                            'id' => $uuid,
                            'sekolah_id' => $sekolahId->sekolah_id,
                            'bentuk_pendidikan_id' => $sekolahId->bentuk_pendidikan_id,
                            'npsn' => $sekolahId->npsn,
                            'nama' => $nama,
                            'no_hp' => $nohp,
                            'is_locked' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_setting_panitia_tb')->insert($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menambahkan setting panitia sekolah", "Menambahkan Panitia Sekolah", "submit");
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
                                $response->message = "Gagal menyimpan panitia.";
                                return json_encode($response);
                            }
                        } catch (\Throwable $th) {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal menyimpan panitia. terjadi kesalahan.";
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
            'prov' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Provinsi tidak boleh kosong. ',
                ]
            ],
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
            'kab' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kabupaten tidak boleh kosong. ',
                ]
            ],
            'kec' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong. ',
                ]
            ],
            'kel' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan tidak boleh kosong. ',
                ]
            ],
            // 'dusun' => [
            //     'rules' => 'required|trim',
            //     'errors' => [
            //         'required' => 'Dusun tidak boleh kosong. ',
            //     ]
            // ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . $this->validator->getError('prov') . $this->validator->getError('kab') . $this->validator->getError('kec') . $this->validator->getError('kel') . $this->validator->getError('dusun');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $prov = htmlspecialchars($this->request->getVar('prov'), true);
            $kab = htmlspecialchars($this->request->getVar('kab'), true);
            $kec = htmlspecialchars($this->request->getVar('kec'), true);
            $kel = htmlspecialchars($this->request->getVar('kel'), true);
            // $dusun = htmlspecialchars($this->request->getVar('dusun'), true);

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

                        $cekOldData = $this->_db->table('_setting_zonasi_tb')->where('id', $id)->get()->getRowObject();

                        if (!$cekOldData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan.";
                            return json_encode($response);
                        }

                        if ((int)$cekOldData->is_locked == 1) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Settingan Zonasi sudah terkunci. Untuk merubah silahkan hubungi admin paniti PPDB Dinas.";
                            return json_encode($response);
                        }

                        // if (($cekOldData->sekolah_id === $sekolahId->sekolah_id) && ($cekOldData->provinsi === $prov) && ($cekOldData->kabupaten === $kab) && ($cekOldData->kecamatan === $kec) && ($cekOldData->kelurahan === $kel) && ($cekOldData->dusun === $dusun)) {
                        if (($cekOldData->sekolah_id === $sekolahId->sekolah_id) && ($cekOldData->provinsi === $prov) && ($cekOldData->kabupaten === $kab) && ($cekOldData->kecamatan === $kec) && ($cekOldData->kelurahan === $kel)) {
                            $response = new \stdClass;
                            $response->code = 201;
                            $response->message = "Tidak ada perubahan data yang perlu disimpan.";
                            return json_encode($response);
                        }

                        $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $sekolahId->sekolah_id, 'provinsi' => $prov, 'kabupaten' => $kab, 'kecamatan' => $kec, 'kelurahan' => $kel])->get()->getRowObject();
                        // $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $sekolahId->sekolah_id, 'provinsi' => $prov, 'kabupaten' => $kab, 'kecamatan' => $kec, 'kelurahan' => $kel, 'dusun' => $dusun])->get()->getRowObject();

                        if ($cekData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Zonasi ini untuk sekolah anda sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        $data = [
                            'sekolah_id' => $sekolahId->sekolah_id,
                            'bentuk_pendidikan_id' => $sekolahId->bentuk_pendidikan_id,
                            'npsn' => $sekolahId->npsn,
                            'provinsi' => $prov,
                            'kabupaten' => $kab,
                            'kecamatan' => $kec,
                            'kelurahan' => $kel,
                            // 'dusun' => $dusun,
                            'is_locked' => 0,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_setting_zonasi_tb')->where('id', $cekOldData->id)->update($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Mengupdate setting zonasi sekolah", "Mengupdate Zonasi Sekolah", "update");
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
                                $response->message = "Gagal mengupdate zonasi.";
                                return json_encode($response);
                            }
                        } catch (\Throwable $th) {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal mengupdate zonasi. terjadi kesalahan.";
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
