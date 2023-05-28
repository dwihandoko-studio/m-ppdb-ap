<?php

namespace App\Libraries\V1;
// use App\Libraries\V1\ReferensilayananLib;

class ReferensilayananLib
{
    private $_db;
    private $_session;
    function __construct()
    {
        helper(['text', 'session', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->_session      = \Config\Services::session();
    }


    private function _send_post($data, $methode)
    {
        $url = (getenv('apilayanan.default.url') === null || getenv('apilayanan.default.url') === "") ? 'https://api.layanan.kntechline.id' : getenv('apilayanan.default.url');
        // $url = "https://api.layanan.kntechline.id";
        $urlendpoint = $url . $methode;
        $key = (getenv('apilayanan.default.key') === null || getenv('apilayanan.default.key') === "") ? 'dGVzdGNsaWVudDp0ZXN0c2NyZXQ=' : getenv('apilayanan.default.key');
        // $key = 'dGVzdGNsaWVudDp0ZXN0c2NyZXQ=';
        //var_dump($urlendpoint);

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . $key,
        ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 30);


        return $curlHandle;
    }

    private function _send_post_upload($data, $methode)
    {
        $urlendpoint = getenv('apibsre.default.url') . $methode;

        $curlHandle = curl_init($urlendpoint);
        // curl_setopt($curlHandle, CURLOPT_UPLOAD, false);
        // curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        // curl_setopt($curlHandle, CURLOPT_HEADER, true);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode(getenv('apibsre.default.user') . ":" . getenv('apibsre.default.secret')),
            'Content-Type:multipart/form-data'
        ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 12000);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 12000);


        return $curlHandle;
    }

    private function _send_get($url)
    {
        $urlendpoint = getenv('api.referensi.dapodik.url') . $url . '&token=' . getenv('api.referensi.dapodik.token');

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "GET");
        // curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
        //     // 'Authorization: Bearer ' . $accessToken
        //     'Authorization: Basic '. base64_encode(getenv('api.referensi.dapodik.user') . ":" . getenv('api.secret'))
        // ));
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 12000);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 12000);

        return $curlHandle;
    }

    public function getSekolah($id)
    {
        $request = ['id' => $id];
        $add         = $this->_send_post($request, "/data/getSekolah");
        $headers = [];
        curl_setopt(
            $add,
            CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                    return $len;

                $headers[strtolower(trim($header[0]))] = trim($header[1]);

                return $len;
            }
        );
        $send_data         = curl_exec($add);

        // var_dump($send_data);
        // die;

        $httpCodeCure = curl_getinfo($add, CURLINFO_HTTP_CODE);

        if (!curl_errno($add)) {
            $info = curl_getinfo($add);

            $result = json_decode($send_data);
            curl_close($add);
            switch ($http_code = $info['http_code']) {

                case 200:  # OK
                    $headerConvert = json_decode(json_encode($headers));
                    $inputLogGagal = new \stdClass;
                    $inputLogGagal->header = $headerConvert;

                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = $info['http_code'];
                    $response->status = "SUCCESS";
                    $response->header = $inputLogGagal;
                    $response->data = $result;
                    $response->message = "Ambil data sekolah berhasil.";
                    return $response;
                    break;
                default:
                    $headerConvert = json_decode(json_encode($headers));
                    $inputLogGagal = new \stdClass;
                    $inputLogGagal->header = $headerConvert;

                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = 1000;
                    $response->status = "UNAUTHORIZED";
                    $response->message = $result->error;
                    return $response;
            }
        } else {
            $inputLogGagal = new \stdClass;
            $inputLogGagal->body = curl_errno($add);

            curl_close($add);
            $response = new \stdClass;
            $response->code = 400;
            $response->status = "ERROR";
            $response->message = $inputLogGagal->body . " . HTTP_CODE:" . $httpCodeCure;
            return $response;
        }
    }

    public function getUser($email)
    {
        $request = ['email' => $email, 'wilayah_ppdb' => ((getenv('ppdb.default.wilayahppdb') === null || getenv('ppdb.default.wilayahppdb') === "") ? '' : getenv('ppdb.default.wilayahppdb'))];
        $add         = $this->_send_post($request, "/data/getUser");
        $headers = [];
        curl_setopt(
            $add,
            CURLOPT_HEADERFUNCTION,
            function ($curl, $header) use (&$headers) {
                $len = strlen($header);
                $header = explode(':', $header, 2);
                if (count($header) < 2) // ignore invalid headers
                    return $len;

                $headers[strtolower(trim($header[0]))] = trim($header[1]);

                return $len;
            }
        );
        $send_data         = curl_exec($add);

        // var_dump($send_data);
        // die;

        $httpCodeCure = curl_getinfo($add, CURLINFO_HTTP_CODE);

        if (!curl_errno($add)) {
            $info = curl_getinfo($add);

            $result = json_decode($send_data);
            curl_close($add);
            switch ($http_code = $info['http_code']) {

                case 200:  # OK
                    $headerConvert = json_decode(json_encode($headers));
                    $inputLogGagal = new \stdClass;
                    $inputLogGagal->header = $headerConvert;

                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = $info['http_code'];
                    $response->status = "SUCCESS";
                    $response->header = $inputLogGagal;
                    $response->data = $result;
                    $response->message = "Ambil data sekolah berhasil.";
                    return $response;
                    break;
                default:
                    $headerConvert = json_decode(json_encode($headers));
                    $inputLogGagal = new \stdClass;
                    $inputLogGagal->header = $headerConvert;

                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = 1000;
                    $response->status = "UNAUTHORIZED";
                    $response->message = $result->error;
                    return $response;
            }
        } else {
            $inputLogGagal = new \stdClass;
            $inputLogGagal->body = curl_errno($add);

            curl_close($add);
            $response = new \stdClass;
            $response->code = 400;
            $response->status = "ERROR";
            $response->message = $inputLogGagal->body . " . HTTP_CODE:" . $httpCodeCure;
            return $response;
        }
    }
}
