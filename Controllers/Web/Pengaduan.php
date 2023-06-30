<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotaModel;
use Config\Services;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;

class Pengaduan extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'cookie', 'session', 'array', 'imageurl', 'web', 'enskripdes', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        // var_dump($user);
        // die;
        if ($user->code == 200) {
            $data['user'] = $user->data;
        }

        $nisn = htmlspecialchars($this->request->getGet('nisn'), true);
        $npsn = htmlspecialchars($this->request->getGet('npsn'), true);

        if ($nisn !== "" && $npsn !== "") {
            $data['nisn'] = $nisn;
            $data['npsn'] = $npsn;
        }

        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/pengaduan', $data);
    }

    public function data()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        // var_dump($user);
        // die;
        if ($user->code == 200) {
            $data['user'] = $user->data;
        }

        $nisn = htmlspecialchars($this->request->getGet('nisn'), true);
        $npsn = htmlspecialchars($this->request->getGet('npsn'), true);

        if ($nisn !== "" && $npsn !== "") {
            $data['nisn'] = $nisn;
            $data['npsn'] = $npsn;
        }

        $data['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $data['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/index-pengaduan', $data);
    }

    public function add()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'email' => [
                'rules' => 'required|trim|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. ',
                    'valid_email' => 'Email tidak valid. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Deskripsi tidak boleh kosong. ',
                ]
            ],
            'tujuan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tujuan tidak boleh kosong. ',
                ]
            ],
            'klasifikasi' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tujuan tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nohp')
                . $this->validator->getError('nama')
                . $this->validator->getError('deskripsi')
                . $this->validator->getError('email')
                . $this->validator->getError('klasifikasi')
                . $this->validator->getError('tujuan');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $email = htmlspecialchars($this->request->getVar('email'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
            $deskripsi = htmlspecialchars($this->request->getVar('deskripsi'), true);
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $npsn = htmlspecialchars($this->request->getVar('npsn'), true);
            $tujuan = htmlspecialchars($this->request->getVar('tujuan'), true);
            $klasifikasi = htmlspecialchars($this->request->getVar('klasifikasi'), true);

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $token = time();

            $data = [
                'id' => $uuid,
                'token' => $token,
                'nama' => $nama,
                'email' => $email,
                'no_hp' => $nohp,
                'deskripsi' => $deskripsi,
                'tujuan' => $tujuan,
                'klasifikasi' => $klasifikasi,
                'nisn' => ($nisn == "-" || $nisn == "" || $nisn == NULL) ? NULL : $nisn,
                'npsn' => ($npsn == "-" || $npsn == "" || $npsn == NULL) ? NULL : $npsn,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('tb_pengaduan')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal mengirim pengaduan.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {

                $this->_db->transCommit();
                // try {
                //     $emailLib = new Emaillib();
                //     $emailLib->sendActivation($data['email']);
                // } catch (\Throwable $th) {
                // }

                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->redirrect = base_url('web/pengaduan/success') . '?id=' . $uuid;
                $response->message = "Pengaduan berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        }
    }

    public function cari()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'tiket' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No tiket tidak boleh kosong. ',
                ]
            ],
            'nohp' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'No handphone tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nohp')
                . $this->validator->getError('tiket');
            return json_encode($response);
        } else {
            $tiket = htmlspecialchars($this->request->getVar('tiket'), true);
            $nohp = htmlspecialchars($this->request->getVar('nohp'), true);

            $data = $this->_db->table('tb_pengaduan')->where(['token' => $tiket, 'no_hp' => $nohp])->get()->getRowObject();
            if ($data) {
                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->redirrect = base_url('web/pengaduan/detail') . '?token=' . $data->token;
                $response->message = "Pengaduan berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Aduan tidak ditemukan.";
                return json_encode($response);
            }
        }
    }

    public function success()
    {
        $id = htmlspecialchars($this->request->getGet('id'), true);
        $data = $this->_db->table('tb_pengaduan')->where('id', $id)->get()->getRowObject();
        if (!$data) {
            return redirect()->to(base_url('web/home'));
        }

        $x['data'] = $data;
        $x['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $x['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/success-pengaduan', $x);
    }

    public function detail()
    {
        $id = htmlspecialchars($this->request->getGet('token'), true);
        $data = $this->_db->table('tb_pengaduan')->where('token', $id)->get()->getRowObject();
        if (!$data) {
            return redirect()->to(base_url('web/home'));
        }

        $x['data'] = $data;
        if ($data->status == 1) {
            $x['comments'] = $this->_db->table('tb_pengaduan_komentar')->where('id_post', $data->id)->orderBy('created_at', 'asc')->get()->getResult();
        }
        $x['page'] = "PPDB ONLINE TA. 2023 - 2024";
        $x['title'] = 'PPDB ONLINE TA. 2023 - 2024';

        return view('new-web/page/detail-pengaduan', $x);
    }

    public function comment()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id_post' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id post tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'komentar' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Komentar tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id_post')
                . $this->validator->getError('nama')
                . $this->validator->getError('komentar');
            return json_encode($response);
        } else {
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $komentar = htmlspecialchars($this->request->getVar('komentar'), true);
            $id_post = htmlspecialchars($this->request->getVar('id_post'), true);

            $posted = $this->_db->table('tb_pengaduan')->where('id', $id_post)->get()->getRowObject();

            if (!$posted) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Aduan tidak ditemukan.";
                return json_encode($response);
            }



            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $token = time();

            $data = [
                'id' => $uuid,
                'id_post' => $id_post,
                'nama' => $nama,
                'komentar' => $komentar,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            if ($posted->status == 0) {
                $this->_db->table('tb_pengaduan')->where('id', $posted->id)->update([
                    'status' => 1,
                    'updated_at' => $data['created_at'],
                ]);
            }

            try {
                $this->_db->table('tb_pengaduan_komentar')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal mengirim komentar.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {


                $this->_db->transCommit();
                // try {
                //     $emailLib = new Emaillib();
                //     $emailLib->sendActivation($data['email']);
                // } catch (\Throwable $th) {
                // }

                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->message = "Komentar berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Gagal menyimpan komentar.";
                return json_encode($response);
            }
        }
    }

    public function webhook()
    {
        header("Content-Type: text/plain");
        /**
         * all data POST sent from  https://jogja.wablas.com
         * you must create URL what can receive POST data
         * we will sent data like this:

         * id = message ID - string
         * phone = sender phone - string
         * message = content of message - string
         * pushName = Sender Name like contact name - string (optional)
         * groupSubject = Group Name - string (optional)
         * timestamp = time send message
         * file = name of the file when receiving media message (optional)
         * url = url file media message (optional)
         * messageType = text/image/document/video/audio/location - string
         * mimeType = type file (optional)
         * deviceId = unix ID device
         * sender = phone number device - integer
         */
        $content = json_decode(file_get_contents('php://input'), true);

        $id = $content['id'];
        $pushName = $content['pushName'];
        $isGroup = $content['isGroup'];
        if ($isGroup == true) {
            return true;
        }
        $message = $content['message'];
        $phone = $content['phone'];
        $messageType = $content['messageType'];
        $file = $content['file'];
        $mimeType = $content['mimeType'];
        $deviceId = $content['deviceId'];
        $sender = $content['sender'];
        $timestamp = $content['timestamp'];

        if ($sender == NULL || $sender == "") {
            $response = new \stdClass;
            $response->message = "Gagal mengirim komentar.";
            return json_encode($response);
        }
        // echo $message;
        $posted = $this->_db->table('tb_pengaduan_test_webhook')->where("no_hp LIKE '%$sender%' AND (status = 0 OR status = 1)")->orderBy('created_at', 'DESC')->get()->getRowObject();

        if (!$posted) {
            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $token = time();

            $data = [
                'id' => $uuid,
                'token' => $token,
                'nama' => $pushName,
                'email' => 'a@text.com',
                'no_hp' => $sender,
                'deskripsi' => $message,
                'tujuan' => 'Via Whatsapp',
                'klasifikasi' => 'Pengaduan Via Whatsapp',
                'nisn' => NULL,
                'npsn' => NULL,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();

            try {
                $this->_db->table('tb_pengaduan_test_webhook')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->message = "Gagal mengirim pengaduan.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {

                $this->_db->transCommit();

                try {
                    $curl = curl_init();
                    $tokenWa = "Pii5tjlkLFPa0mmXRIANDaYpYRBmUgqeIB7Mc96AQbGcghPvOle0iMxIVsmk39OX";
                    $random = true;
                    $payload = [
                        "data" => [
                            [
                                'phone' => $phone,
                                'message' => 'Pengaduan anda berhasil di generate dengan token: ' . $token . ' dengan no hp: ' . $sender . '. Berikut link tautan detail Pengaduan : ' . base_url('web/pengaduan/success') . '?id=' . $uuid,
                            ]
                        ]
                    ];
                    curl_setopt(
                        $curl,
                        CURLOPT_HTTPHEADER,
                        array(
                            "Authorization: $tokenWa",
                            "Content-Type: application/json"
                        )
                    );
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
                    curl_setopt($curl, CURLOPT_URL,  "https://jogja.wablas.com/api/v2/send-message");
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

                    $result = curl_exec($curl);
                    curl_close($curl);
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $response = new \stdClass;
                $response->data = $data;
                $response->redirrect = base_url('web/pengaduan/success') . '?id=' . $uuid;
                $response->message = "Pengaduan berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->message = "Gagal menyimpan user.";
                return json_encode($response);
            }
        } else {
            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $token = time();

            $data = [
                'id' => $uuid,
                'id_post' => $posted->id,
                'nama' => $pushName,
                'komentar' => $message,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            if ($posted->status == 0) {
                $this->_db->table('tb_pengaduan_test_webhook')->where('id', $posted->id)->update([
                    'status' => 1,
                    'updated_at' => $data['created_at'],
                ]);
            }

            try {
                $this->_db->table('tb_pengaduan_komentar_test_webhook')->insert($data);
            } catch (\Throwable $th) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->message = "Gagal mengirim komentar.";
                return json_encode($response);
            }

            if ($this->_db->affectedRows() > 0) {


                $this->_db->transCommit();

                $response = new \stdClass;
                $response->data = $data;
                $response->message = "Komentar berhasil dikirim.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->message = "Gagal menyimpan komentar.";
                return json_encode($response);
            }
        }
    }
}
