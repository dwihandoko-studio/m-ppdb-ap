<?php

namespace App\Controllers\Peserta;

use App\Controllers\BaseController;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Peserta\Datalib;
use App\Libraries\Peserta\Riwayatlib;
use Firebase\JWT\JWT;

class Upload extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function index()
    {
        $data['title'] = 'Upload Berkas';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $user->data->peserta_didik_id)->get()->getRowObject();

        if ($cekRegisterTemp) {
            $data['error'] = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas.";
            $data['sekolah_pilihan'] = $cekRegisterTemp;
        } else {

            $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $user->data->peserta_didik_id)->whereIn('status_pendaftaran', [1, 2, 3])->orderBy('created_at', 'DESC')->limit(1)->get()->getRowObject();
            if ($cekRegisterApprove) {
                if ($cekRegisterApprove->status_pendaftaran == 2) {
                    $data['success'] = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 di :<br/><b>" . getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1) . "</b> Melalui Jalur " . $cekRegisterApprove->via_jalur . ". <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan sesuai jadwal yang telah ditentukan.";
                }
                if ($cekRegisterApprove->status_pendaftaran == 3) {
                    if ($cekRegisterApprove->via_jalur == "AFIRMASI") {
                        $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 di :<br/><b>" . getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1) . "</b> Melalui Jalur " . $cekRegisterApprove->via_jalur . ". <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
                    } else {
                        $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 di :<br/><b>" . getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1) . "</b> Melalui Jalur " . $cekRegisterApprove->via_jalur . ".";
                    }
                }
                $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                $data['sekolah_pilihan'] = $cekRegisterApprove;
            }
        }

        $data['dataUpload'] = $this->_db->table('_upload_kelengkapan_berkas')->where('user_id', $user->data->id)->get()->getRowObject();

        return view('peserta/upload/index', $data);
    }

    public function addSave()
    {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Untuk sementara upload file via web, masih dalam proses perbaikan. Silahkan gunakan App Android.";
        // return json_encode($response);

        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,application/pdf,image/jpeg,image/jpg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih file terlebih dahulu.',
                    'max_size' => 'Ukuran file terlalu besar.',
                    'mime_in' => 'File yang anda upload harus type pdf / image.'
                ]
            ],
            'filename' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Filename tidak boleh kosong.',
                ]
            ],
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('filename')  . " " . $this->validator->getError('file')  . " " . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $filename = htmlspecialchars($this->request->getVar('filename'), true);
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


            $cekData = $this->_db->table('_upload_kelengkapan_berkas')->where(['user_id' => $user->data->id])->get()->getRowObject();

            $userDataLogin = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();
            if (!$userDataLogin) {
                $response = new \stdClass;
                $response->code = 401;
                $response->url = base_url('peserta/home');
                $response->message = "User tidak ditemukan.";
                return json_encode($response);
            }

            $dataLib = new Datalib();
            $cekAvailableRegistered = $dataLib->cekAlreadyRegistered($userDataLogin->peserta_didik_id);
            if ($cekAvailableRegistered) {
                $response = new \stdClass;
                $response->code = 400;
                $response->url = base_url('peserta/home');
                $response->message = "Anda sudah melakukan pendaftaran. Untuk merubah data silahkan batalkan pendaftaran anda, atau silahkan hubungi panitia PPDB.";
                return json_encode($response);
            }

            if ($cekData) {
                $data = [
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $dir = "";
                $namaFile = "";

                if ($id === "_file_kk") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/kk";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_kk'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_akta") {
                    $lampiran = $this->request->getFile('file');

                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/akta";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_akta_kelahiran'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_lulus") {
                    $lampiran = $this->request->getFile('file');

                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/kelulusan";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_lulus'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_prestasi") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/prestasi";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_prestasi'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_afirmasi") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/afirmasi";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_afirmasi'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_pernyataan") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/pernyataan";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_pernyataan'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_foto_rumah") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/fotorumah";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_foto_rumah'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_mutasi") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/mutasi";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_mutasi'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Id tidak diketahui.";
                    return json_encode($response);
                }
                $this->_db->transBegin();
                $this->_db->table('_upload_kelengkapan_berkas')->where('user_id', $user->data->id)->update($data);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        if ($id === "_file_kk") {
                            if ($cekData->lampiran_kk !== null) {
                                unlink($dir . '/' . $cekData->lampiran_kk);
                            }
                        } else if ($id === "_file_akta") {
                            if ($cekData->lampiran_akta_kelahiran !== null) {
                                unlink($dir . '/' . $cekData->lampiran_akta_kelahiran);
                            }
                        } else if ($id === "_file_lulus") {
                            if ($cekData->lampiran_lulus !== null) {
                                unlink($dir . '/' . $cekData->lampiran_lulus);
                            }
                        } else if ($id === "_file_prestasi") {
                            if ($cekData->lampiran_prestasi !== null) {
                                unlink($dir . '/' . $cekData->lampiran_prestasi);
                            }
                        } else if ($id === "_file_afirmasi") {
                            if ($cekData->lampiran_afirmasi !== null) {
                                unlink($dir . '/' . $cekData->lampiran_afirmasi);
                            }
                        } else if ($id === "_file_pernyataan") {
                            if ($cekData->lampiran_pernyataan !== null) {
                                unlink($dir . '/' . $cekData->lampiran_pernyataan);
                            }
                        } else if ($id === "_file_foto_rumah") {
                            if ($cekData->lampiran_foto_rumah !== null) {
                                unlink($dir . '/' . $cekData->lampiran_foto_rumah);
                            }
                        } else if ($id === "_file_mutasi") {
                            if ($cekData->lampiran_mutasi !== null) {
                                unlink($dir . '/' . $cekData->lampiran_mutasi);
                            }
                        }
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Mengupload kelengkapan berkas peserta.", "Upload Berkas", "upload");
                    } catch (\Throwable $th) {
                    }
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "File berhasil disimpan.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    unlink($dir . '/' . $namaFile);
                    // if ($id === "_file_kk") {
                    // } else if($id === "_file_lulus") {
                    //     unlink($dir . '/' . $data['lampiran_kk']);
                    // }
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "File gagal disimpan.";
                    return json_encode($response);
                }
            } else {
                $uuidLib = new Uuid();
                $uuid = $uuidLib->v4();

                $data = [
                    'id' => $uuid,
                    'user_id' => $user->data->id,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dir = "";
                $namaFile = "";

                if ($id === "_file_kk") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/kk";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_kk'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_akta") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/akta";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_akta_kelahiran'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_lulus") {
                    $lampiran = $this->request->getFile('file');
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/kelulusan";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_lulus'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_prestasi") {
                    $lampiran = $this->request->getFile('file');
                    $filesNamelampiran = $lampiran->getName();
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/prestasi";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_prestasi'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_afirmasi") {
                    $lampiran = $this->request->getFile('file');
                    $filesNamelampiran = $lampiran->getName();
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/afirmasi";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_afirmasi'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_pernyataan") {
                    $lampiran = $this->request->getFile('file');
                    $filesNamelampiran = $lampiran->getName();
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/pernyataan";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_pernyataan'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_foto_rumah") {
                    $lampiran = $this->request->getFile('file');
                    $filesNamelampiran = $lampiran->getName();
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/fotorumah";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_foto_rumah'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else if ($id === "_file_mutasi") {
                    $lampiran = $this->request->getFile('file');
                    $filesNamelampiran = $lampiran->getName();
                    $newNamelampiran = _create_name_foto($filename, $userDataLogin->nisn);

                    if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                        $dir = FCPATH . "uploads/peserta/mutasi";

                        $lampiran->move($dir, $newNamelampiran);
                        $data['lampiran_mutasi'] = $newNamelampiran;
                        $namaFile = $newNamelampiran;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Upload file gagal.";
                        return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Id tidak diketahui.";
                    return json_encode($response);
                }
                $this->_db->transBegin();
                $this->_db->table('_upload_kelengkapan_berkas')->insert($data);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Mengupload kelengkapan berkas peserta.", "Upload Berkas");
                    } catch (\Throwable $th) {
                    }
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "File berhasil disimpan.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    unlink($dir . '/' . $namaFile);
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "File gagal disimpan.";
                    return json_encode($response);
                }
            }
        }
    }

    public function hapusLampiran()
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
                    'required' => 'Token tidak boleh kosong.',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                ]
            ],
            'jenis' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenis upload tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama') . " " . $this->validator->getError('jenis');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $jenis = htmlspecialchars($this->request->getVar('jenis'), true);

            $jwt = get_cookie('jwt');
            $token_jwt = getenv('token_jwt.default.key');
            if ($jwt) {

                try {

                    $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                    if ($decoded) {
                        $userId = $decoded->data->id;
                        $role = $decoded->data->role;
                        $oldData = $this->_db->table('_upload_kelengkapan_berkas')->where('id', $id)->get()->getRowObject();


                        $userDataLogin = $this->_db->table('_users_profil_tb')->where('id', $userId)->get()->getRowObject();
                        if (!$userDataLogin) {
                            $response = new \stdClass;
                            $response->code = 401;
                            $response->url = base_url('peserta/home');
                            $response->message = "User tidak ditemukan.";
                            return json_encode($response);
                        }

                        $dataLib = new Datalib();
                        $cekAvailableRegistered = $dataLib->cekAlreadyRegistered($userDataLogin->peserta_didik_id);
                        if ($cekAvailableRegistered) {
                            $response = new \stdClass;
                            $response->code = 201;
                            $response->url = base_url('peserta/home');
                            $response->message = "Anda sudah melakukan pendaftaran. Untuk merubah data silahkan batalkan pendaftaran anda, atau silahkan hubungi panitia PPDB.";
                            return json_encode($response);
                        }

                        $data = [];

                        $dir = "";
                        $namaFile = "";

                        if ($oldData) {
                            if ($jenis === "_file_kk") {
                                $dir = FCPATH . "uploads/peserta/kk";
                                $namaFile = $oldData->lampiran_kk;
                                $data['lampiran_kk'] = null;
                            } else if ($jenis === "_file_akta") {
                                $dir = FCPATH . "uploads/peserta/akta";
                                $namaFile = $oldData->lampiran_akta_kelahiran;
                                $data['lampiran_akta_kelahiran'] = null;
                            } else if ($jenis === "_file_lulus") {
                                $dir = FCPATH . "uploads/peserta/kelulusan";
                                $namaFile = $oldData->lampiran_lulus;
                                $data['lampiran_lulus'] = null;
                            } else if ($jenis === "_file_prestasi") {
                                $dir = FCPATH . "uploads/peserta/prestasi";
                                $namaFile = $oldData->lampiran_prestasi;
                                $data['lampiran_prestasi'] = null;
                            } else if ($jenis === "_file_afirmasi") {
                                $dir = FCPATH . "uploads/peserta/afirmasi";
                                $namaFile = $oldData->lampiran_afirmasi;
                                $data['lampiran_afirmasi'] = null;
                            } else if ($jenis === "_file_pernyataan") {
                                $dir = FCPATH . "uploads/peserta/pernyataan";
                                $namaFile = $oldData->lampiran_pernyataan;
                                $data['lampiran_pernyataan'] = null;
                            } else if ($jenis === "_file_foto_rumah") {
                                $dir = FCPATH . "uploads/peserta/fotorumah";
                                $namaFile = $oldData->lampiran_foto_rumah;
                                $data['lampiran_foto_rumah'] = null;
                            } else if ($jenis === "_file_mutasi") {
                                $dir = FCPATH . "uploads/peserta/mutasi";
                                $namaFile = $oldData->lampiran_mutasi;
                                $data['lampiran_mutasi'] = null;
                            } else {
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Jenis hapus file tidak dikenali";
                                return json_encode($response);
                            }

                            $data['updated_at'] = date('Y-m-d H:i:s');
                            $this->_db->table('_upload_kelengkapan_berkas')->where('id', $oldData->id)->update($data);
                            if ($this->_db->affectedRows() > 0) {
                                if ($jenis === "_file_kk") {
                                    try {
                                        if ($oldData->lampiran_kk !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_akta") {
                                    try {
                                        if ($oldData->lampiran_akta_kelahiran !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_lulus") {
                                    try {
                                        if ($oldData->lampiran_lulus !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_prestasi") {
                                    try {
                                        if ($oldData->lampiran_prestasi !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_afirmasi") {
                                    try {
                                        if ($oldData->lampiran_afirmasi !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_pernyataan") {
                                    try {
                                        if ($oldData->lampiran_pernyataan !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_foto_rumah") {
                                    try {
                                        if ($oldData->lampiran_foto_rumah !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else if ($jenis === "_file_mutasi") {
                                    try {
                                        if ($oldData->lampiran_mutasi !== null) {
                                            unlink($dir . '/' . $namaFile);
                                        }
                                    } catch (\Exception $e) {
                                    }
                                } else {
                                }

                                try {
                                    $riwayatLib = new Riwayatlib();
                                    $riwayatLib->insert("Menghapus kelengkapan berkas peserta.", "Hapus Berkas", "delete");
                                } catch (\Throwable $th) {
                                }

                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Dokumen " . $nama . " berhasil dihapus.";
                                return json_encode($response);
                            } else {
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Dokumen " . $nama . " gagal dihapus.";
                                return json_encode($response);
                            }
                        } else {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Dokumen " . $nama . " tidak ditemukan.";
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
