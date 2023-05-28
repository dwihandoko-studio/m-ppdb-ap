<?php

namespace App\Libraries;

use App\Libraries\V1\ReferensilayananLib;

class Authlib
{
    private $_db;
    private $tb_user;
    private $tb_profil_user;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->tb_user  = $this->_db->table('_users_tb');
        $this->tb_profil_user  = $this->_db->table('_users_profil_tb');
    }

    private function validate_email($email)
    {
        return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
    }

    public function _getFirUserLogin($id)
    {
        return $this->tb_user->where('id', $id)->get()->getRowObject();
    }

    public function _updatedUserFirsLogin($id)
    {
        return $this->tb_user->where('id', $id)->update(['email_verified' => 1]);
    }

    private function _getUser($id)
    {
        $select = "a.id, b.fullname, b.email, b.no_hp as noHp, b.sekolah_asal, b.latitude, b.longitude, b.nisn, b.profile_picture as imageProfile, b.details, b.dusun, b.role_user as roleUser, a.created_at as createdAt, a.updated_at as updated_at, b.last_active as lastActive, b.kecamatan, c.nama as namaKecamatan, b.provinsi, d.nama as namaProvinsi, b.kabupaten, e.nama as namaKabupaten, b.kelurahan, f.nama as namaKelurahan";
        return $this->_db->table('_users_tb a')
            ->select($select)
            ->join('_users_profil_tb b', 'a.id = b.id', 'LEFT')
            ->join('ref_kecamatan c', 'b.kecamatan = c.id', 'LEFT')
            ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
            ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
            ->join('ref_kelurahan f', 'b.kelurahan = f.id', 'LEFT')
            ->where('a.id', $id)
            ->get()->getRowObject();
    }

    private function _updateLogin($id)
    {
        return $this->tb_profil_user->set('last_active', date('Y-m-d H:i:s'))->where('id', $id)->update();
    }

    public function firsLogin($username, $password)
    {
        $user = $this->tb_user->where('email', $username)->get()->getRowObject();
        if ($user) {
            if (password_verify($password, $user->password) == true) {
                if ((int)$user->is_active == 1) {
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Login Berhasil.";
                    $response->data = $user;
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "User di suspen, silahkan hubungi admin.";
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Password tidak sama.";
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "User tidak ditemukan.";
        }
        return $response;
    }

    public function login($username, $password)
    {
        $user = $this->tb_user->where('email', $username)->get()->getRowObject();
        
        if ($user) {
            if (password_verify($password, $user->password) == true) {
                if ((int)$user->is_active == 1) {
                    // if ((int)$user->email_verified == 1) {
                    $userInfo = $this->_getUser($user->id);
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Login Berhasil.";
                    $response->data = $userInfo;

                    $this->_updateLogin($user->id);
                    // } else {
                    //     $response = new \stdClass;
                    //     $response->code = 202;
                    //     $response->data = $user;
                    //     $response->message = "Akun belum diverifikasi.";
                    // }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "User di suspen, silahkan hubungi admin.";
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Password tidak sama.";
            }
        } else {
            // if ($this->validate_email($username)) {
            //     $referensiLayananlib = new ReferensilayananLib();
            //     $userRegister = $referensiLayananlib->getUser($username);
            //     if ($userRegister->code == 200) {
            //         if ($userRegister->data->code == 200) {
            //             $response = new \stdClass;
            //             $response->code = 204;
            //             $response->message = "User ditemukan. belum masuk aplikasi.";
            //             $response->data = $userRegister->data->data;
            //         } else {
            //             $response = new \stdClass;
            //             $response->code = 400;
            //             $response->message = $userRegister->data->message;
            //             $response->dataerror = $userRegister;
            //         }
            //     } else {
            //         $response = new \stdClass;
            //         $response->code = 400;
            //         $response->message = "User tidak ditemukan dilayanan.";
            //         $response->dataerror = $userRegister;
            //     }
            // } else {
            //     $response = new \stdClass;
            //     $response->code = 400;
            //     $response->message = "User tidak ditemukan.";
            // }
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "User tidak ditemukan. $username";
        }
        return $response;
    }

    public function cekUser($username)
    {
        $user = $this->tb_user->where('email', $username)->get()->getRowObject();

        if ($user) {
            if ((int)$user->email_verified == 1) {
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Login Berhasil.";
                $response->data = $userInfo;
            } else {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Email belum terverifikasi.";
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Email tidak terdaftar.";
        }

        return $response;
    }

    public function changePassword($userId, $pass)
    {
        $user = $this->tb_user->where('id', $userId)->get()->getRowObject();

        if ($user) {
            if (password_verify($pass, $user->password) == true) {
                $response = new \stdClass;
                $response->code = 201;
                $response->message = "Password baru tidak boleh sama dengan password lama.";
            } else {
                $data = [
                    'password' => password_hash($pass, PASSWORD_DEFAULT),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->tb_user->where('id', $user->id)->update($data);
                $result = $this->_db->affectedRows();

                if ($result > 0) {
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Ganti Password Baru Berhasil.";
                } else {
                    $response = new \stdClass;
                    $response->code = 401;
                    $response->message = "Password baru gagal disimpan.";
                }
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "token tidak valid.";
        }

        return $response;
    }

    public function changePasswordAndEmail($userId, $pass, $email)
    {
        $user = $this->tb_user->where('id', $userId)->get()->getRowObject();

        if ($user) {
            $cekEmail = $this->tb_user->where('email', $email)->get()->getRowObject();

            if ($cekEmail) {
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Email sudah di gunakan oleh pengguna lain.";
            } else {
                if (password_verify($pass, $user->password) == true) {
                    $response = new \stdClass;
                    $response->code = 201;
                    $response->message = "Password baru tidak boleh sama dengan password lama.";
                } else {
                    $data = [
                        'email' => $email,
                        'password' => password_hash($pass, PASSWORD_DEFAULT),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    $this->tb_user->where('id', $user->id)->update($data);
                    $result = $this->_db->affectedRows();

                    if ($result > 0) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Registrasi Akun Baru Berhasil.";
                    } else {
                        $response = new \stdClass;
                        $response->code = 401;
                        $response->message = "Registrasi Akun Baru gagal disimpan.";
                    }
                }
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "token tidak valid.";
        }

        return $response;
    }
}
