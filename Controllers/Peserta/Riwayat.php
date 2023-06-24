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

    // public function aksibatal()
    // {
    //     if ($this->request->getMethod() != 'post') {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Permintaan tidak diizinkan";
    //         return json_encode($response);
    //     }

    //     $rules = [
    //         'id' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Id tidak boleh kosong. ',
    //             ]
    //         ],
    //         'kode' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Kode tidak boleh kosong. ',
    //             ]
    //         ],
    //         'jalur' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Jalur tidak boleh kosong. ',
    //             ]
    //         ],
    //     ];

    //     if (!$this->validate($rules)) {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = $this->validator->getError('id') . $this->validator->getError('kode') . $this->validator->getError('jalur');
    //         return json_encode($response);
    //     } else {
    //         $Profilelib = new Profilelib();
    //         $user = $Profilelib->user();
    //         if ($user->code != 200) {
    //             delete_cookie('jwt');
    //             session()->destroy();
    //             $response = new \stdClass;
    //             $response->code = 401;
    //             $response->message = "Session anda telah habis. Silahkan login ulang ke aplikasi.";
    //             return json_encode($response);
    //         }

    //         $id = htmlspecialchars($this->request->getVar('id'), true);
    //         $kode = htmlspecialchars($this->request->getVar('kode'), true);
    //         $jalur = htmlspecialchars($this->request->getVar('jalur'), true);

    //         $dataLib = new Datalib();
    //         $canDaftar = $dataLib->canRegister(strtoupper($jalur));

    //         if ($canDaftar->code !== 200) {
    //             return json_encode($canDaftar);
    //         }

    //         $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp a')
    //             ->where('a.id', $id)->get()->getRowArray();

    //         if (!($cekRegisterTemp)) {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Data tidak ditemukan";
    //             return json_encode($response);
    //         }

    //         $cekRegisterTemp['updated_at'] = date('Y-m-d H:i:s');
    //         $cekRegisterTemp['admin_approval'] = session()->get('userId');
    //         $cekRegisterTemp['keterangan_penolakan'] = "Dibatalkan oleh pendaftar";
    //         $cekRegisterTemp['status_pendaftaran'] = 0;
    //         $cekRegisterTemp['batal_pendaftar'] = 1;

    //         $this->_db->transBegin();
    //         $this->_db->table('_tb_pendaftar_tolak')->insert($cekRegisterTemp);
    //         if ($this->_db->affectedRows() > 0) {
    //             $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();

    //             if ($this->_db->affectedRows() > 0) {
    //                 $this->_db->transCommit();
    //                 try {
    //                     $riwayatLib = new Riwayatlib();
    //                     $riwayatLib->insert("Membatalkan pendaftaran dengan No Pendaftaran : " . $cekRegisterTemp['kode_pendaftaran'], "Batal Daftar Jalur " . $cekRegisterTemp['via_jalur'], "batal");
    //                 } catch (\Throwable $th) {
    //                 }
    //                 $response = new \stdClass;
    //                 $response->code = 200;
    //                 $response->message = "Pendaftaran berhasil dibatalkan";
    //                 return json_encode($response);
    //             } else {
    //                 $this->_db->transRollback();
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Pendaftaran gagal dibatalkan.";
    //                 return json_encode($response);
    //             }
    //         } else {
    //             $this->_db->transRollback();
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Pendaftaran gagal dibatalkan.";
    //             return json_encode($response);
    //         }
    //     }
    // }

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

        $currentApprove = $this->_db->table('v_tb_pendaftar')->where('peserta_didik_id', $user->data->peserta_didik_id)->orderBy('waktu_pendaftaran', 'DESC')->limit(1)->get()->getRowObject();
        if ($currentApprove) {
            $pendaftaran = $currentApprove;
        } else {
            $pendaftaran = $this->_db->table('v_tb_pendaftar_temp')->where('peserta_didik_id', $user->data->peserta_didik_id)->orderBy('waktu_pendaftaran', 'DESC')->limit(1)->get()->getRowObject();
        }

        if ($pendaftaran) {
            $data['data'] = $pendaftaran;
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
