<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;

class Referensi extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }


    public function getKabupaten()
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

            $data = $this->_db->table('ref_kabupaten')->where('id_provinsi', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getKecamatan()
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

            $data = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getKelurahan()
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

            $data = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getDusun()
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

            $data = $this->_db->table('ref_dusun')->orderBy('urut', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getSekolah()
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

            $data = $this->_db->table('ref_sekolah')->where('kode_wilayah', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }
}
