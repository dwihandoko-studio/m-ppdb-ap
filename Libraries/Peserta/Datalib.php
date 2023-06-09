<?php

namespace App\Libraries\Peserta;

class Datalib
{
    private $_db;
    private $tb;
    function __construct()
    {
        helper(['text', 'array', 'filesystem']);
        $this->_db      = \Config\Database::connect();
    }

    public function cekAlreadyRegistered($peserta_didik_id)
    {
        $dataPeserta =  $this->_db->table('_tb_pendaftar_temp')->where('peserta_didik_id', $peserta_didik_id)->get()->getRowObject();
        if ($dataPeserta) {
            return $dataPeserta;
        }
        return $this->registeredAndVerified($peserta_didik_id);
    }

    private function registeredAndVerified($peserta_didik_id)
    {
        return $this->_db->table('_tb_pendaftar')->where('peserta_didik_id', $peserta_didik_id)->get()->getRowObject();
    }

    public function canRegister($jalur = "ZONASI")
    {
        $setting = $this->_db->table('_setting_jadwal_tb')->where('is_active', 1)->get()->getRowObject();
        if (!$setting) {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Seting jadwal tidak ditemukan.";
            return $response;
        }

        return $this->verifiCanRegister($setting, $jalur);
    }

    private function verifiCanRegister($setting, $jalur)
    {
        if ($jalur == "ZONASI") {
            $today = date("Y-m-d H:i:s");

            $startdate = strtotime($today);
            $enddateAwal = strtotime($setting->tgl_awal_pendaftaran_zonasi);

            if ($startdate < $enddateAwal) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB belum dibuka.";
                return $response;
            }

            $enddateAkhir = strtotime($setting->tgl_akhir_pendaftaran_zonasi);
            if ($startdate > $enddateAkhir) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB telah ditutup.";
                return $response;
            }
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Pendaftaran PPDB telah dibuka.";
            return $response;
        } else if ($jalur == "AFIRMASI") {
            $today = date("Y-m-d H:i:s");

            $startdate = strtotime($today);
            $enddateAwal = strtotime($setting->tgl_awal_pendaftaran_afirmasi);

            if ($startdate < $enddateAwal) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB belum dibuka.";
                return $response;
            }

            $enddateAkhir = strtotime($setting->tgl_akhir_pendaftaran_afirmasi);
            if ($startdate > $enddateAkhir) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB telah ditutup.";
                return $response;
            }
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Pendaftaran PPDB telah dibuka.";
            return $response;
        } else if ($jalur == "PRESTASI") {
            $today = date("Y-m-d H:i:s");

            $startdate = strtotime($today);
            $enddateAwal = strtotime($setting->tgl_awal_pendaftaran_prestasi);

            if ($startdate < $enddateAwal) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB belum dibuka.";
                return $response;
            }

            $enddateAkhir = strtotime($setting->tgl_akhir_pendaftaran_prestasi);
            if ($startdate > $enddateAkhir) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB telah ditutup.";
                return $response;
            }
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Pendaftaran PPDB telah dibuka.";
            return $response;
        } else if ($jalur == "MUTASI") {
            $today = date("Y-m-d H:i:s");

            $startdate = strtotime($today);
            $enddateAwal = strtotime($setting->tgl_awal_pendaftaran_mutasi);

            if ($startdate < $enddateAwal) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB belum dibuka.";
                return $response;
            }

            $enddateAkhir = strtotime($setting->tgl_akhir_pendaftaran_mutasi);
            if ($startdate > $enddateAkhir) {
                $response = new \stdClass;
                $response->code = 400;
                $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB telah ditutup.";
                return $response;
            }
            $response = new \stdClass;
            $response->code = 200;
            $response->message = "Pendaftaran PPDB telah dibuka.";
            return $response;
        } else {
            $response = new \stdClass;
            $response->code = 400;
            $response->message = "Mohon maaf, saat ini proses pendaftaran PPDB belum dimulai.";
            return $response;
        }
    }
}
