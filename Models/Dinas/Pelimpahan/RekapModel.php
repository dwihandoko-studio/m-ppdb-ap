<?php

namespace App\Models\Dinas\Pelimpahan;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class RekapModel extends Model
{
    protected $table = "_tb_pendaftar a";
    protected $column_order = array(null, null, 'b.fullname', 'b.nisn', 'a.kode_pendaftaran', 'a.via_jalur', 'c.nama', 'c.npsn');
    protected $column_search = array('b.fullname', 'b.nisn', 'c.nama', 'j.npsn', 'a.kode_pendaftaran');
    protected $order = array('j.nama' => 'asc', 'b.nama' => 'asc');
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

        $select = "b.id, b.nisn, b.fullname, b.peserta_didik_id, b.latitude, b.longitude, a.id as id_pendaftaran, c.nama as nama_sekolah_asal, c.npsn as npsn_sekolah_asal, j.nama as nama_sekolah_pelimpahan, j.npsn as npsn_sekolah_pelimpahan, j.latitude as latitude_sekolah_tujuan, j.longitude as longitude_sekolah_tujuan, a.kode_pendaftaran, a.via_jalur, a.created_at, ROUND(getDistanceKm(b.latitude,b.longitude,j.latitude,j.longitude), 2) AS jarak";

        $this->dt->select($select);
        $this->dt->join('_users_profil_tb b', 'a.peserta_didik_id = b.peserta_didik_id', 'LEFT');
        $this->dt->join('ref_sekolah c', 'a.from_sekolah_id = c.id', 'LEFT');
        $this->dt->join('ref_sekolah j', 'a.tujuan_sekolah_id = j.id', 'LEFT');
        // $this->dt->join('ref_bentuk_pendidikan i', 'c.bentuk_pendidikan_id = i.id', 'LEFT');
        // $this->dt->join('ref_provinsi d', 'b.provinsi = d.id', 'LEFT');
        // $this->dt->join('ref_kabupaten e', 'b.kabupaten = e.id', 'LEFT');
        // $this->dt->join('ref_kecamatan f', 'b.kecamatan = f.id', 'LEFT');
        // $this->dt->join('ref_kelurahan g', 'b.kelurahan = g.id', 'LEFT');
        // $this->dt->join('ref_dusun h', 'b.dusun = h.id', 'LEFT');
        // $this->dt->join('_upload_kelengkapan_berkas k', 'b.id = k.user_id', 'LEFT');

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
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 1)");
        $this->dt->where('a.via_jalur', 'PELIMPAHAN');
        $this->dt->where('a.status_pendaftaran', 2);

        if ($filterJenjang != "") {
            $this->dt->where('j.bentuk_pendidikan_id', $filterJenjang);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenjang, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 1)");
        $this->dt->where('a.via_jalur', 'PELIMPAHAN');
        $this->dt->where('a.status_pendaftaran', 2);

        if ($filterJenjang != "") {
            $this->dt->where('j.bentuk_pendidikan_id', $filterJenjang);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenjang, $filterSekolah)
    {
        $this->_get_datatables_query();
        // $this->dt->where("a.tujuan_sekolah_id = (SELECT sekolah_id FROM _users_profil_tb WHERE id = '$userId') AND (a.status_pendaftaran = 1)");
        $this->dt->where('a.via_jalur', 'PELIMPAHAN');
        $this->dt->where('a.status_pendaftaran', 2);

        if ($filterJenjang != "") {
            $this->dt->where('j.bentuk_pendidikan_id', $filterJenjang);
        }

        return $this->dt->countAllResults();
    }
}
