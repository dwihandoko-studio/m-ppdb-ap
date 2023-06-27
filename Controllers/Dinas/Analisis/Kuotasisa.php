<?php

namespace App\Controllers\Dinas\Analisis;

use App\Controllers\BaseController;
use App\Models\Dinas\Analisis\KuotapendaftaranModel;
use App\Models\Dinas\Analisis\KuotapendaftarandetailModel;
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
                $action = '
                            <a target="_blank" href="' . base_url('dinas/analisis/kuotasisa/detail') . '?token=' . $list->sekolah_id . '" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>';

                $row[] = $action;
                $row[] = $no;
                $row[] = '<p>' . $list->nama_sekolah . '<br/>' . $list->nama_kecamatan . '</p>';
                $row[] = $list->npsn;
                $row[] = ($list->zonasi + $list->afirmasi + $list->mutasi + $list->prestasi);
                $row[] = (($list->zonasi + $list->afirmasi + $list->mutasi + $list->prestasi) - ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta));
                $row[] = ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta);
                $tidakLolos = ($list->terverifikasi_zonasi + $list->terverifikasi_afirmasi + $list->terverifikasi_mutasi + $list->terverifikasi_prestasi) - ($list->diterima_zonasi + $list->diterima_afirmasi + $list->diterima_mutasi + $list->diterima_prestasi + $list->diterima_swasta);
                $row[] = $tidakLolos < 0 ? 0 : $tidakLolos;
                $row[] = ($list->terverifikasi_zonasi + $list->terverifikasi_afirmasi + $list->terverifikasi_mutasi + $list->terverifikasi_prestasi + $list->terverifikasi_swasta);

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

    public function getAllDetail()
    {
        $request = Services::request();
        $datamodel = new KuotapendaftarandetailModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenis'), true) ?? "";
        $filterJalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";
        $sekolah_id = htmlspecialchars($request->getVar('sekolah_id'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang, $filterJalur, $sekolah_id);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];
            $row[] = $no;
            if ((int)$list->status_pendaftaran == 2) {
                $status = '<span class="badge badge-success">Lolos</span>';
            } else {
                $status = '<span class="badge badge-danger">Tidak Lolos</span>';
            }
            $row[] = $status;
            $row[] = $list->fullname;
            $row[] = $list->nisn;
            $row[] = $list->via_jalur;
            $row[] = $list->jarak . ' Km';
            $row[] = $list->nama_sekolah_asal . ' (' . $list->npsn_sekolah_asal . ')';

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            // "recordsTotal" => 0,
            // "recordsFiltered" => 0,
            "recordsTotal" => $datamodel->count_all($filterJenjang, $filterJalur, $sekolah_id),
            "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterJalur, $sekolah_id),
            "data" => $data
        ];
        echo json_encode($output);
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


    public function detail()
    {
        $data['title'] = 'Rekapitulasi Proses Analysis';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['sekolah_id'] = htmlspecialchars($this->request->getGet('token'), true);
        $data['sekolahname'] = $this->_db->table('ref_sekolah')->select("nama, npsn")->where('id', $data['sekolah_id'])->get()->getRowObject();

        return view('dinas/analisis/kuotasisa/detail', $data);
    }
}
