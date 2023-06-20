<?php

namespace App\Controllers\Dinas\Masterdata;

use App\Controllers\BaseController;
use App\Models\Dinas\Masterdata\PenggunaModel;
use App\Libraries\V1\ReferensidapodikLib;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;

class Pengguna extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'enskripdes', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function getAll()
    {
        $request = Services::request();
        $datamodel = new PenggunaModel($request);
        if ($request->getMethod(true) == 'POST') {
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
            $filterSekolah = htmlspecialchars($request->getVar('filter_sekolah'), true) ?? "";
            $filterLevel = htmlspecialchars($request->getVar('filter_role'), true) ?? "";

            $lists = $datamodel->get_datatables($filterLevel);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                // $logo = ($list->profile_picture === null || $list->profile_picture === "") ? '-' : '<img style="max-width: 60px; max-height: 60px;" alt="Logo Instansi" src="' . base_url('upload/pengguna') . '/' . $list->profile_picture . '">';


                // if($list->id_akun_ptk === null || $list->id_akun_ptk === "") {
                //     $action = '<div class="dropup">
                //             <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                //                 <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                //             </div>
                //             <div class="dropdown-menu">
                //                 <a href="javascript:;" class="dropdown-item action-create-akun" data-id="' . $list->id . '" data-name="' . $list->nama . '">
                //                     <i class="ni ni-key-25"></i>
                //                     <span>Buat Akun PTK</span>
                //                 </a>
                //                 <a href="javascript:;" class="dropdown-item action-reset-password" data-id="' . $list->id . '" data-name="' . $list->nama . '">
                //                     <i class="ni ni-ruler-pencil"></i>
                //                     <span>Edit</span>
                //                 </a>
                //             </div>
                //         </div>';
                // } else {
                $namaTampil = ($list->fullname) ? $list->fullname : "Unknown";
                // $action = '<div class="dropup">
                //         <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                //             <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                //         </div>
                //         <div class="dropdown-menu">
                //             <a href="javascript:actionResetPassword(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                //                 <i class="ni ni-key-25"></i>
                //                 <span>Reset Password</span>
                //             </a>
                //             <a href="javascript:actionUnlockVerification(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                //                 <i class="ni ni-lock-circle-open"></i>
                //                 <span>Buka Update Biodata</span>
                //             </a>
                //             <!--<a href="javascript:actionHapus(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                //                 <i class="fa fa-trash"></i>
                //                 <span>Hapus</span>
                //             </a>-->
                //         </div>
                //     </div>';
                // }

                // if ((int)$list->role_user == 1) {
                //     $status = 'Admin';
                // } else {
                //     $status = '<span class="badge badge-danger">Tidak Aktif</span>';
                // }

                if ((int)$list->edited_map == 1) {
                    $status = '<span class="badge badge-success" onclick="actionUnlockVerification(\'' . $list->id . '\', \' ' . $namaTampil . '\')">Terkunci</span>';
                    $action = '<div class="dropup">
                            <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                            </div>
                            <div class="dropdown-menu">
                                <a href="javascript:actionResetPassword(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                                    <i class="ni ni-key-25"></i>
                                    <span>Reset Password</span>
                                </a>
                                <a href="javascript:actionUnlockVerification(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                                    <i class="ni ni-lock-circle-open"></i>
                                    <span>Buka Update Biodata</span>
                                </a>
                                <!--<a href="javascript:actionHapus(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                                    <i class="fa fa-trash"></i>
                                    <span>Hapus</span>
                                </a>-->
                            </div>
                        </div>';
                } else {
                    $status = '<span class="badge badge-danger"  onclick="actionLock(\'' . $list->id . '\', \' ' . $namaTampil . '\')">Terbuka</span>';
                    $action = '<div class="dropup">
                            <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                            </div>
                            <div class="dropdown-menu">
                                <a href="javascript:actionResetPassword(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                                    <i class="ni ni-key-25"></i>
                                    <span>Reset Password</span>
                                </a>
                                <a href="javascript:actionLock(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                                    <i class="ni ni-lock-circle-open"></i>
                                    <span>Kunci Update Biodata</span>
                                </a>
                                <!--<a href="javascript:actionHapus(\'' . $list->id . '\', \' ' . $namaTampil . '\')" class="dropdown-item">
                                    <i class="fa fa-trash"></i>
                                    <span>Hapus</span>
                                </a>-->
                            </div>
                        </div>';
                }

                // if ((int)$list->email_verified == 1) {
                //     $verified = '<span class="badge badge-success">Verified</span>';
                // } else {
                //     $verified = '<span class="badge badge-danger">Not Verified</span>';
                // }

                $row[] = $no;
                $row[] = $action;
                $row[] = $namaTampil;
                $row[] = $list->npsn;
                $row[] = $list->nama_kecamatan;
                $row[] = $list->username;
                $row[] = $list->role;
                $row[] = $status;

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterLevel),
                "recordsFiltered" => $datamodel->count_filtered($filterLevel),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Manage Pengguna';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['jenjang_sekolas'] = $this->_db->table('ref_bentuk_pendidikan')->whereIn('id', [5,6])->get()->getResult();
        $data['roles'] = $this->_db->table('_role_user')->whereNotIn('id', [1, 4, 3, 6])->orderBy('role', 'asc')->get()->getResultObject();
        $data['levels'] = $this->_db->table('_role_user')->whereNotIn('id', [1])->orderBy('role', 'asc')->get()->getResultObject();
        // $data['sekolahs'] = $this->_db->table('_sekolah_tb')->whereNotIn('id', [10000000])->orderBy('nama_sekolah', 'asc')->get()->getResultObject();

        return view('dinas/masterdata/pengguna/index', $data);
    }

    public function unlock()
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
                    'required' => 'Id tidak boleh kosong.',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);

            $oldData = $this->_db->table('_users_profil_tb')->where('id', $id)->get()->getRowObject();

            if ($oldData) {
                $data = [
                    'edited_map' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->_db->transBegin();
                $this->_db->table('_users_profil_tb')->where('id', $oldData->id)->update($data);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Update Biodata Pengguna An. " . $nama . " berhasil diunlock.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Update Biodata Pengguna An. " . $nama . " gagal diunlock.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pengguna An. " . $nama . " tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    public function add()
    {
        if ($this->request->getMethod() != 'get') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Permintaan diizinkan";
        $response->data = View('dinas/masterdata/pengguna/add-peserta');
        return json_encode($response);
    }

    public function cekData()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nisn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NISN tidak boleh kosong.',
                ]
            ],
            'npsn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NPSN tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn')
                . $this->validator->getError('npsn');
            return json_encode($response);
        } else {
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);

            $cekUser = $this->_db->table('_users_tb')->where('email', $nisn)->get()->getRowObject();
            if ($cekUser) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "NISN terdeteksi sudah terdaftar di aplikasi. Silahkan untuk melakukan login.";
                return json_encode($response);
            }

            $cekPdOnLocal = $this->_db->table('ref_pd_test')->where(['nisn' => $nisn, 'npsn' => $npsn])->get()->getRowObject();
            if ($cekPdOnLocal) {
                $dataSiswa = $cekPdOnLocal;
                if ($dataSiswa->lintang == null || $dataSiswa->lintang == '' || $dataSiswa->lintang == 'null' || $dataSiswa->lintang == 'NULL' || $dataSiswa->lintang == '-') {
                    $dataSiswa->lintang = '0.0';
                    $dataSiswa->bujur = '-0.0';
                }

                $x['data'] = $dataSiswa;

                $dataSekolah = $this->_db->table('ref_sekolah')->where('id', $dataSiswa->sekolah_id)->get()->getRowObject();

                if ($dataSekolah) {
                    $x['sekolah'] = $dataSekolah;
                }
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Data ditemukan.";
                $response->data = View('dinas/masterdata/pengguna/detail-siswa', $x);
                return json_encode($response);
            } else {

                $referensidapodikLib = new ReferensidapodikLib();
                $dataSyn = $referensidapodikLib->getDetailSiswa($nisn, $npsn);

                // var_dump(getenv('ppdb.default.wilayahppdb'), [getenv('api.referensi.dapodik.token')]);
                // die;

                if ($dataSyn->code == 200) {
                    // var_dump($dataSyn);
                    // die;
                    if ($dataSyn->data) {
                        if (is_array($dataSyn->data)) {
                            if (count($dataSyn->data) > 0) {

                                $dataSiswa = $dataSyn->data[0];
                                if (isset($dataSiswa->Keterangan)) {
                                    $response = new \stdClass;
                                    $response->code = 400;
                                    $response->error = $dataSiswa->Keterangan;
                                    $response->message = "Data tidak ditemukan";
                                    return json_encode($response);
                                }

                                if ($dataSiswa->lintang == null || $dataSiswa->lintang == '' || $dataSiswa->lintang == 'null' || $dataSiswa->lintang == '-') {
                                    $dataSiswa->lintang = '0.0';
                                    $dataSiswa->bujur = '-0.0';
                                }

                                $x['data'] = $dataSiswa;

                                // $referensiLayananLib = new ReferensiLayananLib();
                                // $dataSekolah = $referensiLayananLib->getSekolah($dataSiswa->sekolah_id);

                                $dataSekolah = $this->_db->table('ref_sekolah')->where('id', $dataSiswa->sekolah_id)->get()->getRowObject();

                                if ($dataSekolah) {
                                    // if ($dataSekolah->data->code == 200) {
                                    $x['sekolah'] = $dataSekolah;
                                    // }
                                }
                                $response = new \stdClass;
                                $response->code = 200;
                                $response->message = "Data ditemukan.";
                                $response->data = View('dinas/masterdata/pengguna/detail-siswa', $x);
                                return json_encode($response);
                            } else {
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = "Data tidak ditemukan";
                                return json_encode($response);
                            }
                        } else {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = $dataSyn->data->message;
                            return json_encode($response);
                        }
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Data tidak ditemukan";
                        return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = $dataSyn->message;
                    return json_encode($response);
                }
            }
        }
    }

    public function savePenguna()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nisn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NISN tidak boleh kosong. ',
                ]
            ],
            'npsn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NPSN tidak boleh kosong. ',
                ]
            ],
            'key' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Key tidak boleh kosong. ',
                ]
            ],
            'email' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
            'peserta_didik_id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Peserta didik id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn')
                . $this->validator->getError('key')
                . $this->validator->getError('email')
                . $this->validator->getError('nohp')
                . $this->validator->getError('npsn')
                . $this->validator->getError('peserta_didik_id');
            return json_encode($response);
        } else {
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $keyD = htmlspecialchars($this->request->getVar('key'), true);

            $key = json_decode(safeDecryptMe($keyD, 'Aswertyuioasdfghjkqwertyuiqwerty'));

            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true) ?? "";
            $peserta_didik_id = htmlspecialchars($this->request->getVar('peserta_didik_id'), true) ?? "";

            $cekData = $this->_db->table('_users_tb')->where('email', $nisn)->get()->getRowObject();

            if ($cekData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "NISN sudah terdaftar, silahkan login ke aplikasi.";
                return json_encode($response);
            }

            $pass = "12345678";
            try {
                $pass = date("dmY", strtotime($key->tanggal_lahir));
            } catch (\Throwable $th) {
                $pass = "12345678";
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'email' => $nisn,
                'password' => password_hash($pass, PASSWORD_BCRYPT),
                // 'role_user' => 6,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('_users_tb')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal mendaftarkan user.";
                return json_encode($response);
            }

            $latitudeInput = ($key->lintang == null || $key->lintang == "" || $key->lintang == "null" || $key->lintang == "NULL") ? "-4.9452477" : $key->lintang;
            $longitudeInput = ($key->bujur == null || $key->bujur == "" || $key->bujur == "null" || $key->bujur == "NULL") ? "103.770643" : $key->bujur;

            if ($this->_db->affectedRows() > 0) {
                $key->peserta_didik_id = $peserta_didik_id;
                try {
                    unset($data['password']);
                    // unset($data['role_user']);
                    unset($data['email']);
                    $data['fullname'] = $key->nama;
                    // $data['no_hp'] = $nohp;
                    $data['nisn'] = $nisn;
                    $data['role_user'] = 6;
                    $data['email'] = $email;
                    $data['sekolah_asal'] = $key->sekolah_id;
                    $data['npsn_asal'] = $npsn;
                    $data['latitude'] = $latitudeInput;
                    $data['longitude'] = $longitudeInput;
                    $data['peserta_didik_id'] = $peserta_didik_id;
                    $data['details'] = json_encode($key);

                    $this->_db->table('_users_profil_tb')->insert($data);
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    // try {
                    //     $emailLib = new Emaillib();
                    //     $emailLib->sendActivation($data['email']);
                    // } catch (\Throwable $th) {
                    // }

                    unset($data['details']);
                    unset($data['peserta_didik_id']);
                    unset($data['sekolah_asal']);

                    $response = new \stdClass;
                    $response->code = 200;
                    $response->data = $data;
                    $response->url = base_url('dinas/masterdata/pengguna');
                    $response->message = "Registrasi Berhasil. Silahkan login dengan menggunakan NISN dan passwordnya adalah tanggal lahir anda dengan format ddmmyyyy ($pass).";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }

    public function lock()
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
                    'required' => 'Id tidak boleh kosong.',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);

            $oldData = $this->_db->table('_users_profil_tb')->where('id', $id)->get()->getRowObject();

            if ($oldData) {
                $data = [
                    'edited_map' => 1,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->_db->transBegin();
                $this->_db->table('_users_profil_tb')->where('id', $oldData->id)->update($data);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Update Biodata Pengguna An. " . $nama . " berhasil dikunci.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Update Biodata Pengguna An. " . $nama . " gagal dikunci.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pengguna An. " . $nama . " tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    public function addSave()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,512]|mime_in[file,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'mime_in' => 'Ekstensi yang anda upload harus berekstensi gambar.'
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama instansi tidak boleh kosong.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|trim',
                'errors' => [
                    'required' => 'Singkatan instansi tidak boleh kosong.',
                    'valid_email' => 'Silahkan masukkan E-mail dengan valid.',
                ]
            ],
            'nip' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIP / NIK tidak boleh kosong.',
                ]
            ],
            'nohp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Handphone tidak boleh kosong.',
                ]
            ],
            // 			'instansi' => [
            // 				'rules' => 'required',
            // 				'errors' => [
            // 					'required' => 'Silahkan pilih instansi.',
            // 				]
            // 			],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan pilih role.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Silahkan pilih role.',
                    'min_length' => 'Panjang password minimal 6 karakter.',
                ]
            ],
            're_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Silahkan pilih role.',
                    'matches' => 'Password dan re-password tidak sama.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('instansi') . " " . $this->validator->getError('role') . " " . $this->validator->getError('re_password') . " " . $this->validator->getError('password') . " " . $this->validator->getError('nip') . " " . $this->validator->getError('nama') . " " . $this->validator->getError('email') . " " . $this->validator->getError('nohp') . " " . $this->validator->getError('file');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $role = htmlspecialchars($this->request->getVar('role'), true);
            $instansi = ($this->request->getVar('instansi')) ? htmlspecialchars($this->request->getVar('instansi'), true) : "";
            $nip = htmlspecialchars($this->request->getVar('nip'), true);
            $password = htmlspecialchars($this->request->getVar('password'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $status = htmlspecialchars($this->request->getVar('status'), true);

            $cekData = $this->_db->table('_profil_users_tb')->orWhere(['email' => $email])->get()->getRowObject();

            if ($cekData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "E-mail sudah dipakai oleh pengguna lain.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $dataUser = [
                'id' => $uuid,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'email' => $email,
                'email_verified' => 1,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->_db->transBegin();
            $modelUser = $this->_db->table('_users_tb');
            $insertData = $modelUser->insert($dataUser);

            if ($this->_db->affectedRows() > 0) {
                $dataProfile = [
                    'id' => $uuid,
                    'fullname' => $nama,
                    'email' => $dataUser['email'],
                    'nip' => $nip,
                    'no_hp' => $nohp,
                    'kecamatan' => ($instansi == "") ? null : $instansi,
                    'role_user' => $role,
                    'created_at' => $dataUser['created_at'],
                    'updated_at' => $dataUser['updated_at'],
                ];

                if (!file_exists('/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user')) {
                    mkdir('/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user', 0755);
                    $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
                } else {
                    $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
                }

                $lampiran = $this->request->getFile('file');
                $filesNamelampiran = $lampiran->getName();
                $newNamelampiran = _create_name_foto($filesNamelampiran);

                if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                    $lampiran->move($dir, $newNamelampiran);
                    $dataProfile['profile_picture'] = $newNamelampiran;
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal mengupload foto.";
                    return json_encode($response);
                }

                try {
                    $builder = $this->_db->table('_profil_users_tb');
                    $builder->insert($dataProfile);
                } catch (\Throwable $th) {
                    unlink($dir . '/' . $newNamelampiran);
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal menyimpan data";
                    return json_encode($response);
                }

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Tambah pengguna baru berhasil.";
                    $response->url = base_url('v1/admin/masterdata/pengguna');
                    return json_encode($response);
                } else {
                    unlink($dir . '/' . $newNamelampiran);
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal Menyimpan Profil User.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal Menyimpan User.";
                return json_encode($response);
            }
        }
    }


    //     public function addSave() {
    //         if ($this->request->getMethod() != 'post') {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Permintaan tidak diizinkan";
    //             return json_encode($response);
    //         }

    //         $rules = [
    // 			'nama' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Nama PTK tidak boleh kosong.',
    // 				]
    // 			],
    // 			'id' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Id PTK tidak boleh kosong.',
    // 				]
    // 			],
    // 			'password' => [
    // 				'rules' => 'required|min_length[6]',
    // 				'errors' => [
    // 					'required' => 'Silahkan pilih role.',
    // 					'min_length' => 'Panjang password minimal 6 karakter.',
    // 				]
    // 			],
    // 			're_password' => [
    // 				'rules' => 'required|matches[password]',
    // 				'errors' => [
    // 					'required' => 'Silahkan pilih role.',
    // 					'matches' => 'Password dan re-password tidak sama.',
    // 				]
    // 			],
    //         ];

    //         if (!$this->validate($rules)) {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = $this->validator->getError('nama') . " " . $this->validator->getError('id') . " " . $this->validator->getError('password') . " " . $this->validator->getError('re_password');
    //             return json_encode($response);
    //         } else {
    //             $nama = htmlspecialchars($this->request->getVar('nama'), true);
    //             $id = htmlspecialchars($this->request->getVar('id'), true);
    //             $password = htmlspecialchars($this->request->getVar('password'), true);

    //             $oldPtk = $this->_db->table('_ptk_tb')->where(['id' => $id])->get()->getRowObject();

    //             if(!$oldPtk) {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Data PTK tidak ditemukan.";
    //                 return json_encode($response);
    //             }

    //             $cekData = $this->_db->table('_profil_users_tb')->where(['email' => $oldPtk->email])->get()->getRowObject();

    //             if($cekData) {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "E-mail sudah dipakai oleh pengguna lain.";
    //                 return json_encode($response);
    //             }

    //             $uuidLib = new Uuid();
    //             $uuid = $uuidLib->v4();

    //             $dataUser = [
    //                 'id' => $uuid,
    //                 'password' => password_hash($password, PASSWORD_DEFAULT),
    //                 'email' => $oldPtk->email,
    //                 'email_verified' => 0,
    //                 'is_active' => 1,
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ];

    //             $this->_db->transBegin();
    //             $modelUser = $this->_db->table('_users_tb');
    //             $insertData = $modelUser->insert($dataUser);

    //             if($this->_db->affectedRows() > 0) {
    //                 $dataProfile = [
    //                     'id' => $uuid,
    //                     'fullname' => $oldPtk->nama,
    //                     'email' => $dataUser['email'],
    //                     'nip' => ($oldPtk->nip === null || $oldPtk->nip === "" || $oldPtk->nip === "-") ? null : $oldPtk->nip,
    //                     'no_hp' => ($oldPtk->no_hp === null || $oldPtk->no_hp === "" || $oldPtk->no_hp === "-") ? null : $oldPtk->no_hp,
    //                     'npsn' => ($oldPtk->npsn === null || $oldPtk->npsn === "" || $oldPtk->npsn === "-") ? null : $oldPtk->npsn,
    //                     'jenis_kelamin' => ($oldPtk->jenis_kelamin === null || $oldPtk->jenis_kelamin === "" || $oldPtk->jenis_kelamin === "-") ? null : $oldPtk->jenis_kelamin,
    //                     'role_user' => 4,
    //                     'created_at' => $dataUser['created_at'],
    //                     'updated_at' => $dataUser['updated_at'],
    //                 ];

    //                 // if (!file_exists('/www/wwwroot/panel.covid-19.lampungtengahkab.go.id/public/upload/pengguna')) {
    //                 //     mkdir('/www/wwwroot/panel.covid-19.lampungtengahkab.go.id/public/upload/pengguna', 0755);
    //                 //     $dir = '/www/wwwroot/panel.covid-19.lampungtengahkab.go.id/public/upload/pengguna';
    //                 // } else {
    //                 //     $dir = '/www/wwwroot/panel.covid-19.lampungtengahkab.go.id/public/upload/pengguna';
    //                 // }

    //                 // $lampiran = $this->request->getFile('file');
    //                 // $filesNamelampiran = $lampiran->getName();
    //                 // $newNamelampiran = _create_name_foto($filesNamelampiran);

    //                 // if ($lampiran->isValid() && !$lampiran->hasMoved()) {
    //                 //     $lampiran->move($dir, $newNamelampiran);
    //                 //     $dataProfile['profile_picture'] = $newNamelampiran;
    //                 // } else {
    //                 //     $this->_db->transRollback();
    //                 //     $response = new \stdClass;
    //                 //     $response->code = 400;
    //                 //     $response->message = "Gagal mengupload foto.";
    //                 //     return json_encode($response);
    //                 // }

    //                 try {
    //                     $builder = $this->_db->table('_profil_users_tb');
    //                     $builder->insert($dataProfile);

    //                 } catch (\Throwable $th) {
    //                     // unlink($dir . '/' . $newNamelampiran);
    //                     $this->_db->transRollback();
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "Gagal menyimpan data";
    //                     return json_encode($response);
    //                 }

    //                 if($this->_db->affectedRows() > 0) {
    //                     $this->_db->transCommit();
    //                     $response = new \stdClass;
    //                     $response->code = 200;
    //                     $response->message = "Buat akun PTK berhasil.";
    //                     $response->url = base_url('v1/sekolah/masterdata/pengguna');
    //                     return json_encode($response);
    //                 } else {
    //                     // unlink($dir . '/' . $newNamelampiran);
    //                     $this->_db->transRollback();
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "Gagal Menyimpan Profil User.";
    //                     return json_encode($response);
    //                 }
    //             } else {
    //                 $this->_db->transRollback();
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Gagal Menyimpan User.";
    //                 return json_encode($response);
    //             }
    //         }
    //     }

    //     public function delete() {
    //         if ($this->request->getMethod() != 'post') {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Permintaan tidak diizinkan";
    //             return json_encode($response);
    //         }

    //         $rules = [
    //             'id' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Id tidak boleh kosong.',
    // 				]
    // 			],
    //             'nama' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Nama tidak boleh kosong.',
    // 				]
    // 			],
    //             'role' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Role tidak boleh kosong.',
    // 				]
    // 			],
    // 		];

    // 		if (!$this->validate($rules)) {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama') . " " . $this->validator->getError('role');
    //             return json_encode($response);
    //         } else {
    //             $id = htmlspecialchars($this->request->getVar('id'), true);
    //             $nama = htmlspecialchars($this->request->getVar('nama'), true);
    //             $role = htmlspecialchars($this->request->getVar('role'), true);

    //             if((int)$role == 3) {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Anda tidak di izinkan menghapus pengguna dengan level user sekolah. Silahkan gunakan menu RESET AKUN.";
    //                 return json_encode($response);
    //             }

    //             $oldData = $this->_db->table('_profil_users_tb')->where('id', $id)->get()->getRowObject();

    //             if($oldData) {
    //                 $this->_db->transBegin();
    //                 $this->_db->table('_users_tb')->where('id', $oldData->id)->delete();
    //                 if($this->_db->affectedRows() > 0) {
    //                     if($oldData->profile_picture === null || $oldData->profile_picture === "") {

    //                     } else {
    //                         try {
    //                             $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
    //                             unlink($dir . '/' . $oldData->profile_picture);
    //                         } catch (Exception $e) {
    //                         }
    //                     }

    //                     $this->_db->transCommit();
    //                     $response = new \stdClass;
    //                     $response->code = 200;
    //                     $response->message = "Pengguna An. " . $nama . " berhasil dihapus.";
    //                     return json_encode($response);
    //                 } else {
    //                     $this->_db->transRollback();
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "Pengguna An. " . $nama . " gagal dihapus.";
    //                     return json_encode($response);
    //                 }
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Pengguna An. " . $nama . " tidak ditemukan.";
    //                 return json_encode($response);
    //             }
    //         }
    //     }

    public function resetPassword()
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
                    'required' => 'Id tidak boleh kosong.',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong.',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);

            $oldData = $this->_db->table('_users_profil_tb')->where('id', $id)->get()->getRowObject();

            if ($oldData) {
                $data = [
                    'password' => password_hash('123456', PASSWORD_BCRYPT),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $this->_db->transBegin();
                $this->_db->table('_users_tb')->where('id', $oldData->id)->update($data);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $riwayatLib = new Riwayatlib();
                        $riwayatLib->insert("Mereset password pengguna $id", "Mereset Password Pengguna", "submit");
                    } catch (\Throwable $th) {
                    }
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Password Pengguna An. " . $nama . " berhasil direset. Password Default(123456)";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Password Pengguna An. " . $nama . " gagal direset.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pengguna An. " . $nama . " tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    //     public function resetAkun() {
    //         if ($this->request->getMethod() != 'post') {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Permintaan tidak diizinkan";
    //             return json_encode($response);
    //         }

    //         $rules = [
    //             'id' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Id tidak boleh kosong.',
    // 				]
    // 			],
    //             'nama' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Nama tidak boleh kosong.',
    // 				]
    // 			],
    //             'role' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'Role tidak boleh kosong.',
    // 				]
    // 			],
    //             'npsn' => [
    // 				'rules' => 'required|trim',
    // 				'errors' => [
    // 					'required' => 'NPSN tidak boleh kosong.',
    // 				]
    // 			],
    // 		];

    // 		if (!$this->validate($rules)) {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama') . " " . $this->validator->getError('role') . " " . $this->validator->getError('npsn');
    //             return json_encode($response);
    //         } else {
    //             $id = htmlspecialchars($this->request->getVar('id'), true);
    //             $nama = htmlspecialchars($this->request->getVar('nama'), true);
    //             $role = htmlspecialchars($this->request->getVar('role'), true);
    //             $npsn = htmlspecialchars($this->request->getVar('npsn'), true);

    //             $oldData = $this->_db->table('_profil_users_tb')->where('id', $id)->get()->getRowObject();

    //             if($oldData) {
    //                 $sekolah = $this->_db->table('_sekolah_tb')->where('id', $npsn)->get()->getRowObject();
    //                 if(!$sekolah) {
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "Referensi Sekolah Pengguna An. " . $nama . " tidak ditemukan.";
    //                     return json_encode($response);
    //                 }

    //                 if((int)$oldData->role_user == 3) {
    //                     $data = [
    //                         'email' => $npsn,
    //                         'password' => password_hash('123456', PASSWORD_DEFAULT),
    //                         'email_verified' => 0,
    //                         'update_firs_login' => null,
    //                     ];

    //                     $this->_db->transBegin();
    //                     $this->_db->table('_users_tb')->where('id', $oldData->id)->update($data);
    //                     if($this->_db->affectedRows() > 0) {
    //                         $dataU = [
    //                             'fullname' => $sekolah->nama_sekolah,
    //                             'email' => null,
    //                             'nip' => null,
    //                             'no_hp' => null,
    //                             'jenis_kelamin' => null,
    //                             'jabatan' => null,
    //                             'kecamatan' => null,
    //                             'surat_tugas' => null,
    //                             'profile_picture' => null,
    //                             'last_active' => null,
    //                         ];

    //                         $this->_db->table('_profil_users_tb')->where('id', $oldData->id)->update($dataU);
    //                         if($this->_db->affectedRows() > 0) {
    //                             $this->_db->transCommit();
    //                             $response = new \stdClass;
    //                             $response->code = 200;
    //                             $response->message = "Reset Akun Pengguna An. " . $nama . " Berhasil.";
    //                             return json_encode($response);
    //                         } else {
    //                             $this->_db->transRollback();
    //                             $response = new \stdClass;
    //                             $response->code = 400;
    //                             $response->message = "Reset Akun Pengguna An. " . $nama . " Gagal";
    //                             return json_encode($response);
    //                         }
    //                     } else {
    //                         $this->_db->transRollback();
    //                         $response = new \stdClass;
    //                         $response->code = 400;
    //                         $response->message = "Pengguna An. " . $nama . " gagal reset akun.";
    //                         return json_encode($response);
    //                     }
    //                 } else if((int)$oldData->role_user == 4 || (int)$oldData->role_user == 5 || (int)$oldData->role_user == 2 || (int)$oldData->role_user == 6) {
    //                     $this->_db->transBegin();
    //                     $this->_db->table('_users_tb')->where('id', $oldData->id)->delete();
    //                     if($this->_db->affectedRows() > 0) {
    //                         if($oldData->profile_picture === null || $oldData->profile_picture === "") {

    //                         } else {
    //                             try {
    //                                 $dir = '/www/wwwroot/si-utpg.disdikbud.lampungtengahkab.go.id/public/upload/user';
    //                                 unlink($dir . '/' . $oldData->profile_picture);
    //                             } catch (Exception $e) {
    //                             }
    //                         }

    //                         $this->_db->transCommit();
    //                         $response = new \stdClass;
    //                         $response->code = 200;
    //                         $response->message = "Reset Akun Pengguna An. " . $nama . " berhasil.";
    //                         return json_encode($response);
    //                     } else {
    //                         $this->_db->transRollback();
    //                         $response = new \stdClass;
    //                         $response->code = 400;
    //                         $response->message = "Reset Akun Pengguna An. " . $nama . " Gagal.";
    //                         return json_encode($response);
    //                     }
    //                 } else {
    //                     $response = new \stdClass;
    //                     $response->code = 400;
    //                     $response->message = "Role Pengguna An. " . $nama . " tidak ditemukan.";
    //                     return json_encode($response);
    //                 }
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Pengguna An. " . $nama . " tidak ditemukan.";
    //                 return json_encode($response);
    //             }
    //         }
    //     }
}
