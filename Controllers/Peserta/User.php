<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Peserta\Riwayatlib;
use App\Libraries\Uuid;
use App\Libraries\Peserta\Datalib;
use Firebase\JWT\JWT;
// use App\Models\PtkModel;

class User extends BaseController
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

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;
        $data['details'] = json_decode($user->data->details);
        $data['title'] = 'Dashboard';
        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();
        $dataKabupaten = $this->_db->table('ref_kabupaten')->where('id_provinsi', $user->data->provinsi)->orderBy('nama', 'asc')->get()->getResult();
        if (count($dataKabupaten) > 0) {
            $data['kabupatens'] = $dataKabupaten;
        } else {
            $provinsi = substr(trim($data['details']->kode_wilayah), 0, 2) . '0000';
            $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $provinsi)->orderBy('nama', 'asc')->get()->getResult();
        }
        $dataKecamatan = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $user->data->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        if (count($dataKecamatan) > 0) {
            $data['kecamatans'] = $dataKecamatan;
        } else {
            $kabupaten = substr(trim($data['details']->kode_wilayah), 0, 4) . '00';
            $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        }
        $dataKelurahan = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $user->data->kecamatan)->orderBy('nama', 'asc')->get()->getResult();
        if (count($dataKelurahan) > 0) {
            $data['kelurahans'] = $dataKelurahan;
        } else {
            $kecamatan = substr(trim($data['details']->kode_wilayah), 0, 6);
            $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $kecamatan)->orderBy('nama', 'asc')->get()->getResult();
        }
        $data['dusuns'] = $this->_db->table('ref_dusun')->orderBy('urut', 'asc')->get()->getResult();
        if (isset($user->data->sekolah_asal)) {
            $data['sekolah'] = $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_asal)->get()->getRowObject();
        }
        $cekRegisterApprove = $this->_db->query("SELECT * FROM (
			(SELECT * FROM _tb_pendaftar_temp WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar_tolak WHERE peserta_didik_id = '{$user->data->peserta_didik_id}')
		) AS a ORDER BY a.created_at DESC LIMIT 1")->getRow();

        if ($cekRegisterApprove) {
            switch ((int)$cekRegisterApprove->status_pendaftaran) {
                case 1:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. <br/>Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    $data['can_daftar'] = false;
                    break;
                case 2:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['can_daftar'] = false;
                    $data['pendaft'] = $cekRegisterApprove;
                    $data['success'] = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.";
                    break;
                case 3:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    if ($cekRegisterApprove->via_jalur == "AFIRMASI") {
                        $data['can_daftar'] = true;
                        $data['pendaft'] = $cekRegisterApprove;
                        $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
                    } else {
                        $data['can_daftar'] = false;
                        $data['pendaft'] = $cekRegisterApprove;
                        $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                    }
                    break;

                default:
                    $data['error'] = "Anda sudah melakukan pendaftaran lewat jalur <b>'{$cekRegisterApprove->via_jalur}'</b> dan dalam status menunggu verifikasi berkas.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    break;
            }
        }

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('peserta/profile', $data);
    }

    public function profile()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        // var_dump($user->data);die;

        $data['user'] = $user->data;
        $data['details'] = json_decode($user->data->details);
        $data['title'] = 'Dashboard';
        $data['provinsis'] = $this->_db->table('ref_provinsi')->where("id != '350000'")->orderBy('nama', 'asc')->get()->getResult();
        $dataKabupaten = $this->_db->table('ref_kabupaten')->where('id_provinsi', $user->data->provinsi)->orderBy('nama', 'asc')->get()->getResult();
        if (count($dataKabupaten) > 0) {
            $data['kabupatens'] = $dataKabupaten;
        } else {
            $provinsi = substr(trim($data['details']->kode_wilayah), 0, 2) . '0000';
            $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $provinsi)->orderBy('nama', 'asc')->get()->getResult();
        }
        $dataKecamatan = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $user->data->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        if (count($dataKecamatan) > 0) {
            $data['kecamatans'] = $dataKecamatan;
        } else {
            $kabupaten = substr(trim($data['details']->kode_wilayah), 0, 4) . '00';
            $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        }
        $dataKelurahan = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $user->data->kecamatan)->orderBy('nama', 'asc')->get()->getResult();
        if (count($dataKelurahan) > 0) {
            $data['kelurahans'] = $dataKelurahan;
        } else {
            $kecamatan = substr(trim($data['details']->kode_wilayah), 0, 6);
            $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $kecamatan)->orderBy('nama', 'asc')->get()->getResult();
        }
        $data['dusuns'] = $this->_db->table('ref_dusun')->orderBy('urut', 'asc')->get()->getResult();
        if (isset($user->data->sekolah_asal)) {
            $data['sekolah'] = $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_asal)->get()->getRowObject();
        }

        // $cekRegisterApprove = $this->_db->query("SELECT * FROM (
        // 	(SELECT * FROM _tb_pendaftar_temp WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
        // 	UNION ALL 
        // 	(SELECT * FROM _tb_pendaftar WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
        // 	UNION ALL 
        // 	(SELECT * FROM _tb_pendaftar_tolak WHERE peserta_didik_id = '{$user->data->peserta_didik_id}')
        // ) AS a ORDER BY a.created_at DESC LIMIT 1")->getRow();

        // if ($cekRegisterApprove) {
        //     switch ((int)$cekRegisterApprove->status_pendaftaran) {
        //         case 1:
        //             $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. <br/>Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
        //             $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
        //             $data['pendaft'] = $cekRegisterApprove;
        //             $data['can_daftar'] = false;
        //             break;
        //         case 2:
        //             $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
        //             $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
        //             $data['can_daftar'] = false;
        //             $data['pendaft'] = $cekRegisterApprove;
        //             $data['success'] = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.";
        //             break;
        //         case 3:
        //             $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
        //             $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
        //             if ($cekRegisterApprove->via_jalur == "AFIRMASI") {
        //                 $data['can_daftar'] = true;
        //                 $data['pendaft'] = $cekRegisterApprove;
        //                 $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
        //             } else {
        //                 $data['can_daftar'] = false;
        //                 $data['pendaft'] = $cekRegisterApprove;
        //                 $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
        //             }
        //             break;

        //         default:
        //             $data['error'] = "Anda sudah melakukan pendaftaran lewat jalur <b>'{$cekRegisterApprove->via_jalur}'</b> dan dalam status menunggu verifikasi berkas.";
        //             $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
        //             $data['pendaft'] = $cekRegisterApprove;
        //             break;
        //     }
        // }

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('peserta/lengkapi-profile', $data);
    }

    public function location()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $data['lat'] = htmlspecialchars($this->request->getVar('lat'), true) ?? "";
        $data['long'] = htmlspecialchars($this->request->getVar('long'), true) ?? "";

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = view('peserta/pick-maps', $data);
        return json_encode($response);
    }

    public function gantiPassword()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'oldPassword' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password lama tidak boleh kosong.',
                    'min_length' => 'Panjang Password Lama minimal 6 karakter.',
                ]
            ],
            'newPassword' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password Baru tidak boleh kosong.',
                    'min_length' => 'Panjang Password Baru minimal 6 karakter.',
                ]
            ],
            'retypeNewPassword' => [
                'rules' => 'required|matches[newPassword]',
                'errors' => [
                    'required' => 'Ulangi Password Baru tidak boleh kosong.',
                    'matches' => 'Password Baru dan Ulangi Password Baru tidak sama.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('oldPassword')  . " " . $this->validator->getError('newPassword')  . " " . $this->validator->getError('retypeNewPassword');
            return json_encode($response);
        } else {
            $oldPassword = htmlspecialchars($this->request->getVar('oldPassword'), true);
            $newPassword = htmlspecialchars($this->request->getVar('newPassword'), true);

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
            $builder = $this->_db->table('_users_tb');
            $oldData = $builder->where('id', $user->data->id)->get()->getRowObject();
            if ($oldData) {
                if (password_verify($oldPassword, $oldData->password) == true) {
                    $this->_db->transBegin();
                    $builder->set(['password' => password_hash($newPassword, PASSWORD_DEFAULT), 'updated_at' => date('Y-m-d H:i:s')])->where('id', $oldData->id)->update();
                    $res = $this->_db->affectedRows();
                    if ($res > 0) {
                        $this->_db->transCommit();
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Update Password Baru Berhasil.";
                        $response->url = base_url('v1/ptk/home');
                        return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Update Password Baru Gagal.";
                        return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Password Lama Salah!!!";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Pengguna tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    public function saveprofil()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'provinsi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Provinsi tidak boleh kosong.',
                ]
            ],
            'kabupaten' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kabupaten tidak boleh kosong.',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong.',
                ]
            ],
            'kelurahan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan tidak boleh kosong.',
                ]
            ],
            'dusun' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Dusun tidak boleh kosong.',
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong.',
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong.',
                ]
            ],
            'latitude' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Latitude tidak boleh kosong.',
                ]
            ],
            'longitude' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Longitude tidak boleh kosong.',
                ]
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar, Maksimal 2048 Mb.',
                    'mime_in' => 'File yang anda upload harus type image.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('file')
                . $this->validator->getError('provinsi')
                . $this->validator->getError('kabupaten')
                . $this->validator->getError('kecamatan')
                . $this->validator->getError('kelurahan')
                . $this->validator->getError('dusun')
                . $this->validator->getError('email')
                . $this->validator->getError('nohp')
                .  $this->validator->getError('alamat')
                .  $this->validator->getError('latitude')
                .  $this->validator->getError('longitude');
            return json_encode($response);
        } else {
            $provinsi = htmlspecialchars($this->request->getVar('provinsi'), true);
            $kabupaten = htmlspecialchars($this->request->getVar('kabupaten'), true);
            $kecamatan = htmlspecialchars($this->request->getVar('kecamatan'), true);
            $kelurahan = htmlspecialchars($this->request->getVar('kelurahan'), true);
            $dusun = htmlspecialchars($this->request->getVar('dusun'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $alamat = htmlspecialchars($this->request->getVar('alamat'), true);
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
            $oldData = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();

            if ($oldData) {
                $dataLib = new Datalib();
                $cekAvailableRegistered = $dataLib->cekAlreadyRegistered($oldData->peserta_didik_id);
                if ($cekAvailableRegistered) {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->url = base_url('peserta/home');
                    $response->message = "Anda sudah melakukan pendaftaran. Untuk merubah data silahkan batalkan pendaftaran anda, atau silahkan hubungi panitia PPDB.";
                    return json_encode($response);
                }

                $lampiran = $this->request->getFile('file');
                $lampiranName = $lampiran->getName();
                $newNamelampiran = _create_name_foto($lampiranName, $oldData->nisn);

                // if ($provinsi === $oldData->provinsi && $kabupaten === $oldData->kabupaten && $kecamatan === $oldData->kecamatan && $kelurahan === $oldData->kelurahan && $alamat === $oldData->alamat && $latitude === $oldData->latitude && $longitude === $oldData->longitude && $oldData->profile_picture === $lampiranName && $oldData->email === $email && $oldData->no_hp === $nohp) {
                if ($provinsi === $oldData->provinsi && $kabupaten === $oldData->kabupaten && $kecamatan === $oldData->kecamatan && $kelurahan === $oldData->kelurahan && $dusun === $oldData->dusun && $alamat === $oldData->alamat && $latitude === $oldData->latitude && $longitude === $oldData->longitude && $oldData->profile_picture === $lampiranName && $oldData->email === $email && $oldData->no_hp === $nohp) {
                    $response = new \stdClass;
                    $response->code = 201;
                    $response->url = base_url('peserta/home');
                    $response->message = "Tidak ada perubahan data yang disimpan.";
                    return json_encode($response);
                } else {
                    if ($latitude == 'null' || $latitude == '') {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Titik Koordinat tidak boleh kosong.";
                        return json_encode($response);
                    }

                    $data = [
                        'provinsi' => $provinsi,
                        'kabupaten' => $kabupaten,
                        'kecamatan' => $kecamatan,
                        'kelurahan' => $kelurahan,
                        'dusun' => $dusun,
                        'email' => $email,
                        'no_hp' => $nohp,
                        'alamat' => $alamat,
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/user";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['profile_picture'] = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload foto gagal.";
                        return json_encode($response);
                    }

                    $this->_db->transBegin();

                    $this->_db->table('_users_profil_tb')->where('id', $oldData->id)->update($data);

                    if ($this->_db->affectedRows() > 0) {
                        $this->_db->transCommit();
                        $issuer_claim = "THE_CLAIM"; // this can be the servername. Example: https://domain.com
                        $audience_claim = "THE_AUDIENCE";
                        $issuedat_claim = time(); // issued at
                        $notbefore_claim = $issuedat_claim; //not before in seconds
                        $expire_claim = $issuedat_claim + (3600 * 24); // expire time in seconds
                        $token = array(
                            "iss" => $issuer_claim,
                            "aud" => $audience_claim,
                            "iat" => $issuedat_claim,
                            "nbf" => $notbefore_claim,
                            "exp" => $expire_claim,
                            "data" => array(
                                "id" => $user->data->id,
                                "fullname" => $oldData->fullname,
                                "role" => $user->data->role_user,
                                "compliteProfile" => true,
                            )
                        );
                        $token_jwt = getenv('token_jwt.default.key');
                        $token = JWT::encode($token, $token_jwt);
                        set_cookie('jwt', $token, strval(3600 * 24));

                        try {
                            $riwayatLib = new Riwayatlib();
                            $riwayatLib->insert("Melengkapi biodata peserta.", "Lengkapi Data", "update");
                        } catch (\Throwable $th) {
                        }
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->url = base_url('peserta/home');
                        $response->message = "Update Biodata Berhasil Disimpan.";

                        // $dataUser = ['completeProfil' => true, 'profile_picture' => $data['profile_picture']];
                        // session()->set($dataUser);

                        return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        unlink(FCPATH . "uploads/peserta/user/" . $data['profile_picture']);
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Update Biodata Gagal Disimpan.";
                        return json_encode($response);
                    }
                }
            } else {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Pengguna tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    public function saveprofilupdate()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'provinsi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Provinsi tidak boleh kosong.',
                ]
            ],
            'kabupaten' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kabupaten tidak boleh kosong.',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong.',
                ]
            ],
            'kelurahan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan tidak boleh kosong.',
                ]
            ],
            'dusun' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Dusun tidak boleh kosong.',
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong.',
                    'valid_email' => 'Email tidak valid.',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong.',
                ]
            ],
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong.',
                ]
            ],
            'latitude' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Latitude tidak boleh kosong.',
                ]
            ],
            'longitude' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Longitude tidak boleh kosong.',
                ]
            ],
        ];

        $filename = dot_array_search('file.name', $_FILES);
        if ($filename != '') {
            $lampiran = [
                'file' => [
                    'rules' => 'uploaded[file]|max_size[file, 2048]|mime_in[file,image/jpg,image/png,image/gif,image/jpeg]',
                    'errors' => [
                        'uploaded' => 'File belum terupload. ',
                        'max_size' => 'Ukuran file terlalu besar, maksimal 2 Mb. ',
                        'mime_in' => 'Ekstensi File tidak diizinkan, type file harus gambar. ',
                    ]
                ],
            ];
            $rules = array_merge($rules, $lampiran);
        }


        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('file')
                . $this->validator->getError('provinsi')
                . $this->validator->getError('kabupaten')
                . $this->validator->getError('kecamatan')
                . $this->validator->getError('kelurahan')
                . $this->validator->getError('dusun')
                . $this->validator->getError('email')
                . $this->validator->getError('nohp')
                .  $this->validator->getError('alamat')
                .  $this->validator->getError('latitude')
                .  $this->validator->getError('longitude');
            return json_encode($response);
        } else {
            $provinsi = htmlspecialchars($this->request->getVar('provinsi'), true);
            $kabupaten = htmlspecialchars($this->request->getVar('kabupaten'), true);
            $kecamatan = htmlspecialchars($this->request->getVar('kecamatan'), true);
            $kelurahan = htmlspecialchars($this->request->getVar('kelurahan'), true);
            $dusun = htmlspecialchars($this->request->getVar('dusun'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $no_hp = htmlspecialchars($this->request->getVar('nohp'), true);
            $alamat = htmlspecialchars($this->request->getVar('alamat'), true);
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
            $oldData = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();

            if ($oldData) {
                $dataLib = new Datalib();
                $cekAvailableRegistered = $dataLib->cekAlreadyRegistered($oldData->peserta_didik_id);
                if ($cekAvailableRegistered) {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->url = base_url('peserta/home');
                    $response->message = "Anda sudah melakukan pendaftaran. Untuk merubah data silahkan batalkan pendaftaran anda, atau silahkan hubungi panitia PPDB.";
                    return json_encode($response);
                }

                if ($filename == '') {
                    // if ($provinsi === $oldData->provinsi && $kabupaten === $oldData->kabupaten && $kecamatan === $oldData->kecamatan && $kelurahan === $oldData->kelurahan && $alamat === $oldData->alamat && $latitude === $oldData->latitude && $longitude === $oldData->longitude && $no_hp === $oldData->no_hp && $email === $oldData->email) {
                    if ($provinsi === $oldData->provinsi && $kabupaten === $oldData->kabupaten && $kecamatan === $oldData->kecamatan && $kelurahan === $oldData->kelurahan && $dusun === $oldData->dusun && $alamat === $oldData->alamat && $latitude === $oldData->latitude && $longitude === $oldData->longitude && $no_hp === $oldData->no_hp && $email === $oldData->email) {

                        $response = new \stdClass;
                        $response->code = 201;
                        $response->url = base_url('peserta/home');
                        $response->message = "Tidak ada perubahan data yang disimpan.";
                        return json_encode($response);
                    }
                }
                $data = [
                    'provinsi' => $provinsi,
                    'kabupaten' => $kabupaten,
                    'kecamatan' => $kecamatan,
                    'kelurahan' => $kelurahan,
                    'dusun' => $dusun,
                    'email' => $email,
                    'no_hp' => $no_hp,
                    'alamat' => $alamat,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'edited_map' => 1,
                ];

                // if($oldData->latitude !== $latitude && $oldData->longitude !== $longitude) {
                //     $data['edited_map'] = 1;
                // }

                if ($filename != '') {
                    $lampiranFile = $this->request->getFile('file');
                    $lampiranName = $lampiranFile->getName();
                    $newNamelampiran = _create_name_foto($lampiranName, $oldData->nisn);

                    if ($lampiranFile->isValid() && !$lampiranFile->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/user";

                        $lampiranFile->move($dir, $newNamelampiran);
                        $data['profile_picture'] = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload foto gagal.";
                        return json_encode($response);
                    }
                }

                $this->_db->transBegin();

                $this->_db->table('_users_profil_tb')->where('id', $oldData->id)->update($data);

                if ($this->_db->affectedRows() > 0) {
                    if ($filename != '') {
                        unlink(FCPATH . "uploads/peserta/user/" . $oldData->profile_picture);
                    }
                    $this->_db->transCommit();

                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Mengupdate biodata peserta.", "Update Data", "update");
                    } catch (\Throwable $th) {
                    }
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->url = base_url('peserta/home');
                    $response->message = "Update Biodata Berhasil Disimpan.";

                    $dataUser = [
                        'completeProfil' => true,
                        // 'profile_picture' => $data['profile_picture'],
                    ];
                    if ($filename != '') {
                        $dataUser['profile_picture'] = $data['profile_picture'];
                    }
                    // session()->set($dataUser);

                    return json_encode($response);
                } else {
                    if ($filename != '') {
                        unlink(FCPATH . "uploads/peserta/user/" . $data['profile_picture']);
                    }
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Update Biodata Gagal Disimpan.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pengguna tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    public function getuser()
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $user = $this->_db->table('_profil_users_tb')->where('id', $userId)->get()->getRowObject();

                    if ($user) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Pengguna ditemukan.";
                        $response->data = $user;
                        return json_encode($response);
                    } else {
                        $response = new \stdClass;
                        $response->code = 401;
                        $response->message = "Pengguna tidak ditemukan.";
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
