<?php

namespace App\Libraries;

use App\Libraries\Uuid;

class Fcmlib
{
  var $options = ['timeout' => 3];

  private $_db;
  function __construct()
  {
    helper(['text', 'array', 'filesystem']);
    $this->_db      = \Config\Database::connect();
  }


  public function pushNotifToUser($data)
  {
    return $this->_repushNotifToUser($data);
  }

  private function _repushNotifToUser($data)
  {
    $time = date('Y-m-d') . "T" . date('H:i:s');
    $timeFix = $time . ".000+07:00";
    $date = date('Y-m-d H:i:s');

    $url = "https://fcm.googleapis.com/fcm/send";

    //   $tokenFcm = (getenv('configurasifcm.default.key') == null || getenv('configurasifcm.default.key') == "") ? "AAAARhg838s:APA91bFxZAXjUmx_P-SLwRhF9qDSVPrKkTv6PSQ52uBfd2uJsSROjN6-gjNnHuv25Oda48uTO3EvkMomDK7T-CyBln0st_FFPTMmaR7-eXB8Kow20eyaMFVthXDgN5SPlPfwdXEmRCYW" : getenv('configurasifcm.default.key');

    $tokenFcm = 'AAAAhWE_R_E:APA91bGIIX9buMHQ5Fhp0KPnhoxpUjcMbqNXZe8xhIgBH-y1_72rbH2VDmNwYuYSvTXwPrAUg9zhPIqsWLz2agcmQhSlQE0qcyle4Ms6fXpWL6r35MotgfQXVkZr_OTB-_sJMRPWMrtp';

    $token = "key= " . $tokenFcm;
    $to = $data['send_to'];
    $dataSend = [
      'notification' => [
        'title' => $data['title'],
        'body' => $data['content'],
        // 'icon' => "firebase-logo.png",
        'sound' => 'default',
        // 'click_action' => $data['url']
      ],
      'priority' => 'high',
      // 'to' => 'cJOc74QCSAQ-3UZHH_3GGN:APA91bEcGlKTe-s9F8LCzmXpghLQGKz9S10vstUIS-ivMUmouf8lUBQFT8QxQMLIBgBD4zFc16IZZO4lIP2au0KuemQW2hhTfCJ6DXM-LD80O64K50tisEcIDPZaNrMZQsLrq7ZFYvYt',
      'condition' => "'$to' in topics",
      'data' => $data
    ];

    //   var_dump($dataSend);die;
    //$encoderData = json_encode($dataSend, JSON_UNESCAPED_SLASHES);
    $encoderData = json_encode($dataSend);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encoderData);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $headers = [
      'Authorization:' . $token,
      // 			'Accept: application/json',
      'Content-Type: application/json;'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt(
      $ch,
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

    $server_output = curl_exec($ch);

    //   curl_close ($ch);

    //   var_dump($server_output);die;

    //   return json_decode($server_output);


    $httpCodeCure = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (!curl_errno($ch)) {
      $info = curl_getinfo($ch);

      $result = json_decode($server_output);
      curl_close($ch);
      switch ($http_code = $info['http_code']) {

        case 200:  # OK
          $headerConvert = json_decode(json_encode($headers));
          $inputLogGagal = new \stdClass;
          $inputLogGagal->header = $headerConvert;

          $response = new \stdClass;
          $response->code = $info['http_code'];
          // $response->status_code = $info['http_code'];
          $response->status = "SUCCESS";
          // $response->header = $inputLogGagal;
          $response->data = $result;
          // $response->message = "Ambil referensi provinsi berhasil.";
          return $response;
          break;
        default:
          $headerConvert = json_decode(json_encode($headers));
          $inputLogGagal = new \stdClass;
          $inputLogGagal->header = $headerConvert;

          $response = new \stdClass;
          $response->code = $info['http_code'];
          // $response->status_code = 1000;
          // $response->status = "UNAUTHORIZED";
          $response->message = $result->error;
          return $response;
      }
    } else {
      $inputLogGagal = new \stdClass;
      $inputLogGagal->body = curl_errno($ch);

      curl_close($ch);
      $response = new \stdClass;
      $response->code = 400;
      $response->status = "ERROR";
      $response->message = $inputLogGagal->body . " . HTTP_CODE:" . $httpCodeCure;
      return $response;
    }
  }

  public function subscribeTopic($token, $topic)
  {
    $url = "https://iid.googleapis.com/iid/v1/$token/rel/topics/$topic";
    $key = "key= " . getenv('configurasifcm.default.key');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array());  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $headers = [
      'Authorization:' . $key,
      'Accept: application/json',
      'Content-Type: application/json;'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);

    //print $server_output;die;

    return json_decode($server_output);
  }

  public function pushNotifToAdmin($data)
  {
    $time = date('Y-m-d') . "T" . date('H:i:s');
    $timeFix = $time . ".000+07:00";
    $date = date('Y-m-d H:i:s');

    $url = "https://fcm.googleapis.com/fcm/send";

    $token = "key= " . getenv('configurasifcm.default.key');
    $dataSend = [
      'notification' => [
        'title' => "Portugal vs. Denmark",
        'body' => "5 to 1",
        'icon' => "firebase-logo.png",
        'sound' => 'default',
        // 'click_action' => "http://localhost:8081"
      ],
      'priority' => 'high',
      // 'to' => $data['app_url'],
      'topic' => $data['send_to'],
      'data' => $data
    ];
    //$encoderData = json_encode($dataSend, JSON_UNESCAPED_SLASHES);
    $encoderData = json_encode($dataSend);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $encoderData);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $headers = [
      'Authorization:' . $token,
      'Accept: application/json',
      'Content-Type: application/json; charset=utf-8'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);

    //print $server_output;die;

    return json_decode($server_output);
  }

  public function addTagsUser($level, $akses)
  {
    $dataUsers = $this->_db->table('_profil_users_tb')->select('id', 'fullname')->where('role_user', $level)->get()->getResultObject();
    if (count($dataUsers) > 0) {
      foreach ($dataUsers as $key => $value) {
        $this->_addTagsForAdmin($value->id, $akses);
      }
    }
    return true;
  }


  private function _addTagsForAdmin($userId, $akses)
  {
    $time = date('Y-m-d') . "T" . date('H:i:s');
    $timeFix = $time . ".000+07:00";
    $date = date('Y-m-d H:i:s');

    $url = "https://onesignal.com/api/v1/apps/" . getenv('configurasionesignal.default.id') . "/users/" . $userId;

    $token = "Basic " . getenv('configurasionesignal.default.key');
    $dataSend = [
      'tags' => '{"' . $akses . '":"1"}',
    ];
    //$encoderData = json_encode($dataSend, JSON_UNESCAPED_SLASHES);
    //   $encoderData = json_encode($dataSend);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 500);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($dataSend));  //Post Fields
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $headers = [
      'Authorization:' . $token,
      'Accept: application/json',
      //   	'Content-Type: application/json; charset=utf-8'
      //   	application/x-www-form-urlencoded
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);

    //   print $server_output;die;

    return json_decode($server_output);
  }

  public function setExternalUserId($userId, $onesignalId)
  {
    $url = 'https://onesignal.com/api/v1/players/' . $onesignalId;

    $token = "Basic " . getenv('configurasionesignal.default.key');

    $fields = array(
      'app_id' => '71fd7238-5181-4e0f-b91e-9e64027e3301',
      'external_user_id' => $userId
    );
    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $headers = [
      'Authorization:' . $token,
      'Accept: application/json',
      //   	'Content-Type: application/json; charset=utf-8'
      //   	application/x-www-form-urlencoded
    ];

    //   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $server_output = curl_exec($ch);

    curl_close($ch);

    //   print $server_output;die;

    return json_decode($server_output);
  }

  public function setExternalUserIdWithTag($userId, $tag, $onesignalId)
  {
    $url = 'https://onesignal.com/api/v1/players/' . $onesignalId;

    $token = "Basic " . getenv('configurasionesignal.default.key');

    $tags = array();

    foreach ($tag as $key => $value) {
      $tags[$value] = 'ya';
    }

    $fields = array(
      'app_id' => '71fd7238-5181-4e0f-b91e-9e64027e3301',
      'external_user_id' => $userId,
      'tags' => $tags
    );
    $fields = json_encode($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $server_output = curl_exec($ch);

    curl_close($ch);

    return json_decode($server_output);
  }
}
