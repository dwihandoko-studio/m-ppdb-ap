<?php

namespace App\Controllers\Sekolah;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use Firebase\JWT\JWT;

// header("Access-Control-Allow-Origin: * ");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class Home extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'cookie', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }

    public function index()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();

        if ($user->code != 200) {
            session()->destroy();
            delete_cookie('jwt');
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $cpass = get_cookie('cpas');
        $token_jwt_cpass = getenv('token_jwt.default.key');
        if (!$cpass) {
            $hasChanged = $this->_db->table('_users_tb')->where("id = '{$user->data->id}' AND (update_firs_login IS NULL)")->get()->getRowObject();
            if ($hasChanged) {
                $data['changednow'] = true;
            } else {
                $token_jwt = getenv('token_jwt.default.key');
                $issuer_claim = "THE_CLAIM"; // this can be the servername. Example: https://domain.com
                $audience_claim = "THE_AUDIENCE";
                $issuedat_claim = time(); // issued at
                $notbefore_claim = $issuedat_claim; //not before in seconds
                $expire_claim = $issuedat_claim + (3600 * 24 * 30); // expire time in seconds
                $tokencpas = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "id" => $user->data->id,
                    )
                );

                $tokencpass = JWT::encode($tokencpas, $token_jwt_cpass);
                set_cookie('cpas', $tokencpass, strval(3600 * 24 * 30));
            }
        }

        $cpaspr = get_cookie('cpaspr');
        $token_jwt_cpaspr = getenv('token_jwt.default.key');
        if (!$cpaspr) {
            $hasChangedPRofil = $this->_db->table('_ref_profil_sekolah')->where("id = '{$user->data->sekolah_id}')")->get()->getRowObject();
            if ($hasChangedPRofil) {
                if ($hasChangedPRofil->nama_ks == NULL || $hasChangedPRofil->nama_ks == "") {
                    $data['sprofilc'] = true;
                } else {
                    $issuer_claim_profil = "THE_CLAIM"; // this can be the servername. Example: https://domain.com
                    $audience_claim_profil = "THE_AUDIENCE";
                    $issuedat_claim_profil = time(); // issued at
                    $notbefore_claim_profil = $issuedat_claim_profil; //not before in seconds
                    $expire_claim_profil = $issuedat_claim_profil + (3600 * 24 * 30); // expire time in seconds
                    $tokenccpaspr = array(
                        "iss" => $issuer_claim_profil,
                        "aud" => $audience_claim_profil,
                        "iat" => $issuedat_claim_profil,
                        "nbf" => $notbefore_claim_profil,
                        "exp" => $expire_claim_profil,
                        "data" => array(
                            "id" => $user->data->sekolah_id,
                        )
                    );

                    $tokencpaspr = JWT::encode($tokenccpaspr, $token_jwt_cpaspr);
                    set_cookie('cpaspr', $tokencpaspr, strval(3600 * 24 * 30));
                }
            } else {
                $data['sprofilc'] = true;
            }
        }

        $data['pengumumans'] = $this->_db->table('_tb_info_pengumuman')->where(['tampil' => 1, 'status' => 1])->orderBy('created_at', 'desc')->get()->getResult();

        $data['page'] = "Dashboard";
        $data['file_upload'] = FALSE;
        $data['title'] = 'Dashboard';
        $data['datatables'] = false;

        return view('sekolah/home', $data);
    }


    public function statistik()
    {
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();

        if ($user->code != 200) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $detail = $this->_db->table('ref_sekolah a')
            ->select("a.npsn, a.status_sekolah, a.id, a.bentuk_pendidikan_id, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'ZONASI') as zonasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'AFIRMASI') as afirmasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'MUTASI') as mutasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'PRESTASI') as prestasi_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar_temp WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'SWASTA') as swasta_belum_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'ZONASI') as zonasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'AFIRMASI') as afirmasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'MUTASI') as mutasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'PRESTASI') as prestasi_terverifikasi, (SELECT count(id) FROM _tb_pendaftar WHERE tujuan_sekolah_id_1 = a.id AND via_jalur = 'SWASTA') as swasta_terverifikasi")
            ->where('a.id', $user->data->sekolah_id)
            ->limit(1)
            ->get()
            ->getRowObject();

        if ($detail) {
            $detail->zonasi = (int)$detail->zonasi_terverifikasi + (int)$detail->zonasi_belum_terverifikasi;
            $detail->afirmasi = (int)$detail->afirmasi_terverifikasi + (int)$detail->afirmasi_belum_terverifikasi;
            $detail->mutasi = (int)$detail->mutasi_terverifikasi + (int)$detail->mutasi_belum_terverifikasi;
            $detail->prestasi = (int)$detail->prestasi_terverifikasi + (int)$detail->prestasi_belum_terverifikasi;
            $detail->swasta = (int)$detail->swasta_terverifikasi + (int)$detail->swasta_belum_terverifikasi;

            $detail->total_swasta = $detail->zonasi + $detail->afirmasi + $detail->mutasi + $detail->prestasi + $detail->swasta;
            $detail->total_swasta_terverifikasi = (int)$detail->zonasi_terverifikasi + (int)$detail->afirmasi_terverifikasi + (int)$detail->mutasi_terverifikasi + (int)$detail->prestasi_terverifikasi + (int)$detail->swasta_terverifikasi;
            $detail->total_swasta_belum_terverifikasi = (int)$detail->zonasi_belum_terverifikasi + (int)$detail->afirmasi_belum_terverifikasi + (int)$detail->mutasi_belum_terverifikasi + (int)$detail->prestasi_belum_terverifikasi + (int)$detail->swasta_belum_terverifikasi;

            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Permintaan diizinkan";
            $response->data = $detail;
            return json_encode($response);
        }
    }
}
