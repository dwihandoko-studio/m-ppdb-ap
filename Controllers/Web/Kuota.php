<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Web\KuotaModel;
use App\Models\Web\ZonasiModel;

use App\Models\Web\RekapModel;
use Config\Services;
use App\Libraries\Profilelib;

use App\Models\Dinas\Analisis\ProsesModel;
use App\Models\Dinas\Analisis\ProsessekolahModel;
use App\Models\Dinas\Analisis\ProsessekolahprosesModel;


class Kuota extends BaseController
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

        $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', getenv('ppdb.default.wilayahppdb'))->orderBy('nama', 'asc')->get()->getResult();
        $data['page'] = "PPDB ONLINE TA. 2022 - 2023";
        $data['title'] = 'PPDB ONLINE TA. 2022 - 2023';

        return view('new-web/page/kuota', $data);
    }


    public function getKuotasekolah()
    {
        $request = Services::request();
        $datamodel = new KuotaModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

            $lists = $datamodel->get_datatables($filterKecamatan, $filterJenjang);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                // $row[] = $no;
                $row['button'] = '<button type="button" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                // $row['button'] = '<button type="button" onclick="actionDetailKuota(\'' . $list->id . '\');" style="btn btn-sm btn-primary"><i class="fas fa-search-plus"></i></button>';
                $row['nama'] = $list->nama_sekolah;
                $row['npsn'] = $list->npsn;
                $row['kecamatan'] = $list->nama_kecamatan;
                $row['jumlah'] = (int)$list->zonasi + (int)$list->afirmasi + (int)$list->mutasi + (int)$list->prestasi;
                $row['zonasi'] = $list->zonasi;
                $row['afirmasi'] = $list->afirmasi;
                $row['mutasi'] = $list->mutasi;
                $row['prestasi'] = $list->prestasi;
                $row['id'] = $list->id;


                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filterKecamatan, $filterJenjang),
                "recordsFiltered" => $datamodel->count_filtered($filterKecamatan, $filterJenjang),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }
}
