<?php

namespace App\Libraries\V1;
// use App\Libraries\tte\Historybsrelib;

class ReferensidapodikLib
{
    private $_db;
    private $_session;
    function __construct()
    {
        helper(['text', 'session', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        $this->_session      = \Config\Services::session();
    }

    private function _send_get($url)
    {
        $urlendpoint = getenv('api.referensi.dapodik.url') . $url . '&token=' . getenv('api.referensi.dapodik.token');

        $curlHandle = curl_init($urlendpoint);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 12000);
        curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 12000);

        return $curlHandle;
    }

    public function getDetailSiswa($nisn, $npsn)
    {
        $kodeWiilayah = getenv('ppdb.default.wilayahppdb');
        $add         = $this->_send_get("getSiswa?kode_wilayah=$kodeWiilayah&nisn=$nisn&npsn=$npsn");
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
        
        // var_dump($send_data);die;

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
                    $response->message = "Ambil data siswa berhasil.";
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

    public function synBentukPendidikan()
    {
        $add         = $this->_send_get("getBentukPendidikan?kode_wilayah=120200");
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
                    $response->message = "Ambil referensi provinsi berhasil.";
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

    public function synKabupaten($id)
    {
        $add         = $this->_send_get("getWilayah?kode_wilayah=120200&mst_kode_wilayah=" . $id);
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
                    $response->message = "Ambil referensi provinsi berhasil.";
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

    public function synSekolah($id, $bentuk_pendidikan)
    {
        $add         = $this->_send_get("getSekolah?kode_wilayah=" . $id . "&bentuk_pendidikan_id=" . $bentuk_pendidikan);
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
                    $response->message = "Ambil referensi provinsi berhasil.";
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

    public function synProvinsi()
    {
        $add         = $this->_send_get("getWilayah?kode_wilayah=120200&mst_kode_wilayah=000000");
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
                    $response->message = "Ambil referensi provinsi berhasil.";
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




    public function cekStatusUser($nik)
    {
        $add         = $this->_send_get("api/user/status/{$nik}");
        $send_data         = curl_exec($add);

        if (!curl_errno($add)) {
            $info = curl_getinfo($add);
            curl_close($add);
            switch ($http_code = $info['http_code']) {

                case 200:  # OK
                    return json_decode($send_data);
                    break;
                case 401:
                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = 1000;
                    $response->status = "UNAUTHORIZED";
                    $response->message = "Authorization ke sdk gagal.";
                    return $response;
                    break;
                case 404:
                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = 1000;
                    $response->status = "NOT_FOUND";
                    $response->message = "Url tidak ditemukan.";
                    return $response;
                default:
                    $response = new \stdClass;
                    $response->code = $info['http_code'];
                    $response->status_code = 1000;
                    $response->status = "UNAUTHORIZED";
                    $response->message = "Trafik sedang penuh, silahkan ulangi beberapa saat lagi.";
                    return $response;
            }
        } else {
            curl_close($add);
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

        // $result = json_decode($send_data);
        // if (isset($result->error)) {
        //     return false;
        // }

        // if ($send_data != "false") {
        //     return $result;
        // } else {
        //     return false;
        // }
    }

    public function getRefWilayahLuarKabupaten($kode)
    {
        $add         = $this->_send_get("getWilayah?kode_wilayah=120200&token=CD04B72E-17EB-4C2D-9421-DCF4240C7138&mst_kode_wilayah=$kode");
        $send_data         = curl_exec($add);

        if (!curl_errno($add)) {
            switch ($http_code = curl_getinfo($add, CURLINFO_HTTP_CODE)) {

                case 200:  # OK
                    $result = json_decode($send_data);
                    if (isset($result->error)) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    if ($send_data != "false") {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $result;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    break;
                default:
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

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

    public function getBentukPendidikan()
    {
        $add         = $this->_send_get("getBentukPendidikan?kode_wilayah=120200&token=CD04B72E-17EB-4C2D-9421-DCF4240C7138");
        $send_data         = curl_exec($add);

        if (!curl_errno($add)) {
            switch ($http_code = curl_getinfo($add, CURLINFO_HTTP_CODE)) {

                case 200:  # OK
                    $result = json_decode($send_data);
                    if (isset($result->error)) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    if ($send_data != "false") {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $result;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    break;
                default:
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

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

    public function getRefDataSekolah($jenjang)
    {
        $add         = $this->_send_get("getSekolah?kode_wilayah=120200&token=CD04B72E-17EB-4C2D-9421-DCF4240C7138&bentuk_pendidikan_id=$jenjang");
        $send_data         = curl_exec($add);

        if (!curl_errno($add)) {
            switch ($http_code = curl_getinfo($add, CURLINFO_HTTP_CODE)) {

                case 200:  # OK
                    $result = json_decode($send_data);
                    if (isset($result->error)) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    if ($send_data != "false") {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $result;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    break;
                default:
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

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

    public function getRefDataSekolahLuar($kodewil, $jenjang)
    {
        $add         = $this->_send_get("getSekolah?kode_wilayah=$kodewil&token=CD04B72E-17EB-4C2D-9421-DCF4240C7138&bentuk_pendidikan_id=$jenjang");
        $send_data         = curl_exec($add);

        if (!curl_errno($add)) {
            switch ($http_code = curl_getinfo($add, CURLINFO_HTTP_CODE)) {

                case 200:  # OK
                    $result = json_decode($send_data);
                    if (isset($result->error)) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    if ($send_data != "false") {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $result;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    break;
                default:
                    echo 'Unexpected HTTP code: ', $http_code, "\n";
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

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

    public function getPesertaDidikTingkatAkhir($jenjang, $jenisKelamin)
    {
        $add         = $this->_send_get("getPesertaDidikTingkatAkhir?kode_wilayah=120200&token=CD04B72E-17EB-4C2D-9421-DCF4240C7138&bentuk_pendidikan_id=$jenjang&kode_kabupaten=120200&jenis_kelamin=$jenisKelamin");
        $send_data         = curl_exec($add);

        // $response = new \stdClass;
        //                 $response->code = 400;
        //                 $response->message = $send_data;
        //                 return $response;

        if (!curl_errno($add)) {
            switch ($http_code = curl_getinfo($add, CURLINFO_HTTP_CODE)) {

                case 200:  # OK
                    $result = json_decode($send_data);
                    if (isset($result->error)) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    if ($send_data != "false") {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $result;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    break;
                default:
                    // echo 'Unexpected HTTP code: ', $http_code, "\n";
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = 'Unexpected HTTP code: ' . $http_code;
                    return $response;
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

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

    public function getRefPdNisnNpsn($nisn, $npsn)
    {
        $add         = $this->_send_get("getSiswa?kode_wilayah=120200&token=CD04B72E-17EB-4C2D-9421-DCF4240C7138&nisn=$nisn&npsn=$npsn");
        $send_data         = curl_exec($add);

        // $response = new \stdClass;
        //                 $response->code = 400;
        //                 $response->message = $send_data;
        //                 return $response;

        if (!curl_errno($add)) {
            switch ($http_code = curl_getinfo($add, CURLINFO_HTTP_CODE)) {

                case 200:  # OK
                    $result = json_decode($send_data);
                    if (isset($result->error)) {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    if ($send_data != "false") {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->data = $result;
                        return $response;
                    } else {
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = $result->error;
                        return $response;
                    }

                    break;
                default:
                    // echo 'Unexpected HTTP code: ', $http_code, "\n";
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = 'Unexpected HTTP code: ' . $http_code;
                    return $response;
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $add;
            return $response;
        }

        // var_dump($send_data); die;

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






    // public function getUser($username)
    // {
    //     $data = [
    //         'username' => $username
    //     ];
    //     $add         = $this->_send_post($data, "profiluser/user");
    //     $send_data         = curl_exec($add);

    //     // var_dump($send_data); die;

    //     $result = json_decode($send_data);
    //     if (isset($result->error)) {
    //         return false;
    //     }

    //     if ($send_data != "false") {
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }

    // public function profileUser($userId, $accessToken, $refreshToken)
    // {
    //     $add         = $this->_send_get("profiluser/detail?id=" . $userId, $accessToken, $refreshToken);
    //     $send_data         = curl_exec($add);

    //     // var_dump($send_data);die;

    //     $result = json_decode($send_data);
    //     if (isset($result->error)) {
    //         if($result->error == "invalid_token" && $result->error_description == "The access token provided has expired") {
    //             $refreshed = $this->_requestRefreshToken($refreshToken);
    //             if($refreshed != false) {
    //                 $addRetry         = $this->_send_get("profiluser/detail?id=" . $userId, $refreshed->access_token, $refreshed->refresh_token);
    //                 $send_data_retry         = curl_exec($addRetry);

    //                 $resultRetry = json_decode($send_data_retry);
    //                 if (isset($resultRetry->error)) {
    //                     return false;
    //                 }
    //                 if ($send_data_retry != "false") {
    //                     $resultRetry->access_token = $refreshed->access_token;
    //                     $resultRetry->refresh_token = $refreshed->refresh_token;
    //                     return $resultRetry;
    //                 } else {
    //                     return false;
    //                 }
    //             } else {
    //                 return false;
    //             }
    //         } else {
    //             return false;
    //         }
    //     }

    //     if ($send_data != "false") {
    //         $result->access_token = $accessToken;
    //         $result->refresh_token = $refreshToken;
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }


    // private function _send_refresh_token($data, $methode)
    // {
    //     $urlendpoint = getenv('api.default.url') . "v1/" . $methode;

    //     //var_dump($urlendpoint);

    //     $curlHandle = curl_init($urlendpoint);
    //     curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
    //     curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
    //     curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($curlHandle, CURLOPT_HTTPHEADER, array(
    //         'Authorization: Basic dGVzdGNsaWVudDp0ZXN0c2NyZXQ='
    //     ));
    //     curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
    //     curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, 30);


    //     return $curlHandle;
    // }

    // private function _requestRefreshToken($refreshToken)
    // {
    //     $data = [
    //         'refresh_token' => $refreshToken,
    //         'grant_type' => 'refresh_token'
    //     ];
    //     $add         = $this->_send_refresh_token($data, "user/login");
    //     $send_data         = curl_exec($add);

    //     $result = json_decode($send_data);


    //     if (isset($result->error)) {
    //         return false;
    //     }

    //     if ($result) {
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }

}
