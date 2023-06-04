<?php

namespace App\Libraries;

use App\Libraries\Tokenlib;

class Emaillib
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

    private function _getUser($email)
    {
        return $this->tb_user->where(['email' => $email])->get()->getRowObject();
    }

    private function _sendEmail($emailTo, $title, $content)
    {
        $email = \Config\Services::email();
        // $email->setFrom('pesawaran.ppdb@ngehoster.com', 'PPDB KAB. PESAWARAN');
        $email->setFrom('pesawaran.ppdb@kntechline.com', 'PPDB KAB. PESAWARAN');
        $email->setTo($emailTo);

        $email->setSubject($title);
        $email->setMessage($content);

        $sendd = $email->send();

        if ($sendd) {
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Kode Aktivasi berhasil dikirim.";
            return $response;
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $email->printDebugger();
            return $response;
        }
    }

    private function _sendEmailNotifikasi($emailTo, $title, $content)
    {
        $email = \Config\Services::email();
        $email->setFrom('pesawaran.ppdb@kntechline.com', 'PPDB KAB. PESAWARAN');
        $email->setTo($emailTo);

        $email->setSubject($title);
        $email->setMessage($content);

        $sendd = $email->send();

        if ($sendd) {
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Email notifikasi berhasil dikirim.";
            return $response;
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $email->printDebugger();
            return $response;
        }
    }

    public function sendActivation($email)
    {
        $user = $this->_getUser($email);

        if ($user) {
            if ((int)$user->email_verified === 0) {

                $tokenLib = new Tokenlib();
                $token = $tokenLib->createTokenActivation($user->id);

                if ($token) {
                    $content = '<table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
                            
                            <tbody><tr>
                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                    <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Halo ' . $email . '</h1>
                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Anda telah memasukkan alamat surat elektronik (surel) <strong><a href="mailto:' . $email . '" target="_blank">' . $email . '</a></strong> sebagai kontak untuk akun PPDB Kab. Pesawaran.
                                        Untuk menyelesaikan proses ini, kami akan melakukan verifikasi untuk memastikan bahwa surel ini milik anda.
                                    </p>

                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Kode untuk memverifikasi email akun PPDB Kab. Pesawaran anda adalah sebagai berikut :
                                    </p>

                                    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%">
                                        <tbody><tr>
                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                    <tbody><tr>
                                                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                <tbody><tr>
                                                                    <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                        <a href="' . base_url() . '/auth/activatedakun?from=email&id=' . $user->id . '&token=' . $token['token'] . '" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1" target="_blank">Verifikasi E-mail</a>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>

                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Mengapa saya terima email ini?<br>
                                        Email ini dikirimkan jika seseroang atau perubahan terjadi atas akun PPDB anda.
                                        Jika anda tidak melakukan perubahan apapun, jangan khawatir.
                                        Akun email anda tidak dapat digunakan sebagai kontak dalam akun PPDB Kab. Pesawaran tanpa verifikasi yang anda lakukan
                                    </p>

                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Terima kasih,<br>
                                        Tim PPDB Kab. Pesawaran
                                    </p>

                                </td>
                            </tr>
                        </tbody></table>';
                    // $content = "Silahkan masukkan kode aktivasi akun ini : <br><div style='display: inline-block;width: 200px;background-color: #000; padding: 5px;color: #fff;text-align: center;font-size: 15px;'><b>" . $token['token'] . "</b></div>";

                    $sended = $this->_sendEmail($user->email, "Kode Aktivasi Akun", $content);

                    if ($sended->code == 200) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $sended;
                        $response->user = $user;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Gagal mengirim kode aktivasi.";
                        $response->error = $sended;
                        return $response;
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal membuat token.";
                    $response->error = '';
                    return $response;
                }
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Email tidak terdaftar, silahkan hubungi admin.";
            $response->error = '';
            return $response;
        }
    }

    public function sendResetPassword($email)
    {
        $user = $this->_getUser($email);

        if ($user) {
            $tokenLib = new Tokenlib();
            $token = $tokenLib->createTokenActivation($user->email);

            if ($token) {
                $content = '<table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
                            
                            <tbody><tr>
                                <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                                    <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Halo ' . $email . '</h1>
                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Anda telah memasukkan alamat surat elektronik (surel) <strong><a href="mailto:' . $email . '" target="_blank">' . $email . '</a></strong> sebagai kontak untuk mereset akun PPDB Kab. Pesawaran.
                                        
                                    </p>

                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Untuk menyelesaikan proses ini, silahkan klik tautan di bawah untuk mereset akun ppdb anda:
                                    </p>

                                    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;margin:30px auto;padding:0;text-align:center;width:100%">
                                        <tbody><tr>
                                            <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                    <tbody><tr>
                                                        <td align="center" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                            <table border="0" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                <tbody><tr>
                                                                    <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box">
                                                                        <a href="' . base_url() . '/auth/resetakun?from=email&id=' . $user->email . '&token=' . $token['token'] . '" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;border-radius:3px;color:#fff;display:inline-block;text-decoration:none;background-color:#3097d1;border-top:10px solid #3097d1;border-right:18px solid #3097d1;border-bottom:10px solid #3097d1;border-left:18px solid #3097d1" target="_blank">Reset Password PPDB</a>
                                                                    </td>
                                                                </tr>
                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>

                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Mengapa saya terima email ini?<br>
                                        Email ini dikirimkan jika seseroang atau perubahan terjadi atas akun PPDB Kab. Pesawaran anda.
                                        Jika anda tidak melakukan perubahan apapun, jangan khawatir.
                                        Akun email anda tidak dapat digunakan sebagai kontak dalam akun PPDB Kab. Pesawaran tanpa verifikasi yang anda lakukan
                                    </p>

                                    <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                                        Terima kasih,<br>
                                        Tim PPDB Kab. Pesawaran
                                    </p>

                                </td>
                            </tr>
                        </tbody></table>';
                // $content = "Silahkan masukkan kode aktivasi akun ini : <br><div style='display: inline-block;width: 200px;background-color: #000; padding: 5px;color: #fff;text-align: center;font-size: 15px;'><b>" . $token['token'] . "</b></div>";

                $sended = $this->_sendEmail($user->email, "Tautan link reset Akun Berhasil di kirim", $content);
                // var_dump($sended);die;

                if ($sended->code == 200) {
                    $response = new \stdClass;
                    $response->code = 200;
                    // $response->data = $sended;
                    $response->user = $user;
                    return $response;
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    // $response->message = $sended->message;
                    $response->message = "Gagal mengirim reset password.";
                    $response->error = $sended->message;
                    return $response;
                }
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal membuat token.";
                $response->error = '';
                return $response;
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Email tidak terdaftar, silahkan hubungi admin.";
            $response->error = '';
            return $response;
        }
    }

    public function sendNotifikasi($email, $judul, $text = '')
    {
        $content = '<table align="center" width="570" cellpadding="0" cellspacing="0" style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;background-color:#ffffff;margin:0 auto;padding:0;width:570px">
                
                <tbody><tr>
                    <td style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;padding:35px">
                        <h1 style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#2f3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">Halo ' . $email . '</h1>
                        <p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                            Anda telah memasukkan alamat surat elektronik (surel) <strong><a href="mailto:' . $email . '" target="_blank">' . $email . '</a></strong> sebagai kontak untuk akun PPDB Kab. Pesawaran.
                        </p>';

        $content    .=  $text;

        $content    .=  '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
                            Terima kasih,<br>
                            Tim PPDB Kab. Pesawaran
                        </p>

                    </td>
                </tr>
            </tbody></table>';

        $sended = $this->_sendEmailNotifikasi($email, $judul, $content);

        if ($sended->code == 200) {
            $response = new \stdClass;
            $response->code = 200;
            $response->data = $sended;
            return $response;
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Gagal mengirim notifikasi.";
            return $response;
        }
    }
}
