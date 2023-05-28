<?php

namespace App\Controllers\Dinas\Rekap;

use App\Controllers\BaseController;
use App\Models\Dinas\Rekap\DitolakModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use Firebase\JWT\JWT;

class Ditolak extends BaseController
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
        $datamodel = new DitolakModel($request);

        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
        $filterSekolah = htmlspecialchars($request->getVar('filter_sekolah'), true) ?? "";

        $lists = $datamodel->get_datatables($filterJenjang, $filterSekolah);
        // $lists = [];
        $data = [];
        $no = $request->getPost("start");
        foreach ($lists as $list) {
            $no++;
            $row = [];

            $row[] = $no;
            // if($hakAksesMenu) {
            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
            $action = '<div class="dropup">
                                    <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                                    </div>
                                    <div class="dropdown-menu">
                                        <button onclick="actionDetail(\'' . $list->id . '\')" type="button" class="dropdown-item">
                                            <i class="fa fa-eye"></i>
                                            <span>Detail</span>
                                        </button>
                                    </div>
                                </div>';
            $row[] = $action;
            // $row[] = '<a href="javascript:;" class="btn btn-primary btn-sm action-detail" data-id="' . $list->id . '"><i class="fa fa-eye"></i><span>Detail</span></a>';
            //     } else {
            //         $row[] = '-';
            //     }
            // } else {
            //     $row[] = '-';
            // }


            // $row[] = $no;

            $row[] = $list->fullname;
            $row[] = $list->nisn;
            $row[] = $list->kode_pendaftaran;
            $row[] = $list->via_jalur;
            $row[] = $list->nama_sekolah_asal;
            $row[] = ($list->npsn_sekolah_asal == '10000001') ? '-' : $list->npsn_sekolah_asal;
            $row[] = $list->keterangan_penolakan;

            $data[] = $row;
        }
        $output = [
            "draw" => $request->getPost('draw'),
            // "recordsTotal" => 0,
            // "recordsFiltered" => 0,
            "recordsTotal" => $datamodel->count_all($filterJenjang, $filterSekolah),
            "recordsFiltered" => $datamodel->count_filtered($filterJenjang, $filterSekolah),
            "data" => $data
        ];
        echo json_encode($output);
    }

    public function index()
    {
        $data['title'] = 'Rekapitulasi Ditolak Verifikasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/rekap/ditolak/index', $data);
    }
}
