<?php

namespace App\Models\Dinas;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;
use Firebase\JWT\JWT;

class KuotaModel extends Model
{
    protected $table = "_setting_kuota_tb a";
    protected $column_order = array(null, null, 'c.nama', 'a.bentuk_pendidikan_id', 'a.npsn', 'b.nama', 'a.jumlah_rombel_kebutuhan', 'a.zonasi', 'a.afirmasi', 'a.mutasi', 'a.prestasi');
    protected $column_search = array('a.npsn', 'b.nama', 'c.nama');
    protected $order = array('a.is_locked' => 'asc','a.bentuk_pendidikan_id' => 'asc', 'b.nama' => 'asc');
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

        $select = "a.*, b.nama as nama_sekolah, c.nama as nama_kecamatan, d.nama as nama_jenjang";

        $this->dt->select($select);
        $this->dt->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT');
        $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        $this->dt->join('ref_kecamatan c', 'b.kode_wilayah = c.id', 'LEFT');

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
    function get_datatables($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        // $this->dt->whereIn('a.status_usulan', [1]);

        if ($filterKecamatan != "") {
            $this->dt->where('b.kode_wilayah', $filterKecamatan);
        }

        if ($filterJenjang != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        // $this->dt->whereIn('a.status_usulan', [1]);

        if ($filterKecamatan != "") {
            $this->dt->where('b.kode_wilayah', $filterKecamatan);
        }

        if ($filterJenjang != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan, $filterJenjang)
    {
        $this->_get_datatables_query();
        // $this->dt->whereIn('a.status_usulan', [1]);

        if ($filterKecamatan != "") {
            $this->dt->where('b.kode_wilayah', $filterKecamatan);
        }

        if ($filterJenjang != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenjang);
        }

        return $this->dt->countAllResults();
    }
}
