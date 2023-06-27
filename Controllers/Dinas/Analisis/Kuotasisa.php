<?php

namespace App\Controllers\Dinas\Analisis;

use App\Controllers\BaseController;
use App\Models\Dinas\Analisis\KuotapendaftaranModel;
use App\Models\Dinas\Analisis\ProsessekolahhasilModel;
use App\Models\Dinas\Analisis\ProsessekolahproseshasilModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Prosesluluslib;
use Firebase\JWT\JWT;

class Kuotasisa extends BaseController
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
        $datamodel = new KuotapendaftaranModel($request);

        if ($request->getMethod(true) == 'POST') {
            $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
            $filterKecamatan = htmlspecialchars($request->getVar('filter_kecamatan'), true) ?? "";

            $lists = $datamodel->get_datatables($filterKecamatan, $filterJenjang);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row[] = $no;
                $row[] = ($list->zonasi + $list->afirmasi + $list->mutasi + $list->prestasi);
                $row[] = (($list->zonasi + $list->afirmasi + $list->mutasi + $list->prestasi) - ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta));
                $row[] = ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta);
                $tidakLolos = ($list->terverifikasi_zonasi + $list->terverifikasi_afirmasi + $list->terverifikasi_mutasi + $list->terverifikasi_prestasi) - ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta);
                $row[] = $tidakLolos < 0 ? 0 : $tidakLolos;

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

    public function index()
    {
        $data['title'] = 'Rekapitulasi Data Pelaksanaan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        return view('dinas/analisis/kuotasisa/index', $data);
    }
}
