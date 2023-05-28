<?php

namespace App\Controllers\Sekolah\Rekap;

use App\Controllers\BaseController;
use App\Models\Sekolah\Rekap\DiverifikasiModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Sekolah\Riwayatlib;
use Firebase\JWT\JWT;

class Diverifikasi extends BaseController
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
        $datamodel = new DiverifikasiModel($request);

        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    if ($request->getMethod(true) == 'POST') {
                        $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
                        $filterKelurahan = htmlspecialchars($request->getVar('filter_kelurahan'), true) ?? "";

                        $lists = $datamodel->get_datatables($filterKecamatan, $filterKelurahan, $userId);
                        // $lists = [];
                        $data = [];
                        $no = $request->getPost("start");
                        foreach ($lists as $list) {
                            $no++;
                            $row = [];

                            $row[] = $no;
                            // if($hakAksesMenu) {
                            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
                            $action = '
                            <button onclick="actionDetail(\'' . $list->id_pendaftaran . '\')" type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>';
                            $row[] = $action;

                            $row[] = $list->fullname;
                            $row[] = $list->nisn;
                            $row[] = $list->kode_pendaftaran;
                            $row[] = $list->via_jalur;
                            $row[] = $list->nama_sekolah_asal;
                            $row[] = ($list->npsn_sekolah_asal == '10000001') ? '-' : $list->npsn_sekolah_asal;

                            $data[] = $row;
                        }
                        $output = [
                            "draw" => $request->getPost('draw'),
                            // "recordsTotal" => 0,
                            // "recordsFiltered" => 0,
                            "recordsTotal" => $datamodel->count_all($filterKecamatan, $filterKelurahan, $userId),
                            "recordsFiltered" => $datamodel->count_filtered($filterKecamatan, $filterKelurahan, $userId),
                            "data" => $data
                        ];
                        echo json_encode($output);
                    }
                } else {
                    $output = [
                        "draw" => "1",
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => []
                    ];
                    echo json_encode($output);
                }
            } catch (\Exception $e) {
                $output = [
                    "draw" => "1",
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => []
                ];
                echo json_encode($output);
            }
        } else {
            $output = [
                "draw" => "1",
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Rekapitulasi Diverifikasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('sekolah/rekap/diverifikasi/index', $data);
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

            $oldData = $this->_db->table('_tb_pendaftar a')
                ->select("b.*, k.lampiran_kk, k.lampiran_lulus, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
                ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
                ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
                ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
                ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
                ->join('ref_dusun h', 'b.dusun = h.id', 'LEFT')
                ->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT')
                ->where('a.id', $id)
                ->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $data['data'] = $oldData;

            $response = new \stdClass;
            $response->code = 200;
            $response->result = $oldData;
            $response->data = view('sekolah/rekap/diverifikasi/detail', $data);
            $response->message = "Data ditemukan.";
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
        
        $id = htmlspecialchars($this->request->getVar('id'), true);
        
        $users = $this->_db->table('_users_profil_tb')->where('id', $id)->get()->getRowObject();
        
        if(!$users) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Data tidak ditemukan.";
            return json_encode($response);
        }
        
        $x['data'] = $users;

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('sekolah/rekap/diverifikasi/ubahdata', $x);
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

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        
                        $cekData = $this->_db->table('_users_profil_tb')->where('id', $id)->get()->getRowObject();

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
                            'updated_at' => date('Y-m-d H:i:s')
                        ];

                        try {
                            $this->_db->table('_users_profil_tb')->where('id', $cekData->id)->update($data);
                            if ($this->_db->affectedRows() > 0) {
                                $this->_db->transCommit();
                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Mengubah titik koordinat ke $latitude - $longitude dari $cekData->latitude - $cekData->longitude untuk Peserta $cekData->fullname ($cekData->nisn)", "Mengedit Koordinat Peserta", "update");
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
