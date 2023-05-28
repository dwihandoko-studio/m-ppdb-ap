<?php

namespace App\Controllers\Dinas\Masterdata;

use App\Controllers\BaseController;
use App\Models\Dinas\Masterdata\KelurahanModel;
use Config\Services;
 
use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;
use App\Libraries\Dinas\Riwayatlib;

class Kelurahan extends BaseController
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
        $datamodel = new KelurahanModel($request);
        if ($request->getMethod(true) == 'POST') {
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kec'), true) ?? "";

            $lists = $datamodel->get_datatables($filterKecamatan);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                // $kop = ($list->kop_surat === null || $list->kop_surat === "") ? '-' : 'Ada';
                // $logo = ($list->logo === null || $list->logo === "") ? '-' : '<img style="max-width: 60px; max-height: 60px;" alt="Logo Instansi" src="' . base_url('upload/instansi/logo') . '/' . $list->logo . '">';

                $action = '<div class="dropup">
                        <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                        </div>
                        <div class="dropdown-menu">
                            <!--<a href="javascript:;" class="dropdown-item" data-id="' . $list->id . '" data-name="' . $list->nama . '">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </a>
                            <a href="javascript:;" class="dropdown-item" data-id="' . $list->id . '" data-name="' . $list->nama . '">
                                <i class="ni ni-ruler-pencil"></i>
                                <span>Edit</span>
                            </a> -->
                            <a href="javascript:actionHapus(\'' . $list->id . '\', \' ' . $list->nama . '\')" class="dropdown-item">
                                    <i class="fa fa-trash"></i>
                                    <span>Hapus</span>
                                </a>
                        </div>
                    </div>';

                if ((int)$list->id_wilayah == 1) {
                    $status = '<span class="badge badge-success">Provinsi</span>';
                } else if ((int)$list->id_wilayah == 2) {
                    $status = '<span class="badge badge-success">Kabupaten</span>';
                } else if ((int)$list->id_wilayah == 3) {
                    $status = '<span class="badge badge-success">Kecamatan</span>';
                } else if ((int)$list->id_wilayah == 4) {
                    $status = '<span class="badge badge-success">Kelurahan</span>';
                } else {
                    $status = '<span class="badge badge-danger">Undefined</span>';
                }

                $row[] = $no;
                $row[] = $action;
                $row[] = $list->id;
                $row[] = $list->nama;
                $row[] = $status;

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterKecamatan),
                "recordsFiltered" => $datamodel->count_filtered($filterKecamatan),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Manage Referensi Kelurahan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        
        $data['user'] = $user->data;

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')
            ->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))
            ->orderBy('nama', 'asc')->get()->getResult();
            
        return view('dinas/masterdata/kelurahan/index', $data);
    }
    
    public function add()
    {
        if ($this->request->getMethod() != 'get') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')
            ->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))
            ->orderBy('nama', 'asc')->get()->getResult();

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('dinas/masterdata/kelurahan/add', $data);
        return json_encode($response);
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
            'kecamatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong. ',
                ]
            ],
            'kode' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kode kelurahan/desa tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama kelurahan/desa tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('kecamatan') . $this->validator->getError('kode') . $this->validator->getError('nama');
            return json_encode($response);
        } else {
            $kecamatan = htmlspecialchars($this->request->getVar('kecamatan'), true);
            $kode = htmlspecialchars($this->request->getVar('kode'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        
                        $cekData = $this->_db->table('ref_kelurahan')->where('id', $kode)->get()->getRowObject();

                        if ($cekData) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Kode kelurahan/desa sudah ada.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();

                        $data = [
                            'id' => $kode,
                            'id_kecamatan' => $kecamatan,
                            'nama' => $nama,
                            'id_wilayah' => 4,
                            'created_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('ref_kelurahan')->insert($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menambahkan referensi wilayah kelurahan $nama", "Menambahkan Rerefensi Kelurahan", "submit");
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
                            $response->message = "Gagal menyimpan data. terjadi kesalahan.";
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
                        $current = $this->_db->table('ref_kelurahan')->where('id', $id)->get()->getRowObject();

                        if ($current) {
                            $this->_db->table('ref_kelurahan')->where('id', $id)->delete();

                            if ($this->_db->affectedRows() > 0) {
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menghapus referensi kelurahan $current->nama", "Menghapus Referensi Kelurahan", "delete");
                                } catch (\Throwable $th) {
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data berhasil dihapus.";
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

}
