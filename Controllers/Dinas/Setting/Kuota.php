<?php

namespace App\Controllers\Dinas\Setting;

use App\Controllers\BaseController;
use App\Models\Dinas\KuotaModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;
use App\Libraries\Dinas\Riwayatlib;
// use App\Libraries\V1\Reftahuntwlib;

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

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new KuotaModel($request);

        // $verifikasiAksesLib = new Verifikasihakakseslib();
        // $hakAksesMenu = $verifikasiAksesLib->cekHakAkses();

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

                $action = "";
                $action .= '<div class="dropup">
                        <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                        </div>
                        <div class="dropdown-menu">
                            <button onclick="actionDetail(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>';
                if ((int)$list->is_locked === 1) {
                    $status = '<span class="badge badge-success">Verified</span>';
                    $action .= '<button onclick="actionUnlockVerification(\'' . $list->id . '\', \' ' . $list->nama_sekolah . ' - ' . $list->npsn . '\')" type="button" class="dropdown-item">
                                <i class="ni ni-lock-circle-open"></i>
                                <span>Unlock Verifikasi</span>
                            </button>';
                } else {
                    $status = '<span class="badge badge-danger">Belum</span>';
                    $action .= '<button onclick="actionVerification(\'' . $list->id . '\', \' ' . $list->nama_sekolah . ' - ' . $list->npsn . '\')" type="button" class="dropdown-item">
                                <i class="ni ni-check-bold"></i>
                                <span>Verifikasi</span>
                            </button>';
                }

                $row[] = $status;

                $action .= '<button onclick="actionEdit(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                <i class="ni ni-ruler-pencil"></i>
                                <span>Edit</span>
                            </button>
                            
                        </div>
                    </div>';
                $row[] = $action;
                // <button onclick="actionHapus(\'' . $list->id . '\', \' ' . $list->nama_sekolah . '\')" type="button" class="dropdown-item">
                //                 <i class="fa fa-trash"></i>
                //                 <span>Hapus</span>
                //             </button>
                //     } else {
                //         $row[] = '-';
                //     }
                // } else {
                //     $row[] = '-';
                // }


                // $row[] = $no;

                $row[] = $list->nama_kecamatan;
                $row[] = $list->nama_jenjang;
                $row[] = $list->npsn;
                $row[] = $list->nama_sekolah;
                $row[] = $list->jumlah_rombel_kebutuhan;
                $row[] = $list->zonasi;
                $row[] = $list->afirmasi;
                $row[] = $list->mutasi;
                $row[] = $list->prestasi;
                $row[] = (int)$list->zonasi + (int)$list->afirmasi + (int)$list->mutasi + (int)$list->prestasi;

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

    public function index()
    {
        $data['title'] = 'Setting Kuota';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;

        $data['jenjang_sekolas'] = $this->_db->table('ref_bentuk_pendidikan')->whereIn('id', [5, 6])->get()->getResult();

        $data['instansis'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/setting/kuota/index', $data);
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
            $response->data = view('dinas/setting/kuota/detail', $data);
            return json_encode($response);
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

        $data['jenjang_sekolas'] = $this->_db->table('ref_bentuk_pendidikan')->whereIn('id', [5, 6, 9, 10, 30, 31, 32, 33, 35, 36, 38])->get()->getResult();

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('dinas/setting/kuota/add', $data);
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
            $response->data = view('dinas/setting/kuota/edit', $data);
            return json_encode($response);
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
                        $current = $this->_db->table('_setting_kuota_tb')->where('id', $id)->get()->getRowObject();

                        if ($current) {
                            $this->_db->table('_setting_kuota_tb')->where('id', $id)->delete();

                            if ($this->_db->affectedRows() > 0) {
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menghapus setting kuota sekolah", "Menghapus Kuota Sekolah", "delete");
                                } catch (\Throwable $th) {
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data kuota berhasil dihapus.";
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

    public function verifikasi()
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
                    'required' => 'Nama sekolah tidak boleh kosong. ',
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
            $name = htmlspecialchars($this->request->getVar('name'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                // try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $current = $this->_db->table('_setting_kuota_tb')->where('id', $id)->get()->getRowObject();

                    if ($current) {
                        $this->_db->transBegin();

                        $this->_db->table('_setting_kuota_tb')->where('id', $id)->update(['is_locked' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

                        if ($this->_db->affectedRows() > 0) {
                            $this->_db->transCommit();
                            try {
                                $riwayatLib = new Riwayatlib();
                                $riwayatLib->insert("Memverifikasi data kuota sekolah $name", "Memverifikasi Kuota Sekolah", "submit");
                            } catch (\Throwable $th) {
                            }
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = "Data kuota Sekolah $name berhasil diverifikasi.";
                            return json_encode($response);
                        } else {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data kuota sekolah $name gagal diverifikasi.";
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
                // } catch (\Exception $e) {
                //     delete_cookie('jwt');
                //     session()->destroy();
                //     $response = new \stdClass;
                //     $response->code = 401;
                //     $response->error = $e;
                //     $response->message = "Session telah habis.";
                //     return json_encode($response);
                // }
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

    public function unlockVerifikasi()
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
                    'required' => 'Nama sekolah tidak boleh kosong. ',
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
            $name = htmlspecialchars($this->request->getVar('name'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                // try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $current = $this->_db->table('_setting_kuota_tb')->where('id', $id)->get()->getRowObject();

                    if ($current) {
                        $this->_db->transBegin();

                        $this->_db->table('_setting_kuota_tb')->where('id', $id)->update(['is_locked' => 0, 'updated_at' => date('Y-m-d H:i:s')]);

                        if ($this->_db->affectedRows() > 0) {
                            $this->_db->transCommit();
                            try {
                                $riwayatLib = new Riwayatlib();
                                $riwayatLib->insert("Mengunlock verifikasi data kuota sekolah $name", "Mengunlock verifikasi Kuota Sekolah", "submit");
                            } catch (\Throwable $th) {
                            }
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = "Data kuota Sekolah $name berhasil diunlock verifikasi.";
                            return json_encode($response);
                        } else {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data kuota sekolah $name gagal diunlock verifikasi.";
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
                // } catch (\Exception $e) {
                //     delete_cookie('jwt');
                //     session()->destroy();
                //     $response = new \stdClass;
                //     $response->code = 401;
                //     $response->error = $e;
                //     $response->message = "Session telah habis.";
                //     return json_encode($response);
                // }
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
            'jenjang' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenjang tidak boleh kosong. ',
                ]
            ],
            'sekolah' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Sekolah tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('jenjang') . $this->validator->getError('jenjang') . $this->validator->getError('radius') . $this->validator->getError('jumlahKelas') . $this->validator->getError('jumlahRombelCurrent') . $this->validator->getError('jumlahRombelKebutuhan');
            return json_encode($response);
        } else {
            $jumlahKelas = htmlspecialchars($this->request->getVar('jumlahKelas'), true);
            $jumlahRombelCurrent = htmlspecialchars($this->request->getVar('jumlahRombelCurrent'), true);
            $jumlahRombelKebutuhan = htmlspecialchars($this->request->getVar('jumlahRombelKebutuhan'), true);
            $radius = htmlspecialchars($this->request->getVar('radius'), true);
            $jenjang = htmlspecialchars($this->request->getVar('jenjang'), true);
            $sekolah = htmlspecialchars($this->request->getVar('sekolah'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $refSekolah = $this->_db->table('ref_sekolah')->where('id', $sekolah)->get()->getRowObject();

                        $cekData = $this->_db->table('_setting_kuota_tb')->where('sekolah_id', $sekolah)->get()->getRowObject();

                        if ($cekData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Kuota untuk sekolah ini sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                            return json_encode($response);
                        }

                        if (!$refSekolah) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Sekolah tidak ditemukan.";
                            return json_encode($response);
                        }

                        $prosentaseJalur = getProsentaseJalur($jenjang);

                        if (!$prosentaseJalur) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Referensi prosentase tidak ditemukan.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        if ($jenjang == "6" || $jenjang == "10" || $jenjang == "31" || $jenjang == "32" || $jenjang == "33" || $jenjang == "35" || $jenjang == "36") {
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

                        $data = [
                            'id' => $uuid,
                            'sekolah_id' => $sekolah,
                            'npsn' => $refSekolah->npsn,
                            'bentuk_pendidikan_id' => $jenjang,
                            'jumlah_kelas' => $jumlahKelas,
                            'jumlah_rombel_current' => $jumlahRombelCurrent,
                            'jumlah_rombel_kebutuhan' => $jumlahRombelKebutuhan,
                            'radius_zonasi' => $radius,
                            'zonasi' => $kZonasi,
                            'afirmasi' => $kAfirmasi,
                            'mutasi' => $kMutasi,
                            'prestasi' => $kPrestasi,
                            'is_locked' => 1,
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

                        $prosentaseJalur = getProsentaseJalur($oldData->bentuk_pendidikan_id);

                        if (!$prosentaseJalur) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Referensi prosentase tidak ditemukan.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        if ((int)$oldData->bentuk_pendidikan_id == 6 || (int)$oldData->bentuk_pendidikan_id == 10 || (int)$oldData->bentuk_pendidikan_id == 31 || (int)$oldData->bentuk_pendidikan_id == 32 || (int)$oldData->bentuk_pendidikan_id == 33 || (int)$oldData->bentuk_pendidikan_id == 35 || (int)$oldData->bentuk_pendidikan_id == 36) {
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

                        $data = [
                            'jumlah_kelas' => $jumlahKelas,
                            'jumlah_rombel_current' => $jumlahRombelCurrent,
                            'jumlah_rombel_kebutuhan' => $jumlahRombelKebutuhan,
                            'radius_zonasi' => $radius,
                            'zonasi' => $kZonasi,
                            'afirmasi' => $kAfirmasi,
                            'mutasi' => $kMutasi,
                            'prestasi' => $kPrestasi,
                            'is_locked' => 1,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_setting_kuota_tb')->where('id', $oldData->id)->update($data);
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

    public function import()
    {
        $data['title'] = 'IMPORT DATA KUOTA SEKOLAH';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        $data['user'] = $user->data;
        return view('dinas/setting/kuota/import', $data);
    }

    public function uploadData()
    {
        if ($this->request->getMethod() != 'post') {
            $response = [
                'code' => 400,
                'error' => "Hanya request post yang diperbolehkan."
            ];
        } else {

            $rules = [
                'file' => [
                    'rules' => 'uploaded[file]|max_size[file, 5120]|mime_in[file,application/vnd.ms-excel,application/msexcel,application/x-msexcel,application/x-ms-excel,application/x-excel,application/x-dos_ms_excel,application/xls,application/x-xls,application/excel,application/download,application/vnd.ms-office,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/zip,application/x-zip]',
                    'errors' => [
                        'uploaded' => 'File import gagal di upload. ',
                        'max_size' => 'Ukuran file melebihi batas file max file upload. ',
                        'mime_in' => 'Ekstensi file tidak diizinkan untuk di upload. ',
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $response = [
                    'code' => 400,
                    'error' => $this->validator->getError('file')
                ];
            } else {
                $jenjang = htmlspecialchars($this->request->getVar('jenjang'), true);
                $lampiran = $this->request->getFile('file');
                $extension = $lampiran->getClientExtension();
                $filesNamelampiran = $lampiran->getName();
                $fileLocation = $lampiran->getTempName();

                if ('xls' == $extension) {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }

                $spreadsheet = $reader->load($fileLocation);
                $sheet = $spreadsheet->getActiveSheet()->toArray();

                $total_line = (count($sheet) > 0) ? count($sheet) - 1 : 0;

                $dataImport = [];

                unset($sheet[0]);

                foreach ($sheet as $key => $data) {

                    if ($data[1] == "" || strlen($data[1]) < 8) {
                        // if($data[1] == "") {
                        continue;
                    }

                    $dataInsert = [
                        'npsn' => $data[1],
                        'kuota' => $data[3],
                        'jenjang' => $jenjang,
                    ];

                    $dataImport[] = $dataInsert;
                }

                $response = [
                    'code' => 200,
                    'success' => true,
                    'total_line' => $total_line,
                    'data' => $dataImport,
                ];
            }
        }

        echo json_encode($response);
    }

    public function importData()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'kuota' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kuota tidak boleh kosong. ',
                ]
            ],
            'jenjang' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenjang tidak boleh kosong. ',
                ]
            ],
            'npsn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NPSN tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('jenjang')
                . $this->validator->getError('npsn')
                . $this->validator->getError('kuota');
            return json_encode($response);
        } else {
            $jumlahKelas = htmlspecialchars($this->request->getVar('kuota'), true);
            $jumlahRombelCurrent = htmlspecialchars($this->request->getVar('kuota'), true);
            $jumlahRombelKebutuhan = htmlspecialchars($this->request->getVar('kuota'), true);
            $radius = htmlspecialchars('10', true);
            $jenjang = htmlspecialchars($this->request->getVar('jenjang'), true);
            $sekolah = htmlspecialchars($this->request->getVar('npsn'), true);

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

            $refSekolah = $this->_db->table('ref_sekolah')->where('npsn', $sekolah)->get()->getRowObject();

            $cekData = $this->_db->table('_setting_kuota_tb')->where('sekolah_id', $refSekolah->id)->get()->getRowObject();

            if ($cekData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Kuota untuk sekolah ini sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                return json_encode($response);
            }

            if (!$refSekolah) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Sekolah tidak ditemukan.";
                return json_encode($response);
            }

            $prosentaseJalur = getProsentaseJalur($jenjang);

            if (!$prosentaseJalur) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Referensi prosentase tidak ditemukan.";
                return json_encode($response);
            }

            $this->_db->transBegin();
            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            if ($jenjang == "6" || $jenjang == "10" || $jenjang == "31" || $jenjang == "32" || $jenjang == "33" || $jenjang == "35" || $jenjang == "36") {
                $jumlahSiswa = 32 * (int)$jumlahRombelKebutuhan;
                $kZonasi = ceil(($prosentaseJalur->zonasi / 100) * $jumlahSiswa);
                $kAfirmasi = ceil(($prosentaseJalur->afirmasi / 100) * $jumlahSiswa);
                $kMutasi = ceil(($prosentaseJalur->mutasi / 100) * $jumlahSiswa);
                $kPrestasi = $jumlahSiswa - ($kZonasi + $kAfirmasi + $kMutasi);
            } else {
                $jumlahSiswa = 28 * (int)$jumlahRombelKebutuhan;
                $kZonasi = ceil(($prosentaseJalur->zonasi / 100) * $jumlahSiswa);
                $kAfirmasi = ceil(($prosentaseJalur->afirmasi / 100) * $jumlahSiswa);
                $kMutasi = $jumlahSiswa - ($kZonasi + $kAfirmasi);
                // $kMutasi = ceil(($prosentaseJalur->mutasi / 100) * $jumlahSiswa);
                $kPrestasi = 0;
            }

            $data = [
                'id' => $uuid,
                'sekolah_id' => $refSekolah->id,
                'npsn' => $refSekolah->npsn,
                'bentuk_pendidikan_id' => $jenjang,
                'jumlah_kelas' => $jumlahKelas,
                'jumlah_rombel_current' => $jumlahRombelCurrent,
                'jumlah_rombel_kebutuhan' => $jumlahRombelKebutuhan,
                'radius_zonasi' => $radius,
                'zonasi' => $kZonasi,
                'afirmasi' => $kAfirmasi,
                'mutasi' => $kMutasi,
                'prestasi' => $kPrestasi,
                'is_locked' => 1,
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
                    $response->message = "Berhasil mengimport data";
                    $response->url = base_url('dinas/setting/kuota');
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
        }
    }
}
