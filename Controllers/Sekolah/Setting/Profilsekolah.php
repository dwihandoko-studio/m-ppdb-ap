<?php

namespace App\Controllers\Sekolah\Setting;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;
// use App\Libraries\Settinglib;
// use App\Models\PtkModel;

class Profilsekolah extends BaseController
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
        $data['sekolah'] = $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_id)->get()->getRowObject();

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
        $data['title'] = 'Setting Profil Sekolah';

        $builder = $this->_db->table('_ref_profil_sekolah');
        $data['ks'] = $builder->where('id', $user->data->sekolah_id)->get()->getRowObject();
        $data['sekolah'] = $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_id)->get()->getRowObject();
        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();
        // $data['kabupatens'] = $this->_db->table('ref_kabupaten')->where('id_provinsi', $user->data->provinsi)->orderBy('nama', 'asc')->get()->getResult();
        // $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $user->data->kabupaten)->orderBy('nama', 'asc')->get()->getResult();
        // $data['kelurahans'] = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $user->data->kecamatan)->orderBy('nama', 'asc')->get()->getResult();

        $data['page'] = "Setting Profil Sekolah";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Setting Profil Sekolah';
        $data['datatables'] = false;

        return view('sekolah/setting/profilsekolah/profile', $data);
    }

    public function save()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'nama_sekolah' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama sekolah tidak boleh kosong. ',
                ]
            ],
            'nama_ks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama kepala sekolah tidak boleh kosong. ',
                ]
            ],
            'nip_ks' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIP kepala sekolah tidak boleh kosong. ',
                ]
            ],
            // 'latitude' => [
            //     'rules' => 'required|trim',
            //     'errors' => [
            //         'required' => 'Latitude tidak boleh kosong.',
            //     ]
            // ],
            // 'longitude' => [
            //     'rules' => 'required|trim',
            //     'errors' => [
            //         'required' => 'Longitude tidak boleh kosong.',
            //     ]
            // ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nama_ks')
                . $this->validator->getError('nama_sekolah')
                . $this->validator->getError('nip_ks')
                . $this->validator->getError('latitude')
                . $this->validator->getError('longitude');
            return json_encode($response);
        } else {
            $nama_sekolah = htmlspecialchars($this->request->getVar('nama_sekolah'), true);
            $nama_ks = htmlspecialchars($this->request->getVar('nama_ks'), true);
            $nip_ks = htmlspecialchars($this->request->getVar('nip_ks'), true);
            $latitude = htmlspecialchars($this->request->getVar('latitude'), true);
            $longitude = htmlspecialchars($this->request->getVar('longitude'), true);

            $Profilelib = new Profilelib();
            $user = $Profilelib->userSekolah();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis, silahkan login ulang.";
                return json_encode($response);
            }

            $builder = $this->_db->table('_ref_profil_sekolah');
            $oldData = $builder->where('id', $user->data->sekolah_id)->get()->getRowObject();

            $data = [
                'user_id' => $user->data->id,
                'nama_ks' => $nama_ks,
                'nip_ks' => $nip_ks,
            ];

            if ($oldData) {
                $data['updated_at'] = date('Y-m-d H:i:s');
                $oldSekolah = $this->_db->table('ref_sekolah')->select("latitude, longitude, nama")->where('id', $user->data->sekolah_id)->get()->getRowObject();
                if (!$oldSekolah) {
                    $response = new \stdClass;
                    $response->code = 201;
                    $response->message = "Referensi sekolah tidak ditemukan.";
                    return json_encode($response);
                }

                if ($nama_ks === $oldData->nama_ks && $nip_ks === $oldData->nip_ks && $latitude === $oldSekolah->latitude && $longitude === $oldSekolah->longitude && $nama_sekolah == $oldSekolah->nama) {
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Tidak ada perubahan data yang disimpan.";
                    return json_encode($response);
                } else {
                    $this->_db->transBegin();
                    $this->_db->table('_ref_profil_sekolah')->where('id', $oldData->id)->update($data);

                    if ($this->_db->affectedRows() > 0) {
                        // $this->_db->table('ref_sekolah')->where('id', $oldData->id)->update([
                        //     'latitude' => $latitude,
                        //     'longitude' => $longitude,
                        //     'nama' => $nama_sekolah,
                        // ]);

                        // if ($this->_db->affectedRows() > 0) {
                        $this->_db->transCommit();
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Update Profil Sekolah Berhasil Disimpan.";
                        return json_encode($response);
                        // } else {
                        //     $this->_db->transRollback();
                        //     $response = new \stdClass;
                        //     $response->code = 400;
                        //     $response->message = "Update Profil Sekolah Gagal Disimpan.";
                        //     return json_encode($response);
                        // }
                    } else {
                        $this->_db->transRollback();
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Update Profil Sekolah Gagal Disimpan.";
                        return json_encode($response);
                    }
                }
            } else {
                $data['id'] = $user->data->sekolah_id;
                $data['created_at'] = date('Y-m-d H:i:s');
                $this->_db->transBegin();
                $this->_db->table('_ref_profil_sekolah')->insert($data);

                if ($this->_db->affectedRows() > 0) {
                    $oldSekolah = $this->_db->table('ref_sekolah')->select("latitude, longitude, nama")->where('id', $user->data->sekolah_id)->get()->getRowObject();
                    if ($latitude === $oldSekolah->latitude && $longitude === $oldSekolah->longitude && $nama_sekolah == $oldSekolah->nama) {
                        $this->_db->transCommit();
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Profil Sekolah Berhasil Disimpan.";
                        return json_encode($response);
                    }

                    $this->_db->table('ref_sekolah')->where('id', $user->data->sekolah_id)->update([
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'nama' => $nama_sekolah,
                    ]);
                    if ($this->_db->affectedRows() > 0) {
                        $this->_db->transCommit();
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Profil Sekolah Berhasil Disimpan.";
                        return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Profil Sekolah Gagal Disimpan.";
                        return json_encode($response);
                    }
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Profil Sekolah Gagal Disimpan.";
                    return json_encode($response);
                }
            }
        }
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
        $response->data = view('sekolah/setting/profilsekolah/pick-maps', $data);
        return json_encode($response);
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
