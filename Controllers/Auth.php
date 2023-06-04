<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Libraries\Authlib;
use App\Libraries\Emaillib;
use App\Libraries\Tokenlib;
use App\Libraries\Maintenancelib;
use App\Libraries\Uuid;
use App\Libraries\V1\ReferensidapodikLib;
use App\Libraries\V1\ReferensilayananLib;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
    private $session;
    private $_db;
    function __construct()
    {
        helper(['text', 'file', 'form', 'cookie', 'session', 'array', 'imageurl', 'web', 'enskripdes', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function index()
    {
        $maintenanceLib = new Maintenancelib();

        $response = $maintenanceLib->cekMaintenance();

        if ($response > 0) {
            return redirect()->to(base_url('maintenance') . '/index');
        }

        // if ($this->request->getMethod() != 'post') {
        require_once APPPATH . "libraries/vendor/autoload.php";

        $google_client = new \Google_Client();
        $google_client->setClientId(getenv('auth.google.clientid'));
        $google_client->setClientSecret(getenv('auth.google.clientsecret'));
        $google_client->setRedirectUri(base_url() . '/auth');
        $google_client->addScope('email');
        $google_client->addScope('profile');

        $urlGoogle = $google_client->createAuthUrl();

        if ($this->request->getGet('code')) {
            return $this->loginWithGoogle($google_client, $this->request->getGet('code'), $urlGoogle);
        } else {

            // if (!(session()->get('access_token'))) {
            $data['loginButton'] = $urlGoogle;
            // }
            // $data = new \stdClass;
            $data['title'] = "Admin Layanan";
            if ($this->request->getGet('statuscode')) {
                $data['statuscode'] = (int)htmlspecialchars($this->request->getGet('statuscode'), true);
            }
            if ($this->request->getGet('message')) {
                $data['message'] = htmlspecialchars($this->request->getGet('message'), true);
            }
            return view('login/index', $data);
        }
    }

    public function register()
    {
        $maintenanceLib = new Maintenancelib();

        $response = $maintenanceLib->cekMaintenance();

        if ($response > 0) {
            return redirect()->to(base_url('maintenance') . '/index');
        }

        // if ($this->request->getMethod() != 'post') {
        require_once APPPATH . "libraries/vendor/autoload.php";

        $google_client = new \Google_Client();
        $google_client->setClientId(getenv('auth.google.clientid'));
        $google_client->setClientSecret(getenv('auth.google.clientsecret'));
        $google_client->setRedirectUri(base_url() . '/auth');
        $google_client->addScope('email');
        $google_client->addScope('profile');

        if ($this->request->getGet('code')) {
            return $this->registerWithGoogle($google_client, $this->request->getGet('code'));
        } else {

            // if (!(session()->get('access_token'))) {
            $data['loginButton'] = $google_client->createAuthUrl();
            // }
            // $data = new \stdClass;
            $data['title'] = "Daftar Layanan";
            $data['provinsis'] = $this->_db->table('ref_provinsi')->orderBy('nama', 'asc')->get()->getResult();
            return view('register/index', $data);
        }
    }

    public function aksiregister()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'jenis' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenis tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
            'prov' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Provinsi tidak boleh kosong. ',
                ]
            ],
            'kab' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kabupaten tidak boleh kosong. ',
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                ]
            ],
            'password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. ',
                    'min_length' => 'Panjang password minimal 6 karakter. ',
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. ',
                    'matches' => 'Ulangi Password tidak sama. ',
                ]
            ],
        ];

        $jenis = htmlspecialchars($this->request->getVar('jenis'), true) ?? "";

        if ($jenis === "") {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Jenis tidak boleh kosong.";
            return json_encode($response);
        }

        $role = "";
        if ($jenis === "umum") {
            $role = 5;
            $rules['kel'] = [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kelurahan tidak boleh kosong. ',
                ]
            ];
            $rules['kec'] = [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong. ',
                ]
            ];
        }

        if ($jenis === "sekolah") {
            $role = 4;
            $rules['sekolah'] = [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Sekolah tidak boleh kosong. ',
                ]
            ];
            $rules['kec'] = [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Kecamatan tidak boleh kosong. ',
                ]
            ];
        }

        if ($jenis === "dinas") {
            $role = 3;
        }

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nohp') . $this->validator->getError('nama') . $this->validator->getError('sekolah') . $this->validator->getError('kel') . $this->validator->getError('kec') . $this->validator->getError('kab') . $this->validator->getError('prov') . $this->validator->getError('jenis') . $this->validator->getError('email') . $this->validator->getError('password') . $this->validator->getError('repassword');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $prov = htmlspecialchars($this->request->getVar('prov'), true);
            $kab = htmlspecialchars($this->request->getVar('kab'), true);
            $kec = htmlspecialchars($this->request->getVar('kec'), true);
            $kel = htmlspecialchars($this->request->getVar('kel'), true);
            $sekolah = htmlspecialchars($this->request->getVar('sekolah'), true);
            $password = htmlspecialchars($this->request->getVar('password'), true);

            $oldData = $this->_db->table('_users_tb')->where('email', $email)->get()->getRowObject();

            if ($oldData) {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Email: $email sudah terdaftar pada layanan kami. Silahkan melakukan login.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_user' => $role,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('_users_tb')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal mendaftarkan user.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                try {
                    unset($data['password']);
                    unset($data['role_user']);
                    $data['fullname'] = $nama;
                    $data['no_hp'] = $nohp;
                    $data['provinsi'] = $prov;
                    $data['kabupaten'] = $kab;
                    $data['kecamatan'] = ($kec === null || $kec === "") ? null : $kec;
                    $data['kelurahan'] = ($kel === null || $kel === "") ? null : $kel;
                    $data['sekolah'] = ($sekolah === null || $sekolah === "") ? null : $kel;

                    $this->_db->table('_users_profil_tb')->insert($data);
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    try {
                        $emailLib = new Emaillib();
                        $emailLib->sendActivation($data['email']);
                    } catch (\Throwable $th) {
                    }

                    $response = new \stdClass;
                    $response->code = 200;
                    $response->data = $data;
                    $response->message = "Registrasi Berhasil. Silahkan cek email anda untuk melakukan verifikasi akun. Jika tidak ada di folder Inbox, silahkan cek di folder spam anda.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }

    private function registerWithGoogle($google_client, $code)
    {
        $token = $google_client->fetchAccessTokenWithAuthCode($code);
        if (!isset($token['error'])) {
            $google_client->setAccessToken($token['access_token']);
            // session()->set('access_token', $token['access_token']);
            //get Profile data
            $google_service = new \Google_Service_Oauth2($google_client);

            $dataGoogle = $google_service->userinfo->get();

            $authModel = new AuthModel($this->_db);
            $cekAnyUserGoogle = $authModel->getByOauthId($dataGoogle['id']);
            if ($cekAnyUserGoogle) {
                //UPDATE
                $dataUpdate = [
                    'google_register' => 1,
                    'oauth_google' => $dataGoogle['id'],
                    'last_login' => date('Y-m-d H:i:s'),
                ];

                $this->_db->transBegin();

                try {
                    $user = $authModel->updateGoogle($dataUpdate, $dataGoogle['id']);
                    if ($user > 0) {
                        $dataProfilUpdate = [
                            'fullname' => $dataGoogle['name'],
                            'email' => $dataGoogle['email'],
                            'profile_picture' => $dataGoogle['picture'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $profile = $authModel->updateProfilGoogle($dataProfilUpdate, $cekAnyUserGoogle->id);

                        if ($profile > 0) {
                            $this->_db->transCommit();

                            $dataUser = [
                                'userId' => $cekAnyUserGoogle->id,
                                'name' => $dataProfilUpdate['fullname'],
                                'email' => $dataProfilUpdate['email'],
                                'profile_picture' => $dataProfilUpdate['profile_picture'],
                                'roleUser' => (int)$cekAnyUserGoogle->role_user,
                                'loginGoogle' => true,
                                'login' => true
                            ];

                            if ($cekAnyUserGoogle->update_firs_login !== null) {
                                $dataUser['completeProfil'] = true;
                            }
                            session()->set($dataUser);

                            return redirect()->to(base_url('dashboard'));
                        } else {
                            $this->_db->transRollback();
                            $data['title'] = "Admin Layanan";
                            $data['errorLogin'] = "Login dengan Google gagal.";
                            return view('login/index', $data);
                        }
                    } else {
                        $this->_db->transRollback();
                        $data['title'] = "Admin Layanan";
                        $data['errorLogin'] = "Login dengan Google gagal.";
                        return view('login/index', $data);
                    }
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $data['title'] = "Admin Layanan";
                    $data['errorLogin'] = "Login dengan Google gagal. " . json_encode($th);
                    return view('login/index', $data);
                }
            } else {
                if ($authModel->getEmail($dataGoogle['email'])) {
                    $data['title'] = "Admin Layanan";
                    $data['errorLogin'] = "Email sudah terdaftar dan belum terkait dengan Akun google anda.";
                    return view('login/index', $data);
                }

                $uuidLib = new Uuid();
                $uuid = $uuidLib->v4();

                $dataInsert = [
                    'id' => $uuid,
                    'google_register' => 1,
                    'oauth_google' => $dataGoogle['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'last_login' => date('Y-m-d H:i:s'),
                ];

                $this->_db->transBegin();

                try {
                    $user = $authModel->insertGoogle($dataInsert);
                    if ($user > 0) {
                        $dataInsertProfil = [
                            'id' => $dataInsert['id'],
                            'email' => $dataGoogle['email'],
                            'fullname' => $dataGoogle['name'],
                            'profile_picture' => $dataGoogle['picture'],
                            'created_at' => $dataInsert['created_at'],
                        ];

                        $userProfil = $authModel->insertProfilGoogle($dataInsertProfil);

                        if ($userProfil > 0) {
                            $this->_db->transCommit();
                            $dataUser = [
                                'userId' => $dataInsertProfil['id'],
                                'name' => $dataInsertProfil['fullname'],
                                'email' => $dataInsertProfil['email'],
                                'profile_picture' => $dataInsertProfil['profile_picture'],
                                'roleUser' => 0,
                                'loginGoogle' => true,
                                'login' => true
                            ];
                            session()->set($dataUser);

                            return redirect()->to(base_url('dashboard'));
                        } else {
                            $this->_db->transRollback();
                            $data['title'] = "Admin Layanan";
                            $data['errorLogin'] = "Login dengan Google gagal.";
                            return view('login/index', $data);
                        }
                    } else {
                        $this->_db->transRollback();
                        $data['title'] = "Admin Layanan";
                        $data['errorLogin'] = "Login dengan Google gagal.";
                        return view('login/index', $data);
                    }
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $data['title'] = "Admin Layanan";
                    $data['errorLogin'] = "Login dengan Google gagal. " . json_encode($th);
                    return view('login/index', $data);
                }
            }
        } else {
            $data['title'] = "Admin Layanan";
            $data['errorLogin'] = json_encode($token['error']);
            return view('login/index', $data);
        }
    }

    private function loginWithGoogle($google_client, $code, $urlGoogle)
    {
        $token = $google_client->fetchAccessTokenWithAuthCode($code);
        if (!isset($token['error'])) {
            $google_client->setAccessToken($token['access_token']);
            // session()->set('access_token', $token['access_token']);
            //get Profile data
            $google_service = new \Google_Service_Oauth2($google_client);

            $dataGoogle = $google_service->userinfo->get();

            $authModel = new AuthModel($this->_db);
            $cekAnyUserGoogle = $authModel->getByOauthId($dataGoogle['id']);
            if ($cekAnyUserGoogle) {
                //UPDATE
                $dataUpdate = [
                    'google_register' => 1,
                    'oauth_google' => $dataGoogle['id'],
                    'last_login' => date('Y-m-d H:i:s'),
                ];

                $this->_db->transBegin();

                try {
                    $user = $authModel->updateGoogle($dataUpdate, $dataGoogle['id']);
                    if ($user > 0) {
                        $dataProfilUpdate = [
                            'fullname' => $dataGoogle['name'],
                            'email' => $dataGoogle['email'],
                            'profile_picture' => $dataGoogle['picture'],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $profile = $authModel->updateProfilGoogle($dataProfilUpdate, $cekAnyUserGoogle->id);

                        if ($profile > 0) {
                            $this->_db->transCommit();

                            $dataUser = [
                                'userId' => $cekAnyUserGoogle->id,
                                'name' => $dataProfilUpdate['fullname'],
                                'email' => $dataProfilUpdate['email'],
                                'profile_picture' => $dataProfilUpdate['profile_picture'],
                                'roleUser' => (int)$cekAnyUserGoogle->role_user,
                                'loginGoogle' => true,
                                'login' => true
                            ];

                            if ($cekAnyUserGoogle->update_firs_login !== null) {
                                $dataUser['completeProfil'] = true;
                            }
                            session()->set($dataUser);

                            return redirect()->to(base_url('dashboard'));
                        } else {
                            $this->_db->transRollback();
                            $data['title'] = "Admin Layanan";
                            $data['loginButton'] = $urlGoogle;
                            $data['errorLogin'] = "Login dengan Google gagal.";
                            return view('login/index', $data);
                        }
                    } else {
                        $this->_db->transRollback();
                        $data['title'] = "Admin Layanan";
                        $data['loginButton'] = $urlGoogle;
                        $data['errorLogin'] = "Login dengan Google gagal.";
                        return view('login/index', $data);
                    }
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $data['title'] = "Admin Layanan";
                    $data['loginButton'] = $urlGoogle;
                    $data['errorLogin'] = "Login dengan Google gagal. " . json_encode($th);
                    return view('login/index', $data);
                }
            } else {
                $user = $this->_db->table('_users_tb')->where('email', $dataGoogle['email'])->get()->getRowObject();
                if ($user) {

                    $data['errorLogin'] = "Login dengan Google gagal. Email sudah terdaftar namun belum dikaitkan dengan akun google anda.";
                } else {
                    $data['errorLogin'] = "Login dengan Google gagal. Email belum terdaftar.";
                }
                $data['title'] = "Admin Layanan";
                $data['loginButton'] = $urlGoogle;
                return view('login/index', $data);
            }
        } else {
            $data['title'] = "Admin Layanan";
            $data['loginButton'] = $urlGoogle;
            $data['errorLogin'] = json_encode($token['error']);
            return view('login/index', $data);
        }
    }

    public function login()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'username' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Username tidak boleh kosong. ',
                ]
            ],
            'password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. ',
                    'min_length' => 'Panjang password minimal 6 karakter. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('username') . $this->validator->getError('password');
            return json_encode($response);
        } else {
            $username = htmlspecialchars($this->request->getVar('username'), true);
            $password = htmlspecialchars($this->request->getVar('password'), true);

            // var_dump($password);die;

            $authLib = new Authlib();
            $result = $authLib->login($username, $password);

            $token_jwt = getenv('token_jwt.default.key');
            if ($result->code == 200) {

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
                        "id" => $result->data->id,
                        "fullname" => $result->data->fullname,
                        "role" => (int)$result->data->roleUser,
                        "compliteProfile" => ($result->data->kelurahan == null || $result->data->kelurahan == "") ? false : true,
                    )
                );

                $token = JWT::encode($token, $token_jwt);
                set_cookie('jwt', $token, strval(3600 * 24));



                // $dataUser = [
                //     'userId' => $result->data->id,
                //     'name' => $result->data->fullname,
                //     'nohp' => $result->data->noHp,
                //     'email' => $result->data->email,
                //     'kabupaten' => $result->data->kabupaten,
                //     'profile_picture' => $result->data->imageProfile,
                //     'roleUser' => (int)$result->data->roleUser,
                //     'login' => true
                // ];
                // if ((int)$result->data->roleUser == 6) {
                //     if ($result->data->dusun == null || $result->data->dusun == "") {
                //         // $dataUser['completeProfil'] = false;
                //     } else {
                //         $dataUser['completeProfil'] = true;
                //     }
                // }
                // if ((int)$result->data->roleUser == 4) {
                //     if ($result->data->dusun == null || $result->data->dusun == "") {
                //         $dataUser['completeProfil'] = true;
                //     } else {
                //         $dataUser['completeProfil'] = true;
                //     }
                // }
                // session()->set($dataUser);

                // return redirect()->to(base_url('auth'));

                $response = new \stdClass;
                $response->code = 200;
                $response->message = 'Login berhasil.';
                if ((int)$result->data->roleUser == 6) {
                    $response->url = base_url('peserta/home');
                } else if ((int)$result->data->roleUser == 4) {
                    $response->url = base_url('sekolah/home');
                } else if ((int)$result->data->roleUser == 3) {
                    $response->url = base_url('dinas/home');
                } else {
                    $response->url = base_url('dashboard');
                }
                return json_encode($response);
                // } else if ($result->code == 201) {
                //     $dataUser = [
                //         'userIdForChange' => $result->data->id,
                //     ];
                //     session()->set($dataUser);

                //     $response = new \stdClass;
                //     $response->code = 201;
                //     $response->url = base_url('auth/newpasswordfirslogin');
                //     $response->message = 'Login berhasil, silahkan lengkapi profil anda terlebih dahulu.';
                //     return json_encode($response);
            } else if ($result->code == 202) {
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
                        "id" => $result->data->id,
                        "fullname" => $result->data->fullname,
                        "role" => (int)$result->data->roleUser,
                        "compliteProfile" => ($result->data->kelurahan == null || $result->data->kelurahan == "") ? false : true,
                    )
                );

                $token = JWT::encode($token, $token_jwt);
                set_cookie('jwt', $token, strval(3600 * 24));
                // $dataUser = [
                //     'userId' => $result->data->id,
                //     'name' => $result->data->fullname,
                //     'nohp' => $result->data->noHp,
                //     'email' => $result->data->email,
                //     'kabupaten' => $result->data->kabupaten,
                //     'profile_picture' => $result->data->imageProfile,
                //     'roleUser' => (int)$result->data->roleUser,
                //     'login' => true
                // ];
                // if ((int)$result->data->roleUser == 6) {
                //     if ($result->data->dusun == null || $result->data->dusun == "") {
                //         $dataUser['completeProfil'] = false;
                //     } else {
                //         $dataUser['completeProfil'] = true;
                //     }
                // }
                // if ((int)$result->data->roleUser == 4) {
                //     if ($result->data->dusun == null || $result->data->dusun == "") {
                //         $dataUser['completeProfil'] = true;
                //     } else {
                //         $dataUser['completeProfil'] = true;
                //     }
                // }
                // session()->set($dataUser);

                // return redirect()->to(base_url('auth'));

                $response = new \stdClass;
                $response->code = 200;
                $response->message = 'Login berhasil.';
                if ((int)$result->data->roleUser == 6) {
                    $response->url = base_url('peserta/home');
                } else if ((int)$result->data->roleUser == 4) {
                    $response->url = base_url('sekolah/home');
                } else if ((int)$result->data->roleUser == 3) {
                    $response->url = base_url('dinas/home');
                } else {
                    $response->url = base_url('dashboard');
                }
                return json_encode($response);
                // $dataUser = [
                //     'userIdForVerification' => $result->data->id,
                //     'emailVerifikasi' => $result->data->email,
                // ];
                // session()->set($dataUser);

                // $response = new \stdClass;
                // $response->code = 202;
                // $response->url = base_url('auth/verifikasiemailfirs');
                // $response->message = 'Email anda belum terverifikasi, silahkan verifikasi email anda terlebih dahulu.';
                // return json_encode($response);
            } else if ($result->code == 204) {
                // $dataLayanan = $result->data;
                // // Aksi Insert
                // $dataInsert = [
                //     'id' => $dataLayanan->id,
                //     'email' => $dataLayanan->email,
                //     'password' => $dataLayanan->password,
                //     'created_at' => date('Y-m-d H:i:s')
                // ];

                // $this->_db->transBegin();

                // try {
                //     $this->_db->table('_users_tb')->insert($dataInsert);
                // } catch (\Throwable $th) {
                //     $this->_db->transRollback();
                //     $response = new \stdClass;
                //     $response->code = 401;
                //     $response->message = "Gagal login dengan mengambil user.";
                //     return json_encode($response);
                // }

                // if ($this->_db->affectedRows() > 0) {
                //     try {
                //         unset($dataInsert['password']);
                //         $dataInsert['fullname'] = $dataLayanan->fullname;
                //         $dataInsert['no_hp'] = $dataLayanan->no_hp;
                //         $dataInsert['role_user'] = $dataLayanan->role_user;
                //         $dataInsert['npsn'] = isset($dataLayanan->npsn) ? $dataLayanan->npsn : null;
                //         $dataInsert['provinsi'] = isset($dataLayanan->provinsi) ? $dataLayanan->provinsi : null;
                //         $dataInsert['kabupaten'] = isset($dataLayanan->kabupaten) ? $dataLayanan->kabupaten : null;
                //         $dataInsert['kecamatan'] = isset($dataLayanan->kecamatan) ? $dataLayanan->kecamatan : null;
                //         $dataInsert['kelurahan'] = isset($dataLayanan->kelurahan) ? $dataLayanan->kelurahan : null;
                //         $dataInsert['sekolah_id'] = isset($dataLayanan->sekolah_id) ? $dataLayanan->sekolah_id : null;
                //         $dataInsert['details'] = json_encode($dataLayanan);

                //         $this->_db->table('_users_profil_tb')->insert($dataInsert);
                //     } catch (\Throwable $th) {
                //         $this->_db->transRollback();
                //         $response = new \stdClass;
                //         $response->code = 401;
                //         $response->message = "Gagal login dengan menyimpan informasi user.";
                //         return json_encode($response);
                //     }

                //     if ($this->_db->affectedRows() > 0) {
                //         $this->_db->transCommit();
                //         $dataUser = [
                //             'userId' => $dataInsert['id'],
                //             'name' => $dataInsert['fullname'],
                //             'nohp' => $dataInsert['noHp'],
                //             'email' => $dataInsert['email'],
                //             'kabupaten' => $dataInsert['kabupaten'],
                //             'provinsi' => $dataInsert['provinsi'],
                //             'kecamatan' => $dataInsert['kecamatan'],
                //             'kelurahan' => $dataInsert['kelurahan'],
                //             'profile_picture' => null,
                //             'roleUser' => (int)$dataInsert['role_user'],
                //             'completeProfil' => false,
                //             'login' => true
                //         ];
                //         session()->set($dataUser);

                //         $response = new \stdClass;
                //         $response->code = 200;
                //         $response->message = 'Login berhasil.';
                //         $response->url = base_url('dashboard');
                //         return json_encode($response);
                //     } else {
                //         $this->_db->transRollback();
                //         $response = new \stdClass;
                //         $response->code = 401;
                //         $response->message = "Gagal login dengan menyimpan informasi user.";
                //         return json_encode($response);
                //     }
                // } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Akun sudah terdaftar di layanan namun belum diintegrasikan ke aplikasi. Silahkan hubungi admin dinas.";
                return json_encode($response);
                // }

                //Aksi Session

                // $dataUser = [
                //     'userIdForVerification' => $result->data->id,
                //     'emailVerifikasi' => $result->data->email,
                // ];
                // session()->set($dataUser);

                // $response = new \stdClass;
                // $response->code = 202;
                // $response->url = base_url('auth/verifikasiemailfirs');
                // $response->message = 'Email anda belum terverifikasi, silahkan verifikasi email anda terlebih dahulu.';
                // return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = $result->message;
                $response->dataerror = $result;
                return json_encode($response);
                // $data['title'] = "Admin Layanan";
                // $data['error'] = $result->message;
                // return view('login/index', $data);
            }
        }
    }

    public function lupapasswordaction()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Akses not allowed.";
            return json_encode($response);
        }

        $rules = [
            'username' => [
                'rules' => 'required|valid_email|trim',
                'errors' => [
                    'required' => 'Username tidak boleh kosong. ',
                    'valid_email' => 'Format email salah. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('username');
            return json_encode($response);
        } else {
            $username = htmlspecialchars($this->request->getVar('username'), true);

            $user = $this->_db->table('_users_tb')->where('email', strtolower($username))->get()->getRowObject();
            if ($user) {

                $emailLib = new Emaillib();
                $send = $emailLib->sendResetPassword($user->email);

                if ($send->code == 200) {

                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = 'Kami sudah mengirimkan link reset passwrod di email anda. Silahkan cek email anda.';
                    return json_encode($response);
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = $send->message;
                    $response->error = $send->error;
                    return json_encode($response);
                }
                // $response = new \stdClass;
                // $response->code = 400;
                // $response->message = $send;
                // return json_encode($response);
                // var_dump($send);die;

            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Email tidak terdaftar.";
                return json_encode($response);
                // $data['title'] = "Admin Layanan";
                // $data['error'] = $result->message;
                // return view('login/index', $data);
            }
        }
    }

    public function lupapassword()
    {
        $data['title'] = "Reset Password Layanan";

        if ($this->request->getMethod() != 'post') {
            return view('login/lupapassword', $data);
        }

        $rules = [
            'username' => [
                'rules' => 'required|valid_email|trim',
                'errors' => [
                    'required' => 'Username tidak boleh kosong. ',
                    'valid_email' => 'Format email salah. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('username');
            return json_encode($response);
        } else {
            $username = htmlspecialchars($this->request->getVar('username'), true);

            $user = $this->_db->table('_users_tb')->where('email', strtolower($username))->get()->getRowObject();
            if ($user) {

                $emailLib = new Emaillib();
                $send = $emailLib->sendResetPassword($user->email);
                $response = new \stdClass;
                $response->code = 200;
                $response->message = $send;
                return json_encode($response);
                // var_dump($send);die;

                $response = new \stdClass;
                $response->code = 200;
                $response->message = 'Kami sudah mengirimkan link reset passwrod di email anda. Silahkan cek email anda.';
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Email tidak terdaftar.";
                return json_encode($response);
                // $data['title'] = "Admin Layanan";
                // $data['error'] = $result->message;
                // return view('login/index', $data);
            }
        }
    }

    public function loginmt()
    {
        $data['title'] = "Admin Layanan";
        return view('login/loginmt', $data);
    }

    public function sukses()
    {
        $data['title'] = "SUKSES";
        return view('login/sukses', $data);
    }

    public function activation()
    {
        if (!$this->request->getGet('user')) {
            return view('404');
        }

        if ($this->request->getMethod() != 'post') {
            $data['user'] = htmlspecialchars($this->request->getGet('user'), true);

            $data['title'] = "Activation User";
            // $data['error'] = "Username tidak terdaftar atau belum terverifikasi.";
            return view('login/activation', $data);
        } else {
            $rules = [
                'id' => 'required|trim',
                'token' => 'required|trim',
            ];

            if (!$this->validate($rules)) {
                // $data = new \stdClass;
                $data['user'] = htmlspecialchars($this->request->getGet('user'), true);
                $data['title'] = "Activation User";
                $data['error'] = $this->validator->getError('email');
                return view('login/activation', $data);
            } else {
                $id = htmlspecialchars($this->request->getVar('id'), true);
                $token = htmlspecialchars($this->request->getVar('token'), true);

                $tokenLib = new Tokenlib();
                $validationToken = $tokenLib->validationToken($id, $token);

                if ($validationToken->code == 200) {
                    $data['title'] = "Aktivasi Akun";
                    $data['message'] = "Aktivasi akun berhasil.";
                    $data['url'] = base_url();
                    return view('login/sukses', $data);
                } else if ($validationToken->code == 401) {
                    $data['user'] = htmlspecialchars($this->request->getGet('user'), true);
                    $data['title'] = "Aktivasi Akun";
                    $data['error'] = $validationToken->message;
                    return view('login/activation', $data);
                } else {
                    $data['user'] = htmlspecialchars($this->request->getGet('user'), true);
                    $data['title'] = "Aktivasi Akun";
                    $data['error'] = $validationToken->message;
                    return view('login/activation', $data);
                }
            }
        }




        // $authLib = new Authlib();
        // $result = false;
        // if ($result) {
        //     return redirect()->to(base_url('auth/sukses'));
        // } else {
        //     $data['title'] = "Reset Password | Slamdung";
        //     $data['error'] = "Username tidak terdaftar atau belum terverifikasi.";
        //     return view('login/resetpassword', $data);
        // }
    }

    public function resendaktivasi()
    {
        if ($this->request->getMethod() != 'post') {
            $data['title'] = "Resend Aktivasi";
            return view('login/resendaktivasi', $data);
        }

        $rules = [
            'email' => 'required|trim',
        ];

        if (!$this->validate($rules)) {
            // $data = new \stdClass;
            $data['title'] = "Resend Aktivasi";
            $data['error'] = $this->validator->getError('email');
            return view('login/resendaktivasi', $data);
        } else {
            $email = htmlspecialchars($this->request->getVar('email'), true);

            $emailLib = new Emaillib();
            $sendEmail = $emailLib->sendActivation($email);

            if ($sendEmail->code == 200) {
                $data['title'] = "Sukses Resend Aktivasi";
                $data['url'] = base_url('auth/activation?user=' . $sendEmail->user->id);
                return view('login/sukses', $data);
            } else {
                $data['title'] = "Send Aktivasi";
                $data['error'] = $sendEmail->message;
                return view('login/resendaktivasi', $data);
            }
        }
    }

    public function resetpassword()
    {
        if ($this->request->getMethod() != 'post') {
            $data['title'] = "Reset Password";
            return view('login/resetpassword', $data);
        }

        $rules = [
            'email' => 'required|trim',
        ];

        if (!$this->validate($rules)) {
            // $data = new \stdClass;
            $data['title'] = "Reset Password";
            $data['error'] = $this->validator->getError('email');
            return view('login/resetpassword', $data);
        } else {
            $username = htmlspecialchars($this->request->getVar('email'), true);

            $authLib = new Authlib();
            $result = $authLib->cekUser($username);
            if ($result->code == 200) {
                $data['title'] = "Reset Password";
                return view('login/sukses', $data);
            } else {
                $data['title'] = "Reset Password";
                $data['error'] = "Username tidak terdaftar atau belum terverifikasi.";
                return view('login/resetpassword', $data);
            }
        }
    }

    public function resetakun()
    {
        if (!$this->request->getGet('token') || !$this->request->getGet('id')) {
            return view('404');
        }

        if ($this->request->getMethod() != 'post') {

            $email = htmlspecialchars($this->request->getGet('id'), true);
            $token = htmlspecialchars($this->request->getGet('token'), true);
            $dataReset = $this->_db->table('_token_activation_tb')->where(['user_id' => $email, 'token' => $token])->orderBy('id', 'DESC')->limit(1)->get()->getRowObject();
            if (!$dataReset) {
                return view('404');
            }

            $today = date("Y-m-d H:i:s");
            $startdate = $dataReset->created_at;

            $today = strtotime($today);
            $enddate = strtotime("+1 week", strtotime($dataReset->created_at));

            if ($today < $enddate) {
                $data['reset'] = $dataReset;
                $data['title'] = "Buat Password Baru";
                return view('login/password-baru', $data);
            }

            return view('404', ['data' => "Token telah expired."]);
        } else {
            return view('404', ['data' => "Permintaan tidak diizinkan."]);
        }
    }

    public function newpassword()
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
            'email' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                ]
            ],
            'password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Kata sandi tidak boleh kosong. ',
                    'min_length' => 'Kata sandi minimal 6 karakter. ',
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Ulangi kata sandi tidak boleh kosong. ',
                    'matches' => 'Kata sandi dan ulangi kata sandi tidak sama. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id') . $this->validator->getError('email') . $this->validator->getError('repassword') . $this->validator->getError('password');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $password = htmlspecialchars($this->request->getVar('password'), true);

            $cekDataReset = $this->_db->table('_token_activation_tb')->where('id', $id)->get()->getRowObject();

            if (!$cekDataReset) {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Data tidak ditemukan";
                return json_encode($response);
            }

            $jumlahUser = $this->_db->table('_users_profil_tb')->where('email', $email)->get()->getResult();

            if (count($jumlahUser) > 0) {
                $dataUpdate = [
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                foreach ($jumlahUser as $key => $value) {
                    $this->_db->table('_users_tb')->where('id', $value->id)->update($dataUpdate);
                }

                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Ganti Password Baru Berhasil.";
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "User tidak ditemukan";
                return json_encode($response);
            }
        }
    }


    public function saveNewFirsLogin()
    {
        if ($this->request->getMethod() != 'post') {

            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        } else {
            $rules = [
                'image' => [
                    'rules' => 'uploaded[image]|max_size[image,512]|mime_in[image,image/jpg,image/jpeg,image/png,application/pdf]',
                    'errors' => [
                        'uploaded' => 'Pilih gambar terlebih dahulu.',
                        'max_size' => 'Ukuran gambar terlalu besar.',
                        'mime_in' => 'Ekstensi yang anda upload tidak diizinkan.'
                    ]
                ],
                'fullname' => [
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => 'Nama tidak boleh kosong.',
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
                'jabatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih jabatan.',
                    ]
                ],
                'jenisKelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Silahkan pilih jenis kelamin.',
                    ]
                ],
                'newPassword' => [
                    'rules' => 'required|min_length[6]',
                    'errors' => [
                        'required' => 'Password tidak boleh kosong.',
                        'min_length' => 'Panjang password minimal 6 karakter.',
                    ]
                ],
                'retypeNewPassword' => [
                    'rules' => 'required|matches[newPassword]',
                    'errors' => [
                        'required' => 'Ulangi Password tidak boleh kosong.',
                        'matches' => 'Password dan ulangi-password tidak sama.',
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $errorMessage = $this->validator->getError('retypeNewPassword') . " " . $this->validator->getError('newPassword') . " " . $this->validator->getError('nohp') . " " . $this->validator->getError('jabatan') . " " . $this->validator->getError('jenisKelamin') . " " . $this->validator->getError('email') . " " . $this->validator->getError('nip') . " " . $this->validator->getError('fullname') . " " . $this->validator->getError('image');
                $response = new \stdClass;
                $response->code = 400;
                $response->message = str_replace("  ", "", $errorMessage);
                return json_encode($response);
            } else {
                $pass = htmlspecialchars($this->request->getVar('newPassword'), true);
                $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
                $jabatan = htmlspecialchars($this->request->getVar('jabatan'), true);
                $jenisKelamin = htmlspecialchars($this->request->getVar('jenisKelamin'), true);
                $email = htmlspecialchars($this->request->getVar('email'), true);
                $nip = htmlspecialchars($this->request->getVar('nip'), true);
                $fullname = htmlspecialchars($this->request->getVar('fullname'), true);
                $token = session()->get('userIdForChange');

                $authLib = new Authlib();
                $curUser = $authLib->_getFirUserLogin($token);



                if ($curUser) {

                    $today = date("Y-m-d H:i:s");
                    $startdate = $curUser->update_firs_login;
                    $offset = strtotime("+5 minutes");
                    $enddate = date($startdate, $offset);

                    // $to_time = strtotime($curUser->update_firs_login);
                    // $from_time = strtotime((string)$today);
                    // $hasilDate = round(abs($to_time - $from_time) / 60,2). " minute";
                    // $hasilDate = (abs($to_time - $from_time) / 60,2) . " minute";

                    $start_date = new \DateTime((string)$today);
                    $since_start = $start_date->diff(new \DateTime((string)$curUser->update_firs_login));

                    $minutes = $since_start->days * 24 * 60;
                    $minutes += $since_start->h * 60;
                    $minutes += $since_start->i;

                    // var_dump($minutes);die;

                    if ($minutes <= 5 && $minutes >= 0) {

                        $dataUpdateProfile = [
                            'fullname' => $fullname,
                            'email' => $email,
                            'no_hp' => $nohp,
                            'jenis_kelamin' => $jenisKelamin,
                            'jabatan' => $jabatan,
                            'nip' => $nip,
                        ];

                        $dir = './upload/user';

                        $cekEmail = $this->_db->table('_users_tb')->where('email', $email)->get()->getRowObject();

                        if ($cekEmail) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "E-mail yang anda masukkan sudah digunakan oleh pengguna lain. Silahkan Gunakan E-mail yang lainnya.";
                            return json_encode($response);
                        }

                        $lampiran = $this->request->getFile('image');
                        $filesNamelampiran = $lampiran->getName();
                        $newNamelampiran = _create_name_foto($filesNamelampiran);

                        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                            // echo "failed";

                            $lampiran->move($dir, $newNamelampiran);
                            $dataUpdateProfile['surat_tugas'] = $newNamelampiran;
                            $this->_db->transBegin();
                            $result = $authLib->changePasswordAndEmail($curUser->id, $pass, $email);

                            if ($result->code == 200) {

                                // $oldDataProfil = $this->_db->table('_profil_users_tb')->where('id', $id)->get()->getRowObject();

                                try {
                                    $buildersu = $this->_db->table('_profil_users_tb');
                                    $buildersu->set($dataUpdateProfile);
                                    $buildersu->where('id', $curUser->id);
                                    $buildersu->update();
                                } catch (Exception $e) {
                                    $this->_db->transRollback();
                                    unlink(FCPATH . $dir . '/' . $newNamelampiran);
                                    $response = new \stdClass;
                                    $response->code = 400;
                                    $response->message = 'Gagal simpan akun try.';
                                    return json_encode($response);
                                }

                                $suks = $this->_db->affectedRows();
                                if ($suks > 0) {
                                    $authLib->_updatedUserFirsLogin($curUser->id);
                                    $this->_db->transCommit();
                                    $response = new \stdClass;
                                    $response->code = 200;
                                    $response->message = "Simpan akun berhasil.";
                                    $response->url = base_url();

                                    session()->remove('userIdForChange');
                                    return json_encode($response);
                                } else {
                                    $this->_db->transRollback();
                                    unlink(FCPATH . $dir . '/' . $newNamelampiran);
                                    $response = new \stdClass;
                                    $response->code = 400;
                                    $response->message = 'Gagal simpan akun.' . $curUser->id;
                                    return json_encode($response);
                                }
                            } else {
                                // echo "Gagal ganti password";
                                unlink(FCPATH . $dir . '/' . $newNamelampiran);
                                $response = new \stdClass;
                                $response->code = 400;
                                $response->message = $result->message;
                                return json_encode($response);
                            }
                        } else {
                            // echo "Gambar tidak terupload";
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gambar tidak terupload";
                            return json_encode($response);
                        }
                    } else {
                        // echo "Session telah expired";
                        $response = new \stdClass;
                        $response->code = 401;
                        $response->message = "Session telah expired";
                        $response->url = base_url();
                        return json_encode($response);
                    }
                } else {
                    // echo "Session telah expired end.";
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Session telah expired end.";
                    $response->url = base_url();
                    return json_encode($response);
                }
            }
        }
    }

    public function newpasswordfirslogin()
    {

        if (session()->get('userIdForChange')) {
            $data['title'] = "Registrasi User";
            return view('login/firslogin', $data);
        } else {
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
    }

    public function verifikasiemailfirs()
    {
        if (session()->get('userIdForVerification')) {
            $data['title'] = "Verifikasi Email User";
            return view('login/verifikasi-email-firs', $data);
        } else {
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
    }

    public function verifikasiEmailUser()
    {
        if ($this->request->getMethod() != 'post') {

            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'token' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Token tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('token');
            return json_encode($response);
        } else {
            $token = htmlspecialchars($this->request->getVar('token'), true);
            $id = session()->get('userIdForVerification');

            $tokenLib = new Tokenlib();
            $validationToken = $tokenLib->validationToken($id, $token);

            if ($validationToken->code === 200) {
                session()->remove(['userIdForVerification', 'emailVerifikasi']);
                $updateVerifikasi = [
                    'email_verified' => 1,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $this->_db->transBegin();
                $this->_db->table('_users_tb')->where('id', $validationToken->user->id)->update($updateVerifikasi);

                if ($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $dataUser = [
                        'userId' => $validationToken->user->id,
                        'name' => $validationToken->user->fullname,
                        'nohp' => $validationToken->user->noHp,
                        'npsn' => $validationToken->user->npsn,
                        'email' => $validationToken->user->email,
                        'profile_picture' => $validationToken->user->imageProfile,
                        'roleUser' => (int)$validationToken->user->roleUser,
                        'login' => true
                    ];
                    session()->set($dataUser);

                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Verifikasi Akun Berhasil.";
                    return json_encode($response);
                    // return redirect()->to(base_url('auth'));
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Update status verifikasi gagal.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = $validationToken->message;
                return json_encode($response);
            }
        }
    }

    public function kirimUlangVerifikasi()
    {
        if ($this->request->getMethod() != 'post') {

            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        if (!session()->get('emailVerifikasi')) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Email tidak ditemukan.";
            return json_encode($response);
        } else {
            $email = session()->get('emailVerifikasi');

            $UserInfo = $this->_db->table('_users_tb')->where('email', $email)->get()->getRowObject();

            if ($UserInfo) {

                $emailLib = new Emaillib();
                $sendEmail = $emailLib->sendActivation($UserInfo->email);

                if ($sendEmail->code == 200) {
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Kode Verifikasi berhasil dikirim, silahkan cek email anda.";
                    return json_encode($response);
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Kirim ulang kode Verifikasi gagal.";
                    return json_encode($response);
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Email user tidak ditemukan.";
                return json_encode($response);
            }
        }
    }


    public function activatedakunold()
    {
        if (!$this->request->getGet('from') || !$this->request->getGet('id') || !$this->request->getGet('token')) {
            $data['fontsize'] = 60;
            $data['code'] = "AKTIVASI AKUN GAGAL";
            $data['content'] = "Token tidak dikenali.";
            return view('v1/404', $data);
        }

        $id = htmlspecialchars($this->request->getGet('id'), true);
        $from = htmlspecialchars($this->request->getGet('from'), true);
        $token = htmlspecialchars($this->request->getGet('token'), true);

        $cekAlreadyActivated = $this->_db->table('_users_tb')->where('id', $id)->get()->getRowObject();

        if (!$cekAlreadyActivated) {
            $data['fontsize'] = 60;
            $data['code'] = "USER TIDAK DITEMUKAN";
            $data['content'] = "Silahkan melakukan pendaftaran terlebih dahulu.";
            return view('v1/404', $data);
        }

        if ((int)$cekAlreadyActivated->verified_email == 1 || (int)$cekAlreadyActivated->verified_nohp == 1) {
            return redirect()->to(base_url('auth'));
        }

        $tokenLib = new Tokenlib();
        $verif = $tokenLib->validationToken($cekAlreadyActivated->id, $token);

        if ($verif->code == 200) {
            if ($from == 'email') {
                $updateUser = [
                    'verified_email' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->_db->table('_users_tb')->where('id', $verif->data->user_id)->update($updateUser);

                if ($this->_db->affectedRows() > 0) {
                    return redirect()->to(base_url('auth') . '/compliteprofil?d=' . $verif->data->user_id);
                } else {
                    $data['id'] = $id;
                    $data['title'] = "Verifikasi Akun Layanan";
                    return view('v1/login/verifikasi-gagal', $data);
                }
            } else {
                $data['id'] = $id;
                $data['title'] = "Verifikasi Akun Layanan";
                return view('v1/login/verifikasi-gagal', $data);
            }
        } else {
            $data['id'] = $id;
            $data['title'] = "Verifikasi Akun Layanan";
            return view('v1/login/verifikasi-gagal', $data);
        }
    }

    public function activatedakun()
    {
        if (!$this->request->getGet('from') || !$this->request->getGet('id') || !$this->request->getGet('token')) {
            $data['fontsize'] = 60;
            $data['code'] = "AKTIVASI AKUN GAGAL";
            $data['content'] = "Token tidak dikenali.";
            return view('v1/404', $data);
        }

        $id = htmlspecialchars($this->request->getGet('id'), true);
        $from = htmlspecialchars($this->request->getGet('from'), true);
        $token = htmlspecialchars($this->request->getGet('token'), true);

        $cekAlreadyActivated = $this->_db->table('_users_tb')->where('id', $id)->get()->getRowObject();

        if (!$cekAlreadyActivated) {
            $data['fontsize'] = 60;
            $data['code'] = "USER TIDAK DITEMUKAN";
            $data['content'] = "Silahkan melakukan pendaftaran terlebih dahulu.";
            return view('v1/404', $data);
        }

        if ((int)$cekAlreadyActivated->email_verified == 1) {
            return redirect()->to(base_url('auth') . '?statuscode=200&message=Email Telah Diverifikasi');
        }

        $tokenLib = new Tokenlib();
        $verif = $tokenLib->validationToken($cekAlreadyActivated->id, $token);

        // var_dump(json_encode($verif));die;

        if ($verif->code == 200) {
            if ($from == 'email') {
                $updateUser = [
                    'email_verified' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->_db->table('_users_tb')->where('id', $cekAlreadyActivated->id)->update($updateUser);

                if ($this->_db->affectedRows() > 0) {
                    return redirect()->to(base_url('auth') . '?statuscode=200&message=Email Berhasil diverifikasi.');
                } else {
                    $data['fontsize'] = 60;
                    $data['code'] = "VERIFIKASI GAGAL";
                    $data['content'] = "Silahkan melakukan login dan kirim ulang kode verifikasi terlebih dahulu.";
                    return view('404', $data);
                }
            } else {
                $data['fontsize'] = 60;
                $data['code'] = "VERIFIKASI GAGAL";
                $data['content'] = "Verifikasi tidak diketahui.";
                return view('404', $data);
            }
        } else {
            $data['id'] = $id;
            $data['title'] = "Verifikasi Akun Layanan";
            $data['message'] = "Silahkan melakukan kirim ulang kode verifikasi akun.";
            return view('login/verifikasi-gagal', $data);
        }
    }

    public function expired()
    {
        session()->destroy();
        return redirect()->to(base_url('auth'));
    }

    public function logout()
    {
        // if ($this->request->getMethod() != 'post') {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Hanya request post yang diperbolehkan";
        //     return json_encode($response);
        // }
        delete_cookie('jwt');
        session()->destroy();
        $response = new \stdClass;
        $response->code = 200;
        $response->message = "Anda berhasil logout.";
        $response->url = base_url('web/home');
        return json_encode($response);
        // return
        //     redirect()->to(base_url('auth'));
    }

    public function getKabupaten()
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

            $data = $this->_db->table('ref_kabupaten')->where('id_provinsi', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getKecamatan()
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

            $data = $this->_db->table('ref_kecamatan')->where('id_kabupaten', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getKelurahan()
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

            $data = $this->_db->table('ref_kelurahan')->where('id_kecamatan', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    public function getSekolah()
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

            $data = $this->_db->table('ref_sekolah')->where('kode_wilayah', $id)->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->data = $data;
            $response->message = "success";
            return json_encode($response);
        }
    }

    // public function getdatasiswa()
    // {
    //     if ($this->request->getMethod() != 'post') {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Permintaan tidak diizinkan";
    //         return json_encode($response);
    //     }

    //     $rules = [
    //         'nisn' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'NISN tidak boleh kosong. ',
    //             ]
    //         ],
    //         'npsn' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'NPSN tidak boleh kosong. ',
    //             ]
    //         ],
    //         'tglLahir' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Tanggal Lahir tidak boleh kosong. ',
    //             ]
    //         ],
    //     ];

    //     if (!$this->validate($rules)) {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = $this->validator->getError('nisn') . $this->validator->getError('npsn') . $this->validator->getError('tglLahir') . $this->validator->getError('namaIbu');
    //         return json_encode($response);
    //     } else {
    //         $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
    //         $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
    //         $tglLahir = htmlspecialchars($this->request->getVar('tglLahir'), true);
    //         $namaIbu = htmlspecialchars($this->request->getVar('namaIbu'), true) ?? "";

    //         $cekUser = $this->_db->table('_users_tb')->where('email', $nisn)->get()->getRowObject();
    //         if ($cekUser) {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "NISN terdeteksi sudah terdaftar di aplikasi. Silahkan untuk melakukan login.";
    //             return json_encode($response);
    //         }

    //         $referensidapodikLib = new ReferensidapodikLib();
    //         $dataSyn = $referensidapodikLib->getDetailSiswa($nisn, $npsn);

    //         // var_dump($dataSyn);
    //         // die;

    //         if ($dataSyn->code == 200) {
    //             if (count($dataSyn->data) > 0) {
    //                 $dataSiswa = $dataSyn->data[0];
    //                 // var_dump($dataSiswa);die;
    //                 // $tingkatAkhirs = [6, 9, 72, 71, 73];
    //                 // $any = in_array((int)$dataSiswa->tingkat_pendidikan, $tingkatAkhirs);
    //                 // if ($any) {
    //                     if ($tglLahir == $dataSiswa->tanggal_lahir) {
    //                         $x['data'] = $dataSiswa;

    //                         // $referensiLayananLib = new ReferensiLayananLib();
    //                         // $dataSekolah = $referensiLayananLib->getSekolah($dataSiswa->sekolah_id);

    //                         $dataSekolah = $this->_db->table('ref_sekolah')->where('id', $dataSiswa->sekolah_id)->get()->getRowObject();

    //                         if ($dataSekolah) {
    //                             // if ($dataSekolah->data->code == 200) {
    //                             $x['sekolah'] = $dataSekolah;
    //                             // }
    //                         }
    //                         $response = new \stdClass;
    //                         $response->code = 200;
    //                         $response->message = "Data ditemukan.";
    //                         $response->data = view('web/page/register/detail', $x);
    //                         return json_encode($response);
    //                     } else {
    //                         $response = new \stdClass;
    //                         $response->code = 400;
    //                         $response->message = "Data terdeteksi tidak sesuai dengan data dapodik. Silahkan hubungi operator sekolah asal.";
    //                         return json_encode($response);
    //                     }
    //                 // } else {
    //                 //     $response = new \stdClass;
    //                 //     $response->code = 400;
    //                 //     $response->message = "Mohon maaf, Data terdeteksi berada bukan di jenjang kelas akhir. Silahkan hubungi operator sekolah asal.";
    //                 //     return json_encode($response);
    //                 // }
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Data tidak ditemukan";
    //                 return json_encode($response);
    //             }
    //         } else {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = $dataSyn->message;
    //             return json_encode($response);
    //         }
    //     }
    // }

    public function getdatasiswa()
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
            'tglLahir' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tanggal Lahir tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn') . $this->validator->getError('npsn') . $this->validator->getError('tglLahir') . $this->validator->getError('namaIbu');
            return json_encode($response);
        } else {
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
            $tglLahir = htmlspecialchars($this->request->getVar('tglLahir'), true);
            $namaIbu = htmlspecialchars($this->request->getVar('namaIbu'), true) ?? "";

            $cekUser = $this->_db->table('_users_tb')->where('email', $nisn)->get()->getRowObject();
            if ($cekUser) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "NISN terdeteksi sudah terdaftar di aplikasi. Silahkan untuk melakukan login.";
                return json_encode($response);
            }

            $referensidapodikLib = new ReferensidapodikLib();
            $dataSyn = $referensidapodikLib->getDetailSiswa($nisn, $npsn);

            // var_dump($dataSyn);
            // die;

            if ($dataSyn->code == 200) {
                if (count($dataSyn->data) > 0) {
                    $dataSiswa = $dataSyn->data[0];
                    // var_dump($dataSiswa);die;
                    // $tingkatAkhirs = [6, 9, 72, 71, 73];
                    // $any = in_array((int)$dataSiswa->tingkat_pendidikan, $tingkatAkhirs);
                    // if ($any) {
                    if ($tglLahir == $dataSiswa->tanggal_lahir) {
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
                        $response->data = view('new-web/template/detail-after-sekolah', $x);
                        return json_encode($response);
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Data terdeteksi tidak sesuai dengan data dapodik. Silahkan hubungi operator sekolah asal.";
                        return json_encode($response);
                    }
                    // } else {
                    //     $response = new \stdClass;
                    //     $response->code = 400;
                    //     $response->message = "Mohon maaf, Data terdeteksi berada bukan di jenjang kelas akhir. Silahkan hubungi operator sekolah asal.";
                    //     return json_encode($response);
                    // }
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

    public function saveregis()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        // $jadwals = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        // if (!$jadwals) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Pendaftaran ppdb belum dibuka.";
        //     return json_encode($response);
        // }

        // $today = date("Y-m-d H:i:s");
        // $startdate = strtotime($today);
        // $enddateAwal = strtotime($jadwal->tgl_awal_pendaftaran_zonasi);

        // if ($startdate < $enddateAwal) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Pendaftaran ppdb belum dibuka.";
        //     return json_encode($response);
        // }

        // $enddateAkhir = strtotime($jadwal->tgl_akhir_pendaftaran_zonasi);
        // if ($startdate > $enddateAkhir) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Pendaftaran ppdb telah ditutup.";
        //     return json_encode($response);
        // }

        // if ($this->request->getMethod() != 'post') {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Pendaftaran belum dibuka.";
        // return json_encode($response);
        // }

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
            'password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Kata sandi tidak boleh kosong. ',
                    'min_length' => 'Panjang kata sandi minimal 6 karakter. ',
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Ulangi kata sandi tidak boleh kosong. ',
                    'matches' => 'Ulangi kata sandi tidak sama. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn') . $this->validator->getError('key') . $this->validator->getError('email') . $this->validator->getError('nohp') . $this->validator->getError('npsn') . $this->validator->getError('password') . $this->validator->getError('repassword');
            return json_encode($response);
        } else {
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $keyD = htmlspecialchars($this->request->getVar('key'), true);

            $key = json_decode(safeDecryptMe($keyD, 'Aswertyuioasdfghjkqwertyuiqwerty'));

            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true) ?? "";
            $password = htmlspecialchars($this->request->getVar('password'), true) ?? "";

            $cekData = $this->_db->table('_users_tb')->where('email', $nisn)->get()->getRowObject();

            if ($cekData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "NISN sudah terdaftar, silahkan login ke aplikasi.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'email' => $nisn,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                // 'role_user' => 6,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('_users_tb')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal mendaftarkan user.";
                return json_encode($response);
            }

            $latitudeInput = ($key->lintang == null || $key->lintang == "" || $key->lintang == "null" || $key->lintang == "NULL") ? "-4.9452477" : $key->lintang;
            $longitudeInput = ($key->bujur == null || $key->bujur == "" || $key->bujur == "null" || $key->bujur == "NULL") ? "103.770643" : $key->bujur;

            if ($this->_db->affectedRows() > 0) {
                try {
                    unset($data['password']);
                    // unset($data['role_user']);
                    unset($data['email']);
                    $data['fullname'] = $key->nama;
                    $data['no_hp'] = $nohp;
                    $data['nisn'] = $nisn;
                    $data['role_user'] = 6;
                    $data['email'] = $email;
                    $data['sekolah_asal'] = $key->sekolah_id;
                    $data['npsn_asal'] = $npsn;
                    $data['latitude'] = $latitudeInput;
                    $data['longitude'] = $longitudeInput;
                    $data['peserta_didik_id'] = $key->peserta_didik_id;
                    $data['details'] = json_encode($key);

                    $this->_db->table('_users_profil_tb')->insert($data);
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
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
                    $response->url = base_url('web/home');
                    $response->message = "Registrasi Berhasil. Silahkan login dengan menggunakan NISN dan password yang barusan anda buat.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }

    public function saveregisschool()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        // $jadwals = $this->_db->table('_setting_jadwal_tb')->get()->getRowObject();

        // if (!$jadwals) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Pendaftaran ppdb belum dibuka.";
        //     return json_encode($response);
        // }

        // $today = date("Y-m-d H:i:s");
        // $startdate = strtotime($today);
        // $enddateAwal = strtotime($jadwal->tgl_awal_pendaftaran_zonasi);

        // if ($startdate < $enddateAwal) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Pendaftaran ppdb belum dibuka.";
        //     return json_encode($response);
        // }

        // $enddateAkhir = strtotime($jadwal->tgl_akhir_pendaftaran_zonasi);
        // if ($startdate > $enddateAkhir) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = "Pendaftaran ppdb telah ditutup.";
        //     return json_encode($response);
        // }

        // if ($this->request->getMethod() != 'post') {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Pendaftaran belum dibuka.";
        // return json_encode($response);
        // }

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
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn')
                . $this->validator->getError('key')
                . $this->validator->getError('npsn');
            return json_encode($response);
        } else {
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $keyD = htmlspecialchars($this->request->getVar('key'), true);

            $key = json_decode(safeDecryptMe($keyD, 'Aswertyuioasdfghjkqwertyuiqwerty'));

            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);

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
                $response->code = 401;
                $response->message = "Gagal mendaftarkan user.";
                return json_encode($response);
            }

            $latitudeInput = ($key->lintang == null || $key->lintang == "" || $key->lintang == "null" || $key->lintang == "NULL") ? "-4.9452477" : $key->lintang;
            $longitudeInput = ($key->bujur == null || $key->bujur == "" || $key->bujur == "null" || $key->bujur == "NULL") ? "103.770643" : $key->bujur;

            if ($this->_db->affectedRows() > 0) {
                try {
                    unset($data['password']);
                    // unset($data['role_user']);
                    unset($data['email']);
                    $data['fullname'] = $key->nama;
                    // $data['no_hp'] = $nohp;
                    $data['nisn'] = $nisn;
                    $data['role_user'] = 6;
                    // $data['email'] = $email;
                    $data['sekolah_asal'] = $key->sekolah_id;
                    $data['npsn_asal'] = $npsn;
                    $data['latitude'] = $latitudeInput;
                    $data['longitude'] = $longitudeInput;
                    $data['peserta_didik_id'] = $key->peserta_didik_id;
                    $data['details'] = json_encode($key);

                    $this->_db->table('_users_profil_tb')->insert($data);
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
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
                    $response->url = base_url('web/home');
                    $response->message = "Registrasi Berhasil. Silahkan login dengan menggunakan NISN dan passwordnya adalah tanggal lahir anda dengan format ddmmyyyy (Example: $pass).";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }

    public function saveregisbelumsekolah()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }
        // if ($this->request->getMethod() != 'post') {
        // $response = new \stdClass;
        // $response->code = 400;
        // $response->message = "Pendaftaran belum dibuka.";
        // return json_encode($response);
        // }

        $rules = [
            'nik' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong. ',
                ]
            ],
            'kk' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'KK tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'tempat_lahir' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tempat lahir tidak boleh kosong. ',
                ]
            ],
            'tgl_lahir' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tanggal lahir tidak boleh kosong. ',
                ]
            ],
            'jk' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Jenis kelamin tidak boleh kosong. ',
                ]
            ],
            'nama_ayah' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama ayah tidak boleh kosong. ',
                ]
            ],
            'nama_ibu' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama ibu tidak boleh kosong. ',
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
            'password' => [
                'rules' => 'required|trim|min_length[6]',
                'errors' => [
                    'required' => 'Kata sandi tidak boleh kosong. ',
                    'min_length' => 'Panjang kata sandi minimal 6 karakter. ',
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Ulangi kata sandi tidak boleh kosong. ',
                    'matches' => 'Ulangi kata sandi tidak sama. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nik') . $this->validator->getError('kk') . $this->validator->getError('nama') . $this->validator->getError('tempat_lahir') . $this->validator->getError('tgl_lahir') . $this->validator->getError('jk') . $this->validator->getError('nama_ayah') . $this->validator->getError('nama_ibu') . $this->validator->getError('email') . $this->validator->getError('nohp') . $this->validator->getError('npsn') . $this->validator->getError('password') . $this->validator->getError('repassword');
            return json_encode($response);
        } else {
            $nik = htmlspecialchars($this->request->getVar('nik'), true);
            $kk = htmlspecialchars($this->request->getVar('kk'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $tempat_lahir = htmlspecialchars($this->request->getVar('tempat_lahir'), true);
            $tgl_lahir = htmlspecialchars($this->request->getVar('tgl_lahir'), true);
            $jk = htmlspecialchars($this->request->getVar('jk'), true);
            $nama_ayah = htmlspecialchars($this->request->getVar('nama_ayah'), true);
            $nama_ibu = htmlspecialchars($this->request->getVar('nama_ibu'), true);

            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true) ?? "";
            $password = htmlspecialchars($this->request->getVar('password'), true) ?? "";

            $cekData = $this->_db->table('_users_tb')->where('email', $nik)->get()->getRowObject();

            if ($cekData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "NIK sudah terdaftar, silahkan login ke aplikasi.";
                return json_encode($response);
            }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'email' => $nik,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                // 'role_user' => 6,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $idsekolah = "4a1512a8-b6ac-11ec-985c-0242ac120002";
            $aktive = "1";
            $kodewilayah = "000100";
            $tingkatpendidikan = "1";
            $tglLahirReplace = str_replace("-", "", $tgl_lahir);
            $tglLahirConvert = substr($tglLahirReplace, 2, 8);

            // 	$totalNisn = $this->_db->table('_users_profil_tb')->select("id, (SELECT COUNT(*) as total FROM _users_profil_tb where LEFT(nisn, 8) = 'BS$tglLahirConvert'")
            $totalNisn = $this->_db->table('_users_profil_tb')->where("LEFT(nisn,8) = 'BS$tglLahirConvert'")->countAllResults();

            if ($totalNisn > 0) {
                $totalSumNisn = $totalNisn + 1;
                if ($totalSumNisn > 9) {
                    $urutNisn = $totalSumNisn;
                } else {
                    $urutNisn = '0' . $totalSumNisn;
                }
            } else {
                $urutNisn = '01';
            }

            $nisnCreate = "BS" . $tglLahirConvert . $urutNisn;

            $this->_db->transBegin();

            try {
                $this->_db->table('_users_tb')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal registrasi user.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {
                $uuidLibNisn = new Uuid();
                $uuidNisn = $uuidLibNisn->v4();

                $detailSiswaD = [
                    'peserta_didik_id' => (string)$uuidNisn,
                    'sekolah_id' => (string)$idsekolah,
                    'kode_wilayah' => (string)$kodewilayah,
                    'nama' => (string)$nama,
                    'tempat_lahir' => (string)$tempat_lahir,
                    'tanggal_lahir' => (string)$tgl_lahir,
                    'jenis_kelamin' => (string)$jk,
                    'nik' => (string)$nik,
                    'nisn' => (string)$nisnCreate,
                    'alamat_jalan' => null,
                    'desa_kelurahan' => null,
                    'rt' => null,
                    'rw' => null,
                    'nama_dusun' => null,
                    'nama_ibu_kandung' => (string)$nama_ibu,
                    'pekerjaan_ibu_kandung' => null,
                    'penghasilan_ibu_kandung' => null,
                    'nama_ayah' => (string)$nama_ayah,
                    'pekerjaan_ayah' => null,
                    'penghasilan_ayah' => null,
                    'nama_wali' => null,
                    'pekerjaan_wali' => null,
                    'penghasilan_wali' => null,
                    'kebutuhan_khusus' => null,
                    'no_kip' => null,
                    'no_pkh' => "",
                    'lintang' => '-5.050143',
                    'bujur' => '105.286190',
                    'aktif' => "1",
                    'tingkat_pendidikan' => (string)$tingkatpendidikan
                ];
                try {
                    unset($data['password']);
                    // unset($data['role_user']);
                    unset($data['email']);
                    $data['fullname'] = $nama;
                    $data['no_hp'] = $nohp;
                    $data['nisn'] = $nisnCreate;
                    $data['role_user'] = 6;
                    $data['email'] = $email;
                    $data['sekolah_asal'] = $idsekolah;
                    $data['npsn_asal'] = '10000001';
                    $data['latitude'] = '-5.050143';
                    $data['longitude'] = '105.286190';
                    $data['peserta_didik_id'] = $uuidNisn;
                    $data['details'] = json_encode($detailSiswaD);

                    $this->_db->table('_users_profil_tb')->insert($data);
                } catch (\Throwable $th) {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
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
                    $response->url = base_url('web/home');
                    $response->message = "Registrasi Berhasil. Silahkan login dengan menggunakan NIK dan password yang barusan anda buat.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Gagal menyimpan informasi user.";
                    return json_encode($response);
                }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }

    public function ceknikregistered()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nik' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong. ',
                ]
            ],
            'kk' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'KK tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nik') . $this->validator->getError('kk');
            return json_encode($response);
        } else {
            $nik = htmlspecialchars($this->request->getVar('nik'), true);
            $kk = htmlspecialchars($this->request->getVar('kk'), true);

            $cekUser = $this->_db->table('_users_profil_tb')->where('nip', $nik)->get()->getRowObject();
            if ($cekUser) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "NIK terdeteksi sudah terdaftar di aplikasi. Silahkan untuk melakukan login.";
                return json_encode($response);
            }

            $x['data'] = [
                'nik' => $nik,
                'kk' => $kk,
            ];

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Data ditemukan";
            $response->data = view('web/page/register/detail-belum-sekolah', $x);
            return json_encode($response);
        }
    }
}
