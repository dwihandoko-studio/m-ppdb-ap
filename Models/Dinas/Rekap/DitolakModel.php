<?php

namespace App\Models\Dinas\Rekap;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class DitolakModel extends Model
{
    protected $table = "_tb_pendaftar_tolak a";
    protected $column_order = array(null, null, 'b.fullname', 'b.nisn', 'a.kode_pendaftaran', 'a.via_jalur', 'c.nama', 'c.npsn', 'a.keterangan_penolakan');
    protected $column_search = array('b.fullname', 'b.nisn', 'b.nip', 'c.nama', 'c.npsn', 'a.kode_pendaftaran');
    protected $order = array('b.fullname' => 'asc', 'c.nama' => 'asc');
    protected $request;
    protected $db;
    protected $dt;


    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;

        $this->dt = $this->db->table($this->table);
    }
    private function _get_datatables_query()
    {

        $select = "b.*, k.lampiran_kk, k.lampiran_lulus, k.lampiran_prestasi, k.lampiran_afirmasi, k.lampiran_mutasi, k.lampiran_lainnya, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_tujuan, j.npsn as npsn_sekolah_tujuan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, d.nama as nama_provinsi, e.nama as nama_kabupaten, f.nama as nama_kecamatan, g.nama as nama_kelurahan, h.nama as nama_dusun, i.nama as nama_bentuk_pendidikan, a.keterangan_penolakan";

        $this->dt->select($select);
        $this->dt->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT');
        $this->dt->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT');
        $this->dt->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT');
        $this->dt->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT');
        $this->dt->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT');
        $this->dt->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT');
        $this->dt->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT');
        $this->dt->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT');
        $this->dt->join('ref_dusun h', 'b.dusun = h.id', 'LEFT');
        $this->dt->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT');

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables($filterJenjang, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 3) AND (a.batal_pendaftar = 0)");

        if ($filterJenjang != "") {
            $this->dt->where('a.kecamatan', $filterJenjang);
        }

        if ($filterSekolah != "") {
            $this->dt->where('a.kelurahan', $filterSekolah);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenjang, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 3) AND (a.batal_pendaftar = 0)");

        if ($filterJenjang != "") {
            $this->dt->where('a.kecamatan', $filterJenjang);
        }

        if ($filterSekolah != "") {
            $this->dt->where('a.kelurahan', $filterSekolah);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenjang, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 3) AND (a.batal_pendaftar = 0)");

        if ($filterJenjang != "") {
            $this->dt->where('a.kecamatan', $filterJenjang);
        }

        if ($filterSekolah != "") {
            $this->dt->where('a.kelurahan', $filterSekolah);
        }

        return $this->dt->countAllResults();
    }
}
