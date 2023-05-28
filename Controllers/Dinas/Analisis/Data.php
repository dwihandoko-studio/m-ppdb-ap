<?php

namespace App\Controllers\Dinas\Analisis;

use App\Controllers\BaseController;
use App\Models\Dinas\Analisis\DataModel;
use App\Models\Dinas\Analisis\ProsesModel;
use App\Models\Dinas\Analisis\ProsessekolahModel;
use App\Models\Dinas\Analisis\ProsessekolahprosesModel;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Dinas\Riwayatlib;
use App\Libraries\Dinas\Prosesluluslib;
use Firebase\JWT\JWT;

class Data extends BaseController
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
        $datamodel = new DataModel($request);


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
            // if($hakAksesMenu) {
            //     if((int)$hakAksesMenu->spj_tpg_verifikasi == 1) {
            $action = '<button onclick="actionDetail(\'' . $list->NISN . '\',\'' . $list->Nama . '\',\'' . $list->Tanggal_lahir . '\')" type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                                <span>Detail</span>
                            </button>';

            $row[] = $action;
            $row[] = $list->Nama;
            $row[] = $list->NISN;
            $row[] = $list->NIK;
            $row[] = $list->Nama_ibu_kandung;
            $row[] = $list->Tanggal_lahir;
            $row[] = $list->Nama_sekolah_asal . ' (' . $list->Npsn_sekolah_asal . ')';
            $row[] = $list->Nama_sekolah_tujuan . ' (' . $list->Npsn_sekolah_tujuan . ')';

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
        $data['title'] = 'Rekapitulasi Proses Perbaikan';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }

        $data['user'] = $user->data;

        $data['provinsis'] = $this->_db->table('ref_provinsi')->whereNotIn('id', ['350000', '000000'])->orderBy('nama', 'asc')->get()->getResult();

        return view('dinas/analisis/data/index', $data);
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
            'nisn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NISN tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'tanggal' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tanggal tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn') . $this->validator->getError('nama') . $this->validator->getError('tanggal');
            return json_encode($response);
        } else {
            $data['nisn'] = htmlspecialchars($this->request->getVar('nisn'), true);
            $data['nama'] = htmlspecialchars($this->request->getVar('nama'), true);
            $data['tanggal'] = htmlspecialchars($this->request->getVar('tanggal'), true);

            $response = new \stdClass;
            $response->code = 200;
            $response->result = $data;
            $response->data = view('dinas/analisis/data/detail', $data);
            $response->message = "Data ditemukan.";
            return json_encode($response);
        }
    }
    
    public function detailsave()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $rules = [
            'nisn' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NISN tidak boleh kosong. ',
                ]
            ],
            'nama' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong. ',
                ]
            ],
            'tanggal' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tanggal tidak boleh kosong. ',
                ]
            ],
            'nik' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'NIK tidak boleh kosong. ',
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('nisn') . $this->validator->getError('nama') . $this->validator->getError('tanggal') . $this->validator->getError('nik');
            return json_encode($response);
        } else {
            $nisn = htmlspecialchars($this->request->getVar('nisn'), true);
            $nama = htmlspecialchars($this->request->getVar('nama'), true);
            $tanggal = htmlspecialchars($this->request->getVar('tanggal'), true);
            $nik = htmlspecialchars($this->request->getVar('nik'), true);

            $this->_db->transBegin();
            try {
                $this->_db->table('data_balikan')->where("NISN = '$nisn' AND Nama = '$nama' AND Tanggal_lahir = '$tanggal'")->update(['NIK' => $nik]);
                if($this->_db->affectedRows() > 0) {
                    $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->message = "Data Berhasil di update.";
                    return json_encode($response);
                } else {
                    $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Data gagal diupdate.";
                    return json_encode($response);
                }
            } catch (\Exception $e) {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data tidak ditemukan." . $e;
                return json_encode($response);
            }
            
        }
    }
    

    public function verified() {
        $select = "b.id, b.nisn, b.nip, b.fullname, b.peserta_didik_id, b.latitude, b.details, b.longitude, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.id as sekolah_id_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.user_id, a.peserta_didik_id as id_peserta_didik, a.via_jalur, a.created_at";  //14
        $data = $this->_db->table('_tb_pendaftar_kirim a')
                    ->select($select)
                    ->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT')
                    ->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT')
                    ->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT')
                    ->where('a.status_pendaftaran', 2)
                    ->where('j.bentuk_pendidikan_id', 5)
                    ->get()->getResultArray();
        if(count($data) > 0) {
            print_r("MULAI VERIFIED<br>");
            foreach ($data as $key => $cekRegisterTemp) {
                $dataPeserta = json_decode($cekRegisterTemp['details']);
                
                if(!$dataPeserta) {
                    continue;
                }
                
                $dataInsert = [
                    'Peserta_didik_id' => $cekRegisterTemp['peserta_didik_id'],
                    'Npsn_sekolah_asal' => $cekRegisterTemp['npsn_sekolah_asal'],
                    'Nama_sekolah_asal' => $cekRegisterTemp['nama_sekolah_asal'],
                    'NIK' => $dataPeserta->nik,
                    'NISN' => $cekRegisterTemp['nisn'],
                    'Nama' => $dataPeserta->nama,
                    'Tempat_lahir' => $dataPeserta->tempat_lahir,
                    'Tanggal_lahir' => $dataPeserta->tanggal_lahir,
                    'Jenis_kelamin' => $dataPeserta->jenis_kelamin,
                    'Nama_ibu_kandung' => $dataPeserta->nama_ibu_kandung,
                    'Sekolah_id_tujuan' => $cekRegisterTemp['sekolah_id_tujuan'],
                    'Npsn_sekolah_tujuan' => $cekRegisterTemp['npsn_sekolah_tujuan'],
                    'Nama_sekolah_tujuan' => $cekRegisterTemp['nama_sekolah_tujuan'],
                ];

                $this->_db->transBegin();
                $this->_db->table('data_balikan')->insert($dataInsert);
                if ($this->_db->affectedRows() > 0) {
                    $this->_db->table('_tb_pendaftar_kirim')->where('id', $cekRegisterTemp['id_pendaftaran'])->delete();
                    if ($this->_db->affectedRows() > 0) {

                        $this->_db->transCommit();
                        print_r("BERHASIL VERIVIED AUTO<br>");
                        continue;
                        
                    } else {
                        $this->_db->transRollback();
                        print_r("GAGAL VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
                        continue;
                    }
                } else {
                    $this->_db->transRollback();
                    print_r("GAGAL VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
                        continue;
                }
            }
            print_r("SELESAI VERIVIED AUTO<br>" . $cekRegisterTemp['id']);
        } else {
            print_r("TIDAK ADA DATA");
        }
    }
    
}
