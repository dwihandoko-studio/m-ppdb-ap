<?php

namespace App\Controllers\Sekolah\Rangking;

use App\Controllers\BaseController;
use App\Models\Sekolah\Rangking\MutasiModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Sekolah\Riwayatlib;
use Firebase\JWT\JWT;

class Mutasi extends BaseController
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
        $datamodel = new MutasiModel($request);

        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        if ($request->getMethod(true) == 'POST') {
            $filter_jalur = htmlspecialchars($request->getVar('filter_jalur'), true) ?? "";

            $lists = $datamodel->get_datatables($filter_jalur, $user->data->id);
            // $lists = [];
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $row[] = '';
                $row[] = $no;
                // if($hakAksesMenu) {
                //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
                $action = '
                <button onclick="actionDetail(\'' . $list->id_pendaftaran . '\')" type="button" class="btn btn-primary btn-sm">
                    <i class="fa fa-eye"></i>
                    <span>Detail</span>
                </button>';
                // $row[] = $action;

                // $row[] = $list->jarak;
                $row[] = $list->fullname;
                $row[] = $list->nisn;
                $row[] = $list->kode_pendaftaran;
                $row[] = $list->via_jalur;
                $row[] = $list->nama_sekolah_asal;
                $row[] = (round($list->jarak, 2)) . ' Km';
                // $row[] = getJarak2Koordinat($list->latitude, $list->longitude, $list->latitude_sekolah_tujuan, $list->longitude_sekolah_tujuan, 'kilometers') . ' Km';

                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                // "recordsTotal" => 0,
                // "recordsFiltered" => 0,
                "recordsTotal" => $datamodel->count_all($filter_jalur, $user->data->id),
                "recordsFiltered" => $datamodel->count_filtered($filter_jalur, $user->data->id),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function index()
    {
        return redirect()->to(base_url('sekolah/rangking/mutasi/data'));
    }

    public function data()
    {
        $data['title'] = 'Rekapitulasi Rangking Mutasi';
        $Profilelib = new Profilelib();
        $user = $Profilelib->userSekolah();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        // $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('sekolah/rangking/mutasi/index', $data);
    }


    public function detail()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);

            $oldData = $this->_db->table('_tb_pendaftar a')
                ->select("b.*, k.lampiran_akta_kelahiran, k.lampiran_foto_rumah, k.lampiran_kk, k.lampiran_lulus, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
                ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
                ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
                ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
                ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
                ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
                ->join('ref_dusun h', 'b.dusun = h.id', 'LEFT')
                ->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT')
                ->where('a.id', $id)
                ->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $data['data'] = $oldData;

            $response = new \stdClass;
            $response->code = 200;
            $response->result = $oldData;
            $response->data = view('sekolah/rangking/mutasi/detail', $data);
            $response->message = "Data ditemukan.";
            return json_encode($response);
        }
    }
}
