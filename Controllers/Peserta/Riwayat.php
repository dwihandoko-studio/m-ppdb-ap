<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Libraries\Peserta\Datalib;
use App\Libraries\Profilelib;
use App\Libraries\Peserta\Riwayatlib;
use Firebase\JWT\JWT;

class Riwayat extends BaseController
{
    var $folderImage = 'user';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function pendaftaran()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;
        $userId = $user->data->id;
        $pendaftaran = $this->_db->table('_tb_pendaftar a')
            ->select("a.*, b.fullname")
            ->join('_users_profil_tb b', 'a.admin_approval = b.id', 'LEFT')
            ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")
            ->orderBy('a.created_at', 'desc')
            ->limit(1)
            ->get()->getRowObject();
        if (!$pendaftaran) {
            $pendaftaran = $this->_db->table('_tb_pendaftar_temp a')
                ->select("a.*, b.fullname")
                ->join('_users_profil_tb b', 'a.admin_approval = b.id', 'LEFT')
                ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")
                ->orderBy('a.created_at', 'desc')
                ->limit(1)
                ->get()->getRowObject();

            if (!$pendaftaran) {
                $pendaftaran = $this->_db->table('_tb_pendaftar_tolak a')
                    ->select("a.*, b.fullname")
                    ->join('_users_profil_tb b', 'a.admin_approval = b.id', 'LEFT')
                    ->where("a.peserta_didik_id = (SELECT peserta_didik_id FROM _users_profil_tb WHERE id = '$userId')")
                    ->orderBy('a.created_at', 'desc')
                    ->limit(1)
                    ->get()->getRowObject();
            }
        }
        $data['pendaftaran'] = $pendaftaran;

        return view('peserta/riwayat/pendaftaran', $data);
    }

    public function aktifitas()
    {
        $data['title'] = 'RIWAYAT AKTIFITAS';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        return view('peserta/riwayat/aktifitas', $data);
    }

    public function getAllAktifitas()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

                    if (!$getCurrentUser) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Tidak ada data.";
                        return json_encode($response);
                    }

                    $keyword = htmlspecialchars($this->request->getVar('keyword'), true) ?? "";
                    $page = htmlspecialchars($this->request->getVar('page'), true);

                    $riwayatLib = new Riwayatlib();
                    $dataResult = $riwayatLib->getAll($userId, $page, $keyword);

                    if ($dataResult['countData'] > 0) {
                        if (count($dataResult['result']) > 0) {
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = "Permintaan diizinkan";
                            $response->data = view('peserta/riwayat/content-aktifitas', $dataResult);
                            $response->pagination = view('peserta/riwayat/content-pagination', $dataResult);
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

    public function aksibatal()
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
            'kode' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kode tidak boleh kosong. ',
                ]
            ],
            'jalur' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jalur tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . $this->validator->getError('kode') . $this->validator->getError('jalur');
            return json_encode($response);
        } else {
            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session anda telah habis. Silahkan login ulang ke aplikasi.";
                return json_encode($response);
            }

            $id = htmlspecialchars($this->request->getVar('id'), true);
            $kode = htmlspecialchars($this->request->getVar('kode'), true);
            $jalur = htmlspecialchars($this->request->getVar('jalur'), true);

            $dataLib = new Datalib();
            $canDaftar = $dataLib->canRegister(strtoupper($jalur));

            if ($canDaftar->code !== 200) {
                return json_encode($canDaftar);
            }

            $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp a')
                ->where('a.id', $id)->get()->getRowArray();

            if (!($cekRegisterTemp)) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }

            $cekRegisterTemp['updated_at'] = date('Y-m-d H:i:s');
            $cekRegisterTemp['admin_approval'] = session()->get('userId');
            $cekRegisterTemp['keterangan_penolakan'] = "Dibatalkan oleh pendaftar";
            $cekRegisterTemp['status_pendaftaran'] = 0;
            $cekRegisterTemp['batal_pendaftar'] = 1;

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar_tolak')->insert($cekRegisterTemp);
            if ($this->_db->affectedRows() > 0) {
                $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Membatalkan pendaftaran dengan No Pendaftaran : " . $cekRegisterTemp['kode_pendaftaran'], "Batal Daftar Jalur " . $cekRegisterTemp['via_jalur'], "batal");
                    } catch (\Throwable $th) {
                    }
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Pendaftaran berhasil dibatalkan";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Pendaftaran gagal dibatalkan.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pendaftaran gagal dibatalkan.";
                return json_encode($response);
            }
        }
    }

    public function cetakpendaftaran()
    {
        if ($this->request->getMethod() != 'get') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return view('404', ['data' => "Session anda telah expired. Silahkan melakukan Login ulang."]);
        }

        // $rules = [
        //     'id' => [
        //         'rules' => 'required|trim',
        //         'errors' => [
        //             'required' => 'Id tidak boleh kosong. ',
        //         ]
        //     ],
        //     'kode' => [
        //         'rules' => 'required|trim',
        //         'errors' => [
        //             'required' => 'Kode tidak boleh kosong. ',
        //         ]
        //     ],
        //     'jalur' => [
        //         'rules' => 'required|trim',
        //         'errors' => [
        //             'required' => 'Jalur tidak boleh kosong. ',
        //         ]
        //     ],
        // ];

        // if (!$this->validate($rules)) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = $this->validator->getError('id') . $this->validator->getError('kode') . $this->validator->getError('jalur');
        //     return json_encode($response);
        // } else {
        // $id = htmlspecialchars($this->request->getGet('id'), true);
        // $kode = htmlspecialchars($this->request->getGet('kode'), true);
        // $jalur = htmlspecialchars($this->request->getGet('jalur'), true);

        // $select = "a.*, b.fullname, b.details, c.nama as namaSekolahAsal, c.npsn as npsnSekolahAsal, d.nama as namaSekolahTujuan, d.npsn as npsnSekolahTujuan";
        // $currentApprove = $this->_db->table('_tb_pendaftar a')
        //     ->select($select)
        //     ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
        //     ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
        //     ->join('ref_sekolah d', 'a.tujuan_sekolah_id = d.id', 'LEFT')
        //     ->where('a.id', $id)->get()->getRowObject();

        // if ($currentApprove) {
        //     $pendaftaran = $currentApprove;
        // } else {
        //     $pendaftaran = $this->_db->table('_tb_pendaftar_temp a')
        //         ->select($select)
        //         ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
        //         ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
        //         ->join('ref_sekolah d', 'a.tujuan_sekolah_id = d.id', 'LEFT')
        //         ->where('a.id', $id)->get()->getRowObject();
        // }

        // var_dump($pendaftaran);
        // die;
        // ->select("*, , ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak")

        $currentApprove = $this->_db->query("SELECT 
		b.id AS id,
		b.fullname AS fullname,
		b.email AS email,
		b.nip AS nip,
		b.no_hp AS no_hp,
		b.jenis_kelamin AS jenis_kelamin,
		b.jabatan AS jabatan,
		b.npsn AS npsn,
		b.provinsi AS provinsi,
		b.kabupaten AS kabupaten,
		b.kelurahan AS kelurahan,
		b.dusun AS dusun,
		b.alamat AS alamat,
		b.kecamatan AS kecamatan,
		b.surat_tugas AS surat_tugas,
		b.profile_picture AS profile_picture,
		b.role_user AS role_user,
		b.sekolah_asal AS sekolah_asal,
		b.npsn_asal AS npsn_asal,
		b.peserta_didik_id AS peserta_didik_id,
		b.nisn AS nisn,
		b.latitude AS latitude,
		b.longitude AS longitude,
		b.sekolah_id AS sekolah_id,
		b.details AS details,
		b.last_active AS last_active,
		b.created_at AS created_at,
		b.updated_at AS updated_at,
		a.id AS id_pendaftaran,
		a.keterangan_penolakan AS keterangan_penolakan,
		a.created_at AS waktu_pendaftaran,
		a.update_reject AS waktu_penolakan,
		a.updated_aproval AS waktu_verifikasi,
		a.updated_at AS waktu_update,
		a.from_sekolah_id AS from_sekolah_id,
		a.tujuan_sekolah_id_1 AS tujuan_sekolah_id_1,
		a.status_pendaftaran AS status_pendaftaran,
		a.pendaftar AS pendaftar,
		a.has_daftar_ulang AS has_daftar_ulang,
		a.has_download AS has_download,
		a.has_upload AS has_upload,
		a.lampiran_daftar_ulang AS lampiran_daftar_ulang,
		a.updated_daftar_ulang AS updated_daftar_ulang,
		c.nama AS nama_sekolah_asal,
		c.npsn AS npsn_sekolah_asal,
		j.nama AS nama_sekolah_tujuan_1,
		j.npsn AS npsn_sekolah_tujuan_1,
		j.latitude AS latitude_sekolah_tujuan_1,
		j.longitude AS longitude_sekolah_tujuan_1,
		a.kode_pendaftaran AS kode_pendaftaran,
		a.via_jalur AS via_jalur,
		d.nama AS nama_provinsi,
		e.nama AS nama_kabupaten,
		f.nama AS nama_kecamatan,
		g.nama AS nama_kelurahan,
		h.nama AS nama_dusun,
		i.nama AS nama_bentuk_pendidikan,
		k.lampiran_akta_kelahiran AS lampiran_akta_kelahiran,
		k.lampiran_kk AS lampiran_kk,
		k.lampiran_lulus AS lampiran_lulus,
		k.lampiran_prestasi AS lampiran_prestasi,
		k.lampiran_mutasi AS lampiran_mutasi,
		k.lampiran_afirmasi AS lampiran_afirmasi,
		k.lampiran_pernyataan AS lampiran_pernyataan,
		k.lampiran_lainnya AS lampiran_lainnya
	FROM
		(
			(SELECT * FROM _tb_pendaftar_temp WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar_tolak WHERE peserta_didik_id = '{$user->data->peserta_didik_id}')
		) AS a
	LEFT JOIN _users_profil_tb b ON (a.peserta_didik_id = b.peserta_didik_id)
	LEFT JOIN ref_sekolah c ON (a.from_sekolah_id = c.id)
	LEFT JOIN ref_sekolah j ON (a.tujuan_sekolah_id_1 = j.id)
	LEFT JOIN ref_sekolah l ON (a.tujuan_sekolah_id_2 = l.id)
	LEFT JOIN ref_sekolah m ON (a.tujuan_sekolah_id_3 = m.id)
	LEFT JOIN ref_bentuk_pendidikan i ON (c.bentuk_pendidikan_id = i.id)
	LEFT JOIN ref_provinsi d ON (b.provinsi = d.id)
	LEFT JOIN ref_kabupaten e ON (b.kabupaten = e.id)
	LEFT JOIN ref_kecamatan f ON (b.kecamatan = f.id)
	LEFT JOIN ref_kelurahan g ON (b.kelurahan = g.id)
	LEFT JOIN ref_dusun h ON (b.dusun = h.id)
	LEFT JOIN _upload_kelengkapan_berkas k ON (b.id = k.user_id)
	ORDER BY created_at DESC
	LIMIT 1")->getRow();

        // $currentApprove = $this->_db->table('v_tb_pendaftar')->where('peserta_didik_id', $user->data->peserta_didik_id)->orderBy('waktu_pendaftaran', 'DESC')->limit(1)->get()->getRowObject();
        // if ($currentApprove) {
        //     $pendaftaran = $currentApprove;
        // } else {
        //     $pendaftaran = $this->_db->table('v_tb_pendaftar_temp')->where('peserta_didik_id', $user->data->peserta_didik_id)->orderBy('waktu_pendaftaran', 'DESC')->limit(1)->get()->getRowObject();
        // }

        // if ($pendaftaran) {
        if ($currentApprove) {
            $data['data'] = $currentApprove;
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = view('peserta/riwayat/cetak-pendaftaran', $data);
            return json_encode($response);
        } else {
            return view('404', ['data' => "Data tidak ditemukan."]);
        }
        // }
    }
}
