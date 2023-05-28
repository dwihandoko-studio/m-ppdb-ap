<?php

namespace App\Controllers\Dinas;

use App\Controllers\BaseController;
use App\Models\Dinas\Kirim\KirimModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Prosesluluslib;
use Firebase\JWT\JWT;

class Kirim extends BaseController
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
        $datamodel = new KirimModel($request);


        $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";
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
            $action = '<div class="dropup">
                        <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
                        </div>
                        <div class="dropdown-menu">
                            <button onclick="actionDetail(\'' . $list->id_pendaftaran . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>
                            <button onclick="actionUbah(\'' . $list->id_pendaftaran . '\')" type="button" class="dropdown-item">
                                <i class="fa fa-eye"></i>
                                <span>Ubah Pelimpahan</span>
                            </button>
                        </div>
                    </div>';

            $row[] = $action;
            $row[] = $list->fullname;
            $row[] = $list->nisn;
            $row[] = $list->via_jalur;
            // $row[] = $list->jarak . ' Km';
            // $row[] = $list->latitude . ' - ' . $list->longitude;
            $row[] = $list->nama_sekolah_asal . ' (' . $list->npsn_sekolah_asal . ')';
            $row[] = $list->nama_sekolah_tujuan . ' (' . $list->npsn_sekolah_tujuan . ')';

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
        $data['title'] = 'Rekapitulasi Proses Kirim';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/kirim/index', $data);
    }
    
    public function proseskirim() {
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
                ->where('a.id', $id)
                ->get()->getRowArray();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar_kirim')->insert($oldData);
            if ($this->_db->affectedRows() > 0) {
                // $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();
                // if ($this->_db->affectedRows() > 0) {
                    
                    $this->_db->transCommit();
                    // print_r("BERHASIL VERIVIED AUTO<br>");
                    // continue;
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Proses untuk kirim berhasil dilakukan.";
                    return json_encode($response);
                // } else {
                //     $this->_db->transRollback();
                //     print_r("GAGAL VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
                //     continue;
                // }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data gagal dipindah ke kirim.";
                return json_encode($response);
            }

            // $response = new \stdClass;
            // $response->code = 200;
            // $response->result = $oldData;
            // $response->data = view('dinas/rekap/diverifikasi/detail', $data);
            // $response->message = "Data ditemukan.";
            // return json_encode($response);
        }
    }
    
    
    public function ubah()
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
                ->select("b.*, k.lampiran_kk, k.lampiran_lulus, k.lampiran_pernyataan, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
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
            
            $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', str_replace("'","",getenv('ppdb.default.wilayahppdb')))->orderBy('nama', 'asc')->get()->getResult();

            $response = new \stdClass;
            $response->code = 200;
            $response->result = $oldData;
            $response->data = view('dinas/kirim/detail', $data);
            $response->message = "Data ditemukan.";
            return json_encode($response);
        }
    }
    
    public function ubahpelimpahan()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'id_pendaftaran' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
            'sekolah_tujuan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Id tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('id_pendaftaran') . $this->validator->getError('sekolah_tujuan');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id_pendaftaran'), true);
            $sekolah = htmlspecialchars($this->request->getVar('sekolah_tujuan'), true);

            $oldData = $this->_db->table('_tb_pendaftar a')
                ->where('a.id', $id)
                ->get()->getRowObject();

            if (!$oldData) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan.";
                return json_encode($response);
            }

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar')->where('id', $oldData->id)->update(['tujuan_sekolah_id' => $sekolah]);
            if ($this->_db->affectedRows() > 0) {
                // $this->_db->table('_tb_pendaftar_temp')->where('id', $cekRegisterTemp['id'])->delete();
                // if ($this->_db->affectedRows() > 0) {
                    
                    $this->_db->transCommit();
                    // print_r("BERHASIL VERIVIED AUTO<br>");
                    // continue;
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Proses ubah tujuan sekolah pelimpahan berhasil dilakukan.";
                    return json_encode($response);
                // } else {
                //     $this->_db->transRollback();
                //     print_r("GAGAL VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
                //     continue;
                // }
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data gagal dipindah ke sekolah pelimpahan.";
                return json_encode($response);
            }
        }
    }
    
    public function getSekolah() {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        // $rules = [
        //     'id' => [
        //         'rules' => 'required|trim',
        //         'errors' => [
        //             'required' => 'Id tidak boleh kosong. ',
        //         ]
        //     ],
        //     'lat' => [
        //         'rules' => 'required|trim',
        //         'errors' => [
        //             'required' => 'Latitude tidak boleh kosong. ',
        //         ]
        //     ],
        //     'long' => [
        //         'rules' => 'required|trim',
        //         'errors' => [
        //             'required' => 'Longitude tidak boleh kosong. ',
        //         ]
        //     ],
        // ];

        // if (!$this->validate($rules)) {
        //     $response = new \stdClass;
        //     $response->code = 400;
        //     $response->message = $this->validator->getError('id') . $this->validator->getError('lat') . $this->validator->getError('long');
        //     return json_encode($response);
        // } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            $lat = htmlspecialchars($this->request->getVar('lat'), true);
            $long = htmlspecialchars($this->request->getVar('long'), true);

            $sekolahs = $this->_db->table('ref_sekolah a')
                            // ->select("a.*, ROUND(getDistanceKm('$lat','$long',a.latitude,a.longitude), 2) AS jarak")
                            // ->where('a.kecamatan_id', $id)
                            ->where('a.bentuk_pendidikan_id', 6)
                            ->where("LEFT(a.kode_wilayah,4) = '1209'")
                            ->get()->getResult();
                            
            if(count($sekolahs) > 0) {
                $response = new \stdClass;
                $response->code = 200;
                $response->data = $sekolahs;
                $response->message = "Data ditemukan.";
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Tidak ada data.";
                return json_encode($response);
            }
        // }
    }
    
    // public function proseskelulusan() {
        
    //     $selectSekolah = "a.id as id_pendaftaran, a.tujuan_sekolah_id, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, a.via_jalur, a.created_at, count(a.peserta_didik_id) as jumlah_pendaftar";  //14
    //     $dataSekolahs = $this->_db->table('_tb_pendaftar_proses_an a')
    //                         ->select($selectSekolah)
    //                         ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //                         ->where('a.status_pendaftaran', 1)
    //                         ->groupBy('a.tujuan_sekolah_id')
    //                         ->where('j.bentuk_pendidikan_id', 5)
    //                         ->get()->getResult();
                            
    //     if(count($dataSekolahs) > 0 ) {
    //         print_r("DATA SEKOLAH " . count($dataSekolahs));
    //         foreach ($dataSekolahs as $key => $id) {
    //             // print_r("SELESAI PROSES KELULUSAN ");
    //             $kuota = $this->_db->table('_setting_kuota_tb')->select("zonasi, afirmasi, mutasi, prestasi")->where('sekolah_id', $id->tujuan_sekolah_id)->get()->getRowObject();
                
    //             if(!$kuota) {
    //                 print_r("KUOTA TIDAK DITEMUKAN ");
    //                 continue;
    //             }
                
    //             $sekolah = $this->_db->table('ref_sekolah')->select("status_sekolah")->where('id', $id->tujuan_sekolah_id)->get()->getRowObject();
                
    //             if(!$sekolah) {
    //                 print_r("SEKOLAH TIDAK DITEMUKAN ");
    //                 continue;
    //             }
                
    //             if((int)$sekolah->status_sekolah != 1) {
    //                 print_r("SEKOLAH SWASTA SKIP ");
    //                 continue;
    //             }
                
    //             // $
                
    //             // $limitKuotaAfirmasi = 
                
    //             $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak"; 
                
                
    //             $afirmasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //                                 ->select($select)
    //                                 ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //                                 ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //                                 ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //                                 ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //                                 ->where('a.status_pendaftaran', 1)
    //                                 ->where('a.via_jalur', 'AFIRMASI')
    //                                 ->orderBy('jarak', 'ASC')
    //                                 ->orderBy('a.created_at', 'ASC')
    //                                 ->limit((int)$kuota->afirmasi)
    //                                 ->get()->getResult();
                
    //             $mutasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //                                 ->select($select)
    //                                 ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //                                 ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //                                 ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //                                 ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //                                 ->where('a.status_pendaftaran', 1)
    //                                 ->where('a.via_jalur', 'MUTASI')
    //                                 ->orderBy('jarak', 'ASC')
    //                                 ->orderBy('a.created_at', 'ASC')
    //                                 ->limit((int)$kuota->mutasi)
    //                                 ->get()->getResult();
                
    //             $prestasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //                                 ->select($select)
    //                                 ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //                                 ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //                                 ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //                                 ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //                                 ->where('a.status_pendaftaran', 1)
    //                                 ->where('a.via_jalur', 'PRESTASI')
    //                                 ->orderBy('jarak', 'ASC')
    //                                 ->orderBy('a.created_at', 'ASC')
    //                                 ->limit((int)$kuota->prestasi)
    //                                 ->get()->getResult();
                                    
    //             $sisaAfirmasi = (int)$kuota->afirmasi - count($afirmasiData);
    //             $sisaAfirmasiFix = $sisaAfirmasi > 0 ? $sisaAfirmasi : 0;
                                    
    //             $sisaMutasi = (int)$kuota->mutasi - count($mutasiData);
    //             $sisaMutasiFix = $sisaMutasi > 0 ? $sisaMutasi : 0;
                                    
    //             $sisaPrestasi = (int)$kuota->prestasi - count($prestasiData);
    //             $sisaPrestasiFix = $sisaPrestasi > 0 ? $sisaPrestasi : 0;
                                    
    //             $limitZonasi = (int)$kuota->zonasi + $sisaAfirmasiFix + $sisaMutasiFix + $sisaPrestasiFix;
                
    //             $zonasiData = $this->_db->table('_tb_pendaftar_proses_an a')
    //                                 ->select($select)
    //                                 ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
    //                                 ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
    //                                 ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
    //                                 ->where('a.tujuan_sekolah_id', $id->tujuan_sekolah_id)
    //                                 ->where('a.status_pendaftaran', 1)
    //                                 ->where('a.via_jalur', 'ZONASI')
    //                                 ->orderBy('jarak', 'ASC')
    //                                 ->orderBy('a.created_at', 'ASC')
    //                                 ->limit($limitZonasi)
    //                                 ->get()->getResult();
                                    
    //             $lulusLib = new Prosesluluslib();
                                    
    //             if(count($afirmasiData) > 0) {
    //                 $lulusLib->prosesLulusAfirmasi($afirmasiData);
    //             }
                
    //             if(count($mutasiData) > 0) {
    //                 $lulusLib->prosesLulusMutasi($mutasiData);
    //             }
                
    //             if(count($prestasiData) > 0) {
    //                 $lulusLib->prosesLulusPrestasi($prestasiData);
    //             }
                
    //             if(count($zonasiData) > 0) {
    //                 $lulusLib->prosesLulusZonasi($zonasiData);
    //             }
    //         }
    //         print_r("SELESAI PROSES KELULUSAN ");
    //     } else {
    //         print_r("DATA SEKOLAH TIDAK DITEMUKAN");
    //     }
    // }
}
