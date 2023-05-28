<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Libraries\Maintenancelib;
use App\Libraries\V1\Verifikasihakakseslib;
use Firebase\JWT\JWT;

class Filterauth implements FilterInterface
{
    function __construct()
    {
        helper(['cookie']);
        $this->_db      = \Config\Database::connect();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $compliteProfile = $decoded->data->compliteProfile;

                    $uri = current_url(true);
                    $totalSegment = $uri->getTotalSegments();
                    if ($totalSegment == 0) {
                        return redirect()->to(base_url('web/home'));
                    }
                    $uriMain = $uri->getSegment(1);
                    $uriMain1 = $uri->getSegment(2);

                    if ($uriMain != 'maintenance') {
                        $maintenanceLib = new Maintenancelib();

                        $response = $maintenanceLib->cekMaintenance();

                        if ($response > 0) {
                            if ($role == 1 || $role == 11 || ($role == 3 && ($userId == '651f62fc-0d44-4cb1-b460-fc2c418851cf' || $userId == 'eccc941d-c49e-484d-af93-ee64cad00720'))  || ($role == 6 && $userId == '648676b3-c64e-4f43-a10e-a02579486c6c') || ($role == 4 && ($userId == 'd37ade92-1fd9-4f5d-910f-5b80b98f4fba' || $userId == '7ad19bf3-0274-4f91-a4b7-5fa4b40075c9' || $userId == '88e07290-2229-4f8b-bb70-f0fde139c382'))) {
                                // if($role == 1 || $role == 2 || $role == 11 || ($role == 3 && ($userId == '651f62fc-0d44-4cb1-b460-fc2c418851cf' || $userId == 'eccc941d-c49e-484d-af93-ee64cad00720'))  || ($role == 6 && $userId == '648676b3-c64e-4f43-a10e-a02579486c6c') || ($role == 4 && ($userId == 'd37ade92-1fd9-4f5d-910f-5b80b98f4fba' || $userId == '7ad19bf3-0274-4f91-a4b7-5fa4b40075c9'))) {
                                if ($uriMain === "dashboard" || $uriMain === "" || $uriMain === "web" || $uriMain === "auth") {
                                } else {
                                    if ($role == 1) {
                                        if ($uriMain != "superadmin") {
                                            return redirect()->to(base_url('superadmin/home'));
                                        }
                                    } else if ($role == 2) {
                                        if ($uriMain != "admin") {
                                            return redirect()->to(base_url('admin/home'));
                                        }

                                        $urlAkses = $uri->getSegment(3);
                                        if ($urlAkses == "masterdata" || $urlAkses == "usulan" || $urlAkses == "upload") {
                                            $verifikasiAksesLib = new Verifikasihakakseslib();
                                            $akses = $verifikasiAksesLib->cekHakAkses();

                                            if ($akses) {
                                                $urlAksesControl = $uri->getPath();
                                                if ($urlAkses == "masterdata") {
                                                    if ($urlAksesControl == "v1/admin/masterdata/pengguna" || $urlAksesControl == "v1/admin/masterdata/pengguna/getAll") {
                                                        if ((int)$akses->pengguna == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }
                                                    if ($urlAksesControl == "v1/admin/masterdata/pengguna/addSave") {
                                                        if ((int)$akses->pengguna_add == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/pengguna/resetPassword") {
                                                        if ((int)$akses->pengguna_resetpassword == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/pengguna/delete" || $urlAksesControl == "v1/admin/masterdata/pengguna/resetAkun") {
                                                        if ((int)$akses->pengguna_delete == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/gaji" || $urlAksesControl == "v1/admin/masterdata/gaji/getAll") {
                                                        if ((int)$akses->gaji == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/gaji/import" || $urlAksesControl == "v1/admin/masterdata/gaji/add" || $urlAksesControl == "v1/admin/masterdata/gaji/uploadData" || $urlAksesControl == "v1/admin/masterdata/gaji/importData") {
                                                        if ((int)$akses->gaji_add == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/gaji/editSave") {
                                                        if ((int)$akses->gaji_edit == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/ptk" || $urlAksesControl == "v1/admin/masterdata/ptk/getAll") {
                                                        if ((int)$akses->ptk == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/ptk/unlockPtk") {
                                                        if ((int)$akses->ptk_unlock == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/ptk/import" || $urlAksesControl == "v1/admin/masterdata/ptk/uploadData" || $urlAksesControl == "v1/admin/masterdata/ptk/importData") {
                                                        if ((int)$akses->ptk_update == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/sekolah" || $urlAksesControl == "v1/admin/masterdata/sekolah/getAll") {
                                                        if ((int)$akses->sekolah == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/sekolah/import" || $urlAksesControl == "v1/admin/masterdata/sekolah/uploadData" || $urlAksesControl == "v1/admin/masterdata/sekolah/importData") {
                                                        if ((int)$akses->sekolah_update == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/tahuntw" || $urlAksesControl == "v1/admin/masterdata/tahuntw/getAll") {
                                                        if ((int)$akses->triwulan == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/tahuntw/addSave") {
                                                        if ((int)$akses->triwulan_add == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/masterdata/tahuntw/aktifkan") {
                                                        if ((int)$akses->triwulan_aktifan == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }
                                                }
                                                if ($urlAkses == "usulan") {
                                                    if ((int)$akses->usulan == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    $urlAksesUsulan = $uri->getSegment(4);
                                                    if ($urlAksesUsulan == "tpg" && (int)$akses->usulan_tpg == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/antrian" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/getAll") {
                                                        if ((int)$akses->usulan_tpg_antrian == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/antrian/detail" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/detailUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/tolakUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/setujuiUsulanPtk") {
                                                        if ((int)$akses->usulan_tpg_verifikasi == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/ditolak" || $urlAksesControl == "v1/admin/usulan/tpg/ditolak/getAll") {
                                                        if ((int)$akses->usulan_tpg_ditolak == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/disetujui" || $urlAksesControl == "v1/admin/usulan/tpg/disetujui/getAll") {
                                                        if ((int)$akses->usulan_tpg_disetujui == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/siapsk" || $urlAksesControl == "v1/admin/usulan/tpg/siapsk/getAll") {
                                                        if ((int)$akses->usulan_tpg_siapsk == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/terbitsk" || $urlAksesControl == "v1/admin/usulan/tpg/terbitsk/getAll") {
                                                        if ((int)$akses->usulan_tpg_terbitsk == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tpg/prosestransfer" || $urlAksesControl == "v1/admin/usulan/tpg/prosestransfer/getAll") {
                                                        if ((int)$akses->usulan_tpg_prosestransfer == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    $urlAksesUsulan = $uri->getSegment(4);
                                                    if ($urlAksesUsulan == "tamsil" && (int)$akses->usulan_tamsil == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tamsil/antrian" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/getAll") {
                                                        if ((int)$akses->usulan_tamsil_antrian == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tamsil/antrian/detail" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/detailUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/tolakUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/setujuiUsulanPtk") {
                                                        if ((int)$akses->usulan_tamsil_verifikasi == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tamsil/ditolak" || $urlAksesControl == "v1/admin/usulan/tamsil/ditolak/getAll") {
                                                        if ((int)$akses->usulan_tamsil_ditolak == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tamsil/disetujui" || $urlAksesControl == "v1/admin/usulan/tamsil/disetujui/getAll") {
                                                        if ((int)$akses->usulan_tamsil_disetujui == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/usulan/tamsil/prosestransfer" || $urlAksesControl == "v1/admin/usulan/tamsil/prosestransfer/getAll") {
                                                        if ((int)$akses->usulan_tamsil_prosestransfer == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }
                                                }
                                                if ($urlAkses == "spj") {
                                                    if ((int)$akses->spj == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    $urlAksesUsulan = $uri->getSegment(4);
                                                    if ($urlAksesUsulan == "tpg" && (int)$akses->spj_tpg == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tpg/antrian" || $urlAksesControl == "v1/admin/spj/tpg/antrian/getAll") {
                                                        if ((int)$akses->spj_tpg_antrian == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tpg/antrian/detail" || $urlAksesControl == "v1/admin/spj/tpg/antrian/tolakUpload" || $urlAksesControl == "v1/admin/spj/tpg/antrian/setujuiUpload") {
                                                        if ((int)$akses->spj_tpg_verifikasi == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tpg/belum" || $urlAksesControl == "v1/admin/spj/tpg/belum/getAll") {
                                                        if ((int)$akses->spj_tpg_belum == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tpg/disetujui" || $urlAksesControl == "v1/admin/spj/tpg/disetujui/getAll") {
                                                        if ((int)$akses->spj_tpg_disetujui == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    $urlAksesUsulan = $uri->getSegment(4);
                                                    if ($urlAksesUsulan == "tamsil" && (int)$akses->spj_tamsil == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tamsil/antrian" || $urlAksesControl == "v1/admin/spj/tamsil/antrian/getAll") {
                                                        if ((int)$akses->spj_tamsil_antrian == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tamsil/antrian/detail" || $urlAksesControl == "v1/admin/spj/tamsil/antrian/tolakUpload" || $urlAksesControl == "v1/admin/spj/tamsil/antrian/setujuiUpload") {
                                                        if ((int)$akses->spj_tamsil_verifikasi == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tamsil/belum" || $urlAksesControl == "v1/admin/spj/tamsil/belum/getAll") {
                                                        if ((int)$akses->spj_tamsil_belum == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/spj/tamsil/disetujui" || $urlAksesControl == "v1/admin/spj/tamsil/disetujui/getAll") {
                                                        if ((int)$akses->spj_tamsil_disetujui == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }
                                                }
                                                if ($urlAkses == "upload") {
                                                    if ((int)$akses->upload == 0) {
                                                        return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/admin/upload/matching" || $urlAksesControl == "v1/admin/upload/matching/uploadData" || $urlAksesControl == "v1/admin/upload/matching/importData") {
                                                        if ((int)$akses->upload_matching == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/upload/terbitsk" || $urlAksesControl == "v1/admin/upload/terbitsk/uploadData" || $urlAksesControl == "v1/admin/upload/terbitsk/importData") {
                                                        if ((int)$akses->upload_terbitsk == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/admin/upload/prosestransfer" || $urlAksesControl == "v1/admin/upload/prosestransfer/uploadData" || $urlAksesControl == "v1/admin/upload/prosestransfer/importData") {
                                                        if ((int)$akses->upload_prosestransfer == 0) {
                                                            return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                        }
                                                    }
                                                }
                                            } else {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }
                                        }
                                    } else if ($role == 3) {
                                        if ($uriMain != "dinas") {
                                            return redirect()->to(base_url('dinas/home'));
                                        }
                                    } else if ($role == 4) {
                                        if ($uriMain != "sekolah") {
                                            return redirect()->to(base_url('sekolah/home'));
                                        }
                                        if (!$compliteProfile) {
                                            if ($uri->getSegment(2) != 'user') {
                                                if ($uri->getSegment(2) != 'referensi') {
                                                    return redirect()->to(base_url('sekolah/user/profile'));
                                                }
                                            }
                                        }
                                    } else if ($role == 6) {
                                        if ($uriMain != "peserta") {
                                            return redirect()->to(base_url('peserta/home'));
                                        }

                                        if (!$compliteProfile) {
                                            if ($uri->getSegment(2) != 'user') {
                                                if ($uri->getSegment(2) != 'referensi') {
                                                    return redirect()->to(base_url('peserta/user/profile'));
                                                }
                                            }
                                        }
                                    } else if ($role == 5) {
                                        if ($uriMain != "kecamatan") {
                                            return redirect()->to(base_url('kecamatan/home'));
                                        }

                                        $urlAkses = $uri->getSegment(3);
                                        if ($urlAkses == "masterdata" || $urlAkses == "usulan" || $urlAkses == "upload") {
                                            $verifikasiAksesLib = new Verifikasihakakseslib();
                                            $akses = $verifikasiAksesLib->cekHakAkses();

                                            if ($akses) {
                                                $urlAksesControl = $uri->getPath();
                                                if ($urlAkses == "masterdata") {
                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/pengguna" || $urlAksesControl == "v1/kecamatan/masterdata/pengguna/getAll") {
                                                        if ((int)$akses->pengguna == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }
                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/pengguna/addSave") {
                                                        if ((int)$akses->pengguna_add == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/pengguna/resetPassword") {
                                                        if ((int)$akses->pengguna_resetpassword == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/pengguna/delete" || $urlAksesControl == "v1/kecamatan/masterdata/pengguna/resetAkun") {
                                                        if ((int)$akses->pengguna_delete == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/gaji" || $urlAksesControl == "v1/kecamatan/masterdata/gaji/getAll") {
                                                        if ((int)$akses->gaji == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/gaji/import" || $urlAksesControl == "v1/kecamatan/masterdata/gaji/add" || $urlAksesControl == "v1/kecamatan/masterdata/gaji/uploadData" || $urlAksesControl == "v1/kecamatan/masterdata/gaji/importData") {
                                                        if ((int)$akses->gaji_add == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/gaji/editSave") {
                                                        if ((int)$akses->gaji_edit == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/ptk" || $urlAksesControl == "v1/kecamatan/masterdata/ptk/getAll") {
                                                        if ((int)$akses->ptk == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/ptk/unlockPtk") {
                                                        if ((int)$akses->ptk_unlock == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/ptk/import" || $urlAksesControl == "v1/kecamatan/masterdata/ptk/uploadData" || $urlAksesControl == "v1/kecamatan/masterdata/ptk/importData") {
                                                        if ((int)$akses->ptk_update == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/sekolah" || $urlAksesControl == "v1/kecamatan/masterdata/sekolah/getAll") {
                                                        if ((int)$akses->sekolah == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/sekolah/import" || $urlAksesControl == "v1/kecamatan/masterdata/sekolah/uploadData" || $urlAksesControl == "v1/kecamatan/masterdata/sekolah/importData") {
                                                        if ((int)$akses->sekolah_update == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/tahuntw" || $urlAksesControl == "v1/kecamatan/masterdata/tahuntw/getAll") {
                                                        if ((int)$akses->triwulan == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/tahuntw/addSave") {
                                                        if ((int)$akses->triwulan_add == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/masterdata/tahuntw/aktifkan") {
                                                        if ((int)$akses->triwulan_aktifan == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }
                                                }
                                                if ($urlAkses == "usulan") {
                                                    if ((int)$akses->usulan == 0) {
                                                        return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                    }

                                                    $urlAksesUsulan = $uri->getSegment(4);
                                                    if ($urlAksesUsulan == "tpg" && (int)$akses->usulan_tpg == 0) {
                                                        return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/antrian" || $urlAksesControl == "v1/kecamatan/usulan/tpg/antrian/getAll") {
                                                        if ((int)$akses->usulan_tpg_antrian == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/antrian/detailUsulanPtk" || $urlAksesControl == "v1/kecamatan/usulan/tpg/antrian/tolakUsulanPtk" || $urlAksesControl == "v1/kecamatan/usulan/tpg/antrian/setujuiUsulanPtk") {
                                                        if ((int)$akses->usulan_tpg_verifikasi == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/ditolak" || $urlAksesControl == "v1/kecamatan/usulan/tpg/ditolak/getAll") {
                                                        if ((int)$akses->usulan_tpg_ditolak == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/disetujui" || $urlAksesControl == "v1/kecamatan/usulan/tpg/disetujui/getAll") {
                                                        if ((int)$akses->usulan_tpg_disetujui == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/siapsk" || $urlAksesControl == "v1/kecamatan/usulan/tpg/siapsk/getAll") {
                                                        if ((int)$akses->usulan_tpg_siapsk == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/terbitsk" || $urlAksesControl == "v1/kecamatan/usulan/tpg/terbitsk/getAll") {
                                                        if ((int)$akses->usulan_tpg_terbitsk == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tpg/prosestransfer" || $urlAksesControl == "v1/kecamatan/usulan/tpg/prosestransfer/getAll") {
                                                        if ((int)$akses->usulan_tpg_prosestransfer == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    $urlAksesUsulan = $uri->getSegment(4);
                                                    if ($urlAksesUsulan == "tamsil" && (int)$akses->usulan_tamsil == 0) {
                                                        return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tamsil/antrian" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/antrian/getAll") {
                                                        if ((int)$akses->usulan_tamsil_antrian == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tamsil/antrian/detail" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/antrian/detailUsulanPtk" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/antrian/tolakUsulanPtk" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/antrian/setujuiUsulanPtk") {
                                                        if ((int)$akses->usulan_tamsil_verifikasi == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tamsil/ditolak" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/ditolak/getAll") {
                                                        if ((int)$akses->usulan_tamsil_ditolak == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tamsil/disetujui" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/disetujui/getAll") {
                                                        if ((int)$akses->usulan_tamsil_disetujui == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/usulan/tamsil/prosestransfer" || $urlAksesControl == "v1/kecamatan/usulan/tamsil/prosestransfer/getAll") {
                                                        if ((int)$akses->usulan_tamsil_prosestransfer == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }
                                                }
                                                if ($urlAkses == "upload") {
                                                    if ((int)$akses->upload == 0) {
                                                        return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/upload/matching" || $urlAksesControl == "v1/kecamatan/upload/matching/uploadData" || $urlAksesControl == "v1/kecamatan/upload/matching/importData") {
                                                        if ((int)$akses->upload_matching == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/upload/terbitsk" || $urlAksesControl == "v1/kecamatan/upload/terbitsk/uploadData" || $urlAksesControl == "v1/kecamatan/upload/terbitsk/importData") {
                                                        if ((int)$akses->upload_terbitsk == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }

                                                    if ($urlAksesControl == "v1/kecamatan/upload/prosestransfer" || $urlAksesControl == "v1/kecamatan/upload/prosestransfer/uploadData" || $urlAksesControl == "v1/kecamatan/upload/prosestransfer/importData") {
                                                        if ((int)$akses->upload_prosestransfer == 0) {
                                                            return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                                        }
                                                    }
                                                }
                                            } else {
                                                return redirect()->to(base_url('v1/kecamatan/aksesallowed'));
                                            }
                                        }
                                    } else {
                                        return redirect()->to(base_url('dashboard'));
                                    }
                                }
                            } else {
                                return redirect()->to(base_url('maintenance') . '/index');
                            }
                        }

                        if ($uriMain === "dashboard" || $uriMain === "" || $uriMain === "web" || $uriMain === "auth") {
                        } else {
                            if ($role == 1) {
                                if ($uriMain != "superadmin") {
                                    return redirect()->to(base_url('superadmin/home'));
                                }
                            } else if ($role == 2) {
                                if ($uriMain != "admin") {
                                    return redirect()->to(base_url('admin/home'));
                                }

                                $urlAkses = $uri->getSegment(3);
                                if ($urlAkses == "masterdata" || $urlAkses == "usulan" || $urlAkses == "upload") {
                                    $verifikasiAksesLib = new Verifikasihakakseslib();
                                    $akses = $verifikasiAksesLib->cekHakAkses();

                                    if ($akses) {
                                        $urlAksesControl = $uri->getPath();
                                        if ($urlAkses == "masterdata") {
                                            if ($urlAksesControl == "v1/admin/masterdata/pengguna" || $urlAksesControl == "v1/admin/masterdata/pengguna/getAll") {
                                                if ((int)$akses->pengguna == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }
                                            if ($urlAksesControl == "v1/admin/masterdata/pengguna/addSave") {
                                                if ((int)$akses->pengguna_add == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/pengguna/resetPassword") {
                                                if ((int)$akses->pengguna_resetpassword == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/pengguna/delete" || $urlAksesControl == "v1/admin/masterdata/pengguna/resetAkun") {
                                                if ((int)$akses->pengguna_delete == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/gaji" || $urlAksesControl == "v1/admin/masterdata/gaji/getAll") {
                                                if ((int)$akses->gaji == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/gaji/import" || $urlAksesControl == "v1/admin/masterdata/gaji/add" || $urlAksesControl == "v1/admin/masterdata/gaji/uploadData" || $urlAksesControl == "v1/admin/masterdata/gaji/importData") {
                                                if ((int)$akses->gaji_add == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/gaji/editSave") {
                                                if ((int)$akses->gaji_edit == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/ptk" || $urlAksesControl == "v1/admin/masterdata/ptk/getAll") {
                                                if ((int)$akses->ptk == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/ptk/unlockPtk") {
                                                if ((int)$akses->ptk_unlock == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/ptk/import" || $urlAksesControl == "v1/admin/masterdata/ptk/uploadData" || $urlAksesControl == "v1/admin/masterdata/ptk/importData") {
                                                if ((int)$akses->ptk_update == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/sekolah" || $urlAksesControl == "v1/admin/masterdata/sekolah/getAll") {
                                                if ((int)$akses->sekolah == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/sekolah/import" || $urlAksesControl == "v1/admin/masterdata/sekolah/uploadData" || $urlAksesControl == "v1/admin/masterdata/sekolah/importData") {
                                                if ((int)$akses->sekolah_update == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/tahuntw" || $urlAksesControl == "v1/admin/masterdata/tahuntw/getAll") {
                                                if ((int)$akses->triwulan == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/tahuntw/addSave") {
                                                if ((int)$akses->triwulan_add == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/masterdata/tahuntw/aktifkan") {
                                                if ((int)$akses->triwulan_aktifan == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }
                                        }
                                        if ($urlAkses == "usulan") {
                                            if ((int)$akses->usulan == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            $urlAksesUsulan = $uri->getSegment(4);
                                            if ($urlAksesUsulan == "tpg" && (int)$akses->usulan_tpg == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/antrian" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/getAll") {
                                                if ((int)$akses->usulan_tpg_antrian == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/antrian/detail" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/detailUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/tolakUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tpg/antrian/setujuiUsulanPtk") {
                                                if ((int)$akses->usulan_tpg_verifikasi == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/ditolak" || $urlAksesControl == "v1/admin/usulan/tpg/ditolak/getAll") {
                                                if ((int)$akses->usulan_tpg_ditolak == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/disetujui" || $urlAksesControl == "v1/admin/usulan/tpg/disetujui/getAll") {
                                                if ((int)$akses->usulan_tpg_disetujui == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/siapsk" || $urlAksesControl == "v1/admin/usulan/tpg/siapsk/getAll") {
                                                if ((int)$akses->usulan_tpg_siapsk == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/terbitsk" || $urlAksesControl == "v1/admin/usulan/tpg/terbitsk/getAll") {
                                                if ((int)$akses->usulan_tpg_terbitsk == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tpg/prosestransfer" || $urlAksesControl == "v1/admin/usulan/tpg/prosestransfer/getAll") {
                                                if ((int)$akses->usulan_tpg_prosestransfer == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            $urlAksesUsulan = $uri->getSegment(4);
                                            if ($urlAksesUsulan == "tamsil" && (int)$akses->usulan_tamsil == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tamsil/antrian" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/getAll") {
                                                if ((int)$akses->usulan_tamsil_antrian == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tamsil/antrian/detail" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/detailUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/tolakUsulanPtk" || $urlAksesControl == "v1/admin/usulan/tamsil/antrian/setujuiUsulanPtk") {
                                                if ((int)$akses->usulan_tamsil_verifikasi == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tamsil/ditolak" || $urlAksesControl == "v1/admin/usulan/tamsil/ditolak/getAll") {
                                                if ((int)$akses->usulan_tamsil_ditolak == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tamsil/disetujui" || $urlAksesControl == "v1/admin/usulan/tamsil/disetujui/getAll") {
                                                if ((int)$akses->usulan_tamsil_disetujui == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/usulan/tamsil/prosestransfer" || $urlAksesControl == "v1/admin/usulan/tamsil/prosestransfer/getAll") {
                                                if ((int)$akses->usulan_tamsil_prosestransfer == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }
                                        }
                                        if ($urlAkses == "spj") {
                                            if ((int)$akses->spj == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            $urlAksesUsulan = $uri->getSegment(4);
                                            if ($urlAksesUsulan == "tpg" && (int)$akses->spj_tpg == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tpg/antrian" || $urlAksesControl == "v1/admin/spj/tpg/antrian/getAll") {
                                                if ((int)$akses->spj_tpg_antrian == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tpg/antrian/detail" || $urlAksesControl == "v1/admin/spj/tpg/antrian/tolakUpload" || $urlAksesControl == "v1/admin/spj/tpg/antrian/setujuiUpload") {
                                                if ((int)$akses->spj_tpg_verifikasi == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tpg/belum" || $urlAksesControl == "v1/admin/spj/tpg/belum/getAll") {
                                                if ((int)$akses->spj_tpg_belum == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tpg/disetujui" || $urlAksesControl == "v1/admin/spj/tpg/disetujui/getAll") {
                                                if ((int)$akses->spj_tpg_disetujui == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            $urlAksesUsulan = $uri->getSegment(4);
                                            if ($urlAksesUsulan == "tamsil" && (int)$akses->spj_tamsil == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tamsil/antrian" || $urlAksesControl == "v1/admin/spj/tamsil/antrian/getAll") {
                                                if ((int)$akses->spj_tamsil_antrian == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tamsil/antrian/detail" || $urlAksesControl == "v1/admin/spj/tamsil/antrian/tolakUpload" || $urlAksesControl == "v1/admin/spj/tamsil/antrian/setujuiUpload") {
                                                if ((int)$akses->spj_tamsil_verifikasi == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tamsil/belum" || $urlAksesControl == "v1/admin/spj/tamsil/belum/getAll") {
                                                if ((int)$akses->spj_tamsil_belum == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/spj/tamsil/disetujui" || $urlAksesControl == "v1/admin/spj/tamsil/disetujui/getAll") {
                                                if ((int)$akses->spj_tamsil_disetujui == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }
                                        }
                                        if ($urlAkses == "upload") {
                                            if ((int)$akses->upload == 0) {
                                                return redirect()->to(base_url('v1/admin/aksesallowed'));
                                            }

                                            if ($urlAksesControl == "v1/admin/upload/matching" || $urlAksesControl == "v1/admin/upload/matching/uploadData" || $urlAksesControl == "v1/admin/upload/matching/importData") {
                                                if ((int)$akses->upload_matching == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/upload/terbitsk" || $urlAksesControl == "v1/admin/upload/terbitsk/uploadData" || $urlAksesControl == "v1/admin/upload/terbitsk/importData") {
                                                if ((int)$akses->upload_terbitsk == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }

                                            if ($urlAksesControl == "v1/admin/upload/prosestransfer" || $urlAksesControl == "v1/admin/upload/prosestransfer/uploadData" || $urlAksesControl == "v1/admin/upload/prosestransfer/importData") {
                                                if ((int)$akses->upload_prosestransfer == 0) {
                                                    return redirect()->to(base_url('v1/admin/aksesallowed'));
                                                }
                                            }
                                        }
                                    } else {
                                        return redirect()->to(base_url('admin/aksesallowed'));
                                    }
                                }
                            } else if ($role == 0) {
                                if ($uriMain != "client") {
                                    return redirect()->to(base_url('client/home'));
                                }

                                if (!session()->has('completeProfil')) {
                                    if ($uri->getSegment(2) != 'user') {
                                        return redirect()->to(base_url('client/user/profile'));
                                    }
                                }
                            } else if ($role == 3) {
                                if ($uriMain != "dinas") {
                                    return redirect()->to(base_url('dinas/home'));
                                }

                                // if (!session()->has('completeProfil')) {
                                //     if ($uri->getSegment(2) != 'user') {
                                //         return redirect()->to(base_url('v1/dinas/user/profile'));
                                //     }
                                // }
                            } else if ($role == 4) {
                                if ($uriMain != "sekolah") {
                                    return redirect()->to(base_url('sekolah/home'));
                                }
                                if (!$compliteProfile) {
                                    if ($uri->getSegment(2) != 'user') {
                                        if ($uri->getSegment(2) != 'referensi') {
                                            return redirect()->to(base_url('sekolah/user/profile'));
                                        }
                                    }
                                }
                            } else if ($role == 6) {
                                // var_dump("error");die;
                                if ($uriMain != "peserta") {
                                    return redirect()->to(base_url('peserta/home'));
                                }

                                if (!$compliteProfile) {
                                    if ($uri->getSegment(2) != 'user') {
                                        if ($uri->getSegment(2) != 'referensi') {
                                            return redirect()->to(base_url('peserta/user/profile'));
                                        }
                                    }
                                }
                            } else {
                                return redirect()->to(base_url('dashboard'));
                            }
                        }
                    }
                } else {
                    // delete_cookie('jwt');
                    // session()->destroy();
                    $uri = current_url(true);
                    $totalSegment = $uri->getTotalSegments();
                    if ($totalSegment == 0) {
                        return redirect()->to(base_url('web/home'));
                    }
                    $uriMain = $uri->getSegment(1);
                    if ($uriMain != 'maintenance') {
                        $maintenanceLib = new Maintenancelib();

                        $response = $maintenanceLib->cekMaintenance();

                        if ($response > 0) {
                            if ($uriMain == "web") {
                            } else {
                                return redirect()->to(base_url('maintenance') . '/index');
                            }
                        } else {
                            if ($uriMain == "web" || $uriMain == "auth") {
                            } else {
                                return redirect()->to(base_url('web/home'));
                            }
                        }
                    } else {
                    }
                }
            } catch (\Exception $e) {
                // delete_cookie('jwt');
                // session()->destroy();
                $uri = current_url(true);
                $totalSegment = $uri->getTotalSegments();
                if ($totalSegment == 0) {
                    return redirect()->to(base_url('web/home'));
                }
                $uriMain = $uri->getSegment(1);
                if ($uriMain != 'maintenance') {
                    $maintenanceLib = new Maintenancelib();

                    $response = $maintenanceLib->cekMaintenance();

                    if ($response > 0) {
                        if ($uriMain == "web") {
                        } else {
                            return redirect()->to(base_url('maintenance') . '/index');
                        }
                    } else {
                        if ($uriMain == "web" || $uriMain == "auth") {
                        } else {
                            return redirect()->to(base_url('web/home'));
                        }
                    }
                } else {
                }
            }
        } else {
            $uri = current_url(true);
            $totalSegment = $uri->getTotalSegments();
            if ($totalSegment == 0) {
                return redirect()->to(base_url('web/home'));
            }
            $uriMain = $uri->getSegment(1);
            if ($uriMain != 'maintenance') {
                $maintenanceLib = new Maintenancelib();

                $response = $maintenanceLib->cekMaintenance();

                if ($response > 0) {
                    if ($uriMain == "web") {
                    } else {
                        return redirect()->to(base_url('maintenance') . '/index');
                    }
                } else {
                    if ($uriMain == "web" || $uriMain == "auth") {
                    } else {
                        return redirect()->to(base_url('web/home'));
                    }
                }
            } else {
            }
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $jwt = get_cookie('jwt');
        $token_jwt = getenv('token_jwt.default.key');
        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, $token_jwt, array('HS256'));
                if ($decoded) {
                    $userId = $decoded->data->id;
                    $role = $decoded->data->role;
                    $uri = current_url(true);
                    $totalSegment = $uri->getTotalSegments();
                    if ($totalSegment == 0) {
                        return redirect()->to(base_url('web/home'));
                    }
                    $uriMain = $uri->getSegment(1);
                    if ($uriMain != 'maintenance') {
                        $maintenanceLib = new Maintenancelib();

                        $response = $maintenanceLib->cekMaintenance();

                        if ($response > 0) {
                            if ($role == 1 || ($role == 3 && ($userId == '651f62fc-0d44-4cb1-b460-fc2c418851cf' || $userId == 'eccc941d-c49e-484d-af93-ee64cad00720')) || ($role == 6 && $userId == '648676b3-c64e-4f43-a10e-a02579486c6c') || ($role == 4 && ($userId == 'd37ade92-1fd9-4f5d-910f-5b80b98f4fba' || $userId == '7ad19bf3-0274-4f91-a4b7-5fa4b40075c9' || $userId == '88e07290-2229-4f8b-bb70-f0fde139c382'))) {
                                // if($role == 1 || $role == 2 || ($role == 3 && ($userId == '651f62fc-0d44-4cb1-b460-fc2c418851cf' || $userId == 'eccc941d-c49e-484d-af93-ee64cad00720')) || ($role == 6 && $userId == '648676b3-c64e-4f43-a10e-a02579486c6c') || ($role == 4 && ($userId == 'd37ade92-1fd9-4f5d-910f-5b80b98f4fba' || $userId == '7ad19bf3-0274-4f91-a4b7-5fa4b40075c9'))) {
                                if ($uriMain === "dashboard" || $uriMain === "" || $uriMain === "web" || $uriMain === "auth") {
                                } else {
                                    if ($role == 1) {
                                        return redirect()->to(base_url('superadmin/home'));
                                    } else if ($role == 2) {
                                        return redirect()->to(base_url('admin/home'));
                                    } else if ($role == 3) {
                                        return redirect()->to(base_url('dinas/home'));
                                    } else if ($role == 4) {
                                        return redirect()->to(base_url('sekolah/home'));
                                    } else if ($role == 0) {
                                        return redirect()->to(base_url('client/home'));
                                    } else if ($role == 6) {
                                        return redirect()->to(base_url('peserta/home'));
                                    } else {
                                        return redirect()->to(base_url('dashboard'));
                                    }
                                }
                            } else {
                                return redirect()->to(base_url('maintenance') . '/index');
                            }
                        }

                        if ($uriMain === "dashboard" || $uriMain === "" || $uriMain === "web" || $uriMain === "auth") {
                        } else {
                            if ($role == 1) {
                                return redirect()->to(base_url('superadmin/home'));
                            } else if ($role == 2) {
                                return redirect()->to(base_url('admin/home'));
                            } else if ($role == 3) {
                                return redirect()->to(base_url('dinas/home'));
                            } else if ($role == 4) {
                                return redirect()->to(base_url('sekolah/home'));
                            } else if ($role == 0) {
                                return redirect()->to(base_url('client/home'));
                            } else if ($role == 6) {
                                return redirect()->to(base_url('peserta/home'));
                            } else {
                                return redirect()->to(base_url('dashboard'));
                            }
                        }
                    }
                } else {
                    // delete_cookie('jwt');
                    // session()->destroy();
                    $uri = current_url(true);
                    $totalSegment = $uri->getTotalSegments();
                    if ($totalSegment == 0) {
                        return redirect()->to(base_url('web/home'));
                    }
                    $uriMain = $uri->getSegment(1);
                    if ($uriMain != 'auth') {
                        return redirect()->to(base_url('web/home'));
                    }
                }
            } catch (\Exception $e) {
                // delete_cookie('jwt');
                // session()->destroy();
                $uri = current_url(true);
                $totalSegment = $uri->getTotalSegments();
                if ($totalSegment == 0) {
                    return redirect()->to(base_url('web/home'));
                }
                $uriMain = $uri->getSegment(1);
                if ($uriMain != 'auth') {
                    return redirect()->to(base_url('web/home'));
                }
            }
        } else {
            $uri = current_url(true);
            $totalSegment = $uri->getTotalSegments();
            if ($totalSegment == 0) {
                return redirect()->to(base_url('web/home'));
            }
            $uriMain = $uri->getSegment(1);
            if ($uriMain != 'auth') {
                return redirect()->to(base_url('web/home'));
            }
        }
    }
}
