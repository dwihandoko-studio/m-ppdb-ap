<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;
// use App\Libraries\Settinglib;
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

    public function profile()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;
        $data['title'] = 'Dashboard';
        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();
        $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $user->data->provinsi)->orderBy('nama', 'asc')->get()->getResult();
        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $user->data->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $user->data->kecamatan)->orderBy('nama', 'asc')->get()->getResult();

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('sekolah/lengkapi-profile', $data);
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;
        $data['title'] = 'Dashboard';
        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();
        $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $user->data->provinsi)->orderBy('nama', 'asc')->get()->getResult();
        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $user->data->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $user->data->kecamatan)->orderBy('nama', 'asc')->get()->getResult();

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('sekolah/lengkapi-profile', $data);
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
                            $response->code = 400;
                            $response->message = "Pengguna tidak ditemukan.";
                            return json_encode($response);
                        }
                    } else {
                        $response = new \stdClass;
                        $response->code = 401;
                        $response->message = "Session telah habis.";
                        return json_encode($response);
                    }
                } catch (\Exception $e) {
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah habis.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }
        }
    }

    public function updateBiodata()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'alamat' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong. ',
                ]
            ],
            // 'provinsi' => [
            //     'rules' => 'required|trim',
            //     'errors' => [
            //         'required' => 'Silahkan pilih provinsi. ',
            //     ]
            // ],
            'kabupaten' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan pilih kabupaten. ',
                ]
            ],
            'kecamatan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan pilih kecamatan. ',
                ]
            ],
            'kelurahan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Silahkan pilih kelurahan. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('alamat') . $this->validator->getError('provinsi') . $this->validator->getError('kabupaten') . $this->validator->getError('kecamatan') . $this->validator->getError('kelurahan');
            return json_encode($response);
        } else {
            $alamat = htmlspecialchars($this->request->getVar('alamat'), true);
            // $provinsi = htmlspecialchars($this->request->getVar('provinsi'), true);
            $kabupaten = htmlspecialchars($this->request->getVar('kabupaten'), true);
            $kecamatan = htmlspecialchars($this->request->getVar('kecamatan'), true);
            $kelurahan = htmlspecialchars($this->request->getVar('kelurahan'), true);

            $Profilelib = new Profilelib();
            $user = $Profilelib->userSekolah();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }
            $oldData = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();
            $token_jwt = getenv('token_jwt.default.key');
            if ($oldData) {
                if ($alamat === $oldData->alamat && $kabupaten === $oldData->kabupaten && $kecamatan === $oldData->kecamatan && $kelurahan === $oldData->kelurahan) {
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Tidak ada perubahan data yang disimpan.";
                    return json_encode($response);
                } else {
                    $this->_db->transBegin();
                    $data = [
                        'alamat' => $alamat,
                        'kabupaten' => $kabupaten,
                        'kecamatan' => $kecamatan,
                        'kelurahan' => $kelurahan,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    $this->_db->table('_users_profil_tb')->where('id', $oldData->id)->update($data);

                    if ($this->_db->affectedRows() > 0) {
                        $this->_db->transCommit();
                        $issuer_claim = base_url(); // this can be the servername. Example: https://domain.com
                        $audience_claim = "PPDB";
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
                                "role" => (int)$oldData->role_user,
                                "compliteProfile" => true,
                            )
                        );

                        $token = JWT::encode($token, $token_jwt);
                        set_cookie('jwt', $token, strval(3600 * 24));
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Update Biodata Admin Sekolah Berhasil Disimpan.";
                        return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Update Biodata Admin Sekolah Gagal Disimpan.";
                        return json_encode($response);
                    }
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
                    $user = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();

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
                        $cekData = $this->_db->table('_users_profil_tb')->where(['id' => $userId])->get()->getRowObject();

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
                        $dir = FCPATH . "uploads/sekolah/foto";
                        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
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
                            $this->_db->table('_users_profil_tb')->where('id', $cekData->id)->update($data);
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
}
