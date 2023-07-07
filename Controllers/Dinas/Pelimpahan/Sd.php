<?php

// namespace App\Controllers\Dinas\Pelimpahan;

// use App\Controllers\BaseController;
// use App\Models\Dinas\Pelimpahan\SdModel;
// use Config\Services;

// use App\Libraries\Profilelib;
// use App\Libraries\Uuid;
// use App\Libraries\Dinas\Riwayatlib;
// use Firebase\JWT\JWT;

// class Sd extends BaseController
// {
//     var $folderImage = 'masterdata';
//     private $_db;
//     private $model;

//     function __construct()
//     {
//         helper(['text', 'file', 'form', 'session', 'cookie', 'array', 'imageurl', 'web', 'filesystem']);
//         $this->_db      = \Config\Database::connect();
//     }

//     public function getAll()
//     {
//         $request = Services::request();
//         $datamodel = new SdModel($request);

//         $filterJenjang = htmlspecialchars($request->getVar('filter_jenjang'), true) ?? "";

//         $lists = $datamodel->get_datatables();
//         // $lists = [];
//         $data = [];
//         $no = $request->getPost("start");
//         foreach ($lists as $list) {
//             $no++;
//             $row = [];

//             $row[] = $no;
//             // if($hakAksesMenu) {
//             //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
//             // $action = '<div class="dropup">
//             //             <div class="btn btn-primary btn-sm" href="javascript:;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
//             //                 <span>&nbsp;&nbsp;Aksi&nbsp;&nbsp;</span>
//             //             </div>
//             //             <div class="dropdown-menu">
//             //                 <button onclick="actionDetail(\'' . $list->id . '\')" type="button" class="dropdown-item">
//             //                     <i class="fa fa-eye"></i>
//             //                     <span>Detail</span>
//             //                 </button>
//             //             </div>
//             //         </div>';
//             if(alreadyOnPelimpahan($list->peserta_didik_id) == true) {
//                 $action = '<span class="badge badge-success">Sudah Pelimpahan</span>';
//             } else {
//                 $action = '<button onclick="actionPelimpahan(\'' . $list->peserta_didik_id . '\')" type="button" class="btn btn-primary btn-sm">
//                                 <i class="ni ni-curved-next"></i>
//                                 <span>Limpahkan</span>
//                             </button>';
//             }
//             $row[] = $action;
            
//             $siswa = json_decode($list->details);

//             $row[] = $list->fullname;
//             $row[] = $list->nisn;
//             $row[] = $list->npsn_sekolah_tujuan;
//             $row[] = $list->nama_sekolah_tujuan;
//             $row[] = $siswa->tempat_lahir;
//             $row[] = $siswa->tanggal_lahir;

//             $data[] = $row;
//         }
//         $output = [
//             "draw" => $request->getPost('draw'),
//             // "recordsTotal" => 0,
//             // "recordsFiltered" => 0,
//             "recordsTotal" => $datamodel->count_all(),
//             "recordsFiltered" => $datamodel->count_filtered(),
//             "data" => $data
//         ];
//         echo json_encode($output);
//     }

//     public function index()
//     {
//         $data['title'] = 'Pelimpahan SD';
//         $Profilelib = new Profilelib();
//         $user = $Profilelib->user();
//         if ($user->code != 200) {
//             delete_cookie('jwt');
//             session()->destroy();
//             return redirect()->to(base_url('web/home'));
//         }

//         $data['user'] = $user->data;

//         return view('dinas/pelimpahan/sd/index', $data);
//     }
    
//     public function detail() {
//         if ($this->request->getMethod() != 'post') {
//             $response = new \stdClass;
//             $response->code = 400;
//             $response->message = "Permintaan tidak diizinkan";
//             return json_encode($response);
//         }

//         $rules = [
//             'id' => [
//                 'rules' => 'required|trim',
//                 'errors' => [
//                     'required' => 'Id tidak boleh kosong. ',
//                 ]
//             ],
//         ];

//         if (!$this->validate($rules)) {
//             $response = new \stdClass;
//             $response->code = 400;
//             $response->message = $this->validator->getError('id');
//             return json_encode($response);
//         } else {
//             $id = htmlspecialchars($this->request->getVar('id'), true);

//             $oldData = $this->_db->table('v_tb_user_peserta a')
//                 // ->select("b.*, k.lampiran_kk, k.lampiran_lulus, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan")
//                 // ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
//                 // ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
//                 // ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
//                 // ->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT')
//                 // ->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT')
//                 // ->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT')
//                 // ->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT')
//                 // ->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT')
//                 // ->join('ref_dusun h', 'b.dusun = h.id', 'LEFT')
//                 // ->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT')
//                 ->where('a.peserta_didik_id', $id)
//                 ->get()->getRowObject();

//             if (!$oldData) {
//                 $response = new \stdClass;
//                 $response->code = 400;
//                 $response->message = "Data tidak ditemukan.";
//                 return json_encode($response);
//             }

//             $data['data'] = $oldData;
//             $data['kecamatans'] = $this->_db->table('ref_kecamatan')->where('id_kabupaten', str_replace("'","",getenv('ppdb.default.wilayahppdb')))->orderBy('nama', 'asc')->get()->getResult();

//             $response = new \stdClass;
//             $response->code = 200;
//             $response->result = $oldData;
//             $response->data = view('dinas/pelimpahan/sd/detail', $data);
//             $response->message = "Data ditemukan.";
//             return json_encode($response);
//         }
//     }
    
//     public function savepelimpahan() {
//         if ($this->request->getMethod() != 'post') {
//             $response = new \stdClass;
//             $response->code = 400;
//             $response->message = "Permintaan tidak diizinkan";
//             return json_encode($response);
//         }

//         $rules = [
//             'peserta_didik_id' => [
//                 'rules' => 'required|trim',
//                 'errors' => [
//                     'required' => 'Peserta didik id tidak boleh kosong. ',
//                 ]
//             ],
//             'sekolah_tujuan' => [
//                 'rules' => 'required|trim',
//                 'errors' => [
//                     'required' => 'Sekolah tujuan tidak boleh kosong. ',
//                 ]
//             ],
//         ];

//         if (!$this->validate($rules)) {
//             $response = new \stdClass;
//             $response->code = 400;
//             $response->message = $this->validator->getError('peserta_didik_id') . $this->validator->getError('sekolah_tujuan');
//             return json_encode($response);
//         } else {
//             $Profilelib = new Profilelib();
//             $user = $Profilelib->user();
//             if ($user->code != 200) {
//                 delete_cookie('jwt');
//                 session()->destroy();
//                 $response = new \stdClass;
//                 $response->code = 401;
//                 $response->message = "Session anda telah habis. silahkan login ulang";
//                 return json_encode($response);
//             }
            
//             $peserta_didik_id = htmlspecialchars($this->request->getVar('peserta_didik_id'), true);
//             $sekolah_tujuan = htmlspecialchars($this->request->getVar('sekolah_tujuan'), true);
            
            
//             // $response = new \stdClass;
//             // $response->code = 400;
//             // $response->message = "BERHASIL";
//             // return json_encode($response);

//             $cekAlreadyRegistered = $this->_db->table('_tb_pendaftar')
//                                         ->where(['peserta_didik_id' => $peserta_didik_id, 'via_jalur' => 'PELIMPAHAN'])
//                                         ->get()->getRowObject();
                                        
//             if($cekAlreadyRegistered) {
//                 $response = new \stdClass;
//                 $response->code = 201;
//                 $response->message = "Peserta didik ini sudah terdaftar di pelimpahan. Silahkan refresh ulang halaman";
//                 return json_encode($response);
//             }
//             $cekUserPeserta = $this->_db->table('v_tb_user_peserta')->where('peserta_didik_id', $peserta_didik_id)->get()->getRowObject();
//             if(!$cekUserPeserta) {
//                 $response = new \stdClass;
//                 $response->code = 400;
//                 $response->message = "User Peserta Tidak Ditemukan";
//                 return json_encode($response);
//             }
            
            
            
//             $this->_db->transBegin();
            
//             $cekSekolahTujuan = $this->_db->table('v_tb_sekolah_pelimpahan')->where('id', $sekolah_tujuan)->get()->getRowObject();
//             if(!$cekSekolahTujuan) {
//                 $this->_db->transRollback();
//                 $response = new \stdClass;
//                 $response->code = 400;
//                 $response->message = "Referensi Sekolah Pelimpahan Tidak Ditemukan";
//                 return json_encode($response);
//             }
            
//             if((int)$cekSekolahTujuan->jumlah_pendaftar >= (int)$cekSekolahTujuan->jumlah_kuota) {
//                 $this->_db->transRollback();
//                 $response = new \stdClass;
//                 $response->code = 400;
//                 $response->message = "Sekolah Pelimpahan Sudah Penuh Untuk Kuota yang disediakan.";
//                 return json_encode($response);
//             }
            
//             $uuidLib = new Uuid();
//             $uuid = $uuidLib->v4();

//             $data = [
//                 'id' => $uuid,
//                 'kode_pendaftaran' => createKodePendaftaran("PELIMPAHAN", $cekUserPeserta->nisn),
//                 'user_id' => $cekUserPeserta->id,
//                 'peserta_didik_id' => $cekUserPeserta->peserta_didik_id,
//                 'from_sekolah_id' => $cekUserPeserta->sekolah_asal,
//                 'tujuan_sekolah_id' => $cekSekolahTujuan->id,
//                 'via_jalur' => "PELIMPAHAN",
//                 'status_pendaftaran' => 2,
//                 'lampiran' => null,
//                 'keterangan' => null,
//                 'pendaftar' => 'DINAS',
//                 'created_at' => date('Y-m-d H:i:s'),
//                 'updated_at' => date('Y-m-d H:i:s'),
//                 'updated_aproval' => date('Y-m-d H:i:s'),
//                 'admin_approval' => $user->data->id
//             ];

            
//             $this->_db->table('_tb_pendaftar')->insert($data);
//             if ($this->_db->affectedRows() > 0) {
//                 $this->_db->transCommit();
//                 try {
//                     $riwayatLib = new Riwayatlib();
//                     $riwayatLib->insert("Mendaftarkan pelimpahan ke Sekolah $cekSekolahTujuan->nama, dengan No Pendaftaran : " . $data['kode_pendaftaran'], "Mendaftarkan Pelimpahan");
//                 } catch (\Throwable $th) {
//                 }
//                 $response = new \stdClass;
//                 $response->code = 200;
//                 $response->data = $data;
//                 $response->message = "Pendaftaran pelimpahan ke Sekolah $cekSekolahTujuan->nama berhasil dilakukan. Kode pendaftaran peserta : " . $data['kode_pendaftaran'] . ".";
//                 return json_encode($response);
//             } else {
//                 $this->_db->transRollback();
//                 $response = new \stdClass;
//                 $response->code = 400;
//                 $response->message = "Pendaftaran pelimpahan ke Sekolah $cekSekolahTujuan->nama gagal dilakukan.";
//                 return json_encode($response);
//             }
//         }
//     }
    
//     public function getSekolah() {
//         if ($this->request->getMethod() != 'post') {
//             $response = new \stdClass;
//             $response->code = 400;
//             $response->message = "Permintaan tidak diizinkan";
//             return json_encode($response);
//         }

//         $rules = [
//             'id' => [
//                 'rules' => 'required|trim',
//                 'errors' => [
//                     'required' => 'Id tidak boleh kosong. ',
//                 ]
//             ],
//             'lat' => [
//                 'rules' => 'required|trim',
//                 'errors' => [
//                     'required' => 'Latitude tidak boleh kosong. ',
//                 ]
//             ],
//             'long' => [
//                 'rules' => 'required|trim',
//                 'errors' => [
//                     'required' => 'Longitude tidak boleh kosong. ',
//                 ]
//             ],
//         ];

//         if (!$this->validate($rules)) {
//             $response = new \stdClass;
//             $response->code = 400;
//             $response->message = $this->validator->getError('id') . $this->validator->getError('lat') . $this->validator->getError('long');
//             return json_encode($response);
//         } else {
//             $id = htmlspecialchars($this->request->getVar('id'), true);
//             $lat = htmlspecialchars($this->request->getVar('lat'), true);
//             $long = htmlspecialchars($this->request->getVar('long'), true);

//             $sekolahs = $this->_db->table('v_tb_sekolah_pelimpahan a')
//                             ->select("a.*, ROUND(getDistanceKm('$lat','$long',a.latitude,a.longitude), 2) AS jarak")
//                             // ->where('a.kecamatan_id', $id)
//                             ->where("a.jumlah_pendaftar < a.jumlah_kuota")
//                             ->whereIn('a.bentuk_pendidikan_id', [5,9,30,31,32,33,38])
//                             ->orderBy('jarak', 'asc')
//                             ->get()->getResult();
                            
//             if(count($sekolahs) > 0) {
//                 $response = new \stdClass;
//                 $response->code = 200;
//                 $response->data = $sekolahs;
//                 $response->message = "Data ditemukan.";
//                 return json_encode($response);
//             } else {
//                 $response = new \stdClass;
//                 $response->code = 400;
//                 $response->message = "Tidak ada data.";
//                 return json_encode($response);
//             }
//         }
//     }
// }
