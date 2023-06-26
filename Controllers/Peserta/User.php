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

        // var_dump($data);
        // die;
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

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $builder = $this->_db->table('_users_tb');
                        $oldData = $builder->where('id', $userId)->get()->getRowObject();
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

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $oldData = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

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
                                            "id" => $userId,
                                            "fullname" => $oldData->fullname,
                                            "role" => $role,
                                            "compliteProfile" => true,
                                        )
                                    );

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

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $oldData = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

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

    public function updateFotoProfil()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,512]|is_image[file]',
                'errors' => [
                    'uploaded' => 'Pilih gambar logo instansi terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'File yang anda upload harus type gambar.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('file');
            return json_encode($response);
        } else {

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $cekData = $this->_db->table('_profil_users_tb')->where(['id' => $userId])->get()->getRowObject();

                        if (!$cekData) {
                            $response = new \stdClass;
                            $response->code = 401;
                            $response->message = "Pengguna tidak ditemukan.";
                            return json_encode($response);
                        }

                        $data = [];

                        $lampiran = $this->request->getFile('file');
                        $filesNamelampiran = $lampiran->getName();
                        $newNamelampiran = _create_name_foto($filesNamelampiran);

                        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                            if (!file_exists('/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user')) {
                                mkdir('/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user', 0755);
                                $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
                            } else {
                                $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
                            }

                            $lampiran->move($dir, $newNamelampiran);
                            $data['profile_picture'] = $newNamelampiran;
                        } else {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal mengupload file.";
                            return json_encode($response);
                        }

                        $data['updated_at'] = date('Y-m-d H:i:s');

                        $this->_db->transBegin();
                        try {
                            $this->_db->table('_profil_users_tb')->where('id', $cekData->id)->update($data);
                        } catch (\Exception $e) {
                            unlink($dir . '/' . $newNamelampiran);
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal menyimpan update foto profil.";
                            return json_encode($response);
                        }

                        if ($this->_db->affectedRows() > 0) {
                            if ($cekData->profile_picture === null || $cekData->profile_picture === '') {
                            } else {
                                try {
                                    $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
                                    unlink($dir . '/' . $cekData->profile_picture);
                                } catch (\Exception $e) {
                                }
                            }
                            $this->_db->transCommit();
                            session()->set('profile_picture', $newNamelampiran);
                            $response = new \stdClass;
                            $response->code = 200;
                            $response->message = "Update foto profil berhasil.";
                            $response->data = $cekData->id;
                            return json_encode($response);
                        } else {
                            unlink($dir . '/' . $newNamelampiran);
                            $this->_db->transRollback();
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gagal menyimpan update foto profil";
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

    // public function index()
    // {
    //     $data['title'] = 'PROFILE USER';
    //     $Profilelib = new Profilelib();
    //     $user = $Profilelib->user();
    //     if ($user->code != 200) {
    //         session()->destroy();
    //         return redirect()->to(base_url('auth'));
    //     }

    //     $select = "a.id, a.fullname, a.email, a.no_hp as noHp, a.nip, a.jenis_kelamin as jenisKelamin, a.jabatan, a.profile_picture as imageProfile, a.surat_tugas as suratTugas, a.role_user as roleUser, a.created_at as createdAt, a.updated_at as updated_at, a.last_active as lastActive";
    //     $userDetail = $this->_db->table('_profil_users_tb a')
    //         ->select($select)
    //         ->where('a.id', $user->data->id)
    //         ->get()->getRowObject();

    //     $data['user'] = $user->data;
    //     $data['data'] = $userDetail;

    //     // var_dump($user->data);die;

    //     return view('page/user/index', $data);
    // }

    // public function edit() {
    //     $data['title'] = 'EDIT PROFILE USER';
    //     $Profilelib = new Profilelib();
    //     $user = $Profilelib->user();
    //     if ($user->code != 200) {
    //         session()->destroy();
    //         return redirect()->to(base_url('auth'));
    //     }
    //     $data['user'] = $user->data;

    //     return view('page/user/edit', $data);
    // }

    // public function saveEdit() {
    //     if ($this->request->getMethod() != 'post') {

    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Hanya request post yang diperbolehkan";
    //         return json_encode($response);
    //     } else {
    //         $rules = [
    //             'id' => 'required|trim',
    //             'nohp' => 'required|trim|min_length[9]',
    //             'jabatan' => 'required|trim',
    //             'jenisKelamin' => 'required|trim',
    //             'email' => 'required|trim|valid_email',
    //             'nip' => 'required|trim',
    //             'fullname' => 'required|trim',
    //         ];

    //         $filename = dot_array_search('image.name', $_FILES);
    // 		if($filename != '') {
    // 		    $lampiranRules = ['image' => 'uploaded[image]|max_size[image, 512]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',];
    // 		    $rules = array_merge($rules, $lampiranRules);
    // 		}

    //         if (!$this->validate($rules)) {
    //             $errorMessage = $this->validator->getError('id') . " " . $this->validator->getError('nohp') . " " . $this->validator->getError('jabatan') . " " . $this->validator->getError('jenisKelamin') . " " . $this->validator->getError('email') . " " . $this->validator->getError('nip') . " " . $this->validator->getError('fullname') . " " . $this->validator->getError('image');
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = str_replace("  ", "", $errorMessage);
    //             return json_encode($response);
    //         } else {
    //             $id = htmlspecialchars($this->request->getVar('id'), true);
    //             $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
    //             $jabatan = htmlspecialchars($this->request->getVar('jabatan'), true);
    //             $jenisKelamin = htmlspecialchars($this->request->getVar('jenisKelamin'), true);
    //             $email = htmlspecialchars($this->request->getVar('email'), true);
    //             $nip = htmlspecialchars($this->request->getVar('nip'), true);
    //             $fullname = htmlspecialchars($this->request->getVar('fullname'), true);

    //             $Profilelib = new Profilelib();
    //             $oldData = $Profilelib->userWithId($id);

    //             if($oldData) {

    //                 if($oldData->email != $email) {
    //                     $anyUserEmail = $Profilelib->cekUserWithEmail($email);
    //                     if($anyUserEmail > 0) {
    //                         $response = new \stdClass;
    //                         $response->code = 400;
    //                         $response->message = 'Email sudah terkait dengan pengguna lain.';
    //                         return json_encode($response);
    //                     }
    //                 }

    //                 if($oldData->noHp != $nohp) {
    //                     $anyUserNohp = $Profilelib->cekUserWithNohp($nohp);
    //                     if($anyUserNohp > 0) {
    //                         $response = new \stdClass;
    //                         $response->code = 400;
    //                         $response->message = 'No Handphone sudah terkait dengan pengguna lain.';
    //                         return json_encode($response);
    //                     }
    //                 }

    //                 $dataUpdateProfile = [
    //                     'fullname' => $fullname,
    //                     'email' => $email,
    //                     'no_hp' => $nohp,
    //                     'jenis_kelamin' => $jenisKelamin,
    //                     'jabatan' => $jabatan,
    //                     'nip' => $nip,
    //                 ];

    //                 if($filename != '') {
    //                     $dir = './upload/user';

    //                     $lampiran = $this->request->getFile('image');
    //                     $filesNamelampiran = $lampiran->getName();
    //                     $newNamelampiran = _create_name_foto($filesNamelampiran);

    //                     if ($lampiran->isValid() && !$lampiran->hasMoved()) {
    //                         // echo "failed";

    //                         $lampiran->move($dir, $newNamelampiran);
    //                         $dataUpdateProfile['surat_tugas'] = $newNamelampiran;
    //                         } else {
    //                         // echo "Gambar tidak terupload";
    //                         $response = new \stdClass;
    //                         $response->code = 400;
    //                         $response->message = "Gambar tidak terupload";
    //                         return json_encode($response);
    //                     }
    //                 }

    //                 $this->_db->transBegin();

    //                 try {
    //                     $buildersu = $this->_db->table('_profil_users_tb');
    //                     $buildersu->set($dataUpdateProfile);
    //                     $buildersu->where('id', $id);
    //                     $buildersu->update();

    //                 } catch (Exception $e) {
    //                     $this->_db->transRollback();
    //                     if($filename != '') {
    //                         unlink(FCPATH . $dir . '/' . $newNamelampiran);
    //                     }
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = 'Gagal simpan informasi akun.';
    //                     return json_encode($response);
    //                 }

    //                 $suks = $this->_db->affectedRows();

    //                 if($suks > 0) {
    //                     $this->_db->transCommit();
    //                     if($oldData->suratTugas != null && $filename != '') {
    //                         unlink(FCPATH . $dir . '/' . $oldData->suratTugas);
    //                     }
    //                     $response = new \stdClass;
    //                     $response->code = 200;
    //                     $response->message = "Simpan informasi akun berhasil.";
    //                     $response->url = base_url();
    //                     return json_encode($response);
    //                 } else {
    //                     $this->_db->transRollback();
    //                     if($filename != '') {
    //                         unlink(FCPATH . $dir . '/' . $newNamelampiran);
    //                     }
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = 'Gagal simpan informasi akun.';
    //                     return json_encode($response);
    //                 }
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = 'User tidak ditemukan';
    //                 return json_encode($response);
    //             }
    //         }
    //     }
    // }

    // public function upload() {
    //     if(!$this->request->getGet('token')) {
    //         return view('404');
    //     }

    //     $token = htmlspecialchars($this->request->getGet('token'), true);

    //     $usulanLib = new Usulanlib();
    //     $datas = $usulanLib->getUsulan($token);

    //     $data['title'] = 'Upload Lampiran Usulan TPG';
    //     $Profilelib = new Profilelib();
    //     $user = $Profilelib->user();
    //     if ($user->code != 200) {
    //         session()->destroy();
    //         return redirect()->to(base_url('auth'));
    //     }
    //     $data['user'] = $user->data;

    //     $data['usulan'] = $datas;

    //     return view('page/sekolah/tpg/upload_lampiran_usulan', $data);
    // }

    // public function downloadSptjm() {
    //     if(!$this->request->getGet('token')) {
    //         return view('404');
    //     }

    //     $token = htmlspecialchars($this->request->getGet('token'), true);

    //     $usulanLib = new Usulanlib();
    //     $datas = $usulanLib->getUsulan($token);

    //     // var_dump($data);die;

    //     if(!$datas) {
    //         return view('404');
    //     }

    //     $data['usulan'] = $datas;

    //     $data['title'] = 'SPTJM USULAN';
    //     $Profilelib = new Profilelib();
    //     $user = $Profilelib->user();
    //     if ($user->code != 200) {
    //         session()->destroy();
    //         return redirect()->to(base_url('auth'));
    //     }

    //     $data['user'] = $user->data;

    //     $kepsek = $this->_db->table('_ptk_tb')->where(['npsn' => $data['user']->npsn, 'jabatan_kepsek' => 1])->get()->getRowObject();
    //     if($kepsek) {
    //         $data['kepsek'] = $kepsek;
    //     }

    //     $settingLib = new Settinglib();

    //     $data['tahunAnggaran'] = $settingLib->getCurrentTahunAnggaran();
    //     return view('page/sekolah/tpg/template_sptjm', $data);

    //     if(count($data['usulan']) > 0 ) {
    //         // $dompdf = new \Dompdf\Dompdf(); 
    //         $dompdf = new Dompdf(); 
    //         // $dompdf->set_option('isRemoteEnabled', TRUE);
    //         $dompdf->loadHtml(view('page/sekolah/tpg/template_sptjm', $data));
    //         // $dompdf->setPaper('A4', 'landscape');
    //         $dompdf->setPaper('A4', 'potrait');
    //         $dompdf->render();
    //         $dompdf->stream();
    //         // $dompdf->stream("" .'SPTJM-UTPG-SEMESTER-' . $data['tahunAnggaran']->semester . '-TAHUN-' . $data['tahunAnggaran']->tahun . '-' . $user->data->npsn. '.pdf' . "", array("Attachment"=>0));

    //         // $m = new Merger();

    //         // $dompdf = new \Dompdf\Dompdf();
    //         // $dompdf->load_html(view('page/sekolah/tpg/template_sptjm', $data));
    //         // $dompdf->render();
    //         // $m->addRaw($dompdf->output());
    //         // unset($dompdf);

    //         // $dompdf = new \Dompdf\Dompdf();
    //         // $dompdf->set_paper('A4', 'landscape');
    //         // $dompdf->load_html(view('page/sekolah/tpg/template_lampiran_sptjm', $data));
    //         // $m->addRaw($dompdf->output());
    //         // $dompdf->render();

    //         // // file_put_contents('combined.pdf', $m->merge());
    //         // file_put_contents( 'SPTJM-UTPG-SEMESTER-' . $data['tahunAnggaran']->semester . '-TAHUN-' . $data['tahunAnggaran']->tahun . '-' . $user->data->npsn. '.pdf', $m->merge());
    //     } else {
    //         return view('404');
    //     }
    // }

    // public function uploadLampiranUsulan() {
    //     if ($this->request->getMethod() != 'post') {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Hanya request post yang diperbolehkan";
    //         return json_encode($response);
    //     }

    //     $rules = [
    //         'id' => 'required|trim',
    //         'sptjm' => 'uploaded[sptjm]|max_size[sptjm, 1024]|mime_in[sptjm,application/pdf]',
    //         'sk_tugas' => 'uploaded[sk_tugas]|max_size[sk_tugas, 1024]|mime_in[sk_tugas,application/pdf]',
    //     ];

    //     $filenameGaji = dot_array_search('slip_gaji.name', $_FILES);

    //     if ($filenameGaji != '') {
    //         $img = ['slip_gaji' => 'uploaded[slip_gaji]|max_size[slip_gaji, 1024]|mime_in[slip_gaji,application/pdf]'];
    //         $rules = array_merge($rules, $img);
    //     }

    //     if (!$this->validate($rules)) {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = $this->validator->getError('sptjm') . " " . $this->validator->getError('sk_tugas')  . " " . $this->validator->getError('slip_gaji') . " " . $this->validator->getError('id');
    //         return json_encode($response);
    //     } else {
    //         $id = htmlspecialchars($this->request->getVar('id'), true);

    //         $usulanLib = new Usulanlib();
    //         $usulans = $usulanLib->getUsulan($id);

    //         $settingLib = new Settinglib();

    //         $tahunAnggaran = $settingLib->getCurrentTahunAnggaran();

    //         if(count($usulans) > 0 && $tahunAnggaran) {
    //             $usulan = $usulans[0];

    //             if (!file_exists('./upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester)) {
    //                 mkdir('./upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester, 0755);
    //                 $dir = './upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester;
    //             } else {
    //                 $dir = './upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester;
    //             }

    //             $data = [];

    //             $lampiranSptjm = $this->request->getFile('sptjm');
    //             $filesNamelampiranSptjm = $lampiranSptjm->getName();
    //             $newNamelampiranSptjm = _create_name_foto($filesNamelampiranSptjm);

    //             if ($lampiranSptjm->isValid() && !$lampiranSptjm->hasMoved()) {
    //                 $lampiranSptjm->move($dir, $newNamelampiranSptjm);
    //                     $data['lampiran_sptjm'] = $newNamelampiranSptjm;
    //             } else {
    //                 return false;
    //             }

    //             $lampiranSk = $this->request->getFile('sk_tugas');
    //             $filesNamelampiranSk = $lampiranSk->getName();
    //             $newNamelampiranSk = _create_name_foto($filesNamelampiranSk);

    //             if ($lampiranSk->isValid() && !$lampiranSk->hasMoved()) {
    //                 $lampiranSk->move($dir, $newNamelampiranSk);
    //                     $data['lampiran_sk_pembagian_tugas'] = $newNamelampiranSk;
    //             } else {
    //                 unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
    //                 return false;
    //             }

    //             if ($filenameGaji != '') {
    //                 $lampiranGaji = $this->request->getFile('slip_gaji');
    //                 $filesNamelampiranGaji = $lampiranGaji->getName();
    //                 $newNamelampiranGaji = _create_name_foto($filesNamelampiranGaji);

    //                 if ($lampiranGaji->isValid() && !$lampiranGaji->hasMoved()) {
    //                     $lampiranGaji->move($dir, $newNamelampiranGaji);
    //                         $data['lampiran_slip_gaji'] = $newNamelampiranGaji;
    //                 } else {
    //                     unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
    //                     unlink(FCPATH . $dir . '/' . $newNamelampiranSk);
    //                     return false;
    //                 }
    //             }

    //             $builder = $this->_db->table('_daftar_usulan_tpg');
    //             $builder->where('id', $id);
    //             $builder->update($data);
    //             $updated = $this->_db->affectedRows();
    //             if($updated > 0) {
    //                 $actionChangeStatus = $usulanLib->updateUsulanToProcess($usulan->kode_usulan);
    //                 if($actionChangeStatus != false) {
    //                     $response = new \stdClass;
    //                     $response->code = 200;
    //                     $response->message = "Lampiran usulan tpg berhasil diupload.";
    //                     $response->url = base_url('sekolah/tpg/detail?token='. $usulan->kode_usulan);
    //                     return json_encode($response);
    //                     // return $usulan->kode_usulan;
    //                     // echo "lampiran usulan tpg berhasil diupload.";
    //                 } else {
    //                     unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
    //                     unlink(FCPATH . $dir . '/' . $newNamelampiranSk);
    //                     if ($filenameGaji != '') {
    //                         unlink(FCPATH . $dir . '/' . $newNamelampiranGaji);
    //                     }

    //                     return false;
    //                 }
    //             } else {
    //                 unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
    //                 unlink(FCPATH . $dir . '/' . $newNamelampiranSk);
    //                 if ($filenameGaji != '') {
    //                     unlink(FCPATH . $dir . '/' . $newNamelampiranGaji);
    //                 }

    //                 return false;
    //             }
    //         }
    //     }
    // }
}
