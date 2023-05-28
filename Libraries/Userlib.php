<?php

namespace App\Libraries;

class Userlib
{
    private $_db;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }


    private function _send_json($data, $methode)
    {
        $urlendpoint = getenv('apislamdung.default.url') . "v1/" . $methode;

        //var_dump($urlendpoint);

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic dGVzdGNsaWVudDp0ZXN0c2NyZXQ='
        ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 30);


        return $curlHandle;
    }

    public function login($username, $password)
    {
        $data = [
            'username' => $username,
            'password' => $password,
            'grant_type' => 'password'
        ];
        $add         = $this->_send_json($data, "user/login");
        $send_data         = curl_exec($add);

        $result = json_decode($send_data);
        if (isset($result->error)) {
            return false;
        }

        if ($send_data != "false") {
            return $result;
        } else {
            return false;
        }
    }
}
