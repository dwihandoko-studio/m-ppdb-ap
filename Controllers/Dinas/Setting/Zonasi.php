<?php

namespace App\Controllers\Dinas\Setting;

use App\Controllers\BaseController;
use App\Models\Dinas\ZonasiModel;
use App\Models\Dinas\KuotaModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
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


    public function getAllSekolah()
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

                $row[] = $no;
                $action = '<a class="btn btn-primary btn-sm" href="' . base_url('dinas/setting/zonasi/sekolah?token=' . $list->sekolah_id) . '">
                                <i class="ni ni-vector"></i>
                                <span>ZONASI</span>
                            </a>';
                $row[] = $action;
                $row[] = statusVerifikasiZonasiSekolah($list->sekolah_id);
                $row[] = $list->nama_jenjang;
                $row[] = $list->npsn;
                $row[] = $list->nama_sekolah;
                $row[] = $list->nama_kecamatan;
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

    public function getAll()
    {

        $request = Services::request();
        $datamodel = new ZonasiModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
            // $idSekolah = htmlspecialchars($request->getVar('sekolah_id'), true) ?? "";

            $lists = $datamodel->get_datatables($filterJenjang, $filterKecamatan);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                // $row[] = $no;
                if ((int)$list->is_locked === 1) {
                    $status = '<span class="badge badge-success">Verified</span>';
                    // $action .= '<button onclick="actionUnlockVerification(\'' . $list->id . '\', \' ' . $list->nama_sekolah . ' - ' . $list->npsn . '\')" type="button" class="dropdown-item">
                    //             <i class="ni ni-lock-circle-open"></i>
                    //             <span>Unlock Verifikasi</span>
                    //         </button>';
                } else {
                    $status = '<span class="badge badge-danger">Belum</span>';
                    // $action .= '<button onclick="actionVerification(\'' . $list->id . '\', \' ' . $list->nama_sekolah . ' - ' . $list->npsn . '\')" type="button" class="dropdown-item">
                    //             <i class="ni ni-check-bold"></i>
                    //             <span>Verifikasi</span>
                    //         </button>';
                }
                $row[] = $status;
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
                $action .= '<button onclick="actionHapus(\'' . $list->id . '\', \' ' . $list->nama_sekolah . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </div>';
                $row[] = $action;
                $row[] = $list->nama_sekolah;
                $row[] = $list->npsn;
                $row[] = $list->namaKecamatan;
                $row[] = $list->namaKabupaten;
                $row[] = $list->namaProvinsi;

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterJenjang, $filterKecamatan),
                "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterKecamatan),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Setting Zonasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['jenjangs'] = $this->_db->table('ref_bentuk_pendidikan')->whereIn('id', [5, 6])->get()->getResult();
        $data['instansis'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/setting/zonasi/index-sekolah', $data);
    }

    public function sekolah()
    {
        $id = $this->request->getGet('token');
        if ($id === null || $id === "") {
            return redirect()->to(base_url('dinas/setting/zonasi'));
        }

        $sekolah = $this->_db->table('_setting_kuota_tb a')
            ->select("a.*, b.nama as nama_sekolah, c.nama as nama_kecamatan, d.nama as nama_jenjang")
            ->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT')
            ->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT')
            ->join('ref_kecamatan c', 'b.kode_wilayah = c.id', 'LEFT')
            ->where('a.sekolah_id', htmlspecialchars($id, true))
            ->get()->getRowObject();

        if (!$sekolah) {
            return redirect()->to(base_url('dinas/setting/zonasi'));
        }

        $data['title'] = 'Setting Zonasi ' . $sekolah->nama_sekolah;

        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['sekolah'] = $sekolah;

        return view('dinas/setting/zonasi/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('dinas/setting/zonasi/add', $data);
        return json_encode($response);
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

            $oldData = $this->_db->table('_setting_zonasi_tb a')
                // ->select("a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan, f.nama as namaDusun, g.nama as nama_sekolah, h.nama as nama_jenjang")
                ->select("a.*, b.nama as namaProvinsi, c.nama as namaKabupaten, d.nama as namaKecamatan, e.nama as namaKelurahan, g.nama as nama_sekolah, h.nama as nama_jenjang")
                ->join('ref_provinsi b', 'a.provinsi = b.id', 'LEFT')
                ->join('ref_kabupaten c', 'a.kabupaten = c.id', 'LEFT')
                ->join('ref_kecamatan d', 'a.kecamatan = d.id', 'LEFT')
                ->join('ref_kelurahan e', 'a.kelurahan = e.id', 'LEFT')
                // ->join('ref_dusun f', 'a.dusun = f.id', 'LEFT')
                ->join('ref_sekolah g', 'a.sekolah_id = g.id', 'LEFT')
                ->join('ref_bentuk_pendidikan h', 'a.bentuk_pendidikan_id = h.id', 'LEFT')
                ->where('a.id', $id)
                ->get()->getRowObject();

            if ($oldData) {
                $data['data'] = $oldData;

                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Data ditemukan.";
                $response->title = "Data ditemukan.";
                $response->data = view('dinas/setting/zonasi/detail', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }
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
                $response->data = view('dinas/setting/zonasi/edit', $data);
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
            $response->message = $this->validator->getError('id') . $this->validator->getError('name');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $name = htmlspecialchars($this->request->getVar('name'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $current = $this->_db->table('_setting_zonasi_tb')->where('sekolah_id', $id)->get()->getRowObject();

                        if ($current) {
                            $this->_db->table('_setting_zonasi_tb')->where('sekolah_id', $id)->update(['is_locked' => 1, 'updated_at' => date('Y-m-d H:i:s')]);

                            if ($this->_db->affectedRows() > 0) {
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Memverifikasi pemetaan zonasi sekolah $name", "Memverifikasi Pemetaan Zonasi Sekolah", "submit");
                                } catch (\Throwable $th) {
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data pemetaan zonasi $name berhasil diverifikasi.";
                                return json_encode($response);
                            } else {
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Data pemetaan zonasi $name gagal diverifikasi.";
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
            'prov' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Provinsi tidak boleh kosong. ',
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
            'sekolah' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Sekolah tidak boleh kosong. ',
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
            $response->message = $this->validator->getError('sekolah') . $this->validator->getError('npsn') . $this->validator->getError('jenjang') . $this->validator->getError('prov') . $this->validator->getError('kab') . $this->validator->getError('kec') . $this->validator->getError('kel') . $this->validator->getError('dusun');
            return json_encode($response);
        } else {
            $prov = htmlspecialchars($this->request->getVar('prov'), true);
            $kab = htmlspecialchars($this->request->getVar('kab'), true);
            $kec = htmlspecialchars($this->request->getVar('kec'), true);
            $kel = htmlspecialchars($this->request->getVar('kel'), true);
            $sekolah = htmlspecialchars($this->request->getVar('sekolah'), true);
            $jenjang = htmlspecialchars($this->request->getVar('jenjang'), true);
            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
            // $dusun = htmlspecialchars($this->request->getVar('dusun'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;

                        // $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $sekolah, 'provinsi' => $prov, 'kabupaten' => $kab, 'kecamatan' => $kec, 'kelurahan' => $kel, 'dusun' => $dusun])->get()->getRowObject();
                        $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $sekolah, 'provinsi' => $prov, 'kabupaten' => $kab, 'kecamatan' => $kec, 'kelurahan' => $kel])->get()->getRowObject();

                        if ($cekData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Zonasi ini untuk sekolah ini dengan wilayah yang di pilih sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        $data = [
                            'id' => $uuid,
                            'sekolah_id' => $sekolah,
                            'bentuk_pendidikan_id' => $jenjang,
                            'npsn' => $npsn,
                            'provinsi' => $prov,
                            'kabupaten' => $kab,
                            'kecamatan' => $kec,
                            'kelurahan' => $kel,
                            // 'dusun' => $dusun,
                            'is_locked' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_setting_zonasi_tb')->insert($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menambahkan setting zonasi sekolah", "Menambahkan Zonasi Sekolah", "submit");
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
                                $response->message = "Gagal menyimpan zonasi.";
                                return json_encode($response);
                            }
                        } catch (\Throwable $th) {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal menyimpan zonasi. terjadi kesalahan.";
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
                    $response->message = "Session telah habis...";
                    return json_encode($response);
                }
            } else {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis..";
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

                // try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    // $sekolahId = $this->_db->table('_users_profil_tb a')
                    //     ->select("a.*, b.bentuk_pendidikan_id")
                    //     ->join('ref_sekolah b', 'a.sekolah_id = b.id', 'left')
                    //     ->where('a.id', $userId)->get()->getRowObject();

                    // if (!$sekolahId) {
                    //     $response = new \stdClass;
                    //     $response->code = 400;
                    //     $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                    //     return json_encode($response);
                    // }
                    // if ($sekolahId->sekolah_id === null) {
                    //     $response = new \stdClass;
                    //     $response->code = 400;
                    //     $response->message = "Sekolah anda belum di set oleh admin dinas. Silahkan menghubungi admin dinas.";
                    //     return json_encode($response);
                    // }

                    $cekOldData = $this->_db->table('_setting_zonasi_tb')->where('id', $id)->get()->getRowObject();

                    if (!$cekOldData) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Data tidak ditemukan.";
                        return json_encode($response);
                    }

                    // if ((int)$cekOldData->is_locked == 1) {
                    //     $response = new \stdClass;
                    //     $response->code = 400;
                    //     $response->message = "Settingan Zonasi sudah terkunci. Untuk merubah silahkan hubungi admin paniti PPDB Dinas.";
                    //     return json_encode($response);
                    // }

                    // if (($cekOldData->provinsi === $prov) && ($cekOldData->kabupaten === $kab) && ($cekOldData->kecamatan === $kec) && ($cekOldData->kelurahan === $kel) && ($cekOldData->dusun === $dusun)) {
                    if (($cekOldData->provinsi === $prov) && ($cekOldData->kabupaten === $kab) && ($cekOldData->kecamatan === $kec) && ($cekOldData->kelurahan === $kel)) {
                        $response = new \stdClass;
                        $response->code = 201;
                        $response->message = "Tidak ada perubahan data yang perlu disimpan.";
                        return json_encode($response);
                    }

                    $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $cekOldData->sekolah_id, 'provinsi' => $prov, 'kabupaten' => $kab, 'kecamatan' => $kec, 'kelurahan' => $kel])->get()->getRowObject();
                    // $cekData = $this->_db->table('_setting_zonasi_tb')->where(['sekolah_id' => $cekOldData->sekolah_id, 'provinsi' => $prov, 'kabupaten' => $kab, 'kecamatan' => $kec, 'kelurahan' => $kel, 'dusun' => $dusun])->get()->getRowObject();

                    if ($cekData) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Zonasi ini untuk sekolah ini pada wilayah yang dipilih sudah di set, silahkan menggunakan menu edit untuk merubah data.";
                        return json_encode($response);
                    }

                    $this->_db->transBegin();
                    // $uuidLib = new Uuid();
                    // $uuid = $uuidLib->v4();

                    $data = [
                        // 'sekolah_id' => $sekolahId->sekolah_id,
                        // 'bentuk_pendidikan_id' => $sekolahId->bentuk_pendidikan_id,
                        // 'npsn' => $sekolahId->npsn,
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
}
