<?php

namespace App\Controllers;

use App\Libraries\Profilelib;
use App\Libraries\Notificationlib;
use Firebase\JWT\JWT;


class Notification extends BaseController
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
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {

            try {

                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $builder = $this->_db->table('_notification_tb');
                    if ($role == 3) {
                        $where = "send_to = '$userId' AND readed = 0";
                    } else {
                        $where = "send_to = 'Admin Aproval'  AND readed = 0";
                    }

                    $notifs = $builder->where($where)->get()->getResultObject();

                    if (count($notifs) > 0) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->jumlah = (string)count($notifs);
                        $response->data = $this->_viewContent($notifs);
                        return json_encode($response);
                        // $data['notifs'] = $notifs;
                        // echo view('page/notification/index', $data);
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = "Gagal membuat notifikasi.";
                        return json_encode($response);
                        // return false;
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

    private function _viewContent($notifs)
    {
        $data['notifs'] = $notifs;
        return view('page/notification/index', $data);
    }

    public function detail()
    {
        $token = htmlspecialchars($this->request->getGet('token'), true);
        $builder = $this->_db->table('_notification_tb');
        $data = $builder->where('id', $token)->get()->getRowObject();
        if ($data) {
            $builder->set('readed', 1)->where('id', $data->id)->update();
            return redirect()->to(base_url($data->url));
        } else {
            return redirect()->to(base_url('dashboard'));
        }
    }
}
