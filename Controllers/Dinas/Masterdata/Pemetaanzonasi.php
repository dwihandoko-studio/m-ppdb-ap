<?php

namespace App\Controllers\Dinas\Masterdata;

use App\Controllers\BaseController;
use App\Models\Dinas\Masterdata\ZonasiModel;
use App\Models\Dinas\KuotaModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use Firebase\JWT\JWT;

class Pemetaanzonasi extends BaseController
{
    var $folderImage = 'masterdata';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }
    

    public function getAll()
    {

        $request = Services::request();
        $datamodel = new ZonasiModel($request);

        if ($request->getMethod(true) == 'POST') {
            // $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
            // $filterSekolah = htmlspecialchars($request->getVar('filter_sekolah'), true) ?? "";
            $idSekolah = htmlspecialchars($request->getVar('sekolah_id'), true) ?? "";

            $lists = $datamodel->get_datatables();
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row[] = $no;
                if((int)$list->is_locked === 1) {
                    $status = '<span class="badge badge-success">Verified</span>';
                    // $action .= '<button onclick="actionUnlockVerification(\'' . $list->id . '\', \' ' . $list->nama_sekolah . ' - ' . $list->npsn . '\')" type="button" class="dropdown-item">
                    //             <i class="ni ni-lock-circle-open"></i>
                    //             <span>Unlock Verifikasi</span>
                    //         </button>';
                } else {
                    $status = '<span class="badge badge-danger">Belum</span>';
                    // $action .= '<button onclick="actionVerification(\'' . $list->id . '\', \' ' . $list->nama_sekolah . ' - ' . $list->npsn . '\')" type="button" class="dropdown-item">
                    //             <i class="ni ni-check-bold"></i>
                    //             <span>Verifikasi</span>
                    //         </button>';
                }
                // $row[] = $status;
                $row[] = $list->nama_sekolah . ' (' . $list->npsn_sekolah . ')';
                $row[] = $list->namaDusun;
                $row[] = $list->namaKelurahan;
                $row[] = $list->namaKecamatan;
                $row[] = $list->namaKabupaten;
                $row[] = $list->namaProvinsi;

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        $data['title'] = 'Pemetaan Zonasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['jenjangs'] = $this->_db->table('ref_bentuk_pendidikan')->whereIn('id', [5,6])->get()->getResult();
        // $data['instansis'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/masterdata/zonasi/index', $data);
    }

}
