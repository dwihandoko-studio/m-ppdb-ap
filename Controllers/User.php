<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Profilelib;
use App\Libraries\Uuid;
use App\Libraries\Settinglib;
use App\Models\PtkModel;

class User extends BaseController
{
    var $folderImage = 'user';
    private $_db;
    private $model;

    function __construct()
    {
        helper(['text', 'file', 'form', 'session', 'array', 'imageurl', 'web', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->session      = \Config\Database::connect();
    }
    
    public function index()
    {
        $data['title'] = 'PROFILE USER';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        
        $select = "a.id, a.fullname, a.email, a.no_hp as noHp, a.nip, a.jenis_kelamin as jenisKelamin, a.jabatan, a.profile_picture as imageProfile, a.surat_tugas as suratTugas, a.role_user as roleUser, a.created_at as createdAt, a.updated_at as updated_at, a.last_active as lastActive";
        $userDetail = $this->_db->table('_profil_users_tb a')
            ->select($select)
            ->where('a.id', $user->data->id)
            ->get()->getRowObject();
            
        $data['user'] = $user->data;
        $data['data'] = $userDetail;
        
        // var_dump($user->data);die;
        
        return view('page/user/index', $data);
    }
    
    public function edit() {
        $data['title'] = 'EDIT PROFILE USER';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        $data['user'] = $user->data;
        
        return view('page/user/edit', $data);
    }
    
    public function saveEdit() {
        if ($this->request->getMethod() != 'post') {
            
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        } else {
            $rules = [
                'id' => 'required|trim',
                'nohp' => 'required|trim|min_length[9]',
                'jabatan' => 'required|trim',
                'jenisKelamin' => 'required|trim',
                'email' => 'required|trim|valid_email',
                'nip' => 'required|trim',
                'fullname' => 'required|trim',
            ];
            
            $filename = dot_array_search('image.name', $_FILES);
    		if($filename != '') {
    		    $lampiranRules = ['image' => 'uploaded[image]|max_size[image, 512]|mime_in[image,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',];
    		    $rules = array_merge($rules, $lampiranRules);
    		}
    
            if (!$this->validate($rules)) {
                $errorMessage = $this->validator->getError('id') . " " . $this->validator->getError('nohp') . " " . $this->validator->getError('jabatan') . " " . $this->validator->getError('jenisKelamin') . " " . $this->validator->getError('email') . " " . $this->validator->getError('nip') . " " . $this->validator->getError('fullname') . " " . $this->validator->getError('image');
                $response = new \stdClass;
                $response->code = 400;
                $response->message = str_replace("  ", "", $errorMessage);
                return json_encode($response);
            } else {
                $id = htmlspecialchars($this->request->getVar('id'), true);
                $nohp = htmlspecialchars($this->request->getVar('nohp'), true);
                $jabatan = htmlspecialchars($this->request->getVar('jabatan'), true);
                $jenisKelamin = htmlspecialchars($this->request->getVar('jenisKelamin'), true);
                $email = htmlspecialchars($this->request->getVar('email'), true);
                $nip = htmlspecialchars($this->request->getVar('nip'), true);
                $fullname = htmlspecialchars($this->request->getVar('fullname'), true);
                
                $Profilelib = new Profilelib();
                $oldData = $Profilelib->userWithId($id);
                
                if($oldData) {
                    
                    if($oldData->email != $email) {
                        $anyUserEmail = $Profilelib->cekUserWithEmail($email);
                        if($anyUserEmail > 0) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = 'Email sudah terkait dengan pengguna lain.';
                            return json_encode($response);
                        }
                    }
                
                    if($oldData->noHp != $nohp) {
                        $anyUserNohp = $Profilelib->cekUserWithNohp($nohp);
                        if($anyUserNohp > 0) {
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = 'No Handphone sudah terkait dengan pengguna lain.';
                            return json_encode($response);
                        }
                    }
                
                    $dataUpdateProfile = [
                        'fullname' => $fullname,
                        'email' => $email,
                        'no_hp' => $nohp,
                        'jenis_kelamin' => $jenisKelamin,
                        'jabatan' => $jabatan,
                        'nip' => $nip,
                    ];
                    
                    if($filename != '') {
                        $dir = './upload/user';
                    
                        $lampiran = $this->request->getFile('image');
                        $filesNamelampiran = $lampiran->getName();
                        $newNamelampiran = _create_name_foto($filesNamelampiran);
                        
                        if ($lampiran->isValid() && !$lampiran->hasMoved()) {
                            // echo "failed";
                            
                            $lampiran->move($dir, $newNamelampiran);
                            $dataUpdateProfile['surat_tugas'] = $newNamelampiran;
                            } else {
                            // echo "Gambar tidak terupload";
                            $response = new \stdClass;
                            $response->code = 400;
                            $response->message = "Gambar tidak terupload";
                            return json_encode($response);
                        }
                    }
                    
                    $this->_db->transBegin();
                    
                    try {
                        $buildersu = $this->_db->table('_profil_users_tb');
                        $buildersu->set($dataUpdateProfile);
                        $buildersu->where('id', $id);
                        $buildersu->update();
                        
                    } catch (Exception $e) {
                        $this->_db->transRollback();
                        if($filename != '') {
                            unlink(FCPATH . $dir . '/' . $newNamelampiran);
                        }
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = 'Gagal simpan informasi akun.';
                        return json_encode($response);
                    }
                    
                    $suks = $this->_db->affectedRows();
                    
                    if($suks > 0) {
                        $this->_db->transCommit();
                        if($oldData->suratTugas != null && $filename != '') {
                            unlink(FCPATH . $dir . '/' . $oldData->suratTugas);
                        }
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Simpan informasi akun berhasil.";
                        $response->url = base_url();
                        return json_encode($response);
                    } else {
                        $this->_db->transRollback();
                        if($filename != '') {
                            unlink(FCPATH . $dir . '/' . $newNamelampiran);
                        }
                        $response = new \stdClass;
                        $response->code = 400;
                        $response->message = 'Gagal simpan informasi akun.';
                        return json_encode($response);
                    }
                } else {
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = 'User tidak ditemukan';
                    return json_encode($response);
                }
            }
        }
    }
    
    public function upload() {
        if(!$this->request->getGet('token')) {
            return view('404');
        }
        
        $token = htmlspecialchars($this->request->getGet('token'), true);
        
        $usulanLib = new Usulanlib();
        $datas = $usulanLib->getUsulan($token);
        
        $data['title'] = 'Upload Lampiran Usulan TPG';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        $data['user'] = $user->data;
        
        $data['usulan'] = $datas;
        
        return view('page/sekolah/tpg/upload_lampiran_usulan', $data);
    }
    
    public function downloadSptjm() {
        if(!$this->request->getGet('token')) {
            return view('404');
        }
        
        $token = htmlspecialchars($this->request->getGet('token'), true);
        
        $usulanLib = new Usulanlib();
        $datas = $usulanLib->getUsulan($token);
        
        // var_dump($data);die;
        
        if(!$datas) {
            return view('404');
        }
        
        $data['usulan'] = $datas;
        
        $data['title'] = 'SPTJM USULAN';
        $Profilelib = new Profilelib();
        $user = $Profilelib->user();
        if ($user->code != 200) {
            session()->destroy();
            return redirect()->to(base_url('auth'));
        }
        
        $data['user'] = $user->data;
        
        $kepsek = $this->_db->table('_ptk_tb')->where(['npsn' => $data['user']->npsn, 'jabatan_kepsek' => 1])->get()->getRowObject();
        if($kepsek) {
            $data['kepsek'] = $kepsek;
        }
        
        $settingLib = new Settinglib();
            
        $data['tahunAnggaran'] = $settingLib->getCurrentTahunAnggaran();
        return view('page/sekolah/tpg/template_sptjm', $data);
        
        if(count($data['usulan']) > 0 ) {
            // $dompdf = new \Dompdf\Dompdf(); 
            $dompdf = new Dompdf(); 
            // $dompdf->set_option('isRemoteEnabled', TRUE);
            $dompdf->loadHtml(view('page/sekolah/tpg/template_sptjm', $data));
            // $dompdf->setPaper('A4', 'landscape');
            $dompdf->setPaper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream();
            // $dompdf->stream("" .'SPTJM-UTPG-SEMESTER-' . $data['tahunAnggaran']->semester . '-TAHUN-' . $data['tahunAnggaran']->tahun . '-' . $user->data->npsn. '.pdf' . "", array("Attachment"=>0));
            
            // $m = new Merger();

            // $dompdf = new \Dompdf\Dompdf();
            // $dompdf->load_html(view('page/sekolah/tpg/template_sptjm', $data));
            // $dompdf->render();
            // $m->addRaw($dompdf->output());
            // unset($dompdf);
            
            // $dompdf = new \Dompdf\Dompdf();
            // $dompdf->set_paper('A4', 'landscape');
            // $dompdf->load_html(view('page/sekolah/tpg/template_lampiran_sptjm', $data));
            // $m->addRaw($dompdf->output());
            // $dompdf->render();
            
            // // file_put_contents('combined.pdf', $m->merge());
            // file_put_contents( 'SPTJM-UTPG-SEMESTER-' . $data['tahunAnggaran']->semester . '-TAHUN-' . $data['tahunAnggaran']->tahun . '-' . $user->data->npsn. '.pdf', $m->merge());
        } else {
            return view('404');
        }
    }
    
    public function uploadLampiranUsulan() {
        if ($this->request->getMethod() != 'post') {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Hanya request post yang diperbolehkan";
            return json_encode($response);
        }

        $rules = [
            'id' => 'required|trim',
            'sptjm' => 'uploaded[sptjm]|max_size[sptjm, 1024]|mime_in[sptjm,application/pdf]',
            'sk_tugas' => 'uploaded[sk_tugas]|max_size[sk_tugas, 1024]|mime_in[sk_tugas,application/pdf]',
        ];
        
        $filenameGaji = dot_array_search('slip_gaji.name', $_FILES);

        if ($filenameGaji != '') {
            $img = ['slip_gaji' => 'uploaded[slip_gaji]|max_size[slip_gaji, 1024]|mime_in[slip_gaji,application/pdf]'];
            $rules = array_merge($rules, $img);
        }
        
        if (!$this->validate($rules)) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = $this->validator->getError('sptjm') . " " . $this->validator->getError('sk_tugas')  . " " . $this->validator->getError('slip_gaji') . " " . $this->validator->getError('id');
            return json_encode($response);
        } else {
            $id = htmlspecialchars($this->request->getVar('id'), true);
            
            $usulanLib = new Usulanlib();
            $usulans = $usulanLib->getUsulan($id);
            
            $settingLib = new Settinglib();
            
            $tahunAnggaran = $settingLib->getCurrentTahunAnggaran();
            
            if(count($usulans) > 0 && $tahunAnggaran) {
                $usulan = $usulans[0];
                
                if (!file_exists('./upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester)) {
                    mkdir('./upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester, 0755);
                    $dir = './upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester;
                } else {
                    $dir = './upload/usulan/' . $tahunAnggaran->tahun . '/' . $tahunAnggaran->semester;
                }
                
                $data = [];
                
                $lampiranSptjm = $this->request->getFile('sptjm');
                $filesNamelampiranSptjm = $lampiranSptjm->getName();
                $newNamelampiranSptjm = _create_name_foto($filesNamelampiranSptjm);
    
                if ($lampiranSptjm->isValid() && !$lampiranSptjm->hasMoved()) {
                    $lampiranSptjm->move($dir, $newNamelampiranSptjm);
                        $data['lampiran_sptjm'] = $newNamelampiranSptjm;
                } else {
                    return false;
                }
                
                $lampiranSk = $this->request->getFile('sk_tugas');
                $filesNamelampiranSk = $lampiranSk->getName();
                $newNamelampiranSk = _create_name_foto($filesNamelampiranSk);
    
                if ($lampiranSk->isValid() && !$lampiranSk->hasMoved()) {
                    $lampiranSk->move($dir, $newNamelampiranSk);
                        $data['lampiran_sk_pembagian_tugas'] = $newNamelampiranSk;
                } else {
                    unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
                    return false;
                }
                
                if ($filenameGaji != '') {
                    $lampiranGaji = $this->request->getFile('slip_gaji');
                    $filesNamelampiranGaji = $lampiranGaji->getName();
                    $newNamelampiranGaji = _create_name_foto($filesNamelampiranGaji);
        
                    if ($lampiranGaji->isValid() && !$lampiranGaji->hasMoved()) {
                        $lampiranGaji->move($dir, $newNamelampiranGaji);
                            $data['lampiran_slip_gaji'] = $newNamelampiranGaji;
                    } else {
                        unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
                        unlink(FCPATH . $dir . '/' . $newNamelampiranSk);
                        return false;
                    }
                }
                
                $builder = $this->_db->table('_daftar_usulan_tpg');
                $builder->where('id', $id);
                $builder->update($data);
                $updated = $this->_db->affectedRows();
                if($updated > 0) {
                    $actionChangeStatus = $usulanLib->updateUsulanToProcess($usulan->kode_usulan);
                    if($actionChangeStatus != false) {
                        $response = new \stdClass;
                        $response->code = 200;
                        $response->message = "Lampiran usulan tpg berhasil diupload.";
                        $response->url = base_url('sekolah/tpg/detail?token='. $usulan->kode_usulan);
                        return json_encode($response);
                        // return $usulan->kode_usulan;
                        // echo "lampiran usulan tpg berhasil diupload.";
                    } else {
                        unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
                        unlink(FCPATH . $dir . '/' . $newNamelampiranSk);
                        if ($filenameGaji != '') {
                            unlink(FCPATH . $dir . '/' . $newNamelampiranGaji);
                        }
                        
                        return false;
                    }
                } else {
                    unlink(FCPATH . $dir . '/' . $newNamelampiranSptjm);
                    unlink(FCPATH . $dir . '/' . $newNamelampiranSk);
                    if ($filenameGaji != '') {
                        unlink(FCPATH . $dir . '/' . $newNamelampiranGaji);
                    }
                    
                    return false;
                }
            }
        }
    }
}