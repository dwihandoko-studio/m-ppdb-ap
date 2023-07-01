<?php

namespace App\Controllers\Peserta\Pendaftaran;

use App\Controllers\BaseController;
use App\Libraries\Peserta\Datalib;
use Config\Services;

use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Peserta\Riwayatlib;
use Firebase\JWT\JWT;

class Zonasi extends BaseController
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
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }
        $getCurrentUser = $this->_db->table('_users_profil_tb')->where('id', $user->data->id)->get()->getRowObject();

        if (!$getCurrentUser) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }

        $keyword = htmlspecialchars($this->request->getVar('keyword'), true) ?? "";
        $page = htmlspecialchars($this->request->getVar('page'), true);

        $limit_per_page = 10;

        if ((int)$page == 0 || (int)$page == 1) {
            $page = 1;
            $start = 0;
        } else {
            $page = (int)$page;
            $start = (($page - 1) * $limit_per_page);
        }
        $dataCurrentUser = json_decode($getCurrentUser->details);
        if ((int)$dataCurrentUser->tingkat_pendidikan == 6) {
            $andWhere = "a.bentuk_pendidikan_id IN (6,10,31,32,33,35,36)";
        } else {
            $andWhere = "a.bentuk_pendidikan_id IN (5,9,30,31,32,33,38)";
        }

        $where = "a.provinsi_id = '{$getCurrentUser->provinsi}' AND a.kabupaten_id = '{$getCurrentUser->kabupaten}' AND a.kecamatan_id = '{$getCurrentUser->kecamatan}' AND a.kelurahan_id = '{$getCurrentUser->kelurahan}' AND a.dusun_id = '{$getCurrentUser->dusun}' AND ($andWhere)";

        if ($keyword !== "") {
            $where .= " AND (a.npsn = '$keyword' OR a.nama LIKE '%$keyword%')";
        }

        // $where = "a.provinsi = '{$getCurrentUser->provinsi}' AND a.kabupaten = '{$getCurrentUser->kabupaten}' AND a.kecamatan = '{$getCurrentUser->kecamatan}' AND a.kelurahan = '{$getCurrentUser->kelurahan}' AND a.dusun = '{$getCurrentUser->dusun}' AND ($andWhere)";
        $data['result'] = $this->_db->table('v_tb_sekolah_zonasi a')
            ->select("a.*, ROUND(getDistanceKm('{$getCurrentUser->latitude}','{$getCurrentUser->longitude}',a.latitude,a.longitude), 2) AS jarak")
            // $data['result'] = $this->_db->table('ref_provinsi a')
            //         //RUMUS JARAK (111.111 *
            // DEGREES(ACOS(LEAST(1.0, COS(RADIANS(a.Latitude))
            //      * COS(RADIANS(b.Latitude))
            //      * COS(RADIANS(a.Longitude - b.Longitude))
            //      + SIN(RADIANS(a.Latitude))
            //      * SIN(RADIANS(b.Latitude))))) AS distance_in_km)
            // ->select("b.*, a.dusun as dusun_id, c.nama as nama_jenjang_pendidikan, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, ")
            // ->join('ref_sekolah b', 'a.sekolah_id = b.id')
            // ->join('ref_bentuk_pendidikan c', 'a.bentuk_pendidikan_id = c.id')
            // ->join('ref_kecamatan f', 'b.kode_wilayah = f.id')
            // ->join('ref_kabupaten e', 'f.id_kabupaten = e.id')
            // ->join('ref_provinsi d', 'e.id_provinsi = d.id')
            ->where($where)
            ->orderBy('jarak', 'asc')
            ->limit($limit_per_page, $start)
            ->get()->getResult();
        $data['countData'] = $this->_db->table('v_tb_sekolah_zonasi a')->where($where)->countAllResults();
        // $data['countData'] = $this->_db->table('ref_provinsi a')->where($where)->countAllResults();
        $data['page'] = $page;
        $data['user'] = $getCurrentUser;
        $data['totalPage'] = ($data['countData'] > 0) ? ceil($data['countData'] / $limit_per_page) : 0;
        $data['keyword'] = $keyword;

        if ($data['countData'] > 0) {
            if (count($data['result']) > 0) {
                $response = new \stdClass;
                $response->code = 200;
                $response->message = "Permintaan diizinkan";
                $response->data = view('peserta/pendaftaran/zonasi/pilihan-zonasi', $data);
                $response->pagination = view('peserta/pendaftaran/zonasi/pilihan-pagination', $data);
                return json_encode($response);
            } else {
                $response = new \stdClass;
                $response->code = 204;
                $response->message = "Tidak ada data.";
                return json_encode($response);
            }
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Tidak ada data.";
            return json_encode($response);
        }
    }

    public function index()
    {
        $data['title'] = 'DAFTAR JALUR ZONASI';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            delete_cookie('jwt');
            session()->destroy();
            return redirect()->to(base_url('web/home'));
        }
        $data['user'] = $user->data;

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister();

        if ($canDaftar->code !== 200) {
            $data['jalur'] = "ZONASI";
            $data['message'] = $canDaftar->message . " untuk <b>Jalur Zonasi</b>.";
            return view('peserta/pendaftaran/tutup', $data);
        }

        $cekRegisterApprove = $this->_db->query("SELECT * FROM (
			(SELECT * FROM _tb_pendaftar_temp WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar WHERE peserta_didik_id = '{$user->data->peserta_didik_id}') 
			UNION ALL 
			(SELECT * FROM _tb_pendaftar_tolak WHERE peserta_didik_id = '{$user->data->peserta_didik_id}')
		) AS a ORDER BY a.created_at DESC LIMIT 1")->getRow();

        if ($cekRegisterApprove) {
            switch ((int)$cekRegisterApprove->status_pendaftaran) {
                case 1:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. <br/>Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    $data['can_daftar'] = false;
                    break;
                case 2:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['can_daftar'] = false;
                    $data['pendaft'] = $cekRegisterApprove;
                    $data['success'] = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.";
                    break;
                case 3:
                    $data['error'] = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    if ($cekRegisterApprove->via_jalur == "AFIRMASI") {
                        if ($cekRegisterApprove->keterangan_penolakan == NULL || $cekRegisterApprove->keterangan_penolakan == "") {
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                        } else {
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = $cekRegisterApprove->keterangan_penolakan;
                        }
                        // $data['can_daftar'] = true;
                        // $data['pendaft'] = $cekRegisterApprove;
                        // $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>. <br/>Selanjutnya anda dapat mendaftar kembali menggunakan jalur yang lain (ZONASI, PRESTASI, MUTASI).";
                    } else {
                        if ($cekRegisterApprove->keterangan_penolakan == NULL || $cekRegisterApprove->keterangan_penolakan == "") {
                            $data['can_daftar'] = false;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = "Anda dinyatakan <b>TIDAK LOLOS</b> seleksi PPDB Tahun Ajaran 2023/2024 <br/>di : <b>" . $data['sekolah_pilihan'] . "</b> Melalui Jalur <b>" . $cekRegisterApprove->via_jalur . "</b>.";
                        } else {
                            $data['can_daftar'] = true;
                            $data['pendaft'] = $cekRegisterApprove;
                            $data['warning'] = $cekRegisterApprove->keterangan_penolakan;
                        }
                    }
                    break;

                default:
                    $data['error'] = "Anda sudah melakukan pendaftaran lewat jalur <b>'{$cekRegisterApprove->via_jalur}'</b> dan dalam status menunggu verifikasi berkas.";
                    $data['sekolah_pilihan'] = getNamaAndNpsnSekolah($cekRegisterApprove->tujuan_sekolah_id_1);
                    $data['pendaft'] = $cekRegisterApprove;
                    break;
            }
        }

        return view('peserta/pendaftaran/zonasi/index', $data);
    }

    public function aksidaftar()
    {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Permintaan tidak diizinkan";
            return json_encode($response);
        }

        $dataLib = new Datalib();
        $canDaftar = $dataLib->canRegister();

        if ($canDaftar->code !== 200) {
            return json_encode($canDaftar);
        }

        $rules = [
            'name' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Name tidak boleh kosong. ',
                ]
            ],
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
            $response->message = $this->validator->getError('name') . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $name = htmlspecialchars($this->request->getVar('name'), true);
            $id = htmlspecialchars($this->request->getVar('id'), true);

            $Profilelib = new Profilelib();
            $user = $Profilelib->user();
            if ($user->code != 200) {
                delete_cookie('jwt');
                session()->destroy();
                $response = new \stdClass;
                $response->code = 401;
                $response->message = "Session telah habis.";
                return json_encode($response);
            }
            $peserta = $this->_db->table('_users_profil_tb a')
                ->select("a.*, b.lampiran_kk, b.lampiran_lulus, b.lampiran_afirmasi, b.lampiran_prestasi, b.lampiran_mutasi, b.lampiran_lainnya")
                ->join('_upload_kelengkapan_berkas b', 'a.id = b.user_id', 'LEFT')
                ->where('a.id', $user->data->id)
                ->get()->getRowObject();
            if (!$peserta) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Data anda belum lengkap, silahkan lengkapi data terlebih dahulu.";
                return json_encode($response);
            }

            if ($peserta->lampiran_akta_kelahiran == null || $peserta->lampiran_kk == null || $peserta->lampiran_lulus == null) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Lampiran dokumen anda belum lengkap, silahkan lengkapi lampiran dokumen terlebih dahulu. (Akta, KK dan Lampiran Lulus).";
                return json_encode($response);
            }

            $dataLib = new Datalib();
            $cekAvailableRegistered = $dataLib->cekAlreadyRegistered($peserta->peserta_didik_id);
            if ($cekAvailableRegistered) {
                if ((int)$cekAvailableRegistered->status_pendaftaran !== 3) {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->url = base_url('peserta/home');
                    switch ((int)$cekAvailableRegistered->status_pendaftaran) {
                        case 1:
                            $response->message = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
                            break;
                        case 2:
                            $response->message = "Anda dinyatakan <b>LOLOS</b> pada seleksi PPDB Tahun Ajaran 2023/2024 <br/> Melalui Jalur <b>" . $cekAvailableRegistered->via_jalur . "</b>. <br/>Selanjutnya silahkan melakukan konfirmasi dan daftar ulang ke Sekolah Tujuan <br>sesuai jadwal yang telah ditentukan.";
                            break;

                        default:
                            $response->message = "Anda sudah melakukan pendaftaran. Untuk merubah data silahkan batalkan pendaftaran melalui panitia PPDB Sekolah Tujuan.";
                            break;
                    }
                    return json_encode($response);
                }
            }

            // $cekRegisterApprove = $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();
            // if ($cekRegisterApprove) {
            //     $response = new \stdClass;
            //     $response->code = 400;
            //     $response->message = "Anda sudah melakukan pendaftaran dan telah diverifikasi berkas. Silahkan menunggu pengumuman PPDB pada tanggal yang telah di tentukan.";
            //     return json_encode($response);
            // }

            // $cekRegisterTemp = $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $peserta->peserta_didik_id)->get()->getRowObject();

            // if ($cekRegisterTemp) {
            //     $response = new \stdClass;
            //     $response->code = 400;
            //     $response->message = "Anda sudah melakukan pendaftaran dan dalam status menunggu verifikasi berkas. Silahkan menggunakan tombol batal pendaftaran pada menu riwayat / aktifitas.";
            //     return json_encode($response);
            // }

            $uuidLib = new Uuid();
            $uuid = $uuidLib->v4();

            $data = [
                'id' => $uuid,
                'kode_pendaftaran' => createKodePendaftaran("ZONAZI", $peserta->nisn),
                'user_id' => $user->data->id,
                'peserta_didik_id' => $peserta->peserta_didik_id,
                'from_sekolah_id' => $peserta->sekolah_asal,
                'tujuan_sekolah_id_1' => $id,
                'via_jalur' => "ZONASI",
                'status_pendaftaran' => 0,
                'lampiran' => null,
                'keterangan' => null,
                'pendaftar' => 'SISWA',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->_db->transBegin();
            $this->_db->table('_tb_pendaftar_temp')->insert($data);
            if ($this->_db->affectedRows() > 0) {
                $this->_db->transCommit();
                try {
                    $riwayatLib = new Riwayatlib();
                    $riwayatLib->insert("Mendaftar via Jalur Zonasi ke Sekolah $name, dengan No Pendaftaran : " . $data['kode_pendaftaran'], "Daftar Jalur Zonasi");
                } catch (\Throwable $th) {
                }
                $response = new \stdClass;
                $response->code = 200;
                $response->data = $data;
                $response->message = "Pendaftaran via jalur Zonasi ke Sekolah $name berhasil dilakukan. Kode pendaftaran anda : " . $data['kode_pendaftaran'] . ". Selanjutnya Silahkan cetak bukti pendaftaran anda.";
                return json_encode($response);
            } else {
                $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Pendaftaran via jalur Zonasi ke Sekolah $name berhasil dilakukan.";
                return json_encode($response);
            }
        }
    }

    // public function hapusLampiran()
    // {
    //     if ($this->request->getMethod() != 'post') {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = "Permintaan tidak diizinkan";
    //         return json_encode($response);
    //     }

    //     $rules = [
    //         'id' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Token tidak boleh kosong.',
    //             ]
    //         ],
    //         'nama' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Nama tidak boleh kosong.',
    //             ]
    //         ],
    //         'jenis' => [
    //             'rules' => 'required|trim',
    //             'errors' => [
    //                 'required' => 'Jenis upload tidak boleh kosong.',
    //             ]
    //         ],
    //     ];

    //     if (!$this->validate($rules)) {
    //         $response = new \stdClass;
    //         $response->code = 400;
    //         $response->message = $this->validator->getError('id') . " " . $this->validator->getError('nama') . " " . $this->validator->getError('jenis');
    //         return json_encode($response);
    //     } else {
    //         $id = htmlspecialchars($this->request->getVar('id'), true);
    //         $nama = htmlspecialchars($this->request->getVar('nama'), true);
    //         $jenis = htmlspecialchars($this->request->getVar('jenis'), true);

    //         $oldData = $this->_db->table('_upload_kelengkapan_berkas')->where('id', $id)->get()->getRowObject();
    //         $data = [];

    //         $dir = "";
    //         $namaFile = "";

    //         if ($oldData) {
    //             if ($jenis === "_file_kk") {
    //                 $dir = FCPATH . "uploads/peserta/kk";
    //                 $namaFile = $oldData->lampiran_kk;
    //                 $data['lampiran_kk'] = null;
    //             } else if ($jenis === "_file_lulus") {
    //                 $dir = FCPATH . "uploads/peserta/lulus";
    //                 $namaFile = $oldData->lampiran_lulus;
    //                 $data['lampiran_lulus'] = null;
    //             } else if ($jenis === "_file_prestasi") {
    //                 $dir = FCPATH . "uploads/peserta/prestasi";
    //                 $namaFile = $oldData->lampiran_prestasi;
    //                 $data['lampiran_prestasi'] = null;
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Jenis hapus file tidak dikenali";
    //                 return json_encode($response);
    //             }

    //             $data['updated_at'] = date('Y-m-d H:i:s');
    //             $this->_db->table('_upload_kelengkapan_berkas')->where('id', $oldData->id)->update($data);
    //             if ($this->_db->affectedRows() > 0) {
    //                 if ($jenis === "_file_kk") {
    //                     try {
    //                         if ($oldData->lampiran_kk !== null) {
    //                             unlink($dir . '/' . $namaFile);
    //                         }
    //                     } catch (\Exception $e) {
    //                     }
    //                 } else if ($jenis === "_file_lulus") {
    //                     try {
    //                         if ($oldData->lampiran_lulus !== null) {
    //                             unlink($dir . '/' . $namaFile);
    //                         }
    //                     } catch (\Exception $e) {
    //                     }
    //                 } else if ($jenis === "_file_prestasi") {
    //                     try {
    //                         if ($oldData->lampiran_prestasi !== null) {
    //                             unlink($dir . '/' . $namaFile);
    //                         }
    //                     } catch (\Exception $e) {
    //                     }
    //                 } else {
    //                 }

    //                 $response = new \stdClass;
    //                 $response->code = 200;
    //                 $response->message = "Dokumen " . $nama . " berhasil dihapus.";
    //                 return json_encode($response);
    //             } else {
    //                 $response = new \stdClass;
    //                 $response->code = 400;
    //                 $response->message = "Dokumen " . $nama . " gagal dihapus.";
    //                 return json_encode($response);
    //             }
    //         } else {
    //             $response = new \stdClass;
    //             $response->code = 400;
    //             $response->message = "Dokumen " . $nama . " tidak ditemukan.";
    //             return json_encode($response);
    //         }
    //     }
    // }
}
