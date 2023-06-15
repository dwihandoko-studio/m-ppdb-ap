<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotaModel;
use Config\Services;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;

class Pengaduan extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'cookie', 'session', 'array', 'imageurl', 'web', 'enskripdes', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        // var_dump($user);
        // die;
        if ($user->code == 200) {
            $data['user'] = $user->data;
        }

        $nisn = htmlspecialchars($this->request->getGet('nisn'), true);
        $npsn = htmlspecialchars($this->request->getGet('npsn'), true);

        if ($nisn !== "" && $npsn !== "") {
            $data['nisn'] = $nisn;
            $data['npsn'] = $npsn;
        }

        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/pengaduan', $data);
    }

    public function add()
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
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong. ',
                ]
            ],
            'tujuan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tujuan tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nohp')
                . $this->validator->getError('nama')
                . $this->validator->getError('deskripsi')
                . $this->validator->getError('tujuan');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $deskripsi = htmlspecialchars($this->request->getVar('deskripsi'), true);
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
            $tujuan = htmlspecialchars($this->request->getVar('tujuan'), true);

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'nama' => $nama,
                'no_hp' => $nohp,
                'deskripsi' => $deskripsi,
                'tujuan' => $tujuan,
                'nisn' => ($nisn == "-" || $nisn == "" || $nisn == NULL) ? NULL : $nisn,
                'npsn' => ($npsn == "-" || $npsn == "" || $npsn == NULL) ? NULL : $npsn,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('tb_pengaduan')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal mengirim pengaduan.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {

                $this->_db->transCommit();
                // try {
                //     $emailLib = new Emaillib();
                //     $emailLib->sendActivation($data['email']);
                // } catch (\Throwable $th) {
                // }

                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->redirrect = base_url('web/home');
                $response->message = "Pengaduan berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }
}
