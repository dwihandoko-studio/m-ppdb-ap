<?php

namespace App\Controllers\Dinas\Setting;

use App\Controllers\BaseController;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;

class Penjadwalan extends BaseController
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
        $data['title'] = 'Setting Penjadwalan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;

        $data['data'] = $this->_db->table('_setting_jadwal_tb')->where('is_active', 1)->get()->getRowObject();

        return view('dinas/setting/jadwal/index', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() != 'get') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('dinas/setting/jadwal/add');
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

            $oldData = $this->_db->table('_setting_jadwal_tb')->where('id', $id)->get()->getRowObject();

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
            $response->data = view('dinas/setting/jadwal/edit', $data);
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
            'tgl_awal_pendaftaran_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_pendaftaran_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_pendaftaran_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_pendaftaran_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_mutasi tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('tgl_awal_pendaftaran_zonasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_zonasi') .
                $this->validator->getError('tgl_awal_verifikasi_zonasi') .
                $this->validator->getError('tgl_akhir_verifikasi_zonasi') .
                $this->validator->getError('tgl_awal_analisis_zonasi') .
                $this->validator->getError('tgl_akhir_analisis_zonasi') .
                $this->validator->getError('tgl_pengumuman_zonasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_zonasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_zonasi') .
                $this->validator->getError('tgl_awal_pendaftaran_afirmasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_afirmasi') .
                $this->validator->getError('tgl_awal_verifikasi_afirmasi') .
                $this->validator->getError('tgl_akhir_verifikasi_afirmasi') .
                $this->validator->getError('tgl_awal_analisis_afirmasi') .
                $this->validator->getError('tgl_akhir_analisis_afirmasi') .
                $this->validator->getError('tgl_pengumuman_afirmasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_afirmasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_afirmasi') .
                $this->validator->getError('tgl_awal_pendaftaran_prestasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_prestasi') .
                $this->validator->getError('tgl_awal_verifikasi_prestasi') .
                $this->validator->getError('tgl_akhir_verifikasi_prestasi') .
                $this->validator->getError('tgl_awal_analisis_prestasi') .
                $this->validator->getError('tgl_akhir_analisis_prestasi') .
                $this->validator->getError('tgl_pengumuman_prestasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_prestasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_prestasi') .
                $this->validator->getError('tgl_awal_pendaftaran_mutasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_mutasi') .
                $this->validator->getError('tgl_awal_verifikasi_mutasi') .
                $this->validator->getError('tgl_akhir_verifikasi_mutasi') .
                $this->validator->getError('tgl_awal_analisis_mutasi') .
                $this->validator->getError('tgl_akhir_analisis_mutasi') .
                $this->validator->getError('tgl_pengumuman_mutasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_mutasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_mutasi');
            return json_encode($response);
        } else {
            $tgl_awal_pendaftaran_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_zonasi'), true);
            $tgl_akhir_pendaftaran_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_zonasi'), true);
            $tgl_awal_verifikasi_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_zonasi'), true);
            $tgl_akhir_verifikasi_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_zonasi'), true);
            $tgl_awal_analisis_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_zonasi'), true);
            $tgl_akhir_analisis_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_zonasi'), true);
            $tgl_pengumuman_zonasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_zonasi'), true);
            $tgl_awal_daftar_ulang_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_zonasi'), true);
            $tgl_akhir_daftar_ulang_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_zonasi'), true);
            $tgl_awal_pendaftaran_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_afirmasi'), true);
            $tgl_akhir_pendaftaran_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_afirmasi'), true);
            $tgl_awal_verifikasi_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_afirmasi'), true);
            $tgl_akhir_verifikasi_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_afirmasi'), true);
            $tgl_awal_analisis_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_afirmasi'), true);
            $tgl_akhir_analisis_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_afirmasi'), true);
            $tgl_pengumuman_afirmasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_afirmasi'), true);
            $tgl_awal_daftar_ulang_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_afirmasi'), true);
            $tgl_akhir_daftar_ulang_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_afirmasi'), true);
            $tgl_awal_pendaftaran_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_prestasi'), true);
            $tgl_akhir_pendaftaran_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_prestasi'), true);
            $tgl_awal_verifikasi_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_prestasi'), true);
            $tgl_akhir_verifikasi_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_prestasi'), true);
            $tgl_awal_analisis_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_prestasi'), true);
            $tgl_akhir_analisis_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_prestasi'), true);
            $tgl_pengumuman_prestasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_prestasi'), true);
            $tgl_awal_daftar_ulang_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_prestasi'), true);
            $tgl_akhir_daftar_ulang_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_prestasi'), true);
            $tgl_awal_pendaftaran_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_mutasi'), true);
            $tgl_akhir_pendaftaran_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_mutasi'), true);
            $tgl_awal_verifikasi_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_mutasi'), true);
            $tgl_akhir_verifikasi_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_mutasi'), true);
            $tgl_awal_analisis_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_mutasi'), true);
            $tgl_akhir_analisis_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_mutasi'), true);
            $tgl_pengumuman_mutasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_mutasi'), true);
            $tgl_awal_daftar_ulang_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_mutasi'), true);
            $tgl_akhir_daftar_ulang_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_mutasi'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $kode_wilayah = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

                        if (!$kode_wilayah) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Dinas anda belum di set oleh layanan. Silahkan menghubungi admin layanan.";
                            return json_encode($response);
                        }
                        if ($kode_wilayah->kabupaten === null) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Dinas anda belum di set oleh layanan. Silahkan menghubungi admin layanan.";
                            return json_encode($response);
                        }

                        $this->_db->transBegin();
                        $uuidLib = new Uuid();
                        $uuid = $uuidLib->v4();

                        $data = [
                            'id' => $uuid,
                            'kode_wilayah' => $kode_wilayah->kabupaten,
                            'is_active' => 1,
                            'tgl_awal_pendaftaran_zonasi' => $tgl_awal_pendaftaran_zonasi . ' 07:00:00',
                            'tgl_akhir_pendaftaran_zonasi' => $tgl_akhir_pendaftaran_zonasi . ' 15:00:00',
                            'tgl_awal_verifikasi_zonasi' => $tgl_awal_verifikasi_zonasi . ' 07:00:00',
                            'tgl_akhir_verifikasi_zonasi' => $tgl_akhir_verifikasi_zonasi . ' 17:00:00',
                            'tgl_awal_analisis_zonasi' => $tgl_awal_analisis_zonasi . ' 00:00:00',
                            'tgl_akhir_analisis_zonasi' => $tgl_akhir_analisis_zonasi . ' 23:59:00',
                            'tgl_pengumuman_zonasi' => $tgl_pengumuman_zonasi . ' 00:00:01',
                            'tgl_awal_daftar_ulang_zonasi' => $tgl_awal_daftar_ulang_zonasi . ' 07:00:00',
                            'tgl_akhir_daftar_ulang_zonasi' => $tgl_akhir_daftar_ulang_zonasi . ' 15:00:00',
                            'tgl_awal_pendaftaran_afirmasi' => $tgl_awal_pendaftaran_afirmasi . ' 07:00:00',
                            'tgl_akhir_pendaftaran_afirmasi' => $tgl_akhir_pendaftaran_afirmasi . ' 15:00:00',
                            'tgl_awal_verifikasi_afirmasi' => $tgl_awal_verifikasi_afirmasi . ' 07:00:00',
                            'tgl_akhir_verifikasi_afirmasi' => $tgl_akhir_verifikasi_afirmasi . ' 17:00:00',
                            'tgl_awal_analisis_afirmasi' => $tgl_awal_analisis_afirmasi . ' 00:00:00',
                            'tgl_akhir_analisis_afirmasi' => $tgl_akhir_analisis_afirmasi . ' 23:59:00',
                            'tgl_pengumuman_afirmasi' => $tgl_pengumuman_afirmasi . ' 00:00:01',
                            'tgl_awal_daftar_ulang_afirmasi' => $tgl_awal_daftar_ulang_afirmasi . ' 07:00:00',
                            'tgl_akhir_daftar_ulang_afirmasi' => $tgl_akhir_daftar_ulang_afirmasi . ' 15:00:00',
                            'tgl_awal_pendaftaran_prestasi' => $tgl_awal_pendaftaran_prestasi . ' 07:00:00',
                            'tgl_akhir_pendaftaran_prestasi' => $tgl_akhir_pendaftaran_prestasi . ' 15:00:00',
                            'tgl_awal_verifikasi_prestasi' => $tgl_awal_verifikasi_prestasi . ' 07:00:00',
                            'tgl_akhir_verifikasi_prestasi' => $tgl_akhir_verifikasi_prestasi . ' 17:00:00',
                            'tgl_awal_analisis_prestasi' => $tgl_awal_analisis_prestasi . ' 00:00:00',
                            'tgl_akhir_analisis_prestasi' => $tgl_akhir_analisis_prestasi . ' 23:59:00',
                            'tgl_pengumuman_prestasi' => $tgl_pengumuman_prestasi . ' 00:00:01',
                            'tgl_awal_daftar_ulang_prestasi' => $tgl_awal_daftar_ulang_prestasi . ' 07:00:00',
                            'tgl_akhir_daftar_ulang_prestasi' => $tgl_akhir_daftar_ulang_prestasi . ' 15:00:00',
                            'tgl_awal_pendaftaran_mutasi' => $tgl_awal_pendaftaran_mutasi . ' 07:00:00',
                            'tgl_akhir_pendaftaran_mutasi' => $tgl_akhir_pendaftaran_mutasi . ' 15:00:00',
                            'tgl_awal_verifikasi_mutasi' => $tgl_awal_verifikasi_mutasi . ' 07:00:00',
                            'tgl_akhir_verifikasi_mutasi' => $tgl_akhir_verifikasi_mutasi . ' 17:00:00',
                            'tgl_awal_analisis_mutasi' => $tgl_awal_analisis_mutasi . ' 00:00:00',
                            'tgl_akhir_analisis_mutasi' => $tgl_akhir_analisis_mutasi . ' 23:59:00',
                            'tgl_pengumuman_mutasi' => $tgl_pengumuman_mutasi . ' 00:00:01',
                            'tgl_awal_daftar_ulang_mutasi' => $tgl_awal_daftar_ulang_mutasi . ' 07:00:00',
                            'tgl_akhir_daftar_ulang_mutasi' => $tgl_akhir_daftar_ulang_mutasi . ' 15:00:00',
                        ];

                        try {
                            $this->_db->table('_setting_jadwal_tb')->insert($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->table('_setting_jadwal_tb')->whereNotIn('id', [$data['id']])->update(['is_active' => 0]);
                                $this->_db->transCommit();
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data berhasil disimpan.";
                                $response->data = $data;
                                return json_encode($response);
                            } else {
                                $this->_db->transRollback();
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Gagal menyimpan data.";
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

    public function editSave()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'tgl_awal_pendaftaran_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_zonasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_zonasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_pendaftaran_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_afirmasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_afirmasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_pendaftaran_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_prestasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_prestasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_pendaftaran_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_pendaftaran_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_pendaftaran_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_pendaftaran_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_verifikasi_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_verifikasi_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_verifikasi_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_verifikasi_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_analisis_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_analisis_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_analisis_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_analisis_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_pengumuman_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_pengumuman_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_awal_daftar_ulang_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_awal_daftar_ulang_mutasi tidak boleh kosong. ',
                ]
            ],
            'tgl_akhir_daftar_ulang_mutasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'tgl_akhir_daftar_ulang_mutasi tidak boleh kosong. ',
                ]
            ],
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('tgl_awal_pendaftaran_zonasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_zonasi') .
                $this->validator->getError('tgl_awal_verifikasi_zonasi') .
                $this->validator->getError('tgl_akhir_verifikasi_zonasi') .
                $this->validator->getError('tgl_awal_analisis_zonasi') .
                $this->validator->getError('tgl_akhir_analisis_zonasi') .
                $this->validator->getError('tgl_pengumuman_zonasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_zonasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_zonasi') .
                $this->validator->getError('tgl_awal_pendaftaran_afirmasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_afirmasi') .
                $this->validator->getError('tgl_awal_verifikasi_afirmasi') .
                $this->validator->getError('tgl_akhir_verifikasi_afirmasi') .
                $this->validator->getError('tgl_awal_analisis_afirmasi') .
                $this->validator->getError('tgl_akhir_analisis_afirmasi') .
                $this->validator->getError('tgl_pengumuman_afirmasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_afirmasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_afirmasi') .
                $this->validator->getError('tgl_awal_pendaftaran_prestasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_prestasi') .
                $this->validator->getError('tgl_awal_verifikasi_prestasi') .
                $this->validator->getError('tgl_akhir_verifikasi_prestasi') .
                $this->validator->getError('tgl_awal_analisis_prestasi') .
                $this->validator->getError('tgl_akhir_analisis_prestasi') .
                $this->validator->getError('tgl_pengumuman_prestasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_prestasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_prestasi') .
                $this->validator->getError('tgl_awal_pendaftaran_mutasi') .
                $this->validator->getError('tgl_akhir_pendaftaran_mutasi') .
                $this->validator->getError('tgl_awal_verifikasi_mutasi') .
                $this->validator->getError('tgl_akhir_verifikasi_mutasi') .
                $this->validator->getError('tgl_awal_analisis_mutasi') .
                $this->validator->getError('tgl_akhir_analisis_mutasi') .
                $this->validator->getError('tgl_pengumuman_mutasi') .
                $this->validator->getError('tgl_awal_daftar_ulang_mutasi') .
                $this->validator->getError('tgl_akhir_daftar_ulang_mutasi') .
                $this->validator->getError('id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $tgl_awal_pendaftaran_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_zonasi'), true);
            $tgl_akhir_pendaftaran_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_zonasi'), true);
            $tgl_awal_verifikasi_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_zonasi'), true);
            $tgl_akhir_verifikasi_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_zonasi'), true);
            $tgl_awal_analisis_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_zonasi'), true);
            $tgl_akhir_analisis_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_zonasi'), true);
            $tgl_pengumuman_zonasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_zonasi'), true);
            $tgl_awal_daftar_ulang_zonasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_zonasi'), true);
            $tgl_akhir_daftar_ulang_zonasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_zonasi'), true);
            $tgl_awal_pendaftaran_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_afirmasi'), true);
            $tgl_akhir_pendaftaran_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_afirmasi'), true);
            $tgl_awal_verifikasi_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_afirmasi'), true);
            $tgl_akhir_verifikasi_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_afirmasi'), true);
            $tgl_awal_analisis_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_afirmasi'), true);
            $tgl_akhir_analisis_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_afirmasi'), true);
            $tgl_pengumuman_afirmasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_afirmasi'), true);
            $tgl_awal_daftar_ulang_afirmasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_afirmasi'), true);
            $tgl_akhir_daftar_ulang_afirmasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_afirmasi'), true);
            $tgl_awal_pendaftaran_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_prestasi'), true);
            $tgl_akhir_pendaftaran_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_prestasi'), true);
            $tgl_awal_verifikasi_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_prestasi'), true);
            $tgl_akhir_verifikasi_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_prestasi'), true);
            $tgl_awal_analisis_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_prestasi'), true);
            $tgl_akhir_analisis_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_prestasi'), true);
            $tgl_pengumuman_prestasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_prestasi'), true);
            $tgl_awal_daftar_ulang_prestasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_prestasi'), true);
            $tgl_akhir_daftar_ulang_prestasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_prestasi'), true);
            $tgl_awal_pendaftaran_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_pendaftaran_mutasi'), true);
            $tgl_akhir_pendaftaran_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_pendaftaran_mutasi'), true);
            $tgl_awal_verifikasi_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_verifikasi_mutasi'), true);
            $tgl_akhir_verifikasi_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_verifikasi_mutasi'), true);
            $tgl_awal_analisis_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_analisis_mutasi'), true);
            $tgl_akhir_analisis_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_analisis_mutasi'), true);
            $tgl_pengumuman_mutasi = htmlspecialchars($this->request->getVar('tgl_pengumuman_mutasi'), true);
            $tgl_awal_daftar_ulang_mutasi = htmlspecialchars($this->request->getVar('tgl_awal_daftar_ulang_mutasi'), true);
            $tgl_akhir_daftar_ulang_mutasi = htmlspecialchars($this->request->getVar('tgl_akhir_daftar_ulang_mutasi'), true);



            $oldData = $this->_db->table('_setting_jadwal_tb')->where('id', $id)->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $data = [
                'is_active' => 1,
                'tgl_awal_pendaftaran_zonasi' => $tgl_awal_pendaftaran_zonasi . ' 07:00:00',
                'tgl_akhir_pendaftaran_zonasi' => $tgl_akhir_pendaftaran_zonasi . ' 15:00:00',
                'tgl_awal_verifikasi_zonasi' => $tgl_awal_verifikasi_zonasi . ' 07:00:00',
                'tgl_akhir_verifikasi_zonasi' => $tgl_akhir_verifikasi_zonasi . ' 17:00:00',
                'tgl_awal_analisis_zonasi' => $tgl_awal_analisis_zonasi . ' 00:00:00',
                'tgl_akhir_analisis_zonasi' => $tgl_akhir_analisis_zonasi . ' 23:59:00',
                'tgl_pengumuman_zonasi' => $tgl_pengumuman_zonasi . ' 00:00:01',
                'tgl_awal_daftar_ulang_zonasi' => $tgl_awal_daftar_ulang_zonasi . ' 07:00:00',
                'tgl_akhir_daftar_ulang_zonasi' => $tgl_akhir_daftar_ulang_zonasi . ' 15:00:00',
                'tgl_awal_pendaftaran_afirmasi' => $tgl_awal_pendaftaran_afirmasi . ' 07:00:00',
                'tgl_akhir_pendaftaran_afirmasi' => $tgl_akhir_pendaftaran_afirmasi . ' 15:00:00',
                'tgl_awal_verifikasi_afirmasi' => $tgl_awal_verifikasi_afirmasi . ' 07:00:00',
                'tgl_akhir_verifikasi_afirmasi' => $tgl_akhir_verifikasi_afirmasi . ' 17:00:00',
                'tgl_awal_analisis_afirmasi' => $tgl_awal_analisis_afirmasi . ' 00:00:00',
                'tgl_akhir_analisis_afirmasi' => $tgl_akhir_analisis_afirmasi . ' 23:59:00',
                'tgl_pengumuman_afirmasi' => $tgl_pengumuman_afirmasi . ' 00:00:01',
                'tgl_awal_daftar_ulang_afirmasi' => $tgl_awal_daftar_ulang_afirmasi . ' 07:00:00',
                'tgl_akhir_daftar_ulang_afirmasi' => $tgl_akhir_daftar_ulang_afirmasi . ' 15:00:00',
                'tgl_awal_pendaftaran_prestasi' => $tgl_awal_pendaftaran_prestasi . ' 07:00:00',
                'tgl_akhir_pendaftaran_prestasi' => $tgl_akhir_pendaftaran_prestasi . ' 15:00:00',
                'tgl_awal_verifikasi_prestasi' => $tgl_awal_verifikasi_prestasi . ' 07:00:00',
                'tgl_akhir_verifikasi_prestasi' => $tgl_akhir_verifikasi_prestasi . ' 17:00:00',
                'tgl_awal_analisis_prestasi' => $tgl_awal_analisis_prestasi . ' 00:00:00',
                'tgl_akhir_analisis_prestasi' => $tgl_akhir_analisis_prestasi . ' 23:59:00',
                'tgl_pengumuman_prestasi' => $tgl_pengumuman_prestasi . ' 00:00:01',
                'tgl_awal_daftar_ulang_prestasi' => $tgl_awal_daftar_ulang_prestasi . ' 07:00:00',
                'tgl_akhir_daftar_ulang_prestasi' => $tgl_akhir_daftar_ulang_prestasi . ' 15:00:00',
                'tgl_awal_pendaftaran_mutasi' => $tgl_awal_pendaftaran_mutasi . ' 07:00:00',
                'tgl_akhir_pendaftaran_mutasi' => $tgl_akhir_pendaftaran_mutasi . ' 15:00:00',
                'tgl_awal_verifikasi_mutasi' => $tgl_awal_verifikasi_mutasi . ' 07:00:00',
                'tgl_akhir_verifikasi_mutasi' => $tgl_akhir_verifikasi_mutasi . ' 17:00:00',
                'tgl_awal_analisis_mutasi' => $tgl_awal_analisis_mutasi . ' 00:00:00',
                'tgl_akhir_analisis_mutasi' => $tgl_akhir_analisis_mutasi . ' 23:59:00',
                'tgl_pengumuman_mutasi' => $tgl_pengumuman_mutasi . ' 00:00:01',
                'tgl_awal_daftar_ulang_mutasi' => $tgl_awal_daftar_ulang_mutasi . ' 07:00:00',
                'tgl_akhir_daftar_ulang_mutasi' => $tgl_akhir_daftar_ulang_mutasi . ' 15:00:00',
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('_setting_jadwal_tb')->where('id', $oldData->id)->update($data);
            } catch (\Exception $e) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal mengupdate data";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Data berhasil diupdate.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal mengupdate data";
                return json_encode($response);
            }
        }
    }
}
