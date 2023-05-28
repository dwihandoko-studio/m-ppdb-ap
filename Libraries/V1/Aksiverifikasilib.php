<?php

namespace App\Libraries\V1;
use App\Libraries\Uuid;
use App\Libraries\V1\Reftahuntwlib;
use App\Libraries\Emaillib;

class Aksiverifikasilib
{
    private $_db;
    // private $tb_setting;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
        // $this->tb  = $this->_db->table('_ref_tahun_tw');
    }
    
    private function getTwAktif() {
        
        $twLib = new Reftahuntwlib();
        
        $twAktive = $twLib->getCurrentTahunTw();
        
        if(!$twAktive) {
            return false;
        }
        
        return $twAktive;
        
    }
    
    public function _send_notif_touser_spj_tolak($id_tahun_tw, $kode_usulan, $keterangan, $id_ptk, $jenis = "TPG") {
        $twAktive = $this->_db->table('_ref_tahun_tw')->where('id', $id_tahun_tw)->get()->getRowObject();
        
        $ptk = $this->_db->table('_ptk_tb')->where('id', $id_ptk)->get()->getRowObject();
        
        if($twAktive && $ptk) {
            try {
                $emailLib = new EmailLib();
                $sended = $emailLib->sendNotifikasi($ptk->email, "Laporan SPJ USULAN " . $jenis . " Tahun " . $twAktive->tahun . ' Triwulan ' . $twAktive->tw . ' Kode ' . $kode_usulan . ' Ditolak.' , '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
            Laporan SPJ USULAN ' . $jenis . ' anda tahun ' . $twAktive->tahun . ' triwulan ' . $twAktive->tw . ' dengan Kode Usulan ' . $kode_usulan . ' <b>GAGAL LOLOS VERIFIKASI</b> dikarenakan :
        </p><p>' . $keterangan . '</p>');
            } catch (Exception $exep) {
            }
        }
    }

    public function _send_notif_touser_spj_approved($id_tahun_tw, $kode_usulan, $id_ptk, $jenis = "TPG") {
        $twAktive = $this->_db->table('_ref_tahun_tw')->where('id', $id_tahun_tw)->get()->getRowObject();
        
        $ptk = $this->_db->table('_ptk_tb')->where('id', $id_ptk)->get()->getRowObject();
        
        if($twAktive && $ptk) {
            try {
                $emailLib = new EmailLib();
                $sended = $emailLib->sendNotifikasi($ptk->email, "Laporan SPJ USULAN " . $jenis . " Tahun " . $twAktive->tahun . ' Triwulan ' . $twAktive->tw . ' Kode ' . $kode_usulan . ' Diterima.' , '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
            Laporan SPJ USULAN ' . $jenis . ' anda tahun ' . $twAktive->tahun . ' triwulan ' . $twAktive->tw . ' dengan Kode Usulan ' . $kode_usulan . ' <b>TELAS LOLOS VERIFIKASI</b>.</p><p>Terima Kasih sudah melakukan proses pelaporan SPJ anda.</p>');
            } catch (Exception $exep) {
            }
        }
    }

    public function _send_notif_touser($twAktive, $dataPtk, $kode_usulan, $keterangan, $idUsulan) {
        try {
            $emailLib = new EmailLib();
            $sended = $emailLib->sendNotifikasi($dataPtk->email, "Usulan TPG Tahun " . $twAktive->tahun . ' Triwulan ' . $twAktive->tw . ' Kode ' . $kode_usulan . ' Ditolak.' , '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
        Permohonan usulan TPG anda tahun ' . $twAktive->tahun . ' triwulan ' . $twAktive->tw . ' dengan Kode Usulan ' . $kode_usulan . ' <b>GAGAL LOLOS VERIFIKASI BERKAS</b> dikarenakan :
    </p><p>' . $keterangan . '</p>');
            if($sended->code == 200) {
                $this->_db->table('_tb_usulan_detail_tpg')->where('id', $idUsulan)->update(['notif_tolak' => 1]);
            }
        } catch (Exception $exep) {
        }
    }

    public function _send_notif_touser_terbitsk($twAktive, $dataPtk, $kode_usulan, $no_sk_dirgen, $no_urut_sk, $idUsulan, $keterangan) {
        try {
            $emailLib = new EmailLib();
            $sended = $emailLib->sendNotifikasi($dataPtk->email, "Usulan TPG Tahun " . $twAktive->tahun . ' Triwulan ' . $twAktive->tw . ' dengan Kode ' . $kode_usulan . ' Telah Terbit SK.' , '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
        Usulan pencairan TPG anda tahun ' . $twAktive->tahun . ' triwulan ' . $twAktive->tw . ' dengan Kode Usulan ' . $kode_usulan . ' <b>TELAH TERBIT SKTP DENGAN NOMOR : ' . $no_sk_dirgen . ' NO URUT: ' . $no_urut_sk . '</b><p><p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">' . $keterangan .'</p>');
            if($sended->code == 200) {
                $this->_db->table('_tb_usulan_tpg_siap_sk')->where('id', $idUsulan)->update(['notif_tolak' => 1]);
            }
        } catch (Exception $exep) {
        }
    }

    public function _send_notif_touser_prosestransfer($twAktive, $dataPtk, $kode_usulan, $no_sk_dirgen, $no_urut_sk, $idUsulan, $keterangan) {
        try {
            $emailLib = new EmailLib();
            $sended = $emailLib->sendNotifikasi($dataPtk->email, "Usulan TPG Tahun " . $twAktive->tahun . ' Triwulan ' . $twAktive->tw . ' dengan Kode ' . $kode_usulan . ' Sedang Dalam Proses Transfer.' , '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
        Usulan pencairan TPG anda tahun ' . $twAktive->tahun . ' triwulan ' . $twAktive->tw . ' dengan Kode Usulan ' . $kode_usulan . ' Dan NO SKTP : ' . $no_sk_dirgen . ' NO URUT: ' . $no_urut_sk . ' <b>SEDANG DALAM PROSES TRANSFER</b><p><p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">' . $keterangan .'</p>');
            if($sended->code == 200) {
                $this->_db->table('_tb_usulan_tpg_siap_sk')->where('id', $idUsulan)->update(['notif_tolak' => 1]);
            }
        } catch (Exception $exep) {
        }
    }

    public function _send_notif_touser_prosestransfer_tamsil($twAktive, $dataPtk, $kode_usulan, $idUsulan, $keterangan) {
        try {
            $emailLib = new EmailLib();
            $sended = $emailLib->sendNotifikasi($dataPtk->email, "Usulan Tamsil Tahun " . $twAktive->tahun . ' Triwulan ' . $twAktive->tw . ' dengan Kode ' . $kode_usulan . ' Sedang Dalam Proses Transfer.' , '<p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">
        Usulan pencairan Tamsil anda tahun ' . $twAktive->tahun . ' triwulan ' . $twAktive->tw . ' dengan Kode Usulan ' . $kode_usulan . ' <b>SEDANG DALAM PROSES TRANSFER</b><p><p style="font-family:Avenir,Helvetica,sans-serif;box-sizing:border-box;color:#74787e;font-size:16px;line-height:1.5em;margin-top:0;text-align:left">' . $keterangan .'</p>');
            if($sended->code == 200) {
                $this->_db->table('_tb_usulan_tamsil_transfer')->where('id', $idUsulan)->update(['notif_tolak' => 1]);
            }
        } catch (Exception $exep) {
        }
    }

    public function aksiKeTolak($idPtk, $sendNotif = 0, $kode_usulan = '', $keterangan = '', $idUsulan) {
        $twAktive = $this->getTwAktif();
        $idTw = $twAktive->id;
        
        $oldData = $this->_db->table('_upload_data_attribut')->where(['id_ptk' => $idPtk, 'id_tahun_tw' => $idTw])->get()->getRowObject();
        
        if($oldData) {
        
            $data = [
                'is_locked' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // $this->_db->transBegin();
            try {
                $this->_db->table('_upload_data_attribut')->where('id', $oldData->id)->update($data);
            } catch (\Throwable $th) {
                // $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal mengunlock atribut ptk.";
                return $response;
            }
            
            if($this->_db->affectedRows() > 0) {
                $dataPtk = $this->_db->table('_ptk_tb')->where('id', $oldData->id_ptk)->get()->getRowObject();
                $this->_db->table('_ptk_tb')->where('id', $dataPtk->id_ptk)->update($data);
                
                if($this->_db->affectedRows() > 0) {
                    if($sendNotif == 1) {
                        $this->_send_notif_touser($twAktive, $dataPtk, $kode_usulan, $keterangan, $idUsulan);
                    }
                    // $this->_db->transCommit();
                    $response = new \stdClass;
                    $response->code = 200;
                    $response->data = $data;
                    $response->message = "Berhasil mengunlock ptk.";
                    return $response;
                } else {
                    // $this->_db->transRollback();
                    $response = new \stdClass;
                    $response->code = 400;
                    $response->message = "Gagal mengunlock ptk.";
                    return $response;
                }
            } else {
                // $this->_db->transRollback();
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Gagal mengunlock atribut ptk.";
                return $response;
            }
        } else {
            // $this->_db->transRollback();
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Referensi triwulan aktif tidak ditemukan.";
            return $response;
        }
    }

}
