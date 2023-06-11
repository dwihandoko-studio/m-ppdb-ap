<?php

namespace App\Controllers\Peserta\Pendaftaran;

use App\Controllers\BaseController;
use App\Libraries\Peserta\Datalib;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Peserta\Riwayatlib;
use Firebase\JWT\JWT;

class Prestasi extends BaseController
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
        $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();

        if (!$getCurrentUser) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }

        $keyword = htmlspecialchars($this->request->getVar('keyword'), true) ?? "";
        $page = htmlspecialchars($this->request->getVar('page'), true);

        $limit_per_page = 10;

        if ((int)$page == 0 || (int)$page == 1) {
            $page = 1;
            $start = 0;
        } else {
            $page = (int)$page;
            $start = (($page - 1) * $limit_per_page);
        }
        $dataCurrentUser = json_decode($getCurrentUser->details);
        // $andWhere = "a.jumlah_rombel_kebutuhan > 0";
        $andWhere = "a.status_sekolah = '1'";

        if ((int)$dataCurrentUser->tingkat_pendidikan == 6) {
            $andWhere .= " AND (a.bentuk_pendidikan_id IN (6,10,31,32,33,35,36))";
        } else {
            $andWhere .= " AND (a.bentuk_pendidikan_id IN (5,9,30,31,32,33,38))";
        }

        $where = "$andWhere";

        if ($keyword !== "") {
            $where .= " AND (a.npsn = '$keyword' OR a.nama LIKE '%$keyword%')";
        }

        $data['result'] = $this->_db->table('v_tb_sekolah_kuota a')
            // $data['result'] = $this->_db->table('ref_provinsi a')
            //         //RUMUS JARAK (111.111 *
            // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
            //      * COS(RADIANS(b.Latitude))
            //      * COS(RADIANS(a.Longitude - b.Longitude))
            //      + SIN(RADIANS(a.Latitude))
            //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
            // ->select("b.*, c.nama as nama_jenjang_pendidikan, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, ")
            // ->join('ref_sekolah b', 'a.sekolah_id = b.id')
            // ->join('ref_bentuk_pendidikan c', 'a.bentuk_pendidikan_id = c.id')
            // ->join('ref_kecamatan f', 'b.kode_wilayah = f.id')
            // ->join('ref_kabupaten e', 'f.id_kabupaten = e.id')
            // ->join('ref_provinsi d', 'e.id_provinsi = d.id')
            ->where($where)
            ->orderBy('a.created_at', 'asc')
            ->limit($limit_per_page, $start)
            ->get()->getResult();
        $data['countData'] = $this->_db->table('v_tb_sekolah_kuota a')->where($where)->countAllResults();
        // $data['countData'] = $this->_db->table('ref_provinsi a')->where($where)->countAllResults();
        $data['page'] = $page;
        $data['user'] = $getCurrentUser;
        $data['totalPage'] = ($data['countData'] > 0) ? ceil($data['countData'] / $limit_per_page) : 0;
        $data['keyword'] = $keyword;

        if ($data['countData'] > 0) {
            if (count($data['result']) > 0) {
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('peserta/pendaftaran/prestasi/pilihan-zonasi', $data);
                $response->pagination = view('peserta/pendaftaran/prestasi/pilihan-pagination', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 204;
                $response->message = "Tidak ada data.";
                return json_encode($response);
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }
    }

    public function index()
    {
        $data['title'] = 'DAFTAR JALUR PRESTASI';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("PRESTASI");

        if ($canDaftar->code !== 200) {
            $data['error'] = $canDaftar->message;
        }

        $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $user->data->peserta_didik_id)->get()->getRowObject();
        if ($cekRegisterApprove) {
            $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
            $data['sekolah_pilihan'] = $cekRegisterApprove;
        }

        $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $user->data->peserta_didik_id)->get()->getRowObject();

        if ($cekRegisterTemp) {
            $data['error'] = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas.";
            $data['sekolah_pilihan'] = $cekRegisterTemp;
        }

        return view('peserta/pendaftaran/prestasi/index', $data);
    }

    public function aksidaftar()
    {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Proses pendaftaran peserta dari web masih dalam proses perbaikan. Silahkan gunakan versi android.";
        // return json_encode($response);
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister("PRESTASI");

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'name' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Name tidak boleh kosong. ',
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
            $response->message = $this->validator->getError('name') . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $name = htmlspecialchars($this->request->getVar('name'), true);
            $id = htmlspecialchars($this->request->getVar('id'), true);

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

            $peserta = $this->_db->table('_users_profil_tb a')
                ->select("a.*, b.lampiran_akta_kelahiran, b.lampiran_kk, b.lampiran_lulus, b.lampiran_afirmasi, b.lampiran_prestasi, b.lampiran_mutasi, b.lampiran_lainnya")
                ->join('_upload_kelengkapan_berkas b', 'a.id = b.user_id', 'LEFT')
                ->where('a.id', $user->data->id)
                ->get()->getRowObject();
            if (!$peserta) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data anda belum lengkap, silahkan lengkapi data terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_akta_kelahiran == null || $peserta->lampiran_kk == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran dokumen Akta dan Kartu Keluarga terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_lulus == null) {
                if (substr($user->data->nisn, 0, 2) == "BS") {
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran surat keterangan lulus (sertifikat kelulusan) terlebih dahulu.";
                    return json_encode($response);
                }
            }

            if ($peserta->lampiran_prestasi == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen prestasi anda belum lengkap, silahkan lengkapi lampiran dokumen prestasi terlebih dahulu.";
                return json_encode($response);
            }

            $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();
            if ($cekRegisterApprove) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                return json_encode($response);
            }

            $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();

            if ($cekRegisterTemp) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas. Silahkan menggunakan tombol batal pendaftaran pada menu riwayat / aktifitas.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                // 'kode_pendaftaran' => createKodePendaftaran("PRESTASI", $peserta->nisn),
                'peserta_didik_id' => $peserta->peserta_didik_id,
                'user_id' => $user->data->id,
                'from_sekolah_id' => $peserta->sekolah_asal,
                'tujuan_sekolah_id_1' => $id,
                'via_jalur' => "PRESTASI",
                'status_pendaftaran' => 0,
                'lampiran' => null,
                'keterangan' => null,
                'pendaftar' => 'SISWA',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar_temp')->insert($data);
            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                try {
                    $riwayatLib = new Riwayatlib();
                    $riwayatLib->insert("Mendaftar via Jalur Prestasi, untuk diverifikasi berkas oleh sekolah tujuan.", "Daftar Jalur Prestasi");
                } catch (\Throwable $th) {
                }
                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->message = "Pendaftaran via jalur Prestasi berhasil dilakukan.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pendaftaran via jalur Prestasi gagal dilakukan.";
                return json_encode($response);
            }
        }
    }
}
