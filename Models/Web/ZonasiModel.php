<?php

namespace App\Models\Web;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ZonasiModel extends Model
{
    protected $table = "v_tb_sekolah_zonasi a";
    protected $column_order = array(null, null, 'a.npsn', 'a.nama', null);
    protected $column_search = array('a.nama', 'a.npsn');
    protected $order = array('a.nama' => 'asc');
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

        $select = "a.*, count(a.npsn) as jumlah, e.no_hp as no_hp_sekolah";

        $this->dt->select($select);
        $this->dt->join('_users_profil_tb e', 'a.id = e.sekolah_id');
        // $this->dt->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT');
        // $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        // $this->dt->join('ref_kecamatan c', 'b.kode_wilayah = c.id', 'LEFT');

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
    function get_datatables($filterJenajng, $filterKecamatan)
    {
        $this->_get_datatables_query();
        $this->dt->where('a.status_sekolah', '1');

        if ($filterJenajng != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($filterKecamatan != "") {
            $this->dt->where('a.kecamatan_id', $filterKecamatan);
        }

        $this->dt->groupBy('a.npsn');

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterJenajng, $filterKecamatan)
    {
        $this->_get_datatables_query();
        $this->dt->where('a.status_sekolah', '1');

        if ($filterJenajng != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($filterKecamatan != "") {
            $this->dt->where('a.kecamatan_id', $filterKecamatan);
        }

        $this->dt->groupBy('a.npsn');

        return $this->dt->countAllResults();
    }
    public function count_all($filterJenajng, $filterKecamatan)
    {
        $this->_get_datatables_query();
        $this->dt->where('a.status_sekolah', '1');

        if ($filterJenajng != "") {
            $this->dt->where('a.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($filterKecamatan != "") {
            $this->dt->where('a.kecamatan_id', $filterKecamatan);
        }

        $this->dt->groupBy('a.npsn');

        return $this->dt->countAllResults();
    }
}
