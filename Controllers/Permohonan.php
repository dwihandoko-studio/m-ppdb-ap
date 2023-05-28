<?php

namespace App\Controllers;

use App\Libraries\Authlib;
use App\Libraries\Capillib;
use CodeIgniter\API\ResponseTrait;

class Permohonan extends BaseController
{
    use ResponseTrait;
    protected $format = 'json';

    var $folderImage = 'permohonan/temp';

    function __construct()
    {
        helper(['text', 'file', 'session', 'array', 'filesystem']);
        // $this->session      = \Config\Database::connect();
    }

    public function antrian()
    {
        $capilLib = new Capillib();
        $data['user'] = $capilLib->profileUser();

        $data['title'] = 'Daftar Usulan Permohonan';
        $data['file_upload'] = FALSE;
        $data['page'] = 'Daftar Usulan Permohonan Dalam Antrian';
        $data['datatables'] = TRUE;
        $data['permohonans'] = $capilLib->getPermohonaAntrian();
        // echo json_encode($data['permohonans']);
        // die;

        echo view('template/head', $data);
        echo view('template/topbar', $data);
        echo view('template/left-sidebar', $data);
        echo view('template/right-sidebar', $data);
        echo view('permohonan/antrian', $data);
        echo view('template/core', $data);
        echo view('permohonan/core', $data);
        echo view('template/footer');
    }

    public function proses()
    {
        $capilLib = new Capillib();
        $data['user'] = $capilLib->profileUser();

        $data['title'] = 'Daftar Usulan Permohonan';
        $data['file_upload'] = FALSE;
        $data['page'] = 'Daftar Usulan Permohonan Diproses';
        $data['datatables'] = TRUE;
        $data['permohonans'] = $capilLib->getPermohonaProses();
        // echo json_encode($data['permohonans']);
        // die;

        echo view('template/head', $data);
        echo view('template/topbar', $data);
        echo view('template/left-sidebar', $data);
        echo view('template/right-sidebar', $data);
        echo view('permohonan/proses', $data);
        echo view('template/core', $data);
        echo view('permohonan/core', $data);
        echo view('template/footer');
    }

    public function selesai()
    {
        $capilLib = new Capillib();
        $data['user'] = $capilLib->profileUser();

        $data['title'] = 'Daftar Usulan Permohonan';
        $data['file_upload'] = FALSE;
        $data['page'] = 'Daftar Usulan Permohonan Selesai';
        $data['datatables'] = TRUE;
        $data['permohonans'] = $capilLib->getPermohonaSelesai();
        // echo json_encode($data['permohonans']);
        // die;

        echo view('template/head', $data);
        echo view('template/topbar', $data);
        echo view('template/left-sidebar', $data);
        echo view('template/right-sidebar', $data);
        echo view('permohonan/selesai', $data);
        echo view('template/core', $data);
        echo view('permohonan/core', $data);
        echo view('template/footer');
    }

    public function tolak()
    {
        $capilLib = new Capillib();
        $data['user'] = $capilLib->profileUser();

        $data['title'] = 'Daftar Usulan Permohonan';
        $data['file_upload'] = FALSE;
        $data['page'] = 'Daftar Usulan Permohonan Batal';
        $data['datatables'] = TRUE;
        $data['permohonans'] = $capilLib->getPermohonaBatal();
        // echo json_encode($data['permohonans']);
        // die;

        echo view('template/head', $data);
        echo view('template/topbar', $data);
        echo view('template/left-sidebar', $data);
        echo view('template/right-sidebar', $data);
        echo view('permohonan/batal', $data);
        echo view('template/core', $data);
        echo view('permohonan/core', $data);
        echo view('template/footer');
    }

    public function detail()
    {
        $id = ($this->request->getGet('id')) ? htmlspecialchars($this->request->getGet('id'), true) : "";
        if ($id == "")
            return view('errors/error_404');
        $capilLib = new Capillib();
        $data['user'] = $capilLib->profileUser();

        $data['title'] = 'Detail Permohonan';
        $data['file_upload'] = FALSE;
        $data['page'] = 'Detail Permohonan';
        $data['datatables'] = FALSE;
        $data['data'] = $capilLib->getPermohonanDetail($id);

        if (!$data['data']) {
            return
                view('errors/error_404');
        }

        echo view('template/head', $data);
        echo view('template/topbar', $data);
        echo view('template/left-sidebar', $data);
        echo view('template/right-sidebar', $data);
        if ($data['data']->jenisPermohonan == "UPDATEDATA") {
            echo view('permohonan/detail/index-updatedata', $data);
        } else if ($data['data']->jenisPermohonan == "KTP") {
            echo view('permohonan/detail/index-ktp', $data);
        } else if ($data['data']->jenisPermohonan == "CEKNIK") {
            echo view('permohonan/detail/index-ceknik', $data);
        } else if ($data['data']->jenisPermohonan == "KK") {
            echo view('permohonan/detail/index-kk', $data);
        } else if ($data['data']->jenisPermohonan == "KIA") {
            echo view('permohonan/detail/index-kia', $data);
        } else if ($data['data']->jenisPermohonan == "AKTAKEL") {
            echo view('permohonan/detail/index-aktekelahiran', $data);
        } else if ($data['data']->jenisPermohonan == "AKTACER") {
            echo view('permohonan/detail/index-akteperceraian', $data);
        } else if ($data['data']->jenisPermohonan == "AKTAKEMATIAN") {
            echo view('permohonan/detail/index-aktekematian', $data);
        } else if ($data['data']->jenisPermohonan == "AKTAKAWIN") {
            echo view('permohonan/detail/index-akteperkawinan', $data);
        } else if ($data['data']->jenisPermohonan == "SRTPINDAH") {
            echo view('permohonan/detail/index-suratpindah', $data);
        } else {
        }
        // else if($data['data']->jenisPermohonan == "UPDATEDATA") {
        //     echo view('permohonan/detail/index-updatedata', $data);
        // }
        echo view('template/core', $data);
        echo view('permohonan/detail/core', $data);
        echo view('template/footer');
    }

    public function tolakproses()
    {

        $kode = ($this->request->getGet('kode')) ? htmlspecialchars($this->request->getGet('kode'), true) : "";
        $pemohon = ($this->request->getGet('pemohon')) ? htmlspecialchars($this->request->getGet('pemohon'), true) : "";
        $keterangan = ($this->request->getGet('keterangan')) ? htmlspecialchars($this->request->getGet('keterangan'), true) : "";

        if ($kode == "" || $pemohon == "" || $keterangan == "") {
            $dataEror = [
                'text' => 'Error',
                'message' => 'Field Kosong.',
                'type' => 'error'
            ];
            return $this->fail($dataEror);
        }

        $capilLib = new Capillib();
        $result = $capilLib->changePermohonanToTolak($kode, $pemohon, $keterangan);
        if ($result) {
            $dataSukses = [
                'text' => 'ok',
                'message' => 'Pengajuan Permohonan Berhasil Ditolak.',
                'type' => 'ok'
            ];
            return $this->respond($dataSukses);
        } else {
            $dataEror = [
                'text' => 'Error',
                'message' => 'Permintaan Gagal.',
                'type' => 'error'
            ];
            return $this->fail($dataEror);
        }
    }

    public function approveproses()
    {

        $kode = ($this->request->getVar('kode')) ? htmlspecialchars($this->request->getVar('kode'), true) : "";
        $pemohon = ($this->request->getVar('pemohon')) ? htmlspecialchars($this->request->getVar('pemohon'), true) : "";

        if ($kode == "" || $pemohon == "") {
            return false;
        }

        $capilLib = new Capillib();
        $result = $capilLib->changePermohonanToProses($kode, $pemohon);
        if ($result) {
            echo "Pengajuan Permohonan Berhasil Diproses.";
        } else {

            return false;
        }
    }

    public function approveselesai()
    {
        $rules = [
            'kode' => 'required|trim',
            'pemohon' => 'required|trim',
            'keterangan' => 'required|trim',
        ];

        $filenamefile = dot_array_search('file.name', $_FILES);
        if ($filenamefile != '') {
            $fileVal = ['file' => 'uploaded[file]|max_size[file, 2048]|mime_in[file,image/jpg,image/png,image/gif,image/jpeg,application/pdf]'];
            $rules = array_merge($rules, $fileVal);
        }

        if (!$this->validate($rules)) {
            return false;
        } else {

            $kode = ($this->request->getVar('kode')) ? htmlspecialchars($this->request->getVar('kode'), true) : "";
            $pemohon = ($this->request->getVar('pemohon')) ? htmlspecialchars($this->request->getVar('pemohon'), true) : "";
            $keterangan = ($this->request->getVar('keterangan')) ? htmlspecialchars($this->request->getVar('keterangan'), true) : "";

            $capilLib = new Capillib();

            if ($filenamefile != '') {
                $lampiranFile = $this->request->getFile('file');

                // if (!file_exists('./assets/uploads/' . $this->folderImage)) {
                //     mkdir('./assets/uploads/' . $this->folderImage, 0755);
                //     $dir = './assets/uploads/' . $this->folderImage;
                // } else {
                //     $dir = './assets/uploads/' . $this->folderImage;
                // }

                if ($lampiranFile->isValid() && !$lampiranFile->hasMoved()) {
                    $filesNamelampiranFile = $lampiranFile->getName();
                    // var_dump($filesNamelampiranFile);
                    // die;

                    // $lampiranFile->move($dir, $filesNamelampiranFile);
                    // $type = $lampiranFile->getClientMimeType();
                    $tempName = $lampiranFile->getTempName();
                    // var_dump($tempName);
                    // die;

                    $filePath = './assets/uploads/permohonan/temp/' . $filesNamelampiranFile;
                    //$a = pathinfo($filePath);

                    //$b = mime_content_type($filePath);


                    //$file = '@' . realpath($filePath) . ';filename=' . $a['basename'] . ';type=' . $b;

                    $result = $capilLib->changePermohonanToSelesai($kode, $pemohon, $keterangan, $tempName, $filesNamelampiranFile);
                    
                    // var_dump($result);die;

                    if ($result) {
                        echo "Pengajuan Permohonan Berhasil Diselesaikan.";
                    } else {

                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                $result = $capilLib->changePermohonanToSelesai($kode, $pemohon, $keterangan);

                if ($result) {
                    echo "Pengajuan Permohonan Berhasil Diselesaikan.";
                } else {

                    return false;
                }
            }
        }
    }
}
