<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotaModel;
use App\Models\Web\ZonasiModel;

use App\Models\Web\RekapModel;
use Config\Services;
use App\Libraries\Profilelib;

use App\Models\Dinas\Analisis\ProsesModel;
use App\Models\Dinas\Analisis\ProsessekolahModel;
use App\Models\Dinas\Analisis\ProsessekolahprosesModel;


class Zona extends BaseController
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

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();
        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/zona', $data);
    }

    public function getZonasiSekolah()
    {
        $request = Services::request();
        $datamodel = new ZonasiModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";

            $lists = $datamodel->get_datatables($filterJenjang, $filterKecamatan);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row['no'] = $no;
                $row['button'] = '<button type="button" onclick="actionDetailZonasi(\'' . $list->id . '\', \'' . $list->npsn . '\');" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                $row['id'] = $list->id;
                $row['npsn'] = $list->npsn;
                $row['nama'] = $list->nama;
                $row['jumlah'] = $list->jumlah . ' Wilayah';
                // $row['datazonasi'] = zonasiDetailWeb($list->npsn);

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

    public function getDetailZonasi()
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
                    'required' => 'Name tidak boleh kosong. ',
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

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Data ditemukan.";
            $response->data = zonasiDetailWebNew($name);
            return json_encode($response);
        }
    }
}
