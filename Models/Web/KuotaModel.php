<?php

namespace App\Models\Web;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class KuotaModel extends Model
{
    protected $table = "_setting_kuota_tb a";
    protected $column_order = array(null, 'b.nama', 'b.npsn', 'c.nama', 'a.jumlah');
    protected $column_search = array('b.nama', 'b.npsn');
    protected $order = array('b.nama' => 'asc');
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

        $select = "a.*, b.nama as nama_sekolah, c.nama as nama_kecamatan, d.nama as nama_jenjang, e.no_hp as no_hp_sekolah";

        $this->dt->select($select);
        $this->dt->join('_users_profil_tb e', 'a.sekolah_id = e.sekolah_id');
        $this->dt->join('ref_sekolah b', 'a.sekolah_id = b.id', 'LEFT');
        $this->dt->join('ref_bentuk_pendidikan d', 'a.bentuk_pendidikan_id = d.id', 'LEFT');
        $this->dt->join('ref_kecamatan c', 'LEFT(b.kode_wilayah,6) = c.id', 'LEFT');

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
    function get_datatables($filterKecamatan, $filterJenajng)
    {
        $this->_get_datatables_query();

        if ($filterKecamatan != "") {
            $this->dt->where('b.kode_wilayah', $filterKecamatan);
        }

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered($filterKecamatan, $filterJenajng)
    {
        $this->_get_datatables_query();

        if ($filterKecamatan != "") {
            $this->dt->where('b.kode_wilayah', $filterKecamatan);
        }

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        return $this->dt->countAllResults();
    }
    public function count_all($filterKecamatan, $filterJenajng)
    {
        $this->_get_datatables_query();

        if ($filterKecamatan != "") {
            $this->dt->where('b.kode_wilayah', $filterKecamatan);
        }

        if ($filterJenajng != "") {
            $this->dt->where('b.bentuk_pendidikan_id', $filterJenajng);
        }

        return $this->dt->countAllResults();
    }
}
