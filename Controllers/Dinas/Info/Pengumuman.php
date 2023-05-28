<?php

namespace App\Controllers\Dinas\Info;

use App\Controllers\BaseController;
use App\Models\Dinas\Info\PengumumanModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;
use App\Libraries\Dinas\Riwayatlib;

class Pengumuman extends BaseController
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
        $datamodel = new PengumumanModel($request);
        if ($request->getMethod(true) == 'POST') {
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

            $lists = $datamodel->get_datatables();
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $action = '<div class="dropup">
                        <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                        </div>
                        <div class="dropdown-menu">
                            <button onclick="actionDetail(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>
                            <!--<button onclick="actionEdit(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                <i class="ni ni-ruler-pencil"></i>
                                <span>Edit</span>
                            </button>-->
                            <button onclick="actionHapus(\'' . $list->id . '\', \' ' . $list->judul . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-trash"></i>
                                <span>Hapus</span>
                            </button>
                        </div>
                    </div>';

                if ((int)$list->status == 1) {
                    $status = '<span class="badge badge-success">Aktif</span>';
                } else {
                    $status = '<span class="badge badge-danger">Tidak Aktif</span>';
                }

                if ((int)$list->tampil == 1) {
                    $tampil = '<span class="badge badge-success">Ya</span>';
                } else {
                    $tampil = '<span class="badge badge-danger">Tidak</span>';
                }

                $row[] = $no;
                $row[] = $action;
                $row[] = $list->judul;
                $row[] = substr(strip_tags($list->isi), 0, 80) . "...";
                //             $row[] = potong_teks(str_ireplace(array('&lt;b&gt;', '&lt;/b&gt;', '&lt;h2&gt;', '&lt;/h2&gt;', '&lt;ol&gt;', '&lt;/ol&gt;', '&lt;li&gt;', '&lt;/li&gt;', '&lt;a&gt;', '&lt;/a&gt;'), '',
                // htmlspecialchars($list->isi)), 50);
                // $row[] = $tampil;
                // $row[] = $status;

                $row[] = '';
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Data Informasi Pengumuman';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;
        return view('dinas/info/pengumuman/index', $data);
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

            $oldData = $this->_db->table('_tb_info_pengumuman')->where('id', $id)->get()->getRowObject();

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
            $response->data = view('dinas/info/pengumuman/detail', $data);
            return json_encode($response);
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
            'judul' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Judul tidak boleh kosong.',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong.',
                ]
            ],
            'status' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Status tidak boleh kosong.',
                ]
            ],
            'tampil' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tampil tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('judul') . $this->validator->getError('deskripsi') . $this->validator->getError('status') . $this->validator->getError('tampil');
            return json_encode($response);
        } else {
            $judul = htmlspecialchars($this->request->getVar('judul'), true);
            $deskripsi = $this->request->getVar('deskripsi');
            $status = htmlspecialchars($this->request->getVar('status'), true);
            $tampil = htmlspecialchars($this->request->getVar('tampil'), true);

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'judul' => $judul,
                'isi' => $deskripsi,
                'tampil' => 1,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->_db->transBegin();
            try {
                $this->_db->table('_tb_info_pengumuman')->insert($data);
            } catch (\Exception $e) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal menyimpan data baru.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                try {
                    $riwayatLib = new Riwayatlib();
                    $riwayatLib->insert("Menambahkan informasi pengumuman", "Menambahkan Informasi Pengumuman", "submit");
                } catch (\Throwable $th) {
                }
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Data berhasil disimpan.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal menyimpan data";
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
                        $current = $this->_db->table('_tb_info_pengumuman')->where('id', $id)->get()->getRowObject();

                        if ($current) {
                            $this->_db->table('_tb_info_pengumuman')->where('id', $id)->delete();

                            if ($this->_db->affectedRows() > 0) {
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menghapus informasi pengumuman", "Menghapus Informasi Pengumuman", "delete");
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

    public function uploadImage()
    {
        $validated = $this->validate([
            'upload' => [
                'uploaded[upload]',
                'max_size[upload, 1024]',
                'is_image[upload]',
            ],
        ]);

        if ($validated) {
            $lampiran = $this->request->getFile('upload');
            $filesNamelampiran = $lampiran->getName();
            $newNamelampiran = _create_name_foto($filesNamelampiran);
            $writePath = './upload/widget';

            if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                $lampiran->move($writePath, $newNamelampiran);
                $data = [
                    "uploaded" => true,
                    "url" => base_url('upload/widget/' . $newNamelampiran),
                ];
            } else {
                $data = [
                    "uploaded" => false,
                    "error" => [
                        "message" => $lampiran
                    ],
                ];
            }
        } else {
            $data = [
                "uploaded" => false,
                "error" => [
                    "message" => $this->validator->getError('upload')
                ],
            ];
        }
        return $this->response->setJSON($data);
    }
}
