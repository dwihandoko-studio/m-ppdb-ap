<?php

namespace App\Controllers\Dinas;

use App\Controllers\BaseController;
use App\Models\Dinas\PengaduanModel;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Libraries\Profilelib;
use App\Libraries\Emaillib;
use App\Libraries\Apilib;
use App\Libraries\Helplib;
// use App\Libraries\Situgu\NotificationLib;
use App\Libraries\Uuid;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Pengaduan extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;
    // private $_helpLib;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->_helpLib = new Helplib();
    }

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new PengaduanModel($request);

        $filterKlasifikasi = htmlspecialchars($request->getVar('filter_klasifikasi'), true) ?? "";
        $filterTujuan = htmlspecialchars($request->getVar('filter_tujuan'), true) ?? "";

        $lists = $datamodel->get_datatables($filterKlasifikasi, $filterTujuan);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            $action = '<a class="btn btn-primary btn-sm" href="' . base_url('dinas/pengaduan/detail?token=' . $list->id) . '">
                                <i class="ni ni-headphones"></i>
                                <span>DETAIL</span>
                            </a>';
            if ((int)$list->status === 2) {
                $status = '<span class="badge badge-success">Close</span>';
            } else {
                $status = '<span class="badge badge-danger">Open</span>';
            }
            $row[] = $action;
            $row[] = $list->nama;
            $row[] = $list->token;
            $row[] = $list->no_hp;
            $row[] = $status;

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            // "recordsTotal" => 0,
            // "recordsFiltered" => 0,
            "recordsTotal" => $datamodel->count_all($filterKlasifikasi, $filterTujuan),
            "recordsFiltered" => $datamodel->count_filtered($filterKlasifikasi, $filterTujuan),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function index()
    {
        return redirect()->to(base_url('dinas/pengaduan/data'));
    }

    public function data()
    {
        $data['title'] = 'DATA PENGADUAN';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        $data['user'] = $user->data;
        return view('dinas/pengaduan/index', $data);
    }

    public function detail()
    {
        $data['title'] = 'DETAIL PENGADUAN';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        $data['user'] = $user->data;

        $token = htmlspecialchars($this->request->getGet('token'), true);
        $aduan = $this->_db->table('tb_pengaduan')->where('id', $token)->get()->getRowObject();
        if (!$aduan) {
            return redirect()->to(base_url('dinas/pengaduan/data'));
        }

        $komentars = $this->_db->table('tb_pengaduan_komentar')->where('id_post', $token)->orderBy('created_at')->get()->getResult();
        if (count($komentars) > 0) {
            $data['komentars'] = $komentars;
        }
        $data['aduan'] = $aduan;
        return view('dinas/pengaduan/detail', $data);
    }


    public function balascomment()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id_post' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id post tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'komentar' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Komentar tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id_post')
                . $this->validator->getError('nama')
                . $this->validator->getError('komentar');
            return json_encode($response);
        } else {

            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $komentar = htmlspecialchars($this->request->getVar('komentar'), true);
            $id_post = htmlspecialchars($this->request->getVar('id_post'), true);

            $posted = $this->_db->table('tb_pengaduan')->where('id', $id_post)->get()->getRowObject();

            if (!$posted) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Aduan tidak ditemukan.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'id_post' => $id_post,
                'nama' => $nama,
                'komentar' => $komentar,
                'status' => 0,
                'is_admin' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            if ($posted->status == 0) {
                $this->_db->table('tb_pengaduan')->where('id', $posted->id)->update([
                    'status' => 1,
                    'updated_at' => $data['created_at'],
                ]);
            }

            try {
                $this->_db->table('tb_pengaduan_komentar')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal mengirim balasan komentar.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {


                $this->_db->transCommit();
                $response = new \stdClass;
                try {
                    $emailLib = new Emaillib();
                    $emailLib->sendNotificationKomentar($posted->email, $posted->token, $posted->no_hp, $komentar);
                } catch (\Throwable $th) {
                    $response->error = $th;
                }

                $response->code = 200;
                $response->data = $data;
                $jumlahKomentar = $this->_db->table('tb_pengaduan_komentar')->where('id_post', $id_post)->countAllResults();
                $response->replayed = (string)$jumlahKomentar;
                $response->message = "balasan omentar berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal membalas komentar.";
                return json_encode($response);
            }
        }
    }

    public function close()
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

            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->status = 401;
                $response->message = "Permintaan diizinkan";
                return json_encode($response);
            }

            $current = $this->_db->table('tb_pengaduan')
                ->where('id', $id)
                ->get()->getRowObject();

            if ($current) {

                $this->_db->transBegin();
                try {
                    $this->_db->table('tb_pengaduan')->where('id', $current->id)->update([
                        'status' => 2,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->error = var_dump($th);
                    $response->message = "Aduan gagal ditutup.";
                    return json_encode($response);
                }

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Data aduan berhasil ditutup.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Data aduan gagal ditutup.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }
        }
    }
}
