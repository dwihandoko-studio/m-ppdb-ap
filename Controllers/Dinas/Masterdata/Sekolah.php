<?php

namespace App\Controllers\Dinas\Masterdata;

use App\Controllers\BaseController;
use App\Models\Dinas\Masterdata\SekolahModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;
use App\Libraries\Dinas\Riwayatlib;

class Sekolah extends BaseController
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
        $datamodel = new SekolahModel($request);
        if ($request->getMethod(true) == 'POST') {
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kec'), true) ?? "";
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

            $lists = $datamodel->get_datatables($filterKecamatan, $filterJenjang);
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
                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=' . $list->latitude . '%2C' . $list->longitude . '" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </a>
                            <!--<a href="javascript:actionDetail(\'' . $list->id . '\', \' ' . $list->nama . '\');" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </a>-->
                            <a href="javascript:actionEdit(\'' . $list->id . '\', \' ' . $list->nama . '\');" class="dropdown-item">
                                <i class="ni ni-ruler-pencil"></i>
                                <span>Edit</span>
                            </a>
                        </div>
                    </div>';

                if ((int)$list->status_sekolah == 1) {
                    $status = '<span class="badge badge-success">Negeri</span>';
                } else {
                    $status = '<span class="badge badge-danger">Swasta</span>';
                }

                $row[] = $no;
                $row[] = $action;
                $row[] = $list->npsn;
                $row[] = $list->nama;
                $row[] = $status;
                $row[] = $list->latitude;
                $row[] = $list->longitude;

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
        $data['title'] = 'Manage Referensi Sekolah';
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
        $data['jenjangs'] = $this->_db->table('ref_bentuk_pendidikan')
            ->whereIn('id', [5, 6])
            ->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/masterdata/sekolah/index', $data);
    }

    public function edit()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $id = htmlspecialchars($this->request->getVar('id'), true);

        $sekolah = $this->_db->table('ref_sekolah')->where('id', $id)->get()->getRowObject();

        if (!$sekolah) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Data tidak ditemukan.";
            return json_encode($response);
        }

        $x['data'] = $sekolah;

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('dinas/masterdata/sekolah/edit', $x);
        return json_encode($response);
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
            'latitude' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Latitude tidak boleh kosong. ',
                ]
            ],
            'longitude' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Longitude tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . $this->validator->getError('latitude') . $this->validator->getError('longitude');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $latitude = htmlspecialchars($this->request->getVar('latitude'), true);
            $longitude = htmlspecialchars($this->request->getVar('longitude'), true);

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
            $cekData = $this->_db->table('ref_sekolah')->where('id', $id)->get()->getRowObject();

            if (!$cekData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $this->_db->transBegin();

            $data = [
                'latitude' => $latitude,
                'longitude' => $longitude,
                // 'updated_at' => date('Y-m-d H:i:s')
            ];

            try {
                $this->_db->table('ref_sekolah')->where('id', $cekData->id)->update($data);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Mengubah titik koordinat ke $latitude - $longitude dari $cekData->latitude - $cekData->longitude untuk Sekolah $cekData->nama ($cekData->npsn)", "Mengedit Koordinat Sekolah", "update");
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
        }
    }
}
