<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Models\Sekolah\KonfirmasiModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Sekolah\Riwayatlib;
use App\Libraries\Notificationlib;
use App\Libraries\Fcmlib;
use Firebase\JWT\JWT;

class Konfirmasi extends BaseController
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
        $datamodel = new KonfirmasiModel($request);

        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    if ($request->getMethod(true) == 'POST') {

                        $lists = $datamodel->get_datatables($userId);
                        // $lists = [];
                        $data = [];
                        $no = $request->getPost("start");
                        foreach ($lists as $list) {
                            $no++;
                            $row = [];

                            $row[] = '';
                            // if($hakAksesMenu) {
                            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
                            
                            if((int)$list->has_daftar_ulang === 1) {
                                $row[] = '<span class="badge badge-success">Sudah Konfirmasi</span>';
                            } else {
                                $action = '
                                <button onclick="actionKonfirmasi(\'' . $list->id_pendaftaran . '\',\'' . str_replace("&#039;","`",str_replace("'","`",$list->fullname)) . ' - ' . $list->nisn . '\')" type="button" class="btn btn-warning btn-sm">
                                    <i class="ni ni-check-bold"></i>
                                    <span>Konfirmasikan</span>
                                </button>';
                            $row[] = $action;
                            }

                            // $row[] = '';
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
                            "recordsTotal" => $datamodel->count_all($userId),
                            "recordsFiltered" => $datamodel->count_filtered($userId),
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

        return view('sekolah/konfirmasi/index', $data);
    }
    
    
    public function aksiverifikasi()
    {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Tunggu sampai jadwal pengumuman.";
        // return json_encode($response);
        
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
                    'required' => 'Nama tidak boleh kosong. ',
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

            $oldData = $this->_db->table('_tb_pendaftar a')
                // ->select("b.*, k.lampiran_kk, k.lampiran_lulus, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
                // ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                // ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                // ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                // ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
                // ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
                // ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
                // ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
                // ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
                // ->join('ref_dusun h', 'b.dusun = h.id', 'LEFT')
                // ->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT')
                ->where('a.id', $id)
                ->where('a.id', $id)
                ->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        
                        $this->_db->transBegin();
                        $this->_db->table('_tb_pendaftar')->where('id', $oldData->id)->update(['has_daftar_ulang' => 1, 'has_download' => 1, 'updated_daftar_ulang' => date('Y-m-d H:i:s')]);
                        if ($this->_db->affectedRows() > 0) {
                            
                            $riwayatLib = new Riwayatlib();
                            $riwayatLib->insert("Mengkonfirmasikan Daftar Ulang $name.", "Mengkonfirmasikan Daftar Ulang", "submit");
                            
                            $saveNotifSystem = new Notificationlib();
                            $saveNotifSystem->send([
                                'judul' => "Konfirmasi Daftar Ulang.",
                                'isi' => "Konfirmasi Daftar Ulang anda telah dilakukan oleh Panitia PPDB Sekolah, Silahkan Konfirmasi ke Sekolah.",
                                'action_web' => 'peserta/riwayat/konfirmasi',
                                'action_app' => 'daftar_ulang_page',
                                'token' => $oldData->kode_pendaftaran,
                                'send_from' => $userId,
                                'send_to' => $oldData->user_id,
                            ]);
            
                            $onesignal = new Fcmlib();
                            $send = $onesignal->pushNotifToUser([
                                'title' => "Konfirmasi Daftar Ulang.",
                                'content' => "Konfirmasi Daftar Ulang anda telah dilakukan oleh Panitia PPDB Sekolah, Silahkan Konfirmasi ke Sekolah.",
                                'send_to' => $oldData->user_id,
                                'app_url' => 'daftar_ulang_page',
                            ]);
                                
                            $this->_db->transCommit();
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = "Konfirmasi daftar ulang $name berhasil dilakukan.";
                            return json_encode($response);
                        } else {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal Konfirmasi daftar ulang peserta. $name";
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
