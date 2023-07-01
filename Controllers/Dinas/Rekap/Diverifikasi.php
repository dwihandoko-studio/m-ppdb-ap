<?php

namespace App\Controllers\Dinas\Rekap;

use App\Controllers\BaseController;
use App\Models\Dinas\Rekap\DiverifikasiModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Updatedatalib;
use App\Libraries\Notificationlib;
use App\Libraries\Fcmlib;
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


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";
        $filterSekolah = htmlspecialchars($request->getVar('filter_sekolah'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang, $filterJalur, $filterSekolah);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            // if($hakAksesMenu) {
            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
            $action = '<div class="dropup">
                        <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                        </div>
                        <div class="dropdown-menu">
                            <button onclick="actionDetail(\'' . $list->id_pendaftaran . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>
                        </div>
                    </div>';
            $row[] = $action;

            $row[] = $list->fullname;
            $row[] = $list->nisn;
            $row[] = $list->kode_pendaftaran;
            $row[] = $list->via_jalur;
            $row[] = $list->nama_sekolah_tujuan . ' (' . $list->npsn_sekolah_tujuan . ')';
            // $row[] = $list->nama_sekolah_asal;
            // $row[] = ($list->npsn_sekolah_asal == '10000001') ? '-' : $list->npsn_sekolah_asal;
            // $row[] = $list->jarak . ' Km';

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            // "recordsTotal" => 0,
            // "recordsFiltered" => 0,
            "recordsTotal" => $datamodel->count_all($filterJenjang, $filterJalur, $filterSekolah),
            "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterJalur, $filterSekolah),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function index()
    {
        $data['title'] = 'Rekapitulasi Diverifikasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/rekap/diverifikasi/index', $data);
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
                ->select("b.*, l.jenis_prestasi, l.tingkat_prestasi, l.juara_prestasi, l.peringkat_prestasi, l.akreditasi_prestasi, l.nilai_prestasi, l.nilai_akumulative, k.lampiran_akta_kelahiran, k.lampiran_foto_rumah, k.lampiran_kk, k.lampiran_lulus, k.lampiran_pernyataan, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id_1 = j.id', 'LEFT')
                ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
                ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
                ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
                ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
                ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
                ->join('ref_dusun h', 'b.dusun = h.id', 'LEFT')
                ->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT')
                ->join('tb_nilai_prestasi l', 'a.id = l.id', 'LEFT')
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
            $response->data = view('dinas/rekap/diverifikasi/detail', $data);
            $response->message = "Data ditemukan.";
            return json_encode($response);
        }
    }

    public function aksicabutberkas()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        // $dataLib = new Datalib();
        // $canDaftar = $dataLib->canRegister("AFIRMASI");

        // if ($canDaftar->code !== 200) {
        //     return json_encode($canDaftar);
        // }

        $rules = [
            'name' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Name tidak boleh kosong. ',
                ]
            ],
            'keterangan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Keterangan tidak boleh kosong. ',
                ]
            ],
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
            $response->message = $this->validator->getError('keterangan') . $this->validator->getError('name') . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $name = htmlspecialchars($this->request->getVar('name'), true);
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $keterangan = htmlspecialchars($this->request->getVar('keterangan'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $cekRegisterTemp = $this->_db->table('_tb_pendaftar')->where('id', $id)->get()->getRowArray();

                        if (!$cekRegisterTemp) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Data tidak ditemukan.";
                            return json_encode($response);
                        }

                        $cekRegisterTemp['updated_at'] = date('Y-m-d H:i:s');
                        $cekRegisterTemp['update_reject'] = date('Y-m-d H:i:s');
                        $cekRegisterTemp['admin_approval'] = $userId;
                        $cekRegisterTemp['keterangan_penolakan'] = $keterangan;
                        $cekRegisterTemp['status_pendaftaran'] = 3;

                        $this->_db->transBegin();
                        $this->_db->table('_tb_pendaftar_tolak')->insert($cekRegisterTemp);
                        if ($this->_db->affectedRows() > 0) {
                            $this->_db->table('_tb_pendaftar')->where('id', $cekRegisterTemp['id'])->delete();
                            if ($this->_db->affectedRows() > 0) {
                                $updatelockLib = new Updatedatalib();
                                $berhasil = $updatelockLib->unlockUpdate($cekRegisterTemp['user_id']);

                                try {
                                    $riwayatLib = new Riwayatlib();
                                    if ($cekRegisterTemp['via_jalur'] == "ZONASI") {
                                        $viaJalur = "Zonasi";
                                    } else if ($cekRegisterTemp['via_jalur'] == "AFIRMASI") {
                                        $viaJalur = "Afirmasi";
                                    } else if ($cekRegisterTemp['via_jalur'] == "MUTASI") {
                                        $viaJalur = "Mutasi";
                                    } else if ($cekRegisterTemp['via_jalur'] == "PRESTASI") {
                                        $viaJalur = "Mutasi";
                                    } else {
                                        $viaJalur = "Swasta";
                                    }
                                    $riwayatLib->insert("Mencabut Berkas Pendaftaran $name via Jalur $viaJalur dengan No Pendaftaran : " . $cekRegisterTemp['kode_pendaftaran'], "Cabut Berkas Pendaftaran Jalur $viaJalur", "tolak");

                                    $saveNotifSystem = new Notificationlib();
                                    $saveNotifSystem->send([
                                        'judul' => "Pendaftaran Jalur $viaJalur Dicabut Berkas.",
                                        'isi' => "Pendaftaran anda melalui jalur $viaJalur telah dicabut berkas dengan keterangan: $keterangan.",
                                        'action_web' => 'peserta/riwayat/pendaftaran',
                                        'action_app' => 'riwayat_pendaftaran_page',
                                        'token' => $cekRegisterTemp['kode_pendaftaran'],
                                        'send_from' => $userId,
                                        'send_to' => $cekRegisterTemp['user_id'],
                                    ]);

                                    $onesignal = new Fcmlib();
                                    $send = $onesignal->pushNotifToUser([
                                        'title' => "Pendaftaran Jalur $viaJalur Ditolak.",
                                        'content' => "Pendaftaran anda melalui jalur $viaJalur telah dicabut berkas dengan keterangan: $keterangan.",
                                        'send_to' => $cekRegisterTemp['user_id'],
                                        'app_url' => 'riwayat_pendaftaran_page',
                                    ]);
                                } catch (\Throwable $th) {
                                }
                                $this->_db->transCommit();
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Cabut Berkas Verifikasi pendaftaran $name berhasil dilakukan.";
                                return json_encode($response);
                            } else {
                                $this->_db->transRollback();
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Gagal mencabut berkas verifikasi status pendaftaran peserta. $name";
                                return json_encode($response);
                            }
                        } else {
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal mencabut berkas verifikasi pendaftaran peserta. $name";
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
